<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Orangtua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrangtuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Ambil semua data orang tua dengan relasi ke siswa
        $orangtua = Orangtua::with('siswa')->orderBy('nama_ortu', 'asc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data orang tua berhasil diambil',
            'data' => $orangtua
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
            'nama_ortu' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P', // Disesuaikan untuk API (L/P)
            'idsiswa' => 'required|exists:tbl_siswa,idsiswa',
            'kontak' => 'nullable|string|max:20',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $orangtua = Orangtua::create($request->all());
        $orangtua->load('siswa'); // Muat relasi siswa agar ada di response

        return response()->json([
            'success' => true,
            'message' => 'Data orang tua berhasil ditambahkan',
            'data' => $orangtua
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
        $orangtua = Orangtua::with('siswa')->find($id);

        if (!$orangtua) {
            return response()->json([
                'success' => false,
                'message' => 'Data orang tua tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data orang tua',
            'data' => $orangtua
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
        $orangtua = Orangtua::find($id);
        if (!$orangtua) {
            return response()->json(['success' => false, 'message' => 'Data orang tua tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_ortu' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'idsiswa' => 'required|exists:tbl_siswa,idsiswa',
            'kontak' => 'nullable|string|max:20',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        $orangtua->update($request->all());
        $orangtua->load('siswa'); // Muat relasi siswa setelah update

        return response()->json([
            'success' => true,
            'message' => 'Data orang tua berhasil diperbarui',
            'data' => $orangtua
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
        $orangtua = Orangtua::find($id);

        if (!$orangtua) {
            return response()->json([
                'success' => false,
                'message' => 'Data orang tua tidak ditemukan'
            ], 404);
        }

        $orangtua->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data orang tua berhasil dihapus'
        ], 200);
    }
}
