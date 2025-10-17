<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SiswaModel;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Endpoint untuk React: Mengambil daftar siswa dari database LOKAL.
     * Mendukung paginasi dan pencarian.
     */
    public function index(Request $request)
    {
        $query = SiswaModel::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('namasiswa', 'like', "%{$searchTerm}%")
                  ->orWhere('nis', 'like', "%{$searchTerm}%")
                  ->orWhere('nisn', 'like', "%{$searchTerm}%");
            });
        }

        $siswa = $query->orderBy('namasiswa', 'asc')->paginate(20);

        return response()->json($siswa);
    }

    /**
     * Endpoint untuk React: Mengambil detail satu siswa dari database LOKAL berdasarkan NIS.
     */
    public function show($nis)
    {
        // Cari siswa berdasarkan NIS, bukan ID.
        $siswa = SiswaModel::where('nis', $nis)->first();

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $siswa
        ]);
    }

    // Fungsi store(), update(), dan destroy() kita hapus karena
    // Aplikasi Anak tidak boleh mengubah data master siswa.
}
