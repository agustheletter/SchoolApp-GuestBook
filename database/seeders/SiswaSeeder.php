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
            [
                'nis' => '2025020001',
                'nisn' => '0120250001',
                'namasiswa' => 'Adrenalin Muhammad Dewangga',
                'tempatlahir' => 'Cimahi',
                'tgllahir' => '2007-11-21',
                'jk' => 'L',
                'alamat' => 'Jl. Pasteur No. 37, Bandung',
                'idagama' => 1,
                'tlprumah' => '088222134661',
                'hpsiswa' => '088222134661',
                'photosiswa' => '1746523062_adre.jpg',
                'idthnmasuk' => 1
            ],
            [
                'nis' => '2025020002',
                'nisn' => '0120250002',
                'namasiswa' => 'Evliya Satari Nurarifah',
                'tempatlahir' => 'Cimahi',
                'tgllahir' => '2008-7-04',
                'jk' => 'P',
                'alamat' => 'Jl. Juanda No. 91, Cimahi',
                'idagama' => 1,
                'tlprumah' => '081222678810',
                'hpsiswa' => '081222678810',
                'photosiswa' => '1746523063_evliya.jpg',
                'idthnmasuk' => 1
            ],
        ]);
    }
}
