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
        Schema::create('tbl_keluargapegawai', function (Blueprint $table) {
            $table->increments('idkeluargapegawai');
            $table->integer('idpegawai');
            $table->string('nama_anggota_keluarga');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->enum('jk', ['L', 'P']);
            $table->enum('pendidikan', ['Belum Sekolah', 'TK', 'SD', 'SLTP','SLTA','Perguruan Tinggi']);
            $table->string('nama_sekolah');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('tbl_keluargapegawai');
    }
};
