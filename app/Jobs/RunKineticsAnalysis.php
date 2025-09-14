<?php

namespace App\Jobs;

use App\Models\HasilAnalisis;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class RunKineticsAnalysis implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $analisis;
    protected $inputPath;
    protected $storageFullPath;

    /**
     * Create a new job instance.
     */
    public function __construct(HasilAnalisis $analisis, $inputPath, $storageFullPath)
    {
        $this->analisis = $analisis;
        $this->inputPath = $inputPath;
        $this->storageFullPath = $storageFullPath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Starting async Python analysis", [
            'analysis_id' => $this->analisis->id,
        ]);

        if (function_exists('set_time_limit')) {
            @set_time_limit(0);
        }

        $pythonBin = env('PYTHON_PATH', 'python');
        $pyScript = base_path('app/python/analyze_kinetics.py');
        $paramsEncoded = base64_encode(json_encode($this->analisis->array_param));

        $py = new Process([
            $pythonBin,
            $pyScript,
            '--video', $this->storageFullPath,
            '--params', $paramsEncoded
        ]);
        $py->setTimeout(null);
        $py->setIdleTimeout(null);
        $py->run();

        try {
            $py->run(function ($type, $buffer) use ($py) {
                // $type is Process::OUT or Process::ERR
                if ($type === Process::OUT) {
                    Log::info("Python stdout", ['analysis_id'=>$this->analisis->id, 'buf' => substr($buffer, 0, 1000)]);
                } else {
                    Log::warning("Python stderr", ['analysis_id'=>$this->analisis->id, 'buf' => substr($buffer, 0, 1000)]);
                }
            });
        } catch (\Throwable $e) {
            Log::error("Process run exception", ['err'=>$e->getMessage()]);
            $this->analisis->status = 'failed';
            $this->analisis->save();
            return;
        }

        if (!$py->isSuccessful()) {
            $this->analisis->status = 'failed';
            $this->analisis->save();

            Log::error("Python analysis failed", [
                'analysis_id' => $this->analisis->id,
                'stderr' => $py->getErrorOutput(),
                'stdout' => $py->getOutput(),
            ]);
            return;
        }

        $json = json_decode($py->getOutput(), true);
        if (!$json) {
            $this->analisis->status = 'failed';
            $this->analisis->save();
            Log::error("Invalid JSON from Python", [
                'analysis_id' => $this->analisis->id,
                'output' => $py->getOutput(),
            ]);
            return;
        }

        // update DB
        $this->analisis->hasil_analisis = json_encode($json['hasil_analisis'] ?? '');
        $this->analisis->graf = $json['graf_public'] ?? [];
        $this->analisis->durasi = $json['durasi'] ?? null;
        $this->analisis->akurasi = $json['akurasi'] ?? null;
        $this->analisis->data_point = $json['data_point'] ?? null;
        $this->analisis->interpretasi = $json['interpretasi'] ?? null;
        $this->analisis->rekomendasi = $json['rekomendasi'] ?? null;
        $this->analisis->regression_results = $json['regression_results'] ?? null;
        $this->analisis->half_life = $json['half_life'] ?? null;
        $this->analisis->status = 'done';
        $this->analisis->save();

        Log::info("Analisis selesai async", [
            'analysis_id' => $this->analisis->id
        ]);
    }
}
