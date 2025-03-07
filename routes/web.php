<?php

use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\DspController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisBayarDetailController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasDetailController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MutasiKelasController;
use App\Http\Controllers\ProgramKeahlianController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaKelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\TahunAjaranController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


//=========================AWAL ROUTE LOGIN=========================
Route::get('/', [LoginController::class,'login'])->name('login');
Route::post('loginaksi', [LoginController::class,'loginaksi'])->name('loginaksi');
Route::get('logoutaksi', [LoginController::class,'logoutaksi'])->name('logoutaksi')->middleware('auth');
//=========================AWAL ROUTE LOGIN=========================


//=========================AWAL ROUTE HOME=========================
Route::get('/home', [HomeController::class,'home'])->name('home')->middleware('auth');
Route::get('/about', [HomeController::class,'about'])->middleware('auth');
//=========================AKHIR ROUTE HOME=========================

//=========================AWAL ROUTE PROGRAM KEAHLIAN=========================
Route::get('/programkeahlian', [ProgramKeahlianController::class,'programkeahlian'])->middleware('auth');
Route::post('/programkeahlian/tambah',[ProgramKeahlianController::class,'programkeahliantambah'])->middleware('auth');
Route::get('/programkeahlian/hapus/{idprogramkeahlian}',[ProgramKeahlianController::class,'programkeahlianhapus'])->middleware('auth');
Route::put('/programkeahlian/edit/{idprogramkeahlian}', [ProgramKeahlianController::class,'programkeahlianedit'])->middleware('auth');
//========================AKHIR ROUTE PROGRAM KEAHLIAN========================




//=========================AWAL ROUTE JURUSAN=========================
Route::get('/jurusan', [JurusanController::class,'jurusan'])->middleware('auth');
Route::post('/jurusan/tambah',[JurusanController::class,'jurusantambah'])->middleware('auth');
Route::get('/jurusan/hapus/{idjurusan}',[JurusanController::class,'jurusanhapus'])->middleware('auth');
Route::put('/jurusan/edit/{idjurusan}', [JurusanController::class,'jurusanedit'])->middleware('auth');
//========================AKHIR ROUTE JURUSAN========================



//=========================AWAL ROUTE KELAS=========================
Route::get('/kelas', [KelasController::class,'kelas'])->middleware('auth');
Route::post('/kelas/tambah',[KelasController::class,'kelastambah'])->middleware('auth');
Route::get('/kelas/hapus/{idkelas}',[KelasController::class,'kelashapus'])->middleware('auth');
Route::put('/kelas/edit/{idkelas}', [KelasController::class,'kelasedit'])->middleware('auth');
//========================AKHIR ROUTE KELAS========================


//=========================AWAL ROUTE RUANGAN=========================
Route::get('/ruangan', [RuanganController::class,'ruangan'])->middleware('auth');
Route::post('/ruangan/tambah',[RuanganController::class,'ruangantambah'])->middleware('auth');
Route::get('/ruangan/hapus/{idruang}',[RuanganController::class,'ruanganhapus'])->middleware('auth');
Route::put('/ruangan/edit/{idruang}', [RuanganController::class,'ruanganedit'])->middleware('auth');
//========================AKHIR ROUTE RUANGAN========================



//=========================AWAL ROUTE KELAS DETAIL=========================
Route::get('/kelasdetail', [KelasDetailController::class,'kelasdetail'])->middleware('auth');
Route::post('/kelasdetail/tambah',[KelasDetailController::class,'kelasdetailtambah'])->middleware('auth');
Route::get('/kelasdetail/hapus/{idkelasdetail}',[KelasDetailController::class,'kelasdetailhapus'])->middleware('auth');
Route::put('/kelasdetail/edit/{idkelasdetail}', [KelasDetailController::class,'kelasdetailedit'])->middleware('auth');
//========================AKHIR ROUTE KELAS DETAIL========================




//=========================AWAL ROUTE TAHUN AJARAN=========================
Route::get('/thnajaran', [TahunAjaranController::class,'thnajaran'])->middleware('auth');
Route::post('/thnajaran/tambah',[TahunAjaranController::class,'thnajarantambah'])->middleware('auth');
Route::get('/thnajaran/hapus/{idthnajaran}',[TahunAjaranController::class,'thnajaranhapus'])->middleware('auth');
Route::put('/thnajaran/edit/{idthnajaran}', [TahunAjaranController::class,'thnajaranedit'])->middleware('auth');
//========================AKHIR ROUTE TAHUN AJARAN========================



//=========================AWAL ROUTE SISWA=========================
    //AWAL CRUD SISWA
    Route::get('/siswa', [SiswaController::class,'siswa'])->middleware('auth');
    Route::post('/siswa/tambah',[SiswaController::class,'siswatambah'])->middleware('auth');
    Route::get('/siswa/hapus/{nis}',[SiswaController::class,'siswahapus'])->middleware('auth');
    Route::put('/siswa/edit/{nis}', [SiswaController::class,'siswaedit'])->middleware('auth');
    //AWAL CRUD SISWA

    //AWAL CARI SISWA
    Route::get('/siswadetail', [SiswaController::class,'siswadetail'])->middleware('auth');
    Route::get('/siswadetail/cari', [SiswaController::class,'siswadetailcari'])->middleware('auth');
    //AKHIR CARI SISWA

//========================AKHIR ROUTE SISWA========================


//========================AWAL ROUTE MUTASI KELAS SISWA========================
Route::get('/mutasikelas',[MutasiKelasController::class,'mutasikelas'])->middleware('auth');
Route::get('/mutasikelas/cari',[MutasiKelasController::class,'mutasikelascari'])->middleware('auth');
Route::post('/mutasikelas/proses',[MutasiKelasController::class,'mutasikelasproses'])->middleware('auth');
//========================AKHIR ROUTE MUTASI KELAS SISWA========================



//=========================AWAL ROUTE SISWA KELAS=========================
Route::get('/siswakelas', [SiswaKelasController::class,'siswakelas'])->middleware('auth');
Route::get('/siswakelas/cari',[SiswaKelasController::class,'siswakelascari'])->middleware('auth');


Route::post('/siswakelas/tambah',[SiswaKelasController::class,'siswakelastambah'])->middleware('auth');
Route::get('/siswakelas/hapus/{idsiswakelas}',[SiswaKelasController::class,'siswakelashapus'])->middleware('auth');
Route::put('/siswakelas/edit/{idsiswakelas}', [SiswaKelasController::class,'siswakelasedit'])->middleware('auth');

// Route::get('/siswakelas', function ()
// {
//         $kelas = Carbon::parse(request()->kelas);
//         $data = App\Models\KelasModel::where('kelas',[$kelas])->get();

//     return view('siswakelas', compact('data'))
// })->middleware('auth');

//========================AKHIR ROUTE SISWA KELAS========================


//=========================AWAL ROUTE BAYAR SPP=========================
Route::get('/spp', [SppController::class,'spp'])->middleware('auth');
Route::get('/spp/cari',[SppController::class,'sppcari'])->middleware('auth');
Route::post('/spp/tambah',[SppController::class,'spptambah'])->middleware('auth');
//========================AKHIR ROUTE BAYAR SPP========================

//=========================AWAL ROUTE BAYAR DSP=========================
Route::get('/dsp',[DspController::class,'dsp'])->middleware('auth');
Route::get('/dsp/cari',[DspController::class,'dspcari'])->middleware('auth');
Route::post('/dsp/tambah',[DspController::class,'dsptambah'])->middleware('auth');
//========================AKHIR ROUTE BAYAR DSP========================



//=========================AWAL ROUTE LAPORAN PEMBAYARAN=========================
Route::get('/laporan',[LaporanController::class.'laporan'])->middleware('auth');
Route::get('/laporan/cari',[LaporanController::class.'laporancari'])->middleware('auth');
Route::get('/laporan/cetakpdf',[LaporanController::class.'laporancetakpdf'])->middleware('auth');
//========================AKHIR ROUTE LAPORAN PEMBAYARAN========================


//=========================AWAL ROUTE JENIS BAYAR DETAIL=========================
Route::get('/jenisbayardetail',[JenisBayarDetailController::class,'tampil'])->middleware('auth');
Route::post('/jenisbayardetail/tambah',[JenisBayarDetailController::class,'tambah'])->middleware('auth');
Route::get('/jenisbayardetail/hapus/{idjenisbayardetail}',[JenisBayarDetailController::class,'hapus'])->middleware('auth');
Route::put('/jenisbayardetail/edit/{idjenisbayardetail}',[JenisBayarDetailController::class,'edit'])->middleware('auth');
//========================AKHIR ROUTE JENIS BAYAR DETAIL========================

//=========================AWAL ROUTE JENIS BUKU TAMU =========================
Route::get('/bukutamu',[BukuTamuController::class,'index'])->middleware('auth')->name('bukutamu');
Route::get('/bukutamu/{id}/edit', [BukuTamuController::class, 'edit'])->middleware('auth')->name('bukutamu.edit');
Route::put('/bukutamu/{id}', [BukuTamuController::class, 'update'])->middleware('auth')->name('bukutamu.update');
Route::delete('/bukutamu/{id}', [BukuTamuController::class, 'destroy'])->middleware('auth')->name('bukutamu.destroy');

Route::get('/bukutamu/input',[BukuTamuController::class,'input'])->middleware('auth')->name('bukutamu.input');
Route::get('/bukutamu/input/orangtua',[BukuTamuController::class,'input_orangtua'])->middleware('auth')->name('bukutamu.orangtua');
Route::get('/bukutamu/input/umum',[BukuTamuController::class,'input_umum'])->middleware('auth')->name('bukutamu.umum');

Route::post('/bukutamu/store',[BukuTamuController::class,'store'])->middleware('auth')->name('bukutamu.store');
Route::delete('/bukutamu/{id}',[BukuTamuController::class,'destroy'])->middleware('auth')->name('bukutamu.destroy');

Route::get('/getPegawai/{id}', [BukuTamuController::class, 'getPegawai']);
//========================AKHIR ROUTE JENIS BUKU TAMU ========================
