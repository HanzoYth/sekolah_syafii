<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dataSiswaController extends Controller
{
    function data_siswa(){
        return view ('/modul/siakad/datasiswa');
    }
    function detail_siswa(){
        return view ('/modul/siakad/detailSiswa');
    }
    function edit_siswa(){
        return view ('/modul/siakad/editSiswa');
    }
    
}
