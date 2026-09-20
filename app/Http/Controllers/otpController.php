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
    function tampilan_otp(){
        return view("auth/otp");
    }

    function createOtp(){
        if (otp_guru::where("guru_id", session("id"))->exists()) {
            otp_guru::where("guru_id", session("id"))->delete();
        }

        $data_guru = guru::where("id", session('id'))->first();

        do {
            $kode = random_int(100000, 999999); //992012
        } while (otp_guru::where("kode_otp", $kode)->exists());

        $expiredAt = now()->addMinutes(2); // samain sama durasi timer 01:59 di view

        otp_guru::create([
            "kode_otp"       => $kode,
            "otp_expired_at" => $expiredAt,
            "guru_id"        => session("id"),
        ]);

        $foonte = new FonteService();
        $foonte->sendMassage(
            $data_guru->getUser()->first()->noWa,
            "ini kode Otp anda ($kode) jangan di perlihatkan oleh orang lain"
        );

        return response()->json([
            "kode_otp"   => $kode,
            "expired_in" => now()->diffInSeconds($expiredAt), // sisa detik
        ]);
    }


    function cekOtp(Request $request){
        $otp_d = otp_guru::where("guru_id",session('id'))->first();
        $absensi_guru = master_absen_guru::where("tgl_masuk",Carbon::now()->translatedFormat("Y-m-d"))->where("guru_id",session("id"))->first();
        if ($request->otp != $otp_d->kode_otp){
            return back()->with("eror","kode otp salah");
        }

        $absensi_guru->status_kehadiran = "h";
        $absensi_guru->save();
        return redirect("/gr/das");
    }


}
