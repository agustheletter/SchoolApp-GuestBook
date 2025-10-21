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
        Schema::create('tbl_jabatanpegawai', function (Blueprint $table) {
            // $table->increments('idjabatanpegawai');
            $table->unsignedInteger('idjabatanpegawai')->primary(); // <-- PENTING!
            // $table->integer('idguru');

            $table->integer('idpegawai');
            $table->integer('idjabatan');
            $table->integer('idthnajaran');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_jabatanpegawai');
    }
};
