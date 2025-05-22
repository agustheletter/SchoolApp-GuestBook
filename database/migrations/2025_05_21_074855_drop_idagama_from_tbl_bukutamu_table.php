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
        Schema::table('tbl_bukutamu', function (Blueprint $table) {
            // Drop foreign key terlebih dahulu sebelum drop kolom
            $table->dropForeign(['idagama']);
            $table->dropColumn('idagama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_bukutamu', function (Blueprint $table) {
            $table->unsignedBigInteger('idagama');

            // Tambahkan kembali foreign key
            $table->foreign('idagama')
                ->references('idagama')
                ->on('tbl_agama')
                ->onDelete('cascade');
        });
    }
};
