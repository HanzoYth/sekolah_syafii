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
            $table->string('umur', 50)->nullable()->after('fase');
            $table->string('orang_tua')->nullable()->after('umur');

            // A. Ujian Kenaikan Juz
            $table->string('kenaikan_juz_tanggal')->nullable()->after('orang_tua');
            $table->string('kenaikan_juz_nomor', 50)->nullable()->after('kenaikan_juz_tanggal');
            $table->string('kenaikan_juz_predikat', 50)->nullable()->after('kenaikan_juz_nomor');

            // B. Ujian Tahfidzh
            $table->decimal('ujian_1', 6, 2)->nullable()->after('kenaikan_juz_predikat');
            $table->decimal('ujian_2', 6, 2)->nullable()->after('ujian_1');
            $table->decimal('ujian_akhir', 6, 2)->nullable()->after('ujian_2');
            $table->decimal('ujian_jumlah', 8, 2)->nullable()->after('ujian_akhir');
            $table->decimal('ujian_rata_rata', 6, 2)->nullable()->after('ujian_jumlah');
            $table->string('ujian_predikat', 50)->nullable()->after('ujian_rata_rata');

            // C. Tasmi Akhir Semester
            $table->string('tasmi_tanggal')->nullable()->after('ujian_predikat');
            $table->string('tasmi_jumlah_juz', 50)->nullable()->after('tasmi_tanggal');
            $table->string('tasmi_predikat', 50)->nullable()->after('tasmi_jumlah_juz');

            // D. Pencapaian Tahfizh
            $table->string('target_semester', 50)->default('1 Juz')->after('tasmi_predikat');
            $table->string('tercapai_semester')->nullable()->after('target_semester');
            $table->string('target_total', 50)->default('9 Juz')->after('tercapai_semester');
            $table->string('tercapai_total')->nullable()->after('target_total');
            $table->boolean('tercapai_target_semester')->default(false)->after('tercapai_total');
            $table->boolean('tercapai_target_kelas')->default(false)->after('tercapai_target_semester');

            // Catatan Pengampu Halaqah
            $table->text('catatan_bacaan')->nullable()->after('tercapai_target_kelas');
            $table->text('catatan_hafalan')->nullable()->after('catatan_bacaan');
            $table->text('catatan_akhlak')->nullable()->after('catatan_hafalan');
            $table->string('role_pengampu_label')->default('Pengampu Halaqah & Wali Kelas 6')->after('nama_walas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluasi_rapor_tahfidz', function (Blueprint $table) {
            $table->dropColumn([
                'umur', 'orang_tua',
                'kenaikan_juz_tanggal', 'kenaikan_juz_nomor', 'kenaikan_juz_predikat',
                'ujian_1', 'ujian_2', 'ujian_akhir', 'ujian_jumlah', 'ujian_rata_rata', 'ujian_predikat',
                'tasmi_tanggal', 'tasmi_jumlah_juz', 'tasmi_predikat',
                'target_semester', 'tercapai_semester', 'target_total', 'tercapai_total',
                'tercapai_target_semester', 'tercapai_target_kelas',
                'catatan_bacaan', 'catatan_hafalan', 'catatan_akhlak', 'role_pengampu_label'
            ]);
        });
    }
};
