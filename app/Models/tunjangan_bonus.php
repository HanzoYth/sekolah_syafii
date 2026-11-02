<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tunjangan_bonus extends Model
{
    protected $table  = "tunjangan_bonus";
    public $timestamps = true;
    protected $fillable = [
        "nama_tunjangan_bonus",
        "nominal",
        "guru_id"
    ];
}
