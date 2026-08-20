<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengajuan extends Model
{
    protected $table = "pengajuan";

    protected $fillable = [
        "jenis_pengajuan",
        "isi",
        "konfirmasi",
        "guru_id"
    ];
}
