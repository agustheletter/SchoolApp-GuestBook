<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_jabatan')->insert([
            ['nama_jabatan' => 'Kepala Sekolah'],
            ['nama_jabatan' => 'Wakil Kepala Sekolah'],
            ['nama_jabatan' => 'Guru'],
            ['nama_jabatan' => 'Tata Usaha'],
            ['nama_jabatan' => 'Keamanan'],
            ['nama_jabatan' => 'Caraka'],
        ]);
    }
}
