<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\guru;
use App\Models\ruang_kelas;
use App\Models\tahun_ajaran;
use App\Models\evaluasi_rapor_tahfidz;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class tahfizController extends Controller
{
    /**
     * Helper guard role
     */
    protected function guardRoles(array $allowedRoles = ['g', 'a'])
    {
        $role = session('role');
        if ($role && !in_array($role, $allowedRoles)) {
            return redirect('/tf/gr/dash')->with('error', 'Akses ditolak.');
        }
        return null;
    }

    # ==================== MENU GURU TAHFIZ ====================
    public function dash_guru()
    {
        return view("modul/tahfiz/guru/dashboard");
    }

    public function absensi()
    {
        return view("modul/tahfiz/guru/absensipengampu");
    }

    public function riwayat_laporan(Request $request)
    {
        // Fallback langsung ke fitur rapor jika diakses melalui rute yang sudah ada
        if ($request->query('view') === 'rapor' || $request->query('tab') === 'rapor') {
            return $this->rapor_guru($request);
        }
        if ($request->query('view') === 'input_nilai' || $request->query('tab') === 'input' || $request->query('tab') === 'nilai') {
            return $this->input_nilai($request);
        }
        if ($request->query('view') === 'detail_rapor' && $request->filled('siswa_id')) {
            return $this->detail_rapor($request, $request->query('siswa_id'));
        }
        if ($request->query('view') === 'cetak_massal') {
            return $this->cetak_rapor_massal($request);
        }

        return view("modul/tahfiz/guru/riwayat");
    }

    public function Halaqah_saya()
    {
        return view("modul/tahfiz/guru/Halaqah_saya");
    }

    public function profil_siswa(Request $request)
    {
        if ($request->query('view') === 'rapor') {
            return $this->rapor_guru($request);
        }
        if ($request->query('view') === 'input_nilai') {
            return $this->input_nilai($request);
        }
        return view("modul/tahfiz/guru/siswa");
    }

    public function laporan()
    {
        return view("modul/tahfiz/guru/inputlaporan");
    }

    public function profil_guru()
    {
        return view("modul/tahfiz/guru/profilg");
    }

    # ==================== SISTEM RAPOR WALAS / PENGAMPU TAHFIDZ ====================

    /**
     * Halaman Rapor Walas & Monitoring Projek Tahfidz (Mirip /sk/rapor-walas)
     */
    public function rapor_guru(Request $request)
    {
        $check = $this->guardRoles(['g', 'a']);
        if ($check) return $check;

        // Tahun Ajaran Aktif
        $tahun_aktif = tahun_ajaran::where('aktif', 1)->first();
        if (!$tahun_aktif) {
            $tahun_aktif = (object)[
                'id' => null,
                'nama' => '2025/2026',
                'semester' => 1
            ];
        }

        // Daftar Semua Kelas / Rombel
        $daftar_semua_kelas = ruang_kelas::orderBy('nama_ruang')->get();

        // Tentukan Kelas yang Sedang Dipilih
        $kelas_id = $request->query('kelas_id');
        if (!$kelas_id && $daftar_semua_kelas->isNotEmpty()) {
            // Cari kelas yang memiliki siswa aktif
            $siswaAda = siswa::whereNotNull('kelas_id')->where('aktif', 1)->first();
            $kelas_id = $siswaAda ? $siswaAda->kelas_id : $daftar_semua_kelas->first()->id;
        }

        // Query Data Santri
        $siswa_query = siswa::with(['kelas', 'sekolah']);
        if ($kelas_id) {
            $siswa_query->where('kelas_id', $kelas_id);
        }
        $siswa = $siswa_query->where('aktif', 1)->orderBy('nama')->get();

        // Jika kelas terpilih belum ada siswa, fallback ke siswa yang ada
        if ($siswa->isEmpty()) {
            $siswa = siswa::with(['kelas', 'sekolah'])->where('aktif', 1)->orderBy('nama')->get();
        }

        // Ambil Data Evaluasi Rapor dari Database
        $evaluasi_list = evaluasi_rapor_tahfidz::whereIn('siswa_id', $siswa->pluck('id'))
            ->where(function($q) use ($tahun_aktif) {
                if ($tahun_aktif->id) {
                    $q->where('tahun_ajaran_id', $tahun_aktif->id);
                }
            })
            ->get()
            ->keyBy('siswa_id');

        // Statistik
        $total_santri = $siswa->count();
        $sudah_lengkap = $evaluasi_list->count();
        $belum_lengkap = max(0, $total_santri - $sudah_lengkap);

        // Template acuan standar
        $default_template = evaluasi_rapor_tahfidz::getDefaultTemplate();

        // Ambil Data Evaluasi Rapor Santri Non-Sistem (Manual / Duplikat)
        $rapor_manual_list = evaluasi_rapor_tahfidz::where('is_manual', true)
            ->where(function($q) use ($kelas_id, $tahun_aktif) {
                if ($kelas_id) {
                    $q->where(function($sq) use ($kelas_id) {
                        $sq->where('kelas_id', $kelas_id)->orWhereNull('kelas_id');
                    });
                }
                if ($tahun_aktif->id) {
                    $q->where(function($sq) use ($tahun_aktif) {
                        $sq->where('tahun_ajaran_id', $tahun_aktif->id)->orWhereNull('tahun_ajaran_id');
                    });
                }
            })
            ->latest()
            ->get();

        // Cetak Massal jika ada param print=massal
        if ($request->query('print') === 'massal') {
            return $this->cetak_rapor_massal($request);
        }

        return view('modul.tahfiz.guru.raporWalas', compact(
            'siswa',
            'daftar_semua_kelas',
            'kelas_id',
            'tahun_aktif',
            'evaluasi_list',
            'rapor_manual_list',
            'total_santri',
            'sudah_lengkap',
            'belum_lengkap',
            'default_template'
        ));
    }

    /**
     * Halaman Detail Kustomisasi & Cetak Rapor Santri (Format Acuan Pengguna)
     */
    public function detail_rapor(Request $request, $siswa_id)
    {
        $check = $this->guardRoles(['g', 'a']);
        if ($check) return $check;

        $tahun_aktif = tahun_ajaran::where('aktif', 1)->first() ?? (object)[
            'id' => null,
            'nama' => '2025/2026',
            'semester' => 1
        ];

        $isManual = false;
        $evaluasi = null;
        $manualId = null;

        if (is_string($siswa_id) && str_starts_with($siswa_id, 'manual-')) {
            $isManual = true;
            $manualId = (int)str_replace('manual-', '', $siswa_id);
            $evaluasi = evaluasi_rapor_tahfidz::findOrFail($manualId);
        } elseif ($request->filled('manual_id')) {
            $isManual = true;
            $manualId = (int)$request->query('manual_id');
            $evaluasi = evaluasi_rapor_tahfidz::findOrFail($manualId);
        }

        if ($isManual && $evaluasi) {
            $siswa = (object)[
                'id' => 'manual-' . $evaluasi->id,
                'nama' => $evaluasi->nama_lengkap ?: 'Santri Non-Sistem',
                'nis' => '-',
                'gender' => 'l',
                'tanggal_lahir' => null,
                'kelas_id' => $evaluasi->kelas_id,
                'kelas' => (object)[
                    'id' => $evaluasi->kelas_id,
                    'nama_ruang' => $evaluasi->kelas_label ?: 'VI (ENAM)',
                ],
                'sekolah' => null,
                'is_manual' => true,
            ];

            $template = evaluasi_rapor_tahfidz::getDefaultTemplate($siswa);
            $riwayatHafalan = collect();
            $semuaSiswaKelas = siswa::where('aktif', 1)->orderBy('nama')->take(10)->get();
        } else {
            $siswa = siswa::with(['kelas', 'sekolah', 'tahunAjaran'])->findOrFail($siswa_id);

            // Cari evaluasi tersimpan di DB
            $evaluasi = evaluasi_rapor_tahfidz::where('siswa_id', $siswa->id)
                ->where('semester', $tahun_aktif->semester ?? 1)
                ->latest()
                ->first();

            // Template Default
            $template = evaluasi_rapor_tahfidz::getDefaultTemplate($siswa);

            // Ambil histori setoran/hafalan jika tabel halaqah/laporan_tahfiz tersedia
            $riwayatHafalan = collect();
            if (Schema::hasTable('laporan_tahfiz')) {
                $riwayatHafalan = DB::table('laporan_tahfiz')
                    ->where('siswa_id', $siswa->id)
                    ->orderByDesc('tanggal')
                    ->take(5)
                    ->get();
            }

            // Daftar santri sekelas untuk navigasi cepat antar siswa
            $semuaSiswaKelas = siswa::where('kelas_id', $siswa->kelas_id)
                ->where('aktif', 1)
                ->orderBy('nama')
                ->get();
            if ($semuaSiswaKelas->isEmpty()) {
                $semuaSiswaKelas = siswa::where('aktif', 1)->orderBy('nama')->get();
            }
        }

        $eval = $evaluasi;
        return view('modul.tahfiz.guru.detailRaporWalas', compact(
            'siswa',
            'tahun_aktif',
            'evaluasi',
            'eval',
            'template',
            'riwayatHafalan',
            'semuaSiswaKelas'
        ));
    }
    public function detail_rapor_testing()
    {

        return view('modul.tahfiz.guru.raporSementara');
    }

    /**
     * Cetak Seluruh Rapor Kelas Sekaligus (Massal)
     */
    public function cetak_rapor_massal(Request $request)
    {
        $check = $this->guardRoles(['g', 'a']);
        if ($check) return $check;

        $kelas_id = $request->query('kelas_id');
        $single_siswa_id = $request->query('siswa_id');

        $tahun_aktif = tahun_ajaran::where('aktif', 1)->first() ?? (object)[
            'id' => null,
            'nama' => '2025/2026',
            'semester' => 1
        ];

        // Jika mencetak lembar satu santri saja (baik reguler maupun santri manual non-sistem)
        if ($single_siswa_id) {
            $daftar_siswa = collect();
            $evaluasi_map = collect();

            if (str_starts_with((string)$single_siswa_id, 'manual-')) {
                $manualId = (int)str_replace('manual-', '', $single_siswa_id);
                $m = evaluasi_rapor_tahfidz::find($manualId);
                if ($m) {
                    $vSiswa = (object)[
                        'id' => 'manual-' . $m->id,
                        'manual_id' => $m->id,
                        'nama' => $m->nama_lengkap ?: 'Santri Non-Sistem',
                        'nis' => '-',
                        'gender' => 'l',
                        'tanggal_lahir' => null,
                        'kelas_id' => $m->kelas_id,
                        'kelas' => (object)[
                            'id' => $m->kelas_id,
                            'nama_ruang' => $m->kelas_label ?: 'VI (ENAM)',
                        ],
                        'sekolah' => null,
                        'is_manual' => true,
                    ];
                    $daftar_siswa->push($vSiswa);
                    $evaluasi_map->put($vSiswa->id, $m);
                    if (!$kelas_id) $kelas_id = $m->kelas_id;
                }
            } else {
                $s = siswa::with(['kelas', 'sekolah'])->find($single_siswa_id);
                if ($s) {
                    $daftar_siswa->push($s);
                    $eval = evaluasi_rapor_tahfidz::where('siswa_id', $s->id)->first();
                    if ($eval) {
                        $evaluasi_map->put($s->id, $eval);
                    }
                    if (!$kelas_id) $kelas_id = $s->kelas_id;
                }
            }

            $kelasInfo = ruang_kelas::find($kelas_id);

            return view('modul.tahfiz.guru.cetakRaporMassal', compact(
                'daftar_siswa',
                'evaluasi_map',
                'tahun_aktif',
                'kelasInfo',
                'single_siswa_id'
            ));
        }

        $siswa_query = siswa::with(['kelas', 'sekolah']);
        if ($kelas_id) {
            $siswa_query->where('kelas_id', $kelas_id);
        }
        $daftar_siswa = $siswa_query->where('aktif', 1)->orderBy('nama')->get();

        if ($daftar_siswa->isEmpty()) {
            $daftar_siswa = siswa::with(['kelas', 'sekolah'])->where('aktif', 1)->orderBy('nama')->take(20)->get();
        }

        // Ambil evaluasi untuk semua siswa terdaftar
        $evaluasi_map = evaluasi_rapor_tahfidz::whereIn('siswa_id', $daftar_siswa->pluck('id'))
            ->get()
            ->keyBy('siswa_id');

        // Sertakan santri manual / duplikat non-sistem
        $manuals = evaluasi_rapor_tahfidz::where('is_manual', true)
            ->where(function($q) use ($kelas_id, $tahun_aktif) {
                if ($kelas_id) {
                    $q->where(function($sq) use ($kelas_id) {
                        $sq->where('kelas_id', $kelas_id)->orWhereNull('kelas_id');
                    });
                }
            })
            ->get();

        foreach ($manuals as $m) {
            $vSiswa = (object)[
                'id' => 'manual-' . $m->id,
                'manual_id' => $m->id,
                'nama' => $m->nama_lengkap ?: 'Santri Non-Sistem',
                'nis' => '-',
                'gender' => 'l',
                'tanggal_lahir' => null,
                'kelas_id' => $m->kelas_id,
                'kelas' => (object)[
                    'id' => $m->kelas_id,
                    'nama_ruang' => $m->kelas_label ?: 'VI (ENAM)',
                ],
                'sekolah' => null,
                'is_manual' => true,
            ];
            $daftar_siswa->push($vSiswa);
            $evaluasi_map->put($vSiswa->id, $m);
        }

        $kelasInfo = ruang_kelas::find($kelas_id);

        return view('modul.tahfiz.guru.cetakRaporMassal', compact(
            'daftar_siswa',
            'evaluasi_map',
            'tahun_aktif',
            'kelasInfo',
            'single_siswa_id'
        ));
    }

    /**
     * Simpan Evaluasi Rapor Santri ke Database
     */
    public function simpan_evaluasi_rapor(Request $request)
    {
        // 0. Aksi Update Cepat Identitas Santri (Nama, Kelas, Umur, Ortu)
        if ($request->input('action') === 'update_bio') {
            $siswa_id_input = (string)$request->input('siswa_id');
            $isManual = $request->boolean('is_manual') 
                || str_starts_with($siswa_id_input, 'manual-') 
                || $request->filled('manual_id');

            if ($isManual) {
                $manualId = $request->input('manual_id');
                if (!$manualId && str_starts_with($siswa_id_input, 'manual-')) {
                    $manualId = (int)str_replace('manual-', '', $siswa_id_input);
                }
                $eval = evaluasi_rapor_tahfidz::find($manualId);
                if (!$eval) {
                    return response()->json(['success' => false, 'message' => 'Data santri manual tidak ditemukan.'], 404);
                }
            } else {
                $siswaModel = siswa::find($siswa_id_input);
                if (!$siswaModel) {
                    return response()->json(['success' => false, 'message' => 'Santri tidak ditemukan.'], 404);
                }
                $tahun_aktif = tahun_ajaran::where('aktif', 1)->first();
                $eval = evaluasi_rapor_tahfidz::firstOrNew(['siswa_id' => $siswaModel->id]);
                if (!$eval->exists) {
                    $defaultTpl = evaluasi_rapor_tahfidz::getDefaultTemplate($siswaModel);
                    $eval->fill($defaultTpl);
                    $eval->siswa_id = $siswaModel->id;
                    $eval->kelas_id = $siswaModel->kelas_id;
                    $eval->guru_id = session('id');
                    $eval->tahun_ajaran_id = $tahun_aktif ? $tahun_aktif->id : null;
                    $eval->semester = $tahun_aktif->semester ?? 1;
                    $eval->is_manual = false;
                }
            }

            if ($request->filled('nama_lengkap')) $eval->nama_lengkap = $request->input('nama_lengkap');
            if ($request->filled('kelas_label')) $eval->kelas_label = $request->input('kelas_label');
            if ($request->filled('umur')) $eval->umur = $request->input('umur');
            if ($request->filled('orang_tua')) $eval->orang_tua = $request->input('orang_tua');
            $eval->save();

            return response()->json([
                'success' => true,
                'message' => 'Identitas santri berhasil diperbarui!',
                'data' => [
                    'siswa_id' => $siswa_id_input,
                    'nama_lengkap' => $eval->nama_lengkap,
                    'kelas_label' => $eval->kelas_label,
                    'umur' => $eval->umur,
                    'orang_tua' => $eval->orang_tua,
                ]
            ]);
        }

        // 1. Aksi Hapus Duplikat Santri Non-Sistem
        if ($request->input('action') === 'delete_manual' || $request->input('action') === 'hapus_manual') {
            $manualId = $request->input('manual_id');
            $eval = evaluasi_rapor_tahfidz::where('id', $manualId)->where('is_manual', true)->first();
            if ($eval) {
                $eval->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Rapor duplikat santri manual berhasil dihapus!'
                ]);
            }
            return response()->json(['success' => false, 'message' => 'Data rapor duplikat tidak ditemukan.'], 404);
        }

        // 2. Aksi Duplikat Rapor untuk Siswa Non-Sistem (Belum Terdaftar)
        if ($request->input('action') === 'duplicate' || $request->boolean('is_duplikat')) {
            $request->validate([
                'nama_lengkap' => 'required',
            ]);

            $sourceEvaluasiId = $request->input('source_evaluasi_id');
            $sourceSiswaId = $request->input('source_siswa_id');

            $source = null;
            if ($sourceEvaluasiId) {
                $source = evaluasi_rapor_tahfidz::find($sourceEvaluasiId);
            } elseif ($sourceSiswaId) {
                $source = evaluasi_rapor_tahfidz::where('siswa_id', $sourceSiswaId)->latest()->first();
            }

            $defaultTpl = evaluasi_rapor_tahfidz::getDefaultTemplate();
            $tahun_aktif = tahun_ajaran::where('aktif', 1)->first();
            $tahun_ajaran_id = $tahun_aktif ? $tahun_aktif->id : null;
            $semester = $tahun_aktif->semester ?? 1;

            $kelasId = $request->input('kelas_id') ?: ($source ? $source->kelas_id : null);
            if (!$kelasId && $sourceSiswaId) {
                $sModel = siswa::find($sourceSiswaId);
                if ($sModel) $kelasId = $sModel->kelas_id;
            }

            $copyNilai = $request->has('copy_nilai') ? $request->boolean('copy_nilai') : true;
            $copyCapaian = $request->has('copy_capaian') ? $request->boolean('copy_capaian') : true;
            $copyCatatan = $request->has('copy_catatan') ? $request->boolean('copy_catatan') : true;
            $copyTtd = $request->has('copy_ttd') ? $request->boolean('copy_ttd') : true;

            $newEval = new evaluasi_rapor_tahfidz();
            $newEval->is_manual = true;
            $newEval->siswa_id = null;
            $newEval->kelas_id = $kelasId;
            $newEval->guru_id = session('id');
            $newEval->tahun_ajaran_id = $tahun_ajaran_id;
            $newEval->semester = $semester;

            // Form data pokok yang disesuaikan untuk siswa non-sistem
            $newEval->nama_lengkap = $request->input('nama_lengkap');
            $newEval->kelas_label = $request->input('kelas_label', $source ? $source->kelas_label : 'VI (ENAM)');
            $newEval->umur = $request->input('umur', $source ? $source->umur : '12 TAHUN');
            $newEval->orang_tua = $request->input('orang_tua', $source ? $source->orang_tua : 'Bpk. ZULFIKAR ABDUN & Ibu NAZMA SYAWIE');

            // Kenaikan Juz
            $newEval->kenaikan_juz_tanggal = $source ? $source->kenaikan_juz_tanggal : $defaultTpl['kenaikan_juz_tanggal'];
            $newEval->kenaikan_juz_nomor = $source ? $source->kenaikan_juz_nomor : $defaultTpl['kenaikan_juz_nomor'];
            $newEval->kenaikan_juz_predikat = $source ? $source->kenaikan_juz_predikat : $defaultTpl['kenaikan_juz_predikat'];

            // Header 4 Bulan
            $newEval->bulan_1_label = $request->input('bulan_1_label', $source ? $source->bulan_1_label : 'AGUSTUS');
            $newEval->bulan_2_label = $request->input('bulan_2_label', $source ? $source->bulan_2_label : 'SEPTEMBER');
            $newEval->bulan_3_label = $request->input('bulan_3_label', $source ? $source->bulan_3_label : 'OKTOBER');
            $newEval->bulan_4_label = $request->input('bulan_4_label', $source ? $source->bulan_4_label : 'NOVEMBER');

            // Nilai 4 Bulan
            if ($copyNilai && $source) {
                $newEval->nilai_bulan_1 = $source->nilai_bulan_1;
                $newEval->nilai_bulan_2 = $source->nilai_bulan_2;
                $newEval->nilai_bulan_3 = $source->nilai_bulan_3;
                $newEval->nilai_bulan_4 = $source->nilai_bulan_4;
                $newEval->ujian_jumlah = $source->ujian_jumlah;
                $newEval->ujian_rata_rata = $source->ujian_rata_rata;
                $newEval->ujian_predikat = $source->ujian_predikat;
                $newEval->ujian_terbuka_tanggal = $source->ujian_terbuka_tanggal;
                $newEval->ujian_terbuka_jumlah_juz = $source->ujian_terbuka_jumlah_juz;
                $newEval->ujian_terbuka_predikat = $source->ujian_terbuka_predikat;
            } else {
                $nb1 = $request->filled('nilai_bulan_1') ? (float)$request->input('nilai_bulan_1') : null;
                $nb2 = $request->filled('nilai_bulan_2') ? (float)$request->input('nilai_bulan_2') : null;
                $nb3 = $request->filled('nilai_bulan_3') ? (float)$request->input('nilai_bulan_3') : null;
                $nb4 = $request->filled('nilai_bulan_4') ? (float)$request->input('nilai_bulan_4') : null;
                $newEval->nilai_bulan_1 = $nb1;
                $newEval->nilai_bulan_2 = $nb2;
                $newEval->nilai_bulan_3 = $nb3;
                $newEval->nilai_bulan_4 = $nb4;
                $hasSc = ($nb1 !== null || $nb2 !== null || $nb3 !== null || $nb4 !== null);
                $newEval->ujian_jumlah = $hasSc ? (($nb1 ?? 0) + ($nb2 ?? 0) + ($nb3 ?? 0) + ($nb4 ?? 0)) : null;
                $newEval->ujian_rata_rata = $hasSc ? round($newEval->ujian_jumlah / 4, 1) : null;
                $newEval->ujian_predikat = $newEval->ujian_rata_rata !== null ? evaluasi_rapor_tahfidz::calculatePredikat($newEval->ujian_rata_rata) : '-';
            }

            // Capaian Hafalan
            if ($copyCapaian && $source) {
                $newEval->target_semester = $source->target_semester;
                $newEval->tercapai_semester = $source->tercapai_semester;
                $newEval->target_total = $source->target_total;
                $newEval->tercapai_total = $source->tercapai_total;
                $newEval->tercapai_target_semester = $source->tercapai_target_semester;
                $newEval->tercapai_target_kelas = $source->tercapai_target_kelas;
            } else {
                $newEval->target_semester = '1 Juz';
                $newEval->tercapai_semester = '<1 Juz  (19 Halaman)  (Az-Zukhruf 32 – Az-Zumar 22)';
                $newEval->target_total = '9 Juz';
                $newEval->tercapai_total = '6,5 Juz  (An-nas – Az-Zumar 22)';
                $newEval->tercapai_target_semester = true;
                $newEval->tercapai_target_kelas = true;
            }

            // Catatan
            if ($copyCatatan && $source) {
                $newEval->catatan_bacaan = $source->catatan_bacaan;
                $newEval->catatan_hafalan = $source->catatan_hafalan;
                $newEval->catatan_akhlak = $source->catatan_akhlak;
            } else {
                $newEval->catatan_bacaan = $defaultTpl['catatan_bacaan'];
                $newEval->catatan_hafalan = $defaultTpl['catatan_hafalan'];
                $newEval->catatan_akhlak = $defaultTpl['catatan_akhlak'];
            }

            // Tanda tangan
            $newEval->nama_sekolah = 'SEKOLAH DASAR AL-QUR’AN IMAM SYAFI’I TINGGEDE';
            $newEval->tempat_rapor = $source ? $source->tempat_rapor : 'Sigi';
            $newEval->tanggal_rapor = $source ? $source->tanggal_rapor : '19 Desember 2026';
            $newEval->nama_pengampu = $source ? $source->nama_pengampu : 'NURUL ZHAFIRAH PUTRI';
            $newEval->role_pengampu_label = $source ? $source->role_pengampu_label : 'Pengampu Halaqah & Wali Kelas 5A';
            $newEval->nama_walas = $source ? $source->nama_walas : 'NURUL ZHAFIRAH PUTRI';
            $newEval->role_walas_label = $request->input('role_walas_label', $source ? ($source->role_walas_label ?? 'Wali Kelas') : 'Wali Kelas');
            $newEval->nama_kepsek = $source ? $source->nama_kepsek : 'NABILAH TUL ISLAMIYAH S.Pd.,S.Q';
            $newEval->role_kepsek_label = $request->input('role_kepsek_label', $source ? ($source->role_kepsek_label ?? 'Kepala Sekolah SDQU Imam Syafi’i') : 'Kepala Sekolah SDQU Imam Syafi’i');
            if ($copyTtd && $source) {
                $newEval->ttd_pengampu = $source->ttd_pengampu;
                $newEval->ttd_walas = $source->ttd_walas;
                $newEval->ttd_kepsek = $source->ttd_kepsek;
            }

            $newEval->save();

            $redirectUrl = url('/tf/gr/detail-rapor/manual-' . $newEval->id);
            $printUrl = url('/tf/gr/cetak-rapor-massal?siswa_id=manual-' . $newEval->id);

            return response()->json([
                'success' => true,
                'message' => 'Rapor berhasil diduplikat untuk santri baru: ' . $newEval->nama_lengkap,
                'manual_id' => $newEval->id,
                'siswa_id' => 'manual-' . $newEval->id,
                'nama_lengkap' => $newEval->nama_lengkap,
                'kelas_label' => $newEval->kelas_label,
                'umur' => $newEval->umur,
                'orang_tua' => $newEval->orang_tua,
                'redirect_url' => $redirectUrl,
                'print_url' => $printUrl
            ]);
        }

        // 3. Simpan Evaluasi / Update Rapor (Baik Siswa Terdaftar maupun Siswa Manual)
        $siswa_id_input = (string)$request->input('siswa_id');
        $isManual = $request->boolean('is_manual') 
            || str_starts_with($siswa_id_input, 'manual-') 
            || $request->filled('manual_id');

        $manualId = null;
        if ($isManual) {
            $manualId = $request->input('manual_id');
            if (!$manualId && str_starts_with($siswa_id_input, 'manual-')) {
                $manualId = (int)str_replace('manual-', '', $siswa_id_input);
            }
        } else {
            $request->validate([
                'siswa_id' => 'required'
            ]);
        }

        $siswaModel = !$isManual ? siswa::with('kelas')->find($siswa_id_input) : null;
        $tahun_aktif = tahun_ajaran::where('aktif', 1)->first();
        $tahun_ajaran_id = $tahun_aktif ? $tahun_aktif->id : $request->input('tahun_ajaran_id');
        $semester = $request->input('semester', $tahun_aktif->semester ?? 1);

        // Label 4 Bulan Bagian B (Bisa diedit teksnya)
        $b1Label = $request->input('bulan_1_label', 'AGUSTUS');
        $b2Label = $request->input('bulan_2_label', 'SEPTEMBER');
        $b3Label = $request->input('bulan_3_label', 'OKTOBER');
        $b4Label = $request->input('bulan_4_label', 'NOVEMBER');

        // Nilai 4 Bulan Bagian B (Ujian Tasmi')
        $nb1 = $request->filled('nilai_bulan_1') ? (float)$request->input('nilai_bulan_1') : ($request->filled('ujian_1') ? (float)$request->input('ujian_1') : null);
        $nb2 = $request->filled('nilai_bulan_2') ? (float)$request->input('nilai_bulan_2') : ($request->filled('ujian_2') ? (float)$request->input('ujian_2') : null);
        $nb3 = $request->filled('nilai_bulan_3') ? (float)$request->input('nilai_bulan_3') : ($request->filled('ujian_akhir') ? (float)$request->input('ujian_akhir') : null);
        $nb4 = $request->filled('nilai_bulan_4') ? (float)$request->input('nilai_bulan_4') : null;

        $hasScores = ($nb1 !== null || $nb2 !== null || $nb3 !== null || $nb4 !== null);
        $totalAkhir = $request->filled('ujian_jumlah') 
            ? (float)$request->input('ujian_jumlah') 
            : (($nb1 ?? 0) + ($nb2 ?? 0) + ($nb3 ?? 0) + ($nb4 ?? 0));
        $rataRata = $request->filled('ujian_rata_rata') 
            ? (float)$request->input('ujian_rata_rata') 
            : ($hasScores ? round($totalAkhir / 4, 1) : null);
        $predikatUjian = $request->input('ujian_predikat') ?: ($rataRata !== null ? evaluasi_rapor_tahfidz::calculatePredikat($rataRata) : '-');

        // Data Siswa Manual (Bisa diisi / diedit bebas)
        $namaLengkap = $request->input('nama_lengkap', $siswaModel ? $siswaModel->nama : 'MOH. IBNU MUNDZIR');
        $kelasLabel = $request->input('kelas_label', 'VI (ENAM)');
        $umur = $request->input('umur', '12 TAHUN');
        $orangTua = $request->input('orang_tua', 'Bpk. ZULFIKAR ABDUN & Ibu NAZMA SYAWIE');

        $data = [
            'guru_id' => session('id'),
            'nama_lengkap' => $namaLengkap,
            'kelas_label' => $kelasLabel,
            'umur' => $umur,
            'orang_tua' => $orangTua,

            // A. Ujian Kenaikan Juz
            'kenaikan_juz_tanggal' => $request->input('kenaikan_juz_tanggal', 'Rabu, 08 Oktober 2025'),
            'kenaikan_juz_nomor' => $request->input('kenaikan_juz_nomor', '25'),
            'kenaikan_juz_predikat' => $request->input('kenaikan_juz_predikat', 'Jayyid/C'),

            // B. Ujian Tasmi’ (4 Bulan & Nilai Akhir)
            'bulan_1_label' => $b1Label,
            'bulan_2_label' => $b2Label,
            'bulan_3_label' => $b3Label,
            'bulan_4_label' => $b4Label,
            'nilai_bulan_1' => $nb1,
            'nilai_bulan_2' => $nb2,
            'nilai_bulan_3' => $nb3,
            'nilai_bulan_4' => $nb4,
            'ujian_1' => $nb1,
            'ujian_2' => $nb2,
            'ujian_akhir' => $nb3,
            'ujian_jumlah' => $totalAkhir,
            'ujian_rata_rata' => $rataRata,
            'ujian_predikat' => $predikatUjian,

            // C. Ujian Tahfiz Terbuka
            'ujian_terbuka_tanggal' => $request->input('ujian_terbuka_tanggal', $request->input('tasmi_tanggal', '-')),
            'ujian_terbuka_jumlah_juz' => $request->input('ujian_terbuka_jumlah_juz', $request->input('tasmi_jumlah_juz', '-')),
            'ujian_terbuka_predikat' => $request->input('ujian_terbuka_predikat', $request->input('tasmi_predikat', '-')),
            'tasmi_tanggal' => $request->input('ujian_terbuka_tanggal', $request->input('tasmi_tanggal', '-')),
            'tasmi_jumlah_juz' => $request->input('ujian_terbuka_jumlah_juz', $request->input('tasmi_jumlah_juz', '-')),
            'tasmi_predikat' => $request->input('ujian_terbuka_predikat', $request->input('tasmi_predikat', '-')),

            // D. Pencapaian Tahfizh
            'target_semester' => $request->input('target_semester', '1 Juz'),
            'tercapai_semester' => $request->input('tercapai_semester', '<1 Juz  (19 Halaman)  (Az-Zukhruf 32 – Az-Zumar 22)'),
            'target_total' => $request->input('target_total', '9 Juz'),
            'tercapai_total' => $request->input('tercapai_total', '6,5 Juz  (An-nas – Az-Zumar 22)'),
            'tercapai_target_semester' => $request->input('tercapai_target_semester') === '1' || $request->input('tercapai_target_semester') === true || $request->input('tercapai_target_semester') === 'iya',
            'tercapai_target_kelas' => $request->input('tercapai_target_kelas') === '1' || $request->input('tercapai_target_kelas') === true || $request->input('tercapai_target_kelas') === 'iya',

            // Catatan Pengampu
            'catatan_bacaan' => $request->input('catatan_bacaan'),
            'catatan_hafalan' => $request->input('catatan_hafalan'),
            'catatan_akhlak' => $request->input('catatan_akhlak'),

            // Pengesahan & Tanda Tangan (3 TTD: Pengampu, Wali Kelas, Kepala Sekolah)
            'tempat_rapor' => $request->input('tempat_rapor', 'Sigi'),
            'tanggal_rapor' => $request->input('tanggal_rapor', '19 Desember 2026'),
            'nama_pengampu' => $request->input('nama_pengampu', 'NURUL ZHAFIRAH PUTRI'),
            'ttd_pengampu' => $request->input('ttd_pengampu'),
            'nama_walas' => $request->input('nama_walas', 'NURUL ZHAFIRAH PUTRI'),
            'role_pengampu_label' => $request->input('role_pengampu_label', 'Pengampu Halaqah & Wali Kelas 5A'),
            'role_walas_label' => $request->input('role_walas_label', 'Wali Kelas'),
            'nama_kepsek' => $request->input('nama_kepsek', 'NABILAH TUL ISLAMIYAH S.Pd.,S.Q'),
            'role_kepsek_label' => $request->input('role_kepsek_label', 'Kepala Sekolah SDQU Imam Syafi’i'),
            'ttd_walas' => $request->input('ttd_walas'),
            'ttd_kepsek' => $request->input('ttd_kepsek'),
        ];

        if ($isManual) {
            $data['is_manual'] = true;
            $data['siswa_id'] = null;
            if ($request->filled('kelas_id')) {
                $data['kelas_id'] = $request->input('kelas_id');
            }
            if ($manualId) {
                $evaluasi = evaluasi_rapor_tahfidz::find($manualId);
                if ($evaluasi) {
                    $evaluasi->update($data);
                } else {
                    $evaluasi = evaluasi_rapor_tahfidz::create($data);
                }
            } else {
                $evaluasi = evaluasi_rapor_tahfidz::create($data);
            }
        } else {
            $siswa_id = (int)$siswa_id_input;
            $data['is_manual'] = false;
            $data['siswa_id'] = $siswa_id;
            $evaluasi = evaluasi_rapor_tahfidz::updateOrCreate(
                [
                    'siswa_id' => $siswa_id,
                    'semester' => $semester,
                    'tahun_ajaran_id' => $tahun_ajaran_id
                ],
                $data
            );
        }

        // Fitur: Terapkan Format Ini ke Semua Siswa Lainnya di Rombel
        $terapkanKeSemua = $request->boolean('terapkan_ke_semua') || $request->input('apply_to_all') == '1';
        $affectedCount = 1;
        if ($terapkanKeSemua && $siswaModel && $siswaModel->kelas_id) {
            $temanSekelas = siswa::where('kelas_id', $siswaModel->kelas_id)
                ->where('id', '!=', $siswa_id)
                ->get();

            $sharedFormat = [
                'guru_id' => session('id'),
                'bulan_1_label' => $b1Label,
                'bulan_2_label' => $b2Label,
                'bulan_3_label' => $b3Label,
                'bulan_4_label' => $b4Label,
                'target_semester' => $data['target_semester'],
                'target_total' => $data['target_total'],
                'tempat_rapor' => $data['tempat_rapor'],
                'tanggal_rapor' => $data['tanggal_rapor'],
                'nama_pengampu' => $data['nama_pengampu'],
                'role_pengampu_label' => $data['role_pengampu_label'],
                'nama_walas' => $data['nama_walas'],
                'role_walas_label' => $data['role_walas_label'],
                'nama_kepsek' => $data['nama_kepsek'],
                'role_kepsek_label' => $data['role_kepsek_label'],
                'catatan_bacaan' => $data['catatan_bacaan'],
                'catatan_hafalan' => $data['catatan_hafalan'],
                'catatan_akhlak' => $data['catatan_akhlak'],
            ];

            foreach ($temanSekelas as $teman) {
                evaluasi_rapor_tahfidz::updateOrCreate(
                    [
                        'siswa_id' => $teman->id,
                        'semester' => $semester,
                        'tahun_ajaran_id' => $tahun_ajaran_id
                    ],
                    $sharedFormat
                );
            }
            $affectedCount += $temanSekelas->count();
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $terapkanKeSemua 
                    ? "Rapor santri berhasil disimpan dan format diterapkan ke {$affectedCount} santri sekelas!"
                    : 'Rapor Tahfidz santri berhasil disimpan ke database!',
                'data' => $evaluasi,
                'applied_to_all' => $terapkanKeSemua
            ]);
        }

        return redirect()->back()->with('success', 'Rapor Tahfidz santri berhasil disimpan ke database!');
    }

    /**
     * Halaman Input Nilai Projek & Rapor Santri per Kelas (Spreadsheet / Grid View)
     */
    public function input_nilai(Request $request)
    {
        $check = $this->guardRoles(['g', 'a']);
        if ($check) return $check;

        $tahun_aktif = tahun_ajaran::where('aktif', 1)->first() ?? (object)[
            'id' => null,
            'nama' => '2025/2026',
            'semester' => 1
        ];

        $daftar_semua_kelas = ruang_kelas::orderBy('nama_ruang')->get();

        $kelas_id = $request->query('kelas_id');
        if (!$kelas_id && $daftar_semua_kelas->isNotEmpty()) {
            $siswaAda = siswa::whereNotNull('kelas_id')->where('aktif', 1)->first();
            $kelas_id = $siswaAda ? $siswaAda->kelas_id : $daftar_semua_kelas->first()->id;
        }

        $siswa_query = siswa::with(['kelas', 'sekolah']);
        if ($kelas_id) {
            $siswa_query->where('kelas_id', $kelas_id);
        }
        $siswa = $siswa_query->where('aktif', 1)->orderBy('nama')->get();

        if ($siswa->isEmpty()) {
            $siswa = siswa::with(['kelas', 'sekolah'])->where('aktif', 1)->orderBy('nama')->get();
        }

        // Ambil evaluasi tersimpan di DB
        $evaluasi_list = evaluasi_rapor_tahfidz::whereIn('siswa_id', $siswa->pluck('id'))
            ->where('semester', $tahun_aktif->semester ?? 1)
            ->get()
            ->keyBy('siswa_id');

        // Sertakan santri manual / duplikat non-sistem
        $manuals = evaluasi_rapor_tahfidz::where('is_manual', true)
            ->where(function($q) use ($kelas_id, $tahun_aktif) {
                if ($kelas_id) {
                    $q->where('kelas_id', $kelas_id)->orWhereNull('kelas_id');
                }
            })
            ->get();
        foreach ($manuals as $m) {
            $vSiswa = (object)[
                'id' => 'manual-' . $m->id,
                'nama' => $m->nama_lengkap ?: 'Santri Non-Sistem',
                'nis' => '-',
                'gender' => 'l',
                'tanggal_lahir' => null,
                'kelas_id' => $m->kelas_id,
                'kelas' => (object)[
                    'id' => $m->kelas_id,
                    'nama_ruang' => $m->kelas_label ?: 'VI (ENAM)',
                ],
                'sekolah' => null,
                'is_manual' => true,
            ];
            $siswa->push($vSiswa);
            $evaluasi_list->put($vSiswa->id, $m);
        }

        // Template default
        $default_template = evaluasi_rapor_tahfidz::getDefaultTemplate();

        // Cari jika salah satu santri di kelas sudah memiliki judul/deskripsi khusus
        $firstSaved = $evaluasi_list->first();
        if ($firstSaved) {
            $projek_info = [
                'tema_projek' => $firstSaved->tema_projek ?: ($default_template['tema_projek'] ?? 'Kearifan Lokal'),
                'judul_projek' => $firstSaved->judul_projek ?: ($default_template['judul_projek'] ?? "Al-Qur'an di Hatiku"),
                'deskripsi_projek' => $firstSaved->deskripsi_projek ?: ($default_template['deskripsi_projek'] ?? "Projek Penguatan Karakter & Tahfizh Al-Qur'an"),
                'sub_judul_kegiatan' => $firstSaved->sub_judul_kegiatan ?: ($default_template['sub_judul_kegiatan'] ?? "Membaca dan Menghafal Al-Qur'an Sesuai Kaidah Tajwid"),
            ];
        } else {
            $projek_info = [
                'tema_projek' => $default_template['tema_projek'] ?? 'Kearifan Lokal',
                'judul_projek' => $default_template['judul_projek'] ?? "Al-Qur'an di Hatiku",
                'deskripsi_projek' => $default_template['deskripsi_projek'] ?? "Projek Penguatan Karakter & Tahfizh Al-Qur'an",
                'sub_judul_kegiatan' => $default_template['sub_judul_kegiatan'] ?? "Membaca dan Menghafal Al-Qur'an Sesuai Kaidah Tajwid",
            ];
        }

        $currentKelas = $daftar_semua_kelas->firstWhere('id', $kelas_id);

        return view('modul.tahfiz.guru.inputNilaiRapor', compact(
            'daftar_semua_kelas',
            'kelas_id',
            'currentKelas',
            'siswa',
            'tahun_aktif',
            'evaluasi_list',
            'default_template',
            'projek_info'
        ));
    }

    /**
     * Simpan Massal Seluruh Nilai Siswa dalam Rombel
     */
    public function simpan_massal_nilai(Request $request)
    {
        $check = $this->guardRoles(['g', 'a']);
        if ($check) return $check;

        $tahun_aktif = tahun_ajaran::where('aktif', 1)->first();
        $tahun_ajaran_id = $tahun_aktif ? $tahun_aktif->id : null;
        $semester = $tahun_aktif->semester ?? 1;

        $b1Label = $request->input('bulan_1_label', 'AGUSTUS');
        $b2Label = $request->input('bulan_2_label', 'SEPTEMBER');
        $b3Label = $request->input('bulan_3_label', 'OKTOBER');
        $b4Label = $request->input('bulan_4_label', 'NOVEMBER');

        $target_semester = $request->input('target_semester', '1 Juz');
        $target_total = $request->input('target_total', '9 Juz');
        $tempat_rapor = $request->input('tempat_rapor', 'Sigi');
        $tanggal_rapor = $request->input('tanggal_rapor', '19 Desember 2026');
        $nama_pengampu = $request->input('nama_pengampu', 'NURUL ZHAFIRAH PUTRI');
        $nama_walas = $request->input('nama_walas', 'NURUL ZHAFIRAH PUTRI');
        $role_pengampu_label = $request->input('role_pengampu_label', 'Pengampu Halaqah & Wali Kelas 5A');
        $role_walas_label = $request->input('role_walas_label', 'Wali Kelas');
        $nama_kepsek = $request->input('nama_kepsek', 'NABILAH TUL ISLAMIYAH S.Pd.,S.Q');
        $role_kepsek_label = $request->input('role_kepsek_label', 'Kepala Sekolah SDQU Imam Syafi’i');

        $nilai_input = $request->input('nilai', []); // array keyed by siswa_id

        foreach ($nilai_input as $siswa_id => $dataSiswa) {
            $siswaModel = siswa::with('kelas')->find($siswa_id);
            $kelasNama = 'VI (ENAM)';
            if ($siswaModel && $siswaModel->kelas) {
                $raw = $siswaModel->kelas->nama_ruang ?? '';
                if (preg_match('/(\d+)/', $raw, $m)) {
                    $romawi = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI'];
                    $terbilang = [1 => 'SATU', 2 => 'DUA', 3 => 'TIGA', 4 => 'EMPAT', 5 => 'LIMA', 6 => 'ENAM'];
                    $num = (int)$m[1];
                    $kelasNama = ($romawi[$num] ?? (string)$num) . (isset($terbilang[$num]) ? ' (' . $terbilang[$num] . ')' : '');
                } else {
                    $kelasNama = $raw ?: 'VI (ENAM)';
                }
            }

            $umur = $siswaModel ? evaluasi_rapor_tahfidz::calculateAge($siswaModel->tanggal_lahir) : '12 TAHUN';
            $namaLengkap = $dataSiswa['nama_lengkap'] ?? ($siswaModel->nama ?? 'MOH. IBNU MUNDZIR');
            $kelasLabel = $dataSiswa['kelas_label'] ?? $kelasNama;

            $nb1 = isset($dataSiswa['nilai_bulan_1']) && $dataSiswa['nilai_bulan_1'] !== '' ? (float)$dataSiswa['nilai_bulan_1'] : (isset($dataSiswa['ujian_1']) && $dataSiswa['ujian_1'] !== '' ? (float)$dataSiswa['ujian_1'] : null);
            $nb2 = isset($dataSiswa['nilai_bulan_2']) && $dataSiswa['nilai_bulan_2'] !== '' ? (float)$dataSiswa['nilai_bulan_2'] : (isset($dataSiswa['ujian_2']) && $dataSiswa['ujian_2'] !== '' ? (float)$dataSiswa['ujian_2'] : null);
            $nb3 = isset($dataSiswa['nilai_bulan_3']) && $dataSiswa['nilai_bulan_3'] !== '' ? (float)$dataSiswa['nilai_bulan_3'] : (isset($dataSiswa['ujian_akhir']) && $dataSiswa['ujian_akhir'] !== '' ? (float)$dataSiswa['ujian_akhir'] : null);
            $nb4 = isset($dataSiswa['nilai_bulan_4']) && $dataSiswa['nilai_bulan_4'] !== '' ? (float)$dataSiswa['nilai_bulan_4'] : null;

            $hasScores = ($nb1 !== null || $nb2 !== null || $nb3 !== null || $nb4 !== null);
            $totalAkhir = ($nb1 ?? 0) + ($nb2 ?? 0) + ($nb3 ?? 0) + ($nb4 ?? 0);
            $rataRata = $hasScores ? round($totalAkhir / 4, 1) : null;
            $predikat = $rataRata !== null ? evaluasi_rapor_tahfidz::calculatePredikat($rataRata) : '-';

            $isManual = str_starts_with((string)$siswa_id, 'manual-');
            $manualId = $isManual ? (int)str_replace('manual-', '', $siswa_id) : null;

            $recordData = [
                'guru_id' => session('id'),
                'nama_lengkap' => $namaLengkap,
                'kelas_label' => $kelasLabel,
                'umur' => $dataSiswa['umur'] ?? $umur,
                'orang_tua' => $dataSiswa['orang_tua'] ?? null,

                // A. Ujian Kenaikan Juz
                'kenaikan_juz_tanggal' => $dataSiswa['kenaikan_juz_tanggal'] ?? 'Rabu, 08 Oktober 2025',
                'kenaikan_juz_nomor' => $dataSiswa['kenaikan_juz_nomor'] ?? '25',
                'kenaikan_juz_predikat' => $dataSiswa['kenaikan_juz_predikat'] ?? 'Jayyid/C',

                // B. Ujian Tasmi’ (4 Bulan)
                'bulan_1_label' => $b1Label,
                'bulan_2_label' => $b2Label,
                'bulan_3_label' => $b3Label,
                'bulan_4_label' => $b4Label,
                'nilai_bulan_1' => $nb1,
                'nilai_bulan_2' => $nb2,
                'nilai_bulan_3' => $nb3,
                'nilai_bulan_4' => $nb4,
                'ujian_1' => $nb1,
                'ujian_2' => $nb2,
                'ujian_akhir' => $nb3,
                'ujian_jumlah' => $totalAkhir,
                'ujian_rata_rata' => $rataRata,
                'ujian_predikat' => $predikat,

                // C. Ujian Tahfiz Terbuka
                'ujian_terbuka_tanggal' => $dataSiswa['ujian_terbuka_tanggal'] ?? $dataSiswa['tasmi_tanggal'] ?? '-',
                'ujian_terbuka_jumlah_juz' => $dataSiswa['ujian_terbuka_jumlah_juz'] ?? $dataSiswa['tasmi_jumlah_juz'] ?? '-',
                'ujian_terbuka_predikat' => $dataSiswa['ujian_terbuka_predikat'] ?? $dataSiswa['tasmi_predikat'] ?? '-',
                'tasmi_tanggal' => $dataSiswa['ujian_terbuka_tanggal'] ?? $dataSiswa['tasmi_tanggal'] ?? '-',
                'tasmi_jumlah_juz' => $dataSiswa['ujian_terbuka_jumlah_juz'] ?? $dataSiswa['tasmi_jumlah_juz'] ?? '-',
                'tasmi_predikat' => $dataSiswa['ujian_terbuka_predikat'] ?? $dataSiswa['tasmi_predikat'] ?? '-',

                // D. Pencapaian Tahfizh
                'target_semester' => $target_semester,
                'tercapai_semester' => $dataSiswa['tercapai_semester'] ?? '<1 Juz  (19 Halaman)  (Az-Zukhruf 32 – Az-Zumar 22)',
                'target_total' => $target_total,
                'tercapai_total' => $dataSiswa['tercapai_total'] ?? '6,5 Juz  (An-nas – Az-Zumar 22)',
                'tercapai_target_semester' => !empty($dataSiswa['tercapai_target_semester']) && ($dataSiswa['tercapai_target_semester'] === '1' || $dataSiswa['tercapai_target_semester'] === 'iya'),
                'tercapai_target_kelas' => !empty($dataSiswa['tercapai_target_kelas']) && ($dataSiswa['tercapai_target_kelas'] === '1' || $dataSiswa['tercapai_target_kelas'] === 'iya'),

                // Catatan Pengampu
                'catatan_bacaan' => $dataSiswa['catatan_bacaan'] ?? null,
                'catatan_hafalan' => $dataSiswa['catatan_hafalan'] ?? null,
                'catatan_akhlak' => $dataSiswa['catatan_akhlak'] ?? null,

                'nama_sekolah' => 'SEKOLAH DASAR AL-QUR’AN IMAM SYAFI’I TINGGEDE',
                'tempat_rapor' => $tempat_rapor,
                'tanggal_rapor' => $tanggal_rapor,
                'nama_pengampu' => $nama_pengampu,
                'nama_walas' => $nama_walas,
                'role_pengampu_label' => $role_pengampu_label,
                'role_walas_label' => $role_walas_label,
                'nama_kepsek' => $nama_kepsek,
                'role_kepsek_label' => $role_kepsek_label
            ];

            if ($isManual && $manualId) {
                evaluasi_rapor_tahfidz::where('id', $manualId)->update($recordData);
            } else {
                evaluasi_rapor_tahfidz::updateOrCreate(
                    [
                        'siswa_id' => (int)$siswa_id,
                        'semester' => $semester,
                        'tahun_ajaran_id' => $tahun_ajaran_id
                    ],
                    $recordData
                );
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Seluruh nilai Raport Tahfizh Al-Qur’an santri berhasil disimpan ke database!'
            ]);
        }

        return redirect()->back()->with('success', 'Seluruh nilai Raport Tahfizh Al-Qur’an santri berhasil disimpan ke database!');
    }

    # ==================== MENU ADMIN & SISWA TAHFIZ LAINNYA ====================
    public function pengumuman()
    {
        return view("modul/tahfiz/pengumuman");
    }

    public function siswa_tahfiz()
    {
        return view("modul/tahfiz/siswatahfiz");
    }

    public function laporan_harian()
    {
        return view("modul/tahfiz/laporanharian");
    }

    public function rekap_mgg()
    {
        return view("modul/tahfiz/rekapmingguan");
    }

    public function rekap_bln()
    {
        return view("modul/tahfiz/rekapbulanan");
    }

    public function pengampu()
    {
        return view("modul/tahfiz/pengampu");
    }

    public function input_setoran()
    {
        return view("modul/tahfiz/inputsetoran");
    }

    public function dashboard_siswa()
    {
        return view("modul/tahfiz/siswa/dasboard");
    }

    public function progres_hafalan()
    {
        return view("modul/tahfiz/siswa/progres");
    }

    public function laporan_siswa()
    {
        return view("modul/tahfiz/siswa/riwayatlaporan");
    }

    public function profil()
    {
        return view("modul/tahfiz/siswa/profilsiswa");
    }

    public function pengumuman_siswa()
    {
        return view("modul/tahfiz/siswa/pengumumansiswa");
    }
}
