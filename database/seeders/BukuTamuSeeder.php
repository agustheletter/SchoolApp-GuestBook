<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuTamuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_bukutamu')->insert([
            [
                'id' => 1,
                'nama' => 'Lina Suryani',
                'role' => 'umum',
                'idsiswa' => null,
                'instansi' => 'PT. Tech Solutions',
                'alamat' => 'Jl. Raya No. 10, Jakarta Pusat, DKI Jakarta',
                'kontak' => 'andriana.suryani@techsolutions.com',
                'id_jabatan' => 5,
                'id_pegawai' => 5,
                'keperluan' => 'Pertemuan terkait kolaborasi proyek baru.',
                'deleted_at' => null,
                'created_at' => '2025-03-06 03:51:02',
                'updated_at' => '2025-03-07 09:55:28',
            ],
            [
                'id' => 2,
                'nama' => 'Timothy Ronald',
                'role' => 'umum',
                'idsiswa' => null,
                'instansi' => 'PT. Global Trading',
                'alamat' => 'Jl. Merdeka No.45, Bandung, Jawa Barat',
                'kontak' => 'tamu1@globaltrading.com',
                'id_jabatan' => 1,
                'id_pegawai' => 1,
                'keperluan' => 'Demo produk dan pembahasan kerjasama bisnis.',
                'deleted_at' => null,
                'created_at' => '2025-03-06 22:32:44',
                'updated_at' => '2025-03-06 22:32:44',
            ],
            [
                'id' => 3,
                'nama' => 'Orang Tua 1',
                'role' => 'ortu',
                'idsiswa' => 1,
                'instansi' => null,
                'alamat' => 'Jl. Kemuning No. 20, Surabaya, Jawa Timur',
                'kontak' => 'budi.santoso@gmail.com',
                'id_jabatan' => 4,
                'id_pegawai' => 4,
                'keperluan' => 'Konsultasi mengenai perkembangan akademis anak saya.',
                'deleted_at' => null,
                'created_at' => '2025-03-07 00:02:29',
                'updated_at' => '2025-03-07 00:02:29',
            ],
        ]);
    }

}
