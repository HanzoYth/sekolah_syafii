<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wali Kelas - SIAKAD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/dasboard.css') }}">
    <style>
        .table-siswa { width: 100%; border-collapse: collapse; text-align: left; }
        .table-siswa th { background: #f0fdf4; padding: 12px; font-weight: 600; color: #166534; border-bottom: 2px solid #dcfce7; }
        .table-siswa td { padding: 12px; border-bottom: 1px solid #f1f5f9; color: #475569; }
        .table-siswa tr:hover { background: #f8fafc; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar title="Data Siswa Wali Kelas" description="Daftar siswa yang berada di bawah perwalian Anda." position="Guru SIAKAD" initials="GR" />

            <div style="padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 20px;">
                @if($wallas)
                    <div style="font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #0d5c3a; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px;">
                        <i class="fa-solid fa-users-rectangle"></i> Rombongan Belajar: {{ $wallas->kelas->nama_ruang ?? '-' }}
                    </div>
                    
                    <table class="table-siswa">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswa as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->nis }}</td>
                                <td><strong>{{ $s->nama_lengkap }}</strong></td>
                                <td>{{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td><span style="background:#dcfce7; color:#15803d; padding:4px 8px; border-radius:4px; font-size:12px;">Aktif</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px; color: #94a3b8;">Belum ada data siswa di kelas ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                @else
                    <div style="text-align: center; padding: 40px; color: #64748b;">
                        <i class="fa-solid fa-ban" style="font-size: 32px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
                        Anda saat ini tidak ditugaskan sebagai Wali Kelas.
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>