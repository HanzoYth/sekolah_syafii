<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\master_lokasi_absen_guru;
use App\Models\master_waktu_absen_guru;
use App\Models\master_absen_guru;
use App\Models\guru;
use App\Models\cabang_guru;
use App\Models\jenis_sekolah;
use Illuminate\Support\Carbon;
use App\Models\akun;

class modulGuruController extends Controller
{
    //ini tampilan dashaboard guru dan admin
    function tampilan_dashboard(){
        if (session("hasLogin")){
            Carbon::setLocale("id");
            $data_guru = session("role") == "g" ? guru::find((int) session("id")) : null;
            $data_lokasi = session("role") == "g" ? master_lokasi_absen_guru::where("cabang_id",$data_guru->cabang_id)->first() : null;
            $sudah_absen = master_absen_guru::where("tgl_masuk",now()->format("Y-m-d"))->where("guru_id",session("id"))->exists();
            $total_kehadiran_bulanan = master_absen_guru::where("guru_id",session("id"))->whereMonth("tgl_masuk",now()->month)->count();
            $jumlah_terlambat_menit = master_absen_guru::where("guru_id",session("id"))->sum("terlambat_menit");
            $total_hadir_sekarang = master_absen_guru::where("tgl_masuk",now()->format("Y-m-d"))->count();
            $total_data_guru = guru::count();

            $total_data_guru_honor = guru::where('guru_honor', 1)->count();

            $total_data_guru_tetap = guru::where('guru_tetap', 1)->count();

            $total_data_guru_koordinator_tahfiz =
                guru::where('koordinator_tahfiz', 1)->count();

            $total_data_guru_pengampu_tahfiz =
                guru::where('pengampu_tahfiz', 1)->count();
            $nama_hari = Carbon::now()->translatedFormat("l");
            $tanggal = Carbon::now()->translatedFormat("d M Y");
            $waktu_masuk = $sudah_absen ? master_absen_guru::where("guru_id",session("id"))->where("tgl_masuk",now()->format("Y-m-d"))->first()->waktu_masuk : "00:00:00";
            $waktu_keluar = master_absen_guru::where("guru_id",session("id"))->where("tgl_masuk",now()->format("Y-m-d"))->where("waktu_keluar","!=",Carbon::parse("00:00:00"))->exists()? master_absen_guru::where("guru_id",session("id"))->where("tgl_masuk",now()->format("Y-m-d"))->first()->waktu_keluar: "00:00:00";
            $tepat_waktu = master_absen_guru::where("terlambat_menit",0)->count();
            $terlambat = master_absen_guru::where("terlambat_menit","!=",0)->count();
            $izin_sakit = master_absen_guru::where("status_kehadiran","i")->orWhere("status_kehadiran","s")->count();
            $total_belum_absen = $total_data_guru - master_absen_guru::count();
            return view("modul/guru/g/dashboard",[
                //punya admin
                "guru_aktif" => $total_data_guru,
                "honor" => $total_data_guru_honor,
                "tetap" => $total_data_guru_tetap,
                "koordinator" => $total_data_guru_koordinator_tahfiz,
                "pengampu" => $total_data_guru_pengampu_tahfiz,
                "jumlah_presensi" => $total_hadir_sekarang,
                "tepat_waktu" => $tepat_waktu,
                "terlambat" => $terlambat,
                "izin_sakit" => $izin_sakit,
                "total_belum_absen" => $total_belum_absen,
                
                //untuk guru dan admin
                "hari" => $nama_hari,
                "tanggal" => $tanggal,

                // punya guru
                "total_kehadiran_bulanan" => $total_kehadiran_bulanan,
                "jumlah_terlambat_menit" => $jumlah_terlambat_menit,
                "sudah_absen" => $sudah_absen,
                "waktu_masuk" => $waktu_masuk,
                "waktu_keluar" => $waktu_keluar,
                "data_lokasi" => $data_lokasi,
                "data_guru" => $data_guru
            ]);
        }
        return redirect("/reg");
    }

    //ini fitur2 untuk guru
    function tampilan_formulirGuru(){
        $data_cabang = cabang_guru::all();
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

        $cek_belum_pencet_tombol_keluar= master_absen_guru::where("waktu_keluar",Carbon::parse("00:00:00"))->where("status_kehadiran","!=","a")->where("guru_id",session("id"))->exists();

        if ($cek_belum_pencet_tombol_keluar){
            return back()->with("eror","anda belum melukan absen keluar, silahkan melakukan absen keluar terlebih dahulu");
        }

        $hari = now()->dayOfWeekIso;
        if ($hari == 7){
            return back()->with("eror","waduhh endak bisa absen hari ahad");
        }

        $waktu_sekarang = Carbon::now();
        $waktu_keluar_absen = Carbon::parse($waktu->waktu_keluar);
        $sudah_absen = master_absen_guru::where("tgl_masuk",now()->format("Y-m-d"))->where("guru_id",session("id"))->where("status_kehadiran","!=","a")->exists();

        if ($sudah_absen){
            return back()->with("eror","anda sudah melakukan absen");
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
            "foto" => "required|file|mimes:jpg,jpeg,png:max:2048"
        ]);

        $path = $request->file("foto")->store("uploads");
        guru::create([
            "nama" => $request->nama,
            "nig" => "$request->nig",
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => Carbon::parse($request->tanggal_lahir)->translatedFormat("Y-m-d"),
            "agama" => "islam",
            "alamat" => $request->alamat,
            "pendidikan_terakhir" => "kosong",
            "url_foto" => $path,
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
        return view("modul/guru/a/laporan_absen",["data" => $data_absen_guru]);
    }

    function tampilan_kelolaGuru(){
        $data = guru::all();
        return view("modul/guru/a/kelola_data_guru",[
            "data_guru" => $data
        ]);
    }   

    function tampilan_editGuru($id){
        $data_guru = guru::find($id);
        $data_cabang = cabang_guru::all();
        $data_sekolah = jenis_sekolah::all();
        $data_akun = akun::find((int) $data_guru->cabang_id);
        return view("modul/guru/a/edit_guru",[
            "data_guru" => $data_guru,
            "data_cabang" => $data_cabang,
            "data_sekolah" => $data_sekolah,
            "data_akun" => $data_akun
        ]);
    }

}
