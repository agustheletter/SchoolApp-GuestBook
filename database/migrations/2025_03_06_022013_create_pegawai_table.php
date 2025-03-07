<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tbl_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai');
            $table->foreignId('id_jabatan')->constrained('tbl_jabatan');
            $table->string('kontak')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_pegawai');
    }
};
