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
        if (Schema::hasTable('wallas')) {
            Schema::table('wallas', function (Blueprint $table) {
                if (!Schema::hasColumn('wallas', 'ttd_walas')) {
                    $table->longText('ttd_walas')->nullable()->after('kelas_id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('wallas')) {
            Schema::table('wallas', function (Blueprint $table) {
                if (Schema::hasColumn('wallas', 'ttd_walas')) {
                    $table->dropColumn('ttd_walas');
                }
            });
        }
    }
};
