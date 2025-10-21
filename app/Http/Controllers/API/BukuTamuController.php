<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SiswaModel;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;
use App\Models\JabatanPegawaiModel;
use App\Models\OrtuModel;
use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BukuTamuController extends Controller
{
    /**
     * Menampilkan semua data buku tamu.
     */
    public function index(Request $request)
    {
        $query = BukuTamu::with(['siswa', 'jabatan', 'pegawai']);

        // Logika pencarian server-side
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', "%{$searchTerm}%")
                  ->orWhere('keperluan', 'like', "%{$searchTerm}%")
                  ->orWhere('kontak', 'like', "%{$searchTerm}%")
                  ->orWhereHas('siswa', function($q) use ($searchTerm) {
                      $q->where('namasiswa', 'like', "%{$searchTerm}%");
                  })
                  ->orWhereHas('pegawai', function($q) use ($searchTerm) {
                      $q->where('nama_pegawai', 'like', "%{$searchTerm}%");
                  });
            });
        }

        $perPage = $request->get('rows_per_page', 10);
        $bukutamu = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json($bukutamu);
    }

    /**
     * Menyimpan data buku tamu baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'role' => 'required|in:ortu,umum',
            'idsiswa' => 'required_if:role,ortu|nullable|exists:tbl_siswa,idsiswa',
            'instansi' => 'required_if:role,umum|nullable|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:20',
            'id_jabatan' => 'required|exists:tbl_jabatan,idjabatan',
            'id_pegawai' => 'required|exists:tbl_pegawai,idpegawai',
            'keperluan' => 'required|string',
            'foto_tamu' => 'nullable|string', // Menerima base64 string
        ], [
            'idsiswa.required_if' => 'Nama siswa wajib dipilih jika role adalah Orang Tua.',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();
        $imageName = null;
        $imageUrlForWa = null;

        // Proses dan simpan foto dari base64
        if ($request->has('foto_tamu') && !empty($request->foto_tamu)) {
            try {
                $image = $request->input('foto_tamu');
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageData = base64_decode($image);
                $imageName = 'tamu_' . time() . '.jpg';

                // Simpan ke storage/app/public/foto_tamu
                Storage::disk('public')->put('foto_tamu/' . $imageName, $imageData);
                $validatedData['foto_tamu'] = $imageName;

                // URL publik untuk dikirim via WA
                $imageUrlForWa = Storage::url('foto_tamu/' . $imageName);

            } catch (\Exception $e) {
                Log::error('Gagal menyimpan foto: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => 'Gagal memproses foto.'], 500);
            }
        }

        $bukuTamu = BukuTamu::create($validatedData);
        $bukuTamu->load(['siswa', 'jabatan', 'pegawai']);

        // Kirim notifikasi WhatsApp
        // $this->kirimNotifikasiWhatsApp($bukuTamu, $imageUrlForWa);

        return response()->json([
            'success' => true,
            'message' => 'Data buku tamu berhasil ditambahkan',
            'data' => $bukuTamu
        ], 201);
    }

    /**
     * Menampilkan detail satu data buku tamu.
     */
    public function show($id)
    {
        $tamu = BukuTamu::with(['siswa', 'jabatan', 'pegawai'])->find($id);

        if (!$tamu) {
            return response()->json([
                'success' => false,
                'message' => 'Data buku tamu tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $tamu
        ]);
    }

    /**
     * Menghapus data buku tamu.
     */
    public function destroy($id)
    {
        $bukutamu = BukuTamu::find($id);

        if (!$bukutamu) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        // Hapus file foto jika ada
        if ($bukutamu->foto_tamu) {
            Storage::disk('public')->delete('foto_tamu/' . $bukutamu->foto_tamu);
        }

        $bukutamu->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
    /**
     * Get data untuk form input buku tamu - PAKAI QUERY MANUAL
     */
    public function getFormData()
    {
        try {
            Log::info('Loading form data dengan VALIDASI DATA...');

            // Ambil data siswa
            $siswa = SiswaModel::select('idsiswa', 'namasiswa')->get();

            // Ambil data jabatan - PASTIKAN FIELD NAME KONSISTEN
            $jabatan = JabatanModel::select('idjabatan as id', 'jabatan as nama_jabatan')->get();

            // Data pegawai
            $pegawai = DB::table('tbl_pegawai as p')
                ->join('tbl_jabatanpegawai as jp', 'p.idpegawai', '=', 'jp.idpegawai')
                ->join('tbl_jabatan as j', 'jp.idjabatan', '=', 'j.idjabatan')
                ->select(
                    'p.idpegawai as id',
                    'p.namapegawai as nama_pegawai',
                    'p.hppegawai as kontak',
                    'j.jabatan as jabatan',
                    'j.idjabatan as id_jabatan'
                )
                ->get();

            Log::info('Data loaded dengan validasi', [
                'siswa_count' => $siswa->count(),
                'jabatan_count' => $jabatan->count(),
                'jabatan_sample' => $jabatan->first(), // DEBUG
                'pegawai_count' => $pegawai->count()
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'siswa' => $siswa,
                    'jabatan' => $jabatan,
                    'pegawai' => $pegawai
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error in getFormData: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data form: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get pegawai berdasarkan jabatan - PAKAI QUERY MANUAL JUGA
     */
    public function getPegawai($jabatanId)
    {
        try {
            Log::info('Getting pegawai for jabatan dengan QUERY MANUAL: ' . $jabatanId);

            // PAKAI QUERY MANUAL
            $pegawaiData = DB::table('tbl_pegawai as p')
                ->join('tbl_jabatanpegawai as jp', 'p.idpegawai', '=', 'jp.idpegawai')
                ->join('tbl_jabatan as j', 'jp.idjabatan', '=', 'j.idjabatan')
                ->where('j.idjabatan', $jabatanId)
                ->select(
                    'p.idpegawai as id',
                    'p.namapegawai as nama_pegawai',
                    'p.hppegawai as kontak',
                    'j.jabatan as jabatan'
                )
                ->get();

            Log::info('Pegawai data found dengan QUERY MANUAL: ' . $pegawaiData->count() . ' records');

            return response()->json([
                'success' => true,
                'data' => $pegawaiData
            ]);

        } catch (\Exception $e) {
            Log::error('Error in getPegawai: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data pegawai: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get data orangtua berdasarkan siswa - TETAP PAKAI ELOQUENT (karena simple)
     */
    public function getOrangtua($siswaId)
    {
        try {
            Log::info('Getting orangtua for siswa: ' . $siswaId);

            $orangtua = OrtuModel::where('idsiswa', $siswaId)->first();

            if ($orangtua) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'nama_ortu' => $orangtua->nama_ayah,
                        'kontak' => $orangtua->hp_ayah,
                        'alamat' => $orangtua->alamat_ayah
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
            Log::error('Error in getOrangtua: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data orangtua: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store data buku tamu dari React - DENGAN FIELD MAPPING
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
                'id_jabatan' => 'required|exists:tbl_jabatan,idjabatan', // Tetap validasi dengan id_jabatan
                'id_pegawai' => 'required|exists:tbl_pegawai,idpegawai', // Tetap validasi dengan id_pegawai
                'keperluan' => 'required|string',
                'foto_tamu' => 'nullable|string',
            ]);

            Log::info('Storing guestbook data', [
                'pegawai_id' => $request->id_pegawai,
                'jabatan_id' => $request->id_jabatan,
                'all_data' => $request->all() // DEBUG
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

            // **PERBAIKAN: Mapping field name untuk match dengan database**
            $bukuTamu = BukuTamu::create([
                'nama' => $request->nama,
                'role' => $request->role,
                'idsiswa' => $request->idsiswa,
                'instansi' => $request->instansi,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'idjabatan' => $request->id_jabatan, // Mapping: id_jabatan → idjabatan
                'idpegawai' => $request->id_pegawai, // Mapping: id_pegawai → idpegawai
                'keperluan' => $request->keperluan,
                'foto_tamu' => $imageName,
            ]);

            Log::info('Guestbook data saved successfully: ' . $bukuTamu->id);

            // Kirim WhatsApp notification
            // $this->sendWhatsAppNotification($bukuTamu, $fotoTamuPath);

            return response()->json([
                'success' => true,
                'message' => 'Data buku tamu berhasil disimpan!'
            ]);

        } catch (\Exception $e) {
            Log::error('Store guestbook error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

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

        // Ambil data pegawai
        $pegawai = PegawaiModel::find($bukuTamu->id_pegawai);

        if ($pegawai && !empty($pegawai->hppegawai)) {
            $nomor = ltrim($pegawai->hppegawai, '0');
            if (!str_starts_with($nomor, '62')) {
                $nomor = '62' . $nomor;
            }

            Log::info('Sending WhatsApp to: ' . $nomor);

            // Kirim foto jika ada
            if ($fotoTamuPath && file_exists($fotoTamuPath)) {
                $imageUrl = env('APP_URL') . "/uploads/foto_tamu/{$bukuTamu->foto_tamu}";

                $response = Http::withHeaders(['Authorization' => $apiKey])
                    ->post('https://api.fonnte.com/send', [
                        'target' => $nomor,
                        'url' => $imageUrl,
                        'message' => "Assalamualaikum Bapak/Ibu {$pegawai->namapegawai}, ini adalah foto tamu Anda.",
                    ]);

                Log::info('Foto WhatsApp sent: ' . $response->successful());
            }

            // Kirim pesan detail
            $pesanTeks = $this->formatWhatsAppMessage($bukuTamu, $pegawai);

            $response = Http::withHeaders(['Authorization' => $apiKey])
                ->post('https://api.fonnte.com/send', [
                    'target' => $nomor,
                    'message' => $pesanTeks,
                ]);

            Log::info('Pesan WhatsApp sent: ' . $response->successful());

        } else {
            Log::warning('Pegawai not found or no contact number for ID: ' . $bukuTamu->id_pegawai);
        }
    }

    /**
     * Format WhatsApp message
     */
    private function formatWhatsAppMessage($bukuTamu, $pegawai)
    {
        $pesan = "Assalamualaikum Bapak/Ibu {$pegawai->namapegawai},\n\n"
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
