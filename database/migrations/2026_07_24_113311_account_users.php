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
        Schema::create("akun",function (Blueprint $table) {
            $table->id();
            $table->string("email")->unique();
            $table->string("username")->unique();
            $table->string("noWa");
            $table->enum("gender",["p","l"]);
            $table->string("password");
            $table->boolean("aktif")->default(1);
            $table->foreignId("identity_id")->constrained("identitas_rahasia")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("akun");
    }
};
