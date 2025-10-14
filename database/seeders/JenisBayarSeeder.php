<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisBayarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_jenisbayar')->insert([
            [
                'idjenisbayar' => 1,
                'kodejenisbayar' => 'SPP',
                'jenisbayar' => "Sumbangan Pembinaan Pendidikan (SPP)",
                'periode' => 'Bulanan',
            ],
            [
                'idjenisbayar' => 2,
                'kodejenisbayar' => 'DSP',
                'jenisbayar' => "Dana Sumbangan Pendidikan (DSP)",
                'periode' => 'Cicilan',
            ],
            [
                'idjenisbayar' => 3,
                'kodejenisbayar' => 'KW',
                'jenisbayar' => "Karya Wisata",
                'periode' => 'Cicilan',
            ],
            [
                'idjenisbayar' => 4,
                'kodejenisbayar' => 'WSD',
                'jenisbayar' => "Wisuda",
                'periode' => 'Cicilan',
            ],
        ]);
    }
}
