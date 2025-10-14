<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data lama
        DB::table('tbl_kelasdetail')->truncate();

        // Insert data ke database
        DB::table('tbl_kelasdetail')->insert([
            ['idkelasdetail' => 1, 'idkelas' => 1, 'idthnajaran' => 4, 'idpegawai' => 51, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 2, 'idkelas' => 2, 'idthnajaran' => 4, 'idpegawai' => 4, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 3, 'idkelas' => 4, 'idthnajaran' => 4, 'idpegawai' => 93, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 4, 'idkelas' => 5, 'idthnajaran' => 4, 'idpegawai' => 120, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 5, 'idkelas' => 7, 'idthnajaran' => 4, 'idpegawai' => 105, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 6, 'idkelas' => 8, 'idthnajaran' => 4, 'idpegawai' => 98, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 7, 'idkelas' => 10, 'idthnajaran' => 4, 'idpegawai' => 89, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 8, 'idkelas' => 11, 'idthnajaran' => 4, 'idpegawai' => 104, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 9, 'idkelas' => 13, 'idthnajaran' => 4, 'idpegawai' => 107, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 10, 'idkelas' => 14, 'idthnajaran' => 4, 'idpegawai' => 91, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 11, 'idkelas' => 16, 'idthnajaran' => 4, 'idpegawai' => 65, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 12, 'idkelas' => 17, 'idthnajaran' => 4, 'idpegawai' => 77, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 13, 'idkelas' => 19, 'idthnajaran' => 4, 'idpegawai' => 117, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 14, 'idkelas' => 20, 'idthnajaran' => 4, 'idpegawai' => 108, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 15, 'idkelas' => 22, 'idthnajaran' => 4, 'idpegawai' => 96, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 16, 'idkelas' => 23, 'idthnajaran' => 4, 'idpegawai' => 31, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 17, 'idkelas' => 24, 'idthnajaran' => 4, 'idpegawai' => 95, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 18, 'idkelas' => 25, 'idthnajaran' => 4, 'idpegawai' => 106, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 19, 'idkelas' => 26, 'idthnajaran' => 4, 'idpegawai' => 53, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 20, 'idkelas' => 27, 'idthnajaran' => 4, 'idpegawai' => 61, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 21, 'idkelas' => 28, 'idthnajaran' => 4, 'idpegawai' => 72, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 22, 'idkelas' => 29, 'idthnajaran' => 4, 'idpegawai' => 85, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 23, 'idkelas' => 30, 'idthnajaran' => 4, 'idpegawai' => 13, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 24, 'idkelas' => 31, 'idthnajaran' => 4, 'idpegawai' => 32, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 25, 'idkelas' => 32, 'idthnajaran' => 4, 'idpegawai' => 100, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 26, 'idkelas' => 33, 'idthnajaran' => 4, 'idpegawai' => 83, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 27, 'idkelas' => 34, 'idthnajaran' => 4, 'idpegawai' => 110, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 28, 'idkelas' => 35, 'idthnajaran' => 4, 'idpegawai' => 27, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 29, 'idkelas' => 37, 'idthnajaran' => 4, 'idpegawai' => 24, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 30, 'idkelas' => 38, 'idthnajaran' => 4, 'idpegawai' => 119, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 31, 'idkelas' => 40, 'idthnajaran' => 4, 'idpegawai' => 99, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 32, 'idkelas' => 41, 'idthnajaran' => 4, 'idpegawai' => 79, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 33, 'idkelas' => 43, 'idthnajaran' => 4, 'idpegawai' => 23, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 34, 'idkelas' => 44, 'idthnajaran' => 4, 'idpegawai' => 88, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 35, 'idkelas' => 45, 'idthnajaran' => 4, 'idpegawai' => 75, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 36, 'idkelas' => 46, 'idthnajaran' => 4, 'idpegawai' => 66, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 37, 'idkelas' => 47, 'idthnajaran' => 4, 'idpegawai' => 81, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 38, 'idkelas' => 48, 'idthnajaran' => 4, 'idpegawai' => 94, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 39, 'idkelas' => 49, 'idthnajaran' => 4, 'idpegawai' => 97, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 40, 'idkelas' => 50, 'idthnajaran' => 4, 'idpegawai' => 78, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 41, 'idkelas' => 51, 'idthnajaran' => 4, 'idpegawai' => 48, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 42, 'idkelas' => 52, 'idthnajaran' => 4, 'idpegawai' => 90, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 43, 'idkelas' => 53, 'idthnajaran' => 4, 'idpegawai' => 84, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 44, 'idkelas' => 54, 'idthnajaran' => 4, 'idpegawai' => 112, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 45, 'idkelas' => 55, 'idthnajaran' => 4, 'idpegawai' => 80, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 46, 'idkelas' => 56, 'idthnajaran' => 4, 'idpegawai' => 74, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 47, 'idkelas' => 57, 'idthnajaran' => 4, 'idpegawai' => 8, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 48, 'idkelas' => 58, 'idthnajaran' => 4, 'idpegawai' => 14, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 49, 'idkelas' => 59, 'idthnajaran' => 4, 'idpegawai' => 111, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 50, 'idkelas' => 60, 'idthnajaran' => 4, 'idpegawai' => 30, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 51, 'idkelas' => 61, 'idthnajaran' => 4, 'idpegawai' => 9, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 52, 'idkelas' => 62, 'idthnajaran' => 4, 'idpegawai' => 101, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 53, 'idkelas' => 64, 'idthnajaran' => 4, 'idpegawai' => 86, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 54, 'idkelas' => 65, 'idthnajaran' => 4, 'idpegawai' => 109, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 55, 'idkelas' => 67, 'idthnajaran' => 4, 'idpegawai' => 87, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 56, 'idkelas' => 68, 'idthnajaran' => 4, 'idpegawai' => 73, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 57, 'idkelas' => 70, 'idthnajaran' => 4, 'idpegawai' => 15, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 58, 'idkelas' => 71, 'idthnajaran' => 4, 'idpegawai' => 76, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 59, 'idkelas' => 73, 'idthnajaran' => 4, 'idpegawai' => 10, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 60, 'idkelas' => 74, 'idthnajaran' => 4, 'idpegawai' => 114, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 61, 'idkelas' => 76, 'idthnajaran' => 4, 'idpegawai' => 92, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 62, 'idkelas' => 77, 'idthnajaran' => 4, 'idpegawai' => 49, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 63, 'idkelas' => 79, 'idthnajaran' => 4, 'idpegawai' => 41, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 64, 'idkelas' => 80, 'idthnajaran' => 4, 'idpegawai' => 33, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 65, 'idkelas' => 81, 'idthnajaran' => 4, 'idpegawai' => 35, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 66, 'idkelas' => 82, 'idthnajaran' => 4, 'idpegawai' => 52, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 67, 'idkelas' => 83, 'idthnajaran' => 4, 'idpegawai' => 57, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 68, 'idkelas' => 85, 'idthnajaran' => 4, 'idpegawai' => 40, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
            ['idkelasdetail' => 69, 'idkelas' => 86, 'idthnajaran' => 4, 'idpegawai' => 39, 'idruangan' => 0, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null],
        ]);
    }
}
