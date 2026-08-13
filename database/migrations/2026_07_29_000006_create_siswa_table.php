<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("siswa", function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("nis")->unique();
            $table->string("tempat_lahir")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->enum("gender", ["l", "p"]);
            $table->string("alamat")->nullable();
            $table->string("url_foto")->nullable();
            $table->boolean("aktif")->default(1);
            $table->foreignId("kelas_id")->nullable()->constrained("ruang_kelas")->nullOnDelete();
            $table->foreignId("tahun_ajaran_id")->nullable()->constrained("tahun_ajaran")->nullOnDelete();
            $table->foreignId("user_id")->nullable()->constrained("akun")->nullOnDelete();
            $table->foreignId("sekolah_id")->constrained("jenis_sekolah")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("siswa");
    }
};
