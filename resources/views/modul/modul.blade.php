<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Modul - Sekolah Al-Qur'an Imam Syafi'i</title>
    
    <!-- Google Fonts: Poppins & Amiri -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="./css/module.css">
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
            
            <!-- KOTAK 1: MODUL SIAKAD -->
            <a href="siakad-dashboard.html" class="module-card siakad">
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

            <!-- KOTAK 2: MODUL TAHFIDZ -->
            <a href="tahfidz-dashboard.html" class="module-card tahfidz">
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

            <a href="/gr/das" class="module-card guru">
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