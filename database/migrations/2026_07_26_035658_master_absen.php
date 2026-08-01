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
        Schema::create("master_absensi",function (Blueprint $table){
            $table->id();
            $table->time("waktu_masuk");
            $table->time("waktu_keluar");
            $table->date("tgl_masuk");
            $table->enum("status_kehadiran",["a","h","i","s"]);
            $table->integer("terlambat_menit");
            $table->foreignId("cabang_id")->constrained("cabang_guru")->cascadeOnDelete();
            $table->foreignId("guru_id")->constrained("guru")->cascadeOnDelete();
            $table->foreignId("lokasi_id")->constrained("master_lokasi_absen_guru")->cascadeOnDelete();
            $table->foreignId("waktu_id")->constrained("master_waktu_absen_guru")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("master_absensi");
    }
};
