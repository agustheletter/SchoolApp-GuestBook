<?php

namespace App\Http\Controllers;

use App\Models\AgamaModel;
use App\Models\SiswaModel;

// panggil model siswa
use Illuminate\Http\Request;

// panggil model Agama
use App\Models\SiswaKelasModel;
use App\Models\TahunAjaranModel;
// panggil model Tahun AJarab
use Illuminate\Support\Facades\DB;

//panggil Class File
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
    //====================AWAL METHODE UNTUK TAMPIL siswa=================
    //tampil dengan eloquent
    public function siswa()
    {
        // mengambil data siswa
        // $siswa = SiswaModel::orderby('idsiswa', 'ASC')
        // ->paginate();
        $siswa = SiswaModel::all();

        $agama = AgamaModel::all();
        $thnajaran = TahunAjaranModel::all();

        // mengirim data siswa ke view siswa
        //dd($siswa);
        return view('admin.pages.siswa.v_siswa', ['siswa' => $siswa, 'agama' => $agama, 'thnajaran' => $thnajaran]);
    }
    //===================AKHIR METHODE UNTUK TAMPIL siswa================



    //====================AWAL METHODE UNTUK TAMBAH siswa=================
    //method tambah data siswa dengan eloquent
    public function siswatambah(Request $request)
    {
        // dd($request->all());

        $request->validate([
            //'idsiswa' => 'required',
            'nis' => 'required',
            'nisn' => 'required',
            'namasiswa' => 'required',
            'tempatlahir' => 'required',
            'tgllahir' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'idagama' => 'required',
            'tlprumah' => 'required',
            'hpsiswa' => 'required',
            //'photosiswa' => 'required',
            'idthnajaran' => 'required'
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $filephoto = $request->file('photo');
        $namafile = null; // Set default null kalau tidak ada file

        if ($filephoto) {
            $namafile = time() . "_" . $filephoto->getClientOriginalName();
            $tujuanupload = 'PhotoSiswa';
            $filephoto->move($tujuanupload, $namafile);
        }

        //siswaModel::create([
        SiswaModel::create([
            //'idsiswa' => $request->idsiswa,
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'namasiswa' => $request->namasiswa,
            'tempatlahir' => $request->tempatlahir,
            'tgllahir' => $request->tgllahir,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'idagama' => $request->idagama,
            'tlprumah' => $request->tlprumah,
            'hpsiswa' => $request->hpsiswa,
            'photosiswa' => $namafile,
            'idthnmasuk' => $request->idthnajaran
        ]);

        //kembali ke halaman awal
        return redirect('/siswa');
    }

    //====================AKHIR METHODE UNTUK TAMBAH siswa=================


    //====================AWAL METHODE UNTUK HAPUS siswa=================
    public function siswahapus($idsiswa)
    {
        $siswa = SiswaModel::find($idsiswa);
        File::delete('PhotoSiswa/'.$siswa->photo);
        $siswa->delete();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK HAPUS siswa=================



    //====================AWAL METHODE UNTUK EDIT siswa=================
    public function siswaedit(Request $request, $idsiswa)
    {
        $request->validate([
            //'idsiswa' => 'required',
            'nis' => 'required',
            'nisn' => 'required',
            'namasiswa' => 'required',
            'tempatlahir' => 'required',
            'tgllahir' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'idagama' => 'required',
            'tlprumah' => 'required',
            'hpsiswa' => 'required',
            'photosiswa' => 'required',
            'idthnmasuk' => 'required'
        ]);


        $filephoto = $request->file('photosiswa');
        if($filephoto){
            // menyimpan data file yang diupload ke variabel $file

            $namafile = time() . "_" . $filephoto->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuanupload = 'PhotoSiswa';
            $filephoto->move($tujuanupload, $namafile);
        }

        $siswa = siswaModel::findOrFail($idsiswa);
        
        File::delete('PhotoSiswa/'.$siswa->photosiswa);

        $siswa->update([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'namasiswa' => $request->namasiswa,
            'tempatlahir' => $request->tempatlahir,
            'tgllahir' => $request->tgllahir,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'idagama' => $request->idagama,
            'tlprumah' => $request->tlprumah,
            'hpsiswa' => $request->hpsiswa,
            'photosiswa' => $namafile,
            'idthnmasuk' => $request->idthnmasuk,
        ]);

        // $siswa->photosiswa = $namafile;

        // $siswa->save();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK EDIT siswa=================


    //====================AWAL METHODE UNTUK DETAIL SISWA=================
    public function siswadetail(Request $request)
    {
        $katakunci = $request->siswacari;
        $siswa = SiswaModel::where('namasiswa', 'like', "%" . $katakunci . "%")
            ->paginate();

        // $agama = AgamaModel::all();
        // $thnajaran = TahunAjaranModel::all();

        return view('admin.pages.siswa.v_siswadetail', ['siswa' => $siswa]);
    }
    //====================AKHIR METHODE UNTUK DETAIL SISWA=================


    //====================AWAL METHODE UNTUK CARI KELAS SISWA CARI=================
    public function siswadetailcari(Request $request)
    // public function siswadetailcari($idsiswa)
    {
        //katakunci untuk tombol cari kelas siswa
        $katakunci = $request->carisiswa;

        //ambil idtahun ajaran aktif
        $idthnajaran = Session::get('idthnajaran');

        //ambil data siswa kelas berdasarkan tahun ajaran aktif
        $siswakelas = SiswaKelasModel::
        join('tbl_kelasdetail','tbl_kelasdetail.idkelasdetail','=','tbl_siswakelas.idkelasdetail')
        ->where('tbl_kelasdetail.idthnajaran',$idthnajaran)->get();

        // dd($siswakelas);

        //ambil data detail siswa berdasarkan id siswa
        $siswa = SiswaModel::where('tbl_siswa.idsiswa',$katakunci)->get();


        //ambil data kelas siswa berdasarkan setiap tahun ajaran
        $kelassiswa=SiswaKelasModel::
        join('tbl_siswa','tbl_siswa.idsiswa','=','tbl_siswakelas.idsiswa')
        ->where('tbl_siswa.nis',$katakunci)
        // ->orderby('tbl_siswakelas.idthnajaran', 'ASC')
        ->get();


        // mengirim data siswa kelas ke view siswa kelas
        return view('admin.pages.siswa.v_siswadetailcari',
            [
                // 'siswakelas' => $siswakelas,
                'siswa' => $siswa,
                'siswakelas' => $siswakelas,
                'katakunci'=>$katakunci,
                'kelassiswa'=>$kelassiswa,
            ]);
    }
    //====================AKHIR METHODE UNTUK CARI KELAS SISWA CARI=================


}
