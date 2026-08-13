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
        Schema::create("tunjangan",function (Blueprint $table){
            $table->id();
            $table->string("nama_tunjangan");
            $table->decimal("nominal",15,2);
            $table->foreignId("guru_id")->constrained("guru")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("tunjangan");
    }
};
