<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Pembayaran Guru - SIAKAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/teacher/dashboard.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/teacher/slip-pembayaran.css') }}?v={{ time() }}">
</head>
<body>
    <div class="dashboard-container">
        <x-siakad.sidebar />

        <main class="main-content teacher-payment-page">
            <x-siakad.topbar
                :name="session('nama', 'Ustadzah Fitri')"
                position="Guru Mata Pelajaran"
                initials="UF"
                title="Slip Pembayaran"
                description="Lihat ringkasan dan arsip pembayaran Anda."
            />

            <section class="payment-heading">
                <div><p>RIWAYAT PEMBAYARAN</p><h1>Slip pembayaran guru</h1><span>Dokumen pembayaran tersedia berdasarkan periode.</span></div>
                <button type="button" class="payment-filter"><i class="fa-regular fa-calendar"></i> Agustus 2026 <i class="fa-solid fa-chevron-down"></i></button>
            </section>

            <section class="payment-summary">
                <div class="payment-summary-icon"><i class="fa-solid fa-wallet"></i></div>
                <div><p>Pembayaran terakhir</p><h2>Agustus 2026</h2><span>Status pembayaran telah diproses.</span></div>
                <span class="payment-status"><i class="fa-solid fa-circle-check"></i> Tersedia</span>
                <button type="button" class="payment-download"><i class="fa-solid fa-download"></i> Unduh slip</button>
            </section>

            <section class="payment-history">
                <div class="payment-history-header"><div><p>ARSIP</p><h2>Riwayat slip pembayaran</h2></div><span>3 dokumen</span></div>
                <div class="payment-table-wrap">
                    <table>
                        <thead><tr><th>Periode</th><th>Jenis Pembayaran</th><th>Tanggal Terbit</th><th>Status</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <tr><td><strong>Agustus 2026</strong></td><td>Pembayaran Guru</td><td>01 Agustus 2026</td><td><span class="payment-status"><i class="fa-solid fa-circle-check"></i> Tersedia</span></td><td><button type="button" class="table-download" aria-label="Unduh slip Agustus"><i class="fa-solid fa-download"></i></button></td></tr>
                            <tr><td><strong>Juli 2026</strong></td><td>Pembayaran Guru</td><td>01 Juli 2026</td><td><span class="payment-status"><i class="fa-solid fa-circle-check"></i> Tersedia</span></td><td><button type="button" class="table-download" aria-label="Unduh slip Juli"><i class="fa-solid fa-download"></i></button></td></tr>
                            <tr><td><strong>Juni 2026</strong></td><td>Pembayaran Guru</td><td>02 Juni 2026</td><td><span class="payment-status"><i class="fa-solid fa-circle-check"></i> Tersedia</span></td><td><button type="button" class="table-download" aria-label="Unduh slip Juni"><i class="fa-solid fa-download"></i></button></td></tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
