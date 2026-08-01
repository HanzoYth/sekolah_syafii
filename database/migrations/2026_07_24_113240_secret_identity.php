<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create("identitas_rahasia",function (Blueprint $table) {
            $table->id();
            $table->enum("jenis_role",["a","g","s"]);
            $table->string("identitas")->unique();
            $table->boolean("aktif")->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("identitas_rahasia");
    }
};
