<?php

namespace App\Http\Controllers;

use App\Models\ruang_kelas;
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
    function tambah_kelas(){
       return view("/modul/siakad/tambahKelas");
       
    }

    function tambahTagihan_Siswa(Request $request){
        if ($request->jenis_pembayaran == "ipp"){
            $data_awal_bulan = Carbon::parse($request->tanggal_mulai)->startOfMonth();
            $data_akhir_bulan = Carbon::parse($request->tanggal_akhir)->startOfMonth();
            while ($data_awal_bulan->lte($data_akhir_bulan)){
                slip_pembayaran_ipp::create([
                    "nominal" => $request->nominal,
                    "tanggal_awal" => $data_awal_bulan,
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
        $data_slip_ipp = slip_pembayaran_ipp::paginate(4);
        $data_kelas = ruang_kelas::all();
        return view ('/modul/siakad/pembayaran',[
            "data_slip_ipp" => $data_slip_ipp,
            "data_ruang_kelas" => $data_kelas,
        ]);
    }

    function tampilanPembayaranPangkal(){
        $data_slip_pangkal = slip_pembayaran_pangkal::paginate(4);
        $data_kelas = ruang_kelas::all();
        return view ('/modul/siakad/pangkal',compact('data_slip_pangkal','data_kelas'));  
    }


    function edit_slipPembayaranIpp(Request $request)
    {
        $data_slip = slip_pembayaran_ipp::where('id',$request->id)->first();
        $data_slip->tanggal_awal = Carbon::parse($request->tanggal_awal)->translatedFormat("Y-m-d");
        $data_slip->nominal = $request->nominal;
        $data_slip->status = $request->status == 'Menunggak' ? false : true;
        $data_slip->jumlah_dibayar += (int) $request->bayar;
        $data_slip->save();
        return back()->with('success','berhasil edit pembayaran');
    }


    function edit_slipPembayaranPangkal(Request $request){
        $data_slip = slip_pembayaran_pangkal::where("id",(int) $request->id_siswa)->first();
        $data_slip->nominal = $request->nominal;
        $data_slip->jumlah_di_bayar += (int) $request->bayar;
        $data_slip->status = $request->status == 'Menunggak' ? false : true;
        $data_slip->save();
        return back()->with("success","berhasil edit pembayaran");
    }
}
