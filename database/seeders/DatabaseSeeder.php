<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(TahunAjaranSeeder::class);
        $this->call(BulanSeeder::class);
        $this->call(AgamaSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(TingkatSeeder::class);
        $this->call(JurusanSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProgramKeahlianSeeder::class);
        $this->call(SemesterSeeder::class);

        $this->call(JabatanSeeder::class);
        DB::table('tbl_jabatan')->insert([
            ['nama_jabatan' => 'Developer'],
        ]);

        $this->call(PegawaiSeeder::class);
        DB::table('tbl_pegawai')->insert([
            ['nama_pegawai' => 'Adrenalin', 'jenis_kelamin' => 'Laki-laki', 'id_jabatan' => 7, 'id_agama' => 1, 'kontak' => '088222134661'],
            ['nama_pegawai' => 'Evliya', 'jenis_kelamin' => 'Perempuan', 'id_jabatan' => 7, 'id_agama' => 1, 'kontak' => '081222678810'],
        ]);

        // $this->call(SiswaSeeder::class);

        DB::table('tbl_siswa')->insert([
        // KELAS 10
            ['nis' => '251118435', 'nisn' => '0098224676', 'namasiswa' => 'Adrenalin Muhammad Dewangga', 'tempatlahir' => '0', 'tgllahir' => '2000-01-01', 'jk' => 'L', 'alamat' => '0', 'idagama' => '1',  'kontak' => '0', 'photosiswa' => '0', 'idthnmasuk' => 4],
            ['nis' => '251118435', 'nisn' => '0098224676', 'namasiswa' => 'Evliya Satari Nurarifah', 'tempatlahir' => '0', 'tgllahir' => '2000-01-01', 'jk' => 'P', 'alamat' => '0', 'idagama' => '1',  'kontak' => '0', 'photosiswa' => '0', 'idthnmasuk' => 4],
        ]);

        $this->call(OrangtuaSeeder::class);
        $this->call(BukuTamuSeeder::class);
    }
}
