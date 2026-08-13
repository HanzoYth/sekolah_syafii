<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $table = "kelas";
    public $timestamps = false;
    protected $fillable = [
        "nama_kelas"
    ];
}
