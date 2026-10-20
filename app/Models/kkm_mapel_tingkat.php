<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kkm_mapel_tingkat extends Model
{
    protected $table = 'kkm_mapel_tingkat';
    protected $guarded = [];

    public function mata_pelajaran()
    {
        return $this->belongsTo(mata_pelajaran::class, 'mapel_id');
    }
}

