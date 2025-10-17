<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PegawaiModel; // Pastikan menggunakan model yang benar (App\Models\Pegawai)
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Endpoint untuk React: Mengambil daftar pegawai dari database LOKAL.
     * Mendukung paginasi dan pencarian.
     */
    public function index(Request $request)
    {
        $query = PegawaiModel::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('namapegawai', 'like', "%{$searchTerm}%")
                  ->orWhere('nip', 'like', "%{$searchTerm}%");
            });
        }

        // Ambil data dengan paginasi agar tidak berat di frontend
        $pegawai = $query->orderBy('namapegawai', 'asc')->paginate(20);

        return response()->json($pegawai);
    }

    /**
     * Endpoint untuk React: Mengambil detail satu pegawai dari database LOKAL berdasarkan NIP.
     */
    public function show($nip)
    {
        // Cari pegawai berdasarkan NIP, bukan ID.
        $pegawai = PegawaiModel::where('nip', $nip)->first();

        if (!$pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data pegawai tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pegawai
        ]);
    }

    // Fungsi store(), update(), dan destroy() kita hapus karena
    // Aplikasi Anak tidak boleh mengubah data master pegawai.
}
