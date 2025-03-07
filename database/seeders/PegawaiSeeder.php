<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_pegawai')->insert([
            ['nama_pegawai' => 'Budi Santoso', 'id_jabatan' => 1, 'kontak' => '081234567890'],
            ['nama_pegawai' => 'Siti Aisyah', 'id_jabatan' => 2, 'kontak' => '081234567891'],
            ['nama_pegawai' => 'Dedi Permana', 'id_jabatan' => 3, 'kontak' => '081234567892'],
            ['nama_pegawai' => 'Nina Marlina', 'id_jabatan' => 4, 'kontak' => '081234567893'],
            ['nama_pegawai' => 'Andi Saputra', 'id_jabatan' => 5, 'kontak' => '081234567894'],
        ]);
    }
}
