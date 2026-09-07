<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dataSiswaController extends Controller
{
    function edit_siswa(){
        return view ('/modul/siakad/editSiswa');
    }
    
}
