<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Akademik — Sekolah Islam Al-Qur'an Imam Syafi'i</title>

    <!-- Font & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('/css/activity_reg.css') }}?v={{ time() }}">
</head>
<body>

    <!-- Layer Background & Ornamen Parallax (Dipertahankan) -->
    <div class="auth-bg-layer" style="background-image: url('{{ asset('img/bg_skl.jpeg') }}?v={{ time() }}');" data-mouse-speed="-14"></div>
    <div class="auth-pattern-overlay" data-mouse-speed="18"></div>
    <div class="auth-glow-orb"></div>

    <!-- Card Tunggal Tanpa Gambar di Dalam Card -->
    <div class="auth-card-container" id="authCard">
        <div class="auth-card-top-accent"></div>

        <div class="auth-card-inner">
            <!-- Header Identitas Sekolah -->
            <div class="auth-identity-header">
                <a href="/" class="auth-seal-link" title="Kembali ke Beranda">
                    <img src="{{ asset('img/logo.png') }}?v={{ time() }}" alt="Logo Sekolah Islam Al-Qur'an Imam Syafi'i">
                </a>
                <p class="auth-basmalah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                <h1 class="auth-school-name">Sekolah Islam Al-Qur'an Imam Syafi'i</h1>
                <p class="auth-portal-subtitle">Portal Sistem Informasi Terpadu</p>
            </div>

            <!-- Navigasi Tab Editorial -->
            <div class="tab-navigation" role="tablist">
                <button type="button" class="tab-btn active" id="tabLoginBtn" onclick="switchTab('login')">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk Portal
                </button>
                <button type="button" class="tab-btn" id="tabRegisterBtn" onclick="switchTab('register')">
                    <i class="fa-solid fa-user-plus"></i> Aktivasi Akun
                </button>
            </div>

            <!-- FORM 1: LOGIN -->
            <div class="form-wrapper active" id="loginForm">
                <form action="/reg/login" method="POST">
                    @csrf
                    <div class="field-group">
                        <div class="field-label-row">
                            <label class="field-label" for="loginUsername">Username</label>
                        </div>
                        <div class="input-group">
                            <i class="fa-solid fa-user"></i>
                            <input id="loginUsername" name="username" type="text" placeholder="Masukkan username akun" value="{{ old('username') }}" autocomplete="username" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <div class="field-label-row">
                            <label class="field-label" for="loginPassword">Kata Sandi</label>
                            <a href="/reg/lps" class="forgot-pass">Lupa kata sandi?</a>
                        </div>
                        <div class="input-group">
                            <i class="fa-solid fa-lock"></i>
                            <input id="loginPassword" class="has-toggle" name="password" type="password" placeholder="Masukkan kata sandi" autocomplete="current-password" required>
                            <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('loginPassword', this)" title="Tampilkan/Sembunyikan Sandi"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <span>Masuk ke Sistem</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>
            </div>

            <!-- FORM 2: REGISTER -->
            <div class="form-wrapper" id="registerForm">
                <p class="form-section-note">
                    Gunakan <strong>Kode Identitas</strong> yang diberikan oleh pihak sekolah untuk mengaktifkan akun baru.
                </p>

                <form action="/reg/sign" method="POST">
                    @csrf
                    <div class="input-row-2">
                        <div class="field-group">
                            <label class="field-label" for="regEmail">Alamat Email</label>
                            <div class="input-group">
                                <i class="fa-solid fa-envelope"></i>
                                <input id="regEmail" name="email" type="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="regUsername">Username</label>
                            <div class="input-group">
                                <i class="fa-solid fa-user"></i>
                                <input id="regUsername" name="username" type="text" placeholder="Buat username" value="{{ old('username') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="input-row-2">
                        <div class="field-group">
                            <label class="field-label" for="regNoWa">Nomor WhatsApp</label>
                            <div class="input-group">
                                <i class="fa-brands fa-whatsapp"></i>
                                <input id="regNoWa" name="noWa" type="text" placeholder="08xxxxxxxxxx" value="{{ old('noWa') }}" required>
                            </div>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="regKode">Kode Identitas</label>
                            <div class="input-group">
                                <i class="fa-solid fa-key"></i>
                                <input id="regKode" name="kode" type="text" placeholder="Kode dari sekolah" value="{{ old('kode') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="input-row-2">
                        <div class="field-group">
                            <label class="field-label" for="registerPassword">Kata Sandi Baru</label>
                            <div class="input-group">
                                <i class="fa-solid fa-lock"></i>
                                <input id="registerPassword" class="has-toggle" name="password" type="password" placeholder="Min. 8 karakter" required>
                                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('registerPassword', this)"></i>
                            </div>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="registerPasswordConfirmation">Konfirmasi Sandi</label>
                            <div class="input-group">
                                <i class="fa-solid fa-shield-halved"></i>
                                <input id="registerPasswordConfirmation" class="has-toggle" name="password_confirmation" type="password" placeholder="Ulangi kata sandi" required>
                                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('registerPasswordConfirmation', this)"></i>
                            </div>
                        </div>
                    </div>

                    <div class="password-hint">
                        <i class="fa-solid fa-circle-info"></i>
                        Minimal 8 karakter dengan kombinasi huruf besar, huruf kecil, dan angka.
                    </div>

                    <button type="submit" class="btn-submit">
                        <span>Aktifkan & Daftar Akun</span>
                        <i class="fa-solid fa-check"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer Bar Card -->
        <div class="auth-card-footer">
            <a href="/" class="back-home">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
            </a>
            <a href="/prof?halaman=kontak" class="footer-help-link">
                Hubungi Admin Sekolah
            </a>
        </div>

        <x-warning />
    </div>

    <script>
        function switchTab(tab) {
            const authCard = document.getElementById('authCard');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const tabLoginBtn = document.getElementById('tabLoginBtn');
            const tabRegisterBtn = document.getElementById('tabRegisterBtn');

            if (tab === 'login') {
                loginForm.classList.add('active');
                registerForm.classList.remove('active');
                tabLoginBtn.classList.add('active');
                tabRegisterBtn.classList.remove('active');
                if (authCard) authCard.classList.remove('is-register');
            } else {
                registerForm.classList.add('active');
                loginForm.classList.remove('active');
                tabRegisterBtn.classList.add('active');
                tabLoginBtn.classList.remove('active');
                if (authCard) authCard.classList.add('is-register');
            }
        }

        function togglePassword(inputId, iconElement) {
            const input = document.getElementById(inputId);
            if (!input) return;
            if (input.type === 'password') {
                input.type = 'text';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.add('fa-eye');
            }
        }

        @if(old('email') || old('kode') || old('noWa') || $errors->any())
            document.addEventListener('DOMContentLoaded', function () {
                switchTab('register');
            });
        @endif

        // Efek Parallax Halus pada Latar Belakang
        (function () {
            if (!window.matchMedia || !window.matchMedia('(hover: hover)').matches) return;
            var layers = [].slice.call(document.querySelectorAll('[data-mouse-speed]'));
            var tx = 0, ty = 0, cx = 0, cy = 0;
            document.addEventListener('mousemove', function (e) {
                tx = (e.clientX / window.innerWidth) - 0.5;
                ty = (e.clientY / window.innerHeight) - 0.5;
            });
            function tick() {
                cx += (tx - cx) * 0.08;
                cy += (ty - cy) * 0.08;
                layers.forEach(function (el) {
                    var spd = parseFloat(el.getAttribute('data-mouse-speed')) || 12;
                    el.style.transform = 'translate3d(' + (cx * spd).toFixed(1) + 'px, ' + (cy * spd).toFixed(1) + 'px, 0)';
                });
                requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);
        })();
    </script>
</body>
</html>
