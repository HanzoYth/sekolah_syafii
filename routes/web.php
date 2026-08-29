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
use App\Http\Controllers\kelasHalaqahController;
use App\Http\Controllers\file_surat;
use App\Http\Controllers\pembayaranController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\siakadController;
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
Route::get('/gr/slpgjgr',[modulGuruController::class,"tampilan_slipGaji"]);
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


//ini pengajuan
Route::get("/gr/pgjgr",[modulGuruController::class,"tampilan_pengajuanGuru"]);
Route::get("/gr/apgjgr",[modulGuruController::class,"tampilan_pengajuanGuruA"]);
Route::post("/gr/tbpgjgr",[modulGuruController::class,"tambah_pengajuanGuru"]);
Route::post("/gr/edpgjgr",[modulGuruController::class,"edit_pengajuanGuru"]);
Route::get("/gr/hppgjgr/{id}",[modulGuruController::class,"hapus_pengajuanGuru"]);
Route::get("/gr/rjpggr/{id}",[modulGuruController::class,"tolak_pengajuanGuru"]);
Route::get("/gr/acpggr/{id}",[modulGuruController::class,"terima_pengajuanGuru"]);

//ini pengumuman
Route::get("/gr/pggr",[modulGuruController::class,"Tampilan_PengumumanGuru"]);
Route::post("/gr/tbpggr",[modulGuruController::class,"tambah_pengumumanGuru"]);
Route::post("/gr/edpggr",[modulGuruController::class,"Edit_pengumumanGuru"]);
Route::get("/gr/hppggr/{id}",[modulGuruController::class,"hapus_pengumumanGuru"]);

//ini otp
Route::get("/gr/totp",[otpController::class,"tampilanOtp"]);
Route::get("/gr/otp",[otpController::class,"createOtp"]);
Route::post("/gr/ckotp",[otpController::class,"cekOtp"]);

//ini setting absen
Route::post('/gr/crtabs/{id}',[MasterAbsenController::class,"SettingAbsenGuru"]);
Route::get('/gr/acabs',[MasterAbsenController::class,"addAbsenGuru"]);
Route::get('/gr/klabs',[MasterAbsenController::class,"keluarAbsenGuru"]);
Route::get('/gr/edklabs/{id}',[MasterAbsenController::class,"edit_AbsenGuru"]);

//ini kelola guru
Route::get('/gr/klgr',[modulGuruController::class,"tampilan_kelolaGuru"]);
Route::get('/gr/edgr/{id}',[modulGuruController::class,"tampilan_editGuru"]);
Route::post('/gr/updgr',[modulGuruController::class,"update_dataGuru"]);
Route::post('/gr/upprgr',[modulGuruController::class,"update_profileGuru"]);
Route::get('/gr/edprgr',[modulGuruController::class,"tampilan_editProfileGuru"]);

//ini admin
Route::get('/ad/frad',[adminController::class,"tampilan_formulirAdmin"]);
Route::post('/ad/tbad',[adminController::class,"tambahDataAdmin"]);

//----------------------------------------------------------------------------------


//bagiuan surat

Route::get("/slpgj/{id}",[file_surat::class,"cetak_SuratSlipGaji"])->name("Slipgaji.guru");
Route::get("/slpgjgr/{id}",[file_surat::class,"tampilan_SuratSlipGaji"])->name("DetailSlipGaji.guru");
Route::get("/sk/ssp",[file_surat::class,"suratSlipPembayaran"]);
//-------------------------------------------------------------------------------------




//ini route untuk dasboard tahfiz
Route::get('/tf/das',[modulTahfidzController::class,"dashboard_tahfidz"]);
Route::get('/tf/kls',[kelasHalaqahController::class,"kelas_halaqah"]);


//ini dasboard siakad
Route::get('/sk/das',[modulSiakadController::class,"dashboard_siakad"]);
Route::get('/sk/ds',[dataSiswaController::class,"data_siswa"]); 
Route::get('/sk/dls',[dataSiswaController::class,"detail_siswa"]); 
Route::get('/sk/dts',[dataSiswaController::class,"edit_siswa"]); 
Route::get('/sk/pb',[siakadController::class,"tampilanPembayaran_siswa"]);
Route::get('/sk/dp',[PembayaranController::class,"detail_pembayaran_siswa"]);
Route::get('/sk/pp',[PembayaranController::class,"pembayaran_pangkal"]);


//siswa
Route::get("/sk/frss",[siswaController::class,"tampilan_formulirSiswa"]);
Route::post("/sk/tbss",[siswaController::class,"tambah_siswa"]);
Route::get("/sk/dbs",[siswaController::class,"dashboardSiswa"]);
Route::get("/sk/pbs",[siswaController::class,"pembayaranSiswa"]);
Route::get("/sk/pfs",[siswaController::class,"profilSiswa"]);
Route::get("/sk/dsp",[siswaController::class,"DetailSlipPembayaran"]);



// Route::get('/tes',[file_surat::class,"testingKirim"]);


Route::get('/file/{path}', function ($path) {
    if (!Storage::exists($path)) {
        abort(404);
    }
    return Storage::response($path); // otomatis set header mime-type yang benar
})->where('path', '.*')->name('file.show');