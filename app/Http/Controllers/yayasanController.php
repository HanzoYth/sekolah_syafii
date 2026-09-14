<?php

namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\siswa;
use App\Models\slip_pembayaran_ipp;
use App\Models\slip_pembayaran_pangkal;
use App\Models\slip_pembayaran_pendidikan;
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
}
