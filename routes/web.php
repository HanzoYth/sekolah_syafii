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
use App\Http\Controllers\tanggalMerahController;
use App\Http\Controllers\modulTahfidzController;
use App\Http\Controllers\kelasHalaqahController;
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

// ini route untuk halaman modul guru
Route::get('/gr/das',[modulGuruController::class,"tampilan_dashboard"]);
Route::get('/gr/abs',[modulGuruController::class,"tampilan_presensiAbsen"]);
Route::get('/gr/sta/{id}',[modulGuruController::class,"tampilan_settingAbsen"]);
Route::get('/gr/lpabs',[modulGuruController::class,"tampilan_laporanAbsen"]);
Route::get('/gr/frgr',[modulGuruController::class,"tampilan_formulirGuru"]);
Route::get('/gr/cb',[cabangGuruController::class,"tampilanCabangGuru"]);
Route::post('/gr/tbgr',[modulGuruController::class,"tambahGuru"]);

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


//ini admin
Route::get('/ad/frad',[adminController::class,"tampilan_formulirAdmin"]);
Route::post('/ad/tbad',[adminController::class,"tambahDataAdmin"]);

//ini route untuk dasboard tahfiz
Route::get('/tf/das',[modulTahfidzController::class,"dashboard_tahfidz"]);
Route::get('/tf/kls',[kelasHalaqahController::class,"kelas_halaqah"]);


