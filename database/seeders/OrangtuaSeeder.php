<?php

namespace Database\Seeders;

use App\Models\Orangtua;
use App\Models\SiswaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrangtuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Otomatis
        // $faker = Faker::create();
        // $faker = Faker::create('id_ID'); // ← Locale Indonesia

        // $siswaList = SiswaModel::orderBy('idsiswa')->get();

        // if ($siswaList->isEmpty()) {
        //     $this->command->warn('Tidak ada data siswa. Seeder Orangtua dilewati.');
        //     return;
        // }

        // $no = 1;
        // foreach ($siswaList as $siswa) {
        //     if (!Orangtua::where('idsiswa', $siswa->idsiswa)->exists()) {
        //         Orangtua::create([
        //             'nama_ortu'     => 'Orang Tua ' . $no++,
        //             'jenis_kelamin' => (rand(0,1) ? 'Laki-laki' : 'Perempuan'),
        //             'idsiswa'       => $siswa->idsiswa,
        //             'kontak'        => '08' . rand(1000000000, 9999999999),
        //             'alamat'        => 'Jl. ' . $faker->streetName . ' No. ' . rand(1, 100) . ', ' . $faker->city,
        //         ]);
        //     }
        // }

        // Data Manual
        Orangtua::create([
            'nama_ortu'     => 'Orang Tua 1',
            'jenis_kelamin' => 'Perempuan',
            'idsiswa'       => 1,
            'kontak'        => '0812345678901',
            'alamat'        => 'Jl. Pasteur No. 37, Bandung',
        ]);

        Orangtua::create([
            'nama_ortu'     => 'Orang Tua 2',
            'jenis_kelamin' => 'Perempuan',
            'idsiswa'       => 2,
            'kontak'        => '0812345678902',
            'alamat'        => 'Jl. Juanda No. 91, Cimahi',
        ]);
    }
}
