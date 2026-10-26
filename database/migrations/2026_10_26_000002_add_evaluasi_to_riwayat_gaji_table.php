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
        if (Schema::hasTable('riwayat_gaji')) {
            Schema::table('riwayat_gaji', function (Blueprint $table) {
                if (!Schema::hasColumn('riwayat_gaji', 'evaluasi')) {
                    $table->text('evaluasi')->nullable()->after('guru_id');
                }
                if (!Schema::hasColumn('riwayat_gaji', 'keterlambatan_cepat_pulang')) {
                    $table->bigInteger('keterlambatan_cepat_pulang')->default(0)->after('keterlambatan');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('riwayat_gaji')) {
            Schema::table('riwayat_gaji', function (Blueprint $table) {
                if (Schema::hasColumn('riwayat_gaji', 'evaluasi')) {
                    $table->dropColumn('evaluasi');
                }
                if (Schema::hasColumn('riwayat_gaji', 'keterlambatan_cepat_pulang')) {
                    $table->dropColumn('keterlambatan_cepat_pulang');
                }
            });
        }
    }
};

