<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai Detail - SIAKAD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/dasboard.css') }}">
    <style>
        .page-container { padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 20px; }
        .page-header { font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #0d5c3a; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: center; }
        .nilai-table { width: 100%; border-collapse: collapse; text-align: left; }
        .nilai-table th { background: #f0fdf4; padding: 12px; font-weight: 600; color: #166534; border-bottom: 2px solid #dcfce7; }
        .nilai-table td { padding: 12px; border-bottom: 1px solid #f1f5f9; color: #475569; }
        .nilai-table tr:hover { background: #f8fafc; }
        .input-nilai { width: 60px; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px; text-align: center; font-family: inherit; }
        .input-nilai:focus { border-color: #0d5c3a; outline: none; box-shadow: 0 0 0 2px rgba(13, 92, 58, 0.2); }
        .btn-save { background: #0d5c3a; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; margin-top: 20px; float: right; display: inline-flex; align-items: center; gap: 8px; }
        .btn-save:hover { background: #064e3b; }
        .alert-toast { padding: 16px 20px; background: #ecfdf5; color: #065f46; border-radius: 12px; border: 1px solid #a7f3d0; margin-bottom: 20px; font-weight: 500; font-size: 0.95rem; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar title="Input Nilai Siswa" description="Masukkan nilai untuk mata pelajaran {{ $jadwal->mata_pelajaran->nama_mapel ?? '-' }} kelas {{ $jadwal->kelas->nama_kelas ?? '-' }}." position="Guru SIAKAD" initials="GR" />

            <div class="page-container">
                @if(session('success'))
                <div class="alert-toast">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
                @endif
                
                <div class="page-header">
                    <div>
                        <i class="fa-solid fa-file-pen"></i> Form Nilai: {{ $jadwal->kelas->nama_kelas ?? '-' }} - {{ $jadwal->mata_pelajaran->nama_mapel ?? '-' }}
                    </div>
                    <a href="/sk/nilai-guru" style="color: #64748b; text-decoration: none; font-size: 14px; font-weight: normal;"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>
                
                <form action="/sk/simpan-nilai-siswa/{{ $jadwal->id }}" method="POST">
                    @csrf
                    <table class="nilai-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Nama Siswa</th>
                                <th>NIS</th>
                                @foreach($jenis_penilaian as $jp)
                                    <th style="text-align: center;">{{ $jp->nama_jenis }} ({{ $jp->bobot }}%)</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswa as $index => $s)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $s->nama }}</strong></td>
                                <td>{{ $s->nis }}</td>
                                @foreach($jenis_penilaian as $jp)
                                    <td style="text-align: center;">
                                        <input type="number" 
                                               name="nilai[{{ $s->id }}][{{ $jp->id }}]" 
                                               value="{{ $nilai[$s->id][$jp->id] ?? '' }}" 
                                               class="input-nilai" 
                                               min="0" max="100" step="0.1" 
                                               placeholder="-">
                                    </td>
                                @endforeach
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ 3 + count($jenis_penilaian) }}" style="text-align: center; padding: 30px;">
                                    Belum ada siswa di kelas ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    @if(count($siswa) > 0)
                    <div style="overflow: hidden;">
                        <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Nilai</button>
                    </div>
                    @endif
                </form>
            </div>
        </main>
    </div>
</body>
</html>

