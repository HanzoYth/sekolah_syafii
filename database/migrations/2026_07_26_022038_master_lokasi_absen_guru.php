<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create("master_lokasi_absen_guru",function (Blueprint $table){
            $table->id();
            $table->string("nama_lokasi");
            $table->bigInteger("radius",false,true);
            $table->decimal("latitude",10,7);
            $table->decimal("longitude",10,7);
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
        Schema::dropIfExists("master_lokasi_absen_guru");
    }
};
