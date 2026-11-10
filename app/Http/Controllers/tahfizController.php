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

        $siswa = siswa::with(['kelas', 'sekolah', 'tahunAjaran'])->findOrFail($siswa_id);

        $tahun_aktif = tahun_ajaran::where('aktif', 1)->first() ?? (object)[
            'id' => null,
            'nama' => '2025/2026',
            'semester' => 1
        ];

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

        return view('modul.tahfiz.guru.detailRaporWalas', compact(
            'siswa',
            'tahun_aktif',
            'evaluasi',
            'template',
            'riwayatHafalan',
            'semuaSiswaKelas'
        ));
    }

    /**
     * Cetak Seluruh Rapor Kelas Sekaligus (Massal)
     */
    public function cetak_rapor_massal(Request $request)
    {
        $check = $this->guardRoles(['g', 'a']);
        if ($check) return $check;

        $kelas_id = $request->query('kelas_id');

        $siswa_query = siswa::with(['kelas', 'sekolah']);
        if ($kelas_id) {
            $siswa_query->where('kelas_id', $kelas_id);
        }
        $daftar_siswa = $siswa_query->where('aktif', 1)->orderBy('nama')->get();

        if ($daftar_siswa->isEmpty()) {
            $daftar_siswa = siswa::with(['kelas', 'sekolah'])->where('aktif', 1)->orderBy('nama')->take(20)->get();
        }

        $tahun_aktif = tahun_ajaran::where('aktif', 1)->first() ?? (object)[
            'id' => null,
            'nama' => '2025/2026',
            'semester' => 1
        ];

        // Ambil evaluasi untuk semua siswa
        $evaluasi_map = evaluasi_rapor_tahfidz::whereIn('siswa_id', $daftar_siswa->pluck('id'))
            ->get()
            ->keyBy('siswa_id');

        $kelasInfo = ruang_kelas::find($kelas_id);

        return view('modul.tahfiz.guru.cetakRaporMassal', compact(
            'daftar_siswa',
            'evaluasi_map',
            'tahun_aktif',
            'kelasInfo'
        ));
    }

    /**
     * Simpan Evaluasi Rapor Santri ke Database
     */
    public function simpan_evaluasi_rapor(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id'
        ]);

        $siswa_id = $request->input('siswa_id');
        $tahun_aktif = tahun_ajaran::where('aktif', 1)->first();
        $tahun_ajaran_id = $tahun_aktif ? $tahun_aktif->id : $request->input('tahun_ajaran_id');
        $semester = $request->input('semester', $tahun_aktif->semester ?? 1);

        // Perhitungan otomatis Ujian Tahfidzh
        $u1 = $request->filled('ujian_1') ? (float)$request->input('ujian_1') : 75.0;
        $u2 = $request->filled('ujian_2') ? (float)$request->input('ujian_2') : 92.0;
        $ua = $request->filled('ujian_akhir') ? (float)$request->input('ujian_akhir') : 75.0;
        $jumlah = $request->filled('ujian_jumlah') ? (float)$request->input('ujian_jumlah') : ($u1 + $u2 + ($ua * 2));
        $rataRata = $request->filled('ujian_rata_rata') ? (float)$request->input('ujian_rata_rata') : round($jumlah / 4, 1);
        $predikatUjian = $request->input('ujian_predikat') ?: evaluasi_rapor_tahfidz::calculatePredikat($rataRata);

        $data = [
            'guru_id' => session('id'),
            'umur' => $request->input('umur', '12 TAHUN'),
            'orang_tua' => $request->input('orang_tua'),

            // A. Ujian Kenaikan Juz
            'kenaikan_juz_tanggal' => $request->input('kenaikan_juz_tanggal', 'Rabu, 08 Oktober 2025'),
            'kenaikan_juz_nomor' => $request->input('kenaikan_juz_nomor', '25'),
            'kenaikan_juz_predikat' => $request->input('kenaikan_juz_predikat', 'Jayyid/C'),

            // B. Ujian Tahfidzh
            'ujian_1' => $u1,
            'ujian_2' => $u2,
            'ujian_akhir' => $ua,
            'ujian_jumlah' => $jumlah,
            'ujian_rata_rata' => $rataRata,
            'ujian_predikat' => $predikatUjian,

            // C. Tasmi' Akhir Semester
            'tasmi_tanggal' => $request->input('tasmi_tanggal', '-'),
            'tasmi_jumlah_juz' => $request->input('tasmi_jumlah_juz', '-'),
            'tasmi_predikat' => $request->input('tasmi_predikat', '-'),

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
            'tanggal_rapor' => $request->input('tanggal_rapor', '20 Desember 2025'),
            'nama_pengampu' => $request->input('nama_pengampu', 'USTADZAH PENGAMPU HALAQAH'),
            'ttd_pengampu' => $request->input('ttd_pengampu'),
            'nama_walas' => $request->input('nama_walas', 'NURUL ZHAFIRAH PUTRI'),
            'role_pengampu_label' => $request->input('role_pengampu_label', 'Wali Kelas 6'),
            'nama_kepsek' => $request->input('nama_kepsek', 'NABILAH TUL ISLAMIYAH S.Pd.,S.Q'),
            'ttd_walas' => $request->input('ttd_walas'),
            'ttd_kepsek' => $request->input('ttd_kepsek'),
        ];

        $evaluasi = evaluasi_rapor_tahfidz::updateOrCreate(
            [
                'siswa_id' => $siswa_id,
                'semester' => $semester,
                'tahun_ajaran_id' => $tahun_ajaran_id
            ],
            $data
        );

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Rapor Tahfidz santri berhasil disimpan ke database!',
                'data' => $evaluasi
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

        // Template default
        $default_template = evaluasi_rapor_tahfidz::getDefaultTemplate();

        // Cari jika salah satu santri di kelas sudah memiliki judul/deskripsi khusus
        $firstSaved = $evaluasi_list->first();
        if ($firstSaved) {
            $projek_info = [
                'tema_projek' => $firstSaved->tema_projek ?: $default_template['tema_projek'],
                'judul_projek' => $firstSaved->judul_projek ?: $default_template['judul_projek'],
                'deskripsi_projek' => $firstSaved->deskripsi_projek ?: $default_template['deskripsi_projek'],
                'sub_judul_kegiatan' => $firstSaved->sub_judul_kegiatan ?: $default_template['sub_judul_kegiatan'],
            ];
        } else {
            $projek_info = [
                'tema_projek' => $default_template['tema_projek'],
                'judul_projek' => $default_template['judul_projek'],
                'deskripsi_projek' => $default_template['deskripsi_projek'],
                'sub_judul_kegiatan' => $default_template['sub_judul_kegiatan'],
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

        $target_semester = $request->input('target_semester', '1 Juz');
        $target_total = $request->input('target_total', '9 Juz');
        $tempat_rapor = $request->input('tempat_rapor', 'Sigi');
        $tanggal_rapor = $request->input('tanggal_rapor', '20 Desember 2025');
        $nama_pengampu = $request->input('nama_pengampu', 'USTADZAH PENGAMPU HALAQAH');
        $nama_walas = $request->input('nama_walas', 'NURUL ZHAFIRAH PUTRI');
        $role_pengampu_label = $request->input('role_pengampu_label', 'Wali Kelas 6');
        $nama_kepsek = $request->input('nama_kepsek', 'NABILAH TUL ISLAMIYAH S.Pd.,S.Q');

        $nilai_input = $request->input('nilai', []); // array keyed by siswa_id

        foreach ($nilai_input as $siswa_id => $dataSiswa) {
            $u1 = isset($dataSiswa['ujian_1']) && $dataSiswa['ujian_1'] !== '' ? (float)$dataSiswa['ujian_1'] : 75.0;
            $u2 = isset($dataSiswa['ujian_2']) && $dataSiswa['ujian_2'] !== '' ? (float)$dataSiswa['ujian_2'] : 92.0;
            $ua = isset($dataSiswa['ujian_akhir']) && $dataSiswa['ujian_akhir'] !== '' ? (float)$dataSiswa['ujian_akhir'] : 75.0;

            $jumlah = $u1 + $u2 + ($ua * 2);
            $rataRata = round($jumlah / 4, 1);
            $predikat = evaluasi_rapor_tahfidz::calculatePredikat($rataRata);

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

            evaluasi_rapor_tahfidz::updateOrCreate(
                [
                    'siswa_id' => $siswa_id,
                    'semester' => $semester,
                    'tahun_ajaran_id' => $tahun_ajaran_id
                ],
                [
                    'guru_id' => session('id'),
                    'umur' => $dataSiswa['umur'] ?? $umur,
                    'orang_tua' => $dataSiswa['orang_tua'] ?? null,

                    // A. Ujian Kenaikan Juz
                    'kenaikan_juz_tanggal' => $dataSiswa['kenaikan_juz_tanggal'] ?? 'Rabu, 08 Oktober 2025',
                    'kenaikan_juz_nomor' => $dataSiswa['kenaikan_juz_nomor'] ?? '25',
                    'kenaikan_juz_predikat' => $dataSiswa['kenaikan_juz_predikat'] ?? 'Jayyid/C',

                    // B. Ujian Tahfidzh
                    'ujian_1' => $u1,
                    'ujian_2' => $u2,
                    'ujian_akhir' => $ua,
                    'ujian_jumlah' => $jumlah,
                    'ujian_rata_rata' => $rataRata,
                    'ujian_predikat' => $predikat,

                    // C. Tasmi' Akhir Semester
                    'tasmi_tanggal' => $dataSiswa['tasmi_tanggal'] ?? '-',
                    'tasmi_jumlah_juz' => $dataSiswa['tasmi_jumlah_juz'] ?? '-',
                    'tasmi_predikat' => $dataSiswa['tasmi_predikat'] ?? '-',

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

                    'kelas_label' => $kelasNama,
                    'nama_sekolah' => 'SEKOLAH DASAR AL-QUR’AN IMAM SYAFI’I TINGGEDE',
                    'tempat_rapor' => $tempat_rapor,
                    'tanggal_rapor' => $tanggal_rapor,
                    'nama_pengampu' => $nama_pengampu,
                    'nama_walas' => $nama_walas,
                    'role_pengampu_label' => $role_pengampu_label,
                    'nama_kepsek' => $nama_kepsek
                ]
            );
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
