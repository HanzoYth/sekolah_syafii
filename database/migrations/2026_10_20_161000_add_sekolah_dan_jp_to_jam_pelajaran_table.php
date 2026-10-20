<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jam_pelajaran', function (Blueprint $table) {
            if (!Schema::hasColumn('jam_pelajaran', 'sekolah_id')) {
                $table->unsignedBigInteger('sekolah_id')->nullable()->after('id');
                $table->foreign('sekolah_id')->references('id')->on('jenis_sekolah')->nullOnDelete();
            }
            if (!Schema::hasColumn('jam_pelajaran', 'jam_ke')) {
                $table->string('jam_ke', 50)->nullable()->after('sekolah_id');
            }
            if (!Schema::hasColumn('jam_pelajaran', 'jumlah_jp')) {
                $table->unsignedTinyInteger('jumlah_jp')->default(1)->after('jam_ke');
            }
            if (!Schema::hasColumn('jam_pelajaran', 'durasi_per_jp')) {
                $table->unsignedSmallInteger('durasi_per_jp')->nullable()->after('jumlah_jp');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jam_pelajaran', function (Blueprint $table) {
            if (Schema::hasColumn('jam_pelajaran', 'sekolah_id')) {
                $table->dropForeign(['sekolah_id']);
                $table->dropColumn('sekolah_id');
            }
            if (Schema::hasColumn('jam_pelajaran', 'jam_ke')) {
                $table->dropColumn('jam_ke');
            }
            if (Schema::hasColumn('jam_pelajaran', 'jumlah_jp')) {
                $table->dropColumn('jumlah_jp');
            }
            if (Schema::hasColumn('jam_pelajaran', 'durasi_per_jp')) {
                $table->dropColumn('durasi_per_jp');
            }
        });
    }
};

