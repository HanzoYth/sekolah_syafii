<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS Guru - Dashboard</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/css/modul/guru/das_ad_gr.css')}}">
    <link rel="stylesheet" href="{{asset('/css/modul/guru/dashboard_guru.css')}}    ">
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
                    <h2>Dashboard Utama</h2>
                    <p>Selamat datang kembali, <strong>{{$data_guru->nama}}</strong></p>
                </div>
                <div class="topbar-actions">
                    <button class="icon-btn" title="Notifikasi">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot"></span>
                    </button>
                    <div class="user-profile">
                        <img src="{{ route('file.show',$data_guru->url_foto)}}" alt="Foto Profil">
                        <div class="user-info">
                            <span class="name">{{$data_guru->nama}}</span>
                            <span class="role">{{$data_guru->guru_tetap ? "guru tetap" : "guru honor"}}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <div class="content-body">
                <!-- Hidden Input Koordinat Lokasi Sekolah (Data Dummy) -->
                <input type="hidden" class="latitude" value="{{$latitude}}">
                <input type="hidden" class="longitude" value="{{$longitude}}">
                
                <!-- 1. STATISTIC CARDS -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary-light">
                            <i class="fa-solid fa-calendar-check text-primary"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Kehadiran Bulan Ini</span>
                            <h3>{{$jumlah_kehadiran_bulanan}}<small>/ 25 Hari</small></h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-warning-light">
                            <i class="fa-solid fa-user-clock text-warning"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Total Terlambat(menit)</span>
                            <small>belum di publish oleh admin</small>
                            <!-- <h3>15 <small>menit</small></h3> -->
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-info-light">
                            <i class="fa-solid fa-mug-hot text-info"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Jumlah Pengajuan</span>
                            <h3>0</h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-success-light">
                            <i class="fa-solid fa-wallet text-success"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Gaji Bulan Lalu</span>
                            <small>belum di publish oleh admin</small>
                            <!-- <h3>Rp 4.500.000</h3> -->
                        </div>
                    </div>
                </div>

                <!-- 2. MAIN SECTION: PRESENSI & RIWAYAT TERAKHIR -->
                <div class="dashboard-grid">
                    
                    <!-- Widget Absensi Hari Ini -->
                    <div class="card widget-presensi">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-location-dot"></i> Presensi Hari Ini</h4>
                            <span class="date-badge">{{$nama_hari}}, {{$tanggal_hari_ini}}</span>
                        </div>
                        <div class="card-body">
                            @if ($cek_sudah_absen)
                                <div class="status-box status-success">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <div>
                                        <h5>Sudah Absen Masuk</h5>
                                        <p>Tercatat pukul {{Carbon\Carbon::parse($jam_masuk)->translatedFormat('H:i')}} WITA</p>
                                    </div>
                                </div>
                            @else
                                @if ($cek_status_absen)
                                    @if ($status_absen->status_kehadiran == 's')
                                        <div class="status-box status-warning">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            <div>
                                                <h5>Anda Di Statuskan Sakit</h5>
                                                <p>semoga lekas sembuh</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="status-box status-warning">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            <div>
                                                <h5>Anda Di Statuskan Izin</h5>
                                                <p>semoga urusannya di lancarkan</p>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="status-box status-warning">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        <div>
                                            <h5>Belum Melakukan Absen</h5>
                                            <p>harap melakukan absen segera</p>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <div class="time-tracker">
                                <div class="time-box">
                                    <span class="time-title">Jam Masuk</span>
                                    <span class="time-value">{{$jam_masuk}}</span>
                                </div>
                                <div class="time-divider"><i class="fa-solid fa-arrow-right"></i></div>
                                <div class="time-box">
                                    <span class="time-title">Jam Pulang</span>
                                    <span class="time-value">{{$jam_keluar}}</span>
                                </div>
                            </div>

                            <!-- Element untuk Menampilkan Pesan Radius Geolocation -->
                            <div id="location-status" style="margin-top: 15px; font-size: 0.9rem;"></div>
                            @if($cek_sudah_absen && $cek_sudah_keluar && !$cek_sudah_absen_oleh_admin)
                                <div class="action-buttons" style="margin-top: 15px;">
                                    <button class="btn btn-primary" id="btn_keluar" data-status="boleh">
                                        <i class="fa-solid fa-right-from-bracket"></i> Absen Pulang
                                    </button>
                                </div>
                            @else
                                <div class="action-buttons" style="margin-top: 15px;">
                                    <button class="btn btn-primary" id="btn_keluar" data-status="boleh" disabled>
                                        <i class="fa-solid fa-right-from-bracket"></i> Absen Pulang
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Pengumuman Terbaru -->
                    <div class="card widget-pengumuman">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-bullhorn"></i> Pengumuman Sekolah</h4>
                            <a href="/gr/pggr" class="link-more">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            <div class="announcement-list">
                                @foreach ($data_pengumuman as $value)
                                    <div class="announcement-item">
                                        <div class="badge-date">{{Carbon\Carbon::parse($value->tanggal)->translatedFormat("d")}} {{strtoupper(Carbon\Carbon::parse($value->tanggal)->translatedFormat("M"))}}</div>
                                        <div class="announcement-text">
                                            <h5>{{$value->judul}}</h5>
                                            <p>{{$value->isi}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>
    <x-warning />

    <!-- JAVASCRIPT LOGIC -->
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(
                function (position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;

                    const latInput = document.querySelector(".latitude");
                    const lngInput = document.querySelector(".longitude");

                    if (!latInput || !lngInput) return;

                    let data_latitude = parseFloat(latInput.value);
                    let data_longitude = parseFloat(lngInput.value);

                    const distance = calculateDistance(data_latitude, data_longitude, userLat, userLng);
                    
                    const statusElement = document.getElementById('location-status');
                    const button = document.getElementById("btn_keluar");

                    if (distance <= 500) {
                        if (statusElement) {
                            statusElement.className = "location-status status-ok";
                            statusElement.innerHTML = `<i class="fa-solid fa-circle-check" style="color: #2ec4b6;"></i> Anda berada dalam radius presensi (${Math.round(distance)} meter dari sekolah).`;
                        }
                    } else {
                        if (statusElement) {
                            statusElement.className = "location-status status-warn";
                            statusElement.innerHTML = `<i class="fa-solid fa-triangle-exclamation" style="color: #e63946;"></i> Anda di luar radius presensi (${Math.round(distance)} meter dari sekolah).`;
                        }
                        if (button && button.dataset.status == "boleh") {
                            button.setAttribute("disabled", "");
                        }
                    }
                },
                function (error) {
                    console.warn("Gagal mendapatkan lokasi: " + error.message);
                },
                {
                    enableHighAccuracy: true
                }
            );
        } else {
            alert("Browser Anda tidak mendukung Geolocation.");
        }

        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371e3; // Radius bumi dalam meter
            const φ1 = lat1 * Math.PI / 180;
            const φ2 = lat2 * Math.PI / 180;
            const Δφ = (lat2 - lat1) * Math.PI / 180;
            const Δλ = (lon2 - lon1) * Math.PI / 180;

            const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                    Math.cos(φ1) * Math.cos(φ2) *
                    Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            return R * c; 
        }

        function closeToast() {
            const toast = document.getElementById('errorToast');
            if (toast) {
                toast.classList.add('fade-out');
                setTimeout(() => {
                    toast.remove();
                }, 400);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('errorToast');
            if (toast) {
                setTimeout(() => {
                    closeToast();
                }, 5000);
            }

            const btnKeluar = document.getElementById("btn_keluar");
            if (btnKeluar) {
                btnKeluar.addEventListener('click', () => {
                    window.location.href = "/gr/klabs";
                });
            }
        });
    </script>
</body>
</html>