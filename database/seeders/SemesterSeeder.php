<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data lama
        DB::table('tbl_semester')->truncate();

        // insert data ke dtabase
        DB::table('tbl_semester')->insert([
            [
                'idsemester' => 1,
                'semester' => 'Semester 1',
                'keterangan' => 'Ganjil',
            ],
            [
                'idsemester' => 2,
                'semester' => 'Semester 2',
                'keterangan' => 'Genap',
            ],
            [
                'idsemester' => 3,
                'semester' => 'Semester 3',
                'keterangan' => 'Ganjil',
            ],
            [
                'idsemester' => 4,
                'semester' => 'Semester 4',
                'keterangan' => 'Genap',
            ],
            [
                'idsemester' => 5,
                'semester' => 'Semester 5',
                'keterangan' => 'Ganjil',
            ],
            [
                'idsemester' => 6,
                'semester' => 'Semester 6',
                'keterangan' => 'Genap',
            ],
            [
                'idsemester' => 7,
                'semester' => 'Semester 7',
                'keterangan' => 'Ganjil',
            ],
            [
                'idsemester' => 8,
                'semester' => 'Semester 8',
                'keterangan' => 'Genap',
            ],
        ]);
    }
}
