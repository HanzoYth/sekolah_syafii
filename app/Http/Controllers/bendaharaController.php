<?php

namespace App\Http\Controllers;

use App\Models\bendahara;
use App\Models\cabang_guru;
use App\Models\gaji_bendahara;
use App\Models\jadwal_piket;
use App\Models\master_absen_bendahara;
use App\Models\master_lokasi_absen_guru;
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
            "bendahara_id" => $id
        ]);
    }

    function tampilan_FormulirBendahara(){
        $cabang = cabang_guru::all();
        return view("modul/guru/formulir_bendahara",compact("cabang"));
    }
    function tampilan_dashboardGuru(){
        if (session("hasLogin")){
            Carbon::setLocale("id");
            $data_bendahara = bendahara::where("id",session("id"))->first();
            $nama_hari = Carbon::now()->translatedFormat("l");
            $tanggal_hari_ini = Carbon::now()->translatedFormat("d M Y");
            $bulan = Carbon::now()->translatedFormat("m");
            $jumlah_kehadiran_bulanan = master_absen_bendahara::whereMonth("tgl_masuk",$bulan)->where("bendahara_id",session("id"))->where("status_kehadiran","h")->count();
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
                    $data_waktu = master_absen_bendahara::where("guru_id",session("id"))->whereNotIn("status_kehadiran",["a","i","s"])->where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->first();
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

            for ($data  = $awal_bulan->copy() ; $data <= $akhir_bulan; $data->addDays()){
                if (strtolower(Carbon::parse($data)->translatedFormat("l")) != "minggu"){
                    $jumlah_hari_aktif ++;
                }
            }

            
            return view("modul/guru/g/dashboard",[
                "data_guru" => $data_bendahara,
                "jumlah_kehadiran_bulanan" => $jumlah_kehadiran_bulanan,
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
}
