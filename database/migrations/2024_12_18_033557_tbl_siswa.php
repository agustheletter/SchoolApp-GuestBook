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

            // ========================= PERUBAHAN PENTING =========================
            // idsiswa dijadikan Primary Key, TAPI TIDAK auto-increment.
            // Nomornya akan kita isi manual sesuai data dari Induk saat sinkronisasi.
            $table->unsignedInteger('idsiswa')->primary();
            // =====================================================================

            // NIS kita jadikan unique sebagai "KTP" untuk sinkronisasi
            $table->string('nis')->unique();

            // Sisa kolom disamakan dengan tabel Induk
            $table->string('namasiswa');
            $table->string('nisn')->unique(); // NISN juga harusnya unique
            $table->string('nik')->unique();
            $table->string('tmplahir');
            $table->date('tgllahir');
            $table->enum('jk', ['L', 'P']);
            $table->integer('idagama');
            $table->string('photosiswa')->nullable();
            $table->integer('idthnmasuk');
            $table->string('asalsekolah')->nullable();

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
            $table->string('hpsiswa')->nullable();
            $table->string('email')->nullable()->unique();

            //tempat tinggal
            $table->string('jenistinggal')->nullable();
            $table->string('kepemilikan')->nullable();
            $table->string('transportasi')->nullable();
            $table->integer('jarak')->nullable();
            $table->string('lintang')->nullable();
            $table->string('bujur')->nullable();
            $table->string('nomorkk')->nullable();
            $table->string('nomoraktalahir');
            $table->integer('anakke')->nullable();
            $table->integer('jumlahsaudara')->nullable();

            $table->enum('penerimakps', ['Ya', 'Tidak'])->nullable();
            $table->string('nomorkps')->nullable();
            $table->string('nomorun')->nullable();
            $table->string('nomorijazah')->nullable();
            $table->enum('penerimakip', ['Ya', 'Tidak'])->nullable();
            $table->string('nomorkip')->nullable();
            $table->string('namakip')->nullable();
            $table->string('nomorkks')->nullable();

            //Bank
            $table->string('bank')->nullable();
            $table->string('nomorrekening')->nullable();
            $table->string('atasnamarekening')->nullable();

            $table->enum('layakpip', ['Ya', 'Tidak'])->nullable();
            $table->string('alasanlayakpip')->nullable();

            $table->enum('abk', ['Ya', 'Tidak'])->nullable();
            $table->integer('beratbadan')->nullable();
            $table->integer('tinggibadan')->nullable();
            $table->integer('lingkarkepala')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_siswa');
    }
};
