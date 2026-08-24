<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class riwayat_tunjangan extends Model
{
    protected $table = "riwayat_tunjangan";
    protected $fillable = [
        "nama_tunjangan",
        "nominal",
        "guru_id"
    ];
}
