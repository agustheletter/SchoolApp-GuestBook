<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\PegawaiModel;
use App\Models\SiswaModel;

class SyncMasterData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:master-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch master data (Pegawai, Siswa, etc) from Induk Application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting master data synchronization...');

        $apiUrl = config('app.induk_api_url');
        $apiToken = config('app.induk_api_token');

        if (!$apiUrl || !$apiToken) {
            $this->error('Induk API URL or Token is not configured in .env or config/app.php');
            Log::error('Sync failed: Induk API URL or Token is not configured.');
            return 1; // Return error code
        }

        // --- Sync Pegawai ---
        $this->syncPegawai($apiUrl, $apiToken);

        // --- Sync Siswa ---
        $this->syncSiswa($apiUrl, $apiToken);

        // --- Nanti tambahkan sync untuk Jabatan, Ortu, dll di sini ---

        $this->info('Master data synchronization finished successfully!');
        return 0; // Return success code
    }

    private function syncPegawai($apiUrl, $apiToken)
    {
        $this->line('Syncing Pegawai data...');
        $response = Http::withToken($apiToken)->get("{$apiUrl}/pegawai");

        if ($response->failed()) {
            $this->error('Failed to fetch Pegawai data from Induk API.');
            Log::error('Sync Pegawai Failed: ' . $response->body());
            return;
        }

        $pegawaiFromInduk = $response->json()['data'];
        $syncedCount = 0;

        foreach ($pegawaiFromInduk as $data) {
            PegawaiModel::updateOrCreate(
                ['nip' => $data['nip']], // Kunci untuk mencari data yang sudah ada
                $data // Data lengkap untuk di-update atau di-create
            );
            $syncedCount++;
        }

        $this->info("Synced {$syncedCount} Pegawai records.");
    }

    private function syncSiswa($apiUrl, $apiToken)
    {
        $this->line('Syncing Siswa data...');
        // Note: API Induk kamu untuk siswa butuh `idthnajaran`.
        // Untuk sinkronisasi, kita mungkin butuh semua siswa aktif,
        // jadi API di Induk mungkin perlu disesuaikan atau kita looping per tahun ajaran.
        // Asumsi untuk sekarang, kita ambil dari tahun ajaran '1'.
        $response = Http::withToken($apiToken)->get("{$apiUrl}/siswa?idthnajaran=1");

        if ($response->failed()) {
            $this->error('Failed to fetch Siswa data from Induk API.');
            Log::error('Sync Siswa Failed: ' . $response->body());
            return;
        }

        $siswaFromInduk = $response->json()['data'];
        $syncedCount = 0;

        foreach ($siswaFromInduk as $data) {
             // Sesuaikan mapping kolom jika nama kolom di API beda dengan di DB Anak
            SiswaModel::updateOrCreate(
                ['nis' => $data['nis']], // Kunci unik
                $data
            );
            $syncedCount++;
        }

        $this->info("Synced {$syncedCount} Siswa records.");
    }
}
