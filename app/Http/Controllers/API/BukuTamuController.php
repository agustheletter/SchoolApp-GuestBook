<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BukuTamu;
use App\Models\OrtuModel;
use App\Models\PegawaiModel;
use App\Models\SiswaModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
        $this->kirimNotifikasiWhatsApp($bukuTamu, $imageUrlForWa);

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
     * Mengambil data pegawai berdasarkan jabatan.
     */
    public function getPegawaiByJabatan($jabatanId)
    {
        $pegawai = PegawaiModel::where('id_jabatan', $jabatanId)->select('idpegawai', 'nama_pegawai')->get();
        return response()->json($pegawai);
    }

    /**
     * Mengambil data orang tua berdasarkan siswa.
     */
    public function getOrangtuaBySiswa($siswaId)
    {
        $orangtua = OrtuModel::where('idsiswa', $siswaId)->first();
        if ($orangtua) {
            return response()->json($orangtua);
        }
        return response()->json(null, 200);
    }

    /**
     * Menyediakan data untuk grafik.
     */
    public function getGrafikData(Request $request)
    {
        // Logika dari controller lama dipindahkan ke sini
        $filter = $request->get('filter', 'hari');
        // ... (seluruh logika grafikData dari controller lama bisa diletakkan di sini)
        // Contoh sederhana untuk filter hari ini
        $data = BukuTamu::select(DB::raw("HOUR(created_at) as jam"), DB::raw("count(*) as jumlah"))
            ->whereDate('created_at', Carbon::today())
            ->groupBy('jam')
            ->get();

        return response()->json(['success' => true, 'filter' => $filter, 'data' => $data]);
    }

    /**
     * Logika untuk mengirim notifikasi WhatsApp.
     */
    private function kirimNotifikasiWhatsApp(BukuTamu $bukuTamu, $imageUrl = null)
    {
        $apiKey = env('FONNTE_API_KEY');
        if (!$apiKey) {
            Log::warning('FONNTE_API_KEY tidak disetel.');
            return;
        }

        $pegawai = $bukuTamu->pegawai;
        if (!$pegawai || empty($pegawai->kontak)) {
            Log::warning("Pegawai dengan ID {$bukuTamu->id_pegawai} tidak ditemukan atau tidak punya kontak.");
            return;
        }

        $nomor = ltrim($pegawai->kontak, '0');
        if (!str_starts_with($nomor, '62')) {
            $nomor = '62' . $nomor;
        }

        // Kirim foto jika ada
        if ($imageUrl) {
            Http::withHeaders(['Authorization' => $apiKey])
                ->post('https://api.fonnte.com/send', [
                    'target' => $nomor,
                    'url' => url($imageUrl), // Pastikan URL dapat diakses publik
                    'message' => "Assalamualaikum Bapak/Ibu {$pegawai->nama_pegawai}, ini adalah foto tamu Anda. Informasi lengkapnya akan menyusul.",
                ]);
        }

        // Kirim pesan teks
        $pesanTeks = "Assalamualaikum Bapak/Ibu {$pegawai->nama_pegawai},\n\n"
            . "Ada tamu yang ingin bertemu dengan Anda sedang menunggu di Resepsionis.\n\n";

        if ($bukuTamu->role == 'ortu') {
            $pesanTeks .= "Nama Tamu: *{$bukuTamu->nama}*.\n"
                . "Orang tua dari siswa: *{$bukuTamu->siswa->namasiswa}*.\n";
        } else {
            $pesanTeks .= "Nama Tamu: *{$bukuTamu->nama}*.\n"
                . "Asal Instansi: *{$bukuTamu->instansi}*.\n";
        }

        $pesanTeks .= "Kontak Tamu: *{$bukuTamu->kontak}*.\n\n"
            . "Keperluan: {$bukuTamu->keperluan}\n"
            . "Waktu: " . $bukuTamu->created_at->format('d F Y, H:i') . " WIB\n\n"
            . "Terima kasih.";

        $response = Http::withHeaders(['Authorization' => $apiKey])
            ->post('https://api.fonnte.com/send', [
                'target' => $nomor,
                'message' => $pesanTeks,
            ]);

        Log::info('Fonnte Message Response: ' . $response->body());
    }
}
