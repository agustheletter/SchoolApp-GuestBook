<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_pegawai')->insert([
            ['nama_pegawai' => 'Budi Santosa', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 1, 'id_agama' => 1, 'kontak' => '081234567890'],
            ['nama_pegawai' => 'Siti Aisyah', 'jenis_kelamin' => 'Perempuan', 'id_jabatan' => 2, 'id_agama' => 1, 'kontak' => '081234567891'],
            ['nama_pegawai' => 'Dedi Permana', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 3, 'id_agama' => 2, 'kontak' => '081234567892'],
            ['nama_pegawai' => 'Nina Marlina', 'jenis_kelamin' => 'Perempuan', 'id_jabatan' => 4, 'id_agama' => 1, 'kontak' => '081234567893'],
            ['nama_pegawai' => 'Andi Saputra', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 5, 'id_agama' => 3, 'kontak' => '081234567894'],
            ['nama_pegawai' => 'Ahmad Perkasa', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 3, 'id_agama' => 1, 'kontak' => '081234567895'],
            ['nama_pegawai' => 'Dina Surlina', 'jenis_kelamin' => 'Perempuan', 'id_jabatan' => 4, 'id_agama' => 1, 'kontak' => '081234567896'],
        ]);
    }
}
