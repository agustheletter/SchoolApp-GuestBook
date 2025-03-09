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
        Schema::table('tbl_pegawai', function (Blueprint $table) {
            $table->unsignedBigInteger('id_agama')->nullable()->after('id_jabatan');
            $table->foreign('id_agama')->references('idagama')->on('tbl_agama')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_pegawai', function (Blueprint $table) {
            $table->dropForeign(['id_agama']);
            $table->dropColumn('id_agama');
        });
    }
};
