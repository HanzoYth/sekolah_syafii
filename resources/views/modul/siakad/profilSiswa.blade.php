<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Profil</title>

    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/css/modul/guru/das_ad_gr.css')}}">
    <link rel="stylesheet" href="{{asset('/css/modul/siakad/profilSiswa.css')}}">
</head>
<body>

    <div class="app-layout">

        <!-- INCLUDE SIDEBAR -->
        <x-sidebar_siakad />

        <!-- MAIN CONTENT AREA -->
        <main class="main-content">

            <header class="topbar">
                <div class="page-title">
                    <h2>Profil Saya</h2>
                    <p>Data lengkap akun dan informasi siswa</p>
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

                <!-- HEADER PROFIL: foto + nama + tombol ganti foto -->
                <div class="profile-header">
                    <div class="avatar-wrap">
                        <img class="avatar-xl" src="#" alt="Foto Profil">
                        <label for="input_foto" class="avatar-edit-btn" title="Ganti Foto">
                            <i class="fa-solid fa-camera"></i>
                        </label>
                        <form action="/sk/pr/foto" method="POST" enctype="multipart/form-data" id="form_foto">
                            @csrf
                            <input type="file" name="foto" id="input_foto" accept="image/*" style="display:none" onchange="document.getElementById('form_foto').submit()">
                        </form>
                    </div>
                    <div class="profile-header-info">
                        <h2>Rafly</h2>
                        <p>23665 &middot; Kelas 2A</p>
                        <span class="status-pill">
                            <i class="fa-solid fa-circle" style="font-size:8px;"></i> Siswa Aktif
                        </span>
                    </div>
                </div>

                <!-- DATA PRIBADI -->
                <h3 class="info-section-title"><i class="fa-solid fa-id-card"></i> Data Pribadi</h3>
                <div class="info-card">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">NISN</span>
                            <span class="info-value">23442</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Jenis Kelamin</span>
                            <span class="info-value">Laki - Laki</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tempat, Tanggal Lahir</span>
                            <span class="info-value">Palu, 15 Maret 2025</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Nomor HP</span>
                            <span class="info-value">085655433321</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value">Zuanax@gmail.com</span>
                        </div>
                        <div class="info-item full">
                            <span class="info-label">Alamat</span>
                            <span class="info-value">Jl.Dewi Satra</span>
                        </div>
                    </div>
                </div>

                <!-- DATA AKADEMIK -->
                <h3 class="info-section-title"><i class="fa-solid fa-graduation-cap"></i> Data Akademik</h3>
                <div class="info-card">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Tahun Masuk</span>
                            <span class="info-value">2026</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Wali Kelas</span>
                            <span class="info-value">Subaidah</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Kelas</span>
                            <span class="info-value">2A</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status Siswa</span>
                            <span class="info-value">Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- DATA ORANG TUA / WALI -->
                <h3 class="info-section-title"><i class="fa-solid fa-people-roof"></i> Data Orang Tua / Wali</h3>
                <div class="info-card">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Nama Ayah</span>
                            <span class="info-value">Zianax</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Nama Ibu</span>
                            <span class="info-value">Zuanax</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Pekerjaan Orang Tua</span>
                            <span class="info-value">Pegawai Negeri Sipil</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Nomor HP Orang Tua</span>
                            <span class="info-value">089999887787</span>
                        </div>
                        <div class="info-item full">
                            <span class="info-label">Alamat Orang Tua</span>
                            <span class="info-value">Jl.Sigma</span>
                        </div>
                    </div>
                </div>

                <!-- GANTI PASSWORD -->
                <h3 class="info-section-title"><i class="fa-solid fa-lock"></i> Keamanan Akun</h3>
                <div class="info-card">
                    <form class="password-form" action="/sk/pr/password" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="password_lama">Password Lama</label>
                            <input type="password" name="password_lama" id="password_lama" required>
                        </div>
                        <div class="form-group">
                            <label for="password_baru">Password Baru</label>
                            <input type="password" name="password_baru" id="password_baru" required>
                        </div>
                        <div class="form-group">
                            <label for="password_konfirmasi">Konfirmasi Password Baru</label>
                            <input type="password" name="password_konfirmasi" id="password_konfirmasi" required>
                        </div>
                        <div class="action-buttons">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-key"></i> Simpan Password
                            </button>
                        </div>
                    </form>
                </div>

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