<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi — Sekolah Islam Al-Qur'an Imam Syafi'i</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('/css/activity_reg.css') }}?v={{ time() }}">
</head>
<body>

    <div class="auth-bg-layer" style="background-image: url('{{ asset('img/bg_skl.jpeg') }}?v={{ time() }}');" data-mouse-speed="-14"></div>
    <div class="auth-pattern-overlay" data-mouse-speed="18"></div>
    <div class="auth-glow-orb"></div>

    <div class="auth-card-container">
        <div class="auth-card-top-accent"></div>

        <div class="auth-card-inner">
            <div class="auth-identity-header">
                <a href="/" class="auth-seal-link">
                    <img src="{{ asset('img/logo.png') }}?v={{ time() }}" alt="Logo Sekolah">
                </a>
                <p class="auth-basmalah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                <h1 class="auth-school-name">Pemulihan Kata Sandi</h1>
                <p class="auth-portal-subtitle">Sekolah Islam Al-Qur'an Imam Syafi'i</p>
            </div>

            <div class="form-wrapper active">
                <p class="form-section-note">
                    Masukkan alamat email yang terdaftar pada akun Anda. Sistem akan mengirimkan tautan untuk mengatur ulang kata sandi.
                </p>

                <form action="/reg/krm" method="POST">
                    @csrf
                    <div class="field-group">
                        <label class="field-label" for="resetEmail">Alamat Email Terdaftar</label>
                        <div class="input-group">
                            <i class="fa-solid fa-envelope"></i>
                            <input id="resetEmail" name="email" type="email" placeholder="Masukkan email akun Anda" required autofocus>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <span>Kirim Tautan Pemulihan</span>
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="auth-card-footer">
            <a href="/reg" class="back-home">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Masuk
            </a>
            <a href="/" class="footer-help-link">Beranda</a>
        </div>

        <x-warning />
    </div>

</body>
</html>
