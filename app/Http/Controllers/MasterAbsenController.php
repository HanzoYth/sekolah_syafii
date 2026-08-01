<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\master_absen_guru;
use App\Models\master_lokasi_absen_guru;
use App\Models\master_waktu_absen_guru;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class MasterAbsenController extends Controller
{
    function SettingAbsenGuru(Request $request) {
        $lokasi = master_lokasi_absen_guru::find(1);
        $waktu = master_waktu_absen_guru::all();
        $masuk = [
            $request->jam_masuk_senin,
            $request->jam_masuk_selasa,
            $request->jam_masuk_rabu,
            $request->jam_masuk_kamis,
            $request->jam_masuk_jumat,
            $request->jam_masuk_sabtu,
        ];
        $keluar = [
            $request->jam_keluar_senin,
            $request->jam_keluar_selasa,
            $request->jam_keluar_rabu,
            $request->jam_keluar_kamis,
            $request->jam_keluar_jumat,
            $request->jam_keluar_sabtu,
        ];

        // ini untuk lokasi
        $lokasi->nama_lokasi = $request->nama_lokasi;
        $lokasi->radius = $request->radius;
        $lokasi->latitude = $request->latitude;
        $lokasi->longitude = $request->longitude;
        $lokasi->current_at = now();

        $lokasi->save();

        for ($i=0;$i < count($waktu);$i++){
            $waktu[$i]->waktu_masuk = $masuk[$i];
            $waktu[$i]->waktu_keluar = $keluar[$i];
            $waktu[$i]->current_at = now();
            $waktu[$i]->save();
        }

        return redirect("/gr/sta");
    }

    function addAbsenGuru(){
        $hari = now()->dayOfWeekIso;
        $waktu_absen = Carbon::now();
        $waktu_jadwal = Carbon::parse(master_waktu_absen_guru::find($hari)->waktu_masuk);
        
        $terlambat = $waktu_jadwal->diffInMinutes($waktu_absen);
        
        if (!$waktu_absen->greaterThan($waktu_jadwal)){
            $terlambat = 0;
        }

        master_absen_guru::create([
            "waktu_masuk" => now()->format("H:i:s"),
            "waktu_keluar" => Carbon::parse("00:00:00"),
            "tgl_masuk" => now()->format("Y:m:d"),
            "status_kehadiran" => "h",
            "terlambat_menit" => $terlambat,
            "guru_id" => session("id"),
            "lokasi_id" => 1,
            "waktu_id" => $hari
        ]);

        return redirect("/gr/das");
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
