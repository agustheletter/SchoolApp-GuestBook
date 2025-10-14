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
        Schema::create('tbl_jenisbayar', function (Blueprint $table) {
            $table->increments('idjenisbayar');
            $table->string('kodejenisbayar');
            $table->string('jenisbayar');
            $table->enum('periode',['Bulanan','Cicilan']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_jenisbayar');
    }
};
