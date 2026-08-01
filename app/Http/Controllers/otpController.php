<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\otp_guru;
use Illuminate\Support\Facades\Mail;

class otpController extends Controller
{
    function tampilanOtp(){
        if (session("hasLogin")){
            return view("auth/otp");
        }
        return redirect("/reg");
    }

    function createOtp(Request $request){
        if (otp_guru::where("guru_id",session("id"))->exists()){
            otp_guru::where("guru_id",session("id"))->delete();
        }
        
        $kode = random_int(100000,999999);
        otp_guru::create([
            "kode_otp" => $kode,
            "otp_expired_at" => now()->addMinute(5),
            "guru_id" => $request->id
        ]);

        Mail::raw(
            "Kode OTP absensi Anda adalah: {$kode}\n\nKode ini berlaku selama 5 menit.",
            function ($message) use ($kode) {
                $message->to("ainunmrdh015@gmail.com")
                        ->subject('Kode OTP Absensi');
            }
        );
        return redirect("/gr/totp");
    }

    function cekOtp(Request $request){
        $otp_d = otp_guru::where("guru_id",session('id'))->first();

        if ($request->otp != $otp_d->kode_otp){
            return back();
        }
        return redirect("/gr/acabs");
    }


}
