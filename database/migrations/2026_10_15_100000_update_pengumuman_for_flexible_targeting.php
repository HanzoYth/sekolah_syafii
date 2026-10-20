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
        DB::statement("
            ALTER TABLE `pengumuman`
            ADD COLUMN `guru_id` BIGINT UNSIGNED NULL,
            ADD CONSTRAINT `pengumuman_guru_id_foreign`
            FOREIGN KEY (`guru_id`)
            REFERENCES `guru` (`id`)
            ON DELETE SET NULL
        ");

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
    // Hapus foreign key hanya jika benar-benar ada.
    foreach (['kelas_id', 'siswa_id', 'guru_id'] as $column) {
        if (!Schema::hasColumn('pengumuman', $column)) {
            continue;
        }

        $foreignKeyExists = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::raw('DATABASE()'))
            ->where('TABLE_NAME', 'pengumuman')
            ->where('COLUMN_NAME', $column)
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->exists();

        if ($foreignKeyExists) {
            $constraint = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->where('TABLE_SCHEMA', DB::raw('DATABASE()'))
                ->where('TABLE_NAME', 'pengumuman')
                ->where('COLUMN_NAME', $column)
                ->whereNotNull('REFERENCED_TABLE_NAME')
                ->value('CONSTRAINT_NAME');

            if ($constraint) {
                DB::statement(
                    'ALTER TABLE `pengumuman` DROP FOREIGN KEY `' .
                    str_replace('`', '``', $constraint) . '`'
                );
            }
        }
    }

    Schema::table('pengumuman', function (Blueprint $table) {
        $columns = [];

        foreach (
            ['kelas_id', 'siswa_id', 'guru_id',
             'target_tipe', 'target_role', 'lampiran', 'penulis']
            as $column
        ) {
            if (Schema::hasColumn('pengumuman', $column)) {
                $columns[] = $column;
            }
        }

        if (!empty($columns)) {
            $table->dropColumn($columns);
        }
    });
}

};

