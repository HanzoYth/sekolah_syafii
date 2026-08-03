<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("nilai", function (Blueprint $table) {
            $table->id();
            $table->decimal("nilai", 5, 2);
            $table->enum("semester", ["ganjil", "genap"]);
            $table->boolean("terkunci")->default(0);
            $table->foreignId("siswa_id")->constrained("siswa")->cascadeOnDelete();
            $table->foreignId("mapel_id")->constrained("mata_pelajaran")->cascadeOnDelete();
            $table->foreignId("guru_id")->constrained("guru")->cascadeOnDelete();
            $table->foreignId("jenis_penilaian_id")->constrained("jenis_penilaian")->cascadeOnDelete();
            $table->foreignId("tahun_ajaran_id")->constrained("tahun_ajaran")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("nilai");
    }
};
