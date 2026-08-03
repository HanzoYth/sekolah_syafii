<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("kalender_akademik", function (Blueprint $table) {
            $table->id();
            $table->string("nama_kegiatan");
            $table->date("tanggal_mulai");
            $table->date("tanggal_selesai")->nullable();
            $table->string("keterangan")->nullable();
            $table->foreignId("tahun_ajaran_id")->constrained("tahun_ajaran")->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("kalender_akademik");
    }
};
