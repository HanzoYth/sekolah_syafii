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
        // 1. Master Jenis Prestasi (Template Prestasi Rapor yang dikelola Admin)
        if (!Schema::hasTable('master_prestasi')) {
            Schema::create('master_prestasi', function (Blueprint $table) {
                $table->id();
                $table->string('nama_prestasi');
                $table->string('kategori')->default('Tahfidz'); // Tahfidz, Akademik, Bahasa, Karakter, Lomba
                $table->string('jenjang')->default('semua'); // semua, sd, smp, tk
                $table->integer('urutan')->default(1);
                $table->boolean('aktif')->default(true);
                $table->timestamps();
            });
        }

        // 2. Pengaturan Rapor & Pengesahan (Tanggal, Kepala Sekolah, Titimangsa dikelola Admin)
        if (!Schema::hasTable('pengaturan_rapor')) {
            Schema::create('pengaturan_rapor', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('tahun_ajaran_id')->nullable();
                $table->integer('semester')->default(1);
                $table->string('jenjang')->default('semua');
                $table->string('tempat_rapor')->default('Tinggede');
                $table->string('tanggal_rapor')->default('20 Desember 2025');
                $table->string('nama_kepsek')->default('Rajihul Haq, S.Sos');
                $table->string('nip_kepsek')->default('-');
                $table->text('catatan_walas_template')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_rapor');
        Schema::dropIfExists('master_prestasi');
    }
};

