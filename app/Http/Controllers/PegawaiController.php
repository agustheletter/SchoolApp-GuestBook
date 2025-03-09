<?php

namespace App\Http\Controllers;

use App\Models\AgamaModel;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $datapegawai = PegawaiModel::with(['jabatan', 'agama'])->get();
        return view('admin.pages.pegawai.v_pegawai', compact('datapegawai'));
    }

    public function input()
    {
        $agama = AgamaModel::all();
        $jabatan = JabatanModel::all();

        return view('admin.pages.pegawai.v_pegawai_input', compact('agama', 'jabatan'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'id_agama' => 'required|exists:tbl_agama,idagama',
            'id_jabatan' => 'required|exists:tbl_jabatan,id',
            'kontak' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        PegawaiModel::create([
            'nama_pegawai' => $request->nama_pegawai,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_agama' => $request->id_agama,
            'id_jabatan' => $request->id_jabatan,
            'kontak' => $request->kontak,
        ]);

        return redirect()->route('pegawai')->with('success', 'Data Pegawai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pegawai = PegawaiModel::FindOrFail($id);
        $agama = AgamaModel::all();
        $jabatan = JabatanModel::all();

        return view('admin.pages.pegawai.v_pegawai_edit', compact('pegawai', 'agama', 'jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'id_agama' => 'required|exists:tbl_agama,idagama',
            'id_jabatan' => 'required|exists:tbl_jabatan,id',
            'kontak' => 'required|string|max:255',
        ]);

        $pegawai = PegawaiModel::findOrFail($id);
        $pegawai->update([
            'nama_pegawai' => $request->nama_pegawai,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_agama' => $request->id_agama,
            'id_jabatan' => $request->id_jabatan,
            'kontak' => $request->kontak,
        ]);

        return redirect()->route('pegawai')->with('success', 'Data Pegawai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pegawai = PegawaiModel::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai')->with('success', 'Data Pegawai berhasil dihapus');
    }
}
