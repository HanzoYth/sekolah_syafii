<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Dashboard</title>

    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/css/modul/guru/das_ad_gr.css')}}">
    <link rel="stylesheet" href="{{asset('/css/modul/siakad/dashboardSiswa.css')}}">
</head>
<body>

    <div class="app-layout">

        <!-- INCLUDE SIDEBAR -->
        <x-sidebar_siakad />

        <!-- MAIN CONTENT AREA -->
        <main class="main-content">

            {{-- CHANGED: topbar disederhanakan, profil TIDAK lagi di kanan atas --}}
            @php
                $jam = now()->hour;
                $sapaan = $jam < 11 ? 'pagi' : ($jam < 15 ? 'siang' : ($jam < 19 ? 'sore' : 'malam'));
            @endphp
            <header class="topbar">
                <div class="page-title">
                    <h2>Dashboard Siswa</h2>
                    <p>Selamat {{$sapaan}}, <strong>Rafly</strong></p>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <div class="content-body">

                <!-- FLASH MESSAGES / ERROR TOAST -->
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

                {{-- CHANGED: PROFIL — card tersendiri, disusun ke bawah, info ringkas saja
                     (bukan selengkap halaman Profil: cukup foto, nama, NIS, kelas) --}}
                <div class="profile-card">
                    <img class="avatar-lg" src="#" alt="Foto Profil">
                    <h3>Rafly</h3>
                    <ul class="profile-meta">
                        <li><i class="fa-solid fa-id-badge"></i> NIS: 2026001</li>
                        <li><i class="fa-solid fa-chalkboard"></i> Kelas 1A</li>
                    </ul>
                </div>

                <!-- WIDGET: Ringkasan Status Pembayaran (tetap ringkas, bukan selengkap Slip Pembayaran) -->
                <div class="dashboard-grid">
                    <div class="card widget-presensi">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-file-invoice-dollar"></i> Status Pembayaran</h4>
                            <span class="date-badge">2026/2027</span>
                        </div>
                        <div class="card-body">
                            <div class="status-box status-success">
                                <i class="fa-solid fa-circle-check"></i>
                                <div class="status-info">
                                    <h5>Pembayaran Lunas</h5>
                                    <p>Tidak ada tunggakan untuk periode ini</p>
                                </div>
                            </div>

                            <div class="time-tracker">
                                <div class="time-box">
                                    <span class="time-title">Total Tagihan</span>
                                    <span class="time-value">Rp 1.000.000</span>
                                </div>
                                <div class="time-divider"><i class="fa-solid fa-arrow-right"></i></div>
                                <div class="time-box">
                                    <span class="time-title">Sudah Dibayar</span>
                                    <span class="time-value">Rp 2.000.000</span>
                                </div>
                            </div>

                            <div class="action-buttons">
                                <a href="/sk/pbs" class="btn btn-primary">
                                    <i class="fa-solid fa-receipt"></i> Lihat Slip Pembayaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
    <x-chatbot />
    <script>
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
        });
    </script>
</body>
</html>