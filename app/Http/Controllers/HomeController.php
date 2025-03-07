<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// panggil model jurusan
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\TahunAjaranModel;
use App\Models\SiswaKelasModel;
use App\Models\BayarModel;
use App\Models\BayarDetailModel;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        //ambil idtahun ajaran
        $idthnajaran = Session::get('idthnajaran');
        // dd($idthnajaran);

        //ambil seluruh data tahun ajaran
        $tahunajaran = TahunAjaranModel::select("*")
        ->where('tbl_thnajaran.idthnajaran',Session::get('idthnajaran'))
        ->get();
        // dd($tahunajaran);

        //hitung jumlah jurusan
        $datajurusan    = JurusanModel::count('namajurusan');

        //hitung jumlah kelas berdasarkan tahun ajaran
        $datakelas      = KelasModel::count('namakelas');
        // $datakelas      = KelasModel::select("*")
        // ->join('tbl_siswakelas','tbl_siswakelas.idkelas','=','tbl_kelas.idkelas')
        // ->where('tbl_siswakelas.idthnajaran',Session::get('idthnajaran'))
        // ->count();

        ////hitung jumlah transaksi berdasarkan tahun ajaran
        $databayar      = BayarDetailModel::select("*")
        ->join('tbl_bayar','tbl_bayar.idbayar','=','tbl_bayardetail.idbayar')
        ->where('tbl_bayar.idthnajaran',Session::get('idthnajaran'))
        ->count();

        //MENGHITUNG JUMLAH SISWA PADA TAHUN AJARAN AKTIF
        //  select count(*) as aggregate from `tbl_siswakelas`
        // inner join `tbl_kelasdetail` on `tbl_kelasdetail`.`idkelasdetail` = `tbl_siswakelas`.`idkelasdetail`
        // where `tbl_kelasdetail`.`idthnajaran` = 2

        $datasiswa      = SiswaKelasModel::select("*")
        ->join('tbl_kelasdetail','tbl_kelasdetail.idkelasdetail','=','tbl_siswakelas.idkelasdetail')

        //id tahun ajaran harus diganti dengan varibale supaya bisa dinamis
        ->where('tbl_kelasdetail.idthnajaran',$idthnajaran)
        ->count();


        // dd($datajurusan);

        return view('admin/pages/v_home',
            [
                'jurusan'=>$datajurusan,
                'kelas'=>$datakelas,
                'bayar'=>$databayar,
                'siswa'=>$datasiswa,
                'tahunajaran'=>$tahunajaran
            ]);
    }

    //====================AWAL METHODE UNTUK TAMPIL TENTANG=================
    public function about()
    {
        // mengirim data guru ke view guru
        return view('admin.pages.v_about');
    }
    //===================AKHIR METHODE UNTUK TAMPIL TENTANG================
}
