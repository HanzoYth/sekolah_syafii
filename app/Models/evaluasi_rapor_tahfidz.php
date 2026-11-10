<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluasi_rapor_tahfidz extends Model
{
    use HasFactory;

    protected $table = 'evaluasi_rapor_tahfidz';

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'halaqah_id',
        'tahun_ajaran_id',
        'semester',
        'tema_projek',
        'judul_projek',
        'deskripsi_projek',
        'sub_judul_kegiatan',
        'penilaian_dimensi',
        'catatan_pengampu',
        'capaian_hafalan',
        'nama_sekolah',
        'fase',
        'kelas_label',
        'umur',
        'orang_tua',
        'kenaikan_juz_tanggal',
        'kenaikan_juz_nomor',
        'kenaikan_juz_predikat',
        'ujian_1',
        'ujian_2',
        'ujian_akhir',
        'ujian_jumlah',
        'ujian_rata_rata',
        'ujian_predikat',
        'tasmi_tanggal',
        'tasmi_jumlah_juz',
        'tasmi_predikat',
        'target_semester',
        'tercapai_semester',
        'target_total',
        'tercapai_total',
        'tercapai_target_semester',
        'tercapai_target_kelas',
        'catatan_bacaan',
        'catatan_hafalan',
        'catatan_akhlak',
        'tempat_rapor',
        'tanggal_rapor',
        'nama_pengampu',
        'ttd_pengampu',
        'nama_walas',
        'role_pengampu_label',
        'nama_kepsek',
        'ttd_walas',
        'ttd_kepsek'
    ];

    protected $casts = [
        'penilaian_dimensi' => 'array',
        'semester' => 'integer',
        'ujian_1' => 'float',
        'ujian_2' => 'float',
        'ujian_akhir' => 'float',
        'ujian_jumlah' => 'float',
        'ujian_rata_rata' => 'float',
        'tercapai_target_semester' => 'boolean',
        'tercapai_target_kelas' => 'boolean'
    ];

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'siswa_id');
    }

    public function guru()
    {
        return $this->belongsTo(guru::class, 'guru_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(tahun_ajaran::class, 'tahun_ajaran_id');
    }

    /**
     * Hitung Predikat Nilai Tahfidz Berdasarkan Acuan Resmi SDQU:
     * Mumtaz / A: 91 - 100
     * Jayyid Jiddan / B: 83 - 90
     * Jayyid / C: 72 - 82
     * Maqbul / D: 61 - 71
     * Dha'if / E: < 60
     */
    public static function calculatePredikat($nilai)
    {
        if ($nilai === null || $nilai === '') return '-';
        $num = (float) $nilai;
        if ($num >= 91) return 'Mumtaz/A';
        if ($num >= 83) return 'Jayyid Jiddan/B';
        if ($num >= 72) return 'Jayyid/C';
        if ($num >= 61) return 'Maqbul/D';
        return 'Dha’if/E';
    }

    /**
     * Hitung Usia Otomatis dari Tanggal Lahir
     */
    public static function calculateAge($tanggalLahir)
    {
        if (!$tanggalLahir) return '12 TAHUN';
        try {
            $birth = new \DateTime($tanggalLahir);
            $today = new \DateTime();
            $diff = $today->diff($birth);
            return $diff->y . ' TAHUN';
        } catch (\Exception $e) {
            return '12 TAHUN';
        }
    }

    /**
     * Default template acuan resmi Raport Tahfizh Al-Qur'an SDQU Imam Syafi'i Tinggede
     */
    public static function getDefaultTemplate($siswa = null)
    {
        $kelasNama = 'VI (ENAM)';
        if ($siswa && $siswa->kelas) {
            $raw = $siswa->kelas->nama_ruang ?? $siswa->kelas->nama_kelas ?? '';
            if (preg_match('/(\d+)/', $raw, $m)) {
                $angka = (int) $m[1];
                $romawi = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX'];
                $terbilang = [1 => 'SATU', 2 => 'DUA', 3 => 'TIGA', 4 => 'EMPAT', 5 => 'LIMA', 6 => 'ENAM', 7 => 'TUJUH', 8 => 'DELAPAN', 9 => 'SEMBILAN'];
                $r = $romawi[$angka] ?? (string)$angka;
                $t = $terbilang[$angka] ?? '';
                $kelasNama = $r . ($t ? ' (' . $t . ')' : '');
            } else {
                $kelasNama = $raw ?: 'VI (ENAM)';
            }
        }

        $umur = $siswa ? self::calculateAge($siswa->tanggal_lahir) : '12 TAHUN';

        return [
            'judul_rapor' => 'RAPORT TAHFIZH AL-QUR’AN SEMESTER GANJIL 2025',
            'nama_sekolah' => 'SEKOLAH DASAR AL-QUR’AN IMAM SYAFI’I TINGGEDE',
            'nama_siswa' => $siswa->nama ?? 'MOH. IBNU MUNDZIR',
            'kelas_label' => $kelasNama,
            'umur' => $umur,
            'orang_tua' => 'Bpk. ZULFIKAR ABDUN & Ibu NAZMA SYAWIE',

            // A. Ujian Kenaikan Juz
            'kenaikan_juz_tanggal' => 'Rabu, 08 Oktober 2025',
            'kenaikan_juz_nomor' => '25',
            'kenaikan_juz_predikat' => 'Jayyid/C',

            // B. Ujian Tahfidzh
            'ujian_1' => 75.0,
            'ujian_2' => 92.0,
            'ujian_akhir' => 75.0,
            'ujian_jumlah' => 317.0,
            'ujian_rata_rata' => 79.2,
            'ujian_predikat' => 'Jayyid/C',

            // C. Tasmi' Akhir Semester
            'tasmi_tanggal' => '-',
            'tasmi_jumlah_juz' => '-',
            'tasmi_predikat' => '-',

            // D. Pencapaian Tahfizh
            'target_semester' => '1 Juz',
            'tercapai_semester' => '<1 Juz  (19 Halaman)  (Az-Zukhruf 32 – Az-Zumar 22)',
            'target_total' => '9 Juz',
            'tercapai_total' => '6,5 Juz  (An-nas – Az-Zumar 22)',
            'tercapai_target_semester' => false, // Tidak
            'tercapai_target_kelas' => false,    // Tidak

            // Catatan Pengampu Halaqah
            'catatan_bacaan' => "- Alhamdulillah pemahaman dan penerapan makharijul huruf ananda cukup baik. Ananda cukup mampu memahami konsep dasar tempat keluar huruf, namun masih sering melakukan kesalahan dalam praktiknya.\n- Alhamdulillah pemahaman ananda tentang hukum tajwid cukup baik, namun penerapannya masih belum konsisten, ananda sering lupa menerapkan hukum-hukum dasar seperti ikhfa dan mad tanpa bimbingan ustadzah. Diperlukan latihan lebih sering agar lebih fasih dengan memperbanyak tilawah.",
            'catatan_hafalan' => "Alhamdulillah ananda menunjukkan usaha yang cukup baik dalam menghafal Al-Qur’an, namun ananda masih perlu meningkatkan kelancaran hafalannya dengan memperbanyak muroja’ah. Kelancaran hafalan ananda belum stabil dan seringkali keliru menyambung ayat, baik hafalan baru maupun hafalan lama. Mohon bantuan ummu/abu untuk mendampingi dan memperhatikan proses menghafal ananda selama di rumah.",
            'catatan_akhlak' => "Alhamdulillah ananda cukup mampu menunjukkan sikap hormat kepada ustadz/ah, namun ananda masih perlu pengingat untuk selalu bersikap sopan dan menjaga tutur kata kepada teman. Mohon bantuan ummu/abu di rumah untuk menasehati ananda. Baarakallahufiikum.",

            // Tanda Tangan & Titimangsa (3 TTD: Kiri Pengampu, Kanan Wali Kelas, Tengah Bawah Kepsek)
            'tempat_rapor' => 'Sigi',
            'tanggal_rapor' => '20 Desember 2025',
            'nama_pengampu' => 'USTADZAH PENGAMPU HALAQAH',
            'nama_walas' => 'NURUL ZHAFIRAH PUTRI',
            'role_pengampu_label' => 'Wali Kelas 6',
            'nama_kepsek' => 'NABILAH TUL ISLAMIYAH S.Pd.,S.Q',
            'watermark_logo' => asset('img/logo_sd.jpg')
        ];
    }
}
