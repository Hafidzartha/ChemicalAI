<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HasilAnalisis;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Process\Process;

class RunAnalysis extends Command
{
    /**
     * Nama command untuk artisan
     *
     * @var string
    */
    protected $signature = 'analysis:run {id}';
    protected $description = 'Run Python analysis for an uploaded video';

    public function handle()
    {
        $id = $this->argument('id');
        $analisis = HasilAnalisis::find($id);
        if (!$analisis) {
            $this->error("Analisis {$id} not found");
            return 1;
        }

        Cache::put("analysis_progress_{$id}", 5);

        // build command to call python script
        $videoFullPath = base_path('storage/app/public/videos/') . basename($analisis->video_path);
        $outJson = storage_path("app/analysis_output/analysis_{$id}.json");
        @mkdir(dirname($outJson), 0755, true);

        // pass params as base64-encoded json to avoid shell issues
        $paramsEncoded = base64_encode(json_encode($analisis->array_param));
        $pyScript = base_path('python/analyze_kinetics.py');

        $process = new Process(['python3', $pyScript, '--video', $videoFullPath, '--params', $paramsEncoded, '--out', $outJson]);
        $process->setTimeout(0);

        // Run and capture output for progress lines
        $process->run(function ($type, $buffer) use ($id) {
            // Buffer may contain lines e.g. "PROGRESS:30"
            foreach (preg_split("/\r\n|\n|\r/", $buffer) as $line) {
                $line = trim($line);
                if (stripos($line, 'PROGRESS:') === 0) {
                    $pct = intval(substr($line, strlen('PROGRESS:')));
                    Cache::put("analysis_progress_{$id}", $pct);
                }
            }
        });

        if (!$process->isSuccessful()) {
            $analisis->status = 'failed';
            $analisis->save();
            Cache::put("analysis_progress_{$id}", 100);
            $this->error("Python process failed");
            return 1;
        }

        // read output json
        if (file_exists($outJson)) {
            $json = json_decode(file_get_contents($outJson), true);
            // populate DB fields
            $analisis->hasil_analisis = $json['hasil_analisis'] ?? null;
            $analisis->graf = $json['graf'] ?? null;
            $analisis->durasi = $json['durasi'] ?? null;
            $analisis->akurasi = $json['akurasi'] ?? null;
            $analisis->data_point = $json['data_point'] ?? null;
            $analisis->interpretasi = $json['interpretasi'] ?? null;
            $analisis->rekomendasi = $json['rekomendasi'] ?? null;
            $analisis->status = 'done';
            $analisis->save();
            Cache::put("analysis_progress_{$id}", 100);
            $this->info("Analysis finished for {$id}");
            return 0;
        } else {
            $analisis->status = 'failed';
            $analisis->save();
            Cache::put("analysis_progress_{$id}", 100);
            $this->error("Output JSON not found");
            return 1;
        }
    }
}