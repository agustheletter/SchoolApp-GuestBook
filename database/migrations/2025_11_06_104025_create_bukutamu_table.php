<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tbl_bukutamu', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('role', ['ortu', 'umum']);

            $table->integer('idsiswa')->unsigned()->nullable();
            $table->foreign('idsiswa')->references('idsiswa')->on('tbl_siswa')->onDelete('cascade');

            $table->string('instansi')->nullable();
            $table->text('alamat');
            $table->string('kontak');

            // FK ke jabatan (tbl_jabatan.idjabatan)
            // $table->integer('idjabatan')->unsigned(); // BUKAN id_jabatan
            // $table->foreign('idjabatan')->references('idjabatan')->on('tbl_jabatan')->onDelete('cascade');

            // FK ke pegawai (tbl_pegawai.idpegawai)
            $table->integer('idpegawai')->unsigned();
            $table->foreign('idpegawai')->references('idpegawai')->on('tbl_pegawai')->onDelete('cascade');

            // FK ke pegawai (tbl_thnajaran.idthnajaran)
            $table->integer('idthnajaran')->unsigned();
            $table->foreign('idthnajaran')->references('idthnajaran')->on('tbl_thnajaran')->onDelete('cascade');

            $table->text('keperluan');
            $table->longText('foto_tamu')->nullable();
            // $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_bukutamu');
    }
};
