<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class otp_satpam extends Model
{
    protected $table = "otp_satpam";
    public $timestamps = false;

    protected $fillable = [
        "kode_otp",
        "otp_expired_at",
        "satpam_id"
    ];
}
