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
            if (!Schema::hasColumn('evaluasi_rapor_tahfidz', 'nama_lengkap')) {
                $table->string('nama_lengkap')->nullable()->after('siswa_id');
            }
            if (!Schema::hasColumn('evaluasi_rapor_tahfidz', 'bulan_1_label')) {
                $table->string('bulan_1_label')->default('AGUSTUS')->after('kenaikan_juz_predikat');
                $table->string('bulan_2_label')->default('SEPTEMBER')->after('bulan_1_label');
                $table->string('bulan_3_label')->default('OKTOBER')->after('bulan_2_label');
                $table->string('bulan_4_label')->default('NOVEMBER')->after('bulan_3_label');
            }
            if (!Schema::hasColumn('evaluasi_rapor_tahfidz', 'nilai_bulan_1')) {
                $table->float('nilai_bulan_1')->nullable()->after('bulan_4_label');
                $table->float('nilai_bulan_2')->nullable()->after('nilai_bulan_1');
                $table->float('nilai_bulan_3')->nullable()->after('nilai_bulan_2');
                $table->float('nilai_bulan_4')->nullable()->after('nilai_bulan_3');
            }
            if (!Schema::hasColumn('evaluasi_rapor_tahfidz', 'ujian_terbuka_tanggal')) {
                $table->string('ujian_terbuka_tanggal')->nullable()->default('-')->after('ujian_predikat');
                $table->string('ujian_terbuka_jumlah_juz')->nullable()->default('-')->after('ujian_terbuka_tanggal');
                $table->string('ujian_terbuka_predikat')->nullable()->default('-')->after('ujian_terbuka_jumlah_juz');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluasi_rapor_tahfidz', function (Blueprint $table) {
            $cols = [
                'nama_lengkap',
                'bulan_1_label', 'bulan_2_label', 'bulan_3_label', 'bulan_4_label',
                'nilai_bulan_1', 'nilai_bulan_2', 'nilai_bulan_3', 'nilai_bulan_4',
                'ujian_terbuka_tanggal', 'ujian_terbuka_jumlah_juz', 'ujian_terbuka_predikat'
            ];
            $toDrop = array_filter($cols, fn($c) => Schema::hasColumn('evaluasi_rapor_tahfidz', $c));
            if (!empty($toDrop)) {
                $table->dropColumn($toDrop);
            }
        });
    }
};
