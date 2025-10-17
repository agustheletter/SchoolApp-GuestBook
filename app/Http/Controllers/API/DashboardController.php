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
use App\Models\OrtuModel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        // Hitung total data dari tabel yang ADA di Aplikasi Anak
        $totalSiswa = SiswaModel::count();
        $totalOrangtua = OrtuModel::count();
        $totalJabatan = JabatanModel::count();
        $totalPegawai = PegawaiModel::count();
        $totalBukuTamu = BukuTamu::count();

        // Ambil 5 tamu terbaru
        $recentGuests = BukuTamu::select(
                'id',
                'nama',
                'keperluan',
                DB::raw('DATE_FORMAT(created_at, "%d %b %Y") as tanggal') // Format tanggal
            )
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'stats' => [
                'totalSiswa' => $totalSiswa,
                'totalOrangtua' => $totalOrangtua,
                'totalJabatan' => $totalJabatan,
                'totalPegawai' => $totalPegawai,
                'totalBukuTamu' => $totalBukuTamu,
                // Hapus count untuk tabel yang tidak ada (orangtua, jabatan, dll)
                // Nanti kita akan tambahkan lagi setelah tabelnya disinkronkan.
            ],
            'recentGuests' => $recentGuests,
        ]);
    }
}
