<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// panggil model SPP
use App\Models\BayarModel;

// panggil model Tahun Ajaran
use App\Models\TahunAjaranModel;

// panggil model Siswa
use App\Models\SiswaModel;

// panggil model Siswa
use App\Models\SiswaKelasModel;

// panggil model Siswa
use App\Models\BayarDetailModel;
use App\Models\BulanModel;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Session;

class SppController extends Controller
{
    use ValidatesRequests;
    //====================AWAL METHODE UNTUK TAMPIL PEMBAYARAN SPP=================
    //tampil dengan eloquent
    public function spp()
    {
        //ambil data siswa
        // SELECT
        // *
        // FROM tbl_siswa
        // INNER JOIN tbl_siswakelas ON tbl_siswakelas.idsiswa=tbl_siswa.idsiswa
        // WHERE tbl_siswakelas.idthnajaran='1';

        $datasiswa=SiswaModel::join('tbl_siswakelas', 'tbl_siswakelas.idsiswa','=','tbl_siswa.idsiswa')
        ->where('tbl_siswakelas.idthnajaran',Session::get('idthnajaran'))
        ->get();

        // mengirim data siswa ke view spp
        return view('admin.pages.spp.v_spp',['siswa'=>$datasiswa]);
    }
    //===================AKHIR METHODE UNTUK TAMPIL PEMBAYARAN SPP================



    public function sppcari(Request $request)
    {
        $katakunci = $request->sppcari;

        //ambil data siswa
        // $datasiswa=SiswaModel::all();
        $datasiswa=SiswaModel::join('tbl_siswakelas', 'tbl_siswakelas.idsiswa','=','tbl_siswa.idsiswa')
        ->where('tbl_siswakelas.idthnajaran',Session::get('idthnajaran'))
        ->get();

        // SELECT
        // *FROM tbl_siswa
        // INNER JOIN tbl_siswakelas ON tbl_siswakelas.idsiswa=tbl_siswa.idsiswa
        // INNER JOIN tbl_kelas ON tbl_kelas.idkelas=tbl_siswakelas.idkelas
        // INNER JOIN tbl_tingkat ON tbl_tingkat.idtingkat=tbl_kelas.idtingkat
        // INNER JOIN tbl_thnajaran ON tbl_thnajaran.idthnajaran=tbl_siswakelas.idthnajaran
        // INNER JOIN tbl_jenisbayardetail ON tbl_jenisbayardetail.idtingkat=tbl_tingkat.idtingkat

        // WHERE tbl_siswa.nis='001'
        // AND tbl_jenisbayardetail.idjenisbayar='SPP'
        // AND tbl_siswakelas.idthnajaran='3';


        $headerbayarspp = SiswaModel::
        join('tbl_siswakelas','tbl_siswakelas.idsiswa','=','tbl_siswa.idsiswa')
        ->join('tbl_kelas','tbl_kelas.idkelas','=','tbl_siswakelas.idkelas')
        ->join('tbl_tingkat','tbl_tingkat.idtingkat','=','tbl_kelas.idtingkat')
        ->join('tbl_thnajaran','tbl_thnajaran.idthnajaran','=','tbl_siswakelas.idthnajaran')
        ->join('tbl_jenisbayardetail','tbl_jenisbayardetail.idtingkat','=','tbl_tingkat.idtingkat')


        ->where('tbl_siswa.nis', $katakunci)
        ->where('tbl_jenisbayardetail.idjenisbayar','SPP')

        //tahun ajaran ganti dengan variable thn ajaran
        ->where('tbl_siswakelas.idthnajaran',Session::get('idthnajaran'))
        ->get();



        //Bayar SPP Detail

        // SELECT
        // *FROM tbl_bayardetail
        // INNER JOIN tbl_bayar ON tbl_bayar.idbayar=tbl_bayardetail.idbayar
        // INNER JOIN tbl_siswa ON tbl_siswa.idsiswa=tbl_bayar.idsiswa
        // INNER JOIN users ON users.id=tbl_bayar.iduser
        // INNER JOIN tbl_bulan ON tbl_bulan.idbulan=tbl_bayardetail.idbulan
        // WHERE tbl_siswa.nis='001'
        // AND tbl_bayar.idthnajaran='3'
        // AND tbl_bayardetail.idperiode='1'
        // ORDER BY tbl_bulan.idbulan ASC;

        $bayarspp = BayarDetailModel::
        join('tbl_bayar','tbl_bayar.idbayar','=','tbl_bayardetail.idbayar')
        ->join('tbl_siswa','tbl_siswa.idsiswa','=','tbl_bayar.idsiswa')
        ->join('users','users.id','=','tbl_bayar.iduser')
        ->join('tbl_bulan','tbl_bulan.idbulan','=','tbl_bayardetail.idbulan')

        ->where('tbl_siswa.nis', $katakunci)
        ->where('tbl_bayar.idthnajaran',Session::get('idthnajaran'))
        ->where('tbl_bayardetail.idperiode','1')
        ->orderby('tbl_bulan.idbulan', 'ASC')

        ->get();


        //dd($bayardsp);

        // mengirim data siswa ke view sppcari
        return view('admin.pages.spp.v_sppcari', ['headerspp'=>$headerbayarspp,'spp' => $bayarspp, 'siswa'=>$datasiswa]);
    }


    //====================AWAL METHODE UNTUK TAMBAH Pembayaran SPP=================
    //method tambah data pembayaran SPP dengan eloquent
    public function spptambah(Request $request)
    {
        $idbayarmax = BayarModel::max('idbayar');
        $idbayarmax++;

        $jmlbulan = $request->jumlahbulan;
        $idbulanterakhir = $request->idbulanterakhir;

        // dd($idbulanmax);
        // dd($request->all());

        $this->validate($request, [
            //ke tbl_bayar
            // 'idbayar' => 'required',
            'idsiswa' => 'required',
            'iduser' => 'required',
            'idthnajaran' => 'required',

            //ke tbl_bayardetail
            'nominalbayar' => 'required|numeric'
        ]);


        //insert ke table tbl_bayar
        BayarModel::create([
            'idbayar' =>$idbayarmax,
            'idsiswa' => $request->idsiswa,
            'iduser' => $request->iduser,
            'idthnajaran' => $request->idthnajaran
        ]);


        //insert ke table tbl_bayardetail
        for ($i=0; $i<$jmlbulan; $i++)
        {
            $idbulanterakhir++;

            BayarDetailModel::create([
                'idbayar' => $idbayarmax,
                'idperiode' => 1, //1 untuk SPP
                'idbulan' => $idbulanterakhir, //id bulan harus di looping

                //nominalbayar ambil dari nominaljenisbayar per tahunajaran & tingkat
                //diambil dari input hidden
                'nominalbayar' => $request->nominaljenisbayar
            ]);
        }

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK TAMBAH Pembayaran DSP=================

}
