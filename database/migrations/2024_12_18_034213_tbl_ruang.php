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
        Schema::create('tbl_ruangan', function (Blueprint $table) {
            $table->increments('idruangan');
            $table->string('koderuangan');
            $table->string('namaruangan');
            $table->string('gedung');
            $table->string('lantai');
            $table->string('lokasi')->nullable();
            $table->integer('lebar')->nullable();
            $table->integer('panjang')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('thn_perolehan')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ruangan');
    }
};
