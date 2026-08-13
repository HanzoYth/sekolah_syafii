<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapMingguanController extends Controller
{
    function rekap_mingguan (){
        return view('/modul/tahfiz/rekapmingguan');
    }
}
