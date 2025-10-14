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
        Schema::create('tbl_pendidikanpegawai', function (Blueprint $table) {
            $table->increments('idpendidikanpegawai');
            $table->integer('idpegawai');
            $table->enum('pendidikan', ['TK', 'SD', 'SLTP','SLTA','Perguruan Tinggi']);
            $table->string('nama_sekolah');
            $table->string('jurusan');
            $table->string('kota_sekolah');
            $table->string('nama_ttd_ijazah');
            $table->string('nomor_ijazah');
            $table->date('tgl_ijazah');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('tbl_pendidikanpegawai');
    }
};
