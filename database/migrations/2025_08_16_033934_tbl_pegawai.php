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
        // Menggunakan nama tabel yang sama persis dengan Induk
        Schema::create('tbl_pegawai', function (Blueprint $table) {

            // ========================= PERUBAHAN PENTING =========================
            // idpegawai dijadikan Primary Key, TAPI TIDAK auto-increment.
            // Nomornya akan kita isi manual sesuai data dari Induk saat sinkronisasi.
            $table->unsignedInteger('idpegawai')->primary();
            // =====================================================================

            // NIP tetap kita buat unique karena akan jadi kunci pencarian utama saat sync
            $table->string('nip')->unique();

            // Sisa kolom di bawah ini adalah fotokopian dari tabel Induk
            $table->string('nuptk');
            $table->string('rekening')->nullable();
            $table->string('npwp')->nullable();
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
            $table->string('golongan_darah')->nullable();
            $table->string('karpeg')->nullable();
            $table->string('askes')->nullable();
            $table->string('taspen')->nullable();
            $table->string('karis')->nullable();

            //alamat
            $table->string('jalan')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('dusun')->nullable();
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kodepos')->nullable();

            //kontak
            $table->string('tlprumah')->nullable();
            $table->string('hppegawai')->nullable();
            $table->string('email')->nullable();

            //keluarga
            $table->string('namaibu')->nullable();
            $table->string('statusperkawinan')->nullable();
            $table->string('namapasangan')->nullable();
            $table->string('pekerjaanpasangan')->nullable();
            $table->string('nippasangan')->nullable();
            $table->integer('jml_anak')->nullable();

            $table->string('photopegawai')->nullable();
            $table->enum('statusaktif', ['Aktif', 'Tidak Aktif']);

            $table->timestamps();
            $table->softDeletes(); // Samakan juga dengan Induk
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pegawai');
    }
};

