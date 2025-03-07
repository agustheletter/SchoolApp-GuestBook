<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use App\Models\AgamaModel;
use App\Models\SiswaModel;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    public function index()
    {
        $bukutamu = BukuTamu::with(['agama', 'siswa', 'jabatan', 'pegawai'])->get();
        return view('admin.pages.bukutamu.v_bukutamu', compact('bukutamu'));
    }

    public function edit($id)
    {
        $bukutamu = BukuTamu::findOrFail($id);
        $agama = AgamaModel::all();
        $siswa = SiswaModel::all();
        $jabatan = JabatanModel::all();
        $pegawai = PegawaiModel::all();

        return view('admin.pages.bukutamu.v_bukutamu_edit', compact('bukutamu', 'agama', 'siswa', 'jabatan', 'pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'keperluan' => 'required|string',
        ]);

        $bukutamu = BukuTamu::findOrFail($id);
        $bukutamu->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->route('bukutamu')->with('success', 'Data buku tamu berhasil diperbarui.');
    }

    public function getPegawai($id) {
        $pegawai = PegawaiModel::where('id_jabatan', $id)->get();
        return response()->json($pegawai);
    }

    public function input()
    {
        $bukutamu = BukuTamu::all();
        return view('admin.pages.bukutamu.v_bukutamu_input', ['datajurusan' => $bukutamu]);

    }

    public function input_orangtua()
    {
        $agama = AgamaModel::all();
        $siswa = SiswaModel::all();
        $jabatan = JabatanModel::all();
        $pegawai = PegawaiModel::all();
        $role = 'ortu';

        return view('admin.pages.bukutamu.v_bukutamu_ortu', compact('agama', 'siswa', 'jabatan', 'pegawai', 'role'));
    }

    public function input_umum()
    {
        $agama = AgamaModel::all();
        $jabatan = JabatanModel::all();
        $pegawai = PegawaiModel::all();
        $role = 'umum';

        return view('admin.pages.bukutamu.v_bukutamu_umum', compact('agama', 'jabatan', 'pegawai', 'role'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'role' => 'required|in:ortu,umum',
            'idagama' => 'required|exists:tbl_agama,idagama',
            'idsiswa' => 'nullable|exists:tbl_siswa,idsiswa',
            'instansi' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:255',
            'id_jabatan' => 'required|exists:tbl_jabatan,id',
            'id_pegawai' => 'required|exists:tbl_pegawai,id',
            'keperluan' => 'required|string',
        ]);

        // Simpan data ke database
        BukuTamu::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'role' => $request->role,
            'idagama' => $request->idagama,
            'idsiswa' => $request->idsiswa,
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'id_jabatan' => $request->id_jabatan,
            'id_pegawai' => $request->id_pegawai,
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->route('bukutamu.input')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $bukutamu = BukuTamu::findOrFail($id);
        $bukutamu->delete();

        return redirect()->route('bukutamu')->with('success', 'Data berhasil dihapus');
    }
}
