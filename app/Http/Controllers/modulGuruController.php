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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class modulGuruController extends Controller
{
    //ini tampilan dashaboard guru dan admin
    function tampilan_dashboardGuru(){
        if (session("hasLogin")){
            Carbon::setLocale("id");
            $nama_hari = Carbon::now()->translatedFormat("l");
            $tanggal_hari_ini = Carbon::now()->translatedFormat("d M Y");
            $bulan = Carbon::now()->translatedFormat("m");
            $jumlah_kehadiran_bulanan = master_absen_guru::whereMonth("tgl_masuk",$bulan)->where("guru_id",session("id"))->where("status_kehadiran","h")->count();
            $lokasi_cabang = master_lokasi_absen_guru::where("cabang_id",guru::find(session("id"))->first()->cabang_id)->first();
            $cek_sudah_absen = false;
            $cek_data_absen = master_absen_guru::where("guru_id",session("id"))->whereNotIn("status_kehadiran",["a","i","s"])->where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->exists();
            $jam_masuk = Carbon::parse("00:00:00")->translatedFormat("H:i:s");
            $jam_keluar = Carbon::parse("00:00:00")->translatedFormat("H:i:s"); 
            if ($cek_data_absen){
                $cek_sudah_absen = true;
                $data_waktu = master_absen_guru::where("guru_id",session("id"))->whereNotIn("status_kehadiran",["a","i","s"])->where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->first();

                $jam_masuk = Carbon::parse($data_waktu->waktu_masuk)->translatedFormat("H:i:s");
                $jam_keluar = Carbon::parse($data_waktu->waktu_keluar)->translatedFormat("H:i:s");

            }
            return view("modul/guru/g/dashboard",[
                "jumlah_kehadiran_bulanan" => $jumlah_kehadiran_bulanan,
                "latitude" => $lokasi_cabang->latitude,
                "longitude" => $lokasi_cabang->longitude,
                "nama_hari" => $nama_hari,
                "tanggal_hari_ini" => $tanggal_hari_ini,
                "cek_sudah_absen" => $cek_sudah_absen,
                "jam_masuk" => $jam_masuk,
                "jam_keluar" => $jam_keluar
            ]);
        }
        return redirect("/reg");
    }

    function tampilan_dashboardAdmin(){
        if (session("hasLogin")){
            Carbon::setLocale("id");
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
            foreach($data_guru as $gr){
                if (akun::find($gr->user_id)->aktif){
                    if ($gr->kepala_sekolah) $jumlah_kepala_sekolah ++;
                    if ($gr->guru_honor) $jumlah_guru_honor ++;
                    if ($gr->guru_tetap) $jumlah_guru_tetap ++;
                    if ($gr->koordinator_tahfiz) $jumlah_koordinator ++;
                    if ($gr->pengampu_tahfiz) $jumlah_pengampu ++;
                    $jumlah_data_guru_aktif ++;
                } 
            
            }
            $jumlah_belum_absen =  master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->count() !=  $jumlah_data_guru_aktif ? $jumlah_data_guru_aktif - master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->count() : master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->where("status_kehadiran","a")->count() ;
            
            return view("modul/guru/a/dashboard",[
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

        $waktu_sekarang = Carbon::now();
        $waktu_keluar_absen = Carbon::parse($waktu->waktu_keluar);
        $sudah_absen = master_absen_guru::where("tgl_masuk",now()->format("Y-m-d"))->where("guru_id",session("id"))->where("status_kehadiran","!=","a")->exists(); 

        $cek_belum_pencet_tombol_keluar= master_absen_guru::where("waktu_masuk","!=",Carbon::parse("00:00:00"))->where("waktu_keluar",Carbon::parse("00:00:00"))->where("status_kehadiran","!=","a")->where("guru_id",session("id"))->exists();
        $cek_absen_oleh_admin= master_absen_guru::where("tgl_masuk",now()->format("Y-m-d"))->where("waktu_keluar",Carbon::parse("00:00:00"))->where("waktu_masuk",Carbon::parse("00:00:00"))->where("status_kehadiran","!=","a")->where("guru_id",session("id"))->exists();
        
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
        session()->put("id",$data_guru->id);
        session()->put("nama",$data_guru->nama);

        return redirect("/mod");
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
        return view("modul/guru/a/edit_guru",[
            "id_guru" => $id,
            "data_guru" => $data_guru,
            "data_cabang" => $data_cabang,
            "data_jenis_sekolah" => $data_jenis_sekolah,
            "data_akun" => $data_akun
        ]);
    }

    function update_dataGuru(Request $request){
        $data_guru = guru::find((int) $request->id_guru);
        $data_akun = akun::find((int) $data_guru->user_id);

        $request->validate([
            "url_foto" => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path_foto = $request->file("url_foto")->store('uploads');

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

        if ($request->email != $data_akun->email){
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
        }

        $data_akun->username = $request->username;
        $data_akun->email = $request->email;
        
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
        $data_guru->koordinator_tahfiz = (int) $request->koordinator_tahfiz;
        $data_guru->kepala_sekolah = (int) $request->kepala_sekolah;
        $data_guru->url_foto = $path_foto;
        $data_guru->cabang_id = (int) $request->cabang_id;
        $data_guru->sekolah_id = (int) $request->sekolah_id;

        $data_guru->save();
        $data_akun->save();

        return redirect("/gr/klgr");
    }
}
