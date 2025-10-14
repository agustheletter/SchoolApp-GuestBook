<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisBayarDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_jenisbayardetail')->insert([
            [
                'idjenisbayardetail' => 1,
                'idjenisbayar' => 1,
                'idtingkat' => 1,
                'idthnajaran' => 4,
                'nominaljenisbayar' => 50000,
            ],

            [
                'idjenisbayardetail' => 2,
                'idjenisbayar' => 1,
                'idtingkat' => 2,
                'idthnajaran' => 4,
                'nominaljenisbayar' => 100000,
            ],

            [
                'idjenisbayardetail' => 3,
                'idjenisbayar' => 1,
                'idtingkat' => 3,
                'idthnajaran' => 4,
                'nominaljenisbayar' => 150000,
            ],

            [
                'idjenisbayardetail' => 4,
                'idjenisbayar' => 1,
                'idtingkat' => 1,
                'idthnajaran' => 4,
                'nominaljenisbayar' => 200000,
            ],

            [
                'idjenisbayardetail' => 5,
                'idjenisbayar' => 2,
                'idtingkat' => 1,
                'idthnajaran' => 4,
                'nominaljenisbayar' => 5000000,
            ],
        ]);
    }
}
