<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class modulSiakadController extends Controller
{
      function dashboard_siakad(){
        return view('/modul/siakad/dasboard');
      }

}
