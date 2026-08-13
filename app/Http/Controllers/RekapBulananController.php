<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapBulananController extends Controller
{
    function rekap_bulanan (){
        return view('/modul/tahfiz/rekapbulanan');
    }
}
