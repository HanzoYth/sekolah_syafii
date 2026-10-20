<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class jam_pelajaran extends Model
{
    protected $table = 'jam_pelajaran';
    public $timestamps = false;
    protected $guarded = [];

    public function sekolah()
    {
        return $this->belongsTo(jenis_sekolah::class, 'sekolah_id');
    }

    /**
     * Cek apakah jenjang menggunakan sistem JP (TK/PAUD tidak menggunakan sistem JP)
     */
    public static function pakaiSistemJp($jenis = null): bool
    {
        $kode = strtolower(trim((string) $jenis));
        if (str_contains($kode, 'tk') || str_contains($kode, 'paud')) {
            return false;
        }
        return true;
    }

    /**
     * Standar durasi 1 JP (dalam menit) berdasarkan jenjang sekolah
     * SD = 35 menit, SMP = 45 menit, SMA = 45 menit (TK tidak pakai JP)
     */
    public static function standarMenitPerJp($jenis = null): int
    {
        $kode = strtolower(trim((string) $jenis));
        if (str_contains($kode, 'sd')) return 35;
        if (str_contains($kode, 'smp')) return 45;
        if (str_contains($kode, 'sma') || str_contains($kode, 'smk')) return 45;
        return 35;
    }

    /**
     * Apakah baris jam pelajaran ini menggunakan sistem JP
     */
    public function getIsPakaiJpAttribute(): bool
    {
        if ($this->sekolah && !empty($this->sekolah->jenis)) {
            return self::pakaiSistemJp($this->sekolah->jenis);
        }
        return true;
    }

    /**
     * Total durasi rentang waktu dalam menit
     */
    public function getDurasiMenitAttribute(): int
    {
        if (!$this->jam_mulai || !$this->jam_selesai) {
            return 0;
        }
        try {
            $mulai = Carbon::parse($this->jam_mulai);
            $selesai = Carbon::parse($jam_selesai = $this->jam_selesai);
            $diff = $mulai->diffInMinutes($selesai, false);
            return max(0, (int) $diff);
        } catch (\Throwable $e) {
            return 0;
        }
    }

    /**
     * Standar menit per 1 JP pada baris jam pelajaran ini
     */
    public function getMenitPerJpAttribute(): int
    {
        if (!empty($this->durasi_per_jp) && $this->durasi_per_jp > 0) {
            return (int) $this->durasi_per_jp;
        }
        if ($this->sekolah && !empty($this->sekolah->jenis)) {
            return self::standarMenitPerJp($this->sekolah->jenis);
        }
        $durasi = $this->durasi_menit;
        if ($durasi > 0) {
            if ($durasi % 45 === 0) return 45;
            if ($durasi % 35 === 0) return 35;
        }
        return 35;
    }

    /**
     * Hitung jumlah JP (Jam Pelajaran). Jika TK (tidak pakai JP), kembalikan 0.
     */
    public function getHitungJpAttribute(): int
    {
        if (!$this->is_pakai_jp) {
            return 0;
        }
        if (!empty($this->durasi_per_jp) && !empty($this->jumlah_jp)) {
            return (int) $this->jumlah_jp;
        }
        $durasi = $this->durasi_menit;
        $perJp = $this->menit_per_jp;
        if ($durasi > 0 && $perJp > 0) {
            return max(1, (int) round($durasi / $perJp));
        }
        return (int) ($this->jumlah_jp ?: 1);
    }

    /**
     * Kode jenjang (SD / SMP / SMA / TK / UMUM)
     */
    public function getKodeJenjangAttribute(): string
    {
        if ($this->sekolah && !empty($this->sekolah->jenis)) {
            return strtoupper(trim($this->sekolah->jenis));
        }
        return 'UMUM';
    }

    /**
     * Format tampilan ringkas jam: "07:00 - 07:35"
     */
    public function getRentangWaktuAttribute(): string
    {
        $mulai = $this->jam_mulai ? substr($this->jam_mulai, 0, 5) : '-';
        $selesai = $this->jam_selesai ? substr($this->jam_selesai, 0, 5) : '-';
        return "{$mulai} - {$selesai}";
    }
}
