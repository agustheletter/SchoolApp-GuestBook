<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PegawaiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    /**
     * Menampilkan semua data pegawai.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $pegawai = PegawaiModel::with(['jabatan', 'agama'])
            ->orderBy('id_jabatan', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil diambil',
            'data' => $pegawai
        ], 200);
    }

    /**
     * Menyimpan data pegawai baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pegawai' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'id_agama' => 'required|exists:tbl_agama,idagama',
            'id_jabatan' => 'required|exists:tbl_jabatan,idjabatan',
            'kontak' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $pegawai = PegawaiModel::create($request->all());
        // Muat relasi agar langsung ada di response
        $pegawai->load(['jabatan', 'agama']);

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil ditambahkan',
            'data' => $pegawai
        ], 201);
    }

    /**
     * Menampilkan detail satu data pegawai.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $pegawai = PegawaiModel::with(['jabatan', 'agama'])->find($id);

        if (!$pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data pegawai tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data pegawai',
            'data' => $pegawai
        ], 200);
    }

    /**
     * Memperbarui data pegawai.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $pegawai = PegawaiModel::find($id);
        if (!$pegawai) {
            return response()->json(['success' => false, 'message' => 'Data pegawai tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_pegawai' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'id_agama' => 'required|exists:tbl_agama,idagama',
            'id_jabatan' => 'required|exists:tbl_jabatan,idjabatan',
            'kontak' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        $pegawai->update($request->all());
        $pegawai->load(['jabatan', 'agama']);

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil diperbarui',
            'data' => $pegawai
        ], 200);
    }

    /**
     * Menghapus data pegawai.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $pegawai = PegawaiModel::find($id);

        if (!$pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data pegawai tidak ditemukan'
            ], 404);
        }

        $pegawai->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil dihapus'
        ], 200);
    }
}
