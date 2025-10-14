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
        Schema::create('tbl_gajiberkala', function (Blueprint $table) {
            $table->increments('idgajiberkala');
            $table->integer('idpegawai');
            $table->string('nomorsk');
            $table->integer('masakerja_tahun');
            $table->integer('masakerja_bulan');
            $table->date('tmtgajiberkala');
            $table->integer('gaji_pokok_lama');
            $table->integer('gaji_pokok_baru');
            $table->date('tgl_ttd_sk');
            $table->string('pejabat_ttd')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_gajiberkala');
    }
};
