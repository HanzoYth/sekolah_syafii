<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slip_pembayaran_pendidikan extends Model
{
    protected $table = "slip_pembayaran_pendidikan";
    protected $fillable = [
        "nominal",
        "jumlah_di_bayar",
        "siswa_id",
        "status"
    ];
}
