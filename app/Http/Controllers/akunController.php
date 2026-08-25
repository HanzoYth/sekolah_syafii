<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\akun;
use App\Models\identitas_rahasia;
use App\Models\guru;
use App\Models\admin;
use App\Models\cabang_guru;
use App\Models\siswa;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class akunController extends Controller
{
    function tampilan(){
        return view("auth/activity_reg");
    }

    function sign_in(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'unique:akun,email'
            ],
            'username' => [
                'required',
                'unique:akun,username',
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],
        ], [
            'email.required' => 'email wajib di isi',
            'email.unique' => 'email sudah di gunakan',

            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        $validator->after(function ($validator) use ($request) {

            $password = $request->password;

            if ($password !== null) {

                if (!preg_match('/[A-Z]/', $password) ||
                    !preg_match('/[a-z]/', $password)) {

                    $validator->errors()->add(
                        'password',
                        'Password harus memiliki huruf kapital dan huruf kecil.'
                    );
                }

                if (!preg_match('/[0-9]/', $password)) {

                    $validator->errors()->add(
                        'password',
                        'Password harus memiliki sebuah angka.'
                    );
                }
            }
        });

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $cek_identitas = identitas_rahasia::where("identitas",$request->kode)->exists();
        $identitas = identitas_rahasia::where("identitas",$request->kode)->first();
        
        if (!$cek_identitas){
            return back()->with("eror","maaf kode identitas yang anda masukkan endak ada");
        }else{
            if ($identitas->aktif== "1"){
                return back()->with("eror","maaf kode identitas yang anda masukkan sudah di gunakan");
            }
        }

        if ($identitas->jenis_role == "g" && cabang_guru::where("aktif",1)->count() == 0){
            return back()->with("eror","maaf cabang belum di buat admin");
        }

        $identitas->aktif = true;

        akun::create([
            "email" => $request->email,
            "username" => $request->username,
            "noWa" => $request->noWa,
            "password" => Hash::make($request->password_confirmation),
            "identity_id" => $identitas->id
        ]);
        $identitas->save(); 

        $akun = akun::where("username",$request->username)->first();
        session()->put("role",$identitas->jenis_role);
        session()->put("hasLogin",true);
        session()->put("id_akun",$akun->id);

        if ($identitas->jenis_role == "g"){
            return redirect("/gr/frgr");
        }elseif ($identitas->jenis_role == "a"){
            return redirect("/ad/frad");
        }else{
            return redirect("/sk/frss");
        }
    }   

    function login(Request $request){
        if (!akun::where("username",$request->username)->exists()){
            return back()->with("eror","coba periksa username dan password anda lalu isi kembali");
        }

        if (!Hash::check($request->password,akun::where("username",$request->username)->first()->password)){
            return back()->with("eror","coba periksa username dan password anda lalu isi kembali"); 
        }

        if (!akun::where("username",$request->username)->first()->aktif){
            return back()->with("eror","akun yang anda gunakan sudah endak aktif");
        }

        $akun = akun::where("username",$request->username)->first();
        $identitas = $akun->identitas()->first()->jenis_role; 
        $user = null;

        session()->put("role",$identitas);
        session()->put("hasLogin",true);
        session()->put("id_akun",$akun->id);
        if ($identitas == "g"){
            if (!guru::where("user_id",$akun->id)->exists()){
                return redirect("/gr/frgr");
            }
            $user = guru::where("user_id",$akun->id)->first();
        }else if ($identitas == "a"){   
            if (!admin::where("user_id",$akun->id)->exists()){
                return redirect("/ad/frad");
            }
            $user = admin::where("user_id",$akun->id)->first();
        }else{
            if (!siswa::where("user_id",$akun->id)->exists()){
                return redirect("/sk/frss");
            }
            $user = siswa::where("user_id",$akun->id)->first();
        }
        
        session()->put("id",$user->id);
        session()->put("nama",$user->nama);


        return redirect("/mod");
    }

    function logout(){
        session()->flush();

        return redirect("/");
    }

    function nonAktifkanAkun($id){
        $data_akun = akun::find((int) $id);
        $data_akun->aktif = 0;
        $data_akun->save();
        return back()->with("success","berhasil menonaktifkan guru");
    }
}
