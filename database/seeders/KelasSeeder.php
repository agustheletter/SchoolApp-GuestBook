<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data lama agar tidak duplicate
        DB::table('tbl_kelas')->truncate();

        // Insert semua data
        DB::table('tbl_kelas')->insert([
            ['idkelas' => 1, 'kodekelas' => '10-TOI-A', 'namakelas' => 'X-Teknik Otomasi Industri A', 'idjurusan' => 1, 'idtingkat' => 1],
            ['idkelas' => 2, 'kodekelas' => '10-TOI-B', 'namakelas' => 'X-Teknik Otomasi Industri B', 'idjurusan' => 1, 'idtingkat' => 1],
            ['idkelas' => 3, 'kodekelas' => '10-TOI-C', 'namakelas' => 'X-Teknik Otomasi Industri C', 'idjurusan' => 1, 'idtingkat' => 1],
            ['idkelas' => 4, 'kodekelas' => '10-TPTUP-A', 'namakelas' => 'X-Teknik Pemanasan, Tata Udara, & Pendinginan A', 'idjurusan' => 2, 'idtingkat' => 1],
            ['idkelas' => 5, 'kodekelas' => '10-TPTUP-B', 'namakelas' => 'X-Teknik Pemanasan, Tata Udara, & Pendinginan B', 'idjurusan' => 2, 'idtingkat' => 1],
            ['idkelas' => 6, 'kodekelas' => '10-TPTUP-C', 'namakelas' => 'X-Teknik Pemanasan, Tata Udara, & Pendinginan C', 'idjurusan' => 2, 'idtingkat' => 1],
            ['idkelas' => 7, 'kodekelas' => '10-TEI-A', 'namakelas' => 'X-Teknik Elektronika Industri A', 'idjurusan' => 3, 'idtingkat' => 1],
            ['idkelas' => 8, 'kodekelas' => '10-TEI-B', 'namakelas' => 'X-Teknik Elektronika Industri B', 'idjurusan' => 3, 'idtingkat' => 1],
            ['idkelas' => 9, 'kodekelas' => '10-TEI-C', 'namakelas' => 'X-Teknik Elektronika Industri C', 'idjurusan' => 3, 'idtingkat' => 1],
            ['idkelas' => 10, 'kodekelas' => '10-TEK-A', 'namakelas' => 'X-Teknik Elektronika Komunikasi A', 'idjurusan' => 4, 'idtingkat' => 1],
            ['idkelas' => 11, 'kodekelas' => '10-TEK-B', 'namakelas' => 'X-Teknik Elektronika Komunikasi B', 'idjurusan' => 4, 'idtingkat' => 1],
            ['idkelas' => 12, 'kodekelas' => '10-TEK-C', 'namakelas' => 'X-Teknik Elektronika Komunikasi C', 'idjurusan' => 4, 'idtingkat' => 1],
            ['idkelas' => 13, 'kodekelas' => '10-TM-A', 'namakelas' => 'X-Teknik Mekatronika A', 'idjurusan' => 5, 'idtingkat' => 1],
            ['idkelas' => 14, 'kodekelas' => '10-TM-B', 'namakelas' => 'X-Teknik Mekatronika B', 'idjurusan' => 5, 'idtingkat' => 1],
            ['idkelas' => 15, 'kodekelas' => '10-TM-C', 'namakelas' => 'X-Teknik Mekatronika C', 'idjurusan' => 5, 'idtingkat' => 1],
            ['idkelas' => 16, 'kodekelas' => '10-IOP-A', 'namakelas' => 'X-Instrumentasi dan Otomatisasi Proses A', 'idjurusan' => 6, 'idtingkat' => 1],
            ['idkelas' => 17, 'kodekelas' => '10-IOP-B', 'namakelas' => 'X-Instrumentasi dan Otomatisasi Proses B', 'idjurusan' => 6, 'idtingkat' => 1],
            ['idkelas' => 18, 'kodekelas' => '10-IOP-C', 'namakelas' => 'X-Instrumentasi dan Otomatisasi Proses C', 'idjurusan' => 6, 'idtingkat' => 1],
            ['idkelas' => 19, 'kodekelas' => '10-SIJAP-A', 'namakelas' => 'X-Sistem Informatika Jaringan dan Aplikasi A', 'idjurusan' => 7, 'idtingkat' => 1],
            ['idkelas' => 20, 'kodekelas' => '10-SIJA-B', 'namakelas' => 'X-Sistem Informatika Jaringan dan Aplikasi B', 'idjurusan' => 7, 'idtingkat' => 1],
            ['idkelas' => 21, 'kodekelas' => '10-SIJA-C', 'namakelas' => 'X-Sistem Informatika Jaringan dan Aplikasi C', 'idjurusan' => 7, 'idtingkat' => 1],
            ['idkelas' => 22, 'kodekelas' => '10-RPL-A', 'namakelas' => 'X-Rekayasa Perangkat Lunak A', 'idjurusan' => 8, 'idtingkat' => 1],
            ['idkelas' => 23, 'kodekelas' => '10-RPL-B', 'namakelas' => 'X-Rekayasa Perangkat Lunak B', 'idjurusan' => 8, 'idtingkat' => 1],
            ['idkelas' => 24, 'kodekelas' => '10-RPL-C', 'namakelas' => 'X-Rekayasa Perangkat Lunak C', 'idjurusan' => 8, 'idtingkat' => 1],
            ['idkelas' => 25, 'kodekelas' => '10-PSPT-A', 'namakelas' => 'X-Produksi dan Siaran Program Televisi A', 'idjurusan' => 9, 'idtingkat' => 1],
            ['idkelas' => 26, 'kodekelas' => '10-PSPT-B', 'namakelas' => 'X-Produksi dan Siaran Program Televisi B', 'idjurusan' => 9, 'idtingkat' => 1],
            ['idkelas' => 27, 'kodekelas' => '10-PSPT-C', 'namakelas' => 'X-Produksi dan Siaran Program Televisi C', 'idjurusan' => 9, 'idtingkat' => 1],
            ['idkelas' => 28, 'kodekelas' => '11-TOI-A', 'namakelas' => 'XI-Teknik Otomasi Industri A', 'idjurusan' => 1, 'idtingkat' => 2],
            ['idkelas' => 29, 'kodekelas' => '11-TOI-B', 'namakelas' => 'XI-Teknik Otomasi Industri B', 'idjurusan' => 1, 'idtingkat' => 2],
            ['idkelas' => 30, 'kodekelas' => '11-TOI-C', 'namakelas' => 'XI-Teknik Otomasi Industri C', 'idjurusan' => 1, 'idtingkat' => 2],
            ['idkelas' => 31, 'kodekelas' => '11-TPTUP-A', 'namakelas' => 'XI-Teknik Pemanasan, Tata Udara dan Pendinginan A', 'idjurusan' => 2, 'idtingkat' => 2],
            ['idkelas' => 32, 'kodekelas' => '11-TPTUP-B', 'namakelas' => 'XI-Teknik Pemanasan, Tata Udara dan Pendinginan B', 'idjurusan' => 2, 'idtingkat' => 2],
            ['idkelas' => 33, 'kodekelas' => '11-TPTUP-C', 'namakelas' => 'XI-Teknik Pemanasan, Tata Udara dan Pendinginan C', 'idjurusan' => 2, 'idtingkat' => 2],
            ['idkelas' => 34, 'kodekelas' => '11-TEI-A', 'namakelas' => 'XI-Teknik Elektronika Industri A', 'idjurusan' => 3, 'idtingkat' => 2],
            ['idkelas' => 35, 'kodekelas' => '11-TEI-B', 'namakelas' => 'XI-Teknik Elektronika Industri B', 'idjurusan' => 3, 'idtingkat' => 2],
            ['idkelas' => 36, 'kodekelas' => '11-TEI-C', 'namakelas' => 'XI-Teknik Elektronika Industri C', 'idjurusan' => 3, 'idtingkat' => 2],
            ['idkelas' => 37, 'kodekelas' => '11-TEK-A', 'namakelas' => 'XI-Teknik Elektronika Komunikasi A', 'idjurusan' => 4, 'idtingkat' => 2],
            ['idkelas' => 38, 'kodekelas' => '11-TEK-B', 'namakelas' => 'XI-Teknik Elektronika Komunikasi B', 'idjurusan' => 4, 'idtingkat' => 2],
            ['idkelas' => 39, 'kodekelas' => '11-TEK-C', 'namakelas' => 'XI-Teknik Elektronika Komunikasi C', 'idjurusan' => 4, 'idtingkat' => 2],
            ['idkelas' => 40, 'kodekelas' => '11-TM-A', 'namakelas' => 'XI-Teknik Mekatronika A', 'idjurusan' => 5, 'idtingkat' => 2],
            ['idkelas' => 41, 'kodekelas' => '11-TM-B', 'namakelas' => 'XI-Teknik Mekatronika B', 'idjurusan' => 5, 'idtingkat' => 2],
            ['idkelas' => 42, 'kodekelas' => '11-TM-C', 'namakelas' => 'XI-Teknik Mekatronika C', 'idjurusan' => 5, 'idtingkat' => 2],
            ['idkelas' => 43, 'kodekelas' => '11-IOP-A', 'namakelas' => 'XI-Instrumentasi dan Otomatisasi Proses A', 'idjurusan' => 6, 'idtingkat' => 2],
            ['idkelas' => 44, 'kodekelas' => '11-IOP-B', 'namakelas' => 'XI-Instrumentasi dan Otomatisasi Proses B', 'idjurusan' => 6, 'idtingkat' => 2],
            ['idkelas' => 45, 'kodekelas' => '11-IOP-C', 'namakelas' => 'XI-Instrumentasi dan Otomatisasi Proses C', 'idjurusan' => 6, 'idtingkat' => 2],
            ['idkelas' => 46, 'kodekelas' => '11-SIJA-A', 'namakelas' => 'XI-Sistem Informatika Jaringan dan Aplikasi A', 'idjurusan' => 7, 'idtingkat' => 2],
            ['idkelas' => 47, 'kodekelas' => '11-SIJA-B', 'namakelas' => 'XI-Sistem Informatika Jaringan dan Aplikasi B', 'idjurusan' => 7, 'idtingkat' => 2],
            ['idkelas' => 48, 'kodekelas' => '11-SIJA-C', 'namakelas' => 'XI-Sistem Informatika Jaringan dan Aplikasi C', 'idjurusan' => 7, 'idtingkat' => 2],
            ['idkelas' => 49, 'kodekelas' => '11-RPL-A', 'namakelas' => 'XI-Rekayasa Perangkat Lunak A', 'idjurusan' => 8, 'idtingkat' => 2],
            ['idkelas' => 50, 'kodekelas' => '11-RPL-B', 'namakelas' => 'XI-Rekayasa Perangkat Lunak B', 'idjurusan' => 8, 'idtingkat' => 2],
            ['idkelas' => 51, 'kodekelas' => '11-RPL-C', 'namakelas' => 'XI-Rekayasa Perangkat Lunak C', 'idjurusan' => 8, 'idtingkat' => 2],
            ['idkelas' => 52, 'kodekelas' => '11-PSPT-A', 'namakelas' => 'XI-Produksi dan Siaran Program Televisi A', 'idjurusan' => 9, 'idtingkat' => 2],
            ['idkelas' => 53, 'kodekelas' => '11-PSPT-B', 'namakelas' => 'XI-Produksi dan Siaran Program Televisi B', 'idjurusan' => 9, 'idtingkat' => 2],
            ['idkelas' => 54, 'kodekelas' => '11-PSPT-C', 'namakelas' => 'XI-Produksi dan Siaran Program Televisi C', 'idjurusan' => 9, 'idtingkat' => 2],
            ['idkelas' => 55, 'kodekelas' => '12-TOI-A', 'namakelas' => 'XII-Teknik Otomasi Industri A', 'idjurusan' => 1, 'idtingkat' => 3],
            ['idkelas' => 56, 'kodekelas' => '12-TOI-B', 'namakelas' => 'XII-Teknik Otomasi Industri B', 'idjurusan' => 1, 'idtingkat' => 3],
            ['idkelas' => 57, 'kodekelas' => '12-TOI-C', 'namakelas' => 'XII-Teknik Otomasi Industri C', 'idjurusan' => 1, 'idtingkat' => 3],
            ['idkelas' => 58, 'kodekelas' => '12-TPTUP-A', 'namakelas' => 'XII-Teknik Pemanasan, Tata Udara dan Pendinginan A', 'idjurusan' => 2, 'idtingkat' => 3],
            ['idkelas' => 59, 'kodekelas' => '12-TPTUP-B', 'namakelas' => 'XII-Teknik Pemanasan, Tata Udara dan Pendinginan B', 'idjurusan' => 2, 'idtingkat' => 3],
            ['idkelas' => 60, 'kodekelas' => '12-TPTUP-C', 'namakelas' => 'XII-Teknik Pemanasan, Tata Udara dan Pendinginan C', 'idjurusan' => 2, 'idtingkat' => 3],
            ['idkelas' => 61, 'kodekelas' => '12-TEI-A', 'namakelas' => 'XII-Teknik Elektronika Industri A', 'idjurusan' => 3, 'idtingkat' => 3],
            ['idkelas' => 62, 'kodekelas' => '12-TEI-B', 'namakelas' => 'XII-Teknik Elektronika Industri B', 'idjurusan' => 3, 'idtingkat' => 3],
            ['idkelas' => 63, 'kodekelas' => '12-TEI-C', 'namakelas' => 'XII-Teknik Elektronika Industri C', 'idjurusan' => 3, 'idtingkat' => 3],
            ['idkelas' => 64, 'kodekelas' => '12-TEK-A', 'namakelas' => 'XII-Teknik Elektronika Komunikasi A', 'idjurusan' => 4, 'idtingkat' => 3],
            ['idkelas' => 65, 'kodekelas' => '12-TEK-B', 'namakelas' => 'XII-Teknik Elektronika Komunikasi B', 'idjurusan' => 4, 'idtingkat' => 3],
            ['idkelas' => 66, 'kodekelas' => '12-TEK-C', 'namakelas' => 'XII-Teknik Elektronika Komunikasi C', 'idjurusan' => 4, 'idtingkat' => 3],
            ['idkelas' => 67, 'kodekelas' => '12-TM-A', 'namakelas' => 'XII-Teknik Mekatronika A', 'idjurusan' => 5, 'idtingkat' => 3],
            ['idkelas' => 68, 'kodekelas' => '12-TM-B', 'namakelas' => 'XII-Teknik Mekatronika B', 'idjurusan' => 5, 'idtingkat' => 3],
            ['idkelas' => 69, 'kodekelas' => '12-TM-C', 'namakelas' => 'XII-Teknik Mekatronika C', 'idjurusan' => 5, 'idtingkat' => 3],
            ['idkelas' => 70, 'kodekelas' => '12-IOP-A', 'namakelas' => 'XII-Instrumentasi dan Otomatisasi Proses A', 'idjurusan' => 6, 'idtingkat' => 3],
            ['idkelas' => 71, 'kodekelas' => '12-IOP-B', 'namakelas' => 'XII-Instrumentasi dan Otomatisasi Proses B', 'idjurusan' => 6, 'idtingkat' => 3],
            ['idkelas' => 72, 'kodekelas' => '12-IOP-C', 'namakelas' => 'XII-Instrumentasi dan Otomatisasi Proses C', 'idjurusan' => 6, 'idtingkat' => 3],
            ['idkelas' => 73, 'kodekelas' => '12-SIJA-A', 'namakelas' => 'XII-Sistem Informatika Jaringan dan Aplikasi A', 'idjurusan' => 7, 'idtingkat' => 3],
            ['idkelas' => 74, 'kodekelas' => '12-SIJA-B', 'namakelas' => 'XII-Sistem Informatika Jaringan dan Aplikasi B', 'idjurusan' => 7, 'idtingkat' => 3],
            ['idkelas' => 75, 'kodekelas' => '12-SIJA-C', 'namakelas' => 'XII-Sistem Informatika Jaringan dan Aplikasi C', 'idjurusan' => 7, 'idtingkat' => 3],
            ['idkelas' => 76, 'kodekelas' => '12-RPL-A', 'namakelas' => 'XII-Rekayasa Perangkat Lunak A', 'idjurusan' => 8, 'idtingkat' => 3],
            ['idkelas' => 77, 'kodekelas' => '12-RPL-B', 'namakelas' => 'XII-Rekayasa Perangkat Lunak B', 'idjurusan' => 8, 'idtingkat' => 3],
            ['idkelas' => 78, 'kodekelas' => '12-RPL-C', 'namakelas' => 'XII-Rekayasa Perangkat Lunak C', 'idjurusan' => 8, 'idtingkat' => 3],
            ['idkelas' => 79, 'kodekelas' => '12-PSPT-A', 'namakelas' => 'XII-Produksi dan Siaran Program Televisi A', 'idjurusan' => 9, 'idtingkat' => 3],
            ['idkelas' => 80, 'kodekelas' => '12-PSPT-B', 'namakelas' => 'XII-Produksi dan Siaran Program Televisi B', 'idjurusan' => 9, 'idtingkat' => 3],
            ['idkelas' => 81, 'kodekelas' => '12-PSPT-C', 'namakelas' => 'XII-Produksi dan Siaran Program Televisi C', 'idjurusan' => 9, 'idtingkat' => 3],
            ['idkelas' => 82, 'kodekelas' => '13-IOP-A', 'namakelas' => 'XIII-Instrumentasi dan Otomatisasi Proses A', 'idjurusan' => 6, 'idtingkat' => 4],
            ['idkelas' => 83, 'kodekelas' => '13-IOP-B', 'namakelas' => 'XIII-Instrumentasi dan Otomatisasi Proses B', 'idjurusan' => 6, 'idtingkat' => 4],
            ['idkelas' => 84, 'kodekelas' => '13-IOP-C', 'namakelas' => 'XIII-Instrumentasi dan Otomatisasi Proses C', 'idjurusan' => 6, 'idtingkat' => 4],
            ['idkelas' => 85, 'kodekelas' => '13-SIJA-A', 'namakelas' => 'XIII-Sistem Informatika Jaringan dan Aplikasi A', 'idjurusan' => 7, 'idtingkat' => 4],
            ['idkelas' => 86, 'kodekelas' => '13-SIJA-B', 'namakelas' => 'XIII-Sistem Informatika Jaringan dan Aplikasi B', 'idjurusan' => 7, 'idtingkat' => 4],
            ['idkelas' => 87, 'kodekelas' => '13-SIJA-C', 'namakelas' => 'XIII-Sistem Informatika Jaringan dan Aplikasi C', 'idjurusan' => 7, 'idtingkat' => 4],
        ]);
    }
}
