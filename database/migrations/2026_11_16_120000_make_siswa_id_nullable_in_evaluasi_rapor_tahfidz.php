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
            $table->unsignedBigInteger('siswa_id')->nullable()->change();
            if (!Schema::hasColumn('evaluasi_rapor_tahfidz', 'is_manual')) {
                $table->boolean('is_manual')->default(false)->after('siswa_id');
            }
            if (!Schema::hasColumn('evaluasi_rapor_tahfidz', 'kelas_id')) {
                $table->unsignedBigInteger('kelas_id')->nullable()->after('is_manual');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluasi_rapor_tahfidz', function (Blueprint $table) {
            $table->unsignedBigInteger('siswa_id')->nullable(false)->change();
            if (Schema::hasColumn('evaluasi_rapor_tahfidz', 'is_manual')) {
                $table->dropColumn('is_manual');
            }
            if (Schema::hasColumn('evaluasi_rapor_tahfidz', 'kelas_id')) {
                $table->dropColumn('kelas_id');
            }
        });
    }
};
