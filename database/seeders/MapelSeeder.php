<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_mapel')->insert([
            [
                'idmapel' => 1,
                'kodemapel' => 'PABP',
                'namamapel' => 'Pendidikan Agama dan Budi Pekerti',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 2,
                'kodemapel' => 'PP',
                'namamapel' => 'Pendidikan Pancasila',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 3,
                'kodemapel' => 'BIND',
                'namamapel' => 'Bahasa Indonesia',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 4,
                'kodemapel' => 'MAT',
                'namamapel' => 'Matematika',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 5,
                'kodemapel' => 'BING',
                'namamapel' => 'Bahasa Inggris',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 6,
                'kodemapel' => 'SEJ',
                'namamapel' => 'Sejarah',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 7,
                'kodemapel' => 'PJOK',
                'namamapel' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan (PJOK)',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 8,
                'kodemapel' => 'SB',
                'namamapel' => 'Seni dan Budaya',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 9,
                'kodemapel' => 'BSUN',
                'namamapel' => 'Bahasa Sunda',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 10,
                'kodemapel' => 'IPAS',
                'namamapel' => 'Ilmu Pengetahuan Alam dan Sosial',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 11,
                'kodemapel' => 'BPBK',
                'namamapel' => 'Bimbingan Psikologi / Bimbingan Konseling',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 12,
                'kodemapel' => 'INF',
                'namamapel' => 'Informatika',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 19,
                'kodemapel' => 'PKK',
                'namamapel' => 'Produk Kreatif dan Kewirausahaan (PKK)',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 20,
                'kodemapel' => 'P5',
                'namamapel' => 'Projek Penguatan Profil Pelajar Pancasila (P5)',
                'idjurusan' => null,
            ],
            [
                'idmapel' => 13,
                'kodemapel' => 'DK-RPL',
                'namamapel' => 'Dasar-dasar Kejuruan RPL',
                'idjurusan' => 8,
            ],
            [
                'idmapel' => 14,
                'kodemapel' => 'Pem-Web',
                'namamapel' => 'Pemrograman Web',
                'idjurusan' => 8,
            ],
            [
                'idmapel' => 15,
                'kodemapel' => 'Pem-Mobile',
                'namamapel' => 'Pemrograman Perangkat Bergerak',
                'idjurusan' => 8,
            ],
            [
                'idmapel' => 16,
                'kodemapel' => 'Pem-Grafik',
                'namamapel' => 'Pemrograman Grafik',
                'idjurusan' => 8,
            ],
            [
                'idmapel' => 17,
                'kodemapel' => 'DB',
                'namamapel' => 'Basis Data',
                'idjurusan' => 8,
            ],
            [
                'idmapel' => 18,
                'kodemapel' => 'DDG',
                'namamapel' => 'Dasar Desain Grafis',
                'idjurusan' => 8,
            ],
        ]);
    }
}
