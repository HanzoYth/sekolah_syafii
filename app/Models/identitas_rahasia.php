<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class identitas_rahasia extends Model
{
    protected $table = "identitas_rahasia";

    public $timestamps = false;

    protected $fillable = [
        "jenis_role",
        "identitas",
        "aktif",
    ];
}
