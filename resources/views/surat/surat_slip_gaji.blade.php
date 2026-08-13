<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Penghasilan</title>
    <style>
        /* Pengaturan Halaman A4 Presisi */
        @page {
            size: A4 portrait;
            margin: 8mm 12mm;
        }

        * {
            box-sizing: border-box;
            font-family: "Times New Roman", Times, serif;
        }

        body {
            background-color: #fff;
            margin: 0;
            padding: 0;
            font-size: 10pt;
            color: #000;
            line-height: 1.15;
        }

        .paper {
            width: 100%;
            margin: 0 auto;
        }

        /* Header / Kop Surat */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
            table-layout: fixed;
        }

        .header-table td {
            vertical-align: middle;
            text-align: center;
        }

        .logo {
            width: 65px;
            height: auto;
        }

        .header-text h3 { margin: 0; font-size: 13pt; font-weight: bold; }
        .header-text h2 { margin: 2px 0; font-size: 12pt; font-weight: bold; }
        .header-text h1 { margin: 0; font-size: 14pt; font-weight: bold; }

        .header-address {
            text-align: center;
            font-style: italic;
            font-size: 8.5pt;
            margin-bottom: 4px;
        }

        .double-line {
            border-top: 2px solid #000;
            border-bottom: 1px solid #000;
            height: 1px;
            margin-bottom: 10px;
        }

        /* Judul Surat */
        .title-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .title {
            font-size: 11pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }

        .nomor {
            font-size: 9.5pt;
            margin-top: 2px;
        }

        .section-label {
            font-size: 9.5pt;
            font-weight: bold;
            margin-bottom: 4px;
        }

        /* Biodata Table */
        .bio-table {
            width: 100%;
            margin-left: 15px;
            margin-bottom: 8px;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .bio-table td {
            padding: 1px 0;
            font-size: 9.5pt;
            vertical-align: top;
        }

        /* Tabel Rincian Penghasilan & Potongan */
        .income-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
            margin-bottom: 8px;
            table-layout: fixed;
        }

        .income-table td {
            padding: 1px 0;
            vertical-align: top;
            overflow: hidden;
        }

        .text-center { text-align: center; }
        .text-right  { text-align: right; }
        .bold        { font-weight: bold; }

        .col-rp {
            text-align: left;
            padding-right: 2px;
        }

        .col-amount {
            text-align: right;
            padding-right: 15px;
        }

        /* Tanda Tangan */
        .signature-wrapper {
            width: 100%;
            margin-top: 10px;
        }

        .signature-table {
            width: 220px;
            float: right;
            text-align: center;
            font-size: 9.5pt;
            border-collapse: collapse;
        }

        .signature-space { height: 45px; }
        .signature-name { font-weight: bold; text-decoration: underline; }
        .clear { clear: both; }
    </style>
</head>
<body>

    <div class="paper">
        <!-- Kop Surat -->
        <table class="header-table">
            <colgroup>
                <col style="width: 70px;">
                <col>
                <col style="width: 70px;">
            </colgroup>
            <tr>
                <td><img src="{{ public_path('img/logo.png') }}" class="logo"></td>
                <td>
                    <div class="header-text">
                        <h3>PEMERINTAH KOTA MANADO</h3>
                        <h2>DINAS PENDIDIKAN DAN KEAGAMAAN</h2>
                        <h1>SEKOLAH QURAN IMAM SYAFII</h1>
                    </div>
                </td>
                <td><img src="{{ public_path('img/logo.png') }}" class="logo"></td>
            </tr>
        </table>

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
        <table class="bio-table">
            <colgroup>
                <col style="width: 100px;">
                <col style="width: 15px;">
                <col>
            </colgroup>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $data_guru->nama }}</td>
            </tr>
            <tr>
                <td>NIG</td>
                <td>:</td>
                <td>{{ $data_guru->nig }}</td>
            </tr>
            <tr>
                <td>Golongan</td>
                <td>:</td>
                <td>IX</td>
            </tr>
        </table>

        <!-- Rincian Penghasilan & Potongan -->
        <table class="income-table">
            <colgroup>
                <col style="width: 20px;">   <!-- 1. Roman (I, II) -->
                <col style="width: 320px;">  <!-- 2. Deskripsi -->
                <col style="width: 15px;">   <!-- 3. Titik dua -->
                <col style="width: 25px;">   <!-- 4. "Rp" -->
                <col style="width: 160px;">  <!-- 5. Nominal -->
            </colgroup>

            <!-- Bagian I: Penghasilan -->
            <tr>
                <td class="bold">I.</td>
                <td colspan="4" class="bold">Mempunyai Penghasilan Per Bulan Sebagai Berikut :</td>
            </tr>
            <tr>
                <td></td>
                <td>Gaji Pokok</td>
                <td class="text-center">:</td>
                <td class="col-rp">Rp</td>
                <td class="col-amount">{{ number_format($data_gaji->gaji_pokok, 0, ",", ".") }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Gaji Honor</td>
                <td class="text-center">:</td>
                <td class="col-rp">Rp</td>
                <td class="col-amount">{{ number_format($data_gaji->gaji_honor, 0, ",", ".") }}</td>
            </tr>
            @foreach($data_tunjangan as $value)
                <tr>
                    <td></td>
                    <td>{{ $value->nama_tunjangan }}</td>
                    <td class="text-center">:</td>
                    <td class="col-rp">Rp</td>
                    <td class="col-amount">{{ number_format($value->nominal, 0, ",", ".") }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td>Gaji Tugas Tambahan</td>
                <td class="text-center">:</td>
                <td class="col-rp">Rp</td>
                <td class="col-amount">{{ number_format($data_gaji->gaji_tugas_tambahan, 0, ",", ".") }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Gaji Tambahan</td>
                <td class="text-center">:</td>
                <td class="col-rp">Rp</td>
                <td class="col-amount">{{ number_format($data_gaji->gaji_tambahan, 0, ",", ".") }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Bonus</td>
                <td class="text-center">:</td>
                <td class="col-rp">Rp</td>
                <td class="col-amount">{{ number_format($data_gaji->bonus, 0, ",", ".") }}</td>
            </tr>
            <tr>
                <td colspan="2" class="bold text-right" style="padding-right: 10px;">Jumlah Kotor</td>
                <td class="text-center bold">:</td>
                <td class="col-rp bold">Rp</td>
                <td class="col-amount bold">{{ number_format($jumlah_gaji_kotor, 0, ",", ".") }}</td>
            </tr>

            <!-- Spasi antar Bagian -->
            <tr><td colspan="5" style="height: 6px;"></td></tr>

            <!-- Bagian II: Potongan -->
            <tr>
                <td class="bold">II.</td>
                <td colspan="4" class="bold">Potongan-Potongan</td>
            </tr>
            <tr>
                <td></td>
                <td>Potongan Tidak Hadir</td>
                <td class="text-center">:</td>
                <td class="col-rp">Rp</td>
                <td class="col-amount">{{number_format($data_gaji->potongan_tidak_hadir,0,",",".")}}</td>
            </tr>
            <tr>
                <td></td>
                <td>Potongan Keterlambatan</td>
                <td class="text-center">:</td>
                <td class="col-rp">Rp</td>
                <td class="col-amount">{{number_format($data_gaji->potongan_keterlambatan,0,",",".")}}</td>
            </tr>
            <tr>
                <td></td>
                <td>Kasbon</td>
                <td class="text-center">:</td>
                <td class="col-rp">Rp</td>
                <td class="col-amount">{{number_format($data_gaji->kasbon,0,",",".")}}</td>
            </tr>
            <tr>
                <td></td>
                <td>Jumlah Alpa</td>
                <td class="text-center">:</td>
                <td class="col-amount">{{$jumlah_alpa}} kali</td>
            </tr>
            <tr>
                <td></td>
                <td>Jumlah Terlanah</td>
                <td class="text-center">:</td>
                <td class="col-amount">{{$jumlah_terlambat}} menit</td>
            </tr>
            <tr>
                <td colspan="2" class="bold text-right" style="padding-right: 10px;">Total Penerimaan</td>
                <td class="text-center bold">:</td>
                <td class="col-rp bold">Rp</td>
                <td class="col-amount bold">{{number_format($jumlah_gaji_bersih,0,",",".")}}</td>
            </tr>
        </table>

        <!-- Tanda Tangan -->
        <div class="signature-wrapper">
            <table class="signature-table">
                <tr>
                    <td>Manado, 11 September 2023</td>
                </tr>
                <tr>
                    <td>Bendahara</td>
                </tr>
                <tr>
                    <td class="signature-space"></td>
                </tr>   
                <tr>
                    <td class="signature-name">Deice Illat, S.PdK</td>
                </tr>
                <tr>
                    <td>NIP. 19721214 200604 2 002</td>
                </tr>
            </table>
            <div class="clear"></div>
        </div>
    </div>

</body>
</html>