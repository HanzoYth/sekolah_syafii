<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tunjangan_potongan extends Model
{
    protected $table  = "tunjangan_potongan";
    public $timestamps = true;
    protected $fillable = [
        "nama_potongan",
        "nominal",
        "guru_id"
    ];
}
