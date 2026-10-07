<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rapor - SIAKAD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/dasboard.css') }}">
    <style>
        .page-container { padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 20px; }
        .page-header { font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #0d5c3a; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px; display: flex; align-items: center; gap: 8px; }
        .table-rapor { width: 100%; border-collapse: collapse; text-align: left; }
        .table-rapor th { background: #f0fdf4; padding: 12px; font-weight: 600; color: #166534; border-bottom: 2px solid #dcfce7; }
        .table-rapor td { padding: 12px; border-bottom: 1px solid #f1f5f9; color: #475569; vertical-align: middle; }
        .table-rapor tr:hover { background: #f8fafc; }
        .btn-print { background: #0ea5e9; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 500; }
        .btn-print:hover { background: #0284c7; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar title="Cetak Rapor Siswa" description="Kelola dan cetak rapor akademik siswa per semester." position="Wali Kelas" initials="WK" />

            <div class="page-container">
                <div class="page-header">
                    <i class="fa-solid fa-file-contract"></i> Daftar Siswa - {{ $wallas->ruangKelas->nama_ruang ?? 'Kelas' }}
                </div>
                
                <table class="table-rapor">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Gender</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $s)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $s->nis }}</td>
                            <td><strong>{{ $s->nama }}</strong></td>
                            <td>{{ $s->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td style="text-align: center;">
                                <a href="#" onclick="alert('Fitur Generate Dokumen Rapor sedang dalam pengembangan.')" class="btn-print"><i class="fa-solid fa-print"></i> Lihat & Cetak Rapor</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px;">Belum ada data siswa di kelas ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>

