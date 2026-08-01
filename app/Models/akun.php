<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\identitas_rahasia;

class akun extends Model
{
    protected $table = "akun";
    public $timestamps = false;

    protected $fillable = [
        "email",
        "username",
        "noWa",
        "gender",
        "password",
        "identity_id"
    ];

    public function identitas(){
        return $this->belongsTo(identitas_rahasia::class,"identity_id");
    }
}
