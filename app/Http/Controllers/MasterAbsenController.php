<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\master_absen_guru;
use App\Models\master_lokasi_absen_guru;
use App\Models\master_waktu_absen_guru;
use App\Models\cabang_guru;
use App\Models\guru;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class MasterAbsenController extends Controller
{

    function tampilan_kelolaAbsenGuru(){
        $data_guru = guru::all();
        $data_absen_id_guru_hari_ini = master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->pluck("guru_id")->toArray();
        return view("modul/guru/a/kelola_absen_guru",[
            "data_guru" => $data_guru,
            "data_absen_id_guru" => $data_absen_id_guru_hari_ini
        ]);
    }

    function SettingAbsenGuru(Request $request,$id) {
        $cabang = cabang_guru::find((int) $id);
        $lokasi = master_lokasi_absen_guru::where("cabang_id",(int) $id)->first();
        $waktu = master_waktu_absen_guru::where("cabang_id",(int) $id)->get();
        $masuk = [
            $request->jam_masuk_senin,
            $request->jam_masuk_selasa,
            $request->jam_masuk_rabu,
            $request->jam_masuk_kamis,
            $request->jam_masuk_jumat,
            $request->jam_masuk_sabtu,
            $request->jam_masuk_minggu,
        ];
        $keluar = [
            $request->jam_keluar_senin,
            $request->jam_keluar_selasa,
            $request->jam_keluar_rabu,
            $request->jam_keluar_kamis,
            $request->jam_keluar_jumat,
            $request->jam_keluar_sabtu,
            $request->jam_keluar_minggu,
        ];

        // ini untuk lokasi
        $lokasi->nama_lokasi = $request->nama_lokasi;
        $lokasi->radius = $request->radius;
        $lokasi->latitude = $request->latitude;
        $lokasi->longitude = $request->longitude;
        $lokasi->current_at = now();

        //ini untuk cabang
        $cabang->nama_cabang = $request->nama_cabang;

        //ini untuk waktu
        for ($i=0;$i < count($waktu);$i++){
            $waktu[$i]->waktu_masuk = $masuk[$i];
            $waktu[$i]->waktu_keluar = $keluar[$i];
            $waktu[$i]->current_at = now();
            $waktu[$i]->save();
        }
        $lokasi->save();
        $cabang->save();
            
        return back();
    }

    function addAbsenGuru(){
        Carbon::setLocale("id");
        $data_guru = guru::find((int) session("id"));
        $hari = Carbon::now()->translatedFormat("l");
        $waktu_absen = Carbon::now();
        $waktu_jadwal = Carbon::parse(master_waktu_absen_guru::where("cabang_id",$data_guru->cabang_id)->where("hari",strtolower($hari))->first()->waktu_masuk);
        $terlambat = $waktu_jadwal->diffInMinutes($waktu_absen);
        
        if (!$waktu_absen->greaterThan($waktu_jadwal)){
            $terlambat = 0;
        }

        master_absen_guru::create([
            "waktu_masuk" => now()->format("H:i:s"),
            "waktu_keluar" => Carbon::parse("00:00:00"),
            "tgl_masuk" => now()->format("Y:m:d"),
            "status_kehadiran" => "a",
            "terlambat_menit" => $terlambat,
            "cabang_id" => cabang_guru::find(guru::find((int) session("id"))->cabang_id)->id,
            "guru_id" => session("id"),
            "lokasi_id" => 1,
            "waktu_id" => master_waktu_absen_guru::where("cabang_id",$data_guru->id)->where("hari",strtolower($hari))->first()->id
        ]);

        return redirect("/gr/otp");
    }

    function addAbsenGuruDenganKelola(Request $request){
        Carbon::setLocale("id");
        $data_id_guru = guru::all()->pluck("id")->toArray();
        $data_id_guru_master_absen = master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->pluck("guru_id")->toArray();
        foreach($data_id_guru as $id){  
            $data_guru = guru::find((int) $request->input("id_guru_{$id}"));
            $data_cabang = cabang_guru::where("id",(int) $data_guru->cabang_id)->first();
            $data_waktu = master_waktu_absen_guru::where("cabang_id",$data_cabang->id)->where("hari",strtolower(Carbon::now()->translatedFormat("l")))->first();
            $data_lokasi = master_lokasi_absen_guru::where("cabang_id",$data_cabang->id)->first();
            if (in_array($id,$data_id_guru_master_absen)){
                $data = master_absen_guru::where("guru_id",$id)->first();
                $data->tgl_masuk = Carbon::now()->translatedFormat("Y-m-d");
                $data->status_kehadiran = $request->input("status_{$id}");
                $data->save();
            }else{
                master_absen_guru::create([
                    "waktu_masuk" => Carbon::now()->translatedFormat("H:i:s"),
                    "waktu_keluar" => Carbon::parse("00:00:00"),
                    "tgl_masuk" => Carbon::now()->translatedFormat("Y-m-d"),
                    "status_kehadiran" => $request->input("status_{$id}"),
                    "terlambat_menit" => 0,
                    "cabang_id" => $data_cabang->id,
                    "guru_id" => $data_guru->id,
                    "lokasi_id" => $data_lokasi->id,
                    "waktu_id" => $data_waktu->id 
                ]);
            }
            return back();
        }
    }


    function keluarAbsenGuru(){
        $data = master_absen_guru::where("guru_id",session("id"))->where("tgl_masuk",now()->format("Y-m-d"))->first();

        $waktu_sekarang = Carbon::now();
        if(!$waktu_sekarang->greaterThan(Carbon::parse(master_waktu_absen_guru::where("id",now()->dayOfWeekIso)->first()->waktu_keluar))){
            return back()->with("eror","maaf belum waktunya pulang");
        }


        $data->waktu_keluar = $waktu_sekarang;
        $data->save();

        return redirect("/gr/das");
    }

}
