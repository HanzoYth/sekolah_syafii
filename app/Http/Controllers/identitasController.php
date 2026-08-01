<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\identitas_rahasia;

class identitasController extends Controller
{
    function tampilan_identitas(){
        $jumlah = identitas_rahasia::all();
        return view("identitas",["jumlah" => count($jumlah)]);
    }

    function add_identitas(Request $request){
        identitas_rahasia::create([
            "jenis_role" => $request->role_type,
            "identitas" => $request->kode_identitas,
            "aktif" => 0,
        ]);

        return redirect("/idnt");
    }
}
