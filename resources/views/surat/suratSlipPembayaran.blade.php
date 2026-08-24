<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Slip Pembayaran</title>
    <style>
        @page {
    size: A4 portrait;
    margin: 12mm 15mm;
    background-color: #ffffff;
}

*, *::before, *::after {
    box-sizing: border-box;
    font-family: "Times New Roman", Times, serif;
}

body {
    background-color: #fff;
    margin: 0;
    padding: 0;
    font-size: 10.5pt;
    color: #000;
    line-height: 1.25;
}

.paper {
    width: 100%;
    margin: 0 auto;
}

/* Kop Surat Section */
.kop-container {
    display: table;
    width: 100%;
    margin-bottom: 4px;
    table-layout: fixed;
}

.kop-logo {
    display: table-cell;
    width: 75px;
    vertical-align: middle;
    text-align: center;
}

.logo {
    width: 65px;
    height: 65px;
    border: 1px solid #000;
    border-radius: 50%;
    display: inline-block;
}

.kop-text {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
}

.kop-text .instansi-1 {
    font-size: 13pt;
    font-weight: bold;
    margin: 0;
    text-transform: uppercase;
}

.kop-text .instansi-2 {
    font-size: 12pt;
    font-weight: bold;
    margin: 2px 0;
    text-transform: uppercase;
}

.kop-text .instansi-3 {
    font-size: 14pt;
    font-weight: bold;
    margin: 0;
    text-transform: uppercase;
}

.header-address {
    text-align: center;
    font-style: italic;
    font-size: 8.5pt;
    margin-top: 3px;
    margin-bottom: 6px;
}

.double-line {
    border-top: 2.5px solid #000;
    border-bottom: 0.8px solid #000;
    height: 2px;
    margin-bottom: 14px;
}

/* Judul Surat */
.title-container {
    text-align: center;
    margin-bottom: 16px;
}

.title {
    font-size: 12pt;
    font-weight: bold;
    text-decoration: underline;
    text-transform: uppercase;
}

.nomor {
    font-size: 10pt;
    margin-top: 3px;
}

.section-label {
    font-size: 10pt;
    font-weight: bold;
    margin-bottom: 6px;
}

/* Table alignment */
.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 10pt;
    margin-bottom: 12px;
    table-layout: fixed;
}

.data-table td {
    padding: 3px 0;
    vertical-align: top;
}

.text-center { text-align: center; }
.text-right  { text-align: right; }
.bold        { font-weight: bold; }

.bio-table {
    margin-left: 10px;
    margin-bottom: 14px;
}

/* Tabel Rincian Pembayaran */
.rincian-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 9.5pt;
    margin-bottom: 16px;
}

.rincian-table th,
.rincian-table td {
    border: 1px solid #444;
    padding: 4px 6px;
}

.rincian-table thead th {
    background-color: #f0f0f0;
    font-weight: bold;
    text-align: center;
}

.rincian-table td.nominal { text-align: right; }
.rincian-table td.status { text-align: center; }

.status-lunas {
    font-weight: bold;
}

.status-tunggak {
    font-weight: bold;
}

.subtotal-row td {
    font-weight: bold;
    background-color: #fafafa;
}

.border-top-total {
    border-top: 1px dashed #444;
}

.grand-total-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 4px;
    margin-bottom: 16px;
}

.grand-total-table td {
    padding: 4px 0;
    font-size: 10.5pt;
}

.grand-total-highlight td {
    padding-top: 6px;
    padding-bottom: 6px;
    background-color: #f8f9fa;
    font-weight: bold;
    font-size: 11pt;
}

/* Tanda Tangan */
.signature-container {
    width: 100%;
    margin-top: 20px;
    display: table;
    table-layout: fixed;
}

.signature-spacer {
    display: table-cell;
    width: 55%;
}

.signature-box {
    display: table-cell;
    width: 45%;
    text-align: center;
    font-size: 10pt;
    vertical-align: top;
}

.signature-space {
    height: 60px;
}

.signature-name {
    font-weight: bold;
    text-decoration: underline;
}
    </style>
</head>
<body>

    <div class="paper">
        <!-- Kop Surat -->
        <div class="kop-container">
            <div class="kop-logo">
                <span class="logo"></span>
            </div>
            <div class="kop-text">
                <div class="instansi-1">Yayasan Pendidikan Imam Syafii</div>
                <div class="instansi-2">SMA Islam Terpadu Al-Furqan</div>
                <div class="instansi-3">Slip Pembayaran</div>
            </div>
            <div class="kop-logo">
                <span class="logo"></span>
            </div>
        </div>

        <div class="header-address">
            Alamat: Jl. Pendidikan Raya No. 45, Kecamatan Bunaken Darat, Kota Manado
        </div>

        <div class="double-line"></div>

        <!-- Judul Surat -->
        <div class="title-container">
            <div class="title">Slip Pembayaran Siswa</div>
            <div class="nomor">Nomor : 421 / SLP / SMA-AF / VII / 2026</div>
        </div>

        <div class="section-label">DATA SISWA :</div>

        <!-- Biodata Siswa -->
        <table class="data-table bio-table">
            <colgroup>
                <col style="width: 140px;">
                <col style="width: 20px;">
                <col>
            </colgroup>
            <tr>
                <td>Nama</td>
                <td class="text-center">:</td>
                <td class="bold">Ahmad Fauzi</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td class="text-center">:</td>
                <td>X - IPA 1</td>
            </tr>
            <tr>
                <td>NISN</td>
                <td class="text-center">:</td>
                <td>0051234567</td>
            </tr>
        </table>

        <!-- Bagian I: Slip Pembayaran IPP -->
        <div class="section-label">I. RINCIAN PEMBAYARAN IPP</div>
        <table class="rincian-table">
            <colgroup>
                <col style="width: 40px;">
                <col>
                <col style="width: 130px;">
                <col style="width: 130px;">
                <col style="width: 100px;">
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Nominal Pembayaran</th>
                    <th>Jumlah Tunggakan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Juli 2026</td>
                    <td class="nominal">Rp 500.000</td>
                    <td class="nominal">Rp 1.000.000</td>
                    <td class="status status-tunggak">2 Bulan Menunggak</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Juni 2026</td>
                    <td class="nominal">Rp 500.000</td>
                    <td class="nominal">Rp 0</td>
                    <td class="status status-lunas">Lunas</td>
                </tr>
                <tr class="subtotal-row">
                    <td colspan="2" class="text-center">Jumlah</td>
                    <td class="nominal">Rp 1.000.000</td>
                    <td class="nominal">Rp 1.000.000</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <!-- Bagian II: Slip Pembayaran Pangkal & Pendidikan -->
        <div class="section-label">II. RINCIAN PEMBAYARAN PANGKAL & PENDIDIKAN</div>
        <table class="rincian-table">
            <colgroup>
                <col style="width: 40px;">
                <col>
                <col style="width: 120px;">
                <col style="width: 120px;">
                <col style="width: 120px;">
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nominal Pangkal & Pendidikan</th>
                    <th>Angsuran</th>
                    <th>Tunggakan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>10 Juli 2026</td>
                    <td class="nominal">Rp 5.000.000</td>
                    <td class="nominal">Rp 2.500.000</td>
                    <td class="nominal status-tunggak">Rp 2.500.000</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>15 Juni 2026</td>
                    <td class="nominal">Rp 5.000.000</td>
                    <td class="nominal">Rp 5.000.000</td>
                    <td class="nominal status-lunas">Rp 0</td>
                </tr>
                <tr class="subtotal-row">
                    <td colspan="2" class="text-center">Jumlah</td>
                    <td class="nominal">Rp 10.000.000</td>
                    <td class="nominal">Rp 7.500.000</td>
                    <td class="nominal">Rp 2.500.000</td>
                </tr>
            </tbody>
        </table>

        <!-- Bagian III: Total Keseluruhan -->
        <div class="section-label">III. REKAPITULASI TOTAL</div>
        <table class="grand-total-table">
            <colgroup>
                <col style="width: 320px;">
                <col style="width: 20px;">
                <col style="width: 35px;">
                <col>
            </colgroup>
            <tr>
                <td>Total Pembayaran IPP</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">1.000.000</td>
            </tr>
            <tr>
                <td>Total Pembayaran Pangkal & Pendidikan (Angsuran)</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">7.500.000</td>
            </tr>
            <tr class="bold" style="border-top: 1px dashed #444;">
                <td style="padding-top: 4px;">Total Sisa Tunggakan Keseluruhan</td>
                <td class="text-center" style="padding-top: 4px;">:</td>
                <td style="padding-top: 4px;">Rp</td>
                <td class="text-right" style="padding-top: 4px;">3.500.000</td>
            </tr>
            <tr class="grand-total-highlight">
                <td>TOTAL SELURUH PEMBAYARAN DITERIMA</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">8.500.000</td>
            </tr>
        </table>

        <div style="margin-top: 10px; font-size: 9.5pt; text-align: justify; line-height: 1.3;">
            Demikian Slip Pembayaran ini dibuat berdasarkan riwayat transaksi yang tercatat pada sistem, untuk dapat dipergunakan sebagaimana mestinya.
        </div>

        <!-- Tanda Tangan -->
        <div class="signature-container">
            <div class="signature-spacer"></div>
            <div class="signature-box">
                <div>Manado, 24 Agustus 2026</div>
                <div>Bendahara Sekolah,</div>
                <div class="signature-space"></div>
                <div class="signature-name">Siti Nurhaliza, S.E</div>
                <div>NIP. 19850312 201001 2 003</div>
            </div>
        </div>
    </div>

</body>
</html>