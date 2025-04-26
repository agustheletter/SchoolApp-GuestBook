<?php

namespace App\Http\Controllers;

use App\Models\Orangtua;
use App\Models\SiswaModel;
use Illuminate\Http\Request;

class OrangtuaController extends Controller
{
    public function index()
    {
        $orangtua = Orangtua::with('siswa')->get();
        return view('admin.orangtua.index', compact('orangtua'));
    }

    public function create()
    {
        $siswa = SiswaModel::all();
        return view('admin.orangtua.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ortu' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'idsiswa' => 'required|exists:siswa,idsiswa',
            'kontak' => 'nullable|string|max:20',
        ]);

        Orangtua::create($request->all());

        return redirect()->route('orangtua.index')->with('success', 'Data Orang Tua berhasil ditambahkan.');
    }

    public function edit(Orangtua $orangtua)
    {
        $siswa = SiswaModel::all();
        return view('admin.orangtua.edit', compact('orangtua', 'siswa'));
    }

    public function update(Request $request, Orangtua $orangtua)
    {
        $request->validate([
            'nama_ortu' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'idsiswa' => 'required|exists:siswa,idsiswa',
            'kontak' => 'nullable|string|max:20',
        ]);

        $orangtua->update($request->all());

        return redirect()->route('orangtua.index')->with('success', 'Data Orang Tua berhasil diupdate.');
    }

    public function destroy(Orangtua $orangtua)
    {
        $orangtua->delete();

        return redirect()->route('orangtua.index')->with('success', 'Data Orang Tua berhasil dihapus.');
    }
}
