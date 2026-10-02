<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class riwayat_tunjangan_potongan extends Model
{
    protected $table  = "riwayat_tunjangan_potongan";
    public $timestamps = true;
    protected $fillable = [
        "nama_potongan",
        "nominal",
        "guru_id"
    ];
}
