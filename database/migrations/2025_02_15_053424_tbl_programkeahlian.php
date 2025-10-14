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
        Schema::create('tbl_programkeahlian', function (Blueprint $table) {
            $table->increments('idprogramkeahlian');
            $table->string('kodeprogramkeahlian');
            $table->string('namaprogramkeahlian');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_programkeahlian');
    }
};
