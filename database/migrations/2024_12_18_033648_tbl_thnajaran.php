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
        Schema::create('tbl_thnajaran', function (Blueprint $table) {
            $table->increments('idthnajaran');
            $table->string('thnajaran');
            $table->date('tglmulai');
            $table->date('tglakhir');
            $table->enum('statusaktif', ['Y', 'N'])->default('N');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_thnajaran');
    }
};
