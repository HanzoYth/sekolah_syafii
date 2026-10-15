<?php

namespace App\Http\Controllers;

use App\Models\absensi_mengajar_guru;
use App\Models\absensi_siswa;
use App\Models\jadwal_pelajaran;
use App\Models\jenis_penilaian;
use App\Models\jenis_sekolah;
use App\Models\kelas;
use App\Models\nilai;
use App\Models\pengumuman;
use App\Models\ruang_kelas;
use App\Models\siswa;
use App\Models\slip_pembayaran_ipp;
use App\Models\slip_pembayaran_pangkal;
use App\Models\slip_pembayaran_pendidikan;
use App\Models\tahun_ajaran;
use App\Models\wallas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class siswaController extends Controller
{
    private function getTagihanSiswa($siswa_id, $tahun_nama = '2026/2027')
    {
        $riwayat = collect();

        // 1. Tagihan IPP / SPP Bulanan
        $ipp_list = slip_pembayaran_ipp::where('siswa_id', $siswa_id)->orderByDesc('tanggal_awal')->get();
        foreach ($ipp_list as $item) {
            $tgl = $item->tanggal_awal ? Carbon::parse($item->tanggal_awal) : ($item->created_at ?? now());
            $bulanLabel = $tgl->locale('id')->isoFormat('MMMM Y');
            $nominal = (float) $item->nominal;
            $dibayar = (float) ($item->jumlah_dibayar ?? 0);
            $isLunas = (bool) $item->status || ($nominal > 0 && $dibayar >= $nominal);
            $sisa = max(0, $nominal - ($isLunas ? $nominal : $dibayar));

            $riwayat->push((object)[
                'id' => 'IPP-' . $item->id,
                'tanggal' => $tgl->locale('id')->isoFormat('D MMM Y'),
                'nama_tagihan' => 'SPP / IPP Bulan ' . $bulanLabel,
                'jenis' => 'IPP Bulanan',
                'keterangan' => $isLunas ? 'Pembayaran telah diverifikasi lunas' : ($dibayar > 0 ? 'Dicicil Rp ' . number_format($dibayar, 0, ',', '.') : 'Menunggu penyelesaian pembayaran'),
                'nominal' => $nominal,
                'dibayar' => $isLunas ? $nominal : $dibayar,
                'sisa' => $sisa,
                'status' => $isLunas ? 'lunas' : 'belum',
            ]);
        }

        // 2. Tagihan Uang Pangkal
        $pangkal_list = slip_pembayaran_pangkal::where('siswa_id', $siswa_id)->orderByDesc('id')->get();
        foreach ($pangkal_list as $item) {
            $tgl = $item->created_at ? Carbon::parse($item->created_at) : now();
            $nominal = (float) $item->nominal;
            $dibayar = (float) ($item->jumlah_di_bayar ?? 0);
            $isLunas = (bool) $item->status || ($nominal > 0 && $dibayar >= $nominal);
            $sisa = max(0, $nominal - ($isLunas ? $nominal : $dibayar));

            $riwayat->push((object)[
                'id' => 'PKL-' . $item->id,
                'tanggal' => $tgl->locale('id')->isoFormat('D MMM Y'),
                'nama_tagihan' => 'Uang Pangkal Tahun Ajaran ' . $tahun_nama,
                'jenis' => 'Uang Pangkal',
                'keterangan' => $isLunas ? 'Pembayaran uang pangkal lunas' : ($dibayar > 0 ? 'Sudah dibayar Rp ' . number_format($dibayar, 0, ',', '.') : 'Tagihan uang pangkal aktif'),
                'nominal' => $nominal,
                'dibayar' => $isLunas ? $nominal : $dibayar,
                'sisa' => $sisa,
                'status' => $isLunas ? 'lunas' : 'belum',
            ]);
        }

        // 3. Tagihan Dana Pendidikan
        $pendidikan_list = slip_pembayaran_pendidikan::where('siswa_id', $siswa_id)->orderByDesc('id')->get();
        foreach ($pendidikan_list as $item) {
            $tgl = $item->created_at ? Carbon::parse($item->created_at) : now();
            $nominal = (float) $item->nominal;
            $dibayar = (float) ($item->jumlah_di_bayar ?? 0);
            $isLunas = (bool) $item->status || ($nominal > 0 && $dibayar >= $nominal);
            $sisa = max(0, $nominal - ($isLunas ? $nominal : $dibayar));

            $riwayat->push((object)[
                'id' => 'PDD-' . $item->id,
                'tanggal' => $tgl->locale('id')->isoFormat('D MMM Y'),
                'nama_tagihan' => 'Dana Pengembangan Pendidikan ' . $tahun_nama,
                'jenis' => 'Dana Pendidikan',
                'keterangan' => $isLunas ? 'Pembayaran dana pendidikan lunas' : ($dibayar > 0 ? 'Sudah dibayar Rp ' . number_format($dibayar, 0, ',', '.') : 'Tagihan dana pendidikan aktif'),
                'nominal' => $nominal,
                'dibayar' => $isLunas ? $nominal : $dibayar,
                'sisa' => $sisa,
                'status' => $isLunas ? 'lunas' : 'belum',
            ]);
        }

        return $riwayat;
    }

    function dashboardSiswa()
    {
        if (session('role') !== 's') {
            return redirect(session('role') === 'g' ? '/sk/dsg' : '/sk/das');
        }

        $siswa_id = session("id");

        $data_siswa = siswa::with(['kelas', 'sekolah', 'tahunAjaran'])->where("id", $siswa_id)->first();
        $data_kelas = $data_siswa ? ruang_kelas::where("id", $data_siswa->kelas_id)->first() : null;
        $wallas = ($data_siswa && $data_siswa->kelas_id) ? wallas::with('guru')->where('kelas_id', $data_siswa->kelas_id)->first() : null;
        $tahun_aktif = tahun_ajaran::where('aktif', 1)->first() ?? tahun_ajaran::orderByDesc('id')->first();
        $tahun_nama = $tahun_aktif->nama ?? '2026/2027';

        // 1. Rekap Kehadiran Siswa
        $absensi_harian = absensi_siswa::where('siswa_id', $siswa_id)->whereNull('jadwal_pelajaran_id')->get();
        $absensi_sumber = $absensi_harian->isNotEmpty() ? $absensi_harian : absensi_siswa::where('siswa_id', $siswa_id)->get();
        $total_absen = $absensi_sumber->count();
        $hadir_absen = $absensi_sumber->where('status', 'h')->count();
        $rekap_absen = [
            'hadir' => $hadir_absen,
            'sakit' => $absensi_sumber->where('status', 's')->count(),
            'izin' => $absensi_sumber->where('status', 'i')->count(),
            'alpa' => $absensi_sumber->where('status', 'a')->count(),
            'total' => $total_absen,
            'persentase' => $total_absen > 0 ? round(($hadir_absen / $total_absen) * 100) : 100,
        ];

        // 2. Jadwal Pelajaran Hari Ini & Status Kehadiran Guru Pengajar
        $nama_ruang = $data_kelas->nama_ruang ?? '';
        $kelas_jadwal = $nama_ruang ? kelas::where('nama_kelas', $nama_ruang)->first() : null;
        $kelas_id_jadwal = $kelas_jadwal ? $kelas_jadwal->id : ($data_siswa->kelas_id ?? null);

        $hari_ini = strtolower(now()->locale('id')->isoFormat('dddd'));
        $hari_ini_label = ucfirst(now()->locale('id')->isoFormat('dddd, D MMMM Y'));
        $jadwal_hari_ini = collect();
        $absensi_guru_hari_ini = collect();

        if ($kelas_id_jadwal) {
            $jadwal_hari_ini = jadwal_pelajaran::with(['mata_pelajaran', 'guru', 'jam_pelajaran'])
                ->where('kelas_id', $kelas_id_jadwal)
                ->where('hari', $hari_ini)
                ->get()
                ->sortBy(function ($j) {
                    return $j->jam_pelajaran->jam_mulai ?? '00:00:00';
                })
                ->values();

            if ($jadwal_hari_ini->isNotEmpty()) {
                $absensi_guru_hari_ini = absensi_mengajar_guru::whereIn('jadwal_pelajaran_id', $jadwal_hari_ini->pluck('id'))
                    ->whereDate('tanggal', date('Y-m-d'))
                    ->get()
                    ->keyBy('jadwal_pelajaran_id');
            }
        }

        // 3. Rekap Nilai Akademik Terbaru
        $nilai_db = nilai::with(['mata_pelajaran', 'jenis_penilaian'])->where('siswa_id', $siswa_id)->get();
        $map_nilai = [];
        foreach ($nilai_db as $n) {
            if (!$n->mata_pelajaran || !$n->jenis_penilaian) continue;
            $m_id = $n->mapel_id;
            if (!isset($map_nilai[$m_id])) {
                $map_nilai[$m_id] = [
                    'nama_mapel' => $n->mata_pelajaran->nama_mapel,
                    'kkm' => $n->mata_pelajaran->kkm ?? 75,
                    'nilai_akhir' => 0,
                ];
            }
            $bobot = $n->jenis_penilaian->bobot / 100;
            $map_nilai[$m_id]['nilai_akhir'] += ($n->nilai * $bobot);
        }

        $nilai_terbaru = collect($map_nilai)->map(function ($item) {
            $item['nilai_akhir'] = round($item['nilai_akhir'], 1);
            return (object) $item;
        })->values();

        $rata_rata_nilai = $nilai_terbaru->isNotEmpty() ? round($nilai_terbaru->avg('nilai_akhir'), 1) : 0;

        // 4. Ringkasan Pembayaran
        $riwayat_tagihan = $this->getTagihanSiswa($siswa_id, $tahun_nama);
        $total_tagihan = $riwayat_tagihan->sum('nominal');
        $total_dibayar = $riwayat_tagihan->sum('dibayar');
        $sisa_tagihan = $riwayat_tagihan->sum('sisa');
        $tagihan_belum_lunas = $riwayat_tagihan->where('status', '!=', 'lunas')->count();

        $ringkasan_pembayaran = [
            'ada_data' => $riwayat_tagihan->isNotEmpty(),
            'total_tagihan' => $total_tagihan,
            'total_dibayar' => $total_dibayar,
            'sisa_tagihan' => $sisa_tagihan,
            'tagihan_aktif' => $tagihan_belum_lunas,
            'lunas' => $tagihan_belum_lunas === 0,
        ];

        // 5. Pengumuman Sekolah
        $pengumuman_db = pengumuman::orderByDesc('tanggal')->orderByDesc('id')->take(4)->get();
        $list_pengumuman = $pengumuman_db->map(function ($p) {
            return (object)[
                'tanggal' => $p->tanggal ? Carbon::parse($p->tanggal)->locale('id')->isoFormat('D MMM Y') : now()->isoFormat('D MMM Y'),
                'judul' => $p->judul,
                'ringkasan' => \Illuminate\Support\Str::limit(strip_tags($p->isi), 100),
                'isi' => $p->isi,
                'ditujukan' => 'Seluruh Siswa & Orang Tua',
            ];
        });

        return view('/modul/siakad/siswa/dashboardSiswa', compact(
            "data_siswa", "data_kelas", "wallas", "tahun_aktif",
            "rekap_absen", "jadwal_hari_ini", "hari_ini_label", "absensi_guru_hari_ini",
            "nilai_terbaru", "rata_rata_nilai", "ringkasan_pembayaran", "list_pengumuman"
        ));
    }

    function pembayaranSiswa()
    {
        if (session('role') !== 's') {
            return redirect(session('role') === 'g' ? '/sk/dsg' : '/sk/das');
        }

        $siswa_id = session("id");
        $data_siswa = siswa::with(['kelas', 'sekolah', 'tahunAjaran'])->where("id", $siswa_id)->first();
        $data_kelas = $data_siswa ? ruang_kelas::where("id", $data_siswa->kelas_id)->first() : null;
        $tahun_aktif = tahun_ajaran::where('aktif', 1)->first() ?? tahun_ajaran::orderByDesc('id')->first();
        $tahun_nama = $tahun_aktif->nama ?? '2026/2027';

        $riwayat_pembayaran = $this->getTagihanSiswa($siswa_id, $tahun_nama);

        return view('/modul/siakad/siswa/pembayaranSiswa', compact(
            "data_siswa", "data_kelas", "tahun_aktif", "riwayat_pembayaran"
        ));
    }

    function profilSiswa()
    {
        if (session('role') !== 's') {
            return redirect(session('role') === 'g' ? '/sk/dsg' : '/sk/das');
        }

        $siswa_id = session("id");
        $data_siswa = siswa::with(['kelas', 'sekolah', 'tahunAjaran'])->where("id", $siswa_id)->first();
        $data_kelas = $data_siswa ? ruang_kelas::where("id", $data_siswa->kelas_id)->first() : null;
        $wallas = ($data_siswa && $data_siswa->kelas_id) ? wallas::with('guru')->where('kelas_id', $data_siswa->kelas_id)->first() : null;
        $tahun_aktif = tahun_ajaran::where('aktif', 1)->first() ?? tahun_ajaran::orderByDesc('id')->first();

        return view('/modul/siakad/siswa/profilSiswa', compact(
            "data_siswa", "data_kelas", "wallas", "tahun_aktif"
        ));
    }

    function DetailSlipPembayaran()
    {
        return view('/modul/siakad/admin/detailSlipPembayaran');
    }

    function pengumumanSiswa()
    {
        if (session('role') !== 's') {
            return redirect(session('role') === 'g' ? '/sk/dsg' : '/sk/das');
        }

        $siswa_id = session("id");

        $data_siswa = siswa::with(['kelas', 'sekolah'])->where("id", $siswa_id)->first();
        $data_kelas = $data_siswa ? ruang_kelas::where("id", $data_siswa->kelas_id)->first() : null;

        $pengumuman_db = pengumuman::with(['sekolah', 'ruangKelas'])
            ->where(function($q) use ($siswa_id, $data_siswa) {
                // 1. Target Semua
                $q->where('target_tipe', 'semua')
                // 2. Target Tingkat Sekolah Siswa
                ->orWhere(function($sub) use ($data_siswa) {
                    if ($data_siswa && $data_siswa->sekolah_id) {
                        $sub->where('target_tipe', 'sekolah')
                            ->where('sekolah_id', $data_siswa->sekolah_id);
                    }
                })
                // 3. Target Kelas Siswa
                ->orWhere(function($sub) use ($data_siswa) {
                    if ($data_siswa && $data_siswa->kelas_id) {
                        $sub->where('target_tipe', 'kelas')
                            ->where('kelas_id', $data_siswa->kelas_id);
                    }
                })
                // 4. Target Role Siswa
                ->orWhere(function($sub) {
                    $sub->where('target_tipe', 'role')
                        ->whereIn('target_role', ['s', 'all']);
                })
                // 5. Target Personal Siswa
                ->orWhere(function($sub) use ($siswa_id) {
                    $sub->where('target_tipe', 'spesifik')
                        ->where('siswa_id', $siswa_id);
                });
            })
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->get();

        $list_pengumuman = $pengumuman_db->map(function ($p) {
            $ditujukan = 'Seluruh Siswa & Wali Murid';
            if ($p->target_tipe === 'sekolah') {
                $ditujukan = 'Jenjang ' . ($p->sekolah->jenis ?? 'Sekolah');
            } elseif ($p->target_tipe === 'kelas') {
                $ditujukan = 'Kelas ' . ($p->ruangKelas->nama_ruang ?? '-');
            } elseif ($p->target_tipe === 'role') {
                $ditujukan = 'Seluruh Siswa & Orang Tua';
            } elseif ($p->target_tipe === 'spesifik') {
                $ditujukan = 'Pribadi / Khusus Anda';
            }

            return (object)[
                'id' => $p->id,
                'tanggal' => $p->tanggal ? Carbon::parse($p->tanggal)->locale('id')->isoFormat('D MMMM Y') : now()->isoFormat('D MMMM Y'),
                'judul' => $p->judul,
                'penulis' => $p->penulis ?? 'Admin SIAKAD',
                'ringkasan' => \Illuminate\Support\Str::limit(strip_tags($p->isi), 140),
                'isi' => $p->isi,
                'lampiran' => $p->lampiran,
                'ditujukan' => $ditujukan,
            ];
        });

        return view('/modul/siakad/siswa/pengumumanSiswa', compact(
            "data_siswa", "data_kelas", "list_pengumuman"
        ));
    }

    function tampilan_formulirSiswa()
    {
        $data_ruang_kelas = ruang_kelas::all();
        $data_jenis_sekolah = jenis_sekolah::all();
        $data_tahun_ajaran = tahun_ajaran::all();
        return view("modul/guru/formulir_siswa", [
            "data_ruang_kelas" => $data_ruang_kelas,
            "data_jenis_sekolah" => $data_jenis_sekolah,
            "data_tahun_ajaran" => $data_tahun_ajaran
        ]);
    }

    function tambah_Siswa(Request $request)
    {
        $request->validate([
            "url_foto" => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path_foto = $request->file("url_foto")->store('uploads');

        siswa::create([
            "nama" => $request->nama,
            "nis" => $request->nis,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => Carbon::parse($request->tanggal_lahir)->translatedFormat("Y-m-d"),
            "agama" => "islam",
            "alamat" => $request->alamat,
            "url_foto" => $path_foto,
            "aktif" => 1,
            "kelas_id" => $request->kelas_id,
            "tahun_ajaran" => $request->tahun_ajaran_id,
            "sekolah_id" => $request->sekolah_id,
            "user_id" => (int) session("id_akun")
        ]);
        if (session('role') === 'a') {
            return redirect('/sk/ds')->with('success', 'Data siswa baru berhasil ditambahkan.');
        }

        $data_siswa = siswa::where("nis", $request->nis)->first();
        session()->put("id", $data_siswa->id);
        session()->put("nama", $data_siswa->nama);
        return redirect("/mod");

    }
}
