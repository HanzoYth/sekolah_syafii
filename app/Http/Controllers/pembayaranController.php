<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pembayaranController extends Controller
{
     function pembayaran_siswa(){
        return view ('/modul/siakad/pembayaran');
    }
    function detail_pembayaran_siswa(){
        return view ('/modul/siakad/detailPembayaran');
    }
}
