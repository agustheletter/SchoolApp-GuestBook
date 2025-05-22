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
        return view('admin.pages.orangtua.index', compact('orangtua'));
    }

    public function create()
    {
        $siswa = SiswaModel::all();
        return view('admin.pages.orangtua.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ortu' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'idsiswa' => 'required|exists:tbl_siswa,idsiswa',
            'kontak' => 'nullable|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        Orangtua::create(
            // $request->all()
            [
            'nama_ortu' => $request->nama_ortu,
            'jenis_kelamin' => $request->jenis_kelamin,
            'idsiswa' => $request->idsiswa,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
            ]
        );

        return redirect()->route('orangtua')->with('success', 'Data Orang Tua berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $orangtua = Orangtua::findOrFail($id);
        $siswa = SiswaModel::all();
        return view('admin.pages.orangtua.edit', compact('orangtua', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ortu' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'idsiswa' => 'required|exists:tbl_siswa,idsiswa',
            'kontak' => 'nullable|string',
            'alamat' => 'required|string|max:255',
        ]);

        $orangtua = Orangtua::findOrFail($id);

        dd($request->all(), $orangtua->update([
            'nama_ortu' => $request->nama_ortu,
            'jenis_kelamin' => $request->jenis_kelamin,
            'idsiswa' => $request->idsiswa,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
        ]));

        $orangtua->update([
            'nama_ortu' => $request->nama_ortu,
            'jenis_kelamin' => $request->jenis_kelamin,
            'idsiswa' => $request->idsiswa,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('orangtua')->with('success', 'Data Orang Tua berhasil diupdate.');
    }

    public function destroy($id)
    {
        $orangtua = Orangtua::findOrFail($id);
        $orangtua->delete();

        return redirect()->route('orangtua')->with('success', 'Data Orang Tua berhasil dihapus.');
    }
}
