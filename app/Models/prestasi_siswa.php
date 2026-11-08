<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class prestasi_siswa extends Model
{
    protected $table = 'prestasi_siswa';

    protected $fillable = [
        'siswa_id',
        'tahun_ajaran_id',
        'semester',
        'nama_prestasi',
        'kategori',
        'keterangan',
        'created_by',
    ];

    protected $casts = [
        'semester' => 'integer',
    ];

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'siswa_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(tahun_ajaran::class, 'tahun_ajaran_id');
    }
}

