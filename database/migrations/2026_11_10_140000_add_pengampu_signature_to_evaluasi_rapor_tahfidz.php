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
        Schema::table('evaluasi_rapor_tahfidz', function (Blueprint $table) {
            if (!Schema::hasColumn('evaluasi_rapor_tahfidz', 'nama_pengampu')) {
                $table->string('nama_pengampu')->nullable()->default('USTADZ PENGAMPU HALAQAH')->after('tanggal_rapor');
            }
            if (!Schema::hasColumn('evaluasi_rapor_tahfidz', 'ttd_pengampu')) {
                $table->string('ttd_pengampu')->nullable()->after('nama_pengampu');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluasi_rapor_tahfidz', function (Blueprint $table) {
            $cols = [];
            if (Schema::hasColumn('evaluasi_rapor_tahfidz', 'nama_pengampu')) $cols[] = 'nama_pengampu';
            if (Schema::hasColumn('evaluasi_rapor_tahfidz', 'ttd_pengampu')) $cols[] = 'ttd_pengampu';
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};
