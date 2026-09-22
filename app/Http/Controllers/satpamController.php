<?php

namespace App\Http\Controllers;

use App\Models\cabang_guru;
use App\Models\gaji;
use App\Models\gaji_satpam;
use App\Models\satpam;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Http\Request;

class satpamController extends Controller
{
    function tambah_satpam(Request $request){

        satpam::create([
            "nama" => $request->nama,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "agama" => $request->agama,
            "alamat" => $request->alamat,
            "cabang_id" => $request->cabang_id,
            "gender" => $request->jenis_kelamin,
            "user_id" => (int) session("id_akun")
        ]);

        $data_satpam = satpam::where("nama", $request->nama)->first();
         $this->tambah_Gaji($data_satpam->id);
        session()->put("id",$data_satpam->id);
        session()->put("nama",$data_satpam->nama);

        return redirect("/mod");
    }   

    function tambah_Gaji($id){
        gaji_satpam::create([
            "gaji_pokok" => 0,
            "gaji_honor" => 0,
            "gaji_tugas_tambahan" => 0,
            "potongan_tidak_hadir" => 0,
            "potongan_keterlambatan" => 0,
            "kasbon" => 0,
            "gaji_tambahan" => 0,
            "bonus" => 0,
            "ketidakhadiran" => 0,
            "satpam_id" => $id
        ]);
    }

    function tampilan_FormulirSatpam (){
        $cabang = cabang_guru::all();
        return view("modul/guru/formulir_satpam",compact("cabang"));
    }
}
