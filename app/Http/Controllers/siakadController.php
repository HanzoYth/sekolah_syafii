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
       return view("/modul/siakad/admin/tambahKelas");
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
        if ($exists) {
            return back()->with('error', 'Kelas dengan nama tersebut sudah ada.');
        }

        \App\Models\ruang_kelas::create([
            'nama_ruang' => $nama_ruang
        ]);

        return back()->with('success', 'Ruang kelas berhasil ditambahkan.');
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
        $wallas = \App\Models\wallas::with('kelas')->where('guru_id', $guru_id)->first();
        $siswa = collect();
        if ($wallas && $wallas->kelas) {
            $siswa = \App\Models\siswa::where('kelas_id', $wallas->kelas->id)->get();
        }
        return view('/modul/siakad/guru/dataWaliKelas', compact('wallas', 'siswa'));
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
        $data_wallas = \App\Models\wallas::with(['guru', 'kelas'])->get();
        $data_guru = \App\Models\guru::all();
        $data_kelas = \App\Models\kelas::all();
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
}


