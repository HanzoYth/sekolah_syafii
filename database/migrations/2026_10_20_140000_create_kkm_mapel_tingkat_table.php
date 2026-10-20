<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('kkm_mapel_tingkat')) {
            Schema::create('kkm_mapel_tingkat', function (Blueprint $table) {
                $table->id();
                $table->foreignId('mapel_id')->constrained('mata_pelajaran')->cascadeOnDelete();
                $table->string('tingkat', 20); // e.g. '1','2','3','4','5','6','7','8','9','10','11','12','A','B'
                $table->unsignedInteger('kkm')->default(75);
                $table->timestamps();

                $table->unique(['mapel_id', 'tingkat'], 'mapel_tingkat_unique');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kkm_mapel_tingkat');
    }
};

