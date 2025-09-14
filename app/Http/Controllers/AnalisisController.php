<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilAnalisis;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;
use Exception;

class AnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.analisis');
    }
    public function store(Request $request)
    {
        Log::info("Memulai proses upload dan analisis video");
        // 1. Validasi input
        try{
            $validated = $request->validate([
                'video' => 'required|file|mimetypes:video/mp4,video/avi,video/mov|max:51200',
                'trim_start' => 'required|integer|min:0',
                'trim_end' => 'required|integer|min:1|gt:trim_start',
                'roi_x' => 'required|numeric|min:0',
                'roi_y' => 'required|numeric|min:0',
                'roi_width' => 'required|numeric|min:1',
                'roi_height' => 'required|numeric|min:1',
                'konsentrasi_awal' => 'required|numeric|min:0',
                'ph' => 'required|numeric|min:0|max:14',
                'volume' => 'required|numeric|min:0',
                'pelarut' => 'required|string|max:100',
                'laju_pengadukan' => 'required|numeric|min:0',
                'nama_reaksi' => 'required|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error("Validasi gagal", $e->errors());
            return back()->withErrors($e->errors())->withInput();
        }

        Log::info("validasi input sukses");

        // 2. Persiapan variabel
        $userId = Auth::id();
        $trimStart = (int) $validated['trim_start'];
        $trimEnd   = (int) $validated['trim_end'];

        $roiX = (int) $validated['roi_x'];
        $roiY = (int) $validated['roi_y'];
        $roiW = (int) $validated['roi_width'];
        $roiH = (int) $validated['roi_height'];

        $count = HasilAnalisis::where('id_user', $userId)->count();
        $number = $count + 1;

        // 3. Simpan file upload
        $uploadDirRel = 'uploads';
        $uploadDirFull = storage_path("app/{$uploadDirRel}");
        if (!is_dir($uploadDirFull)) {
            mkdir($uploadDirFull, 0755, true);
        }

        $file = $request->file('video');
        $origExt = $file->getClientOriginalExtension() ?: 'mp4';
        $inputFilename = "{$userId}_{$number}_orig.{$origExt}";
        $file->move($uploadDirFull, $inputFilename);
        $inputPath = $uploadDirFull . DIRECTORY_SEPARATOR . $inputFilename;

        // 4. Output path
        Storage::makeDirectory('public/videos');
        $filename = "{$userId}_{$number}.mp4";
        $storageRelative = "public/videos/{$filename}";
        $storageFullPath = storage_path("app/{$storageRelative}");

        Log::info("file upload disimpan", [
            'user_id' => $userId,
            'input_path' => $inputPath,
            'output_path' => $storageFullPath,
            'trim_start' => $trimStart,
            'trim_end' => $trimEnd,
            'roi' => [
                'x' => $roiX,
                'y' => $roiY,
                'width' => $roiW,
                'height' => $roiH
            ]
        ]);
        // 5. ffmpeg trim + crop
        $ffmpegBin = env('FFMPEG_PATH', 'ffmpeg');
        $ff = new Process([
            $ffmpegBin,
            '-y',
            '-i', $inputPath,
            '-ss', (string)$trimStart,
            '-to', (string)$trimEnd,
            '-filter:v', "crop={$roiW}:{$roiH}:{$roiX}:{$roiY}",
            '-c:v', 'libx264',
            '-c:a', 'aac',
            $storageFullPath
        ]);
        $ff->setTimeout(0);
        $ff->run();

        if (!$ff->isSuccessful() || !file_exists($storageFullPath)) {
            $err = $ff->getErrorOutput() ?: $ff->getOutput();
            Log::error("FFmpeg crop+trim failed", [
                'exit' => $ff->getExitCode(),
                'stderr' => $ff->getErrorOutput(),
                'stdout' => $ff->getOutput()
            ]);
            return back()->withErrors([
                'video' => "Gagal memproses video (ffmpeg). Detail: " . substr($err ?: 'unknown error', 0, 2000)
            ]);
        }

        // 6. DB record
        $analisis = HasilAnalisis::create([
            'id_user' => $userId,
            'video_path' => "storage/videos/{$filename}",
            'analisis_mode' => 'Analisis Kinetika',
            'array_param' => [
                'konsentrasi_awal' => $validated['konsentrasi_awal'],
                'ph' => $validated['ph'],
                'volume_total' => $validated['volume'],
                'pelarut' => $validated['pelarut'],
                'laju_pengadukan' => $validated['laju_pengadukan'],
                'nama_reaksi' => $validated['nama_reaksi'],
                'roi' => [
                    'x' => $roiX,
                    'y' => $roiY,
                    'width' => $roiW,
                    'height' => $roiH
                ]
            ],
            'status' => 'processing',
        ]);

        // 7. Dispatch job analisis
        dispatch(new \App\Jobs\RunKineticsAnalysis($analisis, $inputPath, $storageFullPath));

        return redirect()->route('analisis.history')
            ->with('success', 'Video berhasil diunggah, analisis sedang diproses.');
    }
    
    // // page yang menampilkan progress (form-analisis.blade.php)
    // public function formAnalysis($id)
    // {
    //     $analisis = HasilAnalisis::findOrFail($id);
    //     return view('analisis.history', compact('analisis'));
    // }


    // polling endpoint (JSON)
    public function status($id)
    {
        $analisis = HasilAnalisis::findOrFail($id);
        $progress = Cache::get("analysis_progress_{$id}", 0);
        return response()->json([
            'progress' => (int) $progress,
            'status' => $analisis->status,
        ]);
    }

    // Tampilkan daftar history analisis untuk user login
    public function history()
    {
        $analyses = HasilAnalisis::where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('page.history', compact('analyses'));
    }

    // Tampilkan detail analisis (result page)
    public function show($id, Request $request)
    {
        $analysis = HasilAnalisis::where('id', $id)
            ->where('id_user', $request->user()->id)
            ->firstOrFail();

        return view('page.hasil_analisis', compact('analysis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
