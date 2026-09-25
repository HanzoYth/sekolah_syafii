<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS Guru - Dashboard Admin</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/modul/guru/das_ad_gr.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/modul/guru/dashboard_admin.css')}}?v={{ time() }}">
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
                                
                                <!-- Trigger Modal 1: Tepat Waktu -->
                                <div class="status-box status-success clickable-card" onclick="openModal('modalTepatWaktu')">
                                    <i class="fa-solid fa-user-check"></i>
                                    <div>
                                        <h5>{{$jumlah_guru_tepat_waktu}} Guru Tepat Waktu</h5>
                                        <p>Tercatat masuk sebelum pukul 07:00 WITA</p>
                                    </div>
                                </div>
                                
                                <div class="admin-presensi-stats">
                                    <!-- Trigger Modal 2: Terlambat (Anak Ke-1) -->
                                    <div class="presensi-stat-item clickable-card" onclick="openModal('modalTerlambat')">
                                        <span class="stat-num text-warning">{{$jumlah_terlambat}}</span>
                                        <span class="stat-desc">Terlambat</span>
                                    </div>
                                    
                                    <!-- Trigger Modal 3: Izin / Sakit (Anak Ke-2) -->
                                    <div class="presensi-stat-item clickable-card" onclick="openModal('modalIzinSakit')">
                                        <span class="stat-num text-info">{{$jumlah_izin}}/{{$jumlah_sakit}}</span>
                                        <span class="stat-desc">Izin / Sakit</span>
                                    </div>
                                    
                                    <!-- Trigger Modal 4: Belum Absen (Anak Ke-3) -->
                                    <div class="presensi-stat-item clickable-card" onclick="openModal('modalBelumAbsen')">
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

    <!-- ==================== STRUKTUR MODAL / POP UP ==================== -->
    @php
        Carbon\Carbon::setlocale("id");
        $data_guru_tepat_waktu = App\Models\master_absen_guru::where("tgl_masuk",Carbon\Carbon::now()->translatedFormat("Y-m-d"))->where("status_kehadiran","h")->where("terlambat_menit",0)->get();
        $data_guru_izin_sakit = App\Models\master_absen_guru::where("tgl_masuk",Carbon\Carbon::now()->translatedFormat("Y-m-d"))->where("status_kehadiran","!=","h")->where("status_kehadiran","!=","a")->get();
        $data_guru_terlambat = App\Models\master_absen_guru::where("tgl_masuk",Carbon\Carbon::now()->translatedFormat("Y-m-d"))->where("status_kehadiran","h")->where("terlambat_menit","!=",0)->get();
    @endphp
    <!-- Modal 1: Guru Tepat Waktu -->
    <div id="modalTepatWaktu" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3><i class="fa-solid fa-circle-check text-success"></i> Daftar Guru Tepat Waktu</h3>
                <button class="modal-close-btn" onclick="closeModal('modalTepatWaktu')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="modal-table">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Guru</th>
                                <th>Jam Masuk</th>
                                <th>Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_guru_tepat_waktu as $data)
                                @php
                                    $data_guru = App\Models\guru::where("id",$data->guru_id)->first();
                                @endphp
                                <tr>
                                    <td><img src="{{route('file.show',$data_guru->url_foto)}}" class="avatar-img" alt="Foto"></td>
                                    <td><strong>{{$data_guru->nama}}</strong></td>
                                    <td><span class="time-badge">{{Carbon\Carbon::parse($data->waktu_masuk)->translatedFormat("H:i")}} WITA</span></td>
                                    <td><span class="badge badge-success">Tepat Waktu</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2: Guru Terlambat -->
    <div id="modalTerlambat" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3><i class="fa-solid fa-clock text-warning"></i> Daftar Guru Terlambat</h3>
                <button class="modal-close-btn" onclick="closeModal('modalTerlambat')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="modal-table">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Guru</th>
                                <th>Terlambat</th>
                                <th>Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_guru_terlambat as $data)
                                @php
                                    $data_guru = App\Models\guru::where("id",$data->guru_id)->first();
                                @endphp
                                    <tr>
                                        <td><img src="{{route('file.show',$data_guru->url_foto)}}" class="avatar-img" alt="Foto"></td>
                                        <td><strong>{{$data_guru->nama}}</strong></td>
                                        <td><span class="time-badge danger">{{$data->terlambat_menit}} Menit ({{Carbon\Carbon::parse($data->waktu_masuk)->translatedFormat("H:i")}})</span></td>
                                        <td><span class="badge badge-warning">Terlambat</span></td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3: Guru Izin / Sakit -->
    <div id="modalIzinSakit" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3><i class="fa-solid fa-file-medical text-info"></i> Daftar Guru Izin & Sakit</h3>
                <button class="modal-close-btn" onclick="closeModal('modalIzinSakit')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="modal-table">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Guru</th>
                                <th>Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_guru_izin_sakit as $data)
                                @php
                                    $data_guru = App\Models\guru::where("id",$data->guru_id)->first();
                                @endphp
                                @if ($data->status_kehadiran == "s")
                                    <tr>
                                        <td><img src="{{route('file.show',$data_guru->url_foto)}}" class="avatar-img" alt="Foto"></td>
                                        <td><strong>{{$data_guru->nama}}</strong></td>
                                        <td><span class="badge badge-info">Sakit</span></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td><img src="{{route('file.show',$data_guru->url_foto)}}" class="avatar-img" alt="Foto"></td>
                                        <td><strong>{{$data_guru->nama}}</strong></td>
                                        <td><span class="badge badge-purple">Izin</span></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 4: Guru Belum Absen -->
    <div id="modalBelumAbsen" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3><i class="fa-solid fa-user-xmark text-danger"></i> Daftar Guru Belum Absen</h3>
                <button class="modal-close-btn" onclick="closeModal('modalBelumAbsen')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="modal-table">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Guru</th>
                                <th>Status Kehadiran</th>
                                <th>Aksi Notifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (App\Models\guru::all() as $data)
                                @if (!App\Models\master_absen_guru::where("guru_id",$data->id)->where("tgl_masuk",Carbon\Carbon::now()->translatedFormat("Y-m-d"))->exists())
                                    <tr>
                                        <td><img src="{{route('file.show',$data->url_foto)}}" class="avatar-img" alt="Foto"></td>
                                        <td><strong>{{$data->nama}}</strong></td>
                                        <td><span class="badge badge-danger">Belum Absen</span></td>
                                        <td>
                                            <button class="btn-action-send" data-id = '{{$data->id}}'>
                                                <i class="fa-solid fa-paper-plane"></i> Pengingat
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-warning />

    <!-- JavaScript Event Listener untuk Elemen DOM -->
    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('active');
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('active');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Targetkan div utama untuk Tepat Waktu
            const successBox = document.querySelector('.status-box.status-success');
            if (successBox) {
                successBox.style.cursor = 'pointer';
                successBox.addEventListener('click', function() {
                    openModal('modalTepatWaktu');
                });
            }

            // Targetkan 3 div di dalam container admin-presensi-stats
            const statItems = document.querySelectorAll('.admin-presensi-stats .presensi-stat-item');
            
            if (statItems.length >= 3) {
                // Div 1: Terlambat
                statItems[0].style.cursor = 'pointer';
                statItems[0].addEventListener('click', function() {
                    openModal('modalTerlambat');
                });

                // Div 2: Izin / Sakit
                statItems[1].style.cursor = 'pointer';
                statItems[1].addEventListener('click', function() {
                    openModal('modalIzinSakit');
                });

                // Div 3: Belum Absen
                statItems[2].style.cursor = 'pointer';
                statItems[2].addEventListener('click', function() {
                    openModal('modalBelumAbsen');
                });
            }
        });

        document.querySelectorAll(".btn-action-send").forEach((value) => {
            value.addEventListener("click",(e) => {
                window.location.href = `/krim/${e.target.dataset.id}`;
            }); 
        })
        // Tutup modal jika area luar (overlay) diklik
        window.addEventListener('click', function(e) {
            if (e.target.classList.contains('modal-overlay')) {
                e.target.classList.remove('active');
            }
        });
    </script>
</body>
</html>