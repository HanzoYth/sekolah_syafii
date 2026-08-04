<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class modulTahfidzController extends Controller
{
    function dashboard_tahfidz (){
        return view('/modul/tahfiz/dashboard');
    }
}
