<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SiswaModel;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;
use App\Models\OrtuModel;
use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BukuTamuController extends Controller
{
    /**
     * Get data untuk form input buku tamu
     */
    public function getFormData()
    {
        try {
            $siswa = SiswaModel::select('idsiswa', 'namasiswa')->get();
            $jabatan = JabatanModel::select('id', 'nama_jabatan')->get();
            $pegawai = PegawaiModel::select('id', 'nama_pegawai', 'id_jabatan')->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'siswa' => $siswa,
                    'jabatan' => $jabatan,
                    'pegawai' => $pegawai
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data form'
            ], 500);
        }
    }

    /**
     * Get pegawai berdasarkan jabatan
     */
    public function getPegawai($jabatanId)
    {
        try {
            $pegawai = PegawaiModel::where('id_jabatan', $jabatanId)->get();

            return response()->json([
                'success' => true,
                'data' => $pegawai
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data pegawai'
            ], 500);
        }
    }

    /**
     * Get data orangtua berdasarkan siswa
     */
    public function getOrangtua($siswaId)
    {
        try {
            $orangtua = OrtuModel::where('idsiswa', $siswaId)->first();

            if ($orangtua) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'nama_ortu' => $orangtua->nama_ortu,
                        'kontak' => $orangtua->kontak,
                        'alamat' => $orangtua->alamat
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'nama_ortu' => '',
                        'kontak' => '',
                        'alamat' => ''
                    ]
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data orangtua'
            ], 500);
        }
    }

    /**
     * Store data buku tamu dari React
     */
    public function storeUser(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'role' => 'required|in:ortu,umum',
                'idsiswa' => 'nullable|exists:tbl_siswa,idsiswa',
                'instansi' => 'nullable|string|max:255',
                'alamat' => 'required|string',
                'kontak' => 'required|string|max:255',
                'id_jabatan' => 'required|exists:tbl_jabatan,id',
                'id_pegawai' => 'required|exists:tbl_pegawai,id',
                'keperluan' => 'required|string',
                'foto_tamu' => 'nullable|string',
            ]);

            // Proses foto
            $imageName = null;
            $fotoTamuPath = null;

            if (!empty($request->foto_tamu)) {
                $image = str_replace('data:image/jpeg;base64,', '', $request->foto_tamu);
                $image = str_replace(' ', '+', $image);
                $imageData = base64_decode($image);

                $folder = 'uploads/foto_tamu';
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }

                $imageName = 'tamu_' . time() . '.jpg';
                $fotoTamuPath = public_path($folder . '/' . $imageName);
                file_put_contents($fotoTamuPath, $imageData);
            }

            // Simpan data
            $bukuTamu = BukuTamu::create([
                'nama' => $request->nama,
                'role' => $request->role,
                'idsiswa' => $request->idsiswa,
                'instansi' => $request->instansi,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'id_jabatan' => $request->id_jabatan,
                'id_pegawai' => $request->id_pegawai,
                'keperluan' => $request->keperluan,
                'foto_tamu' => $imageName,
            ]);

            // Kirim WhatsApp notification (sama seperti di Laravel)
            $this->sendWhatsAppNotification($bukuTamu, $fotoTamuPath);

            return response()->json([
                'success' => true,
                'message' => 'Data buku tamu berhasil disimpan!'
            ]);

        } catch (\Exception $e) {
            Log::error('Store guestbook error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send WhatsApp notification
     */
    private function sendWhatsAppNotification($bukuTamu, $fotoTamuPath)
    {
        $apiKey = env('FONNTE_API_KEY');
        $pegawai = PegawaiModel::find($bukuTamu->id_pegawai);

        if ($pegawai && !empty($pegawai->kontak)) {
            $nomor = ltrim($pegawai->kontak, '0');
            if (!str_starts_with($nomor, '62')) {
                $nomor = '62' . $nomor;
            }

            // Kirim foto jika ada
            if ($fotoTamuPath && file_exists($fotoTamuPath)) {
                $imageUrl = env('APP_URL') . "/uploads/foto_tamu/{$bukuTamu->foto_tamu}";

                Http::withHeaders(['Authorization' => $apiKey])
                    ->post('https://api.fonnte.com/send', [
                        'target' => $nomor,
                        'url' => $imageUrl,
                        'message' => "Assalamualaikum Bapak/Ibu {$pegawai->nama_pegawai}, ini adalah foto tamu Anda.",
                    ]);
            }

            // Kirim pesan detail
            $pesanTeks = $this->formatWhatsAppMessage($bukuTamu, $pegawai);

            Http::withHeaders(['Authorization' => $apiKey])
                ->post('https://api.fonnte.com/send', [
                    'target' => $nomor,
                    'message' => $pesanTeks,
                ]);
        }
    }

    /**
     * Format WhatsApp message
     */
    private function formatWhatsAppMessage($bukuTamu, $pegawai)
    {
        $pesan = "Assalamualaikum Bapak/Ibu {$pegawai->nama_pegawai},\n\n"
               . "Ini adalah nomor layanan Hotline SMK Negeri 1 Cimahi.\n"
               . "Saat ini ada tamu yang ingin bertemu dengan Anda sedang menunggu di Ruang Resepsionis.\n\n";

        if ($bukuTamu->role == 'ortu') {
            $siswa = SiswaModel::find($bukuTamu->idsiswa);
            $pesan .= "Nama Tamu: {$bukuTamu->nama}.\n"
                   . "Orang tua dari siswa: {$siswa->namasiswa}.\n"
                   . "Dengan Nomor WA: {$bukuTamu->kontak}.\n";
        } else {
            $pesan .= "Nama Tamu: {$bukuTamu->nama}.\n"
                   . "Asal Instansi: {$bukuTamu->instansi}.\n"
                   . "Dengan Nomor WA: {$bukuTamu->kontak}.\n";
        }

        $pesan .= "\nKeperluan: {$bukuTamu->keperluan}\n"
               . "Waktu: " . now()->format('d F Y, H:i') . " WIB\n\n"
               . "Untuk konfirmasi atau informasi lebih lanjut, silakan hubungi kontak nomor Whatsapp tamu tersebut.\n";

        return $pesan;
    }
}
