<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("pengumuman", function (Blueprint $table) {
            $table->id();
            $table->string("judul");
            $table->text("isi");
            $table->date("tanggal");
            $table->foreignId("guru_id")->constrained("guru")->cascadeOnDelete();
            $table->foreignId("cabang_id")->constrained("cabang_guru")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("pengumuman");
    }
};
