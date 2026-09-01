<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\slip_pembayaran_ipp;
use App\Models\slip_pembayaran_pangkal;
use App\Models\slip_pembayaran_pendidikan;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class siakadController extends Controller
{
    function tampilanBuatTagihan_Siswa(){
        $data_siswa = siswa::all();
        return view("/modul/siakad/buatTagihan",[
            "data_siswa" => $data_siswa
        ]);
    }
   
    function tampilan_pendidikan(){
       return view("/modul/siakad/pendidikan");
       
    }

    function tambahTagihan_Siswa(Request $request){
        if ($request->jenis_pembayaran == "ipp"){
            $data_awal_bulan = Carbon::parse($request->tanggal_mulai)->startOfMonth();
            $data_akhir_bulan = Carbon::parse($request->tanggal_akhir)->startOfMonth();
            while ($data_awal_bulan->lte($data_akhir_bulan)){
                slip_pembayaran_ipp::create([
                    "nominal" => $request->nominal,
                    "tanggal_awal" => $data_awal_bulan,
                    "tanggal_akhir" => $request->tanggal_akhir,
                    "siswa_id" => $request->siswa_id
                ]);

                $data_awal_bulan->addMonth();
            }
        }elseif ($request->jenis_pembayaran == "pangkal"){
            slip_pembayaran_pangkal::create([
                "nominal" => $request->nominal,
                "siswa_id" => $request->siswa_id
            ]);
        }else{
            slip_pembayaran_pendidikan::create([
                "nominal" => $request->nominal,
                "siswa_id" => $request->siswa_id
            ]);
        }
        return back()->with("success","berhasil buat tagihan");
    }

    function tampilanPembayaranIpp_siswa(){
        $data_slip_ipp = slip_pembayaran_ipp::all();
        return view ('/modul/siakad/pembayaran',[
            "data_slip_ipp" => $data_slip_ipp
        ]);
    }
    function edit_slipPembayaranIppSiswa(Request $request){
        
    }
    function pengumumanSiswa (){
        return view('/modul/siakad/pengumumanSiswa');
    }
    function edit_slipPembayaranIpp(Request $request)
    {
        $data_slip = slip_pembayaran_ipp::where('id',$request->id)->first();
        $data_slip->tanggal_awal = Carbon::parse($request->tanggal_awal)->translatedFormat("Y-m-d");
        $data_slip->nominal = $request->nominal;
        $data_slip->status = $request->status == '0' ? false : true;
        $data_slip->save();
        return back()->with('success','berhasil edit pembayaran');
    }
}
