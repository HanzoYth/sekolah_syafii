<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengampuController extends Controller
{
    function pengampu(){
        return view('/modul/tahfiz/pengampu');
    }
}
