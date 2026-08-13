<?php

namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\master_absen_guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\otp_guru;
use Carbon\Carbon;
use App\Services\FonteService;

class otpController extends Controller
{
    function tampilanOtp(){
        if (session("hasLogin")){
            return view("auth/otp");
        }
        return redirect("/reg");
    }

    function createOtp(){
        if (otp_guru::where("guru_id",session("id"))->exists()){
            otp_guru::where("guru_id",session("id"))->delete();
        }

        $data_guru = guru::where("id",session('id'))->first();
        
        $kode = random_int(100000,999999);
        otp_guru::create([
            "kode_otp" => $kode,
            "otp_expired_at" => now()->addMinute(5),
            "guru_id" => session("id")
        ]);

        $foonte = new FonteService();
        $foonte->sendMassage($data_guru->getUser()->first()->noWa,"ini kode Otp anda ($kode) jangan di perlihatkan oleh orang lain");
        

        return redirect("/gr/totp");
    }

    function cekOtp(Request $request){
        $otp_d = otp_guru::where("guru_id",session('id'))->first();
        $absensi_guru = master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->where("guru_id",session("id"))->first();
        if ($request->otp != $otp_d->kode_otp){
            return back();
        }

        $absensi_guru->status_kehadiran = "h";
        $absensi_guru->save();
        return redirect("/gr/das");
    }


}
