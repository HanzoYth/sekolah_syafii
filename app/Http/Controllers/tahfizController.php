<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tahfizController extends Controller
{

    #admin
    function dash_guru(){
        return view("modul/tahfiz/guru/dashboard");
    }
    function riwayat_laporan(){
        return view("modul/tahfiz/guru/riwayat");
    }
    function Halaqah_saya(){
        return view("modul/tahfiz/guru/Halaqah_saya");
    }
    function profil_siswa(){
        return view("modul/tahfiz/guru/siswa");
    }
    function laporan(){
        return view("modul/tahfiz/guru/inputlaporan");
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

