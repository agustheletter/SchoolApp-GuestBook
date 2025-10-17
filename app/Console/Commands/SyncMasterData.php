<?php

namespace App\Console\Commands;

use App\Models\KelasDetailModel;
use App\Models\KelasModel;
use App\Models\OrtuModel;
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
    protected $description = 'Fetch all master data from a single Induk API endpoint';

    public function handle()
    {
        $this->info('Starting unified master data synchronization...');
        $apiUrl = config('app.induk_api_url');
        $apiToken = config('app.induk_api_token');

        if (!$apiUrl || !$apiToken) {
            $this->error('Induk API URL or Token is not configured.');
            return 1;
        }

        // ========================= PERUBAHAN UTAMA: SATU API CALL =========================
        $this->line("Fetching all master data from {$apiUrl}/bukutamu-base...");
        $response = Http::withToken($apiToken)->get("{$apiUrl}/bukutamu-base");

        if ($response->failed()) {
            $this->error('Failed to fetch master data from Induk API.');
            Log::error('Unified Sync Failed: ' . $response->body());
            return 1;
        }

        $allData = $response->json()['data'] ?? [];
        if (empty($allData)) {
            $this->warn('No data received from the main Induk API endpoint.');
            return 0;
        }

        $this->info('Successfully received data from Induk. Starting sync process...');

        // Panggil fungsi proses untuk setiap jenis data
        $this->processData('Pegawai', PegawaiModel::class, $allData['pegawai'] ?? [], 'idpegawai');
        $this->processData('Siswa', SiswaModel::class, $allData['siswa'] ?? [], 'idsiswa');
        $this->processData('Kelas', KelasModel::class, $allData['kelas'] ?? [], 'idkelas');
        $this->processData('KelasDetail', KelasDetailModel::class, $allData['kelas_detail'] ?? [], 'idkelasdetail');
        $this->processData('SiswaKelas', SiswaKelasModel::class, $allData['siswa_kelas'] ?? [], 'idsiswakelas');
        $this->processData('TahunAjaran', TahunAjaranModel::class, $allData['tahun_ajaran'] ?? [], 'idthnajaran');
        $this->processData('OrangTua', OrtuModel::class, $allData['orang_tua'] ?? [], 'idortu');

        $this->info('Master data synchronization finished successfully!');
        return 0;
    }

    /**
     * Fungsi generik untuk memproses dan menyinkronkan data.
     *
     * @param string $modelName Nama model untuk logging (e.g., 'Siswa')
     * @param string $modelClass Class dari model (e.g., SiswaModel::class)
     * @param array $dataFromApi Array data dari API
     * @param string $uniqueKey Kunci unik untuk updateOrCreate (e.g., 'idsiswa')
     */
    private function processData(string $modelName, string $modelClass, array $dataFromApi, string $uniqueKey)
    {
        $this->line("Syncing {$modelName} data...");

        if (empty($dataFromApi)) {
            $this->warn("No {$modelName} data received.");
            return;
        }

        $uniqueData = collect($dataFromApi)->unique($uniqueKey)->values();
        $totalReceived = count($dataFromApi);
        $totalUnique = count($uniqueData);
        $duplicatesFound = $totalReceived - $totalUnique;

        $this->info("Received {$totalReceived} {$modelName} records, found {$totalUnique} unique records.");
        if ($duplicatesFound > 0) {
            $this->warn("Skipping {$duplicatesFound} duplicate {$uniqueKey} records for {$modelName}.");
        }

        $syncedCount = 0;
        $errorCount = 0;

        foreach ($uniqueData as $item) {
            try {
                // Sanitasi tanggal khusus untuk model OrangTua
                if ($modelClass === OrtuModel::class) {
                    $item['tgllahir_ayah'] = (strtotime($item['tgllahir_ayah']) > 0) ? $item['tgllahir_ayah'] : null;
                    $item['tgllahir_ibu'] = (strtotime($item['tgllahir_ibu']) > 0) ? $item['tgllahir_ibu'] : null;
                    $item['tgllahir_wali'] = (strtotime($item['tgllahir_wali']) > 0) ? $item['tgllahir_wali'] : null;
                }

                $modelClass::updateOrCreate(
                    [$uniqueKey => $item[$uniqueKey]],
                    $item
                );
                $syncedCount++;
            } catch (Exception $e) {
                $this->error("Failed to sync {$modelName} with ID: {$item[$uniqueKey]}. Error: " . $e->getMessage());
                Log::error("Failed to sync {$modelName} with ID: {$item[$uniqueKey]}", ['error' => $e->getMessage()]);
                $errorCount++;
            }
        }

        $this->info("Successfully synced {$syncedCount} {$modelName} records.");
        if ($errorCount > 0) {
            $this->warn("There were {$errorCount} errors during {$modelName} sync. Check laravel.log for details.");
        }
    }
}

