<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JabatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Menampilkan semua data jabatan.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $jabatan = JabatanModel::all();
        return response()->json([
            'success' => true,
            'message' => 'Data jabatan berhasil diambil',
            'data' => $jabatan
        ], 200);
    }

    /**
     * Menyimpan data jabatan baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required|string|max:255|unique:tbl_jabatan,nama_jabatan',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $jabatan = JabatanModel::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data jabatan berhasil ditambahkan',
            'data' => $jabatan
        ], 201);
    }

    /**
     * Menampilkan detail satu data jabatan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $jabatan = JabatanModel::find($id);

        if (!$jabatan) {
            return response()->json([
                'success' => false,
                'message' => 'Data jabatan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data jabatan',
            'data' => $jabatan
        ], 200);
    }

    /**
     * Memperbarui data jabatan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $jabatan = JabatanModel::find($id);
        if (!$jabatan) {
            return response()->json(['success' => false, 'message' => 'Data jabatan tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required|string|max:255|unique:tbl_jabatan,nama_jabatan,' . $id . ',idjabatan',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        $jabatan->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data jabatan berhasil diperbarui',
            'data' => $jabatan
        ], 200);
    }

    /**
     * Menghapus data jabatan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $jabatan = JabatanModel::find($id);

        if (!$jabatan) {
            return response()->json([
                'success' => false,
                'message' => 'Data jabatan tidak ditemukan'
            ], 404);
        }

        $jabatan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data jabatan berhasil dihapus'
        ], 200);
    }
}
