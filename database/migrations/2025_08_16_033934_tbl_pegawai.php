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
        Schema::create('tbl_pegawai', function (Blueprint $table) {
            $table->increments('idpegawai');
            $table->string('nip');
            $table->string('nuptk');
            $table->string('rekening');
            $table->string('npwp');
            $table->string('nik');
            $table->string('gelardepan')->nullable();
            $table->string('gelarbelakang')->nullable();
            $table->string('namapegawai');
            $table->string('tmplahir');
            $table->date('tgllahir');
            $table->enum('jk', ['L', 'P']);
            $table->enum('statuskepegawaian', ['PNS', 'PPPK', 'Honorer']);
            $table->enum('kategorikepegawaian', ['Guru', 'TU']);
            $table->integer('idagama');
            $table->string('golongan_darah');
            $table->string('karpeg');
            $table->string('askes');
            $table->string('taspen');
            $table->string('karis');


            //alamat
            $table->string('jalan')->nullable();
            $table->string('rt');
            $table->string('rw');
            $table->string('dusun')->nullable();
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('kodepos');

            //kontak
            $table->string('tlprumah')->nullable();
            $table->string('hppegawai');
            $table->string('email');

            //keluarga
            $table->string('namaibu');
            $table->string('statusperkawinan');
            $table->string('namapasangan')->nullable();
            $table->string('pekerjaanpasangan')->nullable();
            $table->string('nippasangan')->nullable();
            $table->integer('jml_anak')->nullable();

            $table->string('photopegawai');
            $table->enum('statusaktif', ['Aktif', 'Tidak Aktif']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('tbl_pegawai');
    }
};
