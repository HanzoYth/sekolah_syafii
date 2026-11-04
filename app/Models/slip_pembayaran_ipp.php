<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slip_pembayaran_ipp extends Model
{
    protected $table = "slip_pembayaran_ipp";
    protected $fillable = [
        "nominal",
        "tanggal_awal",
        "jumlah_dibayar",
        "jumlah_di_bayar",
        "status",
        "siswa_id",
        "created_at",
        "updated_at"
    ];

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'siswa_id');
    }
}

