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
            $table->unsignedInteger('idsiswa')->primary();
            // =====================================================================

            // Kolom-kolom lain dibuat persis seperti di Aplikasi Induk
            $table->string('namasiswa');
            $table->string('nis');
            $table->string('nisn');
            $table->string('nik');
            $table->string('tmplahir');
            $table->date('tgllahir');

            // PERUBAHAN: Mengizinkan kolom jk untuk bernilai NULL
            $table->enum('jk', ['L', 'P'])->nullable();

            $table->integer('idagama');
            $table->string('photosiswa');
            $table->integer('idthnmasuk');
            $table->string('asalsekolah');

            //alamat
            $table->string('jalan')->nullable();
            $table->string('rt');
            $table->string('rw');
            $table->string('dusun')->nullable();
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('kodepos');

            //kontak
            $table->string('tlprumah')->nullable();
            $table->string('hpsiswa');
            $table->string('email'); // Aturan UNIQUE dihapus

            //tempat tinggal
            $table->string('jenistinggal')->nullable();
            $table->string('kepemilikan')->nullable();
            $table->string('transportasi')->nullable();
            $table->integer('jarak');
            $table->string('lintang')->nullable();
            $table->string('bujur')->nullable();
            $table->string('nomorkk')->nullable();
            $table->string('nomoraktalahir');
            $table->integer('anakke');
            $table->integer('jumlahsaudara');

            // PERUBAHAN: Mengubah ENUM menjadi STRING agar lebih fleksibel
            $table->string('penerimakps')->nullable();
            $table->string('nomorkps')->nullable();
            $table->string('nomorun')->nullable();
            $table->string('nomorijazah')->nullable();
            $table->string('penerimakip')->nullable();
            $table->string('nomorkip')->nullable();
            $table->string('namakip');
            $table->string('nomorkks');

            //Bank
            $table->string('bank')->nullable();
            $table->string('nomorrekening')->nullable();
            $table->string('atasnamarekening')->nullable();

            // PERUBAHAN: Mengubah ENUM menjadi STRING agar lebih fleksibel
            $table->string('layakpip')->nullable();
            $table->string('alasanlayakpip');

            // PERUBAHAN: Mengubah ENUM menjadi STRING agar lebih fleksibel
            $table->string('abk')->nullable();
            $table->integer('beratbadan');
            $table->integer('tinggibadan');
            $table->integer('lingkarkepala');

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

