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
        Schema::create('tbl_bayar', function (Blueprint $table) {
            $table->increments('idbayar');
            $table->integer('idsiswa');
            $table->integer('iduser');
            $table->integer('idthnajaran');
            // $table->datetime('waktubayar');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_bayar');
    }
};
