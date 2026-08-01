<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class master_waktu_absen_guru extends Model
{
    protected $table = "master_waktu_absen_guru";

    protected $fillable = [
        "hari",
        "waktu_masuk",
        "waktu_keluar",
        "current_at",
        "cabang_id"
    ];
}
