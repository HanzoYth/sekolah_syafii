<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class master_lokasi_absen_guru extends Model
{
    protected $table = "master_lokasi_absen_guru";

    protected $fillable = [
        "nama_lokasi",
        "radius",
        "latitude",
        "longitude",
        "current_at",
        "cabang_id"
    ];
}
