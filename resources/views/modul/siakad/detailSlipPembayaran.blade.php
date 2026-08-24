<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Pembayaran</title>
    <!-- FontAwesome untuk ikon cetak -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Path stylesheet disesuaikan dengan file lokal Anda -->
    <link rel="stylesheet" href="{{asset('css/modul/siakad/DetailSlipPembayaran.css')}}">
</head>
<body>

<div class="main-wrapper">

    <div class="topbar">
        <div class="topbar-title">
            <div class="title-with-date">
                <a href="/sk/pbs" class="btn-back" title="Kembali">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <h2>Slip Pembayaran</h2>
            </div>
            <p>Riwayat pembayaran IPP dan Pangkal & Pendidikan Anda</p>
        </div>
    </div>

    <!-- KARTU PROFIL SISWA (akun yang sedang login) -->
    <div class="card">
        <div class="profile-row">
            <div class="teacher-profile">
                <div class="avatar-circle">A</div>
                <div class="teacher-detail">
                    <span>Ahmad Fauzi</span>
                    <small>Kelas X-IPA 1 &middot; NISN: 0051234567</small>
                </div>
            </div>
            <div class="action-buttons">
                <a href="/sk/ssp" class="btn-action btn-print" title="Cetak Slip Pembayaran">
                    <i class="fa fa-print"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- ================= SLIP PEMBAYARAN IPP ================= -->
    <div class="card table-card">
        <div class="card-header">
            <h3>Slip Pembayaran IPP</h3>
            <span class="total-badge">Total: 2</span>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th class="col-status">Status</th>
                        <th class="col-nominal">Nominal Pembayaran</th>
                        <th class="col-nominal">Jumlah Tunggakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Juli 2026</td>
                        <td class="col-status">
                            <span class="tunggakan-badge">
                                2 Bulan Menunggak
                            </span>
                        </td>
                        <td class="nominal-text col-nominal">Rp 500.000</td>
                        <td class="nominal-text col-nominal">Rp 1.000.000</td>
                    </tr>
                    <tr>
                        <td>Juni 2026</td>
                        <td class="col-status">
                            <span class="tunggakan-badge lunas">
                                Lunas
                            </span>
                        </td>
                        <td class="nominal-text col-nominal">Rp 500.000</td>
                        <td class="nominal-text col-nominal">Rp 0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= SLIP PEMBAYARAN PANGKAL & PENDIDIKAN ================= -->
    <div class="card table-card">
        <div class="card-header">
            <h3>Slip Pembayaran Pangkal & Pendidikan</h3>
            <span class="total-badge">Total: 1</span>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th class="col-nominal">Nominal Pangkal & Pendidikan</th>
                        <th class="col-nominal">Angsuran</th>
                        <th class="col-status">Tunggakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>10 Jul 2026</td>
                        <td class="nominal-text col-nominal">Rp 5.000.000</td>
                        <td class="nominal-text col-nominal">Rp 2.500.000</td>
                        <td class="col-status">
                            <span class="tunggakan-badge">
                                Rp 2.500.000
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>