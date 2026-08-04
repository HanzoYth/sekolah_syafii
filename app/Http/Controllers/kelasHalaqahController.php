<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kelasHalaqahController extends Controller
{
     function kelas_halaqah (){
        return view('/modul/tahfiz/kelashalaqah');
    }
}
