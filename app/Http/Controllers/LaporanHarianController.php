<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanHarianController extends Controller
{
    function laporan_harian (){
        return view('/modul/tahfiz/laporanharian');
    }
}
