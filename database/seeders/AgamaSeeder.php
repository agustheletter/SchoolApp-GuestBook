<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Hapus semua data lama
        DB::table('tbl_agama')->truncate();

        // inserta data ke database
        DB::table('tbl_agama')->insert([
            [
                'idagama' => 1,
                'agama' => 'Islam',
            ],
            [
                'idagama' => 2,
                'agama' => 'Protestan',
            ],
            [
                'idagama' => 3,
                'agama' => 'Katolik',
            ],
            [
                'idagama' => 4,
                'agama' => 'Hindu',
            ],
            [
                'idagama' => 5,
                'agama' => 'Budha',
            ],
            [
                'idagama' => 6,
                'agama' => 'Konghucu',
            ],
            [
                'idagama' => 7,
                'agama' => 'Lainnya',
            ],
        ]);
    }
}
