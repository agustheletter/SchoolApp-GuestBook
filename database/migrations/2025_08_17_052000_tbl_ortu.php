<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_ortu', function (Blueprint $table) {
            // Menggunakan unsignedInteger sebagai Primary Key, tidak auto-increment
            $table->unsignedInteger('idortu')->primary();
            $table->integer('idsiswa');

            //ayah
            $table->string('nama_ayah');
            $table->date('tgllahir_ayah')->nullable();
            $table->string('pendidikan_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah');
            $table->string('nik_ayah');
            $table->string('hp_ayah');
            $table->string('alamat_ayah');

            //ibu
            $table->string('nama_ibu');
            $table->date('tgllahir_ibu')->nullable();
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('penghasilan_ibu');
            $table->string('nik_ibu');
            $table->string('hp_ibu');
            $table->string('alamat_ibu');

            //wali
            $table->string('nama_wali')->nullable();
            $table->date('tgllahir_wali')->nullable();
            $table->string('pendidikan_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('penghasilan_wali')->nullable();
            $table->string('nik_wali')->nullable();
            $table->string('hp_wali')->nullable();
            $table->string('alamat_wali')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ortu');
    }
};
