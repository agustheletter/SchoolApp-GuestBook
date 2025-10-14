<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create('id_ID');
        // for($i = 1; $i <= 100; $i++){
        //     // insert data ke table siswa
        //     \DB::table('tbl_jurusan')->insert([
        //         'idjurusan' => $faker->numberBetween(901,1000),
        //         'jurusan' => $faker->company
        //     ]);
        // }

        // Hapus semua data lama
        DB::table('tbl_jurusan')->truncate();

        // insert data ke dtabase
        DB::table('tbl_jurusan')->insert([

            [
                'idjurusan' => 1,
                'kodejurusan' => 'TOI',
                'namajurusan' => 'Teknik Otomasi Industri',
                'idprogramkeahlian' => 1,
            ],

            [
                'idjurusan' => 2,
                'kodejurusan' => 'TPTUP',
                'namajurusan' => "Teknik Pemanasan, Tata Udara, dan Pendinginan (Heating, Ventilation, and Air Conditioning)",
                'idprogramkeahlian' => 2,
            ],

            [
                'idjurusan' => 3,
                'kodejurusan' => 'TEI',
                'namajurusan' => 'Teknik Elektronika Industri',
                'idprogramkeahlian' => 1,
            ],

            [
                'idjurusan' => 4,
                'kodejurusan' => 'TEK',
                'namajurusan' => 'Teknik Elektronika Komunikasi',
                'idprogramkeahlian' => 1,
            ],

            [
                'idjurusan' => 5,
                'kodejurusan' => 'MEKA',
                'namajurusan' => 'Teknik Mekatronika',
                'idprogramkeahlian' => 1,
            ],

            [
                'idjurusan' => 6,
                'kodejurusan' => 'IOP',
                'namajurusan' => 'Instrumentasi dan Otomatisasi Proses',
                'idprogramkeahlian' => 1,
            ],

            [
                'idjurusan' => 7,
                'kodejurusan' => 'SIJA',
                'namajurusan' => 'Sistem Informasi, Jaringan, dan Aplikasi',
                'idprogramkeahlian' => 3,
            ],
            [
                'idjurusan' => 8,
                'kodejurusan' => 'RPL',
                'namajurusan' => 'Rekayasa Perangkat Lunak',
                'idprogramkeahlian' => 3,
            ],
            [
                'idjurusan' => 9,
                'kodejurusan' => 'PSPT',
                'namajurusan' => 'Produksi dan Siaran Program Televisi',
                'idprogramkeahlian' => 4,
            ],

        ]);
    }
}
