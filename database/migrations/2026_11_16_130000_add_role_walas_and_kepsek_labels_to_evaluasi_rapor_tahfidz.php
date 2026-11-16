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
            if (!Schema::hasColumn('evaluasi_rapor_tahfidz', 'role_walas_label')) {
                $table->string('role_walas_label')->default('Wali Kelas')->nullable()->after('nama_walas');
            }
            if (!Schema::hasColumn('evaluasi_rapor_tahfidz', 'role_kepsek_label')) {
                $table->string('role_kepsek_label')->default('Kepala Sekolah SDQU Imam Syafi’i')->nullable()->after('nama_kepsek');
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
            if (Schema::hasColumn('evaluasi_rapor_tahfidz', 'role_walas_label')) $cols[] = 'role_walas_label';
            if (Schema::hasColumn('evaluasi_rapor_tahfidz', 'role_kepsek_label')) $cols[] = 'role_kepsek_label';
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};
