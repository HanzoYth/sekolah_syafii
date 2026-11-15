<?php

namespace Database\Seeders;

use App\Models\absensi_mengajar_guru;
use App\Models\absensi_siswa;
use App\Models\akun;
use App\Models\evaluasi_rapor_siswa;
use App\Models\guru;
use App\Models\jadwal_pelajaran;
use App\Models\nilai;
use App\Models\pengumuman;
use App\Models\prestasi_siswa;
use App\Models\siswa;
use App\Models\slip_pembayaran_ipp;
use App\Models\slip_pembayaran_pangkal;
use App\Models\slip_pembayaran_pendidikan;
use App\Models\tahun_ajaran;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DemoGianSiswaSeeder extends Seeder
{
    public function run(): void
    {
        $tahunAktif = tahun_ajaran::where('aktif', 1)->first() ?? tahun_ajaran::orderByDesc('id')->first();
        $tahunAjaranId = $tahunAktif ? (int) $tahunAktif->id : 3;

        // Jaga invariant Kelas Uji Inval (kelas_id = 16) tetap >= 2 siswa agar SiakadAbsensiDanInvalTest tidak memindahkan Gian kembali.
        foreach ([
            ['nis' => '99000016', 'nama' => 'Santri Uji Inval 1'],
            ['nis' => '99000017', 'nama' => 'Santri Uji Inval 2'],
        ] as $invalSantri) {
            siswa::updateOrCreate(
                ['nis' => $invalSantri['nis']],
                [
                    'nama' => $invalSantri['nama'],
                    'tempat_lahir' => 'Sigi',
                    'tanggal_lahir' => '2016-04-10',
                    'gender' => 'l',
                    'alamat' => 'Jl. Pendidikan No. 16, Tinggede',
                    'aktif' => 1,
                    'kelas_id' => 16,
                    'tahun_ajaran_id' => $tahunAjaranId,
                    'sekolah_id' => 1,
                ]
            );
        }

        $gian = siswa::find(2) ?? siswa::where('nama', 'like', '%Moh Gian Saputra%')->first();
        if (!$gian) {
            $gian = siswa::create([
                'nama' => 'Moh Gian Saputra',
                'nis' => '202600100',
                'gender' => 'l',
                'aktif' => 1,
                'sekolah_id' => 1,
                'user_id' => 3,
            ]);
        }

        $nisClean = siswa::where('nis', '202600100')->where('id', '!=', $gian->id)->exists()
            ? (string) ($gian->nis ?: '202600199')
            : '202600100';

        $gian->update([
            'nama' => 'Moh Gian Saputra',
            'nis' => $nisClean,
            'tempat_lahir' => 'Palu',
            'tanggal_lahir' => '2017-05-14',
            'gender' => 'l',
            'alamat' => 'Jl. Poros Palu - Kulawi, Tinggede, Kec. Marawola, Kab. Sigi',
            'aktif' => 1,
            'kelas_id' => 6, // SD Kelas 2B
            'tahun_ajaran_id' => $tahunAjaranId,
            'sekolah_id' => 1,
        ]);

        $this->seedNilai($gian->id, $tahunAjaranId);
        $this->seedJadwalKelas($tahunAjaranId);
        $this->seedAbsensiDanJurnal($gian->id);
        $this->seedEvaluasiDanPrestasi($gian->id, $tahunAjaranId);
        $this->seedPembayaran($gian->id);
        $this->seedPengumuman($gian->id);

        // Pastikan nomor WhatsApp Wali Kelas (Ustad Ryu) sesuai untuk demo tombol Kirim Izin (WA)
        $ustadRyu = guru::where('nama', 'like', '%Ustad Ryu%')->first();
        if ($ustadRyu && $ustadRyu->user_id) {
            akun::where('id', $ustadRyu->user_id)->update(['noWa' => '082292094253']);
        }
    }

    private function seedNilai(int $siswaId, int $tahunAjaranId): void
    {
        // Nilai 4 mapel SD Kelas 2B x 4 komponen (Tugas 20%, UH 20%, UTS 30%, UAS 30%) -> Rata-rata 91.2 (Juara 1 dari 5 siswa)
        $nilaiMatrix = [
            48 => [1 => 95, 2 => 92, 3 => 90, 4 => 94], // Tahfidz & Tahsin Al-Qur'an (92.6)
            49 => [1 => 90, 2 => 88, 3 => 86, 4 => 92], // Bahasa Arab (89.0)
            50 => [1 => 94, 2 => 90, 3 => 92, 4 => 95], // PAI & Fiqih (92.9)
            51 => [1 => 92, 2 => 90, 3 => 88, 4 => 92], // Bahasa Indonesia (90.4)
        ];

        foreach ($nilaiMatrix as $mapelId => $komponenScores) {
            foreach ($komponenScores as $jenisPenilaianId => $skor) {
                nilai::updateOrCreate(
                    [
                        'siswa_id' => $siswaId,
                        'mapel_id' => $mapelId,
                        'jenis_penilaian_id' => $jenisPenilaianId,
                        'semester' => 'ganjil',
                        'tahun_ajaran_id' => $tahunAjaranId,
                    ],
                    [
                        'nilai' => $skor,
                        'guru_id' => 1,
                        'terkunci' => 1,
                    ]
                );
            }
        }
    }

    private function seedJadwalKelas(int $tahunAjaranId): void
    {
        // Pastikan jadwal kelas SD Kelas 2B (kelas_id = 9) lengkap Senin s/d Jumat
        $jadwalList = [
            [
                'id' => 33,
                'hari' => 'senin',
                'kelas_id' => 9,
                'mapel_id' => 48, // Tahfidz & Tahsin Al-Qur'an
                'guru_id' => 1, // Ustad Ryu
                'jam_pelajaran_id' => 50, // Jam ke 1 (01:25:00 - 02:00:00)
                'tahun_ajaran_id' => $tahunAjaranId,
            ],
            [
                'id' => 34,
                'hari' => 'selasa',
                'kelas_id' => 9,
                'mapel_id' => 49, // Bahasa Arab
                'guru_id' => 1, // Ustad Ryu
                'jam_pelajaran_id' => 38, // Jam 2 (08:15:00 - 09:00:00)
                'tahun_ajaran_id' => $tahunAjaranId,
            ],
            [
                'id' => 35,
                'hari' => 'rabu',
                'kelas_id' => 9,
                'mapel_id' => 50, // PAI & Fiqih
                'guru_id' => 1, // Ustad Ryu
                'jam_pelajaran_id' => 39, // Jam 3 (09:00:00 - 09:45:00)
                'tahun_ajaran_id' => $tahunAjaranId,
            ],
            [
                'id' => 36,
                'hari' => 'kamis',
                'kelas_id' => 9,
                'mapel_id' => 51, // Bahasa Indonesia
                'guru_id' => 1, // Ustad Ryu
                'jam_pelajaran_id' => 37, // Jam 1 (07:30:00 - 08:15:00)
                'tahun_ajaran_id' => $tahunAjaranId,
            ],
            [
                'id' => 37,
                'hari' => 'jumat',
                'kelas_id' => 9, // SD Kelas 2B
                'mapel_id' => 48, // Tahfidz & Tahsin Al-Qur'an
                'guru_id' => 1, // Ustad Ryu
                'jam_pelajaran_id' => 37, // Jam 1 (07:30:00 - 08:15:00)
                'tahun_ajaran_id' => $tahunAjaranId,
            ],
        ];

        foreach ($jadwalList as $jData) {
            jadwal_pelajaran::updateOrCreate(
                ['id' => $jData['id']],
                $jData
            );
        }
    }

    private function seedAbsensiDanJurnal(int $siswaId): void
    {
        $today = Carbon::today();
        $schoolDays = [];
        $cursor = $today->copy();
        while (count($schoolDays) < 10) {
            if (!$cursor->isWeekend()) {
                $schoolDays[] = $cursor->format('Y-m-d');
            }
            $cursor->subDay();
        }
        $schoolDays = array_reverse($schoolDays); // Oldest -> Today (10 hari aktif, 9 Hadir + 1 Izin = 90%)

        $existingHarian = absensi_siswa::where('siswa_id', $siswaId)
            ->whereNull('jadwal_pelajaran_id')
            ->orderBy('id')
            ->get()
            ->values();

        foreach ($schoolDays as $idx => $tanggal) {
            $isIzin = ($idx === 3);
            $payload = [
                'tanggal' => $tanggal,
                'status' => $isIzin ? 'i' : 'h',
                'keterangan' => $isIzin ? 'Izin acara keluarga (surat orang tua)' : 'Hadir tepat waktu mengikuti apel pagi',
                'siswa_id' => $siswaId,
                'kelas_id' => 6,
                'guru_id' => 1,
                'jadwal_pelajaran_id' => null,
            ];

            if (isset($existingHarian[$idx])) {
                $existingHarian[$idx]->update($payload);
            } else {
                absensi_siswa::updateOrCreate(
                    [
                        'siswa_id' => $siswaId,
                        'tanggal' => $tanggal,
                        'jadwal_pelajaran_id' => null,
                    ],
                    $payload
                );
            }
        }

        // Jurnal mengajar guru & absensi mapel SD Kelas 2B (jadwal 33, 34, 35, 36)
        $jurnalEntries = [
            33 => [
                'date' => $this->latestDateForIsoDay(Carbon::MONDAY),
                'guru_id' => 1,
                'jam_masuk' => '07:32:00',
                'materi' => 'Murojaah Surat An-Naba ayat 1-30 dan perbaikan makhraj huruf halqi',
                'catatan' => 'Ananda Moh Gian Saputra sangat lancar dan tartil saat setoran hafalan.',
                'status_siswa' => 'h',
                'ket_siswa' => 'Setoran hafalan lancar dan tajwid terjaga',
            ],
            34 => [
                'date' => $this->latestDateForIsoDay(Carbon::TUESDAY),
                'guru_id' => 1,
                'jam_masuk' => '08:16:00',
                'materi' => 'Mufradat Perlengkapan Kelas & Hiwar Sederhana (Bab 4)',
                'catatan' => 'Latihan percakapan berpasangan di depan kelas berjalan aktif.',
                'status_siswa' => 'h',
                'ket_siswa' => 'Aktif menjawab latihan hiwar Bahasa Arab',
            ],
            35 => [
                'date' => $this->latestDateForIsoDay(Carbon::WEDNESDAY),
                'guru_id' => 1,
                'jam_masuk' => '09:02:00',
                'materi' => 'Praktik Tata Cara Wudhu dan Bacaan Doa Setelah Wudhu',
                'catatan' => 'Seluruh santri mempraktikkan rukun dan sunnah wudhu dengan tertib.',
                'status_siswa' => 'h',
                'ket_siswa' => 'Tertib mempraktikkan rukun wudhu',
            ],
            36 => [
                'date' => $this->latestDateForIsoDay(Carbon::THURSDAY),
                'guru_id' => 1,
                'jam_masuk' => '07:33:00',
                'materi' => 'Menulis Paragraf Narasi Sederhana & Penggunaan Tanda Baca',
                'catatan' => 'Pembahasan hasil karya tulis pendek bertema adab terhadap orang tua.',
                'status_siswa' => 'h',
                'ket_siswa' => 'Hadir dan menyelesaikan tugas narasi dengan rapi',
            ],
            37 => [
                'date' => $this->latestDateForIsoDay(Carbon::FRIDAY),
                'guru_id' => 1,
                'jam_masuk' => '07:28:00',
                'materi' => 'Muroja\'ah Akbar Juz 30 dan Ujian Kelancaran Sambung Ayat',
                'catatan' => 'Ananda Moh Gian Saputra menunjukkan hafalan mutqin dan tajwid yang sangat baik.',
                'status_siswa' => 'h',
                'ket_siswa' => 'Hadir tepat waktu dan setoran hafalan mutqin',
            ],
        ];

        foreach ($jurnalEntries as $jadwalId => $info) {
            if (!jadwal_pelajaran::where('id', $jadwalId)->exists()) {
                continue;
            }
            absensi_mengajar_guru::updateOrCreate(
                [
                    'jadwal_pelajaran_id' => $jadwalId,
                    'tanggal' => $info['date'],
                ],
                [
                    'guru_id' => $info['guru_id'],
                    'jam_masuk' => $info['jam_masuk'],
                    'status' => 'tepat_waktu',
                    'materi' => $info['materi'],
                    'catatan' => $info['catatan'],
                ]
            );

            absensi_siswa::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'jadwal_pelajaran_id' => $jadwalId,
                    'tanggal' => $info['date'],
                ],
                [
                    'status' => $info['status_siswa'],
                    'keterangan' => $info['ket_siswa'],
                    'kelas_id' => 6,
                    'guru_id' => $info['guru_id'],
                ]
            );
        }
    }

    private function seedEvaluasiDanPrestasi(int $siswaId, int $tahunAjaranId): void
    {
        $kegiatanEvaluasi = [
            [
                'kegiatan' => 'Mabit',
                'predikat' => 'Sangat baik',
                'keterangan' => 'Sangat baik, mengikuti rangkaian Mabit dengan antusias serta disiplin dalam ibadah berjamaah.',
            ],
            [
                'kegiatan' => 'Dzikir Pagi',
                'predikat' => 'Sangat baik',
                'keterangan' => 'Sangat baik, istiqomah membaca dzikir pagi dengan adab yang terjaga.',
            ],
            [
                'kegiatan' => 'Ilqai Kalimat',
                'predikat' => 'Sangat baik',
                'keterangan' => 'Sangat baik, berani dan fasih menyampaikan tausiyah singkat di hadapan teman-teman.',
            ],
            [
                'kegiatan' => 'Puasa Sunnah Kamis',
                'predikat' => 'Baik',
                'keterangan' => 'Baik, rutin berlatih puasa sunnah hari Kamis dan menjaga akhlak selama di sekolah.',
            ],
        ];

        evaluasi_rapor_siswa::updateOrCreate(
            [
                'siswa_id' => $siswaId,
                'tahun_ajaran_id' => $tahunAjaranId,
                'semester' => 1,
            ],
            [
                'catatan_walas' => "Alhamdulillah, ananda Moh Gian Saputra menunjukkan prestasi akademik terbaik di kelas serta konsistensi hafalan Al-Qur'an dan akhlak yang santun. Pertahankan semangat belajar, kerendahan hati, dan kedisiplinan ibadah setiap hari.",
                'evaluasi_kegiatan' => $kegiatanEvaluasi,
                'tanggal_rapor' => '24 Desember 2026',
                'nama_kepsek' => 'Rajihul Haq, S.Sos, M.Pd',
                'nama_walas' => 'Ustad Ryu',
            ]
        );

        $targetPrestasi = [
            [
                'nama_prestasi' => "Juara 1 Musabaqah Hifdzil Qur'an (MHQ) Tingkat Kota",
                'kategori' => 'Lomba',
                'keterangan' => 'Kategori Juz 30 Tingkat Sekolah Dasar',
            ],
            [
                'nama_prestasi' => 'Santri Teladan Disiplin & Ibadah Berjamaah',
                'kategori' => 'Karakter',
                'keterangan' => 'Semester Ganjil Tahun Ajaran 2026/2027',
            ],
        ];

        $existingPrestasi = prestasi_siswa::where('siswa_id', $siswaId)
            ->where('tahun_ajaran_id', $tahunAjaranId)
            ->orderBy('id')
            ->get()
            ->values();

        foreach ($targetPrestasi as $idx => $item) {
            $payload = array_merge($item, [
                'siswa_id' => $siswaId,
                'tahun_ajaran_id' => $tahunAjaranId,
                'semester' => 1,
                'created_by' => 'walas',
            ]);

            if (isset($existingPrestasi[$idx])) {
                $existingPrestasi[$idx]->update($payload);
            } else {
                prestasi_siswa::updateOrCreate(
                    [
                        'siswa_id' => $siswaId,
                        'tahun_ajaran_id' => $tahunAjaranId,
                        'semester' => 1,
                        'nama_prestasi' => $item['nama_prestasi'],
                    ],
                    $payload
                );
            }
        }
    }

    private function seedPembayaran(int $siswaId): void
    {
        $ippBulanan = [
            ['tanggal_awal' => '2026-08-01', 'nominal' => 300000, 'jumlah_dibayar' => 300000, 'status' => 1],
            ['tanggal_awal' => '2026-09-01', 'nominal' => 300000, 'jumlah_dibayar' => 300000, 'status' => 1],
            ['tanggal_awal' => '2026-10-01', 'nominal' => 300000, 'jumlah_dibayar' => 300000, 'status' => 1],
            ['tanggal_awal' => '2026-11-01', 'nominal' => 300000, 'jumlah_dibayar' => 150000, 'status' => 0],
        ];

        foreach ($ippBulanan as $ipp) {
            slip_pembayaran_ipp::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'tanggal_awal' => $ipp['tanggal_awal'],
                ],
                [
                    'nominal' => $ipp['nominal'],
                    'jumlah_dibayar' => $ipp['jumlah_dibayar'],
                    'status' => $ipp['status'],
                ]
            );
        }

        slip_pembayaran_pangkal::updateOrCreate(
            ['siswa_id' => $siswaId],
            [
                'nominal' => 1500000,
                'jumlah_di_bayar' => 1500000,
                'status' => 1,
            ]
        );

        slip_pembayaran_pendidikan::updateOrCreate(
            ['siswa_id' => $siswaId],
            [
                'nominal' => 750000,
                'jumlah_di_bayar' => 750000,
                'status' => 1,
            ]
        );
    }

    private function seedPengumuman(int $siswaId): void
    {
        $items = [
            [
                'judul' => 'Pengumuman Peringkat Final & Pembagian Rapor Semester Ganjil 2026/2027',
                'penulis' => 'Ustad Ryu (Wali Kelas SD Kelas 2B)',
                'tanggal' => Carbon::today()->format('Y-m-d'),
                'target_tipe' => 'kelas',
                'target_role' => 's',
                'kelas_id' => 6,
                'sekolah_id' => 1,
                'siswa_id' => null,
                'isi' => "Assalamu'alaikum warahmatullahi wabarakatuh.\n\nAlhamdulillah seluruh komponen nilai mata pelajaran SD Kelas 2B (Tugas, Ulangan Harian, UTS, dan UAS) telah lengkap 100%. Siswa dan Orang Tua dapat memantau rincian transkrip nilai, peringkat final kelas, serta lembar rapor resmi langsung melalui menu Nilai & Rapor di portal SIAKAD.",
            ],
            [
                'judul' => "Jadwal Muroja'ah & Ujian Tasmi' Juz 30 — SD Islam Terpadu",
                'penulis' => 'Koordinator Tahfidz',
                'tanggal' => Carbon::today()->subDays(2)->format('Y-m-d'),
                'target_tipe' => 'role',
                'target_role' => 's',
                'kelas_id' => null,
                'sekolah_id' => 1,
                'siswa_id' => null,
                'isi' => "Diberitahukan kepada seluruh santri dan wali murid agar mempersiapkan hafalan Juz 30 untuk kegiatan ujian tasmi' akhir semester. Mohon pendampingan muroja'ah rutin di rumah setelah shalat Maghrib.",
            ],
            [
                'judul' => 'Apresiasi Juara Kelas & Penerima Penghargaan Santri Teladan',
                'penulis' => 'Ustad Ryu (Wali Kelas SD Kelas 2B)',
                'tanggal' => Carbon::today()->subDays(4)->format('Y-m-d'),
                'target_tipe' => 'spesifik',
                'target_role' => 's',
                'kelas_id' => 6,
                'sekolah_id' => 1,
                'siswa_id' => $siswaId,
                'isi' => "Selamat kepada ananda Moh Gian Saputra atas pencapaian peringkat terbaik kelas dan kedisiplinan dalam setoran hafalan Al-Qur'an. Terus jaga keikhlasan niat dalam menuntut ilmu.",
            ],
        ];

        foreach ($items as $item) {
            pengumuman::updateOrCreate(
                [
                    'judul' => $item['judul'],
                    'target_tipe' => $item['target_tipe'],
                ],
                $item
            );
        }
    }

    private function latestDateForIsoDay(int $isoDay): string
    {
        $date = Carbon::today();
        while ($date->dayOfWeekIso !== $isoDay) {
            $date->subDay();
        }
        return $date->format('Y-m-d');
    }
}
