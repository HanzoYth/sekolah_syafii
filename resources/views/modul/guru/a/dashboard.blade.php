<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS Guru - Dashboard Admin</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/modul/guru/das_ad_gr.css')}}">
    <link rel="stylesheet" href="{{asset('css/modul/guru/dashboard_admin.css')}}">
</head>
<body>

    <div class="app-layout">
        
        <!-- SIDEBAR -->
        <x-sidebar_guru />

        <!-- MAIN CONTENT AREA -->
        <main class="main-content">
            
            <!-- TOP NAVBAR -->
            <header class="topbar">
                <div class="page-title">
                    <h2>Dashboard Admin Guru</h2>
                    <p>Selamat datang kembali, <strong>Administrator</strong></p>
                </div>
                <div class="topbar-actions">
                    <button class="icon-btn" title="Notifikasi">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot"></span>
                    </button>
                    <div class="user-profile">
                        <img src="{{ route('file.show',$mydata->url_foto)}}" alt="Foto Profil">
                        <div class="user-info">
                            <span class="name">Administrator</span>
                            <span class="role">Administrator Modul Guru</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <div class="content-body">
                
                <!-- 1. STATISTIK UTAMA GURU (ADMIN) -->
                <div class="stats-grid">
                    <div class="stat-card"> 
                        <div class="stat-icon bg-primary-light">
                            <i class="fa-solid fa-user-tie text-primary"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Total Guru Aktif</span>
                            <h3>{{$jumlah_guru_aktif}} <small>Orang</small></h3>
                        </div>
                    </div>

                    <div class="stat-card"> 
                        <div class="stat-icon bg-primary-light">
                            <i class="fa-solid fa-user-tie text-primary"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Total Kepala Sekolah</span>
                            <h3>{{$jumlah_kepala_sekolah}} <small>Orang</small></h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-info-light">
                            <i class="fa-solid fa-id-badge text-info"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Guru Tetap / Honorer</span>
                            <h3>{{$jumlah_guru_tetap}}<small>/ {{$jumlah_guru_honor}}</small></h3>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon bg-info-light">
                            <i class="fa-solid fa-id-badge text-info"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">koordinator tahfiz/ pengampu</span>
                            <h3>{{$jumlah_koordinator}} <small>/ {{$jumlah_pengampu}}</small></h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-success-light">
                            <i class="fa-solid fa-clipboard-user text-success"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Presensi Hari Ini</span>
                            <h3>{{$jumlah_presensi}} <small>/ {{$jumlah_guru_aktif}} Guru</small></h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-warning-light">
                            <i class="fa-solid fa-file-signature text-warning"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Pending Pengajuan</span>
                            <h3>{{$jumlah_pengajuan}} <small>Berkas</small></h3>
                        </div>
                    </div>
                </div>

                <!-- 2. REKAPITULASI ABSENSI & PENGGAJIAN (ADMIN) -->
                <div class="dashboard-grid">
                    
                    <!-- Monitoring Presensi Hari Ini -->
                    <div class="card widget-presensi">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-chart-pie"></i> Monitoring Absensi Guru</h4>
                            <span class="date-badge">{{$nama_hari}}, {{$tanggal_sekarang}}</span>
                        </div>
                        <div class="card-body">
                            <div class="admin-presensi-summary">
                                <div class="status-box status-success">
                                    <i class="fa-solid fa-user-check"></i>
                                    <div>
                                        <h5>{{$jumlah_guru_tepat_waktu}} Guru Tepat Waktu</h5>
                                        <p>Tercatat masuk sebelum pukul 07:00 WITA</p>
                                    </div>
                                </div>
                                <div class="admin-presensi-stats">
                                    <div class="presensi-stat-item">
                                        <span class="stat-num text-warning">{{$jumlah_terlambat}}</span>
                                        <span class="stat-desc">Terlambat</span>
                                    </div>
                                    <div class="presensi-stat-item">
                                        <span class="stat-num text-info">{{$jumlah_izin}}/{{$jumlah_sakit}}</span>
                                        <span class="stat-desc">Izin / Sakit</span>
                                    </div>
                                    <div class="presensi-stat-item">
                                        <span class="stat-num text-danger">{{$jumlah_belum_absen}}</span>
                                        <span class="stat-desc">Belum Absen</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Penggajian Periode Ini -->
                    <div class="card widget-pengumuman">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-money-bill-wave"></i> Ringkasan Penggajian</h4>
                            <a href="/gr/klgjgr" class="link-more">Kelola Gaji</a>
                        </div>
                        <div class="card-body">
                            <div class="payroll-summary-box">
                                <div class="payroll-row">
                                    <span>Status Proses:</span>
                                    <strong class="text-success">{{$jumlah_gaji_selesai}} / {{$jumlah_gaji}} Selesai</strong>
                                </div>
                                <div class="payroll-row">
                                    <span>Total Gaji Pokok:</span>
                                    <strong>Rp {{number_format($jumlah_gaji_pokok,0,",",".")}}</strong>
                                </div>
                                <div class="payroll-row">
                                    <span>Total Potongan:</span>
                                    <strong class="text-danger">- Rp {{number_format($jumlah_potongan,0,",",".")}}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <x-warning />
</body>
</html>