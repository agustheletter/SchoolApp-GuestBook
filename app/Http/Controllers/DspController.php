<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// panggil model DSP
use App\Models\DspModel;

// panggil model Tahun Ajaran
use App\Models\TahunAjaranModel;

// panggil model Siswa
use App\Models\SiswaModel;

// panggil model Siswa
use App\Models\SiswaKelasModel;

// panggil model
use App\Models\BayarModel;
use App\Models\BayarDetailModel;
use App\Models\BulanModel;
use App\Models\JenisBayarDetailModel;
use App\Models\JenisBayarModel;

use Illuminate\Support\Facades\Session;

class DspController extends Controller
{
    //====================AWAL METHODE UNTUK TAMPIL PEMBAYARAN DSP=================
    public function dsp()
    {
        //ambil data siswa
        // SELECT
        // *
        // FROM tbl_siswa
        // INNER JOIN tbl_siswakelas ON tbl_siswakelas.idsiswa=tbl_siswa.idsiswa
        // WHERE tbl_siswakelas.idthnajaran='1';

        // $datasiswa=SiswaModel::all();
        $datasiswa=SiswaModel::join('tbl_siswakelas', 'tbl_siswakelas.idsiswa','=','tbl_siswa.idsiswa')
        ->where('tbl_siswakelas.idthnajaran',Session::get('idthnajaran'))
        ->get();

        // mengirim data siswa ke view dsp
        return view('admin.pages.v_dsp',['siswa'=>$datasiswa]);
    }
    //===================AKHIR METHODE UNTUK TAMPIL PEMBAYARAN DSP================


    public function dspcari(Request $request)
    {
        // SELECT *
        // FROM tbl_bayardetail
        // INNER JOIN tbl_bayar ON tbl_bayar.idbayar=tbl_bayardetail.idbayar
        // INNER JOIN tbl_siswa ON tbl_siswa.idsiswa=tbl_bayar.idsiswa
        // INNER JOIN users ON users.id=tbl_bayar.iduser
        // INNER JOIN tbl_periode ON tbl_periode.idperiode=tbl_bayardetail.idperiode
        // INNER JOIN tbl_jenisbayar ON tbl_jenisbayar.idperiode=tbl_periode.idperiode
        // INNER JOIN tbl_jenisbayardetail ON tbl_jenisbayardetail.idjenisbayar=tbl_jenisbayar.idjenisbayar
        // INNER JOIN tbl_thnajaran ON tbl_thnajaran.idthnajaran=tbl_siswa.idthnmasuk
        // WHERE
        // tbl_siswa.nis='001'
        // AND tbl_siswa.idthnmasuk=tbl_jenisbayardetail.idthnajaran
        // AND tbl_bayardetail.idperiode='2';


        $katakunci = $request->dspcari;

        //ambil data siswa
        // $datasiswa=SiswaModel::all();
        $datasiswa=SiswaModel::join('tbl_siswakelas', 'tbl_siswakelas.idsiswa','=','tbl_siswa.idsiswa')
        ->where('tbl_siswakelas.idthnajaran',Session::get('idthnajaran'))
        ->get();

        //Header bayar DSP
        // SELECT
        // *FROM tbl_siswa
        // INNER JOIN tbl_siswakelas ON tbl_siswakelas.idsiswa=tbl_siswa.idsiswa
        // INNER JOIN tbl_kelas ON tbl_kelas.idkelas=tbl_siswakelas.idkelas
        // INNER JOIN tbl_tingkat ON tbl_tingkat.idtingkat=tbl_kelas.idtingkat
        // INNER JOIN tbl_jenisbayardetail ON tbl_jenisbayardetail.idthnajaran=tbl_siswa.idthnmasuk
        // INNER JOIN tbl_thnajaran ON tbl_thnajaran.idthnajaran=tbl_siswa.idthnmasuk
        // WHERE tbl_siswa.nis='001'
        // AND tbl_jenisbayardetail.idjenisbayar='DSP'
        // AND tbl_siswakelas.idthnajaran='3';

        $headerbayardsp = SiswaModel::

        join('tbl_siswakelas','tbl_siswakelas.idsiswa','=','tbl_siswa.idsiswa')
        ->join('tbl_kelas','tbl_kelas.idkelas','=','tbl_siswakelas.idkelas')
        ->join('tbl_tingkat','tbl_tingkat.idtingkat','=','tbl_kelas.idtingkat')
        ->join('tbl_jenisbayardetail','tbl_jenisbayardetail.idthnajaran','=','tbl_siswa.idthnmasuk')
        ->join('tbl_thnajaran','tbl_thnajaran.idthnajaran','=','tbl_siswa.idthnmasuk')

        ->where('tbl_siswa.nis', $katakunci)
        ->where('tbl_jenisbayardetail.idjenisbayar','DSP')

        //Tahun AJARAN HARUS DIGANTI DENGAN VARIABLE TAHUN AJARAN AKTIF
        ->where('tbl_siswakelas.idthnajaran',Session::get('idthnajaran'))
        ->get();


        //Bayar DSP Detail
        // SELECT
        // *FROM
        // tbl_bayardetail
        // INNER JOIN tbl_bayar ON tbl_bayar.idbayar=tbl_bayardetail.idbayar
        // INNER JOIN tbl_siswa ON tbl_siswa.idsiswa=tbl_bayar.idsiswa
        // INNER JOIN users ON users.id=tbl_bayar.iduser
        // WHERE tbl_siswa.nis='001'
        // AND tbl_bayardetail.idperiode='2'
        // ORDER BY tbl_bayardetail.idbayardetail;

        $bayardsp = BayarDetailModel::
        join('tbl_bayar','tbl_bayar.idbayar','=','tbl_bayardetail.idbayar')
        ->join('tbl_siswa','tbl_siswa.idsiswa','=','tbl_bayar.idsiswa')
        ->join('users','users.id','=','tbl_bayar.iduser')

        ->where('tbl_siswa.nis', $katakunci)
        ->where('tbl_bayardetail.idperiode','2')
        ->orderby('tbl_bayar.created_at', 'ASC')

        ->get();

        //dd($bayardsp);
        return view('admin.pages.v_dspcari', ['headerdsp'=>$headerbayardsp,'dsp' => $bayardsp, 'siswa'=>$datasiswa]);
    }


    //====================AWAL METHODE UNTUK TAMBAH Pembayaran DSP=================
    //method tambah data pembayaran DSP dengan eloquent
    public function dsptambah(Request $request)
    {
        $idbayarmax = BayarModel::max('idbayar');
        $idbayarmax++;

        // dd($idbayarmax);
        // dd($request->all());

        $this->validate($request, [
            //ke tbl_bayar
            // 'idbayar' => 'required',
            'idsiswa' => 'required',
            'iduser' => 'required',
            'idthnajaran' => 'required',

            //ke tbl_bayardetail
            // 'idperiode' => 'required',
            // 'idbulan' => 'required',
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
        BayarDetailModel::create([
            'idbayar' => $idbayarmax,
            'idperiode' => 2,
            'idbulan' => 0,
            'nominalbayar' => $request->nominalbayar,
        ]);

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK TAMBAH Pembayaran DSP=================

}
