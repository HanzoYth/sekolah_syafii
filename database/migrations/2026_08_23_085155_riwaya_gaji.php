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
        Schema::create("riwayat_gaji",function(Blueprint $table) {
            $table->id();
            $table->decimal("gaji_pokok",15,2);
            $table->decimal("gaji_honor",15,2);
            $table->decimal("gaji_tugas_tambahan",15,2);
            $table->decimal("potongan_tidak_hadir",15,2);
            $table->decimal("potongan_keterlambatan",15,2);
            $table->decimal("kasbon",15,2);
            $table->decimal("gaji_tambahan",15,2);
            $table->decimal("bonus",15,2);
            $table->string("tugas_tambahan")->default("tidak ada tugas tambahan yang di berikan");
            $table->timestamps();
            $table->foreignId("guru_id")->constrained("guru")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("riwayat_gaji");
    }
};
