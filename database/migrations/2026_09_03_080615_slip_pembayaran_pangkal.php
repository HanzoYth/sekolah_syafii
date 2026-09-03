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
        Schema::create("slip_pembayaran_pangkal",function(Blueprint $table){
            $table->id();
            $table->decimal("nominal",15,2);
            $table->decimal("jumlah_di_bayar",15,2)->default(0);
            $table->boolean("status")->default(0);
            $table->foreignId("siswa_id")->constrained("siswa")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("slip_pembayaran_pangkal");
    }
};