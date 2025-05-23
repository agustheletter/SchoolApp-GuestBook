<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\BukuTamu;
use App\Models\Orangtua;
use App\Models\AgamaModel;
use App\Models\SiswaModel;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    public function index()
    {
        $bukutamu = BukuTamu::with(['siswa', 'jabatan', 'pegawai'])->get();
        return view('admin.pages.bukutamu.v_bukutamu', compact('bukutamu'));
    }

    public function edit($id)
    {
        $bukutamu = BukuTamu::findOrFail($id);
        // $agama = AgamaModel::all();
        $siswa = SiswaModel::all();
        $jabatan = JabatanModel::all();
        $pegawai = PegawaiModel::all();

        return view('admin.pages.bukutamu.v_bukutamu_edit', compact('bukutamu', 'siswa', 'jabatan', 'pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'role' => 'required|in:ortu,umum',
            // 'idagama' => 'required|exists:tbl_agama,idagama',
            'idsiswa' => 'nullable|exists:tbl_siswa,idsiswa',
            'instansi' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:255',
            'id_jabatan' => 'required|exists:tbl_jabatan,id',
            'id_pegawai' => 'required|exists:tbl_pegawai,id',
            'keperluan' => 'required|string',
        ]);

        $bukutamu = BukuTamu::findOrFail($id);
        $bukutamu->update([
            'nama' => $request->nama,
            'role' => $request->role,
            // 'idagama' => $request->idagama,
            'idsiswa' => $request->idsiswa,
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'id_jabatan' => $request->id_jabatan,
            'id_pegawai' => $request->id_pegawai,
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->route('bukutamu')->with('success', 'Data buku tamu berhasil diperbarui.');
    }

    public function input()
    {
        return view('admin.pages.bukutamu.v_bukutamu_input');
    }

    public function input_orangtua()
    {
        // $agama = AgamaModel::all();
        $siswa = SiswaModel::all();
        $jabatan = JabatanModel::all();
        $pegawai = PegawaiModel::all();
        $role = 'ortu';

        return view('admin.pages.bukutamu.v_bukutamu_ortu', compact('siswa', 'jabatan', 'pegawai', 'role'));
    }

    public function input_umum()
    {
        // $agama = AgamaModel::all();
        $jabatan = JabatanModel::all();
        $pegawai = PegawaiModel::all();
        $role = 'umum';

        return view('admin.pages.bukutamu.v_bukutamu_umum', compact('jabatan', 'pegawai', 'role'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'role' => 'required|in:ortu,umum',
            // 'idagama' => 'required|exists:tbl_agama,idagama',
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
            'role' => $request->role,
            // 'idagama' => $request->idagama,
            'idsiswa' => $request->idsiswa,
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'id_jabatan' => $request->id_jabatan,
            'id_pegawai' => $request->id_pegawai,
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->route('bukutamu.input')->with('success', 'Data Buku Tamu berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $bukutamu = BukuTamu::findOrFail($id);
        $bukutamu->delete();

        return redirect()->route('bukutamu')->with('success', 'Data Buku Tamu berhasil dihapus');
    }

    public function getPegawai($id) {
        $pegawai = PegawaiModel::where('id_jabatan', $id)->get();
        return response()->json($pegawai);
    }

    public function getOrangtua($idsiswa)
    {
        $orangtua = Orangtua::where('idsiswa', $idsiswa)->first();
        // return response()->json($orangtua);

        if ($orangtua) {
            return response()->json([
                'nama_ortu' => $orangtua->nama_ortu,
                'kontak'    => $orangtua->kontak,
                'alamat'    => $orangtua->alamat
            ]);
        } else {
            return response()->json([
                'nama_ortu' => null,
                'kontak'    => null,
                'alamat'    => null
            ]);
        }
    }

    // Buku Tamu User controller
    public function inputUser() {
        // $agama = AgamaModel::all();
        $siswa = SiswaModel::all();
        $jabatan = JabatanModel::all();
        $pegawai = PegawaiModel::all();
        $role = 'ortu';

        // return view('users.bukutamu.input');
        return view('users.bukutamu.input', compact('siswa', 'jabatan', 'pegawai', 'role'));
    }

    public function storeUser(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'role' => 'required|in:ortu,umum',
            // 'idagama' => 'required|exists:tbl_agama,idagama',
            'idsiswa' => 'nullable|exists:tbl_siswa,idsiswa',
            'instansi' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:255',
            'id_jabatan' => 'required|exists:tbl_jabatan,id',
            'id_pegawai' => 'required|exists:tbl_pegawai,id',
            'keperluan' => 'required|string',
            'foto_tamu' => 'nullable|string',
        ]);

        if ($request->has('foto_tamu')) {
            $image = $request->input('foto_tamu');
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'tamu_' . time() . '.jpg';
            File::put(public_path('uploads/foto_tamu/') . $imageName, base64_decode($image));
            $validatedData['foto_tamu'] = $imageName;
        }

        // Simpan data ke database
        BukuTamu::create([
            'nama' => $request->nama,
            'role' => $request->role,
            // 'idagama' => $request->idagama,
            'idsiswa' => $request->idsiswa,
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'id_jabatan' => $request->id_jabatan,
            'id_pegawai' => $request->id_pegawai,
            'keperluan' => $request->keperluan,
            'foto_tamu' => $imageName ?? null, // foto tamu = opsional
        ]);

        // pemilihan role
        $role = $request->role;
        // return redirect()->route('bukutamu.user')->with('success', 'Data Buku Tamu berhasil ditambahkan');
        return redirect()->to(route('bukutamu.user') . '#' . $role)->with('success', 'Data Buku Tamu berhasil ditambahkan');
    }
}
