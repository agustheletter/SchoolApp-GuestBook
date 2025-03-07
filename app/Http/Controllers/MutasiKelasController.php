<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\KelasModel;
use App\Models\KelasDetailModel;
use App\Models\SiswaKelasModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;
use App\Models\BayarModel;
use App\Models\BayarDetailModel;
use App\Models\JenisBayarDetailModel;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;

class MutasiKelasController extends Controller
{
    //====================AWAL METHODE UNTUK MUTASI KELAS SISWA=================
    //tampil dengan eloquent
    public function mutasikelas()
    {
        // $thnajaran  = TahunAjaranModel::all();
        $thnajaranawal  = TahunAjaranModel::where('tbl_thnajaran.idthnajaran',Session::get('idthnajaran')-1)
        ->get();

        $kelasawal      = KelasDetailModel::where('tbl_kelasdetail.idthnajaran',Session::get('idthnajaran')-1)
        ->get();

        // dd($kelasawal);

        // mengirim data siswa kelas ke view siswa kelas
        return view('admin.pages.mutasikelas.v_mutasikelas',
            [
                'thnajaranawal' => $thnajaranawal,
                'kelasawal' => $kelasawal,
            ]);
    }
    //===================AKHIR METHODE UNTUK MUTASI KELAS SISWA================


    //===================AWAL METHODE UNTUK MUTASI CARI KELAS SISWA ASAL================
    public function mutasikelascari(Request $request)
    {
        //ambil idkelasdetail dari form halaman mutasikelas
        $idkelasdetailawal = $request->carikelas;

        $idthnajaran=Session::get('idthnajaran');

        //menampilkan tahun ajaran sebelumnya
        $thnajaranawal  = TahunAjaranModel::where('tbl_thnajaran.idthnajaran',Session::get('idthnajaran')-1)
        ->get();

        //menampilkan semua data kelas detail awal berdasarkan kelas pada tahun ajaran sebelumnya
        $kelasawal1=KelasDetailModel::
        where('tbl_kelasdetail.idthnajaran',Session::get('idthnajaran')-1)
        ->where('tbl_kelasdetail.idkelasdetail',$idkelasdetailawal)
        ->first();
        // ->get();

        // dd($kelasawal1);

        //menampilkan semua data kelas detail awal berdasarkan kelas pada tahun ajaran sebelumnya
        $kelasawal2=KelasDetailModel::
        where('tbl_kelasdetail.idthnajaran',Session::get('idthnajaran')-1)
        ->get();

        // dd($kelasawal2);

        //AWAL ambil data siswa dari kelas yang dipilih pada tahun ajjaran sebelumnya
            $siswakelasawal = SiswaKelasModel::
            join('tbl_siswa', 'tbl_siswa.idsiswa', '=', 'tbl_siswakelas.idsiswa')
            ->join('tbl_kelasdetail', 'tbl_kelasdetail.idkelasdetail', '=', 'tbl_siswakelas.idkelasdetail')
            ->join('tbl_kelas', 'tbl_kelas.idkelas', '=', 'tbl_kelasdetail.idkelas')
            ->where('tbl_kelasdetail.idthnajaran', Session::get('idthnajaran') - 1)
            ->where('tbl_kelasdetail.idkelasdetail', $idkelasdetailawal)


            // AWAL LEFT JOIN ke tbl_siswakelas tahun ajaran baru
                // untuk menampilkan siswa pada tahun ajaran sebelumnya yang belum mutasi/naik kelas di tahu jaran berlangsung
                ->leftJoin('tbl_siswakelas as sk2', function ($join) use ($idthnajaran) {
                    $join->on('tbl_siswa.idsiswa', '=', 'sk2.idsiswa')
                        ->whereExists(function ($query) use ($idthnajaran) {
                            $query->select(DB::raw(1))
                                ->from('tbl_kelasdetail as kd2')
                                ->whereRaw('kd2.idkelasdetail = sk2.idkelasdetail')
                                ->where('kd2.idthnajaran', '=', $idthnajaran);
                        });
                })

                // Filter hanya siswa yang belum ada di tahun ajaran baru
                ->whereNull('sk2.idsiswa')

                ->select('tbl_siswakelas.*', 'tbl_siswa.*', 'tbl_kelasdetail.*', 'tbl_kelas.*') // Pastikan field dipilih dengan benar
            // AKHIR LEFT JOIN ke tbl_siswakelas tahun ajaran baru

            ->get();
        //AKHIR ambil data siswa dari kelas yang dipilih pada tahun ajjaran sebelumnya

        // dd($siswakelasawal);


        //menampilkan data kelas tujuan berdasarkan kelas yang sudah di tambah berdasarkan tahun ajaran
        $kelastujuan=KelasDetailModel::
        where('tbl_kelasdetail.idthnajaran',Session::get('idthnajaran'))
        ->get();

        // dd($kelastujuan);

        // mengirim data siswa kelas ke view siswa kelas
        return view('admin.pages.mutasikelas.v_mutasikelascari',
            [
                'siswakelasawal' => $siswakelasawal,
                'thnajaranawal' => $thnajaranawal,
                'kelasawal1' => $kelasawal1,
                'kelasawal2' => $kelasawal2,
                'kelastujuan' => $kelastujuan,
                // 'idkelasdetail' => $idkelasdetailawal,
            ]);
    }
    //===================AKHIR METHODE UNTUK MUTASI CARI KELAS SISWA ASAL================



    //===================AWAL METHODE UNTUK MUTASI SIMPAN KELAS SISWA TUJUAN================
    public function mutasikelasproses(Request $request)
    {
        // dd($request->all());

        //ambil idkelasdetail awal pertama dari form halaman mutasi kelas cari
        $idkelasdetailawal1 = $request->carikelasawal;
        // dd($idkelasdetailawal1);

        //ambil data kelas awal pertama berdasarkan tahun ajaran sebelumnya dan berdasarkan idekelasdetail pertama
        $kelasawal1 = KelasDetailModel::
        where('tbl_kelasdetail.idthnajaran',Session::get('idthnajaran')-1)
        ->where('tbl_kelasdetail.idkelasdetail',$idkelasdetailawal1)
        ->first();

        // dd($kelasawal1);

        //Ambil tahun ajaran sebelumnya
        $thnajaranawal  = TahunAjaranModel::where('tbl_thnajaran.idthnajaran',Session::get('idthnajaran')-1)
        ->get();

        //Ambil tahun ajaran BERJALAN
        $idthnajaran = Session::get('idthnajaran');

        //ambil idkelasdetail tujuan yang terpilih sebelumnya
        $idkelasdetailtujuan    = $request->carikelastujuan;

        //ambil kelas tujuan yang terpilih sebelumnya
        $kelastujuan1=KelasDetailModel::
        where('tbl_kelasdetail.idkelasdetail',$idkelasdetailtujuan)
        ->first();


        $pilihchekbox   = $request->input('pilihsiswa');

        // AWAL SIMPAN DATA KE TABLE SISWA KELAS
            //insert ke table tbl_siswakelas dengan model SiswaKelasModel
            // Mendapatkan nilai checkbox yang tercentang
            $siswaTerpilih = $request->input('pilihsiswa');
            // dd($siswaTerpilih);

            // Memproses simpan data siswa terpilih
            foreach ($siswaTerpilih as $index => $s) {
                SiswaKelasModel::create([
                    'idsiswa'       => $siswaTerpilih[$index],
                    'idkelasdetail' => $idkelasdetailtujuan,
                ]);
            }
        // AKHIR SIMPAN DATA KE TABLE SISWA KELAS


        // AWAL KIRIM DATA UNTUK DITAMPILKAN DI VIEW MUTASI KELAS PROSES
        //KELAS AWAL TAHUN AJARAN SEBELUMNYA
        $kelasawal2 = KelasDetailModel::
        where('tbl_kelasdetail.idthnajaran',Session::get('idthnajaran')-1)
        ->get();

        //KELAS TUJUAN TAHUN AJARAN BERLANGSUNG, UNTUK DIGUNAKAN SELECT DI HALAMAN MUTASI PROSES
        $kelastujuan2 = KelasDetailModel::
        where('tbl_kelasdetail.idthnajaran',Session::get('idthnajaran'))
        ->get();

        //AWAL ambil data siswa dari kelas yang dipilih pada tahun ajjaran sebelumnya
            $siswakelasawal = SiswaKelasModel::
            join('tbl_siswa', 'tbl_siswa.idsiswa', '=', 'tbl_siswakelas.idsiswa')
            ->join('tbl_kelasdetail', 'tbl_kelasdetail.idkelasdetail', '=', 'tbl_siswakelas.idkelasdetail')
            ->join('tbl_kelas', 'tbl_kelas.idkelas', '=', 'tbl_kelasdetail.idkelas')
            ->where('tbl_kelasdetail.idthnajaran', Session::get('idthnajaran') - 1)
            ->where('tbl_kelasdetail.idkelasdetail', $idkelasdetailawal1)


            // AWAL LEFT JOIN ke tbl_siswakelas tahun ajaran baru
                // untuk menampilkan siswa pada tahun ajaran sebelumnya yang belum mutasi/naik kelas di tahu jaran berlangsung
                ->leftJoin('tbl_siswakelas as sk2', function ($join) use ($idthnajaran) {
                    $join->on('tbl_siswa.idsiswa', '=', 'sk2.idsiswa')
                        ->whereExists(function ($query) use ($idthnajaran) {
                            $query->select(DB::raw(1))
                                ->from('tbl_kelasdetail as kd2')
                                ->whereRaw('kd2.idkelasdetail = sk2.idkelasdetail')
                                ->where('kd2.idthnajaran', '=', $idthnajaran);
                        });
                })

                // Filter hanya siswa yang belum ada di tahun ajaran baru
                ->whereNull('sk2.idsiswa')

                ->select('tbl_siswakelas.*', 'tbl_siswa.*', 'tbl_kelasdetail.*', 'tbl_kelas.*') // Pastikan field dipilih dengan benar
            // AKHIR LEFT JOIN ke tbl_siswakelas tahun ajaran baru

            ->get();
        //AKHIR ambil data siswa dari kelas yang dipilih pada tahun ajjaran sebelumnya




        // mengambil data siswa pada kelas tujuan berdasarkan thn ajaran
        $siswakelasproses = SiswaKelasModel::
        join('tbl_kelasdetail','tbl_kelasdetail.idkelasdetail','=','tbl_siswakelas.idkelasdetail')
        ->where('tbl_kelasdetail.idthnajaran',Session::get('idthnajaran'))
        ->where('tbl_kelasdetail.idkelasdetail', $idkelasdetailtujuan)
        ->orderBy('tbl_siswakelas.idsiswa')
        ->get();

        // mengirim data siswa kelas ke view siswa kelas
        // dd($siswakelas);
        return view('admin.pages.mutasikelas.v_mutasikelasproses',
            [
                'siswakelasproses' => $siswakelasproses,
                'siswakelasawal' => $siswakelasawal,
                'thnajaranawal'=>$thnajaranawal,
                'kelasawal1' => $kelasawal1,
                'kelasawal2' => $kelasawal2,
                'kelastujuan1'=>$kelastujuan1,
                'kelastujuan2'=>$kelastujuan2,
                // 'katakunci'=>$idkelasdetailtujuan,
            ]);

        // AKHIR KIRIM DATA UNTUK DITAMPILKAN DI VIEW MUTASI KELAS PROSES
    }
    //===================AKHIR METHODE UNTUK MUTASI SIMPA KELAS SISWA TUJUAN================
}
