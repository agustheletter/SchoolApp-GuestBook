<?php

namespace App\Console\Commands;

use App\Models\KelasDetailModel;
use App\Models\KelasModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\PegawaiModel;
use App\Models\SiswaKelasModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;
use Exception;

class SyncMasterData extends Command
{
    protected $signature = 'sync:master-data';
    protected $description = 'Fetch master data (Pegawai, Siswa, etc) from Induk Application';

    public function handle()
    {
        $this->info('Starting master data synchronization...');
        $apiUrl = config('app.induk_api_url');
        $apiToken = config('app.induk_api_token');

        if (!$apiUrl || !$apiToken) {
            $this->error('Induk API URL or Token is not configured in .env or config/app.php');
            Log::error('Sync failed: Induk API URL or Token is not configured.');
            return 1;
        }

        $this->syncPegawai($apiUrl, $apiToken);
        $this->syncSiswa($apiUrl, $apiToken);
        $this->syncAcademicData($apiUrl, $apiToken);

        $this->info('Master data synchronization finished!');
        return 0;
    }

    private function syncPegawai($apiUrl, $apiToken)
    {
        $this->line('Syncing Pegawai data...');
        $response = Http::withToken($apiToken)->get("{$apiUrl}/pegawai");
        if ($response->failed()) {
            $this->error('Failed to fetch Pegawai data from Induk API.');
            return;
        }

        $pegawaiFromInduk = $response->json()['data'] ?? [];
        if (empty($pegawaiFromInduk)) {
            $this->warn('No Pegawai data received from Induk API.');
            return;
        }

        // PERUBAHAN: Saring data duplikat berdasarkan 'idpegawai'
        $uniquePegawai = collect($pegawaiFromInduk)->unique('idpegawai')->values();
        $totalReceived = count($pegawaiFromInduk);
        $totalUnique = count($uniquePegawai);
        $duplicatesFound = $totalReceived - $totalUnique;

        $this->info("Received {$totalReceived} Pegawai records, found {$totalUnique} unique records.");
        if ($duplicatesFound > 0) {
            $this->warn("Skipping {$duplicatesFound} duplicate IDPEGAWAI records.");
        }

        $syncedCount = 0;
        foreach ($uniquePegawai as $data) {
            try {
                PegawaiModel::updateOrCreate(
                    ['idpegawai' => $data['idpegawai']], // Kunci diubah ke idpegawai
                    $data
                );
                $syncedCount++;
            } catch(Exception $e) {
                $this->error("Failed to sync Pegawai with ID: {$data['idpegawai']}. Error: " . $e->getMessage());
                Log::error("Failed to sync Pegawai with ID: {$data['idpegawai']}", ['error' => $e->getMessage()]);
            }
        }
        $this->info("Successfully synced {$syncedCount} Pegawai records.");
    }

    private function syncSiswa($apiUrl, $apiToken)
    {
        $this->line('Syncing Siswa data...');
        $response = Http::withToken($apiToken)->get("{$apiUrl}/siswa");

        if ($response->failed()) {
            $this->error('Failed to fetch Siswa data from Induk API.');
            Log::error('Sync Siswa Failed: ' . $response->body());
            return;
        }

        $siswaFromInduk = $response->json()['data'] ?? [];
        if (empty($siswaFromInduk)) {
            $this->warn('No Siswa data received from Induk API.');
            return;
        }

        // ========================= PERUBAHAN UTAMA DI SINI =========================
        // 1. Saring data duplikat berdasarkan 'idsiswa'.
        $uniqueSiswa = collect($siswaFromInduk)->unique('idsiswa')->values();

        $totalReceived = count($siswaFromInduk);
        $totalUnique = count($uniqueSiswa);
        $duplicatesFound = $totalReceived - $totalUnique;

        $this->info("Received {$totalReceived} Siswa records from Induk, found {$totalUnique} unique records to sync.");
        if ($duplicatesFound > 0) {
            $this->warn("Skipping {$duplicatesFound} duplicate IDSISWA records from Induk.");
        }
        // ===========================================================================

        $syncedCount = 0;
        $errorCount = 0;

        // 2. Lakukan perulangan pada data yang SUDAH unik.
        foreach ($uniqueSiswa as $data) {
            try {
                if (empty($data['idsiswa'])) {
                    $this->warn("Skipping record with empty IDSISWA. Data: " . json_encode($data));
                    Log::warning('Skipping siswa record with empty IDSISWA', $data);
                    $errorCount++;
                    continue;
                }

                SiswaModel::updateOrCreate(
                    ['idsiswa' => $data['idsiswa']], // Kunci diubah ke idsiswa
                    $data
                );
                $syncedCount++;

            } catch (Exception $e) {
                $this->error("Failed to sync Siswa with ID: {$data['idsiswa']}. Error: " . $e->getMessage());
                Log::error("Failed to sync Siswa with ID: {$data['idsiswa']}", [
                    'error' => $e->getMessage(),
                    'data' => $data
                ]);
                $errorCount++;
            }
        }

        // 3. Sekarang, laporan `syncedCount` akan akurat.
        $this->info("Successfully synced {$syncedCount} Siswa records.");
        if ($errorCount > 0) {
            $this->warn("There were {$errorCount} errors during Siswa sync. Check laravel.log for details.");
        }
    }

    private function syncAcademicData($apiUrl, $apiToken)
    {
        $this->line('Syncing Academic data...');
        $response = Http::withToken($apiToken)->get("{$apiUrl}/academic-data");

        if ($response->failed()) {
            $this->error('Failed to fetch Academic data from Induk API.');
            Log::error('Sync Academic Data Failed: ' . $response->body());
            return;
        }

        $data = $response->json()['data'] ?? [];

        // Sync Kelas
        $kelasData = collect($data['kelas'] ?? [])->unique('idkelas')->values();
        $this->info("Received " . count($kelasData) . " Kelas records.");
        foreach ($kelasData as $item) {
            KelasModel::updateOrCreate(['idkelas' => $item['idkelas']], $item);
        }
        $this->info("Synced " . count($kelasData) . " Kelas records.");

        // Sync KelasDetail
        $kelasDetailData = collect($data['kelas_detail'] ?? [])->unique('idkelasdetail')->values();
        $this->info("Received " . count($kelasDetailData) . " KelasDetail records.");
        foreach ($kelasDetailData as $item) {
            KelasDetailModel::updateOrCreate(['idkelasdetail' => $item['idkelasdetail']], $item);
        }
        $this->info("Synced " . count($kelasDetailData) . " KelasDetail records.");

        // Sync SiswaKelas
        $siswaKelasData = collect($data['siswa_kelas'] ?? [])->unique('idsiswakelas')->values();
        $this->info("Received " . count($siswaKelasData) . " SiswaKelas records.");
        foreach ($siswaKelasData as $item) {
            SiswaKelasModel::updateOrCreate(['idsiswakelas' => $item['idsiswakelas']], $item);
        }
        $this->info("Synced " . count($siswaKelasData) . " SiswaKelas records.");

        // ========================= TAMBAHAN BARU =========================
        // Sync TahunAjaran
        $thnAjaranData = collect($data['tahun_ajaran'] ?? [])->unique('idthnajaran')->values();
        $this->info("Received " . count($thnAjaranData) . " TahunAjaran records.");
        foreach ($thnAjaranData as $item) {
            TahunAjaranModel::updateOrCreate(['idthnajaran' => $item['idthnajaran']], $item);
        }
        $this->info("Synced " . count($thnAjaranData) . " TahunAjaran records.");
        // =================================================================
    }
}

