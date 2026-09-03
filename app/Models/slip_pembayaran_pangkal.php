<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slip_pembayaran_pangkal extends Model
{
    protected $table = "slip_pembayaran_pangkal";
    protected $fillable = [
        "nominal",
        "jumlah_dibayar",
        "siswa_id",
        "status"
    ];
}
