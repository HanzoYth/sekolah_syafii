<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function tampilan_welcome(){
        return view("welcome");
    }

    function tampilan_modul(){
        if (session("hasLogin")){
            return view("modul/modul");
        }
        return redirect("/reg");
    }

}
