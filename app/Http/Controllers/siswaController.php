<?php

namespace App\Http\Controllers;

use App\Models\jenis_sekolah;
use App\Models\ruang_kelas;
use App\Models\siswa;
use App\Models\tahun_ajaran;
use Carbon\Carbon;
use Illuminate\Http\Request;


class siswaController extends Controller
{
    function dashboardSiswa (){
        return view('/modul/siakad/dashboardSiswa');
    }

    function pembayaranSiswa (){
        return view('/modul/siakad/pembayaranSiswa');
    }
    function profilSiswa (){
        return view('/modul/siakad/profilSiswa');
    }
     function DetailSlipPembayaran (){
        return view('/modul/siakad/detailSlipPembayaran');
    }

    function tampilan_formulirSiswa(){
        $data_ruang_kelas = ruang_kelas::all();
        $data_jenis_sekolah = jenis_sekolah::all();
        $data_tahun_ajaran = tahun_ajaran::all();
        return view("modul/guru/formulir_siswa",[
            "data_ruang_kelas" => $data_ruang_kelas,
            "data_jenis_sekolah" => $data_jenis_sekolah,
            "data_tahun_ajaran" => $data_tahun_ajaran
        ]);   
    }


    function tambah_Siswa(Request $request){
        $request->validate([
            "url_foto" => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path_foto = $request->file("url_foto")->store('uploads');

        siswa::create([
            "nama" => $request->nama,
            "nis" => $request->nis,
            "tempat_lahir" => $request->tempat_lahir ,
            "tanggal_lahir" => Carbon::parse($request->tanggal_lahir)->translatedFormat("Y-m-d"),
            "agama" => "islam",
            "alamat" => $request->alamat,
            "url_foto" => $path_foto,
            "aktif" => 1,
            "kelas_id" => $request->kelas_id,
            "tahun_ajaran" => $request->tahun_ajaran_id,
            "sekolah_id" => $request->sekolah_id,
            "user_id" => (int) session("id_akun")
        ]);
        $data_siswa = siswa::where("nis",$request->nis)->first();
        session()->put("id",$data_siswa->id);
        session()->put("nama",$data_siswa->nama);

        return redirect("/mod");
    }
}
