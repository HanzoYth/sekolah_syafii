<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("target_hafalan", function (Blueprint $table) {
            $table->id();
            $table->date("tanggal");
            $table->integer("target_halaman");
            $table->foreignId("halaqah_id")->constrained("halaqah")->cascadeOnDelete();
            $table->foreignId("siswa_id")->nullable()->constrained("siswa")->cascadeOnDelete(); // kosong = target untuk 1 halaqah
            $table->foreignId("guru_id")->constrained("guru")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("target_hafalan");
    }
};
