<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Penghasilan</title>
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
            height: auto;
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

        .income-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        .income-table td {
            padding: 2.5px 0;
        }

        .border-top-total {
            border-top: 1px dashed #444;
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
                <img src="{{ public_path('img/logo.png') }}" class="logo">
            </div>
            <div class="kop-text">
                <div class="instansi-1">PEMERINTAH KOTA MANADO</div>
                <div class="instansi-2">DINAS PENDIDIKAN DAN KEAGAMAAN</div>
                <div class="instansi-3">SEKOLAH QURAN IMAM SYAFII</div>
            </div>
        </div>

        <div class="header-address">
            Alamat: Kompleks Prm.Alokasi Pandu Cerdas, Kecamatan Bunaken Darat Kota Manado
        </div>

        <div class="double-line"></div>

        <!-- Judul Surat -->
        <div class="title-container">
            <div class="title">Surat Keterangan Penghasilan</div>
            <div class="nomor">Nomor : 422 ..... /11.09.23/SDN-18/SKP/IX/2023</div>
        </div>

        <div class="section-label">DIBERIKAN KEPADA :</div>

        <!-- Biodata Pegawai -->
        <table class="data-table bio-table">
            <colgroup>
                <col style="width: 120px;">
                <col style="width: 20px;">
                <col>
            </colgroup>
            <tr>
                <td>Nama</td>
                <td class="text-center">:</td>
                <td class="bold">{{ $data_guru->nama }}</td>
            </tr>
            <tr>
                <td>NIG / NIP</td>
                <td class="text-center">:</td>
                <td>{{ $data_guru->nig }}</td>
            </tr>
            <tr>
                <td>Golongan</td>
                <td class="text-center">:</td>
                <td>IX</td>
            </tr>
        </table>

        <!-- Rincian Penghasilan & Potongan -->
        <table class="income-table">
            <colgroup>
                <col style="width: 25px;">  <!-- Roman I, II -->
                <col style="width: 260px;"> <!-- Deskripsi -->
                <col style="width: 20px;">  <!-- Titik Dua -->
                <col style="width: 35px;">  <!-- Rp -->
                <col style="width: 120px;"> <!-- Nominal -->
                <col>                       <!-- Keterangan Tambahan -->
            </colgroup>

            <!-- Bagian I: Penghasilan -->
            <tr>
                <td class="bold">I.</td>
                <td colspan="5" class="bold">Mempunyai Penghasilan Per Bulan Sebagai Berikut :</td>
            </tr>
            <tr>
                <td></td>
                <td>1. Gaji Pokok</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">{{ number_format($data_gaji->gaji_pokok, 0, ",", ".") }}</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>2. Gaji Honor</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">{{ number_format($data_gaji->gaji_honor, 0, ",", ".") }}</td>
                <td></td>
            </tr>

            <!-- Inisialisasi nomor awal untuk loop tunjangan -->
            @php $no = 3; @endphp

            <!-- Foreach Daftar Tunjangan -->
            @foreach($data_tunjangan as $value)
                <tr>
                    <td></td>
                    <td>{{ $no++ }}. {{ $value->nama_tunjangan }}</td>
                    <td class="text-center">:</td>
                    <td>Rp</td>
                    <td class="text-right">{{ number_format($value->nominal, 0, ",", ".") }}</td>
                    <td></td>
                </tr>
            @endforeach
            <!-- Penghasilan Tambahan (Nomor Lanjut Otomatis) -->
            <tr>
                <td></td>
                <td>{{ $no++ }}. Gaji Tugas Tambahan</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">{{ number_format($data_gaji->gaji_tugas_tambahan, 0, ",", ".") }}</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>{{ $no++ }}. Gaji Tambahan</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">{{ number_format($data_gaji->gaji_tambahan, 0, ",", ".") }}</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>{{ $no++ }}. Bonus / Insentif</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">{{ number_format($data_gaji->bonus, 0, ",", ".") }}</td>
                <td></td>
            </tr>
            <tr class="bold">
                <td></td>
                <td style="padding-top: 4px;">Jumlah Penghasilan Kotor</td>
                <td class="text-center" style="padding-top: 4px;">:</td>
                <td style="padding-top: 4px;" class="border-top-total">Rp</td>
                <td class="text-right border-top-total" style="padding-top: 4px;">{{ number_format($jumlah_gaji_kotor, 0, ",", ".") }}</td>
                <td></td>
            </tr>

            <!-- Spasi -->
            <tr><td colspan="6" style="height: 10px;"></td></tr>

            <!-- Bagian II: Potongan -->
            <tr>
                <td class="bold">II.</td>
                <td colspan="5" class="bold">Potongan-Potongan :</td>
            </tr>
            <tr>
                <td></td>
                <td>1. Potongan Tidak Hadir</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">{{ number_format($data_gaji->potongan_tidak_hadir, 0, ",", ".") }}</td>
                <td style="padding-left: 15px; font-style: italic; color: #444;">({{ $jumlah_alpa }} kali alpa)</td>
            </tr>
            <tr>
                <td></td>
                <td>2. Potongan Keterlambatan</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">{{ number_format($data_gaji->potongan_keterlambatan, 0, ",", ".") }}</td>
                <td style="padding-left: 15px; font-style: italic; color: #444;">({{ $jumlah_terlambat }} menit)</td>
            </tr>
            <tr>
                <td></td>
                <td>3. Kasbon / Pinjaman</td>
                <td class="text-center">:</td>
                <td>Rp</td>
                <td class="text-right">{{ number_format($data_gaji->kasbon, 0, ",", ".") }}</td>
                <td></td>
            </tr>
            <tr class="bold">
                <td></td>
                <td style="padding-top: 4px;">Jumlah Potongan</td>
                <td class="text-center" style="padding-top: 4px;">:</td>
                <td style="padding-top: 4px;" class="border-top-total">Rp</td>
                <td class="text-right border-top-total" style="padding-top: 4px;">{{ number_format($data_gaji->potongan_tidak_hadir + $data_gaji->potongan_keterlambatan + $data_gaji->kasbon, 0, ",", ".") }}</td>
                <td></td>
            </tr>

            <!-- Spasi -->
            <tr><td colspan="6" style="height: 12px;"></td></tr>

            <!-- Total Penerimaan Bersih -->
            <tr class="bold" style="font-size: 11pt;">
                <td class="bold">III.</td>
                <td style="padding-top: 6px; padding-bottom: 6px; background-color: #f8f9fa;">TOTAL PENERIMAAN BERSIH (THP)</td>
                <td class="text-center" style="padding-top: 6px; padding-bottom: 6px; background-color: #f8f9fa;">:</td>
                <td style="padding-top: 6px; padding-bottom: 6px; background-color: #f8f9fa;">Rp</td>
                <td class="text-right" style="padding-top: 6px; padding-bottom: 6px; background-color: #f8f9fa;">{{ number_format($jumlah_gaji_bersih, 0, ",", ".") }}</td>
                <td style="background-color: #f8f9fa;"></td>
            </tr>
        </table>

        <div style="margin-top: 10px; font-size: 9.5pt; text-align: justify; line-height: 1.3;">
            Demikian Surat Keterangan Penghasilan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
        </div>

        <!-- Tanda Tangan -->
        <div class="signature-container">
            <div class="signature-spacer"></div>
            <div class="signature-box">
                <div>Manado, 11 September 2023</div>
                <div>Bendahara Sekolah,</div>
                <div class="signature-space"></div>
                <div class="signature-name">Deice Illat, S.PdK</div>
                <div>NIP. 19721214 200604 2 002</div>
            </div>
        </div>
    </div>

</body>
</html>