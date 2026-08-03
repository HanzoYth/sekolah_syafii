<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("tugas", function (Blueprint $table) {
            $table->id();
            $table->string("judul");
            $table->text("deskripsi")->nullable();
            $table->string("file_url")->nullable();
            $table->dateTime("deadline");
            $table->foreignId("mapel_id")->constrained("mata_pelajaran")->cascadeOnDelete();
            $table->foreignId("kelas_id")->constrained("kelas")->cascadeOnDelete();
            $table->foreignId("guru_id")->constrained("guru")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("tugas");
    }
};
