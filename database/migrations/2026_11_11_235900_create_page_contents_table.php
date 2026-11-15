<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('page_contents')) {
            Schema::create('page_contents', function (Blueprint $table) {
                $table->id();
                $table->string('page_key', 120)->unique();
                $table->longText('content_json')->nullable();
                $table->string('updated_by', 100)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
