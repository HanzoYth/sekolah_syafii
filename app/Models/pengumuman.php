<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengumuman extends Model
{
    protected $table = "pengumuman";
    protected $fillable = [
        "judul",
        "isi",
        "tanggal",
        "guru_id",
        "cabang_id"
    ];
}
