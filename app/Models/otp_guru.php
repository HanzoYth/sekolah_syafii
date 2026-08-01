<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class otp_guru extends Model
{
    protected $table = "otp_guru";
    public $timestamps = false;

    protected $fillable = [
        "kode_otp",
        "otp_expired_at",
        "guru_id"
    ];

}
