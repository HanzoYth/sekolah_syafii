<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai - SIAKAD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/dasboard.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar title="Manajemen Nilai" description="Kelola nilai siswa untuk mata pelajaran Anda." position="Guru SIAKAD" initials="GR" />

            <div style="padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 20px;">
                <div style="font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #0d5c3a; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px;">
                    <i class="fa-solid fa-star"></i> Kelas & Mata Pelajaran Anda
                </div>
                
                @forelse($mapel_guru as $mapel)
                    <div style="padding: 15px; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h3 style="margin: 0; color: #1e293b;">{{ $mapel->mata_pelajaran->nama_mapel ?? '-' }}</h3>
                            <p style="margin: 5px 0 0; color: #64748b; font-size: 13px;"><i class="fa-solid fa-users"></i> {{ $mapel->kelas->nama_kelas ?? '-' }}</p>
                        </div>
                        <button style="background: #0d5c3a; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer;">Input Nilai</button>
                    </div>
                @empty
                    <div style="text-align: center; padding: 30px; color: #94a3b8;">Belum ada jadwal mengajar / mata pelajaran yang ditugaskan.</div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>