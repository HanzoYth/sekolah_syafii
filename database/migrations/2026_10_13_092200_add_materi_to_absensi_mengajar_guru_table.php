<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('absensi_mengajar_guru') && !Schema::hasColumn('absensi_mengajar_guru', 'materi')) {
            Schema::table('absensi_mengajar_guru', function (Blueprint $table) {
                $table->string('materi')->nullable()->after('status');
                $table->text('catatan')->nullable()->after('materi');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('absensi_mengajar_guru') && Schema::hasColumn('absensi_mengajar_guru', 'materi')) {
            Schema::table('absensi_mengajar_guru', function (Blueprint $table) {
                $table->dropColumn(['materi', 'catatan']);
            });
        }
    }
};

