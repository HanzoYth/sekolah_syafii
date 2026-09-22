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
        Schema::create("yayasan",function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->string("agama");
            $table->string("alamat");
            $table->enum("gender",["p","l"]);
            $table->foreignId("user_id")->constrained("akun")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("yayasan");
    }
};
