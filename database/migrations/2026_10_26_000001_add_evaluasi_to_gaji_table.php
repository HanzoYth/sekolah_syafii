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
        if (Schema::hasTable('gaji') && !Schema::hasColumn('gaji', 'evaluasi')) {
            Schema::table('gaji', function (Blueprint $table) {
                $table->text('evaluasi')->nullable()->after('guru_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('gaji') && Schema::hasColumn('gaji', 'evaluasi')) {
            Schema::table('gaji', function (Blueprint $table) {
                $table->dropColumn('evaluasi');
            });
        }
    }
};

