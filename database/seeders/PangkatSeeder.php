<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data lama agar tidak duplicate
        DB::table('tbl_pangkat')->truncate();

        // Insert semua data
        DB::table('tbl_pangkat')->insert([
            [
                'idpangkat' => 1,
                'golongan' => 'I/a',
                'pangkat' => 'Juru Muda',
                'jabatan' => '-',
            ],
            [
                'idpangkat' => 2,
                'golongan' => 'I/b',
                'pangkat' => 'Juru Muda Tingkat I',
                'jabatan' => '-',
            ],
            [
                'idpangkat' => 3,
                'golongan' => 'I/c',
                'pangkat' => 'Juru',
                'jabatan' => '-',
            ],
            [
                'idpangkat' => 4,
                'golongan' => 'I/d',
                'pangkat' => 'Juru Tingkat I',
                'jabatan' => '-',
            ],
            [
                'idpangkat' =>5,
                'golongan' => 'II/a',
                'pangkat' => 'Pengatur Muda',
                'jabatan' => '-',
            ],
            [
                'idpangkat' => 6,
                'golongan' => 'II/b',
                'pangkat' => 'Pengatur Muda Tingkat I',
                'jabatan' => '-',
            ],
            [
                'idpangkat' => 7,
                'golongan' => 'II/c',
                'pangkat' => 'Pengatur',
                'jabatan' => '-',
            ],
            [
                'idpangkat' => 8,
                'golongan' => 'II/d',
                'pangkat' => 'Pengatur Tingkat I',
                'jabatan' => '-',
            ],
            [
                'idpangkat' => 9,
                'golongan' => 'III/a',
                'pangkat' => 'Penata Muda',
                'jabatan' => 'Guru Ahli Pertama',
            ],
            [
                'idpangkat' => 10,
                'golongan' => 'III/b',
                'pangkat' => 'Penata Muda Tingkat I',
                'jabatan' => 'Guru Ahli Pertama',
            ],
            [
                'idpangkat' => 11,
                'golongan' => 'III/c',
                'pangkat' => 'Penata',
                'jabatan' => 'Guru Ahli Muda',
            ],
            [
                'idpangkat' => 12,
                'golongan' => 'III/d',
                'pangkat' => 'Penata Tingkat I',
                'jabatan' => 'Guru Ahli Muda',
            ],
            [
                'idpangkat' => 13,
                'golongan' => 'IV/a',
                'pangkat' => 'Pembina',
                'jabatan' => 'Guru Ahli Madya',
            ],
            [
                'idpangkat' => 14,
                'golongan' => 'IV/b',
                'pangkat' => 'Pembina Tingkat I',
                'jabatan' => 'Guru Ahli Madya',
            ],
            [
                'idpangkat' => 15,
                'golongan' => 'IV/c',
                'pangkat' => 'Pembina Utama Muda',
                'jabatan' => 'Guru Ahli Madya',
            ],
            [
                'idpangkat' => 16,
                'golongan' => 'IV/d',
                'pangkat' => 'Pembina Utama Madya',
                'jabatan' => 'Guru Ahli Utama',
            ],
            [
                'idpangkat' => 17,
                'golongan' => 'IV/e',
                'pangkat' => 'Pembina Utama',
                'jabatan' => 'Guru Ahli Utama',
            ],

            [
                'idpangkat' => 18,
                'golongan' => 'IX',
                'pangkat' => 'Ahli Pertama',
                'jabatan' => 'Guru Pertama',
            ],

            [
                'idpangkat' => 19,
                'golongan' => 'X',
                'pangkat' => 'Ahli Pertama',
                'jabatan' => 'Guru Pertama',
            ],


            [
                'idpangkat' => 20,
                'golongan' => 'XI',
                'pangkat' => 'Ahli Muda',
                'jabatan' => 'Guru Muda',
            ],

        ]);
    }
}
