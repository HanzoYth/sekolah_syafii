<?php

namespace App\Http\Controllers;

use App\Models\bendahara;
use App\Models\cabang_guru;
use App\Models\gaji_bendahara;
use App\Models\jadwal_piket;
use App\Models\master_absen_bendahara;
use App\Models\master_lokasi_absen_guru;
use App\Models\master_waktu_absen_guru;
use App\Models\tanggal_merah;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class bendaharaController extends Controller
{
    function tambah_Bendahara(Request $request){
        $validator = Validator::make($request->all(),
            [
                "foto" => 'required|file|mimes:jpg,jpeg,png|max:2048'
            ],
            [
                "foto.mimes" => "file harus berupa jpg, jpeg, atau png",
                "foto.max" => "ukuran file harus lebih kecil dari 2 mb atau 2 mb",
            ]
        );

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $path_foto = $request->file("foto")->store('uploads');

        bendahara::create([
            "nama" => $request->nama,
            "nig" => $request->nig,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "agama" => $request->agama,
            "alamat" => $request->alamat,
            "cabang_id" => $request->cabang_id,
            "pendidikan_terakhir" => $request->pendidikan_terakhir,
            "url_foto" => $path_foto,
            "gender" => $request->jenis_kelamin,
            "user_id" => (int) session("id_akun") 
        ]);

        $data_bendahara = bendahara::where("nig", $request->nig)->first();
        $this->tambah_Gaji($data_bendahara->id);
        session()->put("id",$data_bendahara->id);
        session()->put("nama",$data_bendahara->nama);

        return redirect("/mod");
    }   

    function tambah_Gaji($id){
        gaji_bendahara::create([
            "gaji_pokok" => 0,
            "gaji_honor" => 0,
            "gaji_tugas_tambahan" => 0,
            "potongan_tidak_hadir" => 0,
            "potongan_keterlambatan" => 0,
            "kasbon" => 0,
            "gaji_tambahan" => 0,
            "bonus" => 0,
            "ketidakhadiran" => 0,
            "bendahara_id" => $id,
            "evaluasi" => null
        ]);
    }

    function tampilan_FormulirBendahara(){
        $cabang = cabang_guru::all();
        return view("modul/guru/formulir_bendahara",compact("cabang"));
    }

    function tampilan_dashboardBendahara(){
        if (session("hasLogin")){
            Carbon::setLocale("id");
            $data_bendahara = bendahara::where("id",session("id"))->first();
            $nama_hari = Carbon::now()->translatedFormat("l");
            $tanggal_hari_ini = Carbon::now()->translatedFormat("d M Y");
            $bulan = Carbon::now()->translatedFormat("m");
            $lokasi_cabang = master_lokasi_absen_guru::where("cabang_id",(int) bendahara::where("id",session("id"))->first()->cabang_id)->first();   
            $cek_sudah_absen = false;
            $cek_sudah_keluar = false;
            $cek_sudah_absen_oleh_admin = false;
            $cek_status_absen = master_absen_bendahara::where("bendahara_id",session("id"))->where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->exists();
            $status_absen = master_absen_bendahara::where("bendahara_id",session("id"))->where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->first();
            $cek_data_absen = master_absen_bendahara::where("bendahara_id",session("id"))->whereNotIn("status_kehadiran",["a","i","s"])->where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->exists();
            $jam_masuk = Carbon::parse("00:00:00")->translatedFormat("H:i:s");
            $jam_keluar = Carbon::parse("00:00:00")->translatedFormat("H:i:s");

            
            if (master_absen_bendahara::where("waktu_masuk","!=",Carbon::parse("00:00:00")->translatedFormat("H:i:s"))->where("waktu_keluar",Carbon::parse("00:00:00")->translatedFormat("H:i:s"))->whereNotIn("status_kehadiran",["a","s","i"])->where("bendahara_id",session("id"))->exists()){
                $cek_sudah_keluar = true;
                $cek_sudah_absen = true;
                $data_waktu = master_absen_bendahara::where("waktu_masuk","!=",Carbon::parse("00:00:00")->translatedFormat("H:i:s"))->where("waktu_keluar",Carbon::parse("00:00:00")->translatedFormat("H:i:s"))->whereNotIn("status_kehadiran",["a","s","i"])->where("bendahara_id",session("id"))->first();
                $jam_masuk = Carbon::parse($data_waktu->waktu_masuk)->translatedFormat("H:i:s");
                $jam_keluar = Carbon::parse($data_waktu->waktu_keluar)->translatedFormat("H:i:s");
            }else{
                if ($cek_data_absen){
                    $cek_sudah_absen = true;
                    $data_waktu = master_absen_bendahara::where("bendahara_id",session("id"))->whereNotIn("status_kehadiran",["a","i","s"])->where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->first();
                    $jam_masuk = Carbon::parse($data_waktu->waktu_masuk)->translatedFormat("H:i:s");
                    $jam_keluar = Carbon::parse($data_waktu->waktu_keluar)->translatedFormat("H:i:s");
                }
            }


            if(master_absen_bendahara::where("tgl_masuk",now()->format("Y-m-d"))->where("waktu_keluar",Carbon::parse("00:00:00")->translatedFormat("H:i:s"))->where("waktu_masuk",Carbon::parse("00:00:00")->translatedFormat("H:i:s"))->where("status_kehadiran","!=","a")->where("bendahara_id",session("id"))->exists()){
                $cek_sudah_absen_oleh_admin = true;
            }

            $awal_bulan = Carbon::now()->startOfMonth();
            $akhir_bulan = Carbon::now()->endOfMonth();
            $jumlah_hari_aktif = 0;
            $jumlah_tidak_hadir = 0;

            for ($data  = $awal_bulan->copy() ; $data <= $akhir_bulan; $data->addDays()){
                if (strtolower(Carbon::parse($data)->translatedFormat("l")) != "minggu"){
                    $jumlah_hari_aktif ++;
                    if (Carbon::parse($data)->translatedFormat("d") <= Carbon::now()->translatedFormat("d")){
                        if (master_absen_bendahara::where("bendahara_id",session("id"))->whereMonth("tgl_masuk",Carbon::now()->translatedFormat("m"))->whereDay("tgl_masuk",Carbon::parse($data)->translatedFormat("d"))->exists()){
                            if(master_absen_bendahara::where("bendahara_id",session("id"))->whereMonth("tgl_masuk",Carbon::now()->translatedFormat("m"))->whereDay("tgl_masuk",Carbon::parse($data)->translatedFormat("d"))->where("status_kehadiran","!=","h")->exists()){
                                $jumlah_tidak_hadir ++;
                            }
                        }else{
                            $jumlah_tidak_hadir ++;
                        }
                    }
                }
            }

            $keterlambatan_hari_ini = master_absen_bendahara::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->where("bendahara_id",session('id'))->exists() ? master_absen_bendahara::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->where("bendahara_id",session('id'))->first()->terlambat_menit ." menit" : "maaf anda belum absen";
            
            return view("modul/staf/bendahara/dashboard",[
                "data_bendahara" => $data_bendahara,
                "jumlah_ketidakhadiran" => $jumlah_tidak_hadir,
                "terlambat" => $keterlambatan_hari_ini,
                "latitude" => $lokasi_cabang->latitude,
                "longitude" => $lokasi_cabang->longitude,
                "nama_hari" => $nama_hari,
                "tanggal_hari_ini" => $tanggal_hari_ini,
                "cek_sudah_absen" => $cek_sudah_absen,
                "jam_masuk" => $jam_masuk,
                "status_absen" => $status_absen,
                "jam_keluar" => $jam_keluar,
                "cek_status_absen" => $cek_status_absen,
                "cek_sudah_absen_oleh_admin" => $cek_sudah_absen_oleh_admin,
                "cek_sudah_keluar" => $cek_sudah_keluar,
                "jumlah_hari_aktif" => $jumlah_hari_aktif,
            ]);
        }
        return redirect("/reg");
    }


    function tampilan_presensiAbsenBendahara(){
        Carbon::setLocale("id");
        $data_bendahara = bendahara::where("id",(int) session("id"))->first();
        $cabang = cabang_guru::find((int) $data_bendahara->cabang_id);
        $lokasi = master_lokasi_absen_guru::where("cabang_id",$cabang->id)->first();
        $waktu = master_waktu_absen_guru::where("cabang_id",$cabang->id)->where("hari",strtolower(Carbon::now()->translatedFormat("l")))->first();

        $tanggal_sekarang = Carbon::now()->translatedFormat("Y-m-d");
        $cek_tanggal_merah = tanggal_merah::where("tanggal",$tanggal_sekarang)->exists();
        $waktu_sekarang = Carbon::now();
        $waktu_keluar_absen = Carbon::parse($waktu->waktu_keluar);
        $sudah_absen = master_absen_bendahara::where("tgl_masuk",now()->format("Y-m-d"))->where("bendahara_id",session("id"))->where("status_kehadiran","!=","a")->exists(); 


        $cek_belum_pencet_tombol_keluar= master_absen_bendahara::where("waktu_masuk","!=",Carbon::parse("00:00:00")->translatedFormat("H:i:s"))->where("waktu_keluar",Carbon::parse("00:00:00")->translatedFormat("H:i:s"))->where("status_kehadiran","h")->where("bendahara_id",session("id"))->exists();
        $cek_absen_oleh_admin= master_absen_bendahara::where("tgl_masuk",now()->format("Y-m-d"))->where("waktu_keluar",Carbon::parse("00:00:00")->translatedFormat("H:i:s"))->where("waktu_masuk",Carbon::parse("00:00:00")->translatedFormat("H:i:s"))->where("status_kehadiran","!=","a")->where("bendahara_id",session("id"))->exists();
    
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
            $total_kehadiran = master_absen_bendahara::where("status_kehadiran","h")->where("bendahara_id",session("id"))->whereMonth("tgl_masuk",Carbon::now()->translatedFormat("m"))->count();
            $total_lambat = master_absen_bendahara::where("status_kehadiran","h")->where("bendahara_id",session("id"))->whereMonth("tgl_masuk",Carbon::now()->translatedFormat("m"))->where("terlambat_menit","!=",0)->count();
            return view("modul/staf/bendahara/presensi_absen",["lokasi" => $lokasi,"cabang" => $cabang,"total_kehadiran" => $total_kehadiran,"total_lambat" => $total_lambat]);
        }

        return redirect("/reg");
    }

    function absen_MasukBendahara(){
        Carbon::setLocale("id");
        $cek_data_bendahara = master_absen_bendahara::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->where("bendahara_id",session("id"))->exists();
        if (!$cek_data_bendahara){
            Carbon::setLocale("id");
            $data_bendahara = bendahara::find((int) session("id"));
            $hari = Carbon::now()->translatedFormat("l");
            $waktu_absen = Carbon::now();
            $waktu_jadwal = Carbon::parse(master_waktu_absen_guru::where("cabang_id",$data_bendahara->cabang_id)->where("hari",strtolower($hari))->first()->waktu_masuk);
            $terlambat = $waktu_jadwal->diffInMinutes($waktu_absen);
            if (!$waktu_absen->greaterThan($waktu_jadwal)){
                $terlambat = 0;
            }
            master_absen_bendahara::create([
                "waktu_masuk" => now()->format("H:i:s"),
                "waktu_keluar" => Carbon::parse("00:00:00"),
                "tgl_masuk" => now()->format("Y:m:d"),
                "status_kehadiran" => "a",
                "terlambat_menit" => $terlambat,
                "cabang_id" => cabang_guru::find(bendahara::find((int) session("id"))->cabang_id)->id,
                "bendahara_id" => session("id"),
                "lokasi_id" => 1,
                "waktu_id" => master_waktu_absen_guru::where("cabang_id",$data_bendahara->cabang_id)->where("hari",strtolower($hari))->first()->id
            ]);

            return redirect("/gr/totp");
        }
        
        return redirect("/gr/totp");
    }
}
