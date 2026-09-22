<?php

namespace App\Http\Controllers;

use App\Models\cabang_guru;
use App\Models\guru;
use App\Models\siswa;
use App\Models\slip_pembayaran_ipp;
use App\Models\slip_pembayaran_pangkal;
use App\Models\slip_pembayaran_pendidikan;
use App\Models\yayasan;
use Illuminate\Http\Request;

class yayasanController extends Controller
{
    function dashboard_Yayasan(){
        $total_guru = guru::count();
        $total_siswa = siswa::count();
        $jumlah_pendapatan_ipp = slip_pembayaran_ipp::all()->sum("jumlah_dibayar");
        $jumlah_pendapatan_pangkal = slip_pembayaran_pangkal::all()->sum("jumlah_di_bayar");
        $jumlah_pendapatan_pendidikan = slip_pembayaran_pendidikan::all()->sum("jumlah_di_bayar");
        $total_bayar = $jumlah_pendapatan_ipp + $jumlah_pendapatan_pangkal + $jumlah_pendapatan_pendidikan;
        $jumlah_tunggakan_ipp = slip_pembayaran_ipp::all()->sum("nominal") - $jumlah_pendapatan_ipp;
        $jumlah_tunggakan_pangkal = slip_pembayaran_pangkal::all()->sum("nominal") - $jumlah_pendapatan_pangkal;
        $jumlah_tunggakan_pendidikan = slip_pembayaran_pendidikan::all()->sum("nominal") - $jumlah_pendapatan_pendidikan;
        return view("dashboard_yayasan",[
            "total_guru" => $total_guru,
            "total_siswa" => $total_siswa,
            "total_bayar" => $total_bayar,
            "jumlah_tunggakan_ipp" => $jumlah_tunggakan_ipp,
            "jumlah_tunggakan_pangkal" => $jumlah_tunggakan_pangkal,
            "jumlah_tunggakan_pendidikan" => $jumlah_tunggakan_pendidikan
        ]);
    }
    function tambah_Yayasan(Request $request){

        yayasan::create([
            "nama" => $request->nama,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "agama" => $request->agama,
            "alamat" => $request->alamat,
            "gender" => $request->jenis_kelamin,
            "user_id" => (int) session("id_akun") 
        ]);

        $data_yayasan = yayasan::where("nama", $request->nama)->first();
        session()->put("id",$data_yayasan->id);
        session()->put("nama",$data_yayasan->nama);

        return redirect("/mod");
    }  
    function tampilan_FormulirYayasan(){
        return view("modul/guru/formulir_yayasan");
    }
}
