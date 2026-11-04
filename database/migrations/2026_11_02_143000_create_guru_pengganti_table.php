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
        if (!Schema::hasTable('guru_pengganti')) {
            Schema::create('guru_pengganti', function (Blueprint $table) {
                $table->id();
                $table->foreignId('jadwal_pelajaran_id')->constrained('jadwal_pelajaran')->cascadeOnDelete();
                $table->foreignId('guru_asli_id')->constrained('guru')->cascadeOnDelete();
                $table->foreignId('guru_pengganti_id')->nullable()->constrained('guru')->nullOnDelete();
                $table->date('tanggal');
                $table->enum('status', ['kosong', 'diambil', 'selesai', 'dibatalkan'])->default('kosong');
                $table->string('alasan_izin')->nullable();
                $table->text('keterangan_tugas')->nullable();
                $table->timestamp('taken_at')->nullable();
                $table->timestamps();

                $table->unique(['jadwal_pelajaran_id', 'tanggal'], 'uniq_jadwal_tgl_pengganti');
                $table->index(['tanggal', 'status']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_pengganti');
    }
};

