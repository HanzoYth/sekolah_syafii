<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP — HRIS Guru</title>

    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&family=Source+Serif+4:opsz,wght@8..60,400;8..60,600;8..60,700&display=swap" rel="stylesheet">

    <!-- CSS OTP -->
    <link rel="stylesheet" href="{{ asset('css/otp.css')}}">
</head>
<body>

    <div class="otp-wrapper">
        <div class="otp-card">
            
            <!-- Banner Islami Top -->
            <div class="otp-header">
                <div class="bismillah-text">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
                <div class="icon-badge">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h2>Verifikasi Kode OTP</h2>
                <p>Masukkan 6 digit kode keamanan yang telah dikirimkan ke nomor WhatsApp / Email Anda.</p>
            </div>

            <!-- Form OTP -->
            <form action="/gr/ckotp" method="POST" class="otp-form">
                @csrf
                
                <!-- Group Input 6 Digit -->
                <div class="otp-inputs">
                    <input type="text" maxlength="1" class="otp-field" autofocus placeholder="•" required>
                    <input type="text" maxlength="1" class="otp-field" placeholder="•" disabled required>
                    <input type="text" maxlength="1" class="otp-field" placeholder="•" disabled required>
                    <input type="text" maxlength="1" class="otp-field" placeholder="•" disabled required>
                    <input type="text" maxlength="1" class="otp-field" placeholder="•" disabled required>
                    <input type="text" maxlength="1" class="otp-field" placeholder="•" disabled required>
                    <input type="hidden" id="value_otp" name="otp">
                </div>

                <!-- Info Timer & Resend -->
                <div class="otp-timer-info">
                    <p>Tidak menerima kode? <a href="#" class="btn-resend">Kirim Ulang</a></p>
                    <div class="timer-badge">
                        <i class="fa-regular fa-clock"></i> <span id="timer">01:59</span>
                    </div>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn-verify">
                    <i class="fa-solid fa-check-circle"></i> VERIFIKASI SEKARANG
                </button>

            </form>


            <!-- Footer / Back Link -->
            <div class="otp-footer">
                <a href="#"><i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Login</a>
            </div>

        </div>
    </div>
    <script src="{{ asset('js/auth/time_otp.js') }}"></script>
</body>
</html>