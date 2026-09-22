<?php

namespace App\Http\Controllers;

use App\Models\cabang_guru;
use App\Models\gaji;
use App\Models\gaji_operator;
use App\Models\operator;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Http\Request;

class operatorController extends Controller
{
    function tambah_Operator(Request $request){
        $validator = Validator::make($request->all(),
            [
                "foto" => 'required|file|mimes:jpg,jpeg,png|max:2048'
            ],
            [
                "foto.mimes" => "file harus berupa jpg, jpeg, atau png",
                "foto.max" => "ukuran file harus lebih kecil dari 2 mb atau 2 mb",
            ]
        );

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $path_foto = $request->file("foto")->store('uploads');

        operator::create([
            "nama" => $request->nama,
            "nig" => $request->nig,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "agama" => $request->agama,
            "alamat" => $request->alamat,
            "cabang_id" => $request->cabang_id,
            "pendidikan_terakhir" => $request->pendidikan_terakhir,
            "url_foto" => $path_foto,
            "gender" => $request->jenis_kelamin,
            "user_id" => (int) session("id_akun") 
        ]);

        $data_operator = operator::where("nig", $request->nig)->first();
        $this->tambah_Gaji($data_operator->id);
        session()->put("id",$data_operator->id);
        session()->put("nama",$data_operator->nama);

        return redirect("/mod");
    }   

    function tambah_Gaji($id){
        gaji_operator::create([
            "gaji_pokok" => 0,
            "gaji_honor" => 0,
            "gaji_tugas_tambahan" => 0,
            "potongan_tidak_hadir" => 0,
            "potongan_keterlambatan" => 0,
            "kasbon" => 0,
            "gaji_tambahan" => 0,
            "bonus" => 0,
            "ketidakhadiran" => 0,
            "operator_id" => $id
        ]);
    }

    function tampilan_FormulirOperator(){
        $cabang = cabang_guru::all();
        return view("modul/guru/formulir_operator",compact("cabang"));
    }
}
