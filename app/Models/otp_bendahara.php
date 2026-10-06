<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class otp_bendahara extends Model
{
    protected $table = "otp_bendahara";
    public $timestamps = false;

    protected $fillable = [
        "kode_otp",
        "otp_expired_at",
        "bendahara_id"
    ];
}
