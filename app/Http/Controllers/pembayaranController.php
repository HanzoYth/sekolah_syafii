<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pembayaranController extends Controller
{
    function detail_pembayaran_siswa(){
        return view ('/modul/siakad/detailPembayaran');
    }
    
    function pembayaran_pangkal(){
        return view ('/modul/siakad/pangkal');
    }
    
}
