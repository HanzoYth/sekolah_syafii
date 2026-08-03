<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("halaqah", function (Blueprint $table) {
            $table->id();
            $table->string("nama_halaqah");
            $table->foreignId("kelas_id")->constrained("kelas")->cascadeOnDelete();
            $table->foreignId("guru_id")->constrained("guru")->cascadeOnDelete(); // pengampu
            $table->foreignId("tahun_ajaran_id")->nullable()->constrained("tahun_ajaran")->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("halaqah");
    }
};
