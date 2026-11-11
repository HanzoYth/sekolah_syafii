<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Massal Raport Tahfizh Al-Qur'an — SDQU Imam Syafi'i</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Rapor -->
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/rapor_walas.css') }}?v={{ time() }}">
    
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">

    <style>
        body {
            background-color: #ECE8DE;
            margin: 0;
            padding: 20px 0 60px 0;
            font-family: 'Poppins', sans-serif;
        }

        .mass-print-toolbar {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 9999;
            background: #ffffff;
            border-radius: 50px;
            padding: 10px 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            display: flex;
            align-items: center;
            gap: 12px;
            border: 2px solid var(--primary-color);
        }

        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
            }
            .mass-print-toolbar {
                display: none !important;
            }
            .page-break {
                page-break-after: always;
                break-after: page;
            }
        }
    </style>
</head>
<body>

    <!-- FLOATING ACTION TOOLBAR (NO-PRINT) -->
    <div class="mass-print-toolbar no-print">
        <span style="font-size: 13px; font-weight: 700; color: var(--primary-dark);">
            <i class="fa-solid fa-layer-group"></i> Total: {{ $daftar_siswa->count() }} Dokumen Raport
        </span>
        <button type="button" onclick="window.print()" class="btn-tahfiz-primary" style="border-radius: 30px;">
            <i class="fa-solid fa-print"></i> Cetak Seluruhnya
        </button>
        <button type="button" onclick="window.close()" class="btn-tahfiz-secondary" style="border-radius: 30px;">
            <i class="fa-solid fa-xmark"></i> Tutup
        </button>
    </div>

    <!-- LOOP SELURUH SANTRI DALAM ROMBEL -->
    @foreach($daftar_siswa as $siswa)
        @php
            $eval = $evaluasi_map->get($siswa->id);
            $template = \App\Models\evaluasi_rapor_tahfidz::getDefaultTemplate($siswa);

            $u1 = $eval->ujian_1 ?? $template['ujian_1'];
            $u2 = $eval->ujian_2 ?? $template['ujian_2'];
            $ua = $eval->ujian_akhir ?? $template['ujian_akhir'];
            $jml = $eval->ujian_jumlah ?? ($u1 + $u2 + ($ua * 2));
            $rata = $eval->ujian_rata_rata ?? round($jml / 4, 1);
            $pred = $eval->ujian_predikat ?? \App\Models\evaluasi_rapor_tahfidz::calculatePredikat($rata);

            $semIya = ($eval->tercapai_target_semester ?? $template['tercapai_target_semester']);
            $klsIya = ($eval->tercapai_target_kelas ?? $template['tercapai_target_kelas']);
        @endphp

        <div class="rapor-print-container" style="margin-bottom: 30px;">

            <!-- WATERMARK LOGO RESMI TRANSPARAN DI TENGAH LEMBAR -->
            <div class="rapor-watermark-overlay" aria-hidden="true">
                <img src="{{ asset('img/logo_sd.jpg') }}" alt="Watermark SDQU Tinggede">
            </div>

            <div class="rapor-sheet-content">

                <!-- HEADER DOKUMEN -->
                <div class="tahfiz-doc-header">
                    <h2>RAPORT TAHFIZH AL-QUR’AN SEMESTER {{ ($tahun_aktif->semester ?? 1) == 1 ? 'GANJIL' : 'GENAP' }} {{ $tahun_aktif->nama ? preg_replace('/[^0-9]/', '', substr($tahun_aktif->nama, 0, 4)) : '2025' }}</h2>
                    <h3>SEKOLAH DASAR AL-QUR’AN IMAM SYAFI’I TINGGEDE</h3>
                </div>

                <!-- DATA IDENTITAS SANTRI -->
                <table class="tahfiz-bio-table">
                    <tr>
                        <td class="tahfiz-bio-label">NAMA LENGKAP</td>
                        <td style="width: 15px;">:</td>
                        <td>{{ strtoupper($siswa->nama) }}</td>
                    </tr>
                    <tr>
                        <td class="tahfiz-bio-label">KELAS</td>
                        <td>:</td>
                        <td>{{ $eval->kelas_label ?? $template['kelas_label'] }}</td>
                    </tr>
                    <tr>
                        <td class="tahfiz-bio-label">UMUR</td>
                        <td>:</td>
                        <td>{{ $eval->umur ?? $template['umur'] }}</td>
                    </tr>
                    <tr>
                        <td class="tahfiz-bio-label">ORANG TUA/WALI</td>
                        <td>:</td>
                        <td>{{ $eval->orang_tua ?? $template['orang_tua'] }}</td>
                    </tr>
                </table>

                <!-- A. UJIAN KENAIKAN JUZ -->
                <div class="tahfiz-section-title">A. UJIAN KENAIKAN JUZ</div>
                <table class="tahfiz-table-clean">
                    <thead>
                        <tr>
                            <th style="width: 45%;">TANGGAL</th>
                            <th style="width: 25%;">JUZ</th>
                            <th style="width: 30%;">PREDIKAT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;">{{ $eval->kenaikan_juz_tanggal ?? $template['kenaikan_juz_tanggal'] }}</td>
                            <td style="text-align: center; font-weight: 700;">{{ $eval->kenaikan_juz_nomor ?? $template['kenaikan_juz_nomor'] }}</td>
                            <td style="text-align: center; font-weight: 700;">{{ $eval->kenaikan_juz_predikat ?? $template['kenaikan_juz_predikat'] }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- B. UJIAN TAHFIZH -->
                <div class="tahfiz-section-title">B. UJIAN TAHFIZH</div>
                <table class="tahfiz-table-clean">
                    <thead>
                        <tr>
                            <th style="width: 15%;">UJIAN 1</th>
                            <th style="width: 15%;">UJIAN 2</th>
                            <th style="width: 18%;">UJIAN AKHIR</th>
                            <th style="width: 16%;">JUMLAH</th>
                            <th style="width: 18%;">NILAI RATA-RATA</th>
                            <th style="width: 18%;">PREDIKAT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;">{{ number_format($u1, 0) }}</td>
                            <td style="text-align: center;">{{ number_format($u2, 0) }}</td>
                            <td style="text-align: center;">{{ number_format($ua, 0) }} x 2</td>
                            <td style="text-align: center; font-weight: 700;">{{ number_format($jml, 0) }}</td>
                            <td style="text-align: center; font-weight: 700;">{{ number_format($rata, 1, ',', '') }}</td>
                            <td style="text-align: center; font-weight: 800;">{{ $pred }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- C. TASMI' AKHIR SEMESTER -->
                <div class="tahfiz-section-title">C. TASMI’ AKHIR SEMESTER</div>
                <table class="tahfiz-table-clean">
                    <thead>
                        <tr>
                            <th style="width: 45%;">TANGGAL</th>
                            <th style="width: 25%;">JUMLAH JUZ</th>
                            <th style="width: 30%;">PREDIKAT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;">{{ $eval->tasmi_tanggal ?? $template['tasmi_tanggal'] }}</td>
                            <td style="text-align: center;">{{ $eval->tasmi_jumlah_juz ?? $template['tasmi_jumlah_juz'] }}</td>
                            <td style="text-align: center;">{{ $eval->tasmi_predikat ?? $template['tasmi_predikat'] }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- D. PENCAPAIAN TAHFIZH -->
                <div class="tahfiz-section-title">D. PENCAPAIAN TAHFIZH</div>
                <table class="tahfiz-table-clean">
                    <thead>
                        <tr>
                            <th colspan="2" style="width: 34%;">HAFALAN SEMESTER</th>
                            <th colspan="2" style="width: 34%;">TOTAL HAFALAN</th>
                            <th colspan="2" style="width: 16%;">TERCAPAI TARGET SEMESTER</th>
                            <th colspan="2" style="width: 16%;">TERCAPAI TARGET KELAS</th>
                        </tr>
                        <tr>
                            <th style="font-size: 11px;">Target</th>
                            <th style="font-size: 11px;">Tercapai</th>
                            <th style="font-size: 11px;">Target</th>
                            <th style="font-size: 11px;">Tercapai</th>
                            <th style="font-size: 11px; width: 8%;">Iya</th>
                            <th style="font-size: 11px; width: 8%;">Tidak</th>
                            <th style="font-size: 11px; width: 8%;">Iya</th>
                            <th style="font-size: 11px; width: 8%;">Tidak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; font-weight: 600;">{{ $eval->target_semester ?? $template['target_semester'] }}</td>
                            <td style="font-size: 11px; line-height: 1.35;">{{ $eval->tercapai_semester ?? $template['tercapai_semester'] }}</td>
                            <td style="text-align: center; font-weight: 600;">{{ $eval->target_total ?? $template['target_total'] }}</td>
                            <td style="font-size: 11px; line-height: 1.35;">{{ $eval->tercapai_total ?? $template['tercapai_total'] }}</td>
                            <td style="text-align: center; font-weight: 800; font-size: 14px;">{!! $semIya ? '√' : '' !!}</td>
                            <td style="text-align: center; font-weight: 800; font-size: 14px;">{!! !$semIya ? '√' : '' !!}</td>
                            <td style="text-align: center; font-weight: 800; font-size: 14px;">{!! $klsIya ? '√' : '' !!}</td>
                            <td style="text-align: center; font-weight: 800; font-size: 14px;">{!! !$klsIya ? '√' : '' !!}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- CATATAN PENGAMPU HALAQAH -->
                <div class="tahfiz-catatan-wrapper">
                    <div class="tahfiz-catatan-title">CATATAN PENGAMPU HALAQAH :</div>

                    <div class="tahfiz-catatan-sub">Bacaan (Makharijul Huruf. Tajwid)</div>
                    <div class="tahfiz-catatan-text">{{ $eval->catatan_bacaan ?? $template['catatan_bacaan'] }}</div>

                    <div class="tahfiz-catatan-sub">Hafalan (Itqan/Kelancaran)</div>
                    <div class="tahfiz-catatan-text">{{ $eval->catatan_hafalan ?? $template['catatan_hafalan'] }}</div>

                    <div class="tahfiz-catatan-sub">Akhlak</div>
                    <div class="tahfiz-catatan-text">{{ $eval->catatan_akhlak ?? $template['catatan_akhlak'] }}</div>
                </div>

                <!-- TANDA TANGAN & TITIMANGSA (3 TANDA TANGAN: KIRI PENGAMPU, KANAN WALI KELAS, TENGAH BAWAH KEPSEK) -->
                <div style="margin-top: 24px; page-break-inside: avoid;">
                    <table style="width: 100%; text-align: center; font-size: 11.5px; border-collapse: collapse; margin-bottom: 8px;">
                        <tr>
                            <!-- Kiri: Pengampu Halaqah -->
                            <td style="width: 46%; vertical-align: top;">
                                <div style="color: transparent; user-select: none;">&nbsp;</div>
                                <div style="font-weight: 500;">Pengampu Halaqah,</div>
                                <div style="height: 58px; display: flex; align-items: center; justify-content: center;">
                                    @if(!empty($eval->ttd_pengampu))
                                        <img src="{{ $eval->ttd_pengampu }}" alt="TTD Pengampu" style="max-height: 52px;">
                                    @endif
                                </div>
                                <strong style="text-decoration: underline; font-size: 12.5px;">{{ $eval->nama_pengampu ?? $template['nama_pengampu'] ?? 'USTADZAH PENGAMPU HALAQAH' }}</strong>
                                <div style="font-size: 11px; color: #333; margin-top: 2px;">Pengampu Halaqah</div>
                            </td>

                            <td style="width: 8%;"></td>

                            <!-- Kanan: Wali Kelas (disertai Titimangsa) -->
                            <td style="width: 46%; vertical-align: top;">
                                <div>
                                    <span>{{ $eval->tempat_rapor ?? $template['tempat_rapor'] }}</span>, 
                                    <span>{{ $eval->tanggal_rapor ?? $template['tanggal_rapor'] }}</span>
                                </div>
                                <div style="font-weight: 500;">Wali Kelas,</div>
                                <div style="height: 58px; display: flex; align-items: center; justify-content: center;">
                                    @if(!empty($eval->ttd_walas))
                                        <img src="{{ $eval->ttd_walas }}" alt="TTD Walas" style="max-height: 52px;">
                                    @endif
                                </div>
                                <strong style="text-decoration: underline; font-size: 12.5px;">{{ $eval->nama_walas ?? $template['nama_walas'] }}</strong>
                                <div style="font-size: 11px; color: #333; margin-top: 2px;">{{ $eval->role_pengampu_label ?? $template['role_pengampu_label'] ?? 'Wali Kelas 6' }}</div>
                            </td>
                        </tr>

                        <!-- Baris 2: Tengah Bawah Kepala Sekolah -->
                        <tr>
                            <td colspan="3" style="text-align: center; vertical-align: top; padding-top: 14px;">
                                <div style="display: inline-block; min-width: 250px;">
                                    <div style="font-weight: 500;">Mengetahui,</div>
                                    <div style="font-size: 11px; color: #333; margin-top: 1px;">Kepala Sekolah SDQU Imam Syafi’i</div>
                                    <div style="height: 58px; display: flex; align-items: center; justify-content: center;">
                                        @if(!empty($eval->ttd_kepsek))
                                            <img src="{{ $eval->ttd_kepsek }}" alt="TTD Kepsek" style="max-height: 52px;">
                                        @endif
                                    </div>
                                    <strong style="text-decoration: underline; font-size: 12.5px;">{{ $eval->nama_kepsek ?? $template['nama_kepsek'] }}</strong>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- KETERANGAN PREDIKAT (FOOTER ACUAN RESMI) -->
                <div class="tahfiz-predikat-legend">
                    <strong>Keterangan Predikat :</strong><br>
                    Mumtaz/ A: 91-100 &nbsp;&nbsp;|&nbsp;&nbsp; Jayyid Jiddan/B : 83-90 &nbsp;&nbsp;|&nbsp;&nbsp; Jayyid/C : 72-82 &nbsp;&nbsp;|&nbsp;&nbsp; Maqbul/D : 61-71 &nbsp;&nbsp;|&nbsp;&nbsp; Dha’if/E : &lt;60
                </div>

            </div>
        </div>

        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

</body>
</html>
