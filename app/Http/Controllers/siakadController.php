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
    // ==========================================
    // MANAJEMEN NILAI (GURU PENGAJAR)
    // ==========================================
    public function inputNilaiDetail($jadwal_id) {
        $guru_id = session('id');
        $jadwal = \App\Models\jadwal_pelajaran::with(['kelas', 'mata_pelajaran'])->where('id', $jadwal_id)->where('guru_id', $guru_id)->first();
        
        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // Sinkronisasi kelas_id (karena tabel kelas dan ruang_kelas terpisah namun namanya sama)
        $nama_kelas = $jadwal->kelas->nama_kelas ?? '';
        $ruang_kelas = \App\Models\ruang_kelas::where('nama_ruang', $nama_kelas)->first();
        
        $siswa = collect();
        if ($ruang_kelas) {
            $siswa = \App\Models\siswa::where('kelas_id', $ruang_kelas->id)->orderBy('nama')->get();
        }
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
        
        // Ambil nilai yang sudah ada
        $nilai_db = \App\Models\nilai::where('mapel_id', $jadwal->mapel_id)
                        ->where('guru_id', $guru_id)
                        ->whereIn('siswa_id', $siswa->pluck('id'))
                        ->get();
                        
        // Kelompokkan nilai agar mudah diakses di blade: $nilai[siswa_id][jenis_penilaian_id] = nilai
        $nilai = [];
        foreach ($nilai_db as $n) {
            $nilai[$n->siswa_id][$n->jenis_penilaian_id] = $n->nilai;
        }

        return view('modul.siakad.guru.inputNilaiDetail', compact('jadwal', 'siswa', 'jenis_penilaian', 'nilai'));
    }

    public function simpanNilaiSiswa(Request $request, $jadwal_id) {
        $guru_id = session('id');
        $jadwal = \App\Models\jadwal_pelajaran::find($jadwal_id);
        
        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
        }

        $input_nilai = $request->input('nilai'); // format: nilai[siswa_id][jenis_penilaian_id] = angka

        if ($input_nilai) {
            foreach ($input_nilai as $siswa_id => $penilaian) {
                foreach ($penilaian as $jenis_id => $angka) {
                    if ($angka !== null && $angka !== '') {
                        \App\Models\nilai::updateOrCreate(
                            [
                                'siswa_id' => $siswa_id,
                                'mapel_id' => $jadwal->mapel_id,
                                'guru_id' => $guru_id,
                                'jenis_penilaian_id' => $jenis_id,
                                'semester' => 'ganjil', // Default ganjil sementara
                                'tahun_ajaran_id' => $jadwal->tahun_ajaran_id
                            ],
                            [
                                'nilai' => $angka
                            ]
                        );
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan!');
    }
    // ==========================================
    // MANAJEMEN KENAIKAN KELAS & KELULUSAN (ADMIN)
    // ==========================================
    public function kenaikanKelasAdmin(Request $request) {
        $kelas_id = $request->input('kelas_id');
        $data_kelas = \App\Models\ruang_kelas::orderBy('nama_ruang')->get();
        
        $siswa = collect();
        if ($kelas_id) {
            $siswa = \App\Models\siswa::where('kelas_id', $kelas_id)->where('aktif', 1)->orderBy('nama')->get();
        }

        return view('modul.siakad.admin.kenaikanKelas', compact('data_kelas', 'siswa', 'kelas_id'));
    }

    public function prosesKenaikanKelas(Request $request) {
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
        $kelas_id = $request->query('kelas_id');
        $data_kelas = \App\Models\ruang_kelas::orderBy('nama_ruang')->get();
        
        // Siswa yang belum punya kelas
        $siswa_belum_ada_kelas = \App\Models\siswa::whereNull('kelas_id')->orderBy('nama')->get();
        
        $kelas_terpilih = null;
        $siswa_kelas_ini = collect();
        
        if ($kelas_id) {
            $kelas_terpilih = \App\Models\ruang_kelas::find($kelas_id);
            if ($kelas_terpilih) {
                $siswa_kelas_ini = \App\Models\siswa::where('kelas_id', $kelas_id)->orderBy('nama')->get();
            }
        }
        
        return view('modul.siakad.admin.pembagianKelas', compact('data_kelas', 'siswa_belum_ada_kelas', 'kelas_terpilih', 'siswa_kelas_ini', 'kelas_id'));
    }

    public function simpanPembagianKelas(Request $request) {
        $request->validate([
            'kelas_id' => 'required|exists:ruang_kelas,id',
            'siswa_ids' => 'required|array'
        ]);

        \App\Models\siswa::whereIn('id', $request->siswa_ids)
            ->update(['kelas_id' => $request->kelas_id]);

        return redirect()->back()->with('success', count($request->siswa_ids) . ' siswa berhasil ditambahkan ke kelas.');
    }

    public function keluarkanSiswaDariKelas($id) {
        $siswa = \App\Models\siswa::find($id);
        if ($siswa) {
            $siswa->update(['kelas_id' => null]);
            return redirect()->back()->with('success', 'Siswa berhasil dikeluarkan dari kelas.');
        }
        return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
    }
    function tampilanBuatTagihan_Siswa(){
        $data_siswa = siswa::all();
        return view("/modul/siakad/buatTagihan",[
            "data_siswa" => $data_siswa
        ]);
    }

    function edit_siswa(){
        return view ('/modul/siakad/admin/editSiswa');
    }

    function dashboard_siakad(){
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
        return view("/modul/siakad/guru/dashboard_guru");
    }
   
    function tambah_kelas(){
       $data_kelas = \App\Models\kelas::all();
       return view("/modul/siakad/admin/tambahKelas", compact('data_kelas'));
    }
    function absenSiswa(){
       return view("/modul/siakad/guru/absensisiswa");
    }

    function profilGuru(){
       return view("/modul/siakad/guru/profilGuru");
    }

    function slipPembayaranGuru(){
       return view("/modul/siakad/guru/slipPembayaran");
    }
    function tampilanPembayaranPemeliharaan(){
       return view("/modul/siakad/admin/pemeliharaan");
       
    }

    function tambahTagihan_Siswa(Request $request){
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
        $data_slip = slip_pembayaran_ipp::where('id',$request->id)->first();
        $data_slip->tanggal_awal = Carbon::parse($request->tanggal_awal)->translatedFormat("Y-m-d");
        $data_slip->nominal = $request->nominal;
        $data_slip->status = $request->status == 'Menunggak' ? false : true;
        $data_slip->jumlah_dibayar += (int) $request->bayar;
        $data_slip->save();
        return back()->with('success','berhasil edit pembayaran');
    }


    function edit_slipPembayaranPangkal(Request $request){
        $data_slip = slip_pembayaran_pangkal::where("id",(int) $request->id_siswa)->first();
        $data_slip->nominal = $request->nominal;
        $data_slip->jumlah_di_bayar += (int) $request->bayar;
        $data_slip->status = $request->status == 'Menunggak' ? false : true;
        $data_slip->save();
        return back()->with("success","berhasil edit pembayaran");
    }

    function edit_slipPembayaranPendidikan(Request $request){
        $data_slip = slip_pembayaran_pendidikan::where("id",(int) $request->id_siswa)->first();
        $data_slip->nominal = $request->nominal;
        $data_slip->jumlah_di_bayar += (int) $request->bayar;
        $data_slip->status = $request->status == 'Menunggak' ? false : true;
        $data_slip->save();
        return back()->with("success","berhasil edit pembayaran");
    }

    function publish_slipPembayaran(Request $request){
        $data_siswa = siswa::where('id',$request->id_siswa)->first();
        $data_akun = akun::where("id",$data_siswa->user_id)->first();

        $data_fonte = new FonteService();

        $pesan = "";

        if ($request->pembayaran == "pendidikan"){
            $pesan = "pembayaran pendidikan anda sudah lunas cek web anda untuk melihat update pembayaran";
        }elseif ($request->pembayaran == "pangkal"){
            $pesan = "pembayaran pangkal anda sudah lunas cek web anda untuk melihat update pembayaran";
        }else{
            $pesan = "pembayaran spp anda sudah lunas cek web anda untuk melihat update pembayaran";
        }

        $data_fonte->sendMassage($data_akun->noWa,$pesan);
        return back()->with("success","tagihan berhasil di publish");
    }

    function hapus_SlipPembayaran(Request $request){
        $data_slipPembayaran = null;

        if ($request->pembayaran == "pendidikan"){
            $data_slipPembayaran = slip_pembayaran_pendidikan::where("id",$request->id)->first();
        }elseif ($request->pembayaran == "pangkal"){
            $data_slipPembayaran = slip_pembayaran_pangkal::where("id",$request->id)->first();
        }else{
            $data_slipPembayaran = slip_pembayaran_ipp::where("id",$request->id)->first();
        }

        $data_slipPembayaran->delete();

        return back()->with("success","pembayaran berhasil dihapus");
    }

    function tampian_daftarSiswa(){
        $data_siswa = siswa::all();
        return view ('/modul/siakad/admin/daftar_siswa',compact("data_siswa"));
    }

    function tampilan_detailSiswa($id){
        $data_siswa = siswa::where("id",$id)->first();
        $data_kelas = ruang_kelas::where("id",$data_siswa->kelas_id)->first();
        return view ('/modul/siakad/admin/detailSiswa',compact("data_siswa","data_kelas"));
    }
    function simpan_kelas(Request $request){
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
        $kelas = \App\Models\kelas::findOrFail($id);
        return view('/modul/siakad/admin/editKelas', compact('kelas'));
    }

    function updateKelas(Request $request, $id) {
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
        $kelas = \App\Models\kelas::findOrFail($id);
        
        // Also try to find and delete from ruang_kelas by matching name
        \App\Models\ruang_kelas::where('nama_ruang', $kelas->nama_kelas)->delete();
        
        $kelas->delete();
        return back()->with('success', 'Ruang kelas berhasil dihapus.');
    }

    function jadwalMengajarGuru(Request $request) {
        $guru_id = session('id'); 
        $jadwal = \App\Models\jadwal_pelajaran::with(['kelas', 'mata_pelajaran', 'jam_pelajaran'])
            ->where('guru_id', $guru_id)
            ->orderBy('hari')
            ->get();
        return view('/modul/siakad/guru/jadwalMengajar', compact('jadwal'));
    }

    function inputNilaiGuru(Request $request) {
        $guru_id = session('id');
        $mapel_guru = \App\Models\jadwal_pelajaran::with(['kelas', 'mata_pelajaran'])
            ->where('guru_id', $guru_id)
            ->get();
        return view('/modul/siakad/guru/inputNilai', compact('mapel_guru'));
    }

    function dataWaliKelas(Request $request) {
        $guru_id = session('id');
        $wallas = \App\Models\wallas::with(['guru', 'ruangKelas'])->where('guru_id', $guru_id)->first();
        $siswa = collect();
        if ($wallas && $wallas->ruangKelas) {
            $siswa = \App\Models\siswa::where('kelas_id', $wallas->kelas_id)->get();
        }
        return view('/modul/siakad/guru/dataWaliKelas', compact('wallas', 'siswa'));
    }

    public function absensiWalas(Request $request) {
        $guru_id = session('id');
        $wallas = \App\Models\wallas::with('ruangKelas')->where('guru_id', $guru_id)->first();
        if (!$wallas) {
            return redirect()->back()->with('error', 'Anda bukan Wali Kelas.');
        }

        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $siswa = \App\Models\siswa::where('kelas_id', $wallas->kelas_id)->orderBy('nama')->get();
        
        $absensi_db = \App\Models\absensi_siswa::where('kelas_id', $wallas->kelas_id)
                        ->whereDate('tanggal', $tanggal)
                        ->get()->keyBy('siswa_id');

        $rekap = [
            'total' => $siswa->count(),
            'hadir' => $absensi_db->where('status', 'h')->count(),
            'sakit' => $absensi_db->where('status', 's')->count(),
            'izin'  => $absensi_db->where('status', 'i')->count(),
            'alpa'  => $absensi_db->where('status', 'a')->count(),
        ];

        return view('modul.siakad.guru.absensisiswa', compact('wallas', 'siswa', 'tanggal', 'absensi_db', 'rekap'));
    }

    public function simpanAbsensiWalas(Request $request) {
        $guru_id = session('id');
        $wallas = \App\Models\wallas::where('guru_id', $guru_id)->first();
        if (!$wallas) return redirect()->back();

        $tanggal = $request->input('tanggal');
        $status_absen = $request->input('status', []); // array siswa_id => status
        $keterangan = $request->input('keterangan', []); // array siswa_id => keterangan

        foreach ($status_absen as $siswa_id => $status) {
            \App\Models\absensi_siswa::updateOrCreate(
                [
                    'tanggal' => $tanggal,
                    'siswa_id' => $siswa_id,
                    'kelas_id' => $wallas->kelas_id
                ],
                [
                    'status' => $status,
                    'keterangan' => $keterangan[$siswa_id] ?? null,
                    'guru_id' => $guru_id
                ]
            );
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan!');
    }

    public function raporWalas(Request $request) {
        $guru_id = session('id');
        $wallas = \App\Models\wallas::with('ruangKelas')->where('guru_id', $guru_id)->first();
        if (!$wallas) {
            return redirect()->back()->with('error', 'Anda bukan Wali Kelas.');
        }

        $siswa = \App\Models\siswa::where('kelas_id', $wallas->kelas_id)->orderBy('nama')->get();

        return view('modul.siakad.guru.raporWalas', compact('wallas', 'siswa'));
    }

    public function detailRaporWalas(Request $request, $siswa_id) {
        $guru_id = session('id');
        $wallas = \App\Models\wallas::with('ruangKelas')->where('guru_id', $guru_id)->first();
        if (!$wallas) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $siswa = \App\Models\siswa::where('id', $siswa_id)->where('kelas_id', $wallas->kelas_id)->firstOrFail();
        
        // Ambil Data Nilai
        $nilai_db = \App\Models\nilai::with(['mata_pelajaran', 'jenis_penilaian'])
                        ->where('siswa_id', $siswa_id)
                        ->get();

        // Rekap Nilai per Mata Pelajaran
        $rekap_nilai = [];
        foreach ($nilai_db as $n) {
            $mapel = $n->mata_pelajaran->nama_mapel;
            if (!isset($rekap_nilai[$mapel])) {
                $rekap_nilai[$mapel] = [
                    'rincian' => [],
                    'nilai_akhir' => 0
                ];
            }
            $rekap_nilai[$mapel]['rincian'][$n->jenis_penilaian->nama_jenis] = $n->nilai;
            // Hitung nilai akhir berdasarkan bobot
            $bobot = $n->jenis_penilaian->bobot / 100;
            $rekap_nilai[$mapel]['nilai_akhir'] += ($n->nilai * $bobot);
        }

        // Ambil Rekap Absensi
        $absensi = \App\Models\absensi_siswa::where('siswa_id', $siswa_id)->get();
        $rekap_absensi = [
            'hadir' => $absensi->where('status', 'h')->count(),
            'sakit' => $absensi->where('status', 's')->count(),
            'izin'  => $absensi->where('status', 'i')->count(),
            'alpa'  => $absensi->where('status', 'a')->count(),
        ];

        return view('modul.siakad.guru.detailRaporWalas', compact('siswa', 'wallas', 'rekap_nilai', 'rekap_absensi'));
    }


    function kelolaJadwalAdmin(Request $request) {
        $data_kelas = \App\Models\kelas::all();
        $data_guru = \App\Models\guru::all();
        $data_mapel = \App\Models\mata_pelajaran::all();
        $data_jam = \App\Models\jam_pelajaran::orderBy('jam_mulai')->get();
        $data_tahun = \App\Models\tahun_ajaran::all();
        $data_jadwal = \App\Models\jadwal_pelajaran::with(['kelas', 'mata_pelajaran', 'guru', 'jam_pelajaran', 'tahun_ajaran'])
            ->orderBy('hari')
            ->get();
        return view('/modul/siakad/admin/kelolaJadwal', compact('data_kelas', 'data_guru', 'data_mapel', 'data_jam', 'data_tahun', 'data_jadwal'));
    }

    function simpanJadwalAdmin(Request $request) {
        $request->validate([
            'kelas_id' => 'required',
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'hari' => 'required',
            'jam_pelajaran_id' => 'required',
            'tahun_ajaran_id' => 'required',
        ]);
        \App\Models\jadwal_pelajaran::create([
            'kelas_id' => $request->kelas_id,
            'guru_id' => $request->guru_id,
            'mapel_id' => $request->mapel_id,
            'hari' => $request->hari,
            'jam_pelajaran_id' => $request->jam_pelajaran_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id
        ]);
        return back()->with('success', 'Jadwal pelajaran berhasil ditambahkan.');
    }

    function kelolaMapel(Request $request) {
        $data_mapel = \App\Models\mata_pelajaran::all();
        return view('/modul/siakad/admin/kelolaMapel', compact('data_mapel'));
    }

    function simpanMapel(Request $request) {
        $request->validate(['nama_mapel' => 'required']);
        \App\Models\mata_pelajaran::create(['nama_mapel' => $request->nama_mapel]);
        return back()->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    function hapusMapel($id) {
        \App\Models\mata_pelajaran::findOrFail($id)->delete();
        return back()->with('success', 'Mata Pelajaran berhasil dihapus.');
    }

    function editMapel($id) {
        $mapel = \App\Models\mata_pelajaran::findOrFail($id);
        return view('/modul/siakad/admin/editMapel', compact('mapel'));
    }

    function updateMapel(Request $request, $id) {
        $request->validate(['nama_mapel' => 'required']);
        \App\Models\mata_pelajaran::findOrFail($id)->update(['nama_mapel' => $request->nama_mapel]);
        return redirect('/sk/kelola-mapel')->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    function hapusJadwal($id) {
        \App\Models\jadwal_pelajaran::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }

    function editJadwal($id) {
        $jadwal = \App\Models\jadwal_pelajaran::findOrFail($id);
        $data_kelas = \App\Models\kelas::all();
        $data_guru = \App\Models\guru::all();
        $data_mapel = \App\Models\mata_pelajaran::all();
        $data_jam = \App\Models\jam_pelajaran::orderBy('jam_mulai')->get();
        $data_tahun = \App\Models\tahun_ajaran::all();
        return view('/modul/siakad/admin/editJadwal', compact('jadwal', 'data_kelas', 'data_guru', 'data_mapel', 'data_jam', 'data_tahun'));
    }

    function updateJadwal(Request $request, $id) {
        $request->validate([
            'kelas_id' => 'required',
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'hari' => 'required',
            'jam_pelajaran_id' => 'required',
            'tahun_ajaran_id' => 'required',
        ]);
        \App\Models\jadwal_pelajaran::findOrFail($id)->update([
            'kelas_id' => $request->kelas_id,
            'guru_id' => $request->guru_id,
            'mapel_id' => $request->mapel_id,
            'hari' => $request->hari,
            'jam_pelajaran_id' => $request->jam_pelajaran_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id
        ]);
        return redirect('/sk/kelola-jadwal')->with('success', 'Jadwal pelajaran berhasil diperbarui.');
    }

    // ==========================================
    // KELOLA REFERENSI AKADEMIK (Tahun & Jam)
    // ==========================================
    public function kelolaReferensi() {
        $data_tahun = \App\Models\tahun_ajaran::orderBy('id', 'desc')->get();
        $data_jam = \App\Models\jam_pelajaran::orderBy('jam_mulai', 'asc')->get();
        return view('modul.siakad.admin.kelolaReferensi', compact('data_tahun', 'data_jam'));
    }

    public function simpanTahunAjaran(Request $request) {
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
        return redirect()->back()->with('success_tahun', 'Tahun Ajaran baru berhasil ditambahkan.');
    }

    public function updateTahunAjaran(Request $request, $id) {
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
        return redirect()->back()->with('success_tahun', 'Tahun Ajaran berhasil diperbarui.');
    }

    public function hapusTahunAjaran($id) {
        \App\Models\tahun_ajaran::findOrFail($id)->delete();
        return redirect()->back()->with('success_tahun', 'Tahun Ajaran berhasil dihapus.');
    }

    public function simpanJamPelajaran(Request $request) {
        $request->validate([
            'nama_jam' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);
        \App\Models\jam_pelajaran::create([
            'nama_jam' => $request->nama_jam,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ]);
        return redirect()->back()->with('success_jam', 'Jam Pelajaran baru berhasil ditambahkan.');
    }

    public function updateJamPelajaran(Request $request, $id) {
        $request->validate([
            'nama_jam' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);
        \App\Models\jam_pelajaran::findOrFail($id)->update([
            'nama_jam' => $request->nama_jam,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ]);
        return redirect()->back()->with('success_jam', 'Jam Pelajaran berhasil diperbarui.');
    }

    public function hapusJamPelajaran($id) {
        \App\Models\jam_pelajaran::findOrFail($id)->delete();
        return redirect()->back()->with('success_jam', 'Jam Pelajaran berhasil dihapus.');
    }

    // ==========================================
    // KELOLA WALI KELAS (ADMIN)
    // ==========================================
    public function kelolaWaliKelas() {
        $data_wallas = \App\Models\wallas::with(['guru', 'ruangKelas'])->get();
        $data_guru = \App\Models\guru::all();
        $data_kelas = \App\Models\ruang_kelas::orderBy('nama_ruang')->get();
        return view('modul.siakad.admin.kelolaWallas', compact('data_wallas', 'data_guru', 'data_kelas'));
    }

    public function simpanWaliKelas(Request $request) {
        $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required'
        ]);

        // Cek apakah kelas sudah memiliki wali kelas
        if (\App\Models\wallas::where('kelas_id', $request->kelas_id)->exists()) {
            return redirect()->back()->with('error', 'Kelas tersebut sudah memiliki wali kelas.');
        }

        \App\Models\wallas::create([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id
        ]);
        return redirect()->back()->with('success', 'Penugasan Wali Kelas berhasil ditambahkan.');
    }

    public function updateWaliKelas(Request $request, $id) {
        $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required'
        ]);

        // Cek duplikasi jika kelas_id diubah ke kelas lain yang sudah ada wali kelasnya
        $cek = \App\Models\wallas::where('kelas_id', $request->kelas_id)->where('id', '!=', $id)->exists();
        if ($cek) {
            return redirect()->back()->with('error', 'Kelas tersebut sudah memiliki wali kelas.');
        }

        \App\Models\wallas::findOrFail($id)->update([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id
        ]);
        return redirect()->back()->with('success', 'Data Wali Kelas berhasil diperbarui.');
    }

    public function hapusWaliKelas($id) {
        \App\Models\wallas::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Penugasan Wali Kelas berhasil dihapus.');
    }

    // ==========================================
    // MENU SISWA (PORTAL ORANG TUA)
    // ==========================================
    public function jadwalSiswa(Request $request) {
        $siswa_id = session('id');
        $siswa = \App\Models\siswa::with('kelas')->find($siswa_id);
        
        if (!$siswa || !$siswa->kelas_id) {
            return redirect()->back()->with('error', 'Data kelas siswa tidak ditemukan.');
        }

        // Ambil jadwal pelajaran berdasarkan kelas siswa
        $jadwal = \App\Models\jadwal_pelajaran::with(['mata_pelajaran', 'guru', 'jam_pelajaran'])
            ->where('kelas_id', $siswa->kelas_id)
            ->orderBy('hari')
            ->get();

        // Rekap Absensi Siswa
        $absensi = \App\Models\absensi_siswa::where('siswa_id', $siswa_id)->get();
        $rekap_absen = [
            'h' => $absensi->where('status', 'h')->count(),
            'i' => $absensi->where('status', 'i')->count(),
            's' => $absensi->where('status', 's')->count(),
            'a' => $absensi->where('status', 'a')->count(),
        ];

        return view('modul.siakad.siswa.jadwalSiswa', compact('siswa', 'jadwal', 'rekap_absen'));
    }

    public function raporSiswa(Request $request) {
        $siswa_id = session('id');
        $siswa = \App\Models\siswa::with('kelas')->findOrFail($siswa_id);

        $nilai = \App\Models\nilai::with(['mata_pelajaran', 'jenis_penilaian'])
            ->where('siswa_id', $siswa_id)
            ->get();

        $jenis_penilaian = \App\Models\jenis_penilaian::all();
        $rekap_nilai = [];

        foreach ($nilai as $n) {
            $mapel_id = $n->mapel_id;
            if (!isset($rekap_nilai[$mapel_id])) {
                $rekap_nilai[$mapel_id] = [
                    'mata_pelajaran' => $n->mata_pelajaran,
                    'nilai_detail' => [],
                    'nilai_akhir' => 0
                ];
            }
            $rekap_nilai[$mapel_id]['nilai_detail'][$n->jenis_penilaian_id] = $n->nilai;
            
            // Kalkulasi nilai akhir dengan bobot
            if ($n->jenis_penilaian) {
                $bobot = $n->jenis_penilaian->bobot / 100;
                $rekap_nilai[$mapel_id]['nilai_akhir'] += ($n->nilai * $bobot);
            }
        }

        // Ambil rekap absen untuk ditampilkan di rapor
        $absensi = \App\Models\absensi_siswa::where('siswa_id', $siswa_id)->get();
        $rekap_absen = [
            'h' => $absensi->where('status', 'h')->count(),
            'i' => $absensi->where('status', 'i')->count(),
            's' => $absensi->where('status', 's')->count(),
            'a' => $absensi->where('status', 'a')->count(),
        ];

        return view('modul.siakad.siswa.raporSiswa', compact('siswa', 'rekap_nilai', 'jenis_penilaian', 'rekap_absen'));
    }
}


