<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class otp_operator extends Model
{
    protected $table = "otp_operator";
    public $timestamps = false;

    protected $fillable = [
        "kode_otp",
        "otp_expired_at",
        "operator_id"
    ];
}
