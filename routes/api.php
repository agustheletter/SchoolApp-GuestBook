<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SiswaController;
use App\Http\Controllers\API\OrangtuaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route untuk resource Siswa
Route::get('/siswa', [SiswaController::class, 'index']);
Route::get('/siswa/{id}', [SiswaController::class, 'show']);
Route::post('/siswa', [SiswaController::class, 'store']);

// NOTE: Untuk update, kita pakai POST karena form-data (untuk upload file) tidak sepenuhnya support method PUT/PATCH
Route::post('/siswa/{id}', [SiswaController::class, 'update']);
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);

// Route untuk resource Orang Tua
Route::get('/orangtua', [OrangtuaController::class, 'index']);
Route::get('/orangtua/{id}', [OrangtuaController::class, 'show']);
Route::post('/orangtua', [OrangtuaController::class, 'store']);
Route::put('/orangtua/{id}', [OrangtuaController::class, 'update']); // Menggunakan PUT untuk update
Route::delete('/orangtua/{id}', [OrangtuaController::class, 'destroy']);
