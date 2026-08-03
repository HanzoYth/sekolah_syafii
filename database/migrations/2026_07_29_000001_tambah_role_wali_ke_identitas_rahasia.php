<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Menambahkan role "w" (wali murid) ke enum jenis_role.
     * Role sebelumnya: a=admin, g=guru, s=siswa.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE identitas_rahasia MODIFY jenis_role ENUM('a','g','s','w') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE identitas_rahasia MODIFY jenis_role ENUM('a','g','s') NOT NULL");
    }
};
