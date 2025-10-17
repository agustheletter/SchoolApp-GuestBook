<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SiswaModel;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Endpoint untuk React: Mengambil daftar siswa untuk tabel utama.
     * Mendukung paginasi dan pencarian (server-side).
     */
    public function index(Request $request)
    {
        $query = SiswaModel::query();

        // Logika pencarian server-side
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('namasiswa', 'like', "%{$searchTerm}%")
                  ->orWhere('nis', 'like', "%{$searchTerm}%")
                  ->orWhere('nisn', 'like', "%{$searchTerm}%");
            });
        }

        // Ambil rows_per_page dari request, default 10
        $perPage = $request->get('rows_per_page', 10);
        $siswa = $query->with('thnajaran')->orderBy('namasiswa', 'asc')->paginate($perPage);

        return response()->json($siswa);
    }

    /**
     * Endpoint untuk React: Mengambil detail LENGKAP satu siswa untuk modal popup.
     */
    public function show($idsiswa)
    {
        // Eager load semua relasi yang dibutuhkan untuk halaman detail.
        // Ini akan mengambil data siswa, data orang tuanya, dan semua riwayat kelasnya
        // beserta detail dari setiap kelas tersebut dalam satu query efisien.
        $siswa = SiswaModel::with([
            'ortu',
            'siswakelas.kelasDetail.kelas',
            'siswakelas.kelasDetail.thnajaran', // Relasi di KelasDetailModel diubah menjadi 'thnajaran'
            'siswakelas.kelasDetail.pegawai' // <-- PERUBAHAN DI SINI: Menggunakan nama relasi yang benar
        ])->find($idsiswa);

        if (!$siswa) {
            return response()->json(['success' => false, 'message' => 'Data siswa tidak ditemukan'], 404);
        }

        // Opsional: kita bisa format riwayat kelas agar lebih rapi untuk frontend
        $siswa->riwayat_kelas_formatted = $siswa->siswakelas->map(function ($item) {
            return [
                'tahun_ajaran' => $item->kelasDetail->thnajaran->thnajaran ?? 'N/A',
                'nama_kelas' => $item->kelasDetail->kelas->namakelas ?? 'N/A',
                'wali_kelas' => $item->kelasDetail->pegawai->namapegawai ?? 'N/A',
            ];
        });


        return response()->json([
            'success' => true,
            'data' => $siswa
        ]);
    }
}

