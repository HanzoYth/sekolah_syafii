<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create("master_waktu_absen_guru",function (Blueprint $table) {
            $table->id();
            $table->string("hari");
            $table->time("waktu_masuk");
            $table->time("waktu_keluar");
            $table->timestamp("current_at")->useCurrent();
            $table->timestamps();
            $table->foreignId("cabang_id")->constrained("cabang_guru")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("master_waktu_absen_guru");
    }
};
