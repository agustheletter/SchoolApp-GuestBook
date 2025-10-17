<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SyncController extends Controller
{
    /**
     * Menerima perintah dari React untuk memulai sinkronisasi.
     */
    public function triggerSync(Request $request)
    {
        // Di sini kita akan meletakkan logika untuk memanggil API Induk.
        // Untuk sekarang, kita simulasikan saja.

        // NANTI, baris di bawah ini akan kita aktifkan:
        // Artisan::queue('sync:master-data');

        // Kirim response cepat ke frontend bahwa proses sudah dimulai.
        return response()->json([
            'success' => true,
            'message' => 'Proses sinkronisasi telah dimulai di background.'
        ], 202); // 202 Accepted
    }
}
