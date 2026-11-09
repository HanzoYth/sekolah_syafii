<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_prestasi extends Model
{
    use HasFactory;

    protected $table = 'master_prestasi';

    protected $fillable = [
        'nama_prestasi',
        'kategori',
        'jenjang',
        'urutan',
        'aktif'
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer'
    ];
}

