<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SiswaModel;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;
use App\Models\JabatanPegawaiModel;
use App\Models\OrtuModel;
use App\Models\BukuTamu;
use App\Models\TahunAjaranModel;
use App\Models\KelasDetailModel;
use App\Models\SiswaKelasModel;
use Carbon\Carbon;
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
        $query = BukuTamu::with(['siswa', 'pegawai', 'tahunAjaran']);

        // Filter berdasarkan tahun ajaran - POIN 8
        if ($request->has('tahun_ajaran') && $request->tahun_ajaran != '') {
            $query->where('idthnajaran', $request->tahun_ajaran);
        }

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
                  })
                  ->orWhereHas('tahunAjaran', function($q) use ($searchTerm) {
                      $q->where('thnajaran', 'like', "%{$searchTerm}%");
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
            'id_pegawai' => 'required|exists:tbl_pegawai,idpegawai',
            'keperluan' => 'required|string',
            'foto_tamu' => 'nullable|string',
        ], [
            'idsiswa.required_if' => 'Nama siswa wajib dipilih jika role adalah Orang Tua.',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();
        $imageName = null;
        $imageUrlForWa = null;

        // POIN 6: Ambil tahun ajaran aktif
        $tahunAjaranAktif = TahunAjaranModel::whereRaw('CURDATE() BETWEEN tglmulai AND tglakhir')
            ->first();

        if (!$tahunAjaranAktif) {
            return response()->json(['success' => false, 'message' => 'Tidak ada tahun ajaran aktif'], 422);
        }

        // Proses dan simpan foto dari base64
        if ($request->has('foto_tamu') && !empty($request->foto_tamu)) {
            try {
                $image = $request->input('foto_tamu');
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageData = base64_decode($image);
                $imageName = 'tamu_' . time() . '.jpg';

                Storage::disk('public')->put('foto_tamu/' . $imageName, $imageData);
                $validatedData['foto_tamu'] = $imageName;

                $imageUrlForWa = Storage::url('foto_tamu/' . $imageName);

            } catch (\Exception $e) {
                Log::error('Gagal menyimpan foto: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => 'Gagal memproses foto.'], 500);
            }
        }

        // POIN 7: Hapus field jabatan dari data yang disimpan
        unset($validatedData['id_jabatan']);

        // POIN 6 & 8: Tambahkan idthnajaran
        $validatedData['idthnajaran'] = $tahunAjaranAktif->idthnajaran;

        $bukuTamu = BukuTamu::create($validatedData);
        $bukuTamu->load(['siswa', 'pegawai', 'tahunAjaran']);

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
        $tamu = BukuTamu::with(['siswa', 'pegawai', 'tahunAjaran'])->find($id);

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

        if ($bukutamu->foto_tamu) {
            Storage::disk('public')->delete('foto_tamu/' . $bukutamu->foto_tamu);
        }

        $bukutamu->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    /**
     * Get data untuk form input buku tamu - DENGAN DATA KELAS BERDASARKAN TAHUN AJARAN AKTIF
     */
    public function getFormData()
    {
        try {
            Log::info('Loading form data dengan KELAS BERDASARKAN TAHUN AJARAN AKTIF...');

            // POIN 6: Ambil tahun ajaran aktif
            $tahunAjaranAktif = TahunAjaranModel::whereRaw('CURDATE() BETWEEN tglmulai AND tglakhir')
                ->first();

            if (!$tahunAjaranAktif) {
                Log::warning('Tidak ada tahun ajaran aktif');
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada tahun ajaran aktif'
                ], 422);
            }

            Log::info('Tahun ajaran aktif: ' . $tahunAjaranAktif->thnajaran);

            // Ambil data siswa dengan kelas berdasarkan tahun ajaran aktif - POIN 6
            $siswa = SiswaModel::select(
                    'tbl_siswa.idsiswa',
                    'tbl_siswa.namasiswa',
                    'tbl_siswa.nis',
                    'tbl_siswa.nisn',
                    'k.namakelas as kelas' // POIN 5 & 6: Ambil kelas dari tabel kelas
                )
                ->leftJoin('tbl_siswakelas as sk', function($join) use ($tahunAjaranAktif) {
                    $join->on('tbl_siswa.idsiswa', '=', 'sk.idsiswa');
                })
                ->leftJoin('tbl_kelasdetail as kd', 'sk.idkelasdetail', '=', 'kd.idkelasdetail')
                ->leftJoin('tbl_kelas as k', 'kd.idkelas', '=', 'k.idkelas')
                ->where('kd.idthnajaran', $tahunAjaranAktif->idthnajaran)
                ->get()
                ->map(function($item) {
                    return [
                        'value' => $item->idsiswa,
                        'label' => $item->namasiswa,
                        'nis' => $item->nis,
                        'nisn' => $item->nisn,
                        'kelas' => $item->kelas ?: '-' // POIN 5: Default value '-'
                    ];
                });

            // Data pegawai (tanpa jabatan) - POIN 7
            $pegawai = PegawaiModel::select(
                    'idpegawai as id',
                    'namapegawai as nama_pegawai'
                )
                ->get();

            Log::info('Data loaded dengan tahun ajaran aktif', [
                'tahun_ajaran' => $tahunAjaranAktif->thnajaran,
                'siswa_count' => $siswa->count(),
                'pegawai_count' => $pegawai->count()
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'siswa' => $siswa,
                    'pegawai' => $pegawai,
                    'tahun_ajaran_aktif' => [
                        'idthnajaran' => $tahunAjaranAktif->idthnajaran,
                        'thnajaran' => $tahunAjaranAktif->thnajaran
                    ]
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
     * Get data orangtua berdasarkan siswa - DENGAN RESET KONTAK & ALAMAT
     */
    public function getOrangtua($siswaId)
    {
        try {
            Log::info('Getting orangtua for siswa: ' . $siswaId);

            $orangtua = OrtuModel::where('idsiswa', $siswaId)->first();

            // POIN 1: Selalu return dengan kontak dan alamat kosong
            if ($orangtua) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'nama_ortu' => $orangtua->nama_ayah,
                        'kontak' => '', // POIN 1: Selalu dikosongkan
                        'alamat' => ''  // POIN 1: Selalu dikosongkan
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'nama_ortu' => '',
                        'kontak' => '', // POIN 1: Selalu dikosongkan
                        'alamat' => ''  // POIN 1: Selalu dikosongkan
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
     * Store data buku tamu dari React - DENGAN PERBAIKAN UNTUK POIN 7
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
                'id_pegawai' => 'required|exists:tbl_pegawai,idpegawai',
                'keperluan' => 'required|string',
                'foto_tamu' => 'nullable|string',
            ]);

            Log::info('Storing guestbook data', [
                'pegawai_id' => $request->id_pegawai,
                'all_data' => $request->all()
            ]);

            // POIN 6: Ambil tahun ajaran aktif
            $tahunAjaranAktif = TahunAjaranModel::whereRaw('CURDATE() BETWEEN tglmulai AND tglakhir')
                ->first();

            if (!$tahunAjaranAktif) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada tahun ajaran aktif'
                ], 422);
            }

            // Proses foto
            $imageName = null;
            $fotoTamuPath = null;

            if (!empty($request->foto_tamu)) {
                try {
                    $image = $request->input('foto_tamu');
                    $image = str_replace('data:image/jpeg;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $imageData = base64_decode($image);

                    $imageName = 'tamu_' . time() . '.jpg';

                    // SIMPAN PAKAI STORAGE - INI YANG BENAR!
                    Storage::disk('public')->put('foto_tamu/' . $imageName, $imageData);

                    Log::info('Foto berhasil disimpan: ' . $imageName);

                } catch (\Exception $e) {
                    Log::error('Gagal menyimpan foto: ' . $e->getMessage());
                    $imageName = null; // Biar data tetap tersimpan tanpa foto
                }
            }

            // if (!empty($request->foto_tamu)) {
            //     $image = $request->input('foto_tamu');
            //     $image = str_replace('data:image/jpeg;base64,', '', $image);
            //     $image = str_replace(' ', '+', $image);
            //     $imageData = base64_decode($image);

            //     $folder = 'uploads/foto_tamu';
            //     if (!file_exists($folder)) {
            //         mkdir($folder, 0777, true);
            //     }

            //     $imageName = 'tamu_' . time() . '.jpg';
            //     $fotoTamuPath = public_path($folder . '/' . $imageName);
            //     file_put_contents($fotoTamuPath, $imageData);
            // }

            // POIN 7: Hapus field jabatan, tambah tahun ajaran
            $bukuTamu = BukuTamu::create([
                'nama' => $request->nama,
                'role' => $request->role,
                'idsiswa' => $request->idsiswa,
                'instansi' => $request->instansi,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'idpegawai' => $request->id_pegawai,
                'keperluan' => $request->keperluan,
                'foto_tamu' => $imageName,
                'idthnajaran' => $tahunAjaranAktif->idthnajaran, // POIN 6 & 8
            ]);

            Log::info('Guestbook data saved successfully: ' . $bukuTamu->id);

            // Kirim WhatsApp notification
            $this->sendWhatsAppNotification($bukuTamu);

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
     * Get data tahun ajaran untuk filter admin - POIN 8
     */
    public function getTahunAjaranOptions()
    {
        try {
            $tahunAjaran = TahunAjaranModel::select('idthnajaran as id', 'thnajaran as tahun_ajaran')
                ->orderBy('tglmulai', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $tahunAjaran
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting tahun ajaran options: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data tahun ajaran'
            ], 500);
        }
    }

    /**
     * Send WhatsApp notification - FIXED VERSION
     */
    private function sendWhatsAppNotification($bukuTamu)
    {
        try {
            Log::info('🔔 === WHATSAPP NOTIFICATION START ===');
            Log::info('📋 BukuTamu ID: ' . $bukuTamu->id);
            Log::info('👤 Pegawai ID dari BukuTamu: ' . $bukuTamu->idpegawai);

            $apiKey = env('FONNTE_API_KEY');
            Log::info('🔑 API Key: ' . ($apiKey ? 'ADA' : 'TIDAK ADA'));

            if (!$apiKey) {
                Log::error('❌ FONNTE_API_KEY not found in .env');
                return;
            }

            $pegawai = PegawaiModel::find($bukuTamu->idpegawai);

            if (!$pegawai) {
                Log::error('❌ Pegawai not found for ID: ' . $bukuTamu->idpegawai);

                // Coba log semua pegawai untuk debug
                $allPegawai = PegawaiModel::select('idpegawai', 'namapegawai')->get();
                Log::info('📝 All Pegawai IDs: ' . $allPegawai->pluck('idpegawai')->implode(', '));
                return;
            }

            Log::info('✅ Pegawai found: ' . $pegawai->namapegawai);
            Log::info('📞 Raw HP Pegawai: "' . ($pegawai->hppegawai ?: 'NULL') . '"');

            if (empty($pegawai->hppegawai)) {
                Log::warning('❌ No contact number for pegawai: ' . $pegawai->namapegawai);
                return;
            }

            $nomor = $this->formatPhoneNumber($pegawai->hppegawai);
            Log::info('🔢 Formatted number: ' . $nomor);

            if (!$nomor) {
                Log::error('❌ Invalid phone number after formatting: ' . $pegawai->hppegawai);
                return;
            }

            Log::info('🚀 Sending WhatsApp to: ' . $nomor);

            // Kirim foto jika ada
            if ($bukuTamu->foto_tamu) {
                Log::info('🖼️ Photo exists, sending photo message');
                $this->sendPhotoMessage($apiKey, $nomor, $pegawai, $bukuTamu);
            } else {
                Log::info('📷 No photo, skipping photo message');
            }

            // Kirim pesan teks
            Log::info('💬 Sending text message');
            $this->sendTextMessage($apiKey, $nomor, $pegawai, $bukuTamu);

            Log::info('✅ === WHATSAPP NOTIFICATION END ===');

        } catch (\Exception $e) {
            Log::error('💥 WhatsApp notification error: ' . $e->getMessage());
            Log::error('📋 Stack trace: ' . $e->getTraceAsString());
        }
    }

    /**
     * Format phone number untuk WhatsApp
     */
    private function formatPhoneNumber($phone)
    {
        // Hapus karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Hapus leading zero
        $phone = ltrim($phone, '0');

        // Tambahkan 62 jika belum ada
        if (!str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }

        // Validasi panjang nomor
        if (strlen($phone) < 10 || strlen($phone) > 15) {
            return null;
        }

        return $phone;
    }

    /**
     * Send photo message via WhatsApp
     */
    private function sendPhotoMessage($apiKey, $nomor, $pegawai, $bukuTamu)
    {
        try {
            $imageUrl = url('storage/foto_tamu/' . $bukuTamu->foto_tamu);

            Log::info('Sending photo via WhatsApp: ' . $imageUrl);

            $response = Http::withHeaders([
                'Authorization' => $apiKey
            ])->timeout(30)->post('https://api.fonnte.com/send', [
                'target' => $nomor,
                'url' => $imageUrl,
                'message' => "Assalamualaikum Bapak/Ibu {$pegawai->namapegawai}, ini adalah foto tamu Anda.",
                'delay' => 2 // Delay 2 detik sebelum kirim
            ]);

            if ($response->successful()) {
                Log::info('Photo WhatsApp sent successfully');
            } else {
                Log::error('Photo WhatsApp failed: ' . $response->body());
            }

        } catch (\Exception $e) {
            Log::error('Photo WhatsApp error: ' . $e->getMessage());
        }
    }

    /**
     * Send text message via WhatsApp - DENGAN LINK FOTO
     */
    private function sendTextMessage($apiKey, $nomor, $pegawai, $bukuTamu)
    {
        try {
            // PAKAI FORMAT PERSIS SEPERTI YANG DULU BERHASIL + LINK FOTO
            $pesanTeks = "Assalamualaikum Bapak/Ibu {$pegawai->namapegawai},\n\n"
                    . "Ini adalah nomor layanan Hotline SMK Negeri 1 Cimahi.\n"
                    . "Saat ini ada tamu yang ingin bertemu dengan Anda sedang menunggu di Ruang Resepsionis.\n\n";

            if ($bukuTamu->role == 'ortu') {
                $siswa = SiswaModel::find($bukuTamu->idsiswa);
                $pesanTeks .= "Nama Tamu: {$bukuTamu->nama}.\n"
                        . "Orang tua dari siswa: {$siswa->namasiswa}.\n"
                        . "Dengan Nomor WA: {$bukuTamu->kontak}.\n";
            } else {
                $pesanTeks .= "Nama Tamu: {$bukuTamu->nama}.\n"
                        . "Asal Instansi: {$bukuTamu->instansi}.\n"
                        . "Dengan Nomor WA: {$bukuTamu->kontak}.\n";
            }

            // TAMBAHKAN LINK FOTO JIKA ADA
            if ($bukuTamu->foto_tamu) {
                $imageUrl = url('storage/foto_tamu/' . $bukuTamu->foto_tamu);
                $pesanTeks .= "Photo: {$imageUrl} .\n";
            }

            $pesanTeks .= "\nKeperluan: {$bukuTamu->keperluan}\n"
                    . "Waktu: " . now()->format('d F Y, H:i') . " WIB\n\n"
                    . "Untuk konfirmasi atau informasi lebih lanjut, silakan hubungi kontak nomor Whatsapp tamu tersebut.\n";

            Log::info('💬 Sending WhatsApp message WITH PHOTO LINK', [
                'target' => $nomor,
                'message_length' => strlen($pesanTeks),
                'has_photo_link' => !empty($bukuTamu->foto_tamu),
                'photo_url' => $bukuTamu->foto_tamu ? url('storage/foto_tamu/' . $bukuTamu->foto_tamu) : 'none'
            ]);

            $response = Http::withHeaders([
                'Authorization' => $apiKey
            ])->timeout(30)->post('https://api.fonnte.com/send', [
                'target' => $nomor,
                'message' => $pesanTeks,
            ]);

            $result = json_decode($response->body(), true);

            Log::info('📡 WhatsApp API Response:', [
                'status' => $result['status'] ?? 'unknown',
                'reason' => $result['reason'] ?? 'none'
            ]);

            if ($result['status'] === true) {
                Log::info('✅ WhatsApp sent successfully with photo link');
                return true;
            } else {
                Log::error('❌ WhatsApp failed: ' . $response->body());
                return false;
            }

        } catch (\Exception $e) {
            Log::error('💥 WhatsApp error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Format WhatsApp message
     */
    // private function formatWhatsAppMessage($bukuTamu, $pegawai)
    // {
    //     $pesan = "Assalamualaikum Bapak/Ibu {$pegawai->namapegawai},\n\n"
    //            . "Ini adalah nomor layanan Hotline SMK Negeri 1 Cimahi.\n"
    //            . "Saat ini ada tamu yang ingin bertemu dengan Anda sedang menunggu di Ruang Resepsionis.\n\n";

    //     if ($bukuTamu->role == 'ortu') {
    //         $siswa = SiswaModel::find($bukuTamu->idsiswa);
    //         $pesan .= "Nama Tamu: {$bukuTamu->nama}.\n"
    //                . "Orang tua dari siswa: {$siswa->namasiswa}.\n"
    //                . "Dengan Nomor WA: {$bukuTamu->kontak}.\n";
    //     } else {
    //         $pesan .= "Nama Tamu: {$bukuTamu->nama}.\n"
    //                . "Asal Instansi: {$bukuTamu->instansi}.\n"
    //                . "Dengan Nomor WA: {$bukuTamu->kontak}.\n";
    //     }

    //     $pesan .= "\nKeperluan: {$bukuTamu->keperluan}\n"
    //            . "Waktu: " . now()->format('d F Y, H:i') . " WIB\n\n"
    //            . "Untuk konfirmasi atau informasi lebih lanjut, silakan hubungi kontak nomor Whatsapp tamu tersebut.\n";

    //     return $pesan;
    // }

    /**
     * AMBIL DATA GRAFIK (DIADAPTASI DARI KODE PRIBADI)
     * Digunakan untuk Dashboard Sekolah
     */
    public function getGrafikData(Request $request)
    {
        try {
            $filterType = $request->get('filter_type', 'harian');
            $year = $request->get('year', Carbon::now()->year);
            $month = $request->get('month') !== null ? (int)$request->get('month') + 1 : Carbon::now()->month;
            $week = $request->get('week');

            $labels = [];
            $data = [];

            if ($filterType === 'harian') {
                $date = $request->get('date', Carbon::today()->toDateString());
                $labels = ['06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
                $data = array_fill(0, count($labels), 0);

                $visits = BukuTamu::whereDate('created_at', $date)
                    ->selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
                    ->groupBy('hour')->get();

                foreach ($visits as $visit) {
                    $hourStr = str_pad($visit->hour, 2, '0', STR_PAD_LEFT) . ':00';
                    $index = array_search($hourStr, $labels);
                    if ($index !== false) $data[$index] = (int)$visit->count;
                }
            }
            elseif ($filterType === 'mingguan') {
                $labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                $data = array_fill(0, 7, 0);

                // Ambil tanggal 1 di bulan & tahun terpilih
                $startOfSelectedMonth = Carbon::create($year, $month, 1)->startOfDay();

                // Cari awal minggu (Senin) berdasarkan nomor minggu yang dipilih
                // Minggu 1 dimulai dari tanggal 1 bulan tersebut
                $startOfDate = $startOfSelectedMonth->copy()->addWeeks($week - 1)->startOfWeek(Carbon::MONDAY);
                $endOfDate = $startOfDate->copy()->endOfWeek(Carbon::SUNDAY);

                $visits = BukuTamu::whereBetween('created_at', [$startOfDate, $endOfDate])
                    ->selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as count')
                    ->groupBy('day')->get();

                // MySQL DAYOFWEEK: 1=Minggu, 2=Senin, ... 7=Sabtu
                $map = [2 => 0, 3 => 1, 4 => 2, 5 => 3, 6 => 4, 7 => 5, 1 => 6];
                foreach ($visits as $v) {
                    if (isset($map[$v->day])) $data[$map[$v->day]] = (int)$v->count;
                }
            }
            elseif ($filterType === 'bulanan') {
                $daysInMonth = Carbon::create($year, $month)->daysInMonth;
                $labels = range(1, $daysInMonth);
                $data = array_fill(0, $daysInMonth, 0);

                $visits = BukuTamu::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->selectRaw('DAY(created_at) as day, COUNT(*) as count')
                    ->groupBy('day')->get();

                foreach ($visits as $v) {
                    if (isset($data[$v->day - 1])) $data[$v->day - 1] = (int)$v->count;
                }
            }
            else { // Tahunan
                $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                $data = array_fill(0, 12, 0);

                $visits = BukuTamu::whereYear('created_at', $year)
                    ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->groupBy('month')->get();

                foreach ($visits as $v) {
                    if (isset($data[$v->month - 1])) $data[$v->month - 1] = (int)$v->count;
                }
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'labels' => $labels,
                    'datasets' => [[
                        'label' => 'Jumlah Tamu',
                        'data' => $data,
                        'borderColor' => '#3b82f6',
                        'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        'fill' => true,
                        'tension' => 0.4
                    ]]
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
