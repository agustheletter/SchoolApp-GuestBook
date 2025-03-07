<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_siswa')->insert([
            ['nis' => '2025020001', 'nisn' => '0120250001', 'namasiswa' => 'Adrenalin Muhammad Dewangga', 'tempatlahir' => 'Cimahi', 'tgllahir' => '2007-11-21', 'jk' => 'L', 'alamat' => 'Jl. Maleber Barat No.208', 'idagama' => 1, 'tlprumah' => '088222134661', 'hpsiswa' => '088222134661', 'photosiswa' => '', 'idthnmasuk' => 1],

            ['nis' => '2025020002', 'nisn' => '0120250002', 'namasiswa' => 'Evliya Satari Nurarifah', 'tempatlahir' => 'Cimahi', 'tgllahir' => '2008-7-21', 'jk' => 'P', 'alamat' => 'Jl. Gak tau No.Berapa ya', 'idagama' => 1, 'tlprumah' => '12345654321', 'hpsiswa' => '65432123456', 'photosiswa' => '', 'idthnmasuk' => 1],
        ]);
    }
}
