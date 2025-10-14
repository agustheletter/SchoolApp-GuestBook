<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TingkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data lama
        DB::table('tbl_tingkat')->truncate();

        // insert data ke dtabase
        DB::table('tbl_tingkat')->insert([
            [
                'idtingkat' => 1,
                'tingkat' => 'X',
            ],
            [
                'idtingkat' => 2,
                'tingkat' => 'XI',
            ],
            [
                'idtingkat' => 3,
                'tingkat' => 'XII',
            ],
            [
                'idtingkat' => 4,
                'tingkat' => 'XIII',
            ],
        ]);
    }
}
