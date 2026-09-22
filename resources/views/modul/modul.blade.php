<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Modul - Sekolah Al-Qur'an Imam Syafi'i</title>
    
    <!-- Google Fonts: Poppins & Amiri -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk Ikon -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/module.css') }}?v={{ time() }}">
</head>
<body>

    <!-- Container Utama (Di Tengah Layar) -->
    <div class="module-container">
        
        <!-- Header Dalam Container -->
        <div class="module-header">
            <p class="basmalah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
            <h2>Pilih Portal Layanan</h2>
            <p class="subtitle">Silakan pilih modul sistem yang ingin Anda akses</p>
        </div>

        <!-- Grid 2 Kotak Modul -->
        <div class="module-grid">
            @if (session("role") == "a" || session("role") == "g" || session("role") == "s" || session("role") == "b")
                <!-- KOTAK 1: MODUL SIAKAD -->
                @if (session("role") == "a")
                    <a href="/sk/das" class="module-card siakad">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <h3>Modul SIAKAD</h3>
                        <p>Sistem Informasi Akademik untuk pengelolaan nilai, jadwal pelajaran, presensi, dan data santri.</p>
                        <div class="card-action">
                            <span>Akses SIAKAD</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </a>
                @elseif (session("role") == "g")
                    <a href="/sk/dsg" class="module-card siakad">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <h3>Modul SIAKAD</h3>
                        <p>Sistem Informasi Akademik untuk pengelolaan nilai, jadwal pelajaran, presensi, dan data santri.</p>
                        <div class="card-action">
                            <span>Akses SIAKAD</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </a>
                @else
                    <a href="/sk/dbs" class="module-card siakad">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <h3>Modul SIAKAD</h3>
                        <p>Sistem Informasi Akademik untuk pengelolaan nilai, jadwal pelajaran, presensi, dan data santri.</p>
                        <div class="card-action">
                            <span>Akses SIAKAD</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </a>
                @endif
            @endif
            @if (session("role") == "a" || session("role") == "g" || session("role") == "s")
                <!-- KOTAK 2: MODUL TAHFIDZ -->
                <a href='/tf/das' class="module-card tahfidz">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-quran"></i>
                    </div>
                    <h3>Modul Tahfidz</h3>
                    <p>Sistem Monitoring Hafalan Al-Qur'an, setoran mutaba'ah harian, dan rekapitulasi juz santri.</p>
                    <div class="card-action">
                        <span>Akses Tahfidz</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            @endif
            @if (session("role") == "a" || session("role") == "g")
                <a href="{{session('role') == 'a' ? '/gr/dasa' : '/gr/das'}}" class="module-card guru">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3>Modul Guru</h3>
                    <p>Sistem Guru.</p>
                    <div class="card-action">
                        <span>Akses Guru</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            @endif

            @if (session("role") == "a")
                <a href="{{session('role') == 'a' ? '/gr/dasa' : '/gr/das'}}" class="module-card guru">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3>Modul Staf</h3>
                    <p>Sistem Untuk Gaji Untuk Para Staf 'bendahara,operator,satpam'</p>
                    <div class="card-action">
                        <span>Akses Modul Staf</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            @endif

            @if (session("role") == "b")
                <a href="{{session('role') == 'a' ? '/gr/dasa' : '/gr/das'}}" class="module-card guru">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3>Bendahara</h3>
                    <p>Sistem Untuk Bendahara</p>
                    <div class="card-action">
                        <span>Akses Modul Bendahara</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            @endif

            @if (session("role") == "o")
                <a href="{{session('role') == 'a' ? '/gr/dasa' : '/gr/das'}}" class="module-card guru">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3>Operator</h3>
                    <p>Sistem Untuk Operator</p>
                    <div class="card-action">
                        <span>Akses Modul Operator</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            @endif

            @if (session("role") == "p")
                <a href="{{session('role') == 'a' ? '/gr/dasa' : '/gr/das'}}" class="module-card guru">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3>Satpam</h3>
                    <p>Sistem Untuk Satpam</p>
                    <div class="card-action">
                        <span>Akses Modul Satpam</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            @endif

            @if (session("role") == "y")
                <a href="{{session('role') == 'a' ? '/gr/dasa' : '/gr/das'}}" class="module-card guru">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3>Ketuan Yayasan</h3>
                    <p>Sistem Untuk Ketua Yayasan</p>
                    <div class="card-action">
                        <span>Akses Modul Ketua Yayasan</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            @endif

        </div>

        <!-- Footer Dalam Container -->
        <div class="module-footer">
            <a href="/reg/logout" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar / Kembali
            </a>
        </div>

    </div>

</body>
</html>