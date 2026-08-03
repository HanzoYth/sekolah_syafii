<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("jadwal_pelajaran", function (Blueprint $table) {
            $table->id();
            $table->enum("hari", ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu"]);
            $table->foreignId("kelas_id")->constrained("kelas")->cascadeOnDelete();
            $table->foreignId("mapel_id")->constrained("mata_pelajaran")->cascadeOnDelete();
            $table->foreignId("guru_id")->constrained("guru")->cascadeOnDelete();
            $table->foreignId("jam_pelajaran_id")->constrained("jam_pelajaran")->cascadeOnDelete();
            $table->foreignId("tahun_ajaran_id")->constrained("tahun_ajaran")->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("jadwal_pelajaran");
    }
};
