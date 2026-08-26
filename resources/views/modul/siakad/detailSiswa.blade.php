<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa - Islamic Smart School</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/modul/siakad/detailsiswa.css')}}">
</head>
<body>

<div class="app-shell">
   

    <div class="main-content">
        <header class="topbar">
            <div class="topbar-inner">
                <div class="topbar-title">
                    <span class="font-arabic">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</span>
                    <h1>Detail Data Santri / Siswa</h1>
                    <p>Informasi Lengkap Profil &amp; Akademik Siswa</p>
                </div>
                <a href="{{ url()->previous() }}" class="btn btn-outline">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
        </header>

        <main class="page">
            <div class="detail-grid">
                <!-- Profil Card -->
                <div class="card profile-card">
                    <div class="avatar-wrapper">
                        <div class="avatar-large">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div>
                    <h2 class="profile-name">Ahmad Al-Fatih</h2>
                    <span class="badge badge-laki"><i class="fa-solid fa-mars"></i> Laki-laki</span>
                    <div class="profile-meta">
                        <span class="badge-kelas">X-A Tahfidz</span>
                    </div>
                </div>

                <!-- Detail Info Card -->
                <div class="card detail-info-card">
                    <h3 class="card-title"><i class="fa-solid fa-id-card"></i> Informasi Pribadi &amp; Akademik</h3>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <label>NISN</label>
                            <p>0051234567</p>
                        </div>
                        <div class="info-item">
                            <label>NIS</label>
                            <p>202301</p>
                        </div>
                        <div class="info-item">
                            <label>Tempat, Tanggal Lahir</label>
                            <p>Jakarta, 12 Ramadhan 1426 H / 15 Oktober 2005</p>
                        </div>
                        <div class="info-item">
                            <label>Program Studi / Kelas</label>
                            <p>X-A Tahfidz Al-Qur'an</p>
                        </div>
                        <div class="info-item full-width">
                            <label>Alamat Lengkap</label>
                            <p>Jl. Pesantren No. 45, Komplek Islamic Center, Jakarta Selatan</p>
                        </div>
                    </div>

                    <h3 class="card-title mt-20"><i class="fa-solid fa-user-group"></i> Informasi Orang Tua / Wali</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Nama Ayah</label>
                            <p>Muhammad Ibrahim</p>
                        </div>
                        <div class="info-item">
                            <label>Nama Ibu</label>
                            <p>Siti Aminah</p>
                        </div>
                        <div class="info-item">
                            <label>No. WhatsApp Orang Tua</label>
                            <p>+62 812-3456-7890</p>
                        </div>
                    </div>

                   
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>