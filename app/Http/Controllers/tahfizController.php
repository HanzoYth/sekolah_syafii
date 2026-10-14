<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tahfizController extends Controller
{

    #admin
    function dash_admin(){
        return view("modul/tahfiz/admin/dashboard");
    }
    function manajemen_siswa(){
        return view("modul/tahfiz/admin/manajemen");
    }
    function manajemen_guru(){
        return view("modul/tahfiz/admin/manajemen_gr");
    }
    function monitoring(){
        return view("modul/tahfiz/admin/monitoring");
    }
    function laporan(){
        return view("modul/tahfiz/admin/laporan");
    }
    #guru
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
    function input_setoran(){
        return view("modul/tahfiz/inputsetoran");
    }

    #siswa
    function dashboard_siswa(){
        return view("modul/tahfiz/siswa/dasboard");
    }
    function progres_hafalan(){
        return view("modul/tahfiz/siswa/progres");
    }

    
    
}

