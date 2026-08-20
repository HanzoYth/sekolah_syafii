<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use App\Models\master_lokasi_absen_guru;
use App\Models\master_waktu_absen_guru;
use App\Models\master_absen_guru;
use App\Models\guru;
use App\Models\akun;
use App\Models\cabang_guru;
use App\Models\tanggal_merah;
use App\Models\jenis_sekolah;
use App\Models\gaji;
use App\Models\wallas;
use App\Models\kelas;
use App\Models\pengajuan;
use App\Models\pengumuman;
use App\Models\tunjangan;
use App\Services\FonteService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;  

class modulGuruController extends Controller
{
    //ini tampilan dashaboard guru dan admin
    function tampilan_dashboardGuru(){
        if (session("hasLogin")){
            Carbon::setLocale("id");
            $data_guru = guru::where("id",session("id"))->first();
            $nama_hari = Carbon::now()->translatedFormat("l");
            $tanggal_hari_ini = Carbon::now()->translatedFormat("d M Y");
            $bulan = Carbon::now()->translatedFormat("m");
            $jumlah_kehadiran_bulanan = master_absen_guru::whereMonth("tgl_masuk",$bulan)->where("guru_id",session("id"))->where("status_kehadiran","h")->count();
            $lokasi_cabang = master_lokasi_absen_guru::where("cabang_id",(int) guru::where("id",session("id"))->first()->cabang_id)->first();   
            $cek_sudah_absen = false;
            $cek_sudah_keluar = false;
            $cek_sudah_absen_oleh_admin = false;
            $cek_data_absen = master_absen_guru::where("guru_id",session("id"))->whereNotIn("status_kehadiran",["a","i","s"])->where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->exists();
            $jam_masuk = Carbon::parse("00:00:00")->translatedFormat("H:i:s");
            $jam_keluar = Carbon::parse("00:00:00")->translatedFormat("H:i:s"); 

            $data_pengumuman = pengumuman::where("cabang_id",$data_guru->cabang_id)->get();

            
            if (master_absen_guru::where("waktu_masuk","!=",Carbon::parse("00:00:00"))->where("waktu_keluar",Carbon::parse("00:00:00"))->whereNotIn("status_kehadiran",["a","s","i"])->where("guru_id",session("id"))->exists()){
                $cek_sudah_keluar = true;
                $cek_sudah_absen = true;
                $data_waktu = master_absen_guru::where("waktu_masuk","!=",Carbon::parse("00:00:00"))->where("waktu_keluar",Carbon::parse("00:00:00"))->whereNotIn("status_kehadiran",["a","s","i"])->where("guru_id",session("id"))->first();
                $jam_masuk = Carbon::parse($data_waktu->waktu_masuk)->translatedFormat("H:i:s");
                $jam_keluar = Carbon::parse($data_waktu->waktu_keluar)->translatedFormat("H:i:s");
            }else{
                if ($cek_data_absen){
                    $cek_sudah_absen = true;
                    $data_waktu = master_absen_guru::where("guru_id",session("id"))->whereNotIn("status_kehadiran",["a","i","s"])->where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->first();
                    $jam_masuk = Carbon::parse($data_waktu->waktu_masuk)->translatedFormat("H:i:s");
                    $jam_keluar = Carbon::parse($data_waktu->waktu_keluar)->translatedFormat("H:i:s");
                }
            }


            if(master_absen_guru::where("tgl_masuk",now()->format("Y-m-d"))->where("waktu_keluar",Carbon::parse("00:00:00"))->where("waktu_masuk",Carbon::parse("00:00:00"))->where("status_kehadiran","!=","a")->where("guru_id",session("id"))->exists()){
                $cek_sudah_absen_oleh_admin = true;
            }
            return view("modul/guru/g/dashboard",[
                "data_guru" => $data_guru,
                "jumlah_kehadiran_bulanan" => $jumlah_kehadiran_bulanan,
                "latitude" => $lokasi_cabang->latitude,
                "longitude" => $lokasi_cabang->longitude,
                "nama_hari" => $nama_hari,
                "tanggal_hari_ini" => $tanggal_hari_ini,
                "cek_sudah_absen" => $cek_sudah_absen,
                "jam_masuk" => $jam_masuk,
                "jam_keluar" => $jam_keluar,
                "cek_sudah_absen_oleh_admin" => $cek_sudah_absen_oleh_admin,
                "cek_sudah_keluar" => $cek_sudah_keluar,
                "data_pengumuman" => $data_pengumuman
            ]);
        }
        return redirect("/reg");
    }

    function tampilan_dashboardAdmin(){
        if (session("hasLogin")){
            Carbon::setLocale("id");
            $myData = admin::where("id",session('id'))->first();
            $jumlah_hadir_hari_ini = master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->whereNotIn("status_kehadiran",["a","i","s"])->count();
            $jumlah_guru_tepat_waktu = master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->whereNotIn("status_kehadiran",["a","i","s"])->where("terlambat_menit",0)->count();
            $jumlah_terlambat = master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->where("terlambat_menit",">",0)->count();
            $jumlah_izin = master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->where("status_kehadiran","i")->count();
            $jumlah_sakit = master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->where("status_kehadiran","s")->count();
            $nama_hari = Carbon::now()->translatedFormat("l");
            $tanggal_sekarang = Carbon::now()->translatedFormat("d M Y");
            $data_guru = guru::all();
            $jumlah_data_guru_aktif = 0; 
            $jumlah_kepala_sekolah = 0;
            $jumlah_guru_tetap = 0;
            $jumlah_guru_honor = 0;
            $jumlah_koordinator = 0;
            $jumlah_pengampu = 0;
            $jumlah_belum_absen = 0;
            foreach($data_guru as $gr){
                if (akun::find($gr->user_id)->aktif){
                    if ($gr->kepala_sekolah) $jumlah_kepala_sekolah ++;
                    if ($gr->guru_honor) $jumlah_guru_honor ++;
                    if ($gr->guru_tetap) $jumlah_guru_tetap ++;
                    if ($gr->koordinator_tahfiz) $jumlah_koordinator ++;
                    if ($gr->pengampu_tahfiz) $jumlah_pengampu ++;
                    $jumlah_data_guru_aktif ++;

                    if (!master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->where("guru_id",$gr->id)->exists()){
                        $jumlah_belum_absen ++;
                    }
                } 
            }

            
            return view("modul/guru/a/dashboard",[
                "mydata" => $myData,
                "jumlah_guru_aktif" => $jumlah_data_guru_aktif,
                "jumlah_kepala_sekolah" => $jumlah_kepala_sekolah,
                "jumlah_guru_tetap" => $jumlah_guru_tetap,
                "jumlah_guru_honor" => $jumlah_guru_honor,
                "jumlah_koordinator" => $jumlah_koordinator,
                "jumlah_pengampu" => $jumlah_pengampu,
                "jumlah_presensi" => $jumlah_hadir_hari_ini,
                "nama_hari" => $nama_hari,
                "tanggal_sekarang" => $tanggal_sekarang,
                "jumlah_guru_tepat_waktu" => $jumlah_guru_tepat_waktu,
                "jumlah_terlambat" => $jumlah_terlambat,
                "jumlah_izin" => $jumlah_izin,
                "jumlah_sakit" => $jumlah_sakit,
                "jumlah_belum_absen" => $jumlah_belum_absen
            ]);
        }
        return redirect ("/reg");
    }

    //ini fitur2 untuk guru
    function tampilan_formulirGuru(){
        $data_cabang = cabang_guru::where("aktif",1)->get();
        $data_sekolah = jenis_sekolah::all();
        return view("/modul/guru/formulir_guru",[
            "cabang" => $data_cabang,
            "sekolah" => $data_sekolah
        ]);
    }

    function tampilan_presensiAbsen(){
        Carbon::setLocale("id");
        $data_guru = guru::where("id",(int) session("id"))->first();
        $cabang = cabang_guru::find((int) $data_guru->cabang_id);
        $lokasi = master_lokasi_absen_guru::where("cabang_id",$cabang->id)->first();
        $waktu = master_waktu_absen_guru::where("cabang_id",$cabang->id)->where("hari",strtolower(Carbon::now()->translatedFormat("l")))->first();

        $tanggal_sekarang = Carbon::now()->translatedFormat("Y-m-d");
        $cek_tanggal_merah = tanggal_merah::where("tanggal",$tanggal_sekarang)->exists();
        $waktu_sekarang = Carbon::now();
        $waktu_keluar_absen = Carbon::parse($waktu->waktu_keluar);
        $sudah_absen = master_absen_guru::where("tgl_masuk",now()->format("Y-m-d"))->where("guru_id",session("id"))->where("status_kehadiran","!=","a")->exists(); 

        $cek_belum_pencet_tombol_keluar= master_absen_guru::where("waktu_masuk","!=",Carbon::parse("00:00:00"))->where("waktu_keluar",Carbon::parse("00:00:00"))->where("status_kehadiran","h")->where("guru_id",session("id"))->exists();
        $cek_absen_oleh_admin= master_absen_guru::where("tgl_masuk",now()->format("Y-m-d"))->where("waktu_keluar",Carbon::parse("00:00:00"))->where("waktu_masuk",Carbon::parse("00:00:00"))->where("status_kehadiran","!=","a")->where("guru_id",session("id"))->exists();
    
        if ($cek_tanggal_merah){
            return back()->with("eror","anda endak bisa melakukan absen tanggal merah");
        }

        if ($cek_absen_oleh_admin){
            return back()->with("eror","anda sudah di absenkan oleh admin");
        }
        if ($sudah_absen){
            return back()->with("eror","anda sudah melakukan absen");
        }

        if ($cek_belum_pencet_tombol_keluar){
            return back()->with("eror","anda belum melukan absen keluar, silahkan melakukan absen keluar terlebih dahulu");
        }

        $hari = now()->dayOfWeekIso;
        if ($hari == 7){
            return back()->with("eror","waduhh endak bisa absen hari ahad");
        }

        if ($waktu_sekarang->greaterThan($waktu_keluar_absen)){
            return back()->with("eror","waduhh endak bisa absen sudah jam segini");
        }

        if (session("hasLogin")){
            return view("modul/guru/g/presensi_absen",["lokasi" => $lokasi,"cabang" => $cabang]);
        }
        return redirect("/reg");
    }

    function tambahGuru(Request $request){
        $request->validate([
            "foto" => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path_foto = $request->file("foto")->store('uploads');

        guru::create([
            "nama" => $request->nama,
            "nig" => "$request->nig",
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => Carbon::parse($request->tanggal_lahir)->translatedFormat("Y-m-d"),
            "agama" => "islam",
            "alamat" => $request->alamat,
            "pendidikan_terakhir" => $request->pendidikan_terakhir,
            "url_foto" => $path_foto,
            "guru_honor" => (int) $request->honor,
            "guru_tetap" => (int) $request->tetap,
            "koordinator_tahfiz" => (int) $request->koordinator,
            "pengampu_tahfiz" => (int) $request->pengampu,
            "kepala_sekolah" => 0,
            "cabang_id" => $request->cabang_id,
            "sekolah_id" => $request->sekolah_id,
            "user_id" => (int) session("id_akun"),
        ]);
        $data_guru = guru::where("nig", $request->nig)->first();
        $this->tambah_Gaji($data_guru->id);
        session()->put("id",$data_guru->id);
        session()->put("nama",$data_guru->nama);

        return redirect("/mod");
    }

    function tambah_Gaji($id_guru){
        gaji::create([
            "gaji_pokok" => 0,
            "gaji_honor" => 0,
            "gaji_tugas_tambahan" => 0,
            "potongan_tidak_hadir" => 0,
            "potongan_keterlambatan" => 0,
            "kasbon" => 0,
            "gaji_tambahan" => 0,
            "bonus" => 0,
            "guru_id" => $id_guru
        ]);
    }

    //ini tampilan fitur2 sebagai admin
    function tampilan_settingAbsen($id){
        if (session("hasLogin")){
            $cabang = cabang_guru::find($id);
            $lokasi = master_lokasi_absen_guru::where("cabang_id", $id)->first();
            $waktu = master_waktu_absen_guru::where("cabang_id",$id)->get();
    
            return view("modul/guru/a/setting_absen",['lokasi' => $lokasi,'waktu'=>$waktu,'id' => $id,'cabang' => $cabang]);
        }
        return redirect("/reg");
    }

    function tampilan_laporanAbsen(){
        $data_absen_guru = master_absen_guru::all();
        $cek_hari_ini_tanggal_merah = tanggal_merah::where("tanggal",Carbon::now()->translatedFormat("Y-m-d"))->exists();
        return view("modul/guru/a/laporan_absen",["data" => $data_absen_guru,"cek" => $cek_hari_ini_tanggal_merah]);
    }

    function tampilan_kelolaGuru(){
        $data = guru::all();
        return view("modul/guru/a/kelola_data_guru",[
            "data_guru" => $data
        ]);
    }   

    function tampilan_editGuru($id){
        $data_guru = guru::find($id);
        $data_cabang = cabang_guru::where("aktif",1)->get();
        $data_jenis_sekolah = jenis_sekolah::all();
        $data_akun = akun::find((int) $data_guru->user_id);
        $data_cabang = cabang_guru::all();
        $data_sekolah = jenis_sekolah::all();
        $data_akun = akun::find((int) $data_guru->user_id);
        return view("modul/guru/a/edit_guru",[
            "data_guru" => $data_guru,
            "data_cabang" => $data_cabang,
            "data_sekolah" => $data_sekolah,
            "data_jenis_sekolah" => $data_jenis_sekolah,
            "data_akun" => $data_akun
        ]);
    }

    function update_dataGuru(Request $request){
        $data_guru = guru::find((int) $request->id_guru);
        $data_akun = akun::find((int) $data_guru->user_id);

        if ($request->password != ""){
            $validator = Validator::make($request->all(), [
                'password' => [
                    'min:8',
                ],
            ], [
                'password.min' => 'Password minimal 8 karakter.',
            ]);

            $validator->after(function ($validator) use ($request) {

                $password = $request->password;

                if ($password !== null) {

                    if (!preg_match('/[A-Z]/', $password) ||
                        !preg_match('/[a-z]/', $password)) {

                        $validator->errors()->add(
                            'password',
                            'Password harus memiliki huruf kapital dan huruf kecil.'
                        );
                    }

                    if (!preg_match('/[0-9]/', $password)) {

                        $validator->errors()->add(
                            'password',
                            'Password harus memiliki sebuah angka.'
                        );
                    }
                }
            });

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data_akun->password = Hash::make($request->password);
        }

        if (strcasecmp(trim($request->email), trim($data_akun->email)) !== 0){
            $validator = Validator::make($request->all(),[
                'email' => [
                    'required',
                    'unique:akun,email'
                ],  
            ],[
                'email.required' => 'email wajib di isi',
                'email.unique' => 'email sudah di gunakan',
            ]
            );

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $data_akun->email = $request->email;
        }

        if ($request->username != $data_akun->username){
            $validator = Validator::make($request->all(),[
                'username' => [
                    'required',
                    'unique:akun,username',
                ],
            ],[
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah digunakan.',
            ]
            );

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data_akun->username = $request->username;
        }

        
        
        $data_guru->nama = $request->nama;
        $data_guru->nig = $request->nig;
        $data_guru->tempat_lahir = $request->tempat_lahir;
        $data_guru->tanggal_lahir = $request->tanggal_lahir;
        $data_guru->agama = $request->agama;
        $data_guru->pendidikan_terakhir = $request->pendidikan_terakhir;
        $data_guru->alamat = $request->alamat;
        $data_guru->guru_honor = (int) $request->guru_honor;
        $data_guru->pengampu_tahfiz = (int) $request->pengampu_tahfiz;
        $data_guru->guru_tetap = (int) $request->guru_tetap;
        $data_guru->tutup_buku = (int) $request->tutup_buku;
        $data_guru->koordinator_tahfiz = (int) $request->koordinator_tahfiz;
        $data_guru->kepala_sekolah = (int) $request->kepala_sekolah;
        $data_guru->cabang_id = (int) $request->cabang_id;
        $data_guru->sekolah_id = (int) $request->sekolah_id;

        $data_guru->save();
        $data_akun->save();

        return redirect("/gr/klgr");
    }

    function tampilan_kelolaGajiGuru(){
        if (session("hasLogin")){
            $data_guru = guru::whereHas("getUser",function ($item) {
                $item->where("aktif",1);
            })->get();

            return view("modul/guru/a/kelola_gaji_guru",[
                "data_guru" => $data_guru
            ]);
        }
        return redirect("/reg");
    }

    function tampilan_editGajiGuru($id){
        if (session("hasLogin")){
            Carbon::setLocale("id");
            $data_guru = guru::where("id",$id)->first();
            $cek_wallas = wallas::where("guru_id",$id)->exists();
            $info_jabatan  = "guru ini tidak punya jabatan utama";
            $bulan = Carbon::now()->translatedFormat("m");
            $data_gaji = gaji::where("guru_id",$id)->first();
            $data_tunjangan = tunjangan::where("guru_id",$id)->get();
            if ($cek_wallas){
                $data_kelas = kelas::where("id",wallas::where("guru_id",$id)->first()->kelas_id)->first();
                $info_jabatan = "guru wali kelas $data_kelas";
            }elseif ($data_guru->kepala_sekolah) {
                $jenis_sekolah = jenis_sekolah::where("id",$data_guru->sekolah_id)->first()->jenis;
                $info_jabatan = "kepala sekolah $jenis_sekolah";
            }

            $jumlah_kehadiran = master_absen_guru::where("guru_id",$id)->whereMonth("tgl_masuk",$bulan)->where("status_kehadiran","h")->count();
            $jumlah_terlambat = master_absen_guru::where("guru_id",$id)->whereMonth("tgl_masuk",$bulan)->where("status_kehadiran","h")->sum("terlambat_menit");
            $awal_bulan = Carbon::now()->startOfMonth();
            $akhir_bulan = Carbon::now()->endOfMonth();
            $jumlah_hari_aktif = 0;

            for ($data  = $awal_bulan->copy() ; $data <= $akhir_bulan; $data->addDays()){
                if (strtolower(Carbon::parse($data)->translatedFormat("l")) != "minggu"){
                    $jumlah_hari_aktif ++;
                }
            }
            return view("modul/guru/a/edit_gaji_guru",[
                "data_guru" => $data_guru,
                "info_jabatan" => $info_jabatan,
                "jumlah_kehadiran" => $jumlah_kehadiran,
                "jumlah_terlambat" => $jumlah_terlambat,
                "data_gaji" => $data_gaji,
                "data_tunjangan" => $data_tunjangan,
                "jumlah_hari_aktif" => $jumlah_hari_aktif
            ]);
        }
        return redirect("/reg");
    }


    function tambah_tunjangan($nama_tunjangan,$nominal,$guru_id){
        tunjangan::create([
            "nama_tunjangan" => $nama_tunjangan,
            "nominal" => $nominal,
            "guru_id" => $guru_id
        ]);
    }

    function simpan_PerubahanGajiGuru(Request $request){
        $data_gaji = gaji::where("guru_id",(int) $request->id_guru)->first();
        $bulan = Carbon::now()->translatedFormat("m");
        $data_absen = master_absen_guru::where("guru_id",$request->id_guru)->whereMonth("tgl_masuk",$bulan)->where("status_kehadiran","h")->sum("terlambat_menit");
        
        $awal_bulan = Carbon::now()->startOfMonth();
        $akhir_bulan = Carbon::now()->endOfMonth();
        $jumlah_hari_aktif = 0;
        Carbon::setLocale("id");
        for ($data  = $awal_bulan->copy() ; $data <= $akhir_bulan; $data->addDays()){
            if (strtolower(Carbon::parse($data)->translatedFormat("l")) != "minggu"){
                $jumlah_hari_aktif ++;
            }
        }
        $jumlah_alpa = $jumlah_hari_aktif - master_absen_guru::where("guru_id",$request->id_guru)->whereMonth("tgl_masuk",$bulan)->where("status_kehadiran","h")->count();
        $data_gaji->gaji_pokok = isset($request->pokok) ? $request->pokok : 0;
        $data_gaji->gaji_honor = isset($request->honor) ? $request->honor : 0;
        $data_gaji->gaji_tugas_tambahan = isset($request->tugas_tambahan) ? $request->tugas_tambahan : 0;
        $data_gaji->potongan_tidak_hadir = isset($request->tidak_hadir) ? $request->tidak_hadir * $jumlah_alpa : 0;
        $data_gaji->potongan_keterlambatan = isset($request->terlambat) ? $request->terlambat * $data_absen : 0;
        $data_gaji->kasbon = isset($request->kasbon) ? $request->kasbon : 0;
        $data_gaji->gaji_tambahan = isset($request->tambahan) ? $request->tambahan : 0;
        $data_gaji->bonus = isset($request->bonus) ? $request->bonus : 0;
        if (isset($request->tgs_tambahan)){
            $data_gaji->tugas_tambahan = $request->tgs_tambahan;
        }

        if (tunjangan::where("guru_id",$request->id_guru)->exists()){
            tunjangan::where("guru_id",$request->id_guru)->delete();
        }
        
        for ($i = 0; $i < count(isset($request->nama_tunjangan) ? $request->nama_tunjangan : []) ; $i++){
            $this->tambah_tunjangan($request->nama_tunjangan[$i],$request->harga_tunjangan[$i],$request->id_guru);
        }

        $data_gaji->save();
        return redirect("/gr/klgjgr");
    }

    function publish_GajiGuru($id){
        $WA_guru = guru::where("id",(int) $id)->first()->getUser;
        $data_gaji = gaji::where("guru_id",(int) $id)->first();
        $data_gaji->publish = 1;
        $data_gaji->save();
        
        $kirim_pesan = new FonteService();
        $kirim_pesan->sendMassage($WA_guru->noWa,"tolong perhatikan email anda untuk melihat lampiran slip gaji anda, kalau akun email anda sudah endak aktif chat admin yang bersangkutan");

        $kirim_surat = new file_surat();
        $kirim_surat->Kirim_FileSlipGaji($id);
        return back();
    }


    function Tampilan_PengumumanGuru(){
        $data_guru = guru::where("id",session('id'))->first();
        $data_pengumuman = pengumuman::where("cabang_id",$data_guru->cabang_id)->get();
        return view("modul/guru/g/pengumuman",[
            "data_pengumuman" => $data_pengumuman,
            "data_guru" => $data_guru
        ]);
    }

    function tambah_pengumumanGuru(Request $request){
        $id_cabang = guru::where("id",session("id"))->first()->cabang_id;

        $data_guru = guru::where("cabang_id",$id_cabang)->where("id","!=",session("id"))->get();

        $Wa_Fonte = new FonteService();
        foreach ($data_guru as $value){
            $Wa_Fonte->sendMassage($value->getUser()->first()->noWa,$request->isi);
        }
        
        pengumuman::create([
            "judul" => $request->judul,
            "isi" => $request->isi,
            "tanggal" => Carbon::parse($request->tanggal)->translatedFormat("Y-m-d"),
            "guru_id" => session("id"),
            "cabang_id" => $id_cabang
        ]);

        return back();
    }

    function Edit_pengumumanGuru(Request $request){
        $data_pengumuman = pengumuman::where("id",(int) $request->id_pengumuman)->first();

        $data_pengumuman->judul = $request->judul;
        $data_pengumuman->isi = $request->isi;
        $data_pengumuman->tanggal = Carbon::parse($request->tanggal)->translatedFormat("Y-m-d");
        
        $data_pengumuman->save();
        
        $id_cabang = guru::where("id",session("id"))->first()->cabang_id;

        $data_guru = guru::where("cabang_id",$id_cabang)->where("id","!=",session("id"))->get();

        $Wa_Fonte = new FonteService();
        foreach ($data_guru as $value){
            $Wa_Fonte->sendMassage($value->getUser()->first()->noWa,$request->isi);
        }

        return back();
    }

    function tampilan_pengajuanGuru(){
        $data_pengajuan = pengajuan::all();
        return view("modul/guru/g/pengajuan",[
            "data_pengajuan" => $data_pengajuan,
        ]);
    }

    function tambah_pengajuanGuru(Request $request){
        pengajuan::create([
            "status_pengajuan" => $request->jenis_pengajuan,
            "isi" => $request->keterangan,
            "guru_id" => session("id")
        ]);

        return back();
    }

    function edit_pengajuanGuru(Request $request){
        $data_pengajuan = pengajuan::where("id", $request->id_pengajuan)->first();

        $data_pengajuan->isi = $request->keterangan;
        $data_pengajuan->status_pengajuan = $request->jenis_pengajuan;

        $data_pengajuan->save();

        return back();
    }

    function hapus_pengajuanGuru($id){
        $data_pengajuan = pengajuan::where("id", $id)->first();

        $data_pengajuan->delete();

        return back();
    }
}
