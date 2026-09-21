<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
    <title>Surat Keterangan Penghasilan</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm 15mm;
            background-color: #ffffff;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #fff;
            margin: 0;
            padding: 0;
            font-size: 10.5pt;
            color: #000;
            line-height: 1.35;
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
            width: 70px;
            vertical-align: middle;
            text-align: center;
        }

        .logo {
            width: 60px;
            height: auto;
        }

        .kop-text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .kop-spacer {
            display: table-cell;
            width: 70px;
        }

        .kop-text .instansi-1 {
            font-size: 13pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header-address {
            text-align: center;
            font-size: 8.5pt;
            margin-top: 3px;
            margin-bottom: 8px;
            color: #333;
        }

        .single-line {
            border-top: 1.2px solid #000;
            margin-bottom: 16px;
        }

        /* Judul Dokumen */
        .title-container {
            text-align: center;
            margin-bottom: 4px;
        }

        .title {
            font-size: 12.5pt;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .nomor {
            text-align: center;
            font-size: 9.5pt;
            margin-top: 3px;
            margin-bottom: 18px;
        }

        .section-label {
            font-size: 10.5pt;
            font-weight: bold;
            margin-bottom: 6px;
            margin-top: 4px;
        }

        /* Table umum untuk pasangan label : value */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 10pt;
            margin-bottom: 16px;
        }

        .data-table td {
            padding: 1.5px 0;
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .label-col { width: 120px; }
        .colon-col { width: 15px; }

        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .plus-minus { width: 18px; text-align: center; }

        .income-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 10pt;
            margin-bottom: 4px;
        }

        .income-table td {
            padding: 1.5px 0;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .border-top-total {
            border-top: 1px solid #000;
            padding-top: 4px !important;
        }

        .total-line {
            font-weight: bold;
            margin: 6px 0 16px 0;
            font-size: 10.5pt;
        }

        .net-salary-line {
            font-weight: bold;
            margin: 4px 0 22px 0;
            font-size: 10.5pt;
        }

        /* Tanda Tangan */
        .signature-container {
            width: 100%;
            margin-top: 6px;
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
            height: 55px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }

        .footer-note {
            margin-top: 26px;
            font-size: 8.5pt;
            font-style: italic;
            color: #444;
            text-align: justify;
        }
    </style>
</head>
<body>

    <div class="paper">
        <!-- Kop Surat -->
        <div class="kop-container">
            <div class="kop-logo">
                @php
                    // Embed logo sebagai base64 agar tetap muncul saat di-export ke PDF (dompdf/mpdf
                    // tidak bisa mengambil gambar lewat URL asset() secara default).
                    $logoPath = public_path('img/logo_sklh.png');
                    $logoData = null;
                    if (file_exists($logoPath)) {
                        $logoType = pathinfo($logoPath, PATHINFO_EXTENSION);
                        $logoData = 'data:image/' . $logoType . ';base64,' . base64_encode(file_get_contents($logoPath));
                    }
                @endphp
                @if($logoData)
                    <img src="{{ $logoData }}" class="logo">
                @endif
            </div>
            <div class="kop-text">
                <div class="instansi-1">Sekolah Qur'an Imam Syafii</div>
            </div>
            <div class="kop-spacer"></div>
        </div>

        <div class="header-address">
            Alamat: Jl. Rapolinja, Tinggede, Kec. Marawola, Kabupaten Sigi
        </div>

        <div class="single-line"></div>

        <!-- Judul Dokumen -->
        <div class="title-container">
            <div class="title">Surat Keterangan Penghasilan</div>
        </div>

        <!-- Data Karyawan -->
        <div class="section-label">DATA KARYAWAN</div>
        <table class="data-table">
            <colgroup>
                <col class="label-col">
                <col class="colon-col">
                <col>
            </colgroup>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td class="bold">{{ $data_guru->nama }}</td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td>{{ $data_guru->nig }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td>Guru</td>
            </tr>
        </table>

        <!-- Rincian Pendapatan -->
        <div class="section-label">RINCIAN PENDAPATAN</div>
        <table class="income-table">
            <colgroup>
                <col class="label-col">
                <col class="colon-col">
                <col>
                <col class="plus-minus">
            </colgroup>
            <tr>
                <td>Gaji Pokok</td>
                <td>:</td>
                <td>Rp{{ number_format($data_gaji->gaji_pokok, 0, ",", ".") }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Gaji Honor</td>
                <td>:</td>
                <td>Rp{{ number_format($data_gaji->gaji_honor, 0, ",", ".") }}</td>
                <td></td>
            </tr>
            @foreach($data_tunjangan as $value)
                <tr>
                    <td>{{ $value->nama_tunjangan }}</td>
                    <td>:</td>
                    <td>Rp{{ number_format($value->nominal, 0, ",", ".") }}</td>
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td>Gaji Tugas Tambahan</td>
                <td>:</td>
                <td>Rp{{ number_format($data_gaji->gaji_tugas_tambahan, 0, ",", ".") }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Gaji Tambahan</td>
                <td>:</td>
                <td>Rp{{ number_format($data_gaji->gaji_tambahan, 0, ",", ".") }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Bonus Kinerja</td>
                <td>:</td>
                <td>Rp{{ number_format($data_gaji->bonus, 0, ",", ".") }}</td>
                <td class="bold">+</td>
            </tr>
        </table>
        <div class="single-line" style="margin-bottom: 4px;"></div>
        <div class="total-line">Total Pendapatan (Bruto): Rp{{ number_format($jumlah_gaji_kotor, 0, ",", ".") }}</div>

        <!-- Rincian Potongan -->
        <div class="section-label">RINCIAN POTONGAN</div>
        <table class="income-table">
            <colgroup>
                <col class="label-col">
                <col class="colon-col">
                <col>
                <col class="plus-minus">
            </colgroup>
            <tr>
                <td>Potongan Tidak Hadir</td>
                <td>:</td>
                <td>Rp{{ number_format($data_gaji->potongan_tidak_hadir, 0, ",", ".") }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Potongan Keterlambatan</td>
                <td>:</td>
                <td>Rp{{ number_format($data_gaji->potongan_keterlambatan, 0, ",", ".") }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Kasbon / Pinjaman</td>
                <td>:</td>
                <td>Rp{{ number_format($data_gaji->kasbon, 0, ",", ".") }}</td>
                <td class="bold">-</td>
            </tr>
        </table>
        <div class="single-line" style="margin-bottom: 4px;"></div>
        @php
            $jumlah_potongan = $data_gaji->potongan_tidak_hadir + $data_gaji->potongan_keterlambatan + $data_gaji->kasbon;
        @endphp
        <div class="total-line">Total Potongan : Rp{{ number_format($jumlah_potongan, 0, ",", ".") }}</div>

        <!-- Gaji Bersih -->
        <div class="net-salary-line">
            GAJI BERSIH (TAKE HOME PAY): Rp{{ number_format($jumlah_gaji_kotor, 0, ",", ".") }} - Rp{{ number_format($jumlah_potongan, 0, ",", ".") }} = Rp{{ number_format($jumlah_gaji_bersih, 0, ",", ".") }}
        </div>

        <!-- Tanda Tangan -->
        <div class="signature-container">
            <div class="signature-spacer"></div>
            <div class="signature-box">
                @php
                    Carbon\Carbon::setlocale("id");
                @endphp
                <div>Palu, {{Carbon\Carbon::parse($data_gaji->created_at)->translatedFormat("d F Y")}}</div>
                <div>Kepala Sekolah,</div>
                <div class="signature-space"></div>
                <div class="signature-name">Ustadzah Nabila</div>
                <div>NIP. 19721214 200604 2 002</div>
            </div>
        </div>

        <div class="footer-note">
            Surat keterangan ini bersifat rahasia. Harap disimpan dengan baik sebagai bukti resmi. Jika terdapat ketidaksesuaian, segera hubungi bendahara sekolah.
        </div>
    </div>

</body>
</html>