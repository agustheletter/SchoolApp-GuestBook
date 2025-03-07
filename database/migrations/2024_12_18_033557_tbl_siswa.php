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
        Schema::create('tbl_siswa', function (Blueprint $table) {
            $table->id('idsiswa');
            $table->string('nis');
            $table->string('nisn');
            $table->string('namasiswa');
            $table->string('tempatlahir');
            $table->date('tgllahir');
            $table->enum('jk', ['L', 'P']);
            $table->string('alamat');
            $table->integer('idagama');
            $table->string('tlprumah');
            $table->string('hpsiswa');
            $table->string('photosiswa');
            $table->integer('idthnmasuk');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
