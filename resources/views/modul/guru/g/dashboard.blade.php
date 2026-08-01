<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS Guru - Dashboard</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/dashboard.css') }}">
</head>
<body>

    <div class="app-layout">
        
        <!-- INCLUDE SIDEBAR -->
        <x-sidebar_guru />

        <!-- MAIN CONTENT AREA -->
        <main class="main-content">
            
            <!-- TOP NAVBAR -->
            <header class="topbar">
                <div class="page-title">
                    <h2>Dashboard {{ session('role') == 'a' ? 'Admin Guru' : 'Utama' }}</h2>
                    <p>Selamat datang kembali, <strong>{{ session('nama') }}</strong></p>
                </div>
                <div class="topbar-actions">
                    <button class="icon-btn" title="Notifikasi">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot"></span>
                    </button>
                    <div class="user-profile">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=200" alt="Foto Profil">
                        <div class="user-info">
                            <span class="name">{{ session('nama') }}</span>
                            <span class="role">{{ session('role') == 'a' ? 'Administrator Modul Guru' : 'Guru Tetap / Wali Kelas' }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <div class="content-body">

                @if(session('role') == 'a')
                <!-- ==========================================================================
                     DASHBOARD ADMIN MODUL GURU
                     ========================================================================== -->
                
                <!-- 1. STATISTIK UTAMA GURU (ADMIN) -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary-light">
                            <i class="fa-solid fa-user-tie text-primary"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Total Guru Aktif</span>
                            <h3>{{$guru_aktif}} <small>Orang</small></h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-info-light">
                            <i class="fa-solid fa-id-badge text-info"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Guru Tetap / Honorer</span>
                            <h3>{{$tetap}} <small>/ {{$honor}}</small></h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-success-light">
                            <i class="fa-solid fa-clipboard-user text-success"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Presensi Hari Ini</span>
                            <h3>{{$jumlah_presensi}} <small>/ {{$guru_aktif}} Guru</small></h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-warning-light">
                            <i class="fa-solid fa-file-signature text-warning"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Pending Pengajuan</span>
                            <h3>5 <small>Berkas</small></h3>
                        </div>
                    </div>
                </div>

                <!-- 2. REKAPITULASI ABSENSI & PENGGAJIAN (ADMIN) -->
                <div class="dashboard-grid">
                    
                    <!-- Kiri: Monitoring Presensi Hari Ini -->
                    <div class="card widget-presensi">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-chart-pie"></i> Monitoring Absensi Guru</h4>
                            <span class="date-badge">{{$hari}}, {{$tanggal}}</span>
                        </div>
                        <div class="card-body">
                            <div class="admin-presensi-summary">
                                <div class="status-box status-success">
                                    <i class="fa-solid fa-user-check"></i>
                                    <div>
                                        <h5>{{$tepat_waktu}} Guru Tepat Waktu</h5>
                                        <p>Tercatat masuk sebelum pukul 07:00 WITA</p>
                                    </div>
                                </div>
                                <div class="admin-presensi-stats">
                                    <div class="presensi-stat-item">
                                        <span class="stat-num text-warning">{{$terlambat}}</span>
                                        <span class="stat-desc">Terlambat</span>
                                    </div>
                                    <div class="presensi-stat-item">
                                        <span class="stat-num text-info">{{$izin_sakit}}</span>
                                        <span class="stat-desc">Izin / Sakit</span>
                                    </div>
                                    <div class="presensi-stat-item">
                                        <span class="stat-num text-danger">{{$total_belum_absen}}</span>
                                        <span class="stat-desc">Belum Absen</span>
                                    </div>
                                </div>
                            </div>

                            <div class="action-buttons" style="margin-top: 20px;">
                                <a href="#" class="btn btn-primary" style="text-decoration: none;">
                                    <i class="fa-solid fa-list-check"></i> Detail Absensi Guru
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Kanan: Ringkasan Penggajian Periode Ini -->
                    <div class="card widget-pengumuman">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-money-bill-wave"></i> Ringkasan Penggajian</h4>
                            <a href="#" class="link-more">Kelola Gaji</a>
                        </div>
                        <div class="card-body">
                            <div class="payroll-summary-box">
                                <div class="payroll-row">
                                    <span>Status Proses:</span>
                                    <strong class="text-success">38 / 45 Selesai</strong>
                                </div>
                                <div class="payroll-row">
                                    <span>Total Gaji Pokok:</span>
                                    <strong>Rp 135.000.000</strong>
                                </div>
                                <div class="payroll-row">
                                    <span>Total Tunjangan:</span>
                                    <strong>Rp 28.500.000</strong>
                                </div>
                                <div class="payroll-row">
                                    <span>Total Potongan:</span>
                                    <strong class="text-danger">- Rp 3.200.000</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- 3. PENGAJUAN PENDING & AKTIVITAS TERBARU (ADMIN) -->
                <div class="dashboard-grid">
                    
                    <!-- Kiri: Daftar Pengajuan Menunggu Approval -->
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-clock-rotate-left"></i> Pengajuan Menunggu Persetujuan</h4>
                            <a href="#" class="link-more">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            <div class="announcement-list">
                                <div class="announcement-item">
                                    <div class="badge-date">28 JUL</div>
                                    <div class="announcement-text">
                                        <h5>Budi Santoso, M.Pd. (Izin Sakit)</h5>
                                        <p>Mengajukan izin sakit 2 hari disertai surat dokter.</p>
                                    </div>
                                </div>
                                <div class="announcement-item">
                                    <div class="badge-date">27 JUL</div>
                                    <div class="announcement-text">
                                        <h5>Siti Rahma, S.Pd. (Cuti Tahunan)</h5>
                                        <p>Mengajukan cuti 3 hari mulai tanggal 1 Agustus 2026.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kanan: Log Aktivitas Terbaru -->
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-wave-square"></i> Aktivitas Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <div class="announcement-list">
                                <div class="announcement-item">
                                    <div class="badge-date" style="background: var(--navy-700);"><i class="fa-solid fa-user-pen"></i></div>
                                    <div class="announcement-text">
                                        <h5>Perubahan Data Guru</h5>
                                        <p>Drs. Hendra memperbarui data sertifikasi & rekening bank.</p>
                                    </div>
                                </div>
                                <div class="announcement-item">
                                    <div class="badge-date" style="background: var(--navy-700);"><i class="fa-solid fa-check-double"></i></div>
                                    <div class="announcement-text">
                                        <h5>Pengajuan Disetujui</h5>
                                        <p>Izin Dinas Luar Siti Aminah telah disetujui Admin.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                @else
                <!-- ==========================================================================
                     DASHBOARD ROLE GURU
                     ========================================================================== -->
                
                <!-- 1. STATISTIC CARDS -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary-light">
                            <i class="fa-solid fa-calendar-check text-primary"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Kehadiran Bulan Ini</span>
                            <h3>{{$total_kehadiran_bulanan}} <small>/ 25 Hari</small></h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-warning-light">
                            <i class="fa-solid fa-user-clock text-warning"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Total Terlambat(menit)</span>
                            <h3>{{$jumlah_terlambat_menit}} <small>menit</small></h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-info-light">
                            <i class="fa-solid fa-mug-hot text-info"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Sisa Cuti Tahunan</span>
                            <h3>8 <small>Hari</small></h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-success-light">
                            <i class="fa-solid fa-wallet text-success"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Gaji Bulan Lalu</span>
                            <h3>Rp 4.500.000</h3>
                        </div>
                    </div>
                </div>

                <!-- 2. MAIN SECTION: PRESENSI & RIWAYAT TERAKHIR -->
                <div class="dashboard-grid">
                    
                    <!-- Kiri: Widget Absensi Hari Ini -->
                    <div class="card widget-presensi">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-location-dot"></i> Presensi Hari Ini</h4>
                            <span class="date-badge">{{$hari}}, {{$tanggal}}</span>
                        </div>
                        <div class="card-body">
                            @if ($sudah_absen)
                                <div class="status-box status-success">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <div>
                                        <h5>Sudah Absen Masuk</h5>
                                        <p>Tercatat pukul {{Carbon\Carbon::parse($waktu_masuk)->translatedFormat("H:i")}} WITA</p>
                                    </div>
                                </div>
                            @else
                                <div class="status-box status-warning">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <div>
                                        <h5>belum Absen Masuk</h5>
                                        <p>anda belum melakukan absen hari ini</p>
                                    </div>
                                </div>
                            @endif

                            <div class="time-tracker">
                                <div class="time-box">
                                    <span class="time-title">Jam Masuk</span>
                                    <span class="time-value">{{$waktu_masuk}}</span>
                                </div>
                                <div class="time-divider"><i class="fa-solid fa-arrow-right"></i></div>
                                <div class="time-box">
                                    <span class="time-title">Jam Pulang</span>
                                    <span class="time-value">{{$waktu_keluar}}</span>
                                </div>
                            </div>

                            <div class="action-buttons">
                                @if($sudah_absen && $waktu_keluar == "00:00:00")
                                    <button class="btn btn-primary" id="btn_keluar">
                                        <i class="fa-solid fa-right-from-bracket"></i> Absen Pulang
                                    </button>
                                @else
                                    <button class="btn btn-primary" id="btn_keluar" disabled>
                                        <i class="fa-solid fa-right-from-bracket"></i> Absen Pulang
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Kanan: Pengumuman Terbaru -->
                    <div class="card widget-pengumuman">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-bullhorn"></i> Pengumuman Sekolah</h4>
                            <a href="#" class="link-more">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            <div class="announcement-list">
                                <div class="announcement-item">
                                    <div class="badge-date">28 JUL</div>
                                    <div class="announcement-text">
                                        <h5>Rapat Persiapan Penilaian Tengah Semester</h5>
                                        <p>Diharapkan seluruh guru hadir di Ruang Rapat Lt. 2 pukul 13:00 WITA...</p>
                                    </div>
                                </div>
                                <div class="announcement-item">
                                    <div class="badge-date">01 AGU</div>
                                    <div class="announcement-text">
                                        <h5>Pelatihan Kurikulum Operasional Satuan Pendidikan</h5>
                                        <p>Wajib bagi seluruh Guru Tetap dan Guru Honorarium Yayasan...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                @endif
        @if(session('eror'))
            <div class="alert alert-danger" id="errorToast">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
                    <div>
                        <p>
                            <i class="fas fa-exclamation-circle" style="color: #e63946;"></i> 
                            {{ session('eror') }}
                        </p>
                    </div>
                    <button type="button" onclick="closeToast()" style="background:none; border:none; color: var(--text-light); cursor:pointer; font-size:1.1rem; line-height:1;">&times;</button>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" id="errorToast">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
                    <div>
                        @foreach ($errors->all() as $error)
                            <p>
                                <i class="fas fa-exclamation-circle" style="color: #e63946;"></i> 
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                    <button type="button" onclick="closeToast()" style="background:none; border:none; color: var(--text-light); cursor:pointer; font-size:1.1rem; line-height:1;">&times;</button>
                </div>
            </div>
        @endif
            </div>
        </main>
    </div>
    <script>
        function closeToast() {
            const toast = document.getElementById('errorToast');
            if (toast) {
                toast.classList.add('fade-out');
                setTimeout(() => {
                    toast.remove();
                }, 400); // Sesuai durasi animasi slideOutRight
            }
        }

        // Otomatis hilangkan error setelah 5 detik
        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('errorToast');
            if (toast) {
                setTimeout(() => {
                    closeToast();
                }, 5000); // 5000ms = 5 detik
            }
        });

        document.getElementById("btn_keluar").addEventListener('click',() => {
            window.location.href = "/gr/klabs";
        })
    </script>
</body>
</html>