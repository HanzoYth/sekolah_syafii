<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("guru",function (Blueprint $table){
            $table->id();
            $table->string("nama");
            $table->string("nig");
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir")->nullable();
            $table->string("agama");
            $table->string("alamat");
            $table->string("pendidikan_terakhir");
            $table->string("url_foto");
            $table->boolean("guru_honor")->default(0);
            $table->boolean("guru_tetap")->default(0);
            $table->boolean("koordinator_tahfiz")->default(0);
            $table->boolean("pengampu_tahfiz")->default(0);
            $table->boolean("kepala_sekolah")->default(0);
            $table->integer("tutup_buku")->default(1);
            $table->foreignId("cabang_id")->constrained("cabang_guru")->cascadeOnDelete();
            $table->foreignId("sekolah_id")->constrained("jenis_sekolah")->cascadeOnDelete();
            $table->foreignId("user_id")->constrained("akun")->cascadeOnDelete();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("guru");
    }
};
