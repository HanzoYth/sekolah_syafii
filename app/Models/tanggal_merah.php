<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tanggal_merah extends Model
{
    protected $table = "tanggal_merah";


    protected $fillable = [
        "tanggal",
        "keterangan",
        "cabang_id"
    ];
}
