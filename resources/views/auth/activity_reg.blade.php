<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk & Daftar - Generasi Rabbani</title>
    
    <!-- Font & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{asset('/css/activity_reg.css')}}">
</head>
<body>

    <div class="auth-card-container">
        <!-- LAYOUT 1: SISI KIRI (INFORMASI SEKOLAH) -->
        <div class="auth-brand-side">
            <div class="brand-overlay"></div>
            <div class="brand-content">
                <div class="brand-logo">
                    <i class="fas fa-quran"></i>
                    <span>Rabbani</span>
                </div>
                <p class="basmalah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                <h2>Mencetak Generasi Berakhlaq <span class="highlight">Al-Qur'an</span></h2>
                <p class="brand-desc">
                    Selamat datang di portal akademik terpadu. Silakan masuk untuk mengakses materi pembelajaran, rekap tahfidz, dan informasi kegiatan santri.
                </p>
                <div class="brand-features">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Sistem Pembelajaran Modern</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Monitoring Tahfidz Real-Time</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- LAYOUT 2: SISI KANAN (FORM INPUT LOGIN / SIGN UP) -->
        <div class="auth-form-side">
            <!-- Navigasi Tab Switcher -->
            <div class="tab-navigation">
                <button class="tab-btn active" id="tabLoginBtn" onclick="switchTab('login')">Masuk</button>
                <button class="tab-btn" id="tabRegisterBtn" onclick="switchTab('register')">Daftar</button>
            </div>

            <!-- FORM 1: LOGIN -->
            <div class="form-wrapper active" id="loginForm">
                <div class="form-header">
                    <h3>Selamat Datang Kembali! 👋</h3>
                    <p>Masukkan akun kamu untuk melanjutkan</p>
                </div>
                <form action="/reg/login" method="POST">
                    @csrf
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input name="username" type="text" placeholder="username" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input name="password" type="password" placeholder="Kata Sandi" required>
                    </div>
                    <div class="form-options">
                        <!-- <label class="remember-me">
                            <input type="checkbox"> Ingat saya
                        </label> -->
                        <a href="#" class="forgot-pass">Lupa Sandi?</a>
                    </div>
                    <button type="submit" class="btn-submit">Masuk Sekarang</button>
                </form>
            </div>

            <!-- FORM 2: REGISTER -->
            <div class="form-wrapper" id="registerForm">
                <div class="form-header">
                    <h3>Buat Akun Baru 🚀</h3>
                    <p>Lengkapi data di bawah untuk mendaftar</p>
                </div>
                <form action="/reg/sign" method="POST">
                    @csrf
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input name ="email" type="email" placeholder="email" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input name ="username" type="text" placeholder="username" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input name="noWa" type="text" placeholder="nomor wa" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <select name="gender" >
                            <option value="p">Perempuan</option>
                            <option value="l">Laki-Laki</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input name="kode" type="text" placeholder="kode identitas" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input name="password" type="password" placeholder="Kata Sandi" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-shield-alt"></i>
                        <input name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" required>
                    </div>
                    <button type="submit" class="btn-submit">Daftar Akun</button>
                </form>
            </div>

            <a href="/" class="back-home"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
        </div>
        <x-warning />
    </div>
    <!-- JavaScript untuk Switch Tab Form -->
</body>
</html>