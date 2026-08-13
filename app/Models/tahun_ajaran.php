<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tahun_ajaran extends Model
{
    protected $table = "tahun_ajaran";

    protected $fillable = [
        "nama",
        "tanggal_mulai",
        "tanggal_selesai",
        "aktif"
    ];
}
