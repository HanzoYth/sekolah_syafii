<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tahfizController extends Controller
{
    function tampilan_Tahfiz(){
        return view("modul/tahfiz/pengumuman");
    }
}
