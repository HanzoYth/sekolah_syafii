<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('evaluasi_rapor_siswa') && !Schema::hasColumn('evaluasi_rapor_siswa', 'catatan_mapel')) {
            Schema::table('evaluasi_rapor_siswa', function (Blueprint $table) {
                $table->json('catatan_mapel')->nullable()->after('evaluasi_kegiatan');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('evaluasi_rapor_siswa') && Schema::hasColumn('evaluasi_rapor_siswa', 'catatan_mapel')) {
            Schema::table('evaluasi_rapor_siswa', function (Blueprint $table) {
                $table->dropColumn('catatan_mapel');
            });
        }
    }
};
