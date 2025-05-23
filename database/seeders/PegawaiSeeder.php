<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        DB::table('tbl_pegawai')->insert([
            ['nama_pegawai' => 'Agus Priyatmono Nugroho', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 1, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Agus Rahmawan', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 3, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Yuli Pamungkas', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 3, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Agus Suratna Permadi', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 3, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Chandra Hardiawan', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 3, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Siti Maryam', 'jenis_kelamin' => 'Perempuan', 'id_jabatan' => 3, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Indra Yusiana', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 3, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Erwin', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 2, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Farid Mulyana', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 2, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Tresna Yogaswara', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 2, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Suyadi', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 4, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Mimin Kurniasih', 'jenis_kelamin' => 'Perempuan', 'id_jabatan' => 4, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Imron Rosadi', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 4, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Iwan Wartiyah', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 4, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Rudi Wardoyo', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 4, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Marti', 'jenis_kelamin' => 'Perempuan', 'id_jabatan' => 4, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Fiska Farida Rustandi', 'jenis_kelamin' => 'Perempuan', 'id_jabatan' => 4, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Oman', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 4, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Dedi Hadiansyah', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 4, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Jayanti Mandalasari', 'jenis_kelamin' => 'Perempuan', 'id_jabatan' => 4, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Ahmad Suherman', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 6, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Cecep Saripuloh', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 6, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Didin Saefudin', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 6, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Dandi Kiki Andrian', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 6, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Fajar Hidayah', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 6, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Muhammad Toha', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 6, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Cecep Wahyudin', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 6, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Herry Sudaryan', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 5, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Wahyu Nur Hidayat', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 5, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Peltu Budima', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 5, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Kustiana', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 5, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Rosadi', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 5, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Nunu Isya Ansori', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 5, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Agus Tatang', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 5, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
            ['nama_pegawai' => 'Andri', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 5, 'id_agama' => 1, 'kontak' => $faker->numerify('08##########')],
        ]);
    }
}
