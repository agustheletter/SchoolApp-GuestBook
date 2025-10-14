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
        Schema::create('tbl_pangkatpegawai', function (Blueprint $table) {
            $table->increments('idpangkatpegawai');
            $table->integer('idpegawai');
            $table->integer('idpangkat');
            $table->string('nomorsk');
            $table->integer('masakerja_tahun');
            $table->integer('masakerja_bulan');
            $table->date('tmtpangkat');
            $table->integer('angka_kredit');
            $table->integer('gaji_pokok');
            $table->date('tgl_ttd')->nullable();;
            $table->string('pejabat_ttd')->nullable();;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pangkatpegawai');
    }
};
