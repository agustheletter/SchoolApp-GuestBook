<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaranModel;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    /**
     * Get all tahun ajaran for dropdown
     */
    public function index()
    {
        try {
            // Ambil data tahun ajaran dari database
            $tahunAjaran = TahunAjaranModel::select('idthnajaran', 'thnajaran')
                // ->where('statusaktif', 'Y') // Optional: hanya yang aktif
                ->orderBy('thnajaran', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $tahunAjaran
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data tahun ajaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get tahun ajaran aktif saat ini
     */
    public function getAktif()
    {
        try {
            $tahunAjaranAktif = TahunAjaranModel::select('idthnajaran', 'thnajaran')
                ->where('statusaktif', 1) // Sesuaikan dengan field status di tabel kamu
                ->first();

            return response()->json([
                'success' => true,
                'data' => $tahunAjaranAktif
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil tahun ajaran aktif'
            ], 500);
        }
    }
}
