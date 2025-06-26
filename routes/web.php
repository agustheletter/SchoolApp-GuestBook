<?php

use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\DspController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisBayarDetailController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasDetailController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MutasiKelasController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProgramKeahlianController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaKelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\TahunAjaranController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Event\TestRunner\WarningTriggered;

Route::get('/', function () {
    return view('users.landing');
})->name('landing');

// 404 Route
Route::fallback(function () {
    return redirect()->route('home');
});

//=========================AWAL ROUTE BUKU TAMU USER =========================
Route::get('/guestbook',[BukuTamuController::class,'inputUser'])->name('bukutamu.user');

Route::post('/guestbook/store',[BukuTamuController::class,'storeUser'])->name('guestbook.store');
//========================AKHIR ROUTE BUKU TAMU USER ========================


//=========================AWAL ROUTE LOGIN=========================
Route::get('/login', [LoginController::class,'login'])->name('login');
Route::post('loginaksi', [LoginController::class,'loginaksi'])->name('loginaksi');
Route::get('logoutaksi', [LoginController::class,'logoutaksi'])->name('logoutaksi')->middleware('auth');
//=========================AKHIR ROUTE LOGIN=========================


//=========================AWAL ROUTE HOME=========================
Route::get('/home', [HomeController::class,'home'])->name('home')->middleware('auth');
Route::get('/about', [HomeController::class,'about'])->middleware('auth');
//=========================AKHIR ROUTE HOME=========================


//=========================AWAL ROUTE PROGRAM KEAHLIAN=========================
// Route::get('/programkeahlian', [ProgramKeahlianController::class,'programkeahlian'])->middleware('auth');
// Route::post('/programkeahlian/tambah',[ProgramKeahlianController::class,'programkeahliantambah'])->middleware('auth');
// Route::get('/programkeahlian/hapus/{idprogramkeahlian}',[ProgramKeahlianController::class,'programkeahlianhapus'])->middleware('auth');
// Route::put('/programkeahlian/edit/{idprogramkeahlian}', [ProgramKeahlianController::class,'programkeahlianedit'])->middleware('auth');
//========================AKHIR ROUTE PROGRAM KEAHLIAN========================




//=========================AWAL ROUTE JURUSAN=========================
// Route::get('/jurusan', [JurusanController::class,'jurusan'])->middleware('auth');
// Route::post('/jurusan/tambah',[JurusanController::class,'jurusantambah'])->middleware('auth');
// Route::get('/jurusan/hapus/{idjurusan}',[JurusanController::class,'jurusanhapus'])->middleware('auth');
// Route::put('/jurusan/edit/{idjurusan}', [JurusanController::class,'jurusanedit'])->middleware('auth');
//========================AKHIR ROUTE JURUSAN========================



//=========================AWAL ROUTE KELAS=========================
// Route::get('/kelas', [KelasController::class,'kelas'])->middleware('auth');
// Route::post('/kelas/tambah',[KelasController::class,'kelastambah'])->middleware('auth');
// Route::get('/kelas/hapus/{idkelas}',[KelasController::class,'kelashapus'])->middleware('auth');
// Route::put('/kelas/edit/{idkelas}', [KelasController::class,'kelasedit'])->middleware('auth');
//========================AKHIR ROUTE KELAS========================


//=========================AWAL ROUTE TAHUN AJARAN=========================
// Route::get('/thnajaran', [TahunAjaranController::class,'thnajaran'])->middleware('auth');
// Route::post('/thnajaran/tambah',[TahunAjaranController::class,'thnajarantambah'])->middleware('auth');
// Route::get('/thnajaran/hapus/{idthnajaran}',[TahunAjaranController::class,'thnajaranhapus'])->middleware('auth');
// Route::put('/thnajaran/edit/{idthnajaran}', [TahunAjaranController::class,'thnajaranedit'])->middleware('auth');
//========================AKHIR ROUTE TAHUN AJARAN========================



//=========================AWAL ROUTE SISWA=========================
    //AWAL CRUD SISWA
    Route::get('/siswa', [SiswaController::class,'siswa'])->middleware('auth');
    Route::post('/siswa/tambah',[SiswaController::class,'siswatambah'])->middleware('auth');
    Route::get('/siswa/hapus/{nis}',[SiswaController::class,'siswahapus'])->middleware('auth');
    Route::put('/siswa/edit/{id}', [SiswaController::class,'siswaedit'])->middleware('auth');
    //AWAL CRUD SISWA

    //AWAL CARI SISWA
    // Route::get('/siswadetail', [SiswaController::class,'siswadetail'])->middleware('auth');
    // Route::get('/siswadetail/cari', [SiswaController::class,'siswadetailcari'])->middleware('auth');
    //AKHIR CARI SISWA

//========================AKHIR ROUTE SISWA========================


//=========================AWAL ROUTE ORANG TUA=========================
    //AWAL CRUD SISWA
    Route::get('/orangtua', [SiswaController::class,'siswa'])->middleware('auth');
    Route::post('/orangtua/tambah',[SiswaController::class,'siswatambah'])->middleware('auth');
    Route::get('/orangtua/hapus/{id}',[SiswaController::class,'siswahapus'])->middleware('auth');
    Route::put('/orangtua/edit/{id}', [SiswaController::class,'siswaedit'])->middleware('auth');
    //AWAL CRUD SISWA

    Route::get('/bukutamu',[BukuTamuController::class,'index'])->middleware('auth')->name('bukutamu');
    Route::get('/bukutamu/{id}/edit', [BukuTamuController::class, 'edit'])->middleware('auth')->name('bukutamu.edit');
    Route::put('/bukutamu/{id}', [BukuTamuController::class, 'update'])->middleware('auth')->name('bukutamu.update');

    Route::post('/bukutamu/store',[BukuTamuController::class,'store'])->middleware('auth')->name('bukutamu.store');
    Route::delete('/bukutamu/{id}',[BukuTamuController::class,'destroy'])->middleware('auth')->name('bukutamu.destroy');

//========================AKHIR ROUTE ORANG TUA========================



//=========================AWAL ROUTE PEGAWAI =========================
Route::get('/pegawai',[PegawaiController::class,'index'])->middleware('auth')->name('pegawai');
Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->middleware('auth')->name('pegawai.edit');
Route::get('/pegawai/input',[PegawaiController::class,'input'])->middleware('auth')->name('pegawai.input');

Route::post('/pegawai/store',[PegawaiController::class,'store'])->middleware('auth')->name('pegawai.store');
Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->middleware('auth')->name('pegawai.update');
Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->middleware('auth')->name('pegawai.destroy');
//========================AKHIR ROUTE PEGAWAI ========================



//=========================AWAL ROUTE JABATAN =========================
Route::get('/jabatan',[JabatanController::class,'index'])->middleware('auth')->name('jabatan');

Route::post('/jabatan/store',[JabatanController::class,'store'])->middleware('auth')->name('jabatan.store');
Route::put('/jabatan/{id}',[JabatanController::class,'update'])->middleware('auth')->name('jabatan.update');
Route::delete('/jabatan/{id}',[JabatanController::class,'destroy'])->middleware('auth')->name('jabatan.destroy');

//========================AKHIR ROUTE JABATAN ========================



//=========================AWAL ROUTE BUKU TAMU =========================
Route::get('/bukutamu',[BukuTamuController::class,'index'])->middleware('auth')->name('bukutamu');
Route::get('/bukutamu/{id}/edit', [BukuTamuController::class, 'edit'])->middleware('auth')->name('bukutamu.edit');
Route::put('/bukutamu/{id}', [BukuTamuController::class, 'update'])->middleware('auth')->name('bukutamu.update');
Route::delete('/bukutamu/{id}', [BukuTamuController::class, 'destroy'])->middleware('auth')->name('bukutamu.destroy');

Route::get('/bukutamu/input',[BukuTamuController::class,'input'])->middleware('auth')->name('bukutamu.input');
Route::get('/bukutamu/input/orangtua',[BukuTamuController::class,'input_orangtua'])->middleware('auth')->name('bukutamu.orangtua');
Route::get('/bukutamu/input/umum',[BukuTamuController::class,'input_umum'])->middleware('auth')->name('bukutamu.umum');

Route::post('/bukutamu/store',[BukuTamuController::class,'store'])->middleware('auth')->name('bukutamu.store');

//========================AKHIR ROUTE BUKU TAMU ========================



//=========================AWAL ROUTE ORANG TUA =========================
Route::get('/orangtua',[OrangtuaController::class,'index'])->middleware('auth')->name('orangtua');
Route::get('/orangtua/{id}/edit', [OrangtuaController::class, 'edit'])->middleware('auth')->name('orangtua.edit');
Route::put('/orangtua/{id}', [OrangtuaController::class, 'update'])->middleware('auth')->name('orangtua.update');
Route::delete('/orangtua/{id}', [OrangtuaController::class, 'destroy'])->middleware('auth')->name('orangtua.destroy');

Route::get('/orangtua/input',[OrangtuaController::class,'create'])->middleware('auth')->name('orangtua.input');
Route::post('/orangtua/store',[OrangtuaController::class,'store'])->middleware('auth')->name('orangtua.store');

//========================AKHIR ROUTE ORANG TUA ========================



//========================AKHIR ROUTE API REQUEST DATA ========================

Route::get('/getPegawai/{id}', [BukuTamuController::class, 'getPegawai']);
Route::get('/getOrangtua/{idsiswa}', [BukuTamuController::class, 'getOrangtua']);

// Route::get('/admin/grafik', [BukuTamuController::class, 'grafik'])->name('admin.grafik');
Route::get('/admin/grafik-data', [BukuTamuController::class, 'grafikData'])->name('admin.grafik.data');

//========================AKHIR ROUTE API REQUEST DATA ========================


