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
            $table->foreignId('id_jabatan')->constrained('tbl_jabatan');
            $table->foreignId('id_pegawai')->constrained('tbl_pegawai');
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
