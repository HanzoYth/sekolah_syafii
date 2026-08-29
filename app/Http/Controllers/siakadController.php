<?php

namespace App\Http\Controllers;

use App\Models\slip_pembayaran_ipp;
use Illuminate\Http\Request;

class siakadController extends Controller
{
    function tampilanPembayaran_siswa(){
        $data_slip_ipp = slip_pembayaran_ipp::all();
        return view ('/modul/siakad/pembayaran',[
            "data_slip_ipp" => $data_slip_ipp
        ]);
    }
    function edit_slipPembayaranIppSiswa(Request $request){
        
    }
}
