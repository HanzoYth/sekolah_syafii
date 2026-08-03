<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table("kelas", function (Blueprint $table) {
            $table->foreignId("ruang_kelas_id")->nullable()->after("nama_kelas")
                ->constrained("ruang_kelas")->nullOnDelete();
            $table->foreignId("tahun_ajaran_id")->nullable()->after("ruang_kelas_id")
                ->constrained("tahun_ajaran")->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table("kelas", function (Blueprint $table) {
            $table->dropForeign(["ruang_kelas_id"]);
            $table->dropForeign(["tahun_ajaran_id"]);
            $table->dropColumn(["ruang_kelas_id", "tahun_ajaran_id"]);
        });
    }
};
