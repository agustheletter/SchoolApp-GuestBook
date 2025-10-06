<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Ambil semua data siswa dengan relasi ke agama dan tahun ajaran
        // Pastikan di SiswaModel sudah ada relasi 'agama' dan 'tahunAjaranMasuk'
        $siswa = SiswaModel::with(['agama', 'tahunAjaranMasuk'])->orderBy('namasiswa', 'asc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diambil',
            'data' => $siswa
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|unique:tbl_siswa,nis',
            'nisn' => 'required|unique:tbl_siswa,nisn',
            'namasiswa' => 'required|string|max:255',
            'tempatlahir' => 'required|string',
            'tgllahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'alamat' => 'required|string',
            'idagama' => 'required|integer|exists:tbl_agama,idagama',
            'kontak' => 'required|string',
            'photosiswa' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Photo tidak wajib
            'idthnmasuk' => 'required|integer|exists:tbl_thnajaran,idthnajaran',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $photoPath = null;
        if ($request->hasFile('photosiswa')) {
            // Simpan file ke storage/app/public/PhotoSiswa
            // Pastikan sudah menjalankan `php artisan storage:link`
            $photoPath = $request->file('photosiswa')->store('public/PhotoSiswa');
        }

        $siswa = SiswaModel::create([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'namasiswa' => $request->namasiswa,
            'tempatlahir' => $request->tempatlahir,
            'tgllahir' => $request->tgllahir,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'idagama' => $request->idagama,
            'kontak' => $request->kontak,
            'photosiswa' => $photoPath, // simpan path-nya
            'idthnmasuk' => $request->idthnmasuk,
        ]);

        // Load relasi agar response-nya lengkap
        $siswa->load(['agama', 'tahunAjaranMasuk']);

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil ditambahkan',
            'data' => $siswa
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $siswa = SiswaModel::with(['agama', 'tahunAjaranMasuk'])->find($id);

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Siswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data siswa',
            'data' => $siswa
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $siswa = SiswaModel::find($id);
        if (!$siswa) {
            return response()->json(['success' => false, 'message' => 'Siswa tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nis' => 'required|unique:tbl_siswa,nis,' . $id . ',idsiswa',
            'nisn' => 'required|unique:tbl_siswa,nisn,' . $id . ',idsiswa',
            'namasiswa' => 'required|string|max:255',
            'tempatlahir' => 'required|string',
            'tgllahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'alamat' => 'required|string',
            'idagama' => 'required|integer|exists:tbl_agama,idagama',
            'kontak' => 'required|string',
            'photosiswa' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'idthnmasuk' => 'required|integer|exists:tbl_thnajaran,idthnajaran',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        $dataToUpdate = $request->except('photosiswa');

        if ($request->hasFile('photosiswa')) {
            // Hapus photo lama jika ada
            if ($siswa->photosiswa) {
                Storage::delete($siswa->photosiswa);
            }
            // Upload photo baru
            $photoPath = $request->file('photosiswa')->store('public/PhotoSiswa');
            $dataToUpdate['photosiswa'] = $photoPath;
        }

        $siswa->update($dataToUpdate);
        $siswa->load(['agama', 'tahunAjaranMasuk']);

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diperbarui',
            'data' => $siswa
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $siswa = SiswaModel::find($id);

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Siswa tidak ditemukan'
            ], 404);
        }

        // Hapus file photo dari storage
        if ($siswa->photosiswa) {
            Storage::delete($siswa->photosiswa);
        }

        $siswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil dihapus'
        ], 200);
    }
}
