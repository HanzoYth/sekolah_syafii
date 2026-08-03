<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cabang_guru;
use App\Models\master_lokasi_absen_guru;
use App\Models\master_waktu_absen_guru;
use Carbon\Carbon;

class cabangGuruController extends Controller
{
    function tampilanCabangGuru(){
        $jumlah = cabang_guru::count();
        $data = cabang_guru::all();
        $no = 1;
        return view("modul/guru/a/tambah_cabang",[
            "jumlah" => $jumlah,
            "data" => $data,
            "no" => $no
        ]);
    }

    function TambahCabang(Request $request){
        cabang_guru::create([
            "nama_cabang" => $request->nama_cabang
        ]);
        master_lokasi_absen_guru::create([
            "nama_lokasi" => "sekolah",
            "radius" => 100,
            "latitude" => -0.8888921542202785,
            "longitude" => 119.85032280828936,
            "current_at" => now(),
            "cabang_id" => cabang_guru::where("nama_cabang",$request->nama_cabang)->first()->id,
        ]);

        $hari = ["senin","selasa","rabu","kamis","jumat","sabtu","minggu"];

        for ($i = 0; $i < count($hari) ;$i++){
            master_waktu_absen_guru::create([
                "hari" => $hari[$i],
                "waktu_masuk" => $i == 6 ? Carbon::parse("00:00:00")->translatedFormat("H:i:s"): Carbon::parse("07:00:00")->translatedFormat("H:i:s"),
                "waktu_keluar" => $i == 6 ? Carbon::parse("00:00:00")->translatedFormat("H:i:s"): Carbon::parse("14:00:00")->translatedFormat("H:i:s"),
                "current_at" => now(),
                "cabang_id" => cabang_guru::where("nama_cabang",$request->nama_cabang)->first()->id,
            ]);
        }
        return redirect("/gr/cb");
    }

    function nonAktikanCabang($id){
        $data_cabang = cabang_guru::find($id);
        $data_cabang->aktif = !$data_cabang->aktif;
        $data_cabang->save();

        return back();
    }
}
