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
        Schema::create("tanggal_merah", function (Blueprint $table) {
            $table->id();
            $table->date("tanggal");
            $table->string("keterangan");
            $table->foreignId("cabang_id")->nullable()->constrained("cabang_guru")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("tanggal_merah");
    }
};