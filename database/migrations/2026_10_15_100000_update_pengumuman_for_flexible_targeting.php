<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah nullability kolom yang sebelumnya mandatory
        DB::statement("ALTER TABLE `pengumuman` MODIFY `sekolah_id` BIGINT UNSIGNED NULL");
        DB::statement("ALTER TABLE `pengumuman` MODIFY `guru_id` BIGINT UNSIGNED NULL");

        Schema::table('pengumuman', function (Blueprint $table) {
            if (!Schema::hasColumn('pengumuman', 'target_tipe')) {
                $table->string('target_tipe', 50)->default('semua')->after('tanggal');
            }
            if (!Schema::hasColumn('pengumuman', 'target_role')) {
                $table->string('target_role', 20)->nullable()->after('target_tipe');
            }
            if (!Schema::hasColumn('pengumuman', 'kelas_id')) {
                $table->foreignId('kelas_id')->nullable()->after('sekolah_id')->constrained('ruang_kelas')->nullOnDelete();
            }
            if (!Schema::hasColumn('pengumuman', 'siswa_id')) {
                $table->foreignId('siswa_id')->nullable()->after('kelas_id')->constrained('siswa')->nullOnDelete();
            }
            if (!Schema::hasColumn('pengumuman', 'lampiran')) {
                $table->string('lampiran', 255)->nullable()->after('isi');
            }
            if (!Schema::hasColumn('pengumuman', 'penulis')) {
                $table->string('penulis', 100)->nullable()->default('Admin')->after('judul');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            if (Schema::hasColumn('pengumuman', 'kelas_id')) {
                $table->dropForeign(['kelas_id']);
                $table->dropColumn('kelas_id');
            }
            if (Schema::hasColumn('pengumuman', 'siswa_id')) {
                $table->dropForeign(['siswa_id']);
                $table->dropColumn('siswa_id');
            }
            $dropCols = array_filter(['target_tipe', 'target_role', 'lampiran', 'penulis'], function($col) {
                return Schema::hasColumn('pengumuman', $col);
            });
            if (!empty($dropCols)) {
                $table->dropColumn($dropCols);
            }
        });
    }
};

