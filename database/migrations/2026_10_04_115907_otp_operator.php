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
        Schema::create("otp_operator",function (Blueprint $table) {
            $table->id();
            $table->string("kode_otp");
            $table->timestamp("otp_expired_at");
            $table->foreignId("operator_id")->constrained("operator")->cascadeOnDelete();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("otp_operator");
    }
};
