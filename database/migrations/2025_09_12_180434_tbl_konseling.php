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
        Schema::create('tbl_konseling', function (Blueprint $table) {
            $table->id('idkonseling');
            $table->unsignedBigInteger('idsiswa');
            $table->unsignedBigInteger('idjenis');
            $table->date('tanggal');
            $table->text('permasalahan');
            $table->text('penanganan')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->unsignedBigInteger('idpegawai')->nullable(); // ID guru BK yang menangani
            $table->enum('status', ['open', 'process', 'closed'])->default('open');
            $table->timestamps();
            
            // Kita akan menambahkan foreign key setelah tabel dibuat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_konseling');
    }
};
