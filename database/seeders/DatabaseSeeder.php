<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        $this->call(PegawaiSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(BukuTamuSeeder::class);
    }
}
