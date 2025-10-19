<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SiswaController;
use App\Http\Controllers\API\PegawaiController;
use App\Http\Controllers\API\BukuTamuController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\SyncController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TahunAjaranController;

// PUBLIC ROUTES
Route::post('/login', [AuthController::class, 'login']);
Route::get('/tahun-ajaran', [TahunAjaranController::class, 'index']);

// PROTECTED ROUTES - BUTUH AUTH
Route::middleware(['auth:sanctum'])->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

    // Endpoint untuk resource Buku Tamu
    Route::get('/bukutamu', [BukuTamuController::class, 'index']);
    Route::get('/bukutamu/grafik', [BukuTamuController::class, 'getGrafikData']);
    Route::get('/bukutamu/{id}', [BukuTamuController::class, 'show']);
    Route::post('/bukutamu', [BukuTamuController::class, 'store']);
    Route::delete('/bukutamu/{id}', [BukuTamuController::class, 'destroy']);

    // Endpoint untuk Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Endpoint untuk data Siswa
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::get('/siswa/{id}', [SiswaController::class, 'show']);

    // Endpoint untuk data Pegawai
    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::get('/pegawai/{id}', [PegawaiController::class, 'show']);

    // Endpoint untuk sinkronisasi
    Route::post('/sync-manual', [SyncController::class, 'triggerSync']);
});
