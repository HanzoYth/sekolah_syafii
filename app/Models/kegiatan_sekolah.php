<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kegiatan_sekolah extends Model
{
    protected $table = 'kegiatan_sekolah';

    protected $fillable = [
        'jenjang',
        'nama_kegiatan',
        'keterangan_default',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer',
    ];
}

