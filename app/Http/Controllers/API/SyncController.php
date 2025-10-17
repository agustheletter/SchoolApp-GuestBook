<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class SyncController extends Controller
{
    /**
     * Menerima perintah dari React untuk memulai sinkronisasi.
     */
    public function triggerSync(Request $request)
    {
        try {
            // Menjalankan command sync:master-data di background
            // agar tidak membuat request dari frontend menunggu (timeout).
            $process = new Process(['php', base_path('artisan'), 'sync:master-data']);
            $process->disableOutput();
            $process->run();

            // Cek jika proses gagal (opsional, tapi bagus untuk logging)
            if (!$process->isSuccessful()) {
                 // Log error jika command gagal dieksekusi
                 Log::error('Sync process failed to start: ' . $process->getErrorOutput());
            }

            return response()->json([
                'success' => true,
                'message' => 'Proses sinkronisasi telah dimulai di background. Data akan diperbarui dalam beberapa saat.'
            ], 202); // 202 Accepted

        } catch (\Exception $e) {
            Log::error('Failed to trigger sync: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memulai proses sinkronisasi.'
            ], 500);
        }
    }
}

