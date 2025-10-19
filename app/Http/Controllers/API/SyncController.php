<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class SyncController extends Controller
{
    /**
     * Menerima perintah dari React untuk memulai sinkronisasi.
     */
    public function triggerSync(Request $request)
    {
        try {
            // Mendorong command ke antrian (queue) untuk dieksekusi di background.
            // Ini adalah cara standar Laravel dan lebih aman.
            // Artisan::queue('sync:master-data');

            // Menggunakan Artisan::call() untuk eksekusi langsung (blocking)
            // Cocok untuk development, tapi berisiko timeout jika proses lama.
            Artisan::call('sync:master-data');

            return response()->json([
                'success' => true,
                'message' => 'Sinkronisasi telah selesai dijalankan.'
            ], 200); // 200 OK karena proses sudah selesai

        } catch (\Exception $e) {
            Log::error('Failed to run sync command directly: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menjalankan proses sinkronisasi.'
            ], 500);
        }
    }
}

