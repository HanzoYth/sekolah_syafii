<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    function notifikasi (){
        return view('/modul/tahfiz/notifikasi');
    }

public function tandaiBaca($id) {
    Notifikasi::where('id', $id)->update(['is_read' => true]);
    return response()->json(['status' => 'ok']);
}
}
