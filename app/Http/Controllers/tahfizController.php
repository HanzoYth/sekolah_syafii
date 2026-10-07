<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tahfizController extends Controller
{
    function pengumuman(){
        return view("modul/tahfiz/pengumuman");
    }
    function siswa_tahfiz(){
        return view("modul/tahfiz/siswatahfiz");
    }
    function laporan_harian(){
        return view("modul/tahfiz/laporanharian");
    }
    
    function rekap_mgg(){
        return view("modul/tahfiz/rekapmingguan");
    
    }
    function rekap_bln(){
        return view("modul/tahfiz/rekapbulanan");
    }
    function pengampu(){
        return view("modul/tahfiz/pengampu");
    }
    
}
