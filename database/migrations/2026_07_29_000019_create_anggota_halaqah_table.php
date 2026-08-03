<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("anggota_halaqah", function (Blueprint $table) {
            $table->id();
            $table->foreignId("halaqah_id")->constrained("halaqah")->cascadeOnDelete();
            $table->foreignId("siswa_id")->constrained("siswa")->cascadeOnDelete();
            $table->timestamps();
            $table->unique(["halaqah_id", "siswa_id"]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("anggota_halaqah");
    }
};
