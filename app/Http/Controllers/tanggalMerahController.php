<?php

namespace App\Http\Controllers;

use App\Models\cabang_guru;
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
            }
            return back();
        }
        tanggal_merah::create([
            "tanggal" => Carbon::parse($request->tanggal)->translatedFormat("Y-m-d"),
            "keterangan" => $request->nama_libur,
            "cabang_id" => (int) $request->cabang_id
        ]);

        return back();
    
    }

    function editTanggalMerah(Request $request,$id){
        $data_tanggal_merah = tanggal_merah::find((int) $id);

        $data_tanggal_merah->tanggal = $request->tanggal;
        $data_tanggal_merah->keterangan =  $request->nama_libur;
        $data_tanggal_merah->cabang_id = (int) $request->cabang_id;

        $data_tanggal_merah->save();

        return back();
    }

    function hapusTanggalMerah($id){
        tanggal_merah::destroy((int) $id);

        return back();
    }
}
