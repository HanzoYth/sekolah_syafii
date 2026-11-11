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
        if (Schema::hasTable('evaluasi_rapor_siswa')) {
            Schema::table('evaluasi_rapor_siswa', function (Blueprint $table) {
                if (!Schema::hasColumn('evaluasi_rapor_siswa', 'ttd_walas')) {
                    $table->longText('ttd_walas')->nullable()->after('nama_walas');
                }
                if (!Schema::hasColumn('evaluasi_rapor_siswa', 'ttd_kepsek')) {
                    $table->longText('ttd_kepsek')->nullable()->after('ttd_walas');
                }
            });
        }

        if (Schema::hasTable('pengaturan_rapor')) {
            Schema::table('pengaturan_rapor', function (Blueprint $table) {
                if (!Schema::hasColumn('pengaturan_rapor', 'ttd_kepsek')) {
                    $table->longText('ttd_kepsek')->nullable()->after('nip_kepsek');
                }
                if (!Schema::hasColumn('pengaturan_rapor', 'ttd_walas')) {
                    $table->longText('ttd_walas')->nullable()->after('ttd_kepsek');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('evaluasi_rapor_siswa')) {
            Schema::table('evaluasi_rapor_siswa', function (Blueprint $table) {
                if (Schema::hasColumn('evaluasi_rapor_siswa', 'ttd_walas')) {
                    $table->dropColumn('ttd_walas');
                }
                if (Schema::hasColumn('evaluasi_rapor_siswa', 'ttd_kepsek')) {
                    $table->dropColumn('ttd_kepsek');
                }
            });
        }

        if (Schema::hasTable('pengaturan_rapor')) {
            Schema::table('pengaturan_rapor', function (Blueprint $table) {
                if (Schema::hasColumn('pengaturan_rapor', 'ttd_walas')) {
                    $table->dropColumn('ttd_walas');
                }
                if (Schema::hasColumn('pengaturan_rapor', 'ttd_kepsek')) {
                    $table->dropColumn('ttd_kepsek');
                }
            });
        }
    }
};
