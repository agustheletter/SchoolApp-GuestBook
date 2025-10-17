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
            Artisan::queue('sync:master-data');

            return response()->json([
                'success' => true,
                'message' => 'Proses sinkronisasi telah dimulai di background. Data akan diperbarui dalam beberapa saat.'
            ], 202); // 202 Accepted

        } catch (\Exception $e) {
            Log::error('Failed to queue sync command: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memulai proses sinkronisasi. Cek log untuk detail.'
            ], 500);
        }
    }
}

