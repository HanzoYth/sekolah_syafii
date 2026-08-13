<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tunjangan extends Model
{
    protected $table = "tunjangan";
    public $timestamps = false;
    protected $fillable = [
        "nama_tunjangan",
        "nominal",
        "guru_id"
    ];
}
