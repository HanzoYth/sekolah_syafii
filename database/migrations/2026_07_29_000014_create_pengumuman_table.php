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
            $table->foreignId("user_id")->constrained("akun")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("pengumuman");
    }
};
