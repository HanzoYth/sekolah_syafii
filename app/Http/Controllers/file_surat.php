<?php

namespace App\Http\Controllers;

use App\Mail\sendFileEmail;
use App\Models\gaji;
use App\Models\guru;
use App\Models\tunjangan;
use App\Models\master_absen_guru;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Services\FonteService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class file_surat extends Controller
{
    function cetak_SuratSlipGaji($id){
        $guru = guru::where("id",$id)->first();
        $data_gaji = gaji::where("guru_id",$id)->first();
        $data_tunjangan = tunjangan::where("guru_id",$id)->get();
        $bulan = Carbon::now()->translatedFormat("m");
        $jumlah_alpa = 25 - master_absen_guru::where("guru_id",1)->whereMonth("tgl_masuk",$bulan)->where("status_kehadiran","h")->count();
        $jumlah_terlambat = master_absen_guru::where("guru_id",1)->whereMonth("tgl_masuk",$bulan)->where("status_kehadiran","h")->sum("terlambat_menit");

        $jumlah_gaji_kotor = $data_gaji->gaji_pokok + $data_gaji->gaji_honor + $data_gaji->gaji_tugas_tambahan + $data_gaji->gaji_tambahan + $data_gaji->bonus;
        
        foreach($data_tunjangan as $data) {$jumlah_gaji_kotor += $data->nominal;}
        $jumlah_gaji_bersih = $jumlah_gaji_kotor - ($data_gaji->potongan_tidak_hadir + $data_gaji->potongan_keterlambatan + $data_gaji->kasbon);

        $pdf = Pdf::loadView("surat/surat_slip_gaji",[
            "data_guru" => $guru,
            "data_gaji" => $data_gaji,
            "data_tunjangan" => $data_tunjangan,
            "jumlah_gaji_kotor" => $jumlah_gaji_kotor,
            "jumlah_alpa" => $jumlah_alpa,
            "jumlah_terlambat" => $jumlah_terlambat,
            "jumlah_gaji_bersih" => $jumlah_gaji_bersih
        ]);

        return $pdf->download("slip_gaji.pdf");
    }

    function Kirim_FileSlipGaji($id){
        $guru = guru::where("id",$id)->first();
        $data_gaji = gaji::where("guru_id",$id)->first();
        $data_tunjangan = tunjangan::where("guru_id",$id)->get();
        $bulan = Carbon::now()->translatedFormat("m");
        $jumlah_alpa = 25 - master_absen_guru::where("guru_id",1)->whereMonth("tgl_masuk",$bulan)->where("status_kehadiran","h")->count();
        $jumlah_terlambat = master_absen_guru::where("guru_id",1)->whereMonth("tgl_masuk",$bulan)->where("status_kehadiran","h")->sum("terlambat_menit");

        $jumlah_gaji_kotor = $data_gaji->gaji_pokok + $data_gaji->gaji_honor + $data_gaji->gaji_tugas_tambahan + $data_gaji->gaji_tambahan + $data_gaji->bonus;
        
        foreach($data_tunjangan as $data) {$jumlah_gaji_kotor += $data->nominal;}
        $jumlah_gaji_bersih = $jumlah_gaji_kotor - ($data_gaji->potongan_tidak_hadir + $data_gaji->potongan_keterlambatan + $data_gaji->kasbon);

        $pdf = Pdf::loadView("surat/surat_slip_gaji",[
            "data_guru" => $guru,
            "data_gaji" => $data_gaji,
            "data_tunjangan" => $data_tunjangan,
            "jumlah_gaji_kotor" => $jumlah_gaji_kotor,
            "jumlah_alpa" => $jumlah_alpa,
            "jumlah_terlambat" => $jumlah_terlambat,
            "jumlah_gaji_bersih" => $jumlah_gaji_bersih
        ]);


        Mail::to($guru->getUser()->first()->email)->send(
            new sendFileEmail($pdf->output())
        );

        return;
    }
}
