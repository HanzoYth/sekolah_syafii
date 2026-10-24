<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function tampilan_welcome(){
        return view("welcome");
    }

    function tampilan_modul(){
        if (session("hasLogin")){
            return view("modul/modul");
        }
        return redirect("/reg");
    }

    function tampilan_profile_sekolah(Request $request){
        $halaman = strtolower((string) $request->query('halaman', 'profil'));

        return match ($halaman) {
            'program', 'pendidikan', 'akademik' => view("halaman_program"),
            'galeri', 'kegiatan', 'prestasi'    => view("halaman_galeri"),
            'ppdb', 'pendaftaran'               => view("halaman_ppdb"),
            'kontak', 'lokasi'                  => view("halaman_kontak"),
            default                             => view("profile_sekolah"),
        };
    }

    function tampilan_program(){
        return view("halaman_program");
    }

    function tampilan_galeri(){
        return view("halaman_galeri");
    }

    function tampilan_ppdb(){
        return view("halaman_ppdb");
    }

    function tampilan_kontak(){
        return view("halaman_kontak");
    }
}
