<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Absensi Guru - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Ubah path CSS sesuai lokasi file kamu jika untuk testing lokal, misal: edit_absen_guru.css -->
    <link rel="stylesheet" href="{{asset('css/modul/guru/edit_absen_guru.css')}}">
</head>
<body>

<div class="dashboard-container">
    <main class="main-wrapper">
        
        <!-- TOPBAR HEADER -->
        <header class="topbar">
            <div class="topbar-left">
                <a href="javascript:history.back()" class="btn-back" title="Kembali">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div class="topbar-title">
                    <h2>Detail & Rekap Absensi Guru</h2>
                    <p>Laporan Kehadiran Bulanan Tenaga Pengajar</p>
                </div>
            </div>
        </header>

        <!-- CARD INFORMASI & REKAP STATISTIK GURU -->
        <div class="col-12" style="margin-bottom: 24px;">
            <div class="card">
                <div class="card-header">
                    <div class="header-icon icon-info">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div>
                        <h3>Informasi & Ringkasan Kehadiran</h3>
                        <p class="subtitle">Data identitas dan rekapitulasi presensi bulan ini</p>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Informasi Utama Guru -->
                    <div class="grid-cols-2" style="margin-bottom: 20px; border-bottom: 1px solid #e5e7eb; padding-bottom: 16px;">
                        <div class="form-group">
                            <label for="nama_guru">Nama Lengkap Guru</label>
                            <input type="text" id="nama_guru" class="form-control readonly" value="{{$data_guru->nama}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="cabang_guru">Cabang / Unit</label>
                            <input type="text" id="cabang_guru" class="form-control readonly" value="{{$data_cabang->nama_cabang}}" readonly>
                        </div>
                    </div>

                    <!-- Rekap Statistik Absensi -->
                    <div class="stats-grid">
                        <div class="stat-box stat-hadir">
                            <span class="stat-label">Jumlah Hadir</span>
                            <span class="stat-value">{{$jumlah_hadir}} <small style="font-size: 0.8rem; font-weight: 500;">Hari</small></span>
                        </div>
                        <div class="stat-box stat-izin">
                            <span class="stat-label">Jumlah Izin</span>
                            <span class="stat-value">{{$jumlah_izin}} <small style="font-size: 0.8rem; font-weight: 500;">Hari</small></span>
                        </div>
                        <div class="stat-box stat-sakit">
                            <span class="stat-label">Jumlah Sakit</span>
                            <span class="stat-value">{{$jumlah_sakit}} <small style="font-size: 0.8rem; font-weight: 500;">Hari</small></span>
                        </div>
                        <div class="stat-box stat-terlambat">
                            <span class="stat-label">Total Terlambat</span>
                            <span class="stat-value">{{$terlambat}} <small style="font-size: 0.8rem; font-weight: 500;">Menit</small></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD TABEL DAFTAR ABSENSI BULAN INI -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="header-icon icon-income">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <div>
                        <h3>Daftar Presensi Bulan Ini</h3>
                        <p class="subtitle">Riwayat presensi dari awal hingga akhir bulan</p>
                    </div>
                </div>

                <div class="card-body" style="padding: 0;">
                    <div class="table-responsive">
                        <table class="table-presensi">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk - Keluar</th>
                                    <th>Lokasi Presensi</th>
                                    <th>Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tanggal as $tgl)
                                    @if (App\Models\tanggal_merah::where("tanggal",$tgl->tanggal_bulan)->exists())
                                        <tr class="row-holiday">
                                            <td style="font-weight: 600;">{{$tgl->hari}}</td>
                                            <td>{{Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('d M Y')}}</td>
                                            <td colspan="3" class="holiday-label" style="text-align: center;">
                                                <i class="fa-solid fa-mug-hot"></i> Tanggal Merah
                                            </td>
                                        </tr>
                                    @elseif (App\Models\master_absen_guru::where("guru_id",$id_guru)->where("tgl_masuk",$tgl->tanggal_bulan)->exists())
                                    
                                        @if (App\Models\master_absen_guru::where("guru_id",$id_guru)->where("tgl_masuk",$tgl->tanggal_bulan)->first()->status_kehadiran == "h")
                                            <tr>
                                                <td style="font-weight: 500;">{{$tgl->hari}}</td>
                                                <td>{{Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('d M Y')}}</td>
                                                <td>
                                                    <span class="time-badge"><i class="fa-regular fa-clock"></i> {{App\Models\master_absen_guru::where("guru_id",$id_guru)->where("tgl_masuk",$tgl->tanggal_bulan)->first()->waktu_masuk}} - {{App\Models\master_absen_guru::where("guru_id",$id_guru)->where("tgl_masuk",$tgl->tanggal_bulan)->first()->waktu_keluar}}</span>
                                                </td>
                                                <td>
                                                    <div class="location-badge">
                                                        <i class="fa-solid fa-location-dot" style="color: #ef4444;"></i>
                                                        <span>{{$nama_lokasi}}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Hadir</span>
                                                </td>
                                            </tr>

                                        @elseif (App\Models\master_absen_guru::where("guru_id",$id_guru)->where("tgl_masuk",$tgl->tanggal_bulan)->first()->status_kehadiran == "i")
                                            <tr>
                                                <td style="font-weight: 500;">{{$tgl->hari}}</td>
                                                <td>{{Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('d M Y')}}</td>
                                                <td><span style="color: #9ca3af;">-</span></td>
                                                <td><span style="color: #9ca3af;">-</span></td>
                                                <td>
                                                    <span class="badge badge-warning">Izin</span>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td style="font-weight: 500;">{{$tgl->hari}}</td>
                                                <td>{{Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('d M Y')}}</td>
                                                <td><span style="color: #9ca3af;">-</span></td>
                                                <td><span style="color: #9ca3af;">-</span></td>
                                                <td>
                                                    <span class="badge badge-info">Sakit</span>
                                                </td>
                                            </tr>
                                        @endif
                                    @else
                                        @if (strtolower(Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('l')) == "minggu")
                                            <tr class="row-holiday">
                                                <td style="font-weight: 600;">{{$tgl->hari}}</td>
                                                <td>{{Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('d M Y')}}</td>
                                                <td colspan="3" class="holiday-label" style="text-align: center;">
                                                    <i class="fa-solid fa-mug-hot"></i> Libur (Libur Akhir Pekan)
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td style="font-weight: 500;">{{$tgl->hari}}</td>
                                                <td>{{Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('d M Y')}}</td>
                                                <td><span style="color: #9ca3af;">-</span></td>
                                                <td><span style="color: #9ca3af;">-</span></td>
                                                <td>
                                                    <span class="badge badge-warning">Tidak Hadir</span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

</body>
</html>