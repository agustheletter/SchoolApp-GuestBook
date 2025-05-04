<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuTamuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_bukutamu')->insert([
            [
                'id' => 1,
                'nama' => 'Andriana',
                'role' => 'umum',
                'idagama' => 1,
                'idsiswa' => null,
                'instansi' => 'SMK Negeri 999 Jakarta',
                'alamat' => 'Jl. Kota Tua Jakarta No.777',
                'kontak' => 'smkn999jakarta@jakarta.sch.id',
                'id_jabatan' => 5,
                'id_pegawai' => 5,
                'keperluan' => 'Collaboration',
                'deleted_at' => null,
                'created_at' => '2025-03-06 03:51:02',
                'updated_at' => '2025-03-07 09:55:28',
            ],
            [
                'id' => 2,
                'nama' => 'Tamu 1',
                'role' => 'umum',
                'idagama' => 1,
                'idsiswa' => null,
                'instansi' => 'SMK Negeri 1 Bandung',
                'alamat' => 'Bandung',
                'kontak' => '08123321222',
                'id_jabatan' => 1,
                'id_pegawai' => 1,
                'keperluan' => 'Mabar',
                'deleted_at' => null,
                'created_at' => '2025-03-06 22:32:44',
                'updated_at' => '2025-03-06 22:32:44',
            ],
            [
                'id' => 3,
                'nama' => 'Orang Tua 1',
                'role' => 'ortu',
                'idagama' => 1,
                'idsiswa' => 1,
                'instansi' => null,
                'alamat' => 'Gatau',
                'kontak' => 'orangtua1@gmail.com',
                'id_jabatan' => 4,
                'id_pegawai' => 4,
                'keperluan' => 'Konsultasi',
                'deleted_at' => null,
                'created_at' => '2025-03-07 00:02:29',
                'updated_at' => '2025-03-07 00:02:29',
            ],
        ]);
    }
}
