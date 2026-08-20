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
        Schema::create("pengajuan",function (Blueprint $table) {
            $table->id();
            $table->enum("status_pengajuan",["s","i"]);
            $table->string("isi");
            $table->boolean("konfirmasi")->default(0);
            $table->foreignId("guru_id")->constrained("guru")->cascadeOnDelete();   
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("pengajuan");
    }
};
