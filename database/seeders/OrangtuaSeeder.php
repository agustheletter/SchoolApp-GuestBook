<?php

namespace Database\Seeders;

use App\Models\Orangtua;
use App\Models\SiswaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrangtuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswaList = SiswaModel::orderBy('idsiswa')->get();

        if ($siswaList->isEmpty()) {
            $this->command->warn('Tidak ada data siswa. Seeder Orangtua dilewati.');
            return;
        }

        $no = 1;
        foreach ($siswaList as $siswa) {
            Orangtua::create([
                'nama_ortu' => 'Orang Tua ' . $no++,
                'jenis_kelamin' => (rand(0,1) ? 'Laki-laki' : 'Perempuan'),
                'idsiswa' => $siswa->idsiswa,
                'kontak' => '08' . rand(1000000000, 9999999999),
            ]);
        }
    }
}
