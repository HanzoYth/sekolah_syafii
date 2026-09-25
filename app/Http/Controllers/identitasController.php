<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\identitas_rahasia;

class identitasController extends Controller
{
    function tampilan_identitas(){
        $to_data = 0;
        if (identitas_rahasia::count() != 0){
            $identitas = identitas_rahasia::orderBy("id","desc")->first()->identitas;
            $data = explode("-",$identitas)[1];
            $to_data = ltrim($data,"0");
        }
        return view("identitas",["jumlah" => (int) $to_data]);
    }

    function add_identitas(Request $request){
        identitas_rahasia::create([
            "jenis_role" => $request->role_type,
            "identitas" => $request->kode_identitas,
            "aktif" => 0,
        ]);

        return back()->with("success","berhasil tambah kode");
    }

    function ambil_DataIdentitas($role){
        $data_identitas = identitas_rahasia::where("jenis_role",$role)->get();

        return response()->json($data_identitas);
    }

    function hapus_DataIdentitas($id){
        $data_identitas = identitas_rahasia::where("id",$id)->first();
        $data_identitas->delete();

        return back()->with("success","berhasil hapus kode");
    }
}
