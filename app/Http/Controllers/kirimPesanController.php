<?php

namespace App\Http\Controllers;

use App\Models\guru;
use App\Services\FonteService;
use Illuminate\Http\Request;

class kirimPesanController extends Controller
{
    function kirim_pesanPengingat($id){
        $data_guru = guru::where("id",$id)->first();
        $foonte = new FonteService();
        $foonte->sendMassage(
            $data_guru->getUser()->first()->noWa,
            "Tolong melakukan absen saat sudah di kawasan sekolah"
        );

        return back()->with("success","berhasil mengirim pesan ke ".$data_guru->nama);
    }
}
