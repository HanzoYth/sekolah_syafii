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
        // 1. Master Program Kegiatan Sekolah (Dikelola oleh Admin)
        if (!Schema::hasTable('kegiatan_sekolah')) {
            Schema::create('kegiatan_sekolah', function (Blueprint $table) {
                $table->id();
                $table->string('jenjang', 20)->default('semua'); // 'semua', 'tk', 'sd', 'smp', 'sma'
                $table->string('nama_kegiatan');
                $table->text('keterangan_default')->nullable();
                $table->integer('urutan')->default(1);
                $table->boolean('aktif')->default(true);
                $table->timestamps();
            });
        }

        // 2. Evaluasi Rapor Santri (Catatan Wali Kelas & Evaluasi Kegiatan Per Santri)
        if (!Schema::hasTable('evaluasi_rapor_siswa')) {
            Schema::create('evaluasi_rapor_siswa', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('siswa_id');
                $table->unsignedBigInteger('tahun_ajaran_id')->nullable();
                $table->integer('semester')->default(1);
                $table->text('catatan_walas')->nullable();
                $table->json('evaluasi_kegiatan')->nullable(); // format: [{kegiatan, predikat, keterangan}]
                $table->string('tanggal_rapor')->nullable();
                $table->string('nama_kepsek')->nullable();
                $table->string('nama_walas')->nullable();
                $table->timestamps();

                $table->index(['siswa_id', 'tahun_ajaran_id', 'semester']);
            });
        }

        // 3. Prestasi Santri (Diinput oleh Walas / Admin)
        if (!Schema::hasTable('prestasi_siswa')) {
            Schema::create('prestasi_siswa', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('siswa_id');
                $table->unsignedBigInteger('tahun_ajaran_id')->nullable();
                $table->integer('semester')->default(1);
                $table->string('nama_prestasi'); // misal: "Tasmi hafalan juz 30 & 29 sekali duduk"
                $table->string('kategori')->default('Umum'); // Tahfidz, Akademik, Bahasa, Karakter
                $table->text('keterangan')->nullable();
                $table->string('created_by')->default('walas'); // 'walas' atau 'admin'
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
        Schema::dropIfExists('prestasi_siswa');
        Schema::dropIfExists('evaluasi_rapor_siswa');
        Schema::dropIfExists('kegiatan_sekolah');
    }
};

