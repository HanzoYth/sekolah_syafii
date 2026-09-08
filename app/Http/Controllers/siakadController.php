<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\ruang_kelas;
use App\Models\siswa;
use App\Models\slip_pembayaran_ipp;
use App\Models\slip_pembayaran_pangkal;
use App\Models\slip_pembayaran_pendidikan;
use App\Services\FonteService;
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
   
    function tambah_kelas(){
       return view("/modul/siakad/tambahKelas");
       
    }
    function tampilanPembayaranPemeliharaan(){
       return view("/modul/siakad/pemeliharaan");
       
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
        $data_slip_ipp = slip_pembayaran_ipp::paginate(6)->onEachSide(1);
        $data_kelas = ruang_kelas::all();
        $jumlah_total_bayar_lunas = slip_pembayaran_ipp::where("status",true)->sum("jumlah_dibayar");
        return view ('/modul/siakad/pembayaran',[
            "data_slip_ipp" => $data_slip_ipp,
            "data_ruang_kelas" => $data_kelas,
            "total_bayar_lunas" => $jumlah_total_bayar_lunas
        ]);
    }

    function tampilanPembayaranPangkal(){
        $data_slip_pangkal = slip_pembayaran_pangkal::paginate(6)->onEachSide(1);
        $data_kelas = ruang_kelas::all();
        $target_pangkal_belum_lunas = slip_pembayaran_pangkal::sum("nominal");
        $total_lunas_pangkal = slip_pembayaran_pangkal::sum("jumlah_di_bayar");
        $total_target_pangkal = $target_pangkal_belum_lunas  - $total_lunas_pangkal;
        $total_siswa_lunas = slip_pembayaran_pangkal::where("status",true)->count();
        $total_siswa_belum_lunas = slip_pembayaran_pangkal::where("status",false)->count();
        return view ('/modul/siakad/pangkal',compact('data_slip_pangkal','data_kelas',"total_target_pangkal","total_lunas_pangkal","total_siswa_lunas","total_siswa_belum_lunas"));  
    }

    function tampilanPembayaranPendidikan(){
        $data_slip_pendidikan = slip_pembayaran_pendidikan::paginate(6)->onEachSide(1);
        $data_kelas = ruang_kelas::all();
        $target_pendidikan_belum_lunas = slip_pembayaran_pendidikan::sum("nominal");
        $total_lunas_pendidikan = slip_pembayaran_pendidikan::sum("jumlah_di_bayar");
        $total_target_pendidikan = $target_pendidikan_belum_lunas  - $total_lunas_pendidikan;
        $total_siswa_lunas = slip_pembayaran_pendidikan::where("status",true)->count();
        $total_siswa_belum_lunas = slip_pembayaran_pendidikan::where("status",false)->count();
        return view("/modul/siakad/pendidikan",compact("data_slip_pendidikan","data_kelas","total_lunas_pendidikan","total_target_pendidikan","total_siswa_lunas","total_siswa_belum_lunas"));
       
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

    function edit_slipPembayaranPendidikan(Request $request){
        $data_slip = slip_pembayaran_pendidikan::where("id",(int) $request->id_siswa)->first();
        $data_slip->nominal = $request->nominal;
        $data_slip->jumlah_di_bayar += (int) $request->bayar;
        $data_slip->status = $request->status == 'Menunggak' ? false : true;
        $data_slip->save();
        return back()->with("success","berhasil edit pembayaran");
    }

    function publish_slipPembayaran(Request $request){
        $data_siswa = siswa::where('id',$request->id_siswa)->first();
        $data_akun = akun::where("id",$data_siswa->user_id)->first();

        $data_fonte = new FonteService();

        $pesan = "";

        if ($request->pembayaran == "pendidikan"){
            $pesan = "pembayaran pendidikan anda sudah lunas cek web anda untuk melihat update pembayaran";
        }elseif ($request->pembayaran == "pangkal"){
            $pesan = "pembayaran pangkal anda sudah lunas cek web anda untuk melihat update pembayaran";
        }else{
            $pesan = "pembayaran spp anda sudah lunas cek web anda untuk melihat update pembayaran";
        }

        $data_fonte->sendMassage($data_akun->noWa,$pesan);
        return back()->with("success","tagihan berhasil di publish");
    }

    function hapus_SlipPembayaran(Request $request){
        $data_slipPembayaran = null;

        if ($request->pembayaran == "pendidikan"){
            $data_slipPembayaran = slip_pembayaran_pendidikan::where("id",$request->id)->first();
        }elseif ($request->pembayaran == "pangkal"){
            $data_slipPembayaran = slip_pembayaran_pangkal::where("id",$request->id)->first();
        }else{
            $data_slipPembayaran = slip_pembayaran_ipp::where("id",$request->id)->first();
        }

        $data_slipPembayaran->delete();

        return back()->with("success","pembayaran berhasil dihapus");
    }

    function tampian_daftarSiswa(){
        $data_siswa = siswa::all();
        return view ('/modul/siakad/daftar_siswa',compact("data_siswa"));
    }

    function tampilan_detailSiswa($id){
        $data_siswa = siswa::where("id",$id)->first();
        $data_kelas = ruang_kelas::where("id",$data_siswa->kelas_id)->first();
        return view ('/modul/siakad/detailSiswa',compact("data_siswa","data_kelas"));
    }
}
