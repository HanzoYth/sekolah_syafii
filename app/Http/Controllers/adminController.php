<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use Illuminate\Support\Carbon;

class adminController extends Controller
{
    function tampilan_formulirAdmin(){
        return view("modul/guru/formulir_admin");
    }

    function tambahDataAdmin(Request $request){
        admin::create([
            "nama" => $request->nama,
            "nig" => $request->nig,
            "tempat_lahir" => $request->tempat_lahir ,
            "tanggal_lahir" => Carbon::parse($request->tanggal_lahir)->translatedFormat("Y-m-d"),
            "agama" => "islam",
            "alamat" => $request->alamat,
            "pendidikan_terakhir" => $request->pendidikan_terakhir,
            "url_foto" => $request->url_foto,
            "user_id" => (int) session("id_akun")
        ]);
        $data_admin = admin::where("nig",$request->nig)->first();
        session()->put("id",$data_admin->id);
        session()->put("nama",$data_admin->nama);

        return redirect("/mod");
    }
}
