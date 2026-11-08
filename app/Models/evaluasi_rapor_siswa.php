<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class evaluasi_rapor_siswa extends Model
{
    protected $table = 'evaluasi_rapor_siswa';

    protected $fillable = [
        'siswa_id',
        'tahun_ajaran_id',
        'semester',
        'catatan_walas',
        'evaluasi_kegiatan',
        'tanggal_rapor',
        'nama_kepsek',
        'nama_walas',
    ];

    protected $casts = [
        'evaluasi_kegiatan' => 'array',
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

