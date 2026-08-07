<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dataSiswaController extends Controller
{
    function data_siswa(){
        return view ('/modul/siakad/datasiswa');
    }
}
