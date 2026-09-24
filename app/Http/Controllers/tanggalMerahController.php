<?php

namespace App\Http\Controllers;

use App\Models\cabang_guru;
use App\Models\guru;
use App\Models\master_absen_guru;
use App\Models\master_lokasi_absen_guru;
use App\Models\master_waktu_absen_guru;
use App\Models\tanggal_merah;
use Carbon\Carbon;
use Illuminate\Http\Request;


class tanggalMerahController extends Controller
{
    function tampilan_tanggalMerah(){
        $data_tanggal_merah = tanggal_merah::all();
        $data_cabang = cabang_guru::where("aktif",1)->get();
        return view("modul/guru/a/atur_tanggal_merah",["tanggal_merah" => $data_tanggal_merah,"cabang" => $data_cabang,"nomor" => 0]);
    }

    function tambahTanggalMerah(Request $request){
        Carbon::setLocale("id");
        if (!tanggal_merah::where("tanggal",Carbon::parse($request->tanggal)->translatedFormat("Y-m-d"))->exists()){
            $data_cabang_aktif = cabang_guru::where("aktif",1)->get();
            $data_tanggal_merah_cabang = tanggal_merah::where("tanggal",Carbon::parse($request->tanggal)->translatedFormat("Y-m-d"))->pluck("cabang_id");
            if ($request->cabang_id == "all"){
                foreach($data_cabang_aktif as $value){
                    if (in_array($value->id,$data_tanggal_merah_cabang->toArray())) continue;
                    tanggal_merah::create([
                        "tanggal" => Carbon::parse($request->tanggal)->translatedFormat("Y-m-d"),
                        "keterangan" => $request->nama_libur,
                        "cabang_id" => $value->id
                    ]);
                    foreach(guru::where("cabang_id",$value->id)->get() as $data_guru){
                        $data_waktu = master_waktu_absen_guru::where("cabang_id",$value->id)->where("hari",strtolower(Carbon::parse($request->tanggal)->translatedFormat("l")))->first();
                        $data_lokasi = master_lokasi_absen_guru::where("cabang_id",$value->id)->first();
                        master_absen_guru::create([
                            "waktu_masuk" => Carbon::parse("00:00:00"),
                            "waktu_keluar" => Carbon::parse("00:00:00"),
                            "tgl_masuk" => Carbon::parse($request->tanggal)->translatedFormat("Y-m-d"),
                            "status_kehadiran" => "h",
                            "terlambat_menit" => 0,
                            "cabang_id" => $value->id,
                            "guru_id" => $data_guru->id,
                            "lokasi_id" => $data_lokasi->id,
                            "waktu_id" => $data_waktu->id 
                        ]);
                    }
                }
                return back();
            }
            tanggal_merah::create([
                "tanggal" => Carbon::parse($request->tanggal)->translatedFormat("Y-m-d"),
                "keterangan" => $request->nama_libur,
                "cabang_id" => (int) $request->cabang_id
            ]);
            foreach(guru::where("cabang_id",(int) $request->cabang_id)->get() as $data_guru){
                $data_waktu = master_waktu_absen_guru::where("cabang_id",(int) $request->cabang_id)->where("hari",strtolower(Carbon::parse($request->tanggal)->translatedFormat("l")))->first();
                $data_lokasi = master_lokasi_absen_guru::where("cabang_id",(int) $request->cabang_id)->first();
                master_absen_guru::create([
                    "waktu_masuk" => Carbon::parse("00:00:00"),
                    "waktu_keluar" => Carbon::parse("00:00:00"),
                    "tgl_masuk" => Carbon::parse($request->tanggal)->translatedFormat("Y-m-d"),
                    "status_kehadiran" => "h",
                    "terlambat_menit" => 0,
                    "cabang_id" => (int) $request->cabang_id,
                    "guru_id" => $data_guru->id,
                    "lokasi_id" => $data_lokasi->id,
                    "waktu_id" => $data_waktu->id 
                ]);
            }
    
            return back()->with("success","berhasil tambah tanggal merah");
        }
        return back()->with("eror","tanggal merah sudah tersedia");
    }

    function editTanggalMerah(Request $request,$id){
        $data_tanggal_merah = tanggal_merah::find((int) $id);


        foreach(guru::where("cabang_id",$data_tanggal_merah->cabang_id)->get() as $data_guru){
            $data_absen = master_absen_guru::where("guru_id",$data_guru->id)->where("tgl_masuk",Carbon::parse($data_tanggal_merah->tanggal)->translatedFormat("Y-m-d"))->first();
            $data_absen->tgl_masuk = $request->tanggal;
            $data_absen->save();
        }

        $data_tanggal_merah->tanggal = $request->tanggal;
        $data_tanggal_merah->keterangan =  $request->nama_libur;
        $data_tanggal_merah->save();

        return back()->with("success","berhasil edit tanggal merah");
    }

    function hapusTanggalMerah($id){
        $data_tanggal_merah = tanggal_merah::find((int) $id);
        foreach(guru::where("cabang_id",(int) $data_tanggal_merah->cabang_id)->get() as $data_guru){
            $data_absen = master_absen_guru::where("guru_id",$data_guru->id)->where("tgl_masuk",Carbon::parse($data_tanggal_merah->tanggal)->translatedFormat("Y-m-d"))->first();
            $data_absen->delete();
        }
        tanggal_merah::destroy((int) $id);

        return back()->with("success","berhasil hapus tanggal merah");
    }
}
