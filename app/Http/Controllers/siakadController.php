<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\ruang_kelas;
use App\Models\siswa;
use App\Models\slip_pembayaran_ipp;
use App\Models\slip_pembayaran_pangkal;
use App\Models\slip_pembayaran_pendidikan;
use App\Services\FonteService;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class siakadController extends Controller
{
    private function guardRoles(array $allowedRoles) {
        $currentRole = session('role');
        if (!in_array($currentRole, $allowedRoles)) {
            if ($currentRole === 'a') return redirect('/sk/das')->with('error', 'Akses dialihkan ke Portal Admin.');
            if ($currentRole === 'g') return redirect('/sk/dsg')->with('error', 'Akses dialihkan ke Portal Guru.');
            if ($currentRole === 's') return redirect('/sk/dbs')->with('error', 'Akses dialihkan ke Portal Siswa.');
            return redirect('/')->with('error', 'Silakan masuk terlebih dahulu.');
        }
        return null;
    }

    // ==========================================
    // MANAJEMEN NILAI (GURU PENGAJAR & WALI KELAS)
    // ==========================================
    public function inputNilaiDetail(Request $request, $jadwal_id) {
        $check = $this->guardRoles(['g']);
        if ($check) return $check;
        $guru_id = session('id');
        $jadwal = \App\Models\jadwal_pelajaran::with(['kelas', 'mata_pelajaran', 'jam_pelajaran', 'tahun_ajaran', 'guru'])->find($jadwal_id);
        
        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
        }

        // Cek apakah user adalah Guru Pengajar jadwal ini ATAU Wali Kelas dari kelas jadwal ini
        $nama_kelas = $jadwal->kelas->nama_kelas ?? '';
        $ruang_kelas = \App\Models\ruang_kelas::where('nama_ruang', $nama_kelas)->first();
        $ruang_kelas_id = $ruang_kelas ? $ruang_kelas->id : $jadwal->kelas_id;

        $wallas = \App\Models\wallas::with('ruangKelas')->where('guru_id', $guru_id)->first();
        $isWalasKelasIni = $wallas && ($wallas->kelas_id == $ruang_kelas_id || ($wallas->ruangKelas && $wallas->ruangKelas->nama_ruang === $nama_kelas));

        if ($jadwal->guru_id != $guru_id && !$isWalasKelasIni) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengelola nilai mata pelajaran ini.');
        }

        $isWalasAccess = ($request->query('from') === 'walas') || ($jadwal->guru_id != $guru_id && $isWalasKelasIni);

        $siswa = \App\Models\siswa::where('kelas_id', $ruang_kelas_id)->orderBy('nama')->get();

        $jenis_penilaian = \App\Models\jenis_penilaian::all();
        if ($jenis_penilaian->isEmpty()) {
            \App\Models\jenis_penilaian::insert([
                ['nama_jenis' => 'Tugas', 'bobot' => 20],
                ['nama_jenis' => 'Ulangan Harian', 'bobot' => 30],
                ['nama_jenis' => 'UTS', 'bobot' => 20],
                ['nama_jenis' => 'UAS', 'bobot' => 30]
            ]);
            $jenis_penilaian = \App\Models\jenis_penilaian::all();
        }
        
        // Ambil nilai yang sudah ada untuk mata pelajaran & siswa di kelas ini
        $nilai_db = \App\Models\nilai::where('mapel_id', $jadwal->mapel_id)
                        ->whereIn('siswa_id', $siswa->pluck('id'))
                        ->get();
                        
        // Kelompokkan nilai agar mudah diakses di blade: $nilai[siswa_id][jenis_penilaian_id] = nilai
        $nilai = [];
        foreach ($nilai_db as $n) {
            $nilai[$n->siswa_id][$n->jenis_penilaian_id] = $n->nilai;
        }

        return view('modul.siakad.guru.inputNilaiDetail', compact('jadwal', 'siswa', 'jenis_penilaian', 'nilai', 'isWalasAccess'));
    }

    public function simpanNilaiSiswa(Request $request, $jadwal_id) {
        $check = $this->guardRoles(['g']);
        if ($check) return $check;
        $guru_id = session('id');
        $jadwal = \App\Models\jadwal_pelajaran::with('kelas')->find($jadwal_id);
        
        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
        }

        // Validasi hak akses: Guru Pengajar jadwal ini ATAU Wali Kelas dari kelas ini
        $nama_kelas = $jadwal->kelas->nama_kelas ?? '';
        $ruang_kelas = \App\Models\ruang_kelas::where('nama_ruang', $nama_kelas)->first();
        $ruang_kelas_id = $ruang_kelas ? $ruang_kelas->id : $jadwal->kelas_id;

        $wallas = \App\Models\wallas::with('ruangKelas')->where('guru_id', $guru_id)->first();
        $isWalasKelasIni = $wallas && ($wallas->kelas_id == $ruang_kelas_id || ($wallas->ruangKelas && $wallas->ruangKelas->nama_ruang === $nama_kelas));

        if ($jadwal->guru_id != $guru_id && !$isWalasKelasIni) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $input_nilai = $request->input('nilai'); // format: nilai[siswa_id][jenis_penilaian_id] = angka

        if ($input_nilai) {
            foreach ($input_nilai as $siswa_id => $penilaian) {
                foreach ($penilaian as $jenis_id => $angka) {
                    if ($angka !== null && $angka !== '') {
                        $cleanScore = min(100, max(0, floatval($angka)));
                        \App\Models\nilai::updateOrCreate(
                            [
                                'siswa_id' => $siswa_id,
                                'mapel_id' => $jadwal->mapel_id,
                                'jenis_penilaian_id' => $jenis_id,
                                'semester' => 'ganjil', // Default ganjil sementara
                                'tahun_ajaran_id' => $jadwal->tahun_ajaran_id
                            ],
                            [
                                'guru_id' => $jadwal->guru_id,
                                'nilai' => $cleanScore
                            ]
                        );
                    }

                }
            }
        }

        return redirect()->back()->with('success', 'Data nilai siswa berhasil disimpan dan diperbarui!');
    }
    // ==========================================
    // MANAJEMEN KENAIKAN KELAS & KELULUSAN (ADMIN)
    // ==========================================
    public function kenaikanKelasAdmin(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $sekolah_id = $request->query('sekolah_id');
        $kelas_id = $request->input('kelas_id');
        
        $kelas_query = \App\Models\ruang_kelas::orderBy('nama_ruang');
        if ($sekolah_id) {
            $jenis = \App\Models\jenis_sekolah::find($sekolah_id);
            if ($jenis) {
                $prefix = strtoupper($jenis->jenis);
                $kelas_query->where('nama_ruang', 'like', $prefix . ' %');
            }
        }
        $data_kelas = $kelas_query->get();
        
        $siswa = collect();
        if ($kelas_id) {
            $siswa = \App\Models\siswa::where('kelas_id', $kelas_id)->where('aktif', 1)->orderBy('nama')->get();
        }

        $data_sekolah = \App\Models\jenis_sekolah::all();
        return view('modul.siakad.admin.kenaikanKelas', compact('data_kelas', 'siswa', 'kelas_id', 'data_sekolah', 'sekolah_id'));
    }

    public function prosesKenaikanKelas(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate([
            'siswa_id' => 'required|array',
            'aksi' => 'required|in:naik,lulus',
            'kelas_tujuan' => 'required_if:aksi,naik'
        ]);

        $siswa_ids = $request->input('siswa_id');
        $aksi = $request->input('aksi');

        if ($aksi === 'naik') {
            $kelas_tujuan = $request->input('kelas_tujuan');
            \App\Models\siswa::whereIn('id', $siswa_ids)->update(['kelas_id' => $kelas_tujuan]);
            return redirect()->back()->with('success', count($siswa_ids) . ' siswa berhasil dipindahkan ke kelas baru.');
        } else if ($aksi === 'lulus') {
            \App\Models\siswa::whereIn('id', $siswa_ids)->update(['aktif' => 0]);
            return redirect()->back()->with('success', count($siswa_ids) . ' siswa berhasil diluluskan (dinonaktifkan dari akademik aktif).');
        }
        
        return redirect()->back();
    }

    // ==========================================
    // MANAJEMEN PEMBAGIAN KELAS (ROMBEL)
    // ==========================================
    public function pembagianKelas(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $sekolah_id = $request->query('sekolah_id');
        $kelas_id = $request->query('kelas_id');
        
        $kelas_query = \App\Models\ruang_kelas::orderBy('nama_ruang');
        $siswa_query = \App\Models\siswa::whereNull('kelas_id')->orderBy('nama');

        if ($sekolah_id) {
            $jenis = \App\Models\jenis_sekolah::find($sekolah_id);
            if ($jenis) {
                $prefix = strtoupper($jenis->jenis);
                $kelas_query->where('nama_ruang', 'like', $prefix . ' %');
            }
            $siswa_query->where('sekolah_id', $sekolah_id);
        }
        $data_kelas = $kelas_query->get();
        $siswa_belum_ada_kelas = $siswa_query->get();
        
        $kelas_terpilih = null;
        $siswa_di_kelas = collect();
        
        if ($kelas_id) {
            $kelas_terpilih = \App\Models\ruang_kelas::find($kelas_id);
            if ($kelas_terpilih) {
                $siswa_di_kelas = \App\Models\siswa::where('kelas_id', $kelas_id)->orderBy('nama')->get();
            }
        }
        $siswa_kelas_ini = $siswa_di_kelas;
        
        $data_sekolah = \App\Models\jenis_sekolah::all();
        return view('modul.siakad.admin.pembagianKelas', compact('data_kelas', 'siswa_belum_ada_kelas', 'kelas_terpilih', 'siswa_di_kelas', 'siswa_kelas_ini', 'kelas_id', 'data_sekolah', 'sekolah_id'));
    }

    public function simpanPembagianKelas(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate([
            'kelas_id' => 'required|exists:ruang_kelas,id',
            'siswa_ids' => 'required|array'
        ]);

        \App\Models\siswa::whereIn('id', $request->siswa_ids)
            ->update(['kelas_id' => $request->kelas_id]);

        return redirect()->back()->with('success', count($request->siswa_ids) . ' siswa berhasil ditambahkan ke kelas.');
    }

    public function keluarkanSiswaDariKelas($id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $siswa = \App\Models\siswa::find($id);
        if ($siswa) {
            $siswa->update(['kelas_id' => null]);
            return redirect()->back()->with('success', 'Siswa berhasil dikeluarkan dari kelas.');
        }
        return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
    }
    function tampilanBuatTagihan_Siswa(){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $data_siswa = siswa::all();
        return view("/modul/siakad/buatTagihan",[
            "data_siswa" => $data_siswa
        ]);
    }

    function edit_siswa(){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        return view ('/modul/siakad/admin/editSiswa');
    }

    function dashboard_siakad(){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $jumlahSiswa = siswa::count();
        $jumlahSiswaAktif = siswa::where(function ($query) {
            $query->where('aktif', true)->orWhereNull('aktif');
        })->count();
        $jumlahKelas = ruang_kelas::count();
        $jumlahTagihan = slip_pembayaran_ipp::count()
            + slip_pembayaran_pangkal::count()
            + slip_pembayaran_pendidikan::count();
        $jumlahTunggakan = slip_pembayaran_ipp::where('status', false)->count()
            + slip_pembayaran_pangkal::where('status', false)->count()
            + slip_pembayaran_pendidikan::where('status', false)->count();
        $kelasDenganSiswa = ruang_kelas::query()
            ->leftJoin('siswa', 'siswa.kelas_id', '=', 'ruang_kelas.id')
            ->select('ruang_kelas.id', 'ruang_kelas.nama_ruang', DB::raw('COUNT(siswa.id) as jumlah_siswa'))
            ->groupBy('ruang_kelas.id', 'ruang_kelas.nama_ruang')
            ->orderByDesc('jumlah_siswa')
            ->limit(5)
            ->get();

        return view('/modul/siakad/admin/dasboard', compact(
            'jumlahSiswa',
            'jumlahSiswaAktif',
            'jumlahKelas',
            'jumlahTagihan',
            'jumlahTunggakan',
            'kelasDenganSiswa'
        ));
    }

    function tampilanDashboardGuru(){
        $check = $this->guardRoles(['g']);
        if ($check) return $check;

        $guru_id = session('id');
        $guru = \App\Models\guru::find($guru_id);
        
        $wallas = \App\Models\wallas::with('ruangKelas')->where('guru_id', $guru_id)->first();
        $isWallas = $wallas ? true : false;

        // Walas sudah tentu menjadi guru pengajar juga, bahkan jika checkbox di modul guru dimatikan
        $isPengajar = $isWallas || ($guru && ($guru->guru_tetap || $guru->guru_honor)) || \App\Models\jadwal_pelajaran::where('guru_id', $guru_id)->exists();
        
        $hari_ini = date('l');
        $hari_indo = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];
        $nama_hari = $hari_indo[$hari_ini] ?? 'Senin';
        
        $jadwal_hari_ini = collect();
        $kelas_diampu = collect();
        if ($isPengajar) {
            $jadwal_hari_ini = \App\Models\jadwal_pelajaran::with(['kelas', 'mata_pelajaran', 'jam_pelajaran'])
                                ->where('guru_id', $guru_id)
                                ->where('hari', strtolower($nama_hari))
                                ->get()
                                ->sortBy(function($j) {
                                    return $j->jam_pelajaran->jam_mulai ?? '00:00';
                                });
                                
            $kelas_mapel_ids = \App\Models\jadwal_pelajaran::where('guru_id', $guru_id)->pluck('kelas_id')->unique();
            $kelas_diampu = \App\Models\kelas::whereIn('id', $kelas_mapel_ids)->get();
        }

        // Data siswa binaan wali kelas
        $siswa_walas = collect();
        if ($isWallas && $wallas) {
            $siswa_walas = \App\Models\siswa::where('kelas_id', $wallas->kelas_id)->get();
        }

        return view("/modul/siakad/guru/dashboard_guru", compact('guru', 'wallas', 'isWallas', 'isPengajar', 'jadwal_hari_ini', 'kelas_diampu', 'nama_hari', 'siswa_walas'));
    }
   
    function tambah_kelas(){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

       // Sinkronisasi otomatis dari Modul Guru (ruang_kelas) ke tabel kelas SIAKAD
       $ruang_kelas_all = \App\Models\ruang_kelas::all();
       foreach($ruang_kelas_all as $rk) {
           if (!\App\Models\kelas::where('nama_kelas', $rk->nama_ruang)->exists()) {
               \App\Models\kelas::create([
                   'nama_kelas' => $rk->nama_ruang
               ]);
           }
       }

       $data_kelas = \App\Models\kelas::all();
       return view("/modul/siakad/admin/tambahKelas", compact('data_kelas'));
    }
    public function laporanAbsensiGuru(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;
        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $status_filter = $request->input('status', 'semua');
        
        $carbonTanggal = \Carbon\Carbon::parse($tanggal)->locale('id');
        $hari_terpilih = strtolower($carbonTanggal->isoFormat('dddd'));
        $hari_indonesia = ucfirst($carbonTanggal->isoFormat('dddd, D MMMM Y'));

        // Ambil semua jadwal pelajaran pada hari yang sesuai dengan tanggal terpilih
        $semua_jadwal = \App\Models\jadwal_pelajaran::with(['guru', 'mata_pelajaran', 'jam_pelajaran', 'kelas'])
            ->where('hari', $hari_terpilih)
            ->get()
            ->sortBy(function($j) {
                return $j->jam_pelajaran->jam_mulai ?? '00:00';
            });

        // Ambil absensi mengajar guru yang tercatat pada tanggal tersebut
        $absensi_guru_db = \App\Models\absensi_mengajar_guru::where('tanggal', $tanggal)
            ->get()
            ->keyBy('jadwal_pelajaran_id');

        // Ambil data rekap absensi siswa per jadwal pada tanggal tersebut
        $absensi_siswa_db = \App\Models\absensi_siswa::where('tanggal', $tanggal)
            ->whereNotNull('jadwal_pelajaran_id')
            ->get()
            ->groupBy('jadwal_pelajaran_id');

        $laporan = collect();
        $total_sesi = $semua_jadwal->count();
        $total_tepat_waktu = 0;
        $total_terlambat = 0;
        $total_belum_absen = 0;

        foreach ($semua_jadwal as $jadwal) {
            $absen = $absensi_guru_db->get($jadwal->id);
            $siswa_absen = $absensi_siswa_db->get($jadwal->id, collect());
            
            $jam_mulai = $jadwal->jam_pelajaran ? \Carbon\Carbon::parse($jadwal->jam_pelajaran->jam_mulai) : null;
            $jam_batas = $jam_mulai ? $jam_mulai->copy()->addMinutes(5) : null;
            
            $status = 'belum_absen';
            $jam_masuk = null;

            if ($absen) {
                $status = $absen->status; // 'tepat_waktu' | 'terlambat'
                $jam_masuk = $absen->jam_masuk;
                if ($status === 'tepat_waktu') {
                    $total_tepat_waktu++;
                } else {
                    $total_terlambat++;
                }
            } else {
                $total_belum_absen++;
            }

            // Filter status jika ada
            if ($status_filter !== 'semua' && $status !== $status_filter) {
                continue;
            }

            $laporan->push((object)[
                'jadwal' => $jadwal,
                'guru' => $jadwal->guru,
                'mata_pelajaran' => $jadwal->mata_pelajaran,
                'kelas' => $jadwal->kelas,
                'jam_pelajaran' => $jadwal->jam_pelajaran,
                'jam_mulai' => $jam_mulai ? $jam_mulai->format('H:i') : '-',
                'jam_selesai' => $jadwal->jam_pelajaran ? substr($jadwal->jam_pelajaran->jam_selesai, 0, 5) : '-',
                'jam_batas_toleransi' => $jam_batas ? $jam_batas->format('H:i') : '-',
                'jam_masuk' => $jam_masuk,
                'status' => $status,
                'materi' => $absen->materi ?? null,
                'catatan' => $absen->catatan ?? null,
                'rekap_siswa' => [
                    'hadir' => $siswa_absen->where('status', 'h')->count(),
                    'sakit' => $siswa_absen->where('status', 's')->count(),
                    'izin'  => $siswa_absen->where('status', 'i')->count(),
                    'alpa'  => $siswa_absen->where('status', 'a')->count(),
                    'total' => $siswa_absen->count()
                ]
            ]);
        }

        $stats = [
            'total_sesi' => $total_sesi,
            'tepat_waktu' => $total_tepat_waktu,
            'terlambat' => $total_terlambat,
            'belum_absen' => $total_belum_absen
        ];

        return view('/modul/siakad/admin/laporanAbsensiGuru', compact('laporan', 'tanggal', 'hari_indonesia', 'stats', 'status_filter'));
    }

    function absenSiswa(Request $request){
        $check = $this->guardRoles(['g']);
        if ($check) return $check;

        $guru_id = session('id');
        $guru = \App\Models\guru::find($guru_id);
        $isWallas = \App\Models\wallas::where('guru_id', $guru_id)->exists();
        $isPengajar = $isWallas || ($guru && ($guru->guru_tetap || $guru->guru_honor)) || \App\Models\jadwal_pelajaran::where('guru_id', $guru_id)->exists();
        if (!$isPengajar) {
            return redirect('/sk/dsg')->with('error', 'Status Anda pada modul guru bukan sebagai Guru Pengajar.');
        }

        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $carbonTanggal = \Carbon\Carbon::parse($tanggal)->locale('id');
        $hari_terpilih = strtolower($carbonTanggal->isoFormat('dddd'));
        $hari_indonesia = ucfirst($carbonTanggal->isoFormat('dddd, D MMMM Y'));
        
        // Ambil jadwal mengajar guru pada hari tanggal terpilih
        $jadwal_hari_ini = \App\Models\jadwal_pelajaran::with(['kelas', 'mata_pelajaran', 'jam_pelajaran'])
            ->where('guru_id', $guru_id)
            ->where('hari', $hari_terpilih)
            ->get()
            ->sortBy(function($j) {
                return $j->jam_pelajaran->jam_mulai ?? '00:00';
            });

        // Ambil data absensi guru untuk semua jadwal hari itu
        $absensi_guru_semua = \App\Models\absensi_mengajar_guru::whereIn('jadwal_pelajaran_id', $jadwal_hari_ini->pluck('id'))
            ->where('tanggal', $tanggal)
            ->get()
            ->keyBy('jadwal_pelajaran_id');

        // Ambil data absensi siswa untuk semua jadwal hari itu
        $absensi_siswa_semua = \App\Models\absensi_siswa::whereIn('jadwal_pelajaran_id', $jadwal_hari_ini->pluck('id'))
            ->where('tanggal', $tanggal)
            ->get()
            ->groupBy('jadwal_pelajaran_id');
            
        $jadwal_id = $request->input('jadwal_id');
        $siswa = collect();
        $absensi_db = collect();
        $jadwal_terpilih = null;
        $absen_guru = null;
        $toleransi_info = null;
        
        if ($jadwal_id) {
            $jadwal_terpilih = \App\Models\jadwal_pelajaran::with(['kelas', 'mata_pelajaran', 'jam_pelajaran'])->find($jadwal_id);
            if ($jadwal_terpilih && $jadwal_terpilih->guru_id == $guru_id) {
                // Sinkronisasi kelas ke ruang_kelas
                $nama_kelas = $jadwal_terpilih->kelas->nama_kelas ?? '';
                $ruang_kelas = \App\Models\ruang_kelas::where('nama_ruang', $nama_kelas)->first();
                $ruang_kelas_id = $ruang_kelas ? $ruang_kelas->id : $jadwal_terpilih->kelas_id;

                $siswa = \App\Models\siswa::where('kelas_id', $ruang_kelas_id)->orderBy('nama')->get();
                $absensi_db = \App\Models\absensi_siswa::where('jadwal_pelajaran_id', $jadwal_id)
                    ->where('tanggal', $tanggal)
                    ->get()
                    ->keyBy('siswa_id');

                $absen_guru = $absensi_guru_semua->get($jadwal_id);

                $jam_mulai = $jadwal_terpilih->jam_pelajaran ? \Carbon\Carbon::parse($jadwal_terpilih->jam_pelajaran->jam_mulai) : null;
                $jam_buka = $jam_mulai ? $jam_mulai->copy()->subMinutes(5) : null; // Buka 5 mnt sebelum bel
                $jam_batas = $jam_mulai ? $jam_mulai->copy()->addMinutes(5) : null; // Toleransi 5 mnt setelah bel
                $sekarang = now();
                $is_today = ($tanggal === date('Y-m-d'));

                // Cek apakah belum boleh absen (terlalu dini sebelum waktu buka)
                $terlalu_dini = false;
                if ($is_today && !$absen_guru) {
                    $terlalu_dini = $jam_buka && ($sekarang->format('H:i:s') < $jam_buka->format('H:i:s'));
                }

                $estimasi = 'tepat_waktu';
                if ($is_today) {
                    if ($terlalu_dini) {
                        $estimasi = 'belum_buka';
                    } else if ($jam_batas && $sekarang->format('H:i:s') <= $jam_batas->format('H:i:s')) {
                        $estimasi = 'tepat_waktu';
                    } else {
                        $estimasi = 'terlambat';
                    }
                } else if ($tanggal < date('Y-m-d')) {
                    $estimasi = 'terlambat';
                }

                $toleransi_info = [
                    'jam_mulai' => $jam_mulai ? $jam_mulai->format('H:i') : '-',
                    'jam_selesai' => $jadwal_terpilih->jam_pelajaran ? substr($jadwal_terpilih->jam_pelajaran->jam_selesai, 0, 5) : '-',
                    'jam_buka' => $jam_buka ? $jam_buka->format('H:i') : '-',
                    'jam_batas' => $jam_batas ? $jam_batas->format('H:i') : '-',
                    'estimasi_status' => $estimasi,
                    'terlalu_dini' => $terlalu_dini,
                    'is_today' => $is_today
                ];
            }
        }
        
        $rekap_siswa = [
            'total' => $siswa->count(),
            'hadir' => $absensi_db->where('status', 'h')->count(),
            'sakit' => $absensi_db->where('status', 's')->count(),
            'izin'  => $absensi_db->where('status', 'i')->count(),
            'alpa'  => $absensi_db->where('status', 'a')->count(),
        ];

        return view("/modul/siakad/guru/absensiMapel", compact(
            'jadwal_hari_ini', 'siswa', 'absensi_db', 'tanggal', 'jadwal_id', 'jadwal_terpilih', 
            'absen_guru', 'toleransi_info', 'rekap_siswa', 'hari_indonesia', 'absensi_guru_semua', 'absensi_siswa_semua'
        ));
    }

    public function simpanAbsensiMapel(Request $request) {
        $check = $this->guardRoles(['g']);
        if ($check) return $check;

        $guru_id = session('id');
        $jadwal_id = $request->input('jadwal_id');
        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $absensi = $request->input('absensi', []);
        $materi = $request->input('materi') ?: 'Pertemuan Pembelajaran Rutin';
        $catatan = $request->input('catatan') ?? $request->input('catatan_jurnal');
        
        if ($tanggal > date('Y-m-d')) {
            return redirect()->back()->with('error', 'Tidak dapat melakukan absensi untuk tanggal di masa depan.');
        }

        $jadwal = \App\Models\jadwal_pelajaran::with(['jam_pelajaran', 'mata_pelajaran', 'kelas'])->find($jadwal_id);
        if (!$jadwal || $jadwal->guru_id != $guru_id) {
            return redirect()->back()->with('error', 'Jadwal mengajar tidak valid atau bukan milik Anda.');
        }

        // Cek & Rekam Kehadiran Guru Mengajar
        // Toleransi masuk kelas: jam_pelajaran->jam_mulai + 5 menit
        $absen_guru = \App\Models\absensi_mengajar_guru::where('jadwal_pelajaran_id', $jadwal_id)
            ->where('tanggal', $tanggal)
            ->first();

        $jam_mulai_str = $jadwal->jam_pelajaran->jam_mulai ?? '07:00:00';
        $jam_mulai = \Carbon\Carbon::parse($jam_mulai_str);
        $jam_buka = $jam_mulai->copy()->subMinutes(5); // buka 5 menit sebelum jam mulai
        $jam_batas = $jam_mulai->copy()->addMinutes(5); // batas toleransi 5 menit setelah jam mulai
        $sekarang = now();

        // Validasi Anti-Kecurangan Absen Terlalu Dini
        if (!$absen_guru && $tanggal === date('Y-m-d')) {
            if ($sekarang->format('H:i:s') < $jam_buka->format('H:i:s')) {
                return redirect()->back()->with('error', 'Presensi belum dapat dilakukan. Sesi ini baru dapat dibuka mulai pukul ' . $jam_buka->format('H:i') . ' WIB (5 menit sebelum jam mulai).');
            }
        }

        // Sinkronisasi kelas jadwal ke ruang_kelas (foreign key absensi_siswa.kelas_id -> ruang_kelas.id)
        $nama_kelas = $jadwal->kelas->nama_kelas ?? ($jadwal->kelas->nama_ruang ?? '');
        $ruang_kelas = \App\Models\ruang_kelas::where('nama_ruang', $nama_kelas)->first();
        $ruang_kelas_id = $jadwal->kelas->ruang_kelas_id ?? ($ruang_kelas ? $ruang_kelas->id : null);

        // Simpan Absensi Siswa
        foreach ($absensi as $siswa_id => $data) {
            $siswa_obj = \App\Models\siswa::find($siswa_id);
            $kelas_id_to_save = $ruang_kelas_id ?? ($siswa_obj ? $siswa_obj->kelas_id : $jadwal->kelas_id);

            \App\Models\absensi_siswa::updateOrCreate(
                [
                    'jadwal_pelajaran_id' => $jadwal_id,
                    'siswa_id' => $siswa_id,
                    'tanggal' => $tanggal
                ],
                [
                    'kelas_id' => $kelas_id_to_save,
                    'guru_id' => $guru_id,
                    'status' => $data['status'] ?? 'h',
                    'keterangan' => $data['keterangan'] ?? null
                ]
            );
        }

        $info_status = '';
        if (!$absen_guru) {
            if ($tanggal === date('Y-m-d')) {
                $jam_masuk = $sekarang->format('H:i:s');
                $status_guru = ($jam_masuk <= $jam_batas->format('H:i:s')) ? 'tepat_waktu' : 'terlambat';
            } else if ($tanggal < date('Y-m-d')) {
                // Input susulan setelah hari H dianggap terlambat
                $status_guru = 'terlambat';
                $jam_masuk = $jam_batas->copy()->addMinutes(15)->format('H:i:s');
            } else {
                $status_guru = 'tepat_waktu';
                $jam_masuk = $jam_mulai->format('H:i:s');
            }

            $absen_baru = \App\Models\absensi_mengajar_guru::create([
                'jadwal_pelajaran_id' => $jadwal_id,
                'guru_id' => $guru_id,
                'tanggal' => $tanggal,
                'jam_masuk' => $jam_masuk,
                'status' => $status_guru,
                'materi' => $materi,
                'catatan' => $catatan
            ]);

            $status_badge = ($status_guru === 'tepat_waktu') ? 'Tepat Waktu' : 'Terlambat';
            $info_status = "Presensi kehadiran & jurnal materi Anda berhasil dicatat sebagai {$status_badge} (Masuk pukul " . substr($jam_masuk, 0, 5) . " WIB, batas toleransi " . $jam_batas->format('H:i') . " WIB).";
        } else {
            $absen_guru->update([
                'materi' => $materi,
                'catatan' => $catatan
            ]);
            $status_badge = ($absen_guru->status === 'tepat_waktu') ? 'Tepat Waktu' : 'Terlambat';
            $info_status = "Presensi siswa & jurnal materi diperbarui. Waktu masuk guru tetap tercatat {$status_badge} (Pukul " . substr($absen_guru->jam_masuk, 0, 5) . " WIB).";
        }

        return redirect()->back()->with('success', 'Data absensi mapel berhasil disimpan! ' . $info_status);
    }

    function profilGuru(){
        $check = $this->guardRoles(['g']);
        if ($check) return $check;

        $guru_id = session('id');
        $guru = \App\Models\guru::with(['getCabang', 'getSekolah'])->find($guru_id);
        $wallas = \App\Models\wallas::with('ruangKelas')->where('guru_id', $guru_id)->first();
        $total_jadwal = \App\Models\jadwal_pelajaran::where('guru_id', $guru_id)->count();
        return view("/modul/siakad/guru/profilGuru", compact('guru', 'wallas', 'total_jadwal'));
    }

    function slipPembayaranGuru(){
        $check = $this->guardRoles(['g']);
        if ($check) return $check;

        $guru_id = session('id');
        $guru = \App\Models\guru::with(['getCabang', 'getSekolah'])->find($guru_id);
        $wallas = \App\Models\wallas::with('ruangKelas')->where('guru_id', $guru_id)->first();
        
        // Ambil riwayat kehadiran mengajar guru untuk rekapitulasi jam mengajar
        $riwayat_absen = \App\Models\absensi_mengajar_guru::with(['jadwal.mata_pelajaran', 'jadwal.kelas', 'jadwal.jam_pelajaran'])
            ->where('guru_id', $guru_id)
            ->orderByDesc('tanggal')
            ->get();

        $rekap_bulanan = $riwayat_absen->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->tanggal)->format('Y-m');
        })->map(function($items, $ym) {
            $carbon = \Carbon\Carbon::createFromFormat('Y-m', $ym)->locale('id');
            return [
                'periode_kode' => $ym,
                'label_bulan' => $carbon->isoFormat('MMMM Y'),
                'periode_nama' => $carbon->isoFormat('MMMM Y'),
                'tanggal_terbit' => $carbon->endOfMonth()->isoFormat('D MMM Y'),
                'total_sesi' => $items->count(),
                'tepat_waktu' => $items->where('status', 'tepat_waktu')->count(),
                'terlambat' => $items->where('status', 'terlambat')->count(),
                'items' => $items
            ];
        })->values();

        $total_jadwal_mingguan = \App\Models\jadwal_pelajaran::where('guru_id', $guru_id)->count();

        return view("/modul/siakad/guru/slipPembayaran", compact('guru', 'wallas', 'riwayat_absen', 'rekap_bulanan', 'total_jadwal_mingguan'));
    }
    function tampilanPembayaranPemeliharaan(){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

       return view("/modul/siakad/admin/pemeliharaan");
       
    }

    function tambahTagihan_Siswa(Request $request){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        if ($request->jenis_pembayaran == "ipp"){
            $data_awal_bulan = Carbon::parse($request->tanggal_mulai)->startOfMonth();
            $data_akhir_bulan = Carbon::parse($request->tanggal_akhir)->startOfMonth();
            while ($data_awal_bulan->lte($data_akhir_bulan)){
                slip_pembayaran_ipp::create([
                    "nominal" => $request->nominal,
                    "tanggal_awal" => $data_awal_bulan,
                    "siswa_id" => $request->siswa_id
                ]);

                $data_awal_bulan->addMonth();
            }
        }elseif ($request->jenis_pembayaran == "pangkal"){
            slip_pembayaran_pangkal::create([
                "nominal" => $request->nominal,
                "siswa_id" => $request->siswa_id
            ]);
        }else{
            slip_pembayaran_pendidikan::create([
                "nominal" => $request->nominal,
                "siswa_id" => $request->siswa_id
            ]);
        }
        return back()->with("success","berhasil buat tagihan");
    }

    function tampilanPembayaranIpp_siswa(){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $data_slip_ipp = slip_pembayaran_ipp::paginate(6)->onEachSide(1);
        $data_kelas = ruang_kelas::all();
        $jumlah_total_bayar_lunas = slip_pembayaran_ipp::where("status",true)->sum("jumlah_dibayar");
        return view ('/modul/siakad/admin/pembayaran',[
            "data_slip_ipp" => $data_slip_ipp,
            "data_ruang_kelas" => $data_kelas,
            "total_bayar_lunas" => $jumlah_total_bayar_lunas
        ]);
    }

    function tampilanPembayaranPangkal(){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $data_slip_pangkal = slip_pembayaran_pangkal::paginate(6)->onEachSide(1);
        $data_kelas = ruang_kelas::all();
        $target_pangkal_belum_lunas = slip_pembayaran_pangkal::sum("nominal");
        $total_lunas_pangkal = slip_pembayaran_pangkal::sum("jumlah_di_bayar");
        $total_target_pangkal = $target_pangkal_belum_lunas  - $total_lunas_pangkal;
        $total_siswa_lunas = slip_pembayaran_pangkal::where("status",true)->count();
        $total_siswa_belum_lunas = slip_pembayaran_pangkal::where("status",false)->count();
        return view ('/modul/siakad/admin/pangkal',compact('data_slip_pangkal','data_kelas',"total_target_pangkal","total_lunas_pangkal","total_siswa_lunas","total_siswa_belum_lunas"));  
    }

    function tampilanPembayaranPendidikan(){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;
        $data_slip_pendidikan = slip_pembayaran_pendidikan::paginate(6)->onEachSide(1);
        $data_kelas = ruang_kelas::all();
        $target_pendidikan_belum_lunas = slip_pembayaran_pendidikan::sum("nominal");
        $total_lunas_pendidikan = slip_pembayaran_pendidikan::sum("jumlah_di_bayar");
        $total_target_pendidikan = $target_pendidikan_belum_lunas  - $total_lunas_pendidikan;
        $total_siswa_lunas = slip_pembayaran_pendidikan::where("status",true)->count();
        $total_siswa_belum_lunas = slip_pembayaran_pendidikan::where("status",false)->count();
        return view("/modul/siakad/admin/pendidikan",compact("data_slip_pendidikan","data_kelas","total_lunas_pendidikan","total_target_pendidikan","total_siswa_lunas","total_siswa_belum_lunas"));
       
    }

    function edit_slipPembayaranIpp(Request $request)
    {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $id = $request->id ?? $request->id_siswa;
        $data_slip = slip_pembayaran_ipp::find($id);
        if (!$data_slip) {
            return back()->with('error', 'Data slip pembayaran IPP tidak ditemukan.');
        }
        if ($request->filled('tanggal_awal')) {
            $data_slip->tanggal_awal = Carbon::parse($request->tanggal_awal)->translatedFormat("Y-m-d");
        }
        if ($request->filled('nominal')) {
            $data_slip->nominal = (float) $request->nominal;
        }
        if ($request->filled('bayar')) {
            $data_slip->jumlah_dibayar += (float) $request->bayar;
        }

        $nominal = (float) $data_slip->nominal;
        $dibayar = (float) $data_slip->jumlah_dibayar;

        if ($request->has('status') && $request->status !== null && $request->status !== '') {
            $data_slip->status = (strtolower($request->status) === 'lunas' || $request->status === '1' || $request->status === true);
        } else {
            $data_slip->status = ($dibayar >= $nominal && $nominal > 0);
        }

        $data_slip->save();
        return back()->with('success','berhasil edit pembayaran');
    }


    function edit_slipPembayaranPangkal(Request $request){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $id = $request->id ?? $request->id_siswa;
        $data_slip = slip_pembayaran_pangkal::find($id);
        if (!$data_slip) {
            return back()->with('error', 'Data slip pembayaran uang pangkal tidak ditemukan.');
        }
        if ($request->filled('nominal')) {
            $data_slip->nominal = (float) $request->nominal;
        }
        if ($request->filled('bayar')) {
            $data_slip->jumlah_di_bayar += (float) $request->bayar;
        }

        $nominal = (float) $data_slip->nominal;
        $dibayar = (float) $data_slip->jumlah_di_bayar;

        if ($request->has('status') && $request->status !== null && $request->status !== '') {
            $data_slip->status = (strtolower($request->status) === 'lunas' || $request->status === '1' || $request->status === true);
        } else {
            $data_slip->status = ($dibayar >= $nominal && $nominal > 0);
        }

        $data_slip->save();
        return back()->with("success","berhasil edit pembayaran");
    }

    function edit_slipPembayaranPendidikan(Request $request){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $id = $request->id ?? $request->id_siswa;
        $data_slip = slip_pembayaran_pendidikan::find($id);
        if (!$data_slip) {
            return back()->with('error', 'Data slip pembayaran dana pendidikan tidak ditemukan.');
        }
        if ($request->filled('nominal')) {
            $data_slip->nominal = (float) $request->nominal;
        }
        if ($request->filled('bayar')) {
            $data_slip->jumlah_di_bayar += (float) $request->bayar;
        }

        $nominal = (float) $data_slip->nominal;
        $dibayar = (float) $data_slip->jumlah_di_bayar;

        if ($request->has('status') && $request->status !== null && $request->status !== '') {
            $data_slip->status = (strtolower($request->status) === 'lunas' || $request->status === '1' || $request->status === true);
        } else {
            $data_slip->status = ($dibayar >= $nominal && $nominal > 0);
        }

        $data_slip->save();
        return back()->with("success","berhasil edit pembayaran");
    }

    function publish_slipPembayaran(Request $request){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $data_siswa = siswa::where('id',$request->id_siswa)->first();
        if (!$data_siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }
        $data_akun = akun::where("id",$data_siswa->user_id)->first();

        $pesan = "";

        if ($request->pembayaran == "pendidikan"){
            $pesan = "pembayaran pendidikan anda sudah lunas cek web anda untuk melihat update pembayaran";
        }elseif ($request->pembayaran == "pangkal"){
            $pesan = "pembayaran pangkal anda sudah lunas cek web anda untuk melihat update pembayaran";
        }else{
            $pesan = "pembayaran spp anda sudah lunas cek web anda untuk melihat update pembayaran";
        }

        try {
            $data_fonte = new FonteService();
            if ($data_akun && $data_akun->noWa) {
                $data_fonte->sendMassage($data_akun->noWa,$pesan);
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning("Gagal kirim notifikasi WA publish: " . $e->getMessage());
        }
        return back()->with("success","tagihan berhasil di publish");
    }

    function hapus_SlipPembayaran(Request $request){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;
        $data_slipPembayaran = null;

        if ($request->pembayaran == "pendidikan"){
            $data_slipPembayaran = slip_pembayaran_pendidikan::where("id",$request->id)->first();
        }elseif ($request->pembayaran == "pangkal"){
            $data_slipPembayaran = slip_pembayaran_pangkal::where("id",$request->id)->first();
        }else{
            $data_slipPembayaran = slip_pembayaran_ipp::where("id",$request->id)->first();
        }

        if (!$data_slipPembayaran) {
            return back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        $data_slipPembayaran->delete();

        return back()->with("success","pembayaran berhasil dihapus");
    }

    function tampian_daftarSiswa(Request $request){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $sekolah_id = $request->query('sekolah_id');
        $query = siswa::with(['kelas', 'sekolah']);
        if ($sekolah_id) {
            $query->where('sekolah_id', $sekolah_id);
        }
        $data_siswa = $query->get();
        $data_sekolah = \App\Models\jenis_sekolah::all();
        return view ('/modul/siakad/admin/daftar_siswa',compact("data_siswa", "data_sekolah", "sekolah_id"));
    }

    function tampilan_detailSiswa($id){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $data_siswa = siswa::with(['kelas', 'sekolah', 'tahunAjaran'])->find($id);
        if (!$data_siswa) {
            return redirect('/sk/ds')->with('error', 'Data siswa tidak ditemukan.');
        }
        $data_kelas = $data_siswa->kelas;
        return view ('/modul/siakad/admin/detailSiswa',compact("data_siswa","data_kelas"));
    }

    function simpan_kelas(Request $request){
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate([
            'tingkat_sekolah' => 'required',
            'no_kelas' => 'required',
            'tipe_kelas' => 'required'
        ]);

        $nama_ruang = $request->tingkat_sekolah . ' Kelas ' . $request->no_kelas . ' ' . $request->tipe_kelas;

        // Check for duplicates
        $exists = \App\Models\ruang_kelas::where('nama_ruang', $nama_ruang)->exists();
        $exists2 = \App\Models\kelas::where('nama_kelas', $nama_ruang)->exists();
        if ($exists || $exists2) {
            return back()->with('error', 'Kelas dengan nama tersebut sudah ada.');
        }

        if (!$exists) {
            \App\Models\ruang_kelas::create([
                'nama_ruang' => $nama_ruang
            ]);
        }
        if (!$exists2) {
            \App\Models\kelas::create([
                'nama_kelas' => $nama_ruang
            ]);
        }

        return back()->with('success', 'Ruang kelas berhasil ditambahkan.');
    }

    function editKelas($id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $kelas = \App\Models\kelas::findOrFail($id);
        return view('/modul/siakad/admin/editKelas', compact('kelas'));
    }

    function updateKelas(Request $request, $id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate(['nama_kelas' => 'required']);
        
        $kelas = \App\Models\kelas::findOrFail($id);
        $nama_lama = $kelas->nama_kelas;
        $nama_baru = $request->nama_kelas;
        
        // Sinkronisasi pembaruan ke tabel ruang_kelas jika ada
        \App\Models\ruang_kelas::where('nama_ruang', $nama_lama)->update(['nama_ruang' => $nama_baru]);
        
        $kelas->update(['nama_kelas' => $nama_baru]);
        
        return redirect('/sk/tk')->with('success', 'Nama kelas berhasil diperbarui.');
    }

    function hapusKelas($id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $kelas = \App\Models\kelas::findOrFail($id);
        $nama_ruang = $kelas->nama_kelas;

        $ruang = \App\Models\ruang_kelas::where('nama_ruang', $nama_ruang)->first();
        $ruang_id = $ruang ? $ruang->id : $kelas->id;

        $adaSiswa = \App\Models\siswa::where('kelas_id', $ruang_id)->orWhere('kelas_id', $kelas->id)->exists();
        if ($adaSiswa) {
            return back()->with('error', 'Tidak dapat menghapus kelas karena masih ada siswa yang terdaftar di kelas ini.');
        }

        $adaJadwal = \App\Models\jadwal_pelajaran::where('kelas_id', $kelas->id)->exists();
        if ($adaJadwal) {
            return back()->with('error', 'Tidak dapat menghapus kelas karena masih terdapat jadwal pelajaran aktif.');
        }

        \App\Models\ruang_kelas::where('nama_ruang', $nama_ruang)->delete();
        $kelas->delete();
        return back()->with('success', 'Ruang kelas berhasil dihapus.');
    }

    function jadwalMengajarGuru(Request $request) {
        $check = $this->guardRoles(['g']);
        if ($check) return $check;

        $guru_id = session('id'); 
        $guru = \App\Models\guru::find($guru_id);
        $isWallas = \App\Models\wallas::where('guru_id', $guru_id)->exists();
        $isPengajar = $isWallas || ($guru && ($guru->guru_tetap || $guru->guru_honor)) || \App\Models\jadwal_pelajaran::where('guru_id', $guru_id)->exists();
        if (!$isPengajar) {
            return redirect('/sk/dsg')->with('error', 'Status Anda pada modul guru bukan sebagai Guru Pengajar.');
        }

        $jadwal = \App\Models\jadwal_pelajaran::with(['kelas', 'mata_pelajaran', 'jam_pelajaran'])
            ->where('guru_id', $guru_id)
            ->orderBy('hari')
            ->get();
        return view('/modul/siakad/guru/jadwalMengajar', compact('jadwal'));
    }

    function inputNilaiGuru(Request $request) {
        $check = $this->guardRoles(['g']);
        if ($check) return $check;

        $guru_id = session('id');
        $guru = \App\Models\guru::find($guru_id);
        $isWallas = \App\Models\wallas::where('guru_id', $guru_id)->exists();
        $isPengajar = $isWallas || ($guru && ($guru->guru_tetap || $guru->guru_honor)) || \App\Models\jadwal_pelajaran::where('guru_id', $guru_id)->exists();
        if (!$isPengajar) {
            return redirect('/sk/dsg')->with('error', 'Status Anda pada modul guru bukan sebagai Guru Pengajar.');
        }

        $mapel_guru = \App\Models\jadwal_pelajaran::with(['kelas', 'mata_pelajaran', 'jam_pelajaran', 'tahun_ajaran'])
            ->where('guru_id', $guru_id)
            ->get();
        return view('/modul/siakad/guru/inputNilai', compact('mapel_guru'));
    }

    function dataWaliKelas(Request $request) {
        $check = $this->guardRoles(['g']);
        if ($check) return $check;

        $guru_id = session('id');
        $wallas = \App\Models\wallas::with(['guru', 'ruangKelas'])->where('guru_id', $guru_id)->first();
        
        if (!$wallas) {
            return redirect('/sk/dsg')->with('eror', 'Anda bukan wali kelas.');
        }
        $siswa = collect();
        $jadwal_mingguan = collect();
        $jadwal_hari_ini = collect();
        $absensi_mengajar_hari_ini = collect();
        $hari_ini_indonesia = ucfirst(now()->locale('id')->isoFormat('dddd, D MMMM Y'));
        $absensi_siswa_hari_ini = collect();
        
        if ($wallas && $wallas->ruangKelas) {
            $siswa = \App\Models\siswa::where('kelas_id', $wallas->kelas_id)->get();
            // Sinkronisasi kelas dan ruang_kelas berdasarkan nama
            $kelas = \App\Models\kelas::where('nama_kelas', $wallas->ruangKelas->nama_ruang)->first();
            $kelas_id_jadwal = $kelas ? $kelas->id : $wallas->kelas_id;

            $jadwal_semua = \App\Models\jadwal_pelajaran::with(['guru', 'mata_pelajaran', 'jam_pelajaran'])
                ->where('kelas_id', $kelas_id_jadwal)
                ->get();

            $jadwal_mingguan = $jadwal_semua
                ->sortBy(function($j) {
                    return $j->jam_pelajaran->jam_mulai ?? '00:00';
                })
                ->groupBy('hari');

            // Jadwal Pelajaran Kelas Binaan Hari Ini
            $hari_ini = strtolower(now()->locale('id')->isoFormat('dddd'));
            $jadwal_hari_ini = $jadwal_semua->where('hari', $hari_ini)->sortBy(function($j) {
                return $j->jam_pelajaran->jam_mulai ?? '00:00';
            });

            if ($jadwal_hari_ini->isNotEmpty()) {
                $absensi_mengajar_hari_ini = \App\Models\absensi_mengajar_guru::whereIn('jadwal_pelajaran_id', $jadwal_hari_ini->pluck('id'))
                    ->where('tanggal', date('Y-m-d'))
                    ->get()
                    ->keyBy('jadwal_pelajaran_id');

                $absensi_siswa_hari_ini = \App\Models\absensi_siswa::whereIn('jadwal_pelajaran_id', $jadwal_hari_ini->pluck('id'))
                    ->where('tanggal', date('Y-m-d'))
                    ->get()
                    ->groupBy('jadwal_pelajaran_id');
            }
        }
        return view('/modul/siakad/guru/dataWaliKelas', compact(
            'wallas', 'siswa', 'jadwal_mingguan', 'jadwal_hari_ini', 'absensi_mengajar_hari_ini', 'hari_ini_indonesia', 'absensi_siswa_hari_ini'
        ));
    }

    public function absensiWalas(Request $request) {
        $check = $this->guardRoles(['g']);
        if ($check) return $check;

        $guru_id = session('id');
        $wallas = \App\Models\wallas::with('ruangKelas')->where('guru_id', $guru_id)->first();
        if (!$wallas) {
            return redirect()->back()->with('error', 'Anda bukan Wali Kelas.');
        }

        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $tab = $request->input('tab', 'harian');
        $carbonTanggal = \Carbon\Carbon::parse($tanggal)->locale('id');
        $hari_terpilih = strtolower($carbonTanggal->isoFormat('dddd'));
        $hari_indonesia = ucfirst($carbonTanggal->isoFormat('dddd, D MMMM Y'));

        $siswa = \App\Models\siswa::where('kelas_id', $wallas->kelas_id)->orderBy('nama')->get();
        
        // Sinkronisasi ID ruang_kelas dan kelas untuk query jadwal
        $kelas_id_absensi = $wallas->kelas_id;
        $nama_kelas = $wallas->ruangKelas->nama_ruang ?? '';
        $kelas = \App\Models\kelas::where('nama_kelas', $nama_kelas)->first();
        $kelas_id_jadwal = $kelas ? $kelas->id : $wallas->kelas_id;
        $kelas_ids_query = array_unique(array_filter([$kelas_id_absensi, $kelas ? $kelas->id : null]));

        // 1. Ambil Jadwal Pelajaran kelas ini pada hari yang dipilih
        $jadwal_hari_ini = \App\Models\jadwal_pelajaran::with(['mata_pelajaran', 'guru', 'jam_pelajaran'])
            ->where('kelas_id', $kelas_id_jadwal)
            ->where('hari', $hari_terpilih)
            ->get()
            ->sortBy(function($j) {
                return $j->jam_pelajaran->jam_mulai ?? '00:00';
            })
            ->values();

        // 2. Ambil Rekam Presensi Masuk & Jurnal Mengajar Guru Mapel pada tanggal tersebut
        $absensi_guru_hari_ini = \App\Models\absensi_mengajar_guru::whereIn('jadwal_pelajaran_id', $jadwal_hari_ini->pluck('id'))
            ->where('tanggal', $tanggal)
            ->get()
            ->keyBy('jadwal_pelajaran_id');

        // 3. Ambil Data Presensi Siswa dari Guru Pengajar (per mapel) pada tanggal tersebut
        $absensi_mapel_siswa = \App\Models\absensi_siswa::whereIn('jadwal_pelajaran_id', $jadwal_hari_ini->pluck('id'))
            ->where('tanggal', $tanggal)
            ->get()
            ->groupBy('siswa_id');

        // 4. Ambil Absensi Harian Wali Kelas yang sudah pernah diverifikasi/disimpan manual (jadwal_pelajaran_id = null)
        $absensi_walas_db = \App\Models\absensi_siswa::whereIn('kelas_id', $kelas_ids_query)
            ->whereNull('jadwal_pelajaran_id')
            ->whereDate('tanggal', $tanggal)
            ->get()
            ->keyBy('siswa_id');

        // 5. Konsolidasi Kehadiran Otomatis Siswa Hari Ini
        $konsolidasi_siswa = [];
        $total_hadir = 0;
        $total_sakit = 0;
        $total_izin = 0;
        $total_alpa = 0;
        $total_belum = 0;

        foreach ($siswa as $s) {
            $catatan_mapel = $absensi_mapel_siswa->get($s->id, collect());
            $absen_walas = $absensi_walas_db->get($s->id);

            $status_terpilih = 'h';
            $sumber = 'belum';
            $keterangan_default = '';

            $catatan_khusus = $catatan_mapel->first(function($c) {
                return !empty($c->keterangan);
            });
            $ket_teks = $catatan_khusus ? $catatan_khusus->keterangan : '';

            if ($catatan_mapel->isNotEmpty()) {
                $sumber = 'mapel';
                if ($catatan_mapel->contains('status', 's')) {
                    $status_terpilih = 's';
                    $keterangan_default = $ket_teks ?: 'Sakit';
                } elseif ($catatan_mapel->contains('status', 'i')) {
                    $status_terpilih = 'i';
                    $keterangan_default = $ket_teks ?: 'Izin';
                } elseif ($catatan_mapel->contains('status', 'a')) {
                    $status_terpilih = 'a';
                    $keterangan_default = $ket_teks ?: 'Alpa';
                } else {
                    $status_terpilih = 'h';
                    $keterangan_default = $ket_teks ?: '';
                }
            } elseif ($absen_walas) {
                $status_terpilih = $absen_walas->status;
                $sumber = 'mapel';
                $keterangan_default = $absen_walas->keterangan ?? '';
            } else {
                $status_terpilih = 'h';
                $sumber = 'belum';
                $keterangan_default = '';
            }

            // Hitung ringkasan
            if ($sumber === 'belum') {
                $total_belum++;
            } else {
                if ($status_terpilih === 'h') $total_hadir++;
                elseif ($status_terpilih === 's') $total_sakit++;
                elseif ($status_terpilih === 'i') $total_izin++;
                elseif ($status_terpilih === 'a') $total_alpa++;
            }

            // Detail per mapel hari ini untuk siswa ini
            $mapel_info = [];
            foreach ($jadwal_hari_ini as $j) {
                $rec = $catatan_mapel->where('jadwal_pelajaran_id', $j->id)->first();
                $guru_absen = $absensi_guru_hari_ini->get($j->id);
                $mapel_info[] = [
                    'mapel' => $j->mata_pelajaran->nama_mapel ?? 'Mapel',
                    'guru' => $j->guru->nama ?? 'Guru',
                    'jam' => $j->jam_pelajaran ? substr($j->jam_pelajaran->jam_mulai, 0, 5) . '-' . substr($j->jam_pelajaran->jam_selesai, 0, 5) : '',
                    'guru_hadir' => $guru_absen ? true : false,
                    'status_siswa' => $rec ? $rec->status : ($guru_absen ? 'a' : 'belum'),
                    'keterangan_guru' => $rec->keterangan ?? ($guru_absen ? '' : 'Belum diabsen')
                ];
            }

            $konsolidasi_siswa[$s->id] = [
                'status' => $status_terpilih,
                'sumber' => $sumber,
                'keterangan' => $keterangan_default,
                'mapel_info' => $mapel_info,
                'total_mapel_hadir' => $catatan_mapel->where('status', 'h')->count(),
                'total_mapel_sesi' => $catatan_mapel->count()
            ];
        }

        $rekap = [
            'total' => $siswa->count(),
            'hadir' => $total_hadir,
            'sakit' => $total_sakit,
            'izin'  => $total_izin,
            'alpa'  => $total_alpa,
            'belum' => $total_belum,
            'total_sesi' => $jadwal_hari_ini->count(),
            'sesi_diabsen' => $absensi_guru_hari_ini->count()
        ];

        // 6. Rekap Akumulasi Absensi Kelas (Seluruh Hari Efektif) - Mengintegrasikan Otomatis Data Mapel & Data Walas
        $semua_absensi_siswa = \App\Models\absensi_siswa::whereIn('kelas_id', $kelas_ids_query)->get();
        $semua_tanggal_efektif = $semua_absensi_siswa->pluck('tanggal')->unique()->values();
        $total_hari_efektif = $semua_tanggal_efektif->count();

        // Rekapitulasi per siswa dihitung secara terpadu
        $rekap_akumulasi = [];
        foreach ($siswa as $s) {
            $h = 0; $skt = 0; $izn = 0; $alp = 0;
            
            // Loop setiap tanggal efektif yang ada catatan presensinya
            foreach ($semua_tanggal_efektif as $tgl) {
                $abs_tgl = $semua_absensi_siswa->where('siswa_id', $s->id)->where('tanggal', $tgl);
                if ($abs_tgl->isEmpty()) continue;

                // Prioritaskan verifikasi Walas harian jika ada (jadwal_pelajaran_id null)
                $walas_rec = $abs_tgl->whereNull('jadwal_pelajaran_id')->first();
                if ($walas_rec) {
                    $st = $walas_rec->status;
                } else {
                    // Jika walas belum verifikasi hari itu, ambil agregasi dari guru mapel
                    $mapel_recs = $abs_tgl->whereNotNull('jadwal_pelajaran_id');
                    if ($mapel_recs->contains('status', 's')) $st = 's';
                    elseif ($mapel_recs->contains('status', 'i')) $st = 'i';
                    elseif ($mapel_recs->contains('status', 'a')) $st = 'a';
                    else $st = 'h';
                }

                if ($st === 'h') $h++;
                elseif ($st === 's') $skt++;
                elseif ($st === 'i') $izn++;
                elseif ($st === 'a') $alp++;
            }

            $total_catat = $h + $skt + $izn + $alp;
            $persen = $total_catat > 0 ? round(($h / $total_catat) * 100) : 0;

            $rekap_akumulasi[$s->id] = [
                'hadir' => $h,
                'sakit' => $skt,
                'izin' => $izn,
                'alpa' => $alp,
                'total' => $total_catat,
                'persentase' => $persen
            ];
        }

        return view('modul.siakad.guru.absensisiswa', compact(
            'wallas', 'siswa', 'tanggal', 'hari_indonesia', 'jadwal_hari_ini',
            'absensi_guru_hari_ini', 'konsolidasi_siswa', 'rekap', 'rekap_akumulasi', 
            'total_hari_efektif', 'tab'
        ));
    }

    public function simpanAbsensiWalas(Request $request) {
        $check = $this->guardRoles(['g']);
        if ($check) return $check;

        $guru_id = session('id');
        $wallas = \App\Models\wallas::with('ruangKelas')->where('guru_id', $guru_id)->first();
        if (!$wallas) return redirect()->back();

        $tanggal = $request->input('tanggal');
        $status_absen = $request->input('status', []); // array siswa_id => status
        $keterangan = $request->input('keterangan', []); // array siswa_id => keterangan

        // Sinkronisasi dengan tabel ruang_kelas (foreign key absensi_siswa.kelas_id -> ruang_kelas.id)
        $kelas_id_absensi = $wallas->kelas_id;

        foreach ($status_absen as $siswa_id => $status) {
            \App\Models\absensi_siswa::updateOrCreate(
                [
                    'tanggal' => $tanggal,
                    'siswa_id' => $siswa_id,
                    'kelas_id' => $kelas_id_absensi,
                    'jadwal_pelajaran_id' => null
                ],
                [
                    'status' => $status,
                    'keterangan' => $keterangan[$siswa_id] ?? null,
                    'guru_id' => $guru_id
                ]
            );
        }

        return redirect()->back()->with('success', 'Absensi harian kelas berhasil disimpan!');
    }

    public function raporWalas(Request $request) {
        $check = $this->guardRoles(['g']);
        if ($check) return $check;

        $guru_id = session('id');
        $wallas = \App\Models\wallas::with(['ruangKelas', 'guru'])->where('guru_id', $guru_id)->first();
        if (!$wallas) {
            return redirect()->back()->with('error', 'Anda bukan Wali Kelas.');
        }

        $siswa = \App\Models\siswa::where('kelas_id', $wallas->kelas_id)->orderBy('nama')->get();
        $total_siswa = $siswa->count();

        // Sinkronisasi kelas dengan tabel kelas untuk jadwal pelajaran
        $nama_kelas = $wallas->ruangKelas->nama_ruang ?? '';
        $kelas = \App\Models\kelas::where('nama_kelas', $nama_kelas)->first();
        $kelas_id_jadwal = $kelas ? $kelas->id : $wallas->kelas_id;

        $jadwal_kelas = \App\Models\jadwal_pelajaran::with(['mata_pelajaran', 'guru', 'jam_pelajaran', 'tahun_ajaran'])
            ->where('kelas_id', $kelas_id_jadwal)
            ->get();

        // Daftar mata pelajaran unik di kelas perwalian ini
        $daftar_jadwal_mapel = $jadwal_kelas->unique('mapel_id')->values();

        $jenis_penilaian = \App\Models\jenis_penilaian::all();
        if ($jenis_penilaian->isEmpty()) {
            \App\Models\jenis_penilaian::insert([
                ['nama_jenis' => 'Tugas', 'bobot' => 20],
                ['nama_jenis' => 'Ulangan Harian', 'bobot' => 30],
                ['nama_jenis' => 'UTS', 'bobot' => 20],
                ['nama_jenis' => 'UAS', 'bobot' => 30]
            ]);
            $jenis_penilaian = \App\Models\jenis_penilaian::all();
        }
        $jumlah_komponen = $jenis_penilaian->count();

        // Ambil seluruh nilai siswa di kelas ini
        $nilai_db = \App\Models\nilai::with(['mata_pelajaran', 'jenis_penilaian'])
            ->whereIn('siswa_id', $siswa->pluck('id'))
            ->get();

        // Kelompokkan nilai: $map_nilai[siswa_id][mapel_id][jenis_penilaian_id] = nilai
        $map_nilai = [];
        foreach ($nilai_db as $n) {
            $map_nilai[$n->siswa_id][$n->mapel_id][$n->jenis_penilaian_id] = $n->nilai;
        }

        // 1. Rekap Per Mata Pelajaran (Untuk Manajemen Nilai Pengajar oleh Walas)
        $rekap_mapel = collect();
        foreach ($daftar_jadwal_mapel as $j) {
            $mapel_id = $j->mapel_id;
            $kkm = $j->mata_pelajaran->kkm ?? 75;
            $siswa_dinilai = 0;
            $siswa_lengkap = 0;
            $siswa_tuntas = 0;
            $siswa_remedi = 0;
            $total_na_mapel = 0;

            foreach ($siswa as $s) {
                $komponen_siswa = $map_nilai[$s->id][$mapel_id] ?? [];
                if (count($komponen_siswa) > 0) {
                    $siswa_dinilai++;
                    if (count($komponen_siswa) >= $jumlah_komponen) {
                        $siswa_lengkap++;
                    }
                    $na = 0;
                    foreach ($jenis_penilaian as $jp) {
                        $skor = $komponen_siswa[$jp->id] ?? 0;
                        $na += ($skor * ($jp->bobot / 100));
                    }
                    $total_na_mapel += $na;
                    if ($na >= $kkm) {
                        $siswa_tuntas++;
                    } else {
                        $siswa_remedi++;
                    }
                }
            }

            $rata_mapel = $siswa_dinilai > 0 ? round($total_na_mapel / $siswa_dinilai, 1) : 0;

            $rekap_mapel->push((object)[
                'jadwal_id' => $j->id,
                'mapel_id' => $mapel_id,
                'nama_mapel' => $j->mata_pelajaran->nama_mapel ?? '-',
                'kkm' => $kkm,
                'guru_nama' => $j->guru->nama ?? '-',
                'hari' => ucfirst($j->hari ?? '-'),
                'jam_mulai' => substr($j->jam_pelajaran->jam_mulai ?? '', 0, 5),
                'jam_selesai' => substr($j->jam_pelajaran->jam_selesai ?? '', 0, 5),
                'total_siswa' => $total_siswa,
                'siswa_dinilai' => $siswa_dinilai,
                'siswa_lengkap' => $siswa_lengkap,
                'siswa_tuntas' => $siswa_tuntas,
                'siswa_remedi' => $siswa_remedi,
                'rata_rata' => $rata_mapel,
                'status_input' => $siswa_dinilai === 0 ? 'belum_input' : ($siswa_lengkap >= $total_siswa && $total_siswa > 0 ? 'lengkap' : 'sebagian')
            ]);
        }

        // 2. Rekap Leger Nilai Per Siswa (Semua Mata Pelajaran)
        $leger_temp = [];
        $total_mapel_kelas = $daftar_jadwal_mapel->count();

        foreach ($siswa as $s) {
            $nilai_per_mapel = [];
            $total_nilai_siswa = 0;
            $jumlah_mapel_terisi = 0;

            foreach ($daftar_jadwal_mapel as $j) {
                $m_id = $j->mapel_id;
                $kkm = $j->mata_pelajaran->kkm ?? 75;
                $komponen_siswa = $map_nilai[$s->id][$m_id] ?? [];

                if (count($komponen_siswa) > 0) {
                    $na = 0;
                    foreach ($jenis_penilaian as $jp) {
                        $skor = $komponen_siswa[$jp->id] ?? 0;
                        $na += ($skor * ($jp->bobot / 100));
                    }
                    $na_round = round($na, 1);
                    $nilai_per_mapel[$m_id] = [
                        'ada' => true,
                        'nilai_akhir' => $na_round,
                        'tuntas' => $na_round >= $kkm,
                        'lengkap' => count($komponen_siswa) >= $jumlah_komponen
                    ];
                    $total_nilai_siswa += $na_round;
                    $jumlah_mapel_terisi++;
                } else {
                    $nilai_per_mapel[$m_id] = [
                        'ada' => false,
                        'nilai_akhir' => null,
                        'tuntas' => false,
                        'lengkap' => false
                    ];
                }
            }

            $rata_siswa = $jumlah_mapel_terisi > 0 ? round($total_nilai_siswa / $jumlah_mapel_terisi, 1) : 0;
            $predikat = '-';
            if ($jumlah_mapel_terisi > 0) {
                if ($rata_siswa >= 90) $predikat = 'A';
                elseif ($rata_siswa >= 80) $predikat = 'B';
                elseif ($rata_siswa >= 75) $predikat = 'C';
                else $predikat = 'D';
            }

            $leger_temp[] = [
                'siswa' => $s,
                'nilai_mapel' => $nilai_per_mapel,
                'total_nilai' => round($total_nilai_siswa, 1),
                'rata_rata' => $rata_siswa,
                'mapel_terisi' => $jumlah_mapel_terisi,
                'total_mapel' => $total_mapel_kelas,
                'predikat' => $predikat
            ];
        }

        // Hitung Peringkat Kelas berdasarkan rata_rata tertinggi
        $sorted_by_score = collect($leger_temp)->sortByDesc('total_nilai')->values();
        $rank_map = [];
        foreach ($sorted_by_score as $idx => $item) {
            $rank_map[$item['siswa']->id] = $item['mapel_terisi'] > 0 ? ($idx + 1) : '-';
        }

        $leger_siswa = collect($leger_temp)->map(function($item) use ($rank_map) {
            $item['peringkat'] = $rank_map[$item['siswa']->id] ?? '-';
            return (object)$item;
        });

        $stats_nilai = [
            'total_mapel' => $total_mapel_kelas,
            'mapel_sudah_input' => $rekap_mapel->where('siswa_dinilai', '>', 0)->count(),
            'mapel_lengkap' => $rekap_mapel->where('status_input', 'lengkap')->count(),
            'rata_kelas' => $rekap_mapel->where('siswa_dinilai', '>', 0)->count() > 0 
                ? round($rekap_mapel->where('siswa_dinilai', '>', 0)->avg('rata_rata'), 1) 
                : 0
        ];

        if ($request->query('tab') === 'nilai') {
            return view('modul.siakad.guru.manajemenNilaiWalas', compact(
                'wallas', 'siswa', 'rekap_mapel', 'leger_siswa', 'stats_nilai', 'jenis_penilaian'
            ));
        }

        return view('modul.siakad.guru.raporWalas', compact(
            'wallas', 'siswa', 'rekap_mapel', 'leger_siswa', 'stats_nilai'
        ));
    }

    public function detailRaporWalas(Request $request, $siswa_id) {
        $check = $this->guardRoles(['g']);
        if ($check) return $check;

        $guru_id = session('id');
        $wallas = \App\Models\wallas::with(['ruangKelas', 'guru'])->where('guru_id', $guru_id)->first();
        if (!$wallas) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $siswa = \App\Models\siswa::where('id', $siswa_id)->where('kelas_id', $wallas->kelas_id)->firstOrFail();
        $semua_siswa_kelas = \App\Models\siswa::where('kelas_id', $wallas->kelas_id)->get();
        $total_siswa_kelas = $semua_siswa_kelas->count();
        
        // Ambil Tahun Ajaran Aktif
        $tahun_aktif = \App\Models\tahun_ajaran::where('aktif', 1)->first() ?? \App\Models\tahun_ajaran::orderByDesc('id')->first();

        // Ambil sinkronisasi nama_ruang kelas dengan tabel kelas
        $nama_kelas = $wallas->ruangKelas->nama_ruang ?? '';
        $kelas_jadwal = \App\Models\kelas::where('nama_kelas', $nama_kelas)->first();
        $kelas_id_jadwal = $kelas_jadwal ? $kelas_jadwal->id : $wallas->kelas_id;

        $jadwal_kelas = collect();
        if ($kelas_id_jadwal) {
            $jadwal_kelas = \App\Models\jadwal_pelajaran::with(['mata_pelajaran', 'guru'])
                ->where('kelas_id', $kelas_id_jadwal)
                ->get()
                ->unique('mapel_id');
        }

        // Ambil Data Nilai Siswa
        $nilai_db = \App\Models\nilai::with(['mata_pelajaran', 'jenis_penilaian'])
                        ->where('siswa_id', $siswa_id)
                        ->get();

        // Rekap Nilai per Mata Pelajaran
        $rekap_nilai = [];
        // Inisialisasi dari jadwal kelas agar semua mapel kelas tampil lengkap di lembar rapor
        foreach ($jadwal_kelas as $jk) {
            if (!$jk->mata_pelajaran) continue;
            $rekap_nilai[$jk->mata_pelajaran->nama_mapel] = [
                'kkm' => $jk->mata_pelajaran->kkm ?? 75,
                'rincian' => [],
                'nilai_akhir' => 0,
                'ada_nilai' => false
            ];
        }

        foreach ($nilai_db as $n) {
            if (!$n->mata_pelajaran || !$n->jenis_penilaian) continue;
            $mapel = $n->mata_pelajaran->nama_mapel;
            if (!isset($rekap_nilai[$mapel])) {
                $rekap_nilai[$mapel] = [
                    'kkm' => $n->mata_pelajaran->kkm ?? 75,
                    'rincian' => [],
                    'nilai_akhir' => 0,
                    'ada_nilai' => false
                ];
            }
            $rekap_nilai[$mapel]['ada_nilai'] = true;
            $rekap_nilai[$mapel]['rincian'][$n->jenis_penilaian->nama_jenis] = $n->nilai;
            $bobot = $n->jenis_penilaian->bobot / 100;
            $rekap_nilai[$mapel]['nilai_akhir'] += ($n->nilai * $bobot);
        }

        $total_nilai_akhir = 0;
        $mapel_dinilai = 0;
        foreach ($rekap_nilai as $m => $d) {
            if (!empty($d['ada_nilai'])) {
                $total_nilai_akhir += $d['nilai_akhir'];
                $mapel_dinilai++;
            }
        }
        $rata_rata_rapor = $mapel_dinilai > 0 ? round($total_nilai_akhir / $mapel_dinilai, 1) : 0;


        // Ambil Rekap Absensi Harian Kelas (jadwal_pelajaran_id = null)
        $absensi = \App\Models\absensi_siswa::where('siswa_id', $siswa_id)
            ->whereNull('jadwal_pelajaran_id')
            ->get();
        if ($absensi->isEmpty()) {
            $absensi = \App\Models\absensi_siswa::where('siswa_id', $siswa_id)->get();
        }
        $rekap_absensi = [
            'hadir' => $absensi->where('status', 'h')->count(),
            'sakit' => $absensi->where('status', 's')->count(),
            'izin'  => $absensi->where('status', 'i')->count(),
            'alpa'  => $absensi->where('status', 'a')->count(),
        ];

        return view('modul.siakad.guru.detailRaporWalas', compact(
            'siswa', 'wallas', 'rekap_nilai', 'rekap_absensi', 'rata_rata_rapor', 'total_nilai_akhir', 'total_siswa_kelas', 'tahun_aktif'
        ));
    }


    function kelolaJadwalAdmin(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $sekolah_id = $request->query('sekolah_id');
        $data_sekolah = \App\Models\jenis_sekolah::all();

        $kelas_query = \App\Models\kelas::query();
        $mapel_query = \App\Models\mata_pelajaran::query();
        $jadwal_query = \App\Models\jadwal_pelajaran::with(['kelas', 'mata_pelajaran', 'guru', 'jam_pelajaran', 'tahun_ajaran'])->orderBy('hari');

        if ($sekolah_id) {
            $jenis = \App\Models\jenis_sekolah::find($sekolah_id);
            if ($jenis) {
                $prefix = strtoupper($jenis->jenis);
                $kelas_query->where('nama_kelas', 'like', $prefix . ' %');
                $jadwal_query->whereHas('kelas', function($q) use ($prefix) {
                    $q->where('nama_kelas', 'like', $prefix . ' %');
                });
            }
            $mapel_query->where('sekolah_id', $sekolah_id);
        }

        $data_kelas = $kelas_query->get();
        $data_mapel = $mapel_query->get();
        $data_jadwal = $jadwal_query->get();
        
        $data_guru = \App\Models\guru::all();
        $data_jam = \App\Models\jam_pelajaran::orderBy('jam_mulai')->get();
        $data_tahun = \App\Models\tahun_ajaran::all();
        
        return view('/modul/siakad/admin/kelolaJadwal', compact('data_kelas', 'data_guru', 'data_mapel', 'data_jam', 'data_tahun', 'data_jadwal', 'data_sekolah', 'sekolah_id'));
    }

    function simpanJadwalAdmin(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate([
            'kelas_id' => 'required',
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'hari' => 'required',
            'jam_pelajaran_id' => 'required',
            'tahun_ajaran_id' => 'required',
        ]);

        // Validasi Bentrok Jadwal Mengajar Guru
        $bentrokGuru = \App\Models\jadwal_pelajaran::where('guru_id', $request->guru_id)
            ->where('hari', strtolower($request->hari))
            ->where('jam_pelajaran_id', $request->jam_pelajaran_id)
            ->where('tahun_ajaran_id', $request->tahun_ajaran_id)
            ->exists();
        if ($bentrokGuru) {
            return back()->with('error', 'Guru tersebut sudah memiliki jadwal mengajar di kelas lain pada hari dan sesi jam yang sama.');
        }

        // Validasi Bentrok Jadwal Kelas (Ruang Kelas tidak boleh memiliki 2 mapel bersamaan)
        $bentrokKelas = \App\Models\jadwal_pelajaran::where('kelas_id', $request->kelas_id)
            ->where('hari', strtolower($request->hari))
            ->where('jam_pelajaran_id', $request->jam_pelajaran_id)
            ->where('tahun_ajaran_id', $request->tahun_ajaran_id)
            ->exists();
        if ($bentrokKelas) {
            return back()->with('error', 'Kelas tersebut sudah terisi mata pelajaran lain pada hari dan sesi jam yang sama.');
        }

        \App\Models\jadwal_pelajaran::create([
            'kelas_id' => $request->kelas_id,
            'guru_id' => $request->guru_id,
            'mapel_id' => $request->mapel_id,
            'hari' => strtolower($request->hari),
            'jam_pelajaran_id' => $request->jam_pelajaran_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id
        ]);
        return back()->with('success', 'Jadwal pelajaran berhasil ditambahkan.');
    }

    function kelolaMapel(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $sekolah_id = $request->query('sekolah_id');
        $query = \App\Models\mata_pelajaran::query();
        if ($sekolah_id) {
            $query->where('sekolah_id', $sekolah_id);
        }
        $data_mapel = $query->get();
        $data_sekolah = \App\Models\jenis_sekolah::all();
        return view('/modul/siakad/admin/kelolaMapel', compact('data_mapel', 'data_sekolah', 'sekolah_id'));
    }

    function simpanMapel(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate(['nama_mapel' => 'required', 'sekolah_id' => 'required']);
        \App\Models\mata_pelajaran::create([
            'nama_mapel' => $request->nama_mapel,
            'sekolah_id' => $request->sekolah_id
        ]);
        return back()->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    function hapusMapel($id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        if (\App\Models\jadwal_pelajaran::where('mapel_id', $id)->exists()) {
            return back()->with('error', 'Tidak dapat menghapus mata pelajaran karena masih digunakan pada jadwal pelajaran aktif.');
        }
        if (\App\Models\nilai::where('mapel_id', $id)->exists()) {
            return back()->with('error', 'Tidak dapat menghapus mata pelajaran karena memiliki data nilai siswa.');
        }

        \App\Models\mata_pelajaran::findOrFail($id)->delete();
        return back()->with('success', 'Mata Pelajaran berhasil dihapus.');
    }

    function editMapel($id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $mapel = \App\Models\mata_pelajaran::findOrFail($id);
        $data_sekolah = \App\Models\jenis_sekolah::all();
        return view('/modul/siakad/admin/editMapel', compact('mapel', 'data_sekolah'));
    }

    function updateMapel(Request $request, $id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate(['nama_mapel' => 'required', 'sekolah_id' => 'required']);
        \App\Models\mata_pelajaran::findOrFail($id)->update([
            'nama_mapel' => $request->nama_mapel,
            'sekolah_id' => $request->sekolah_id
        ]);
        return redirect('/sk/kelola-mapel')->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    function hapusJadwal($id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        \App\Models\jadwal_pelajaran::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }

    function editJadwal($id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $jadwal = \App\Models\jadwal_pelajaran::findOrFail($id);
        $data_kelas = \App\Models\kelas::all();
        $data_guru = \App\Models\guru::all();
        $data_mapel = \App\Models\mata_pelajaran::all();
        $data_jam = \App\Models\jam_pelajaran::orderBy('jam_mulai')->get();
        $data_tahun = \App\Models\tahun_ajaran::all();
        return view('/modul/siakad/admin/editJadwal', compact('jadwal', 'data_kelas', 'data_guru', 'data_mapel', 'data_jam', 'data_tahun'));
    }

    function updateJadwal(Request $request, $id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate([
            'kelas_id' => 'required',
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'hari' => 'required',
            'jam_pelajaran_id' => 'required',
            'tahun_ajaran_id' => 'required',
        ]);

        // Validasi Bentrok Jadwal Mengajar Guru
        $bentrokGuru = \App\Models\jadwal_pelajaran::where('guru_id', $request->guru_id)
            ->where('hari', strtolower($request->hari))
            ->where('jam_pelajaran_id', $request->jam_pelajaran_id)
            ->where('tahun_ajaran_id', $request->tahun_ajaran_id)
            ->where('id', '!=', $id)
            ->exists();
        if ($bentrokGuru) {
            return back()->with('error', 'Guru tersebut sudah memiliki jadwal mengajar di kelas lain pada hari dan sesi jam yang sama.');
        }

        // Validasi Bentrok Jadwal Kelas
        $bentrokKelas = \App\Models\jadwal_pelajaran::where('kelas_id', $request->kelas_id)
            ->where('hari', strtolower($request->hari))
            ->where('jam_pelajaran_id', $request->jam_pelajaran_id)
            ->where('tahun_ajaran_id', $request->tahun_ajaran_id)
            ->where('id', '!=', $id)
            ->exists();
        if ($bentrokKelas) {
            return back()->with('error', 'Kelas tersebut sudah terisi mata pelajaran lain pada hari dan sesi jam yang sama.');
        }

        \App\Models\jadwal_pelajaran::findOrFail($id)->update([
            'kelas_id' => $request->kelas_id,
            'guru_id' => $request->guru_id,
            'mapel_id' => $request->mapel_id,
            'hari' => strtolower($request->hari),
            'jam_pelajaran_id' => $request->jam_pelajaran_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id
        ]);
        return redirect('/sk/kelola-jadwal')->with('success', 'Jadwal pelajaran berhasil diperbarui.');
    }


    // ==========================================
    // KELOLA REFERENSI AKADEMIK (Tahun & Jam)
    // ==========================================
    public function kelolaReferensi() {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $data_tahun = \App\Models\tahun_ajaran::orderBy('id', 'desc')->get();
        $data_jam = \App\Models\jam_pelajaran::orderBy('jam_mulai', 'asc')->get();
        return view('modul.siakad.admin.kelolaReferensi', compact('data_tahun', 'data_jam'));
    }

    public function simpanTahunAjaran(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date'
        ]);
        \App\Models\tahun_ajaran::create([
            'nama' => $request->nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'aktif' => $request->has('aktif') ? 1 : 0
        ]);
        return redirect()->back()->with('success', 'Tahun Ajaran baru berhasil ditambahkan.');
    }

    public function updateTahunAjaran(Request $request, $id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date'
        ]);
        \App\Models\tahun_ajaran::findOrFail($id)->update([
            'nama' => $request->nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'aktif' => $request->has('aktif') ? 1 : 0
        ]);
        return redirect()->back()->with('success', 'Tahun Ajaran berhasil diperbarui.');
    }

    public function hapusTahunAjaran($id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        if (\App\Models\jadwal_pelajaran::where('tahun_ajaran_id', $id)->exists()) {
            return back()->with('error', 'Tidak dapat menghapus tahun ajaran yang masih digunakan oleh jadwal pelajaran aktif.');
        }

        \App\Models\tahun_ajaran::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Tahun Ajaran berhasil dihapus.');
    }

    public function simpanJamPelajaran(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate([
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);
        \App\Models\jam_pelajaran::create([
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ]);
        return redirect()->back()->with('success', 'Jam Pelajaran baru berhasil ditambahkan.');
    }

    public function updateJamPelajaran(Request $request, $id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate([
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);
        \App\Models\jam_pelajaran::findOrFail($id)->update([
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ]);
        return redirect()->back()->with('success', 'Jam Pelajaran berhasil diperbarui.');
    }

    public function hapusJamPelajaran($id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        if (\App\Models\jadwal_pelajaran::where('jam_pelajaran_id', $id)->exists()) {
            return back()->with('error', 'Tidak dapat menghapus jam pelajaran yang masih digunakan oleh jadwal pelajaran aktif.');
        }

        \App\Models\jam_pelajaran::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Jam Pelajaran berhasil dihapus.');
    }

    // ==========================================
    // KELOLA WALI KELAS (ADMIN)
    // ==========================================
    public function kelolaWaliKelas(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $sekolah_id = $request->query('sekolah_id');
        
        $wallas_query = \App\Models\wallas::with(['guru', 'ruangKelas']);
        $kelas_query = \App\Models\ruang_kelas::orderBy('nama_ruang');

        if ($sekolah_id) {
            $jenis = \App\Models\jenis_sekolah::find($sekolah_id);
            if ($jenis) {
                $prefix = strtoupper($jenis->jenis);
                $kelas_query->where('nama_ruang', 'like', $prefix . ' %');
                $wallas_query->whereHas('ruangKelas', function($q) use ($prefix) {
                    $q->where('nama_ruang', 'like', $prefix . ' %');
                });
            }
        }
        
        $data_wallas = $wallas_query->get();
        $data_kelas = $kelas_query->get();
        $data_guru = \App\Models\guru::all();
        $data_sekolah = \App\Models\jenis_sekolah::all();

        return view('modul.siakad.admin.kelolaWallas', compact('data_wallas', 'data_guru', 'data_kelas', 'data_sekolah', 'sekolah_id'));
    }

    public function simpanWaliKelas(Request $request) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required'
        ]);

        // Cek apakah kelas sudah memiliki wali kelas
        if (\App\Models\wallas::where('kelas_id', $request->kelas_id)->exists()) {
            return redirect()->back()->with('error', 'Kelas tersebut sudah memiliki wali kelas.');
        }

        // Cek apakah guru sudah menjadi wali kelas di kelas lain
        if (\App\Models\wallas::where('guru_id', $request->guru_id)->exists()) {
            return redirect()->back()->with('error', 'Guru tersebut sudah ditugaskan sebagai wali kelas di kelas lain.');
        }

        \App\Models\wallas::create([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id
        ]);
        return redirect()->back()->with('success', 'Penugasan Wali Kelas berhasil ditambahkan.');
    }

    public function updateWaliKelas(Request $request, $id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required'
        ]);

        // Cek duplikasi jika kelas_id diubah ke kelas lain yang sudah ada wali kelasnya
        $cek = \App\Models\wallas::where('kelas_id', $request->kelas_id)->where('id', '!=', $id)->exists();
        if ($cek) {
            return redirect()->back()->with('error', 'Kelas tersebut sudah memiliki wali kelas.');
        }

        // Cek duplikasi guru sudah jadi walas di kelas lain
        $cekGuru = \App\Models\wallas::where('guru_id', $request->guru_id)->where('id', '!=', $id)->exists();
        if ($cekGuru) {
            return redirect()->back()->with('error', 'Guru tersebut sudah ditugaskan sebagai wali kelas di kelas lain.');
        }

        \App\Models\wallas::findOrFail($id)->update([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id
        ]);
        return redirect()->back()->with('success', 'Data Wali Kelas berhasil diperbarui.');
    }

    public function hapusWaliKelas($id) {
        $check = $this->guardRoles(['a']);
        if ($check) return $check;

        \App\Models\wallas::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Penugasan Wali Kelas berhasil dihapus.');
    }

    // ==========================================
    // MENU SISWA (PORTAL ORANG TUA & SISWA)
    // ==========================================
    public function jadwalSiswa(Request $request) {
        if (session('role') !== 's') {
            return redirect(session('role') === 'g' ? '/sk/dsg' : '/sk/das')->with('error', 'Akses khusus Siswa / Wali Murid.');
        }

        $siswa_id = session('id');
        $siswa = \App\Models\siswa::with(['kelas', 'sekolah', 'tahunAjaran'])->find($siswa_id);
        
        if (!$siswa) {
            return redirect('/sk/dbs')->with('error', 'Data siswa tidak ditemukan.');
        }

        $tab = $request->query('tab', 'jadwal');
        $wallas = $siswa->kelas_id ? \App\Models\wallas::with(['guru', 'ruangKelas'])->where('kelas_id', $siswa->kelas_id)->first() : null;

        // Sinkronisasi ruang_kelas (siswa->kelas_id) dengan tabel kelas (jadwal_pelajaran->kelas_id)
        $nama_ruang = $siswa->kelas->nama_ruang ?? '';
        $kelas_jadwal = $nama_ruang ? \App\Models\kelas::where('nama_kelas', $nama_ruang)->first() : null;
        $kelas_id_jadwal = $kelas_jadwal ? $kelas_jadwal->id : $siswa->kelas_id;

        // Ambil jadwal pelajaran berdasarkan kelas siswa
        $jadwal = collect();
        if ($kelas_id_jadwal) {
            $jadwal = \App\Models\jadwal_pelajaran::with(['mata_pelajaran', 'guru', 'jam_pelajaran', 'tahun_ajaran'])
                ->where('kelas_id', $kelas_id_jadwal)
                ->get()
                ->sortBy(function($j) {
                    return $j->jam_pelajaran->jam_mulai ?? '00:00:00';
                })
                ->values();
        }

        $jadwal_per_hari = $jadwal->groupBy(function($j) {
            return strtolower($j->hari ?? '');
        });

        // Jadwal Hari Ini & Status Kehadiran Guru Pengajar
        $hari_ini = strtolower(now()->locale('id')->isoFormat('dddd'));
        $hari_ini_label = ucfirst(now()->locale('id')->isoFormat('dddd, D MMMM Y'));
        $jadwal_hari_ini = $jadwal_per_hari->get($hari_ini, collect());

        $absensi_guru_hari_ini = collect();
        $absensi_siswa_hari_ini = collect();
        if ($jadwal_hari_ini->isNotEmpty()) {
            $absensi_guru_hari_ini = \App\Models\absensi_mengajar_guru::whereIn('jadwal_pelajaran_id', $jadwal_hari_ini->pluck('id'))
                ->whereDate('tanggal', date('Y-m-d'))
                ->get()
                ->keyBy('jadwal_pelajaran_id');

            $absensi_siswa_hari_ini = \App\Models\absensi_siswa::where('siswa_id', $siswa_id)
                ->whereIn('jadwal_pelajaran_id', $jadwal_hari_ini->pluck('id'))
                ->whereDate('tanggal', date('Y-m-d'))
                ->get()
                ->keyBy('jadwal_pelajaran_id');
        }

        // Semua data absensi siswa
        $semua_absensi = \App\Models\absensi_siswa::with(['jadwal.mata_pelajaran', 'jadwal.guru', 'jadwal.jam_pelajaran', 'guru'])
            ->where('siswa_id', $siswa_id)
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->get();

        // 1. Riwayat Absensi Harian Kelas (Wali Kelas: jadwal_pelajaran_id = null)
        $riwayat_absensi_harian = $semua_absensi->whereNull('jadwal_pelajaran_id')->values();

        // 2. Riwayat Absensi Sesi Mata Pelajaran (Guru Pengajar: jadwal_pelajaran_id != null) + Jurnal Materi
        $absensi_mapel_raw = $semua_absensi->whereNotNull('jadwal_pelajaran_id')->values();
        $jurnal_guru_map = collect();
        if ($absensi_mapel_raw->isNotEmpty()) {
            $jurnal_list = \App\Models\absensi_mengajar_guru::whereIn('jadwal_pelajaran_id', $absensi_mapel_raw->pluck('jadwal_pelajaran_id')->unique())
                ->get();
            foreach ($jurnal_list as $jg) {
                $jurnal_guru_map[$jg->jadwal_pelajaran_id . '_' . $jg->tanggal] = $jg;
            }
        }

        $riwayat_absensi_mapel = $absensi_mapel_raw->map(function($item) use ($jurnal_guru_map) {
            $jurnal = $jurnal_guru_map[$item->jadwal_pelajaran_id . '_' . $item->tanggal] ?? null;
            $item->jurnal_materi = $jurnal->materi ?? null;
            $item->jurnal_catatan = $jurnal->catatan ?? null;
            $item->jam_masuk_guru = $jurnal->jam_masuk ?? null;
            $item->status_masuk_guru = $jurnal->status ?? null;
            return $item;
        });

        // Rekap Absensi Utama (Prioritaskan Harian Wali Kelas jika ada, atau gabungan)
        $sumber_rekap = $riwayat_absensi_harian->isNotEmpty() ? $riwayat_absensi_harian : $semua_absensi;
        $total_rekap = $sumber_rekap->count();
        $hadir_rekap = $sumber_rekap->where('status', 'h')->count();
        $rekap_absen = [
            'h' => $hadir_rekap,
            'i' => $sumber_rekap->where('status', 'i')->count(),
            's' => $sumber_rekap->where('status', 's')->count(),
            'a' => $sumber_rekap->where('status', 'a')->count(),
            'total' => $total_rekap,
            'persentase' => $total_rekap > 0 ? round(($hadir_rekap / $total_rekap) * 100) : 100,
        ];

        $total_mapel_sesi = $riwayat_absensi_mapel->count();
        $hadir_mapel_sesi = $riwayat_absensi_mapel->where('status', 'h')->count();
        $rekap_absen_mapel = [
            'h' => $hadir_mapel_sesi,
            'i' => $riwayat_absensi_mapel->where('status', 'i')->count(),
            's' => $riwayat_absensi_mapel->where('status', 's')->count(),
            'a' => $riwayat_absensi_mapel->where('status', 'a')->count(),
            'total' => $total_mapel_sesi,
            'persentase' => $total_mapel_sesi > 0 ? round(($hadir_mapel_sesi / $total_mapel_sesi) * 100) : 100,
        ];

        return view('modul.siakad.siswa.jadwalSiswa', compact(
            'siswa', 'wallas', 'jadwal', 'jadwal_per_hari', 'jadwal_hari_ini', 'hari_ini_label',
            'absensi_guru_hari_ini', 'absensi_siswa_hari_ini',
            'riwayat_absensi_harian', 'riwayat_absensi_mapel',
            'rekap_absen', 'rekap_absen_mapel', 'tab'
        ));
    }

    public function raporSiswa(Request $request) {
        if (session('role') !== 's') {
            return redirect(session('role') === 'g' ? '/sk/dsg' : '/sk/das')->with('error', 'Akses khusus Siswa / Wali Murid.');
        }

        $siswa_id = session('id');
        $siswa = \App\Models\siswa::with(['kelas', 'sekolah', 'tahunAjaran'])->findOrFail($siswa_id);

        $tab = $request->query('tab', 'transkrip');

        $wallas = $siswa->kelas_id ? \App\Models\wallas::with(['guru', 'ruangKelas'])->where('kelas_id', $siswa->kelas_id)->first() : null;
        $tahun_aktif = \App\Models\tahun_ajaran::where('aktif', 1)->first() ?? \App\Models\tahun_ajaran::orderByDesc('id')->first();

        $jenis_penilaian = \App\Models\jenis_penilaian::all();
        if ($jenis_penilaian->isEmpty()) {
            \App\Models\jenis_penilaian::insert([
                ['nama_jenis' => 'Tugas', 'bobot' => 20],
                ['nama_jenis' => 'Ulangan Harian', 'bobot' => 30],
                ['nama_jenis' => 'UTS', 'bobot' => 20],
                ['nama_jenis' => 'UAS', 'bobot' => 30]
            ]);
            $jenis_penilaian = \App\Models\jenis_penilaian::all();
        }

        // Sinkronisasi kelas siswa dengan jadwal pelajaran
        $nama_ruang = $siswa->kelas->nama_ruang ?? '';
        $kelas_jadwal = $nama_ruang ? \App\Models\kelas::where('nama_kelas', $nama_ruang)->first() : null;
        $kelas_id_jadwal = $kelas_jadwal ? $kelas_jadwal->id : $siswa->kelas_id;

        $jadwal_kelas = collect();
        if ($kelas_id_jadwal) {
            $jadwal_kelas = \App\Models\jadwal_pelajaran::with(['mata_pelajaran', 'guru'])
                ->where('kelas_id', $kelas_id_jadwal)
                ->get()
                ->unique('mapel_id');
        }

        $nilai = \App\Models\nilai::with(['mata_pelajaran', 'jenis_penilaian', 'guru'])
            ->where('siswa_id', $siswa_id)
            ->get();

        $rekap_nilai = [];

        // Inisialisasi daftar mapel dari jadwal kelas agar semua mapel kelas terlihat
        foreach ($jadwal_kelas as $jk) {
            if (!$jk->mata_pelajaran) continue;
            $rekap_nilai[$jk->mapel_id] = [
                'mata_pelajaran' => $jk->mata_pelajaran,
                'guru_nama' => $jk->guru->nama ?? '-',
                'kkm' => $jk->mata_pelajaran->kkm ?? 75,
                'nilai_detail' => [],
                'ada_nilai' => false,
                'nilai_akhir' => 0,
            ];
        }

        // Masukkan nilai aktual dari tabel nilai
        foreach ($nilai as $n) {
            if (!$n->mata_pelajaran) continue;
            $mapel_id = $n->mapel_id;
            if (!isset($rekap_nilai[$mapel_id])) {
                $rekap_nilai[$mapel_id] = [
                    'mata_pelajaran' => $n->mata_pelajaran,
                    'guru_nama' => $n->guru->nama ?? '-',
                    'kkm' => $n->mata_pelajaran->kkm ?? 75,
                    'nilai_detail' => [],
                    'ada_nilai' => false,
                    'nilai_akhir' => 0,
                ];
            }
            $rekap_nilai[$mapel_id]['ada_nilai'] = true;
            $rekap_nilai[$mapel_id]['nilai_detail'][$n->jenis_penilaian_id] = $n->nilai;

            if ($n->jenis_penilaian) {
                $bobot = $n->jenis_penilaian->bobot / 100;
                $rekap_nilai[$mapel_id]['nilai_akhir'] += ($n->nilai * $bobot);
            }
        }

        // Hitung predikat, ketuntasan, dan statistik keseluruhan
        $total_nilai_akhir = 0;
        $mapel_dinilai = 0;
        $mapel_tuntas = 0;

        foreach ($rekap_nilai as $m_id => &$item) {
            $na = round($item['nilai_akhir'], 1);
            $item['nilai_akhir'] = $na;
            $kkm = $item['kkm'];
            $namaMapel = $item['mata_pelajaran']->nama_mapel ?? 'Mata Pelajaran';

            if ($item['ada_nilai']) {
                $mapel_dinilai++;
                $total_nilai_akhir += $na;
                $tuntas = $na >= $kkm;
                if ($tuntas) $mapel_tuntas++;

                $predikat = 'D';
                if ($na >= 90) $predikat = 'A';
                elseif ($na >= 80) $predikat = 'B';
                elseif ($na >= 70) $predikat = 'C';

                $item['predikat'] = $predikat;
                $item['tuntas'] = $tuntas;
                $item['deskripsi'] = $na >= 90
                    ? "Sangat baik dalam menguasai seluruh kompetensi dasar mata pelajaran {$namaMapel}."
                    : ($tuntas
                        ? "Baik dan telah mencapai ketuntasan kompetensi pada mata pelajaran {$namaMapel}."
                        : "Perlu bimbingan dan penguatan lebih lanjut pada kompetensi dasar {$namaMapel}.");
            } else {
                $item['predikat'] = '-';
                $item['tuntas'] = false;
                $item['deskripsi'] = 'Nilai belum diinput oleh Guru Pengajar.';
            }
        }
        unset($item);

        $rata_rata = $mapel_dinilai > 0 ? round($total_nilai_akhir / $mapel_dinilai, 1) : 0;
        $predikat_umum = '-';
        if ($mapel_dinilai > 0) {
            if ($rata_rata >= 90) $predikat_umum = 'A (Sangat Baik)';
            elseif ($rata_rata >= 80) $predikat_umum = 'B (Baik)';
            elseif ($rata_rata >= 75) $predikat_umum = 'C (Cukup)';
            else $predikat_umum = 'D (Perlu Bimbingan)';
        }

        $stats_akademik = [
            'total_mapel' => count($rekap_nilai),
            'mapel_dinilai' => $mapel_dinilai,
            'mapel_tuntas' => $mapel_tuntas,
            'total_nilai_akhir' => round($total_nilai_akhir, 1),
            'rata_rata' => $rata_rata,
            'predikat_umum' => $predikat_umum,
        ];

        // Ambil rekap absen harian wali kelas untuk ditampilkan di rapor
        $absensi = \App\Models\absensi_siswa::where('siswa_id', $siswa_id)
            ->whereNull('jadwal_pelajaran_id')
            ->get();
        if ($absensi->isEmpty()) {
            $absensi = \App\Models\absensi_siswa::where('siswa_id', $siswa_id)->get();
        }
        $rekap_absen = [
            'h' => $absensi->where('status', 'h')->count(),
            'i' => $absensi->where('status', 'i')->count(),
            's' => $absensi->where('status', 's')->count(),
            'a' => $absensi->where('status', 'a')->count(),
        ];

        return view('modul.siakad.siswa.raporSiswa', compact(
            'siswa', 'wallas', 'tahun_aktif', 'rekap_nilai', 'jenis_penilaian', 'rekap_absen', 'stats_akademik', 'tab'
        ));
    }
}


