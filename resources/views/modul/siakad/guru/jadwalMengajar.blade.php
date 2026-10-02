<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mengajar - SIAKAD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/dasboard.css') }}">
    <style>
        .jadwal-container { padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 20px; }
        .jadwal-header { font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #0d5c3a; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px; }
        .jadwal-table { width: 100%; border-collapse: collapse; text-align: left; }
        .jadwal-table th { background: #f0fdf4; padding: 12px; font-weight: 600; color: #166534; border-bottom: 2px solid #dcfce7; }
        .jadwal-table td { padding: 12px; border-bottom: 1px solid #f1f5f9; color: #475569; }
        .jadwal-table tr:hover { background: #f8fafc; }
        .badge-hari { background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold; }
        .badge-kelas { background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar title="Jadwal Mengajar" description="Jadwal mata pelajaran yang Anda ampu." position="Guru SIAKAD" initials="GR" />

            <div class="jadwal-container">
                <div class="jadwal-header"><i class="fa-solid fa-calendar-week"></i> Jadwal Mengajar Anda</div>
                <table class="jadwal-table">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Jam Pelajaran</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwal as $j)
                        <tr>
                            <td><span class="badge-hari">{{ $j->hari }}</span></td>
                            <td>{{ $j->jam_pelajaran->jam_mulai ?? '-' }} - {{ $j->jam_pelajaran->jam_selesai ?? '-' }}</td>
                            <td><span class="badge-kelas">{{ $j->kelas->nama_kelas ?? '-' }}</span></td>
                            <td><strong>{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</strong></td>
                            <td>{{ $j->kelas->nama_kelas ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px;">
                                <i class="fa-solid fa-folder-open" style="font-size: 24px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                                Belum ada jadwal mengajar yang diatur untuk Anda.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>