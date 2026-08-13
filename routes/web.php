<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\akunController;
use App\Http\Controllers\modulGuruController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\identitasController;
use App\Http\Controllers\MasterAbsenController;
use App\Http\Controllers\otpController;
use App\Http\Controllers\cabangGuruController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\dataSiswaController;
use App\Http\Controllers\modulSiakadController;
use App\Http\Controllers\tanggalMerahController;
use App\Http\Controllers\modulTahfidzController;
use App\Http\Controllers\dataWalasControll;
use App\Http\Controllers\kelasHalaqahController;
use App\Http\Controllers\file_surat;
use App\Http\Controllers\siswaController;
use Illuminate\Support\Facades\Storage;

// ini route untuk halaman modul dan welcome
Route::get("/",[PageController::class,"tampilan_welcome"]);
Route::get("/mod",[PageController::class,"tampilan_modul"]);

//ini route untuk atur identitas_rahasia
Route::get("/idnt",[identitasController::class,"tampilan_identitas"]);
Route::post("/add/idnt",[identitasController::class,"add_identitas"]);

// ini route untuk halaman registrasi
Route::get('/reg',[akunController::class,"tampilan"]);
Route::post('/reg/sign',[akunController::class,"sign_in"]);
Route::post('/reg/login',[akunController::class,"login"]);
Route::get("/reg/logout",[akunController::class,"logout"]);
Route::get("/reg/nakt/{id}",[akunController::class,"nonAktifkanAkun"]);

// ini route untuk halaman modul guru
Route::get('/gr/das',[modulGuruController::class,"tampilan_dashboardGuru"]);
Route::get('/gr/abs',[modulGuruController::class,"tampilan_presensiAbsen"]);
Route::get('/gr/sta/{id}',[modulGuruController::class,"tampilan_settingAbsen"]);
Route::get('/gr/dasa',[modulGuruController::class,"tampilan_dashboardAdmin"]);
Route::get('/gr/lpabs',[modulGuruController::class,"tampilan_laporanAbsen"]);
Route::get('/gr/frgr',[modulGuruController::class,"tampilan_formulirGuru"]);
Route::get('/gr/cb',[cabangGuruController::class,"tampilanCabangGuru"]);
Route::post('/gr/tbgr',[modulGuruController::class,"tambahGuru"]);

//kelola gaji guru
Route::get('/gr/klgjgr',[modulGuruController::class,"tampilan_kelolaGajiGuru"]);         
Route::get('/gr/edgjgr/{id}',[modulGuruController::class,"tampilan_editGajiGuru"]);        
Route::post('/gr/spgjgr',[modulGuruController::class,"simpan_PerubahanGajiGuru"]);        
Route::get('/gr/pbgjgr/{id}',[modulGuruController::class,"publish_GajiGuru"]);        

//kelola absen guru admin
Route::get('/gr/klab',[MasterAbsenController::class,"tampilan_kelolaAbsenGuru"]);
Route::post('/gr/keabs',[MasterAbsenController::class,"addAbsenGuruDenganKelola"]);

//ini untuk tanggall merah
Route::get("/gr/tgm",[tanggalMerahController::class,"tampilan_tanggalMerah"]);
Route::post("/gr/tbgm",[tanggalMerahController::class,"tambahTanggalMerah"]);
Route::post("/gr/edgm/{id}",[tanggalMerahController::class,"editTanggalMerah"]);
Route::get("/gr/hpgm/{id}",[tanggalMerahController::class,"hapusTanggalMerah"]);

//ini seting cabang
Route::post("/gr/tcb",[cabangGuruController::class,"TambahCabang"]);
Route::get("/gr/nkt/{id}",[cabangGuruController::class,"nonAktikanCabang"]);

//ini otp
Route::get("/gr/totp",[otpController::class,"tampilanOtp"]);
Route::get("/gr/otp",[otpController::class,"createOtp"]);
Route::post("/gr/ckotp",[otpController::class,"cekOtp"]);

//ini setting absen
Route::post('/gr/crtabs/{id}',[MasterAbsenController::class,"SettingAbsenGuru"]);
Route::get('/gr/acabs',[MasterAbsenController::class,"addAbsenGuru"]);
Route::get('/gr/klabs',[MasterAbsenController::class,"keluarAbsenGuru"]);

//ini kelola guru
Route::get('/gr/klgr',[modulGuruController::class,"tampilan_kelolaGuru"]);
Route::get('/gr/edgr/{id}',[modulGuruController::class,"tampilan_editGuru"]);
Route::post('/gr/updgr',[modulGuruController::class,"update_dataGuru"]);

//ini admin
Route::get('/ad/frad',[adminController::class,"tampilan_formulirAdmin"]);
Route::post('/ad/tbad',[adminController::class,"tambahDataAdmin"]);

//----------------------------------------------------------------------------------


//bagiuan surat

Route::get("/slpgj/{id}",[file_surat::class,"cetak_SuratSlipGaji"])->name("Slipgaji.guru");
// Route::get("/slip",[file_surat::class,"cetak_SuratSlipGajiTes"]);

//-------------------------------------------------------------------------------------




//ini route untuk dasboard tahfiz
Route::get('/tf/das',[modulTahfidzController::class,"dashboard_tahfidz"]);
Route::get('/tf/kls',[kelasHalaqahController::class,"kelas_halaqah"]);


//ini dasboard siakad
Route::get('/sk/das',[modulSiakadController::class,"dashboard_siakad"]);
Route::get('/sk/ds',[dataSiswaController::class,"data_siswa"]);
Route::get('/sk/dw',[dataWalasController::class,"data_walas"]);



//siswa
Route::get("/sk/frss",[siswaController::class,"tampilan_formulirSiswa"]);
Route::post("/sk/tbss",[siswaController::class,"tambah_siswa"]);


// Route::get('/tes',[file_surat::class,"testingKirim"]);


Route::get('/file/{path}', function ($path) {
    if (!Storage::exists($path)) {
        abort(404);
    }
    return Storage::response($path); // otomatis set header mime-type yang benar
})->where('path', '.*')->name('file.show');