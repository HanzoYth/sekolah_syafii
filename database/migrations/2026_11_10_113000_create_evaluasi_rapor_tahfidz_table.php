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
        if (!Schema::hasTable('evaluasi_rapor_tahfidz')) {
            Schema::create('evaluasi_rapor_tahfidz', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('siswa_id');
                $table->unsignedBigInteger('guru_id')->nullable();
                $table->unsignedBigInteger('halaqah_id')->nullable();
                $table->unsignedBigInteger('tahun_ajaran_id')->nullable();
                $table->integer('semester')->default(1);
                $table->string('tema_projek')->nullable();
                $table->string('judul_projek')->nullable();
                $table->text('deskripsi_projek')->nullable();
                $table->string('sub_judul_kegiatan')->nullable();
                $table->json('penilaian_dimensi')->nullable();
                $table->text('catatan_pengampu')->nullable();
                $table->text('capaian_hafalan')->nullable();
                $table->string('nama_sekolah')->nullable();
                $table->string('fase')->nullable();
                $table->string('kelas_label')->nullable();
                $table->string('tempat_rapor')->default('Sigi');
                $table->string('tanggal_rapor')->default('20 Desember 2025');
                $table->string('nama_walas')->default('Nabilah Tul Islamiyah, S.Pd');
                $table->string('nama_kepsek')->default('Rajihul Haq, S.Sos');
                $table->string('ttd_walas')->nullable();
                $table->string('ttd_kepsek')->nullable();
                $table->timestamps();

                $table->index(['siswa_id', 'tahun_ajaran_id', 'semester']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasi_rapor_tahfidz');
    }
};
