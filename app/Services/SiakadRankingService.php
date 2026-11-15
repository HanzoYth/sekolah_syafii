<?php

namespace App\Services;

use App\Models\jadwal_pelajaran;
use App\Models\jenis_penilaian;
use App\Models\kelas;
use App\Models\nilai;
use App\Models\ruang_kelas;
use App\Models\siswa;
use Illuminate\Support\Collection;

class SiakadRankingService
{
    /**
     * Build class subject recap, student ledger, and final class ranking context.
     * Student-facing ranking is only unlocked once every scheduled subject has complete components for all students.
     */
    public function buildClassRankingContext(?int $kelasId, ?int $targetSiswaId = null): array
    {
        $jenis_penilaian = $this->resolveJenisPenilaian();

        if (!$kelasId) {
            return $this->emptyContext($jenis_penilaian);
        }

        $siswa = siswa::where('kelas_id', $kelasId)->orderBy('nama')->get();
        $total_siswa = $siswa->count();

        $ruangKelas = ruang_kelas::find($kelasId);
        $nama_kelas = $ruangKelas->nama_ruang ?? '';
        $kelas = $nama_kelas !== '' ? kelas::where('nama_kelas', $nama_kelas)->first() : null;
        $kelas_id_jadwal = $kelas ? $kelas->id : $kelasId;

        $jadwal_kelas = jadwal_pelajaran::with(['mata_pelajaran', 'guru', 'jam_pelajaran', 'tahun_ajaran'])
            ->where('kelas_id', $kelas_id_jadwal)
            ->get();

        $daftar_jadwal_mapel = $jadwal_kelas->unique('mapel_id')->values();
        $jumlah_komponen = $jenis_penilaian->count();

        $nilai_db = $siswa->isNotEmpty()
            ? nilai::with(['mata_pelajaran', 'jenis_penilaian'])
                ->whereIn('siswa_id', $siswa->pluck('id'))
                ->get()
            : collect();

        $map_nilai = [];
        foreach ($nilai_db as $n) {
            $map_nilai[$n->siswa_id][$n->mapel_id][$n->jenis_penilaian_id] = $n->nilai;
        }

        $rekap_mapel = $this->buildRekapMapel(
            $daftar_jadwal_mapel,
            $siswa,
            $map_nilai,
            $jenis_penilaian,
            $jumlah_komponen,
            $total_siswa
        );

        $total_mapel_kelas = $daftar_jadwal_mapel->count();
        $leger_temp = $this->buildLegerTemp(
            $daftar_jadwal_mapel,
            $siswa,
            $map_nilai,
            $jenis_penilaian,
            $jumlah_komponen,
            $total_mapel_kelas
        );

        $sorted_by_score = collect($leger_temp)
            ->filter(fn ($item) => ($item['mapel_terisi'] ?? 0) > 0)
            ->sort(function ($a, $b) {
                if ($a['total_nilai'] !== $b['total_nilai']) {
                    return $b['total_nilai'] <=> $a['total_nilai'];
                }
                if ($a['rata_rata'] !== $b['rata_rata']) {
                    return $b['rata_rata'] <=> $a['rata_rata'];
                }
                return strcmp((string) ($a['siswa']->nama ?? ''), (string) ($b['siswa']->nama ?? ''));
            })
            ->values();

        $rank_map = [];
        foreach ($sorted_by_score as $idx => $item) {
            $rank_map[$item['siswa']->id] = $idx + 1;
        }

        $leger_siswa = collect($leger_temp)->map(function ($item) use ($rank_map) {
            $item['peringkat'] = $rank_map[$item['siswa']->id] ?? '-';
            return (object) $item;
        });

        $mapel_sudah_input = $rekap_mapel->where('siswa_dinilai', '>', 0)->count();
        $mapel_lengkap = $rekap_mapel->where('status_input', 'lengkap')->count();
        $stats_nilai = [
            'total_mapel' => $total_mapel_kelas,
            'mapel_sudah_input' => $mapel_sudah_input,
            'mapel_lengkap' => $mapel_lengkap,
            'rata_kelas' => $mapel_sudah_input > 0
                ? round($rekap_mapel->where('siswa_dinilai', '>', 0)->avg('rata_rata'), 1)
                : 0,
        ];

        $finalReady = $total_mapel_kelas > 0
            && $total_siswa > 0
            && $jumlah_komponen > 0
            && $mapel_lengkap === $total_mapel_kelas;

        $top3 = collect();
        if ($finalReady) {
            $top3 = $sorted_by_score->take(3)->values()->map(function ($item, $idx) {
                $s = $item['siswa'];
                return (object) [
                    'peringkat' => $idx + 1,
                    'siswa_id' => (int) $s->id,
                    'nama' => $s->nama ?? '-',
                    'inisial' => $this->extractInitials($s->nama ?? 'S'),
                    'rata_rata' => $item['rata_rata'],
                    'total_nilai' => $item['total_nilai'],
                    'predikat' => $item['predikat'],
                ];
            });
        }

        $ranking_siswa = [
            'final_ready' => $finalReady,
            'total_siswa' => $total_siswa,
            'total_ranked' => $sorted_by_score->count(),
            'total_mapel' => $total_mapel_kelas,
            'mapel_lengkap' => $mapel_lengkap,
            'peringkat_siswa' => ($finalReady && $targetSiswaId) ? ($rank_map[(int) $targetSiswaId] ?? null) : null,
            'top3' => $top3,
        ];

        return [
            'siswa' => $siswa,
            'jadwal_kelas' => $jadwal_kelas,
            'daftar_jadwal_mapel' => $daftar_jadwal_mapel,
            'jenis_penilaian' => $jenis_penilaian,
            'rekap_mapel' => $rekap_mapel,
            'leger_siswa' => $leger_siswa,
            'rank_map' => $rank_map,
            'stats_nilai' => $stats_nilai,
            'ranking_siswa' => $ranking_siswa,
        ];
    }

    private function emptyContext(Collection $jenisPenilaian): array
    {
        return [
            'siswa' => collect(),
            'jadwal_kelas' => collect(),
            'daftar_jadwal_mapel' => collect(),
            'jenis_penilaian' => $jenisPenilaian,
            'rekap_mapel' => collect(),
            'leger_siswa' => collect(),
            'rank_map' => [],
            'stats_nilai' => [
                'total_mapel' => 0,
                'mapel_sudah_input' => 0,
                'mapel_lengkap' => 0,
                'rata_kelas' => 0,
            ],
            'ranking_siswa' => [
                'final_ready' => false,
                'total_siswa' => 0,
                'total_ranked' => 0,
                'total_mapel' => 0,
                'mapel_lengkap' => 0,
                'peringkat_siswa' => null,
                'top3' => collect(),
            ],
        ];
    }

    private function resolveJenisPenilaian(): Collection
    {
        $jenis = jenis_penilaian::all();
        if ($jenis->isEmpty()) {
            jenis_penilaian::insert([
                ['nama_jenis' => 'Tugas', 'bobot' => 20],
                ['nama_jenis' => 'Ulangan Harian', 'bobot' => 30],
                ['nama_jenis' => 'UTS', 'bobot' => 20],
                ['nama_jenis' => 'UAS', 'bobot' => 30],
            ]);
            $jenis = jenis_penilaian::all();
        }

        return $jenis;
    }

    private function calculateWeightedScore(array $komponenSiswa, Collection $jenisPenilaian): float
    {
        $na = 0.0;
        foreach ($jenisPenilaian as $jp) {
            $skor = $komponenSiswa[$jp->id] ?? 0;
            $na += ($skor * ($jp->bobot / 100));
        }

        return $na;
    }

    private function buildRekapMapel(
        Collection $daftarJadwalMapel,
        Collection $siswa,
        array $mapNilai,
        Collection $jenisPenilaian,
        int $jumlahKomponen,
        int $totalSiswa
    ): Collection {
        $rekap_mapel = collect();

        foreach ($daftarJadwalMapel as $j) {
            $mapel_id = $j->mapel_id;
            $kkm = $j->getKkm();
            $siswa_dinilai = 0;
            $siswa_lengkap = 0;
            $siswa_tuntas = 0;
            $siswa_remedi = 0;
            $total_na_mapel = 0;

            foreach ($siswa as $s) {
                $komponen_siswa = $mapNilai[$s->id][$mapel_id] ?? [];
                if (count($komponen_siswa) > 0) {
                    $siswa_dinilai++;
                    if (count($komponen_siswa) >= $jumlahKomponen) {
                        $siswa_lengkap++;
                    }
                    $na = $this->calculateWeightedScore($komponen_siswa, $jenisPenilaian);
                    $total_na_mapel += $na;
                    if ($na >= $kkm) {
                        $siswa_tuntas++;
                    } else {
                        $siswa_remedi++;
                    }
                }
            }

            $rata_mapel = $siswa_dinilai > 0 ? round($total_na_mapel / $siswa_dinilai, 1) : 0;

            $rekap_mapel->push((object) [
                'jadwal_id' => $j->id,
                'mapel_id' => $mapel_id,
                'nama_mapel' => $j->mata_pelajaran->nama_mapel ?? '-',
                'kkm' => $kkm,
                'guru_nama' => $j->guru->nama ?? '-',
                'hari' => ucfirst($j->hari ?? '-'),
                'jam_mulai' => substr($j->jam_pelajaran->jam_mulai ?? '', 0, 5),
                'jam_selesai' => substr($j->jam_pelajaran->jam_selesai ?? '', 0, 5),
                'total_siswa' => $totalSiswa,
                'siswa_dinilai' => $siswa_dinilai,
                'siswa_lengkap' => $siswa_lengkap,
                'siswa_tuntas' => $siswa_tuntas,
                'siswa_remedi' => $siswa_remedi,
                'rata_rata' => $rata_mapel,
                'status_input' => $siswa_dinilai === 0
                    ? 'belum_input'
                    : ($siswa_lengkap >= $totalSiswa && $totalSiswa > 0 ? 'lengkap' : 'sebagian'),
            ]);
        }

        return $rekap_mapel;
    }

    private function buildLegerTemp(
        Collection $daftarJadwalMapel,
        Collection $siswa,
        array $mapNilai,
        Collection $jenisPenilaian,
        int $jumlahKomponen,
        int $totalMapelKelas
    ): array {
        $leger_temp = [];

        foreach ($siswa as $s) {
            $nilai_per_mapel = [];
            $total_nilai_siswa = 0;
            $jumlah_mapel_terisi = 0;

            foreach ($daftarJadwalMapel as $j) {
                $m_id = $j->mapel_id;
                $kkm = $j->getKkm();
                $komponen_siswa = $mapNilai[$s->id][$m_id] ?? [];

                if (count($komponen_siswa) > 0) {
                    $na_round = round($this->calculateWeightedScore($komponen_siswa, $jenisPenilaian), 1);
                    $nilai_per_mapel[$m_id] = [
                        'ada' => true,
                        'nilai_akhir' => $na_round,
                        'tuntas' => $na_round >= $kkm,
                        'lengkap' => count($komponen_siswa) >= $jumlahKomponen,
                    ];
                    $total_nilai_siswa += $na_round;
                    $jumlah_mapel_terisi++;
                } else {
                    $nilai_per_mapel[$m_id] = [
                        'ada' => false,
                        'nilai_akhir' => null,
                        'tuntas' => false,
                        'lengkap' => false,
                    ];
                }
            }

            $rata_siswa = $jumlah_mapel_terisi > 0 ? round($total_nilai_siswa / $jumlah_mapel_terisi, 1) : 0;
            $predikat = '-';
            if ($jumlah_mapel_terisi > 0) {
                if ($rata_siswa >= 90) {
                    $predikat = 'A';
                } elseif ($rata_siswa >= 80) {
                    $predikat = 'B';
                } elseif ($rata_siswa >= 75) {
                    $predikat = 'C';
                } else {
                    $predikat = 'D';
                }
            }

            $leger_temp[] = [
                'siswa' => $s,
                'nilai_mapel' => $nilai_per_mapel,
                'total_nilai' => round($total_nilai_siswa, 1),
                'rata_rata' => $rata_siswa,
                'mapel_terisi' => $jumlah_mapel_terisi,
                'total_mapel' => $totalMapelKelas,
                'predikat' => $predikat,
            ];
        }

        return $leger_temp;
    }

    private function extractInitials(string $nama): string
    {
        $words = preg_split('/\s+/', trim($nama)) ?: ['S'];
        $first = strtoupper(substr($words[0] ?? 'S', 0, 1));
        $second = strtoupper(substr($words[1] ?? '', 0, 1));

        return $first . $second;
    }
}
