<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("laporan_tahfiz", function (Blueprint $table) {
            $table->id();
            $table->date("tanggal");

            // Setoran ziyadah (hafalan baru) hari ini
            $table->string("ziyadah_surah")->nullable();
            $table->integer("ziyadah_ayat_dari")->nullable();
            $table->integer("ziyadah_ayat_sampai")->nullable();

            // Setoran murojaah hari ini
            $table->string("murojaah_surah")->nullable();
            $table->integer("murojaah_ayat_dari")->nullable();
            $table->integer("murojaah_ayat_sampai")->nullable();

            // PR ziyadah untuk persiapan di rumah
            $table->string("pr_ziyadah_surah")->nullable();
            $table->integer("pr_ziyadah_ayat_dari")->nullable();
            $table->integer("pr_ziyadah_ayat_sampai")->nullable();

            // PR murojaah untuk persiapan di rumah
            $table->string("pr_murojaah_surah")->nullable();
            $table->integer("pr_murojaah_ayat_dari")->nullable();
            $table->integer("pr_murojaah_ayat_sampai")->nullable();

            $table->integer("jumlah_halaman")->default(0);
            $table->enum("kondisi_hafalan", ["lancar", "belum_lancar"]);
            $table->text("catatan")->nullable(); // ditampilkan sebagai catatan pengampu ke wali murid

            $table->foreignId("siswa_id")->constrained("siswa")->cascadeOnDelete();
            $table->foreignId("halaqah_id")->constrained("halaqah")->cascadeOnDelete();
            $table->foreignId("guru_id")->constrained("guru")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("laporan_tahfiz");
    }
};
