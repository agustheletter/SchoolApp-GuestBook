<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data lama
        DB::table('tbl_bulan')->truncate();

        // insert data ke dtabase
        DB::table('tbl_bulan')->insert([
            [
                'idbulan' => 1,
                'namabulan' => 'Juli',
            ],
            [
                'idbulan' => 2,
                'namabulan' => 'Agustus',
            ],
            [
                'idbulan' => 3,
                'namabulan' => 'September',
            ],
            [
                'idbulan' => 4,
                'namabulan' => 'Oktober',
            ],
            [
                'idbulan' => 5,
                'namabulan' => 'Nopember',
            ],
            [
                'idbulan' => 6,
                'namabulan' => 'Desember',
            ],
            [
                'idbulan' => 7,
                'namabulan' => 'Januari',
            ],
            [
                'idbulan' => 8,
                'namabulan' => 'Pebruari',
            ],
            [
                'idbulan' => 9,
                'namabulan' => 'Maret',
            ],
            [
                'idbulan' => 10,
                'namabulan' => 'April',
            ],
            [
                'idbulan' => 11,
                'namabulan' => 'Mei',
            ],
            [
                'idbulan' => 12,
                'namabulan' => 'Juni',
            ],

        ]);
    }
}
