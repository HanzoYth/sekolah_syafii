<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    function notifikasi (){
        return view('/modul/tahfiz/notifikasi');
    }
}
