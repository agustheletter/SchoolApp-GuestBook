<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PegawaiModel;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Endpoint untuk React: Mengambil daftar pegawai untuk tabel utama.
     * Mendukung paginasi dan pencarian (server-side).
     */
    public function index(Request $request)
    {
        $query = PegawaiModel::query();

        // Logika pencarian server-side
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('namapegawai', 'like', "%{$searchTerm}%")
                  ->orWhere('nip', 'like', "%{$searchTerm}%");
            });
        }

        $perPage = $request->get('rows_per_page', 10);

        // Eager load relasi yang mungkin dibutuhkan di tabel utama
        $pegawai = $query->with('agama')->orderBy('namapegawai', 'asc')->paginate($perPage);

        return response()->json($pegawai);
    }

    /**
     * Endpoint untuk React: Mengambil detail LENGKAP satu pegawai untuk modal popup.
     */
    public function show($idpegawai)
    {
        // Eager load semua relasi yang dibutuhkan untuk halaman detail.
        $pegawai = PegawaiModel::with([
            'agama',
            'pangkatpegawai.pangkat',
            'gajiberkala',
            'pendidikanpegawai',
            'keluargapegawai'
        ])->find($idpegawai);

        if (!$pegawai) {
            return response()->json(['success' => false, 'message' => 'Data pegawai tidak ditemukan'], 404);
        }

        // Format data agar lebih mudah dibaca di frontend
        $pegawai->nama_lengkap = trim("{$pegawai->gelardepan} {$pegawai->namapegawai} {$pegawai->gelarbelakang}");

        return response()->json([
            'success' => true,
            'data' => $pegawai
        ]);
    }
}
