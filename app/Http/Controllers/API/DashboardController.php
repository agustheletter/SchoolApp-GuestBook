<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\TahunAjaranModel;
use App\Models\SiswaKelasModel;
use App\Models\BayarDetailModel;
use App\Models\BukuTamu;
use App\Models\PegawaiModel;
use App\Models\SiswaModel;
use App\Models\Orangtua;
use App\Models\JabatanModel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil id tahun ajaran aktif (kalau ada di session, atau pakai default)
        $idthnajaran = Session::get('idthnajaran') ?? 1;

        // Ambil data tahun ajaran aktif
        $tahunajaran = TahunAjaranModel::where('tbl_thnajaran.idthnajaran', $idthnajaran)->first();

        // Hitung total data
        $datajurusan = JurusanModel::count('namajurusan');
        $datakelas = KelasModel::count('namakelas');
        $databayar = BayarDetailModel::join('tbl_bayar', 'tbl_bayar.idbayar', '=', 'tbl_bayardetail.idbayar')
            ->where('tbl_bayar.idthnajaran', $idthnajaran)
            ->count();

        $datasiswa = SiswaKelasModel::join('tbl_kelasdetail', 'tbl_kelasdetail.idkelasdetail', '=', 'tbl_siswakelas.idkelasdetail')
            ->where('tbl_kelasdetail.idthnajaran', $idthnajaran)
            ->count();

        // Data tambahan dari AppServiceProvider biar sinkron
        $totalPegawai = PegawaiModel::count();
        $totalBukuTamu = BukuTamu::count();
        $totalSiswa = SiswaModel::count();
        $totalOrangtua = Orangtua::count();
        $totalJabatan = JabatanModel::count();

        // Ambil 5 tamu terbaru
        $recentGuests = BukuTamu::select('id', 'nama', 'keperluan', DB::raw('DATE_FORMAT(CREATED_AT, "%d %b") as tanggal'))
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'tahun_ajaran' => $tahunajaran,
            'stats' => [
                'jurusan' => $datajurusan,
                'kelas' => $datakelas,
                'bayar' => $databayar,
                'siswa' => $datasiswa,
                'totalPegawai' => $totalPegawai,
                'totalBukuTamu' => $totalBukuTamu,
                'totalSiswa' => $totalSiswa,
                'totalOrangtua' => $totalOrangtua,
                'totalJabatan' => $totalJabatan,
            ],
            'recentGuests' => $recentGuests,
        ]);
    }
}
