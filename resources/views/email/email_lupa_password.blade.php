<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Password</title>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #f4f4f0;
        font-family: 'Segoe UI', Tahoma, Arial, sans-serif;
        color: #2c2c2c;
    }
    .wrapper {
        width: 100%;
        padding: 40px 0;
        background-color: #f4f4f0;
    }
    .container {
        max-width: 520px;
        margin: 0 auto;
        background-color: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e0ddd3;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .header {
        background: linear-gradient(135deg, #065f46 0%, #047857 60%, #059669 100%);
        padding: 32px 24px;
        text-align: center;
        position: relative;
    }
    .header::after {
        content: "";
        display: block;
        height: 4px;
        background: repeating-linear-gradient(
            90deg,
            #d4af37 0px, #d4af37 10px,
            transparent 10px, transparent 20px
        );
        margin-top: 20px;
    }
    .header h1 {
        color: #ffffff;
        font-size: 20px;
        margin: 0;
        letter-spacing: 0.5px;
    }
    .header p {
        color: #d1fae5;
        font-size: 13px;
        margin: 6px 0 0;
    }
    .body-content {
        padding: 32px 28px;
    }
    .body-content p {
        font-size: 14px;
        line-height: 1.7;
        margin: 0 0 16px;
        color: #3f3f3f;
    }
    .btn-wrapper {
        text-align: center;
        margin: 28px 0;
    }
    .btn {
        display: inline-block;
        background-color: #047857;
        color: #ffffff !important;
        text-decoration: none;
        padding: 13px 32px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        border: 1px solid #d4af37;
    }
    .link-fallback {
        font-size: 12px;
        color: #6b7280;
        word-break: break-all;
        background-color: #f9fafb;
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px dashed #d4af37;
    }
    .notice {
        font-size: 12px;
        color: #92400e;
        background-color: #fffbeb;
        border-left: 3px solid #d4af37;
        padding: 10px 14px;
        border-radius: 4px;
        margin-top: 20px;
    }
    .footer {
        text-align: center;
        padding: 20px 24px 28px;
        font-size: 11px;
        color: #9ca3af;
    }
    .footer .divider {
        width: 60px;
        height: 2px;
        background-color: #d4af37;
        margin: 0 auto 14px;
    }
</style>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="header">
            <h1>Reset Password</h1>
            <p>Sistem Informasi Akademik</p>
        </div>
        <div class="body-content">
            <p>Assalamu'alaikum, <strong>{{ $userName }}</strong>,</p>
            <p>
                Kami menerima permintaan untuk mengatur ulang password akun Anda.
                Silakan klik tombol di bawah ini untuk membuat password baru.
            </p>

            <div class="btn-wrapper">
                <a href="{{ $resetUrl }}" class="btn">Reset Password Sekarang</a>
            </div>

            <p style="margin-bottom:8px;">Atau salin dan tempel link berikut ke browser Anda:</p>
            <p class="link-fallback">{{ $resetUrl }}</p>

            <div class="notice">
                Link ini hanya berlaku selama <strong>60 menit</strong>. Jika Anda tidak merasa meminta reset password, abaikan email ini — password Anda tidak akan berubah.
            </div>
        </div>
        <div class="footer">
            <div class="divider"></div>
            Email ini dikirim otomatis, mohon tidak membalas email ini.
        </div>
    </div>
</div>
</body>
</html>