<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
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
@php
    $siswa = $slip->siswa ?? null;
    $nama_siswa = $siswa->nama ?? 'Ahmad Fauzi';
    $kelas_siswa = ($siswa && $siswa->kelas) ? $siswa->kelas->nama_ruang : 'X - IPA 1';
    $nis_siswa = $siswa->nis ?? '0051234567';
    $nom = (float)($slip->nominal ?? 500000);
    $bayar = (float)($slip->jumlah_dibayar ?? ($slip->jumlah_di_bayar ?? 500000));
    $sisa = max(0, $nom - $bayar);
    $isLunas = (bool)($slip->status ?? false) || ($nom > 0 && $bayar >= $nom);
    $tipeName = ($type === 'pangkal') ? 'Uang Pangkal' : (($type === 'pendidikan') ? 'Dana Pengembangan Pendidikan' : 'SPP / IPP Bulanan');
    $periode = ($type === 'ipp' && $slip && $slip->tanggal_awal) ? \Carbon\Carbon::parse($slip->tanggal_awal)->locale('id')->isoFormat('MMMM Y') : 'Tahun Ajaran 2026/2027';
    $inv_num = '421 / SLP / ' . strtoupper($type ?? 'IPP') . ' / ' . date('Ym') . ' / ' . str_pad($slip->id ?? 1, 4, '0', STR_PAD_LEFT);
    $tgl_cetak = ($slip && $slip->created_at) ? \Carbon\Carbon::parse($slip->created_at)->locale('id')->isoFormat('D MMMM Y') : date('d F Y');
@endphp

    <div class="paper">
        <!-- Kop Surat -->
        <div class="kop-container">
            <div class="kop-logo">
                <span class="logo"></span>
            </div>
            <div class="kop-text">
                <div class="instansi-1">Yayasan Pendidikan Imam Syafii</div>
                <div class="instansi-2">SEKOLAH ISLAM TERPADU IMAM SYAFII</div>
                <div class="instansi-3">Kuitansi Slip Pembayaran</div>
            </div>
            <div class="kop-logo">
                <span class="logo"></span>
            </div>
        </div>

        <div class="header-address">
            Alamat: Jl. Pendidikan Raya No. 45, Kecamatan Bunaken Darat, Kota Manado | Telp: (0431) 889212
        </div>

        <div class="double-line"></div>

        <!-- Judul Surat -->
        <div class="title-container">
            <div class="title">SLIP BUKTI PEMBAYARAN RESMI</div>
            <div class="nomor">Nomor : {{ $inv_num }}</div>
        </div>

        <div class="section-label">DATA SANTRI / SISWA :</div>

        <!-- Biodata Siswa -->
        <table class="data-table bio-table">
            <colgroup>
                <col style="width: 140px;">
                <col style="width: 20px;">
                <col>
            </colgroup>
            <tr>
                <td>Nama Santri</td>
                <td class="text-center">:</td>
                <td class="bold">{{ $nama_siswa }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td class="text-center">:</td>
                <td>{{ $kelas_siswa }}</td>
            </tr>
            <tr>
                <td>NIS / Identitas</td>
                <td class="text-center">:</td>
                <td>{{ $nis_siswa }}</td>
            </tr>
            <tr>
                <td>Tahun Ajaran</td>
                <td class="text-center">:</td>
                <td>2026/2027</td>
            </tr>
        </table>

        <!-- Rincian Pembayaran -->
        <div class="section-label">RINCIAN TRANSAKSI PEMBAYARAN :</div>
        <table class="rincian-table">
            <colgroup>
                <col style="width: 40px;">
                <col>
                <col style="width: 120px;">
                <col style="width: 120px;">
                <col style="width: 120px;">
                <col style="width: 90px;">
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Uraian Tagihan</th>
                    <th>Nominal</th>
                    <th>Jumlah Dibayar</th>
                    <th>Sisa Tagihan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>{{ $tipeName }} - Periode: {{ $periode }}</td>
                    <td class="nominal">Rp {{ number_format($nom, 0, ',', '.') }}</td>
                    <td class="nominal" style="font-weight: bold; color: #047857;">Rp {{ number_format($bayar, 0, ',', '.') }}</td>
                    <td class="nominal" style="{{ $sisa > 0 ? 'color: #dc2626; font-weight: bold;' : '' }}">Rp {{ number_format($sisa, 0, ',', '.') }}</td>
                    <td class="status {{ $isLunas ? 'status-lunas' : 'status-tunggak' }}">{{ $isLunas ? 'Lunas' : ($bayar > 0 ? 'Cicilan' : 'Menunggak') }}</td>
                </tr>
                <tr class="subtotal-row">
                    <td colspan="2" class="text-center">Total</td>
                    <td class="nominal">Rp {{ number_format($nom, 0, ',', '.') }}</td>
                    <td class="nominal">Rp {{ number_format($bayar, 0, ',', '.') }}</td>
                    <td class="nominal">Rp {{ number_format($sisa, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <!-- Bagian III: Total Keseluruhan -->
        <div class="section-label">REKAPITULASI DITERIMA :</div>
        <table class="grand-total-table">
            <colgroup>
                <col style="width: 320px;">
                <col style="width: 20px;">
                <col style="width: 35px;">
                <col>
            </colgroup>
            <tr>
                <td>Total Tagihan Administrasi</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">{{ number_format($nom, 0, ',', '.') }}</td>
            </tr>
            <tr class="grand-total-highlight">
                <td>JUMLAH PEMBAYARAN RESMI DITERIMA</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">{{ number_format($bayar, 0, ',', '.') }}</td>
            </tr>
            <tr class="bold" style="border-top: 1px dashed #444;">
                <td style="padding-top: 4px;">Sisa Tunggakan Belum Terbayar</td>
                <td class="text-center" style="padding-top: 4px;">:</td>
                <td style="padding-top: 4px;">Rp</td>
                <td class="text-right" style="padding-top: 4px;">{{ number_format($sisa, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div style="margin-top: 12px; font-size: 9pt; text-align: justify; line-height: 1.35; color: #444;">
            Demikian Slip Pembayaran resmi ini dicetak secara otomatis melalui Sistem Informasi Akademik (SIAKAD) Sekolah Islam Terpadu Imam Syafii berdasarkan riwayat transaksi yang sah dan dapat dipergunakan sebagaimana mestinya.
        </div>

        <!-- Tanda Tangan -->
        <div class="signature-container">
            <div class="signature-spacer">
                <div style="font-size: 9.5pt;">
                    <div>Yang Menyerahkan,</div>
                    <div style="height: 55px;"></div>
                    <div class="signature-name">{{ $nama_siswa }}</div>
                    <div style="font-size: 8.5pt; color: #555;">(Santri / Wali Santri)</div>
                </div>
            </div>
            <div class="signature-box">
                <div>Manado, {{ $tgl_cetak }}</div>
                <div>Bendahara Sekolah,</div>
                <div class="signature-space"></div>
                <div class="signature-name">{{ session('nama') ?? 'Bendahara SIAKAD' }}</div>
                <div>Petugas Keuangan Resmi</div>
            </div>
        </div>
    </div>

</body>
</html>