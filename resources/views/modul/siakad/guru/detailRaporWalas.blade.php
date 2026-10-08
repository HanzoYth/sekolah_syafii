<x-siakad-layout title="Detail Rapor - SIAKAD" pageTitle="Rapor Akademik Siswa" pageDescription="Preview rapor sebelum dicetak.">
    <div class="page-header" style="display: flex; justify-content: space-between;">
        <h2 class="page-title"><i class="fa-solid fa-user-graduate"></i> Rapor: {{ $siswa->nama }}</h2>
        <x-siakad.ui.button type="primary" icon="fa-solid fa-print" onclick="window.print()">Cetak Dokumen</x-siakad.ui.button>
    </div>

    <!-- Area yang akan dicetak -->
    <div class="print-area" style="background: white; padding: 40px; border: 1px solid #e2e8f0; border-radius: 8px; margin-top: 20px;">
        <div style="text-align: center; border-bottom: 3px solid #1e293b; padding-bottom: 20px; margin-bottom: 20px;">
            <h1 style="margin: 0; font-size: 24px; text-transform: uppercase;">Laporan Hasil Belajar Siswa</h1>
            <h2 style="margin: 5px 0 0 0; font-size: 18px; color: #475569;">Semester Ganjil - Tahun Ajaran 2026/2027</h2>
        </div>

        <table style="width: 100%; margin-bottom: 30px; font-size: 14px;">
            <tr>
                <td style="width: 150px; font-weight: bold; padding: 4px 0;">Nama Lengkap</td>
                <td style="width: 10px;">:</td>
                <td>{{ $siswa->nama }}</td>
                
                <td style="width: 150px; font-weight: bold; padding: 4px 0;">Kelas</td>
                <td style="width: 10px;">:</td>
                <td>{{ $wallas->ruangKelas->nama_ruang }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding: 4px 0;">NIS / NISN</td>
                <td>:</td>
                <td>{{ $siswa->nis }}</td>
                
                <td style="font-weight: bold; padding: 4px 0;">Wali Kelas</td>
                <td>:</td>
                <td>{{ $wallas->guru->nama ?? '-' }}</td>
            </tr>
        </table>

        <h3 style="font-size: 16px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px; margin-bottom: 15px;">A. Nilai Akademik</h3>
        <table style="width: 100%; border-collapse: collapse; font-size: 14px; text-align: center; margin-bottom: 30px;" border="1">
            <thead>
                <tr style="background: #f8fafc;">
                    <th style="padding: 10px; border: 1px solid #cbd5e1; width: 50px;">No</th>
                    <th style="padding: 10px; border: 1px solid #cbd5e1; text-align: left;">Mata Pelajaran</th>
                    <th style="padding: 10px; border: 1px solid #cbd5e1; width: 100px;">Nilai Akhir</th>
                    <th style="padding: 10px; border: 1px solid #cbd5e1; width: 100px;">Predikat</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @forelse($rekap_nilai as $mapel => $data)
                    @php 
                        $na = $data['nilai_akhir']; 
                        $predikat = 'D';
                        if($na >= 90) $predikat = 'A';
                        elseif($na >= 80) $predikat = 'B';
                        elseif($na >= 70) $predikat = 'C';
                    @endphp
                    <tr>
                        <td style="padding: 10px; border: 1px solid #cbd5e1;">{{ $i++ }}</td>
                        <td style="padding: 10px; border: 1px solid #cbd5e1; text-align: left;">{{ $mapel }}</td>
                        <td style="padding: 10px; border: 1px solid #cbd5e1; font-weight: bold;">{{ number_format($na, 1) }}</td>
                        <td style="padding: 10px; border: 1px solid #cbd5e1;">{{ $predikat }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 20px; border: 1px solid #cbd5e1;">Belum ada nilai yang diinput.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <h3 style="font-size: 16px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px; margin-bottom: 15px;">B. Ketidakhadiran</h3>
        <table style="width: 50%; border-collapse: collapse; font-size: 14px; margin-bottom: 40px;" border="1">
            <tr>
                <td style="padding: 8px 15px; border: 1px solid #cbd5e1; background: #f8fafc;">Sakit</td>
                <td style="padding: 8px 15px; border: 1px solid #cbd5e1; text-align: center;">{{ $rekap_absensi['sakit'] }} hari</td>
            </tr>
            <tr>
                <td style="padding: 8px 15px; border: 1px solid #cbd5e1; background: #f8fafc;">Izin</td>
                <td style="padding: 8px 15px; border: 1px solid #cbd5e1; text-align: center;">{{ $rekap_absensi['izin'] }} hari</td>
            </tr>
            <tr>
                <td style="padding: 8px 15px; border: 1px solid #cbd5e1; background: #f8fafc;">Tanpa Keterangan</td>
                <td style="padding: 8px 15px; border: 1px solid #cbd5e1; text-align: center;">{{ $rekap_absensi['alpa'] }} hari</td>
            </tr>
        </table>

        <div style="display: flex; justify-content: space-between; margin-top: 50px;">
            <div style="text-align: center;">
                <p style="margin-bottom: 70px;">Orang Tua / Wali</p>
                <p>_________________________</p>
            </div>
            <div style="text-align: center;">
                <p style="margin-bottom: 70px;">Wali Kelas</p>
                <p style="font-weight: bold;">{{ $wallas->guru->nama ?? '..........................' }}</p>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * { visibility: hidden; }
            .print-area, .print-area * { visibility: visible; }
            .print-area { position: absolute; left: 0; top: 0; width: 100%; border: none; padding: 0; }
            .siakad-topbar, .siakad-sidebar, .page-header { display: none !important; }
        }
    </style>
</x-siakad-layout>

