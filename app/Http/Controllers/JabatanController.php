<?php

namespace App\Http\Controllers;

use App\Models\JabatanModel;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $datajabatan = JabatanModel::all();
        return view('admin.pages.jabatan.v_jabatan', compact('datajabatan'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_jabatan' => 'required|string|max:255'
        ]);

        // Simpan data ke database
        JabatanModel::create([
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        return redirect()->route('jabatan')->with('success', 'Data Jabatan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255'
        ]);

        $jabatan = JabatanModel::findOrFail($id);

        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        return redirect()->route('jabatan')->with('success', 'Data Jabatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jabatan = JabatanModel::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('jabatan')->with('success', 'Data Jabatan berhasil dihapus');
    }
}
