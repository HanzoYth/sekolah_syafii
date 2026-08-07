<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dataWalasController extends Controller
{
    function data_walas(){
        return view ('/modul/siakad/datawalas');
    }
}
