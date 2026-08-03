<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("absensi_siswa", function (Blueprint $table) {
            $table->id();
            $table->date("tanggal");
            $table->enum("status", ["h", "i", "s", "a"]); // hadir, izin, sakit, alpha
            $table->string("keterangan")->nullable();
            $table->foreignId("siswa_id")->constrained("siswa")->cascadeOnDelete();
            $table->foreignId("kelas_id")->constrained("kelas")->cascadeOnDelete();
            $table->foreignId("guru_id")->constrained("guru")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("absensi_siswa");
    }
};
