<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slip_pembayaran_ipp extends Model
{
    protected $table = "slip_pembayaran_ipp";
    protected $fillable = [
        "nominal",
        "tanggal_awal",
        "tanggal_akhir",
        "jumlah_di_bayar",
        "jumlah_tunggakan",
        "siswa_id"
    ];
}
