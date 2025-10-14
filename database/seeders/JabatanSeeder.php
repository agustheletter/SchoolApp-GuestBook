<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Hapus semua data lama
        DB::table('tbl_jabatan')->truncate();

        // inserta data ke database
        DB::table('tbl_jabatan')->insert([
            [
                'idjabatan' => 1,
                'jabatan' => 'Kepala Sekolah',
            ],
            [
                'idjabatan' => 2,
                'jabatan' => 'Wakil Kepala Sekolah',
            ],
            [
                'idjabatan' => 3,
                'jabatan' => 'Guru',
            ],
            [
                'idjabatan' => 4,
                'jabatan' => 'Tata Usaha',
            ],
            [
                'idjabatan' => 5,
                'jabatan' => 'Keamanan',
            ],
            [
                'idjabatan' => 6,
                'jabatan' => 'Caraka',
            ],

        ]);
    }
}
