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
            $table->increments('idsiswa');
            $table->string('namasiswa');
            $table->string('nis');
            $table->string('nisn');
            $table->string('nik');
            $table->string('tmplahir');
            $table->date('tgllahir');
            $table->enum('jk', ['L', 'P']);
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
            $table->string('email');

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


            $table->enum('penerimakps', ['Ya', 'Tidak']);
            $table->string('nomorkps')->nullable();
            $table->string('nomorun')->nullable();
            $table->string('nomorijazah')->nullable();
            $table->enum('penerimakip', ['Ya', 'Tidak']);
            $table->string('nomorkip')->nullable();
            $table->string('namakip');
            $table->string('nomorkks');

            //Bank
            $table->string('bank')->nullable();
            $table->string('nomorrekening')->nullable();
            $table->string('atasnamarekening')->nullable();

            $table->enum('layakpip', ['Ya', 'Tidak']);
            $table->string('alasanlayakpip');

            $table->enum('abk', ['Ya', 'Tidak']);
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
