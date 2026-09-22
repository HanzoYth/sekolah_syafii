<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bendahara extends Model
{
    protected $table = "bendahara";
    public $timestamps = false;

    protected $fillable = [
        "nama",
        "nig",
        "tempat_lahir",
        "tanggal_lahir",
        "agama",
        "alamat",
        "pendidikan_terakhir",
        "url_foto",
        "gender",
        "cabang_id",
        "user_id"
    ];
}
