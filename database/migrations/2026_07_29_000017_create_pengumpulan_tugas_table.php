<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("pengumpulan_tugas", function (Blueprint $table) {
            $table->id();
            $table->string("file_url");
            $table->dateTime("waktu_kumpul");
            $table->decimal("nilai", 5, 2)->nullable();
            $table->enum("status", ["belum", "tepat_waktu", "terlambat"])->default("tepat_waktu");
            $table->foreignId("tugas_id")->constrained("tugas")->cascadeOnDelete();
            $table->foreignId("siswa_id")->constrained("siswa")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("pengumpulan_tugas");
    }
};
