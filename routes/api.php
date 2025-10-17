<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SiswaController;
use App\Http\Controllers\API\PegawaiController;
use App\Http\Controllers\API\BukuTamuController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\SyncController; // <--- TAMBAHKAN INI

/* ... route-route lain ... */

// Endpoint untuk data Pegawai
Route::get('/pegawai', [PegawaiController::class, 'index']);
Route::get('/pegawai/{nip}', [PegawaiController::class, 'show']);

// Endpoint untuk data Siswa
Route::get('/siswa', [SiswaController::class, 'index']);
Route::get('/siswa/{nis}', [SiswaController::class, 'show']);

// Endpoint untuk resource Buku Tamu
Route::get('/bukutamu', [BukuTamuController::class, 'index']);
Route::get('/bukutamu/grafik', [BukuTamuController::class, 'getGrafikData']); // Route untuk data grafik
Route::get('/bukutamu/{id}', [BukuTamuController::class, 'show']);
Route::post('/bukutamu', [BukuTamuController::class, 'store']);
Route::delete('/bukutamu/{id}', [BukuTamuController::class, 'destroy']);

// Endpoint untuk Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);


// =========================================================
// === ENDPOINT BARU UNTUK TOMBOL SINKRONISASI DARI REACT ===
// =========================================================
Route::post('/sync-manual', [SyncController::class, 'triggerSync']);

