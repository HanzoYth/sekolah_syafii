<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Kelas - SIAKAD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/dasboard.css') }}">
    <style>
        .page-container { padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 20px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px; margin-bottom: 20px; }
        .page-header h2 { font-size: 18px; color: #0d5c3a; margin: 0; display: flex; align-items: center; gap: 8px; }
        .recap-box { display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap; }
        .recap-item { background: #f8fafc; padding: 12px 20px; border-radius: 8px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 12px; min-width: 140px; }
        .recap-item.hadir { border-color: #86efac; background: #f0fdf4; }
        .recap-item.sakit { border-color: #fde047; background: #fefce8; }
        .recap-item.izin { border-color: #93c5fd; background: #eff6ff; }
        .recap-item.alpa { border-color: #fca5a5; background: #fef2f2; }
        .recap-item i { font-size: 20px; color: #64748b; }
        .recap-item.hadir i { color: #16a34a; }
        .recap-item.sakit i { color: #eab308; }
        .recap-item.izin i { color: #3b82f6; }
        .recap-item.alpa i { color: #ef4444; }
        .recap-item div strong { display: block; font-size: 18px; color: #1e293b; }
        .recap-item div span { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }

        .table-absensi { width: 100%; border-collapse: collapse; text-align: left; }
        .table-absensi th { background: #f0fdf4; padding: 12px; font-weight: 600; color: #166534; border-bottom: 2px solid #dcfce7; }
        .table-absensi td { padding: 12px; border-bottom: 1px solid #f1f5f9; color: #475569; vertical-align: middle; }
        .table-absensi tr:hover { background: #f8fafc; }
        
        .radio-group { display: flex; gap: 10px; }
        .radio-label { display: flex; align-items: center; gap: 5px; cursor: pointer; padding: 4px 8px; border-radius: 4px; border: 1px solid #cbd5e1; font-size: 14px; transition: all 0.2s; }
        .radio-label:hover { background: #f1f5f9; }
        .radio-label input[type="radio"] { cursor: pointer; }
        
        /* Custom styles when selected */
        .radio-label:has(input[value="h"]:checked) { background: #dcfce7; border-color: #16a34a; color: #166534; }
        .radio-label:has(input[value="s"]:checked) { background: #fef9c3; border-color: #eab308; color: #854d0e; }
        .radio-label:has(input[value="i"]:checked) { background: #dbeafe; border-color: #3b82f6; color: #1e40af; }
        .radio-label:has(input[value="a"]:checked) { background: #fee2e2; border-color: #ef4444; color: #991b1b; }

        .input-ket { width: 100%; padding: 6px 10px; border: 1px solid #cbd5e1; border-radius: 4px; font-family: inherit; font-size: 14px; }
        .input-ket:focus { border-color: #0d5c3a; outline: none; }
        
        .btn-save { background: #0d5c3a; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; margin-top: 20px; display: inline-flex; align-items: center; gap: 8px; }
        .btn-save:hover { background: #064e3b; }
        .filter-form { display: flex; gap: 10px; align-items: center; }
        .filter-form input[type="date"] { padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit; }
        .filter-form button { background: #f1f5f9; border: 1px solid #cbd5e1; padding: 8px 15px; border-radius: 6px; cursor: pointer; }
        .filter-form button:hover { background: #e2e8f0; }
        .alert-toast { padding: 16px 20px; background: #ecfdf5; color: #065f46; border-radius: 12px; border: 1px solid #a7f3d0; margin-bottom: 20px; font-weight: 500; font-size: 0.95rem; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar title="Absensi Kelas" description="Kelola kehadiran siswa di kelas Anda." position="Wali Kelas" initials="WK" />

            <div class="page-container">
                @if(session('success'))
                <div class="alert-toast">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
                @endif
                
                <div class="page-header">
                    <h2><i class="fa-solid fa-clipboard-user"></i> Absensi: {{ $wallas->ruangKelas->nama_ruang ?? 'Kelas' }}</h2>
                    <form class="filter-form" method="GET" action="/sk/absensi-walas">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ $tanggal }}">
                        <button type="submit">Tampilkan</button>
                    </form>
                </div>
                
                <div class="recap-box">
                    <div class="recap-item">
                        <i class="fa-solid fa-users"></i>
                        <div><strong>{{ $rekap['total'] }}</strong><span>Total Siswa</span></div>
                    </div>
                    <div class="recap-item hadir">
                        <i class="fa-solid fa-circle-check"></i>
                        <div><strong>{{ $rekap['hadir'] }}</strong><span>Hadir</span></div>
                    </div>
                    <div class="recap-item sakit">
                        <i class="fa-solid fa-notes-medical"></i>
                        <div><strong>{{ $rekap['sakit'] }}</strong><span>Sakit</span></div>
                    </div>
                    <div class="recap-item izin">
                        <i class="fa-solid fa-envelope-open-text"></i>
                        <div><strong>{{ $rekap['izin'] }}</strong><span>Izin</span></div>
                    </div>
                    <div class="recap-item alpa">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div><strong>{{ $rekap['alpa'] }}</strong><span>Alpa</span></div>
                    </div>
                </div>

                <form action="/sk/simpan-absensi-walas" method="POST">
                    @csrf
                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                    
                    <div style="overflow-x: auto;">
                        <table class="table-absensi">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Nama Siswa</th>
                                    <th>NIS</th>
                                    <th style="width: 320px;">Status Kehadiran</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($siswa as $index => $s)
                                    @php
                                        $absen = $absensi_db[$s->id] ?? null;
                                        $status = $absen ? $absen->status : 'h'; // Default hadir (h)
                                        $keterangan = $absen ? $absen->keterangan : '';
                                    @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $s->nama }}</strong></td>
                                    <td>{{ $s->nis }}</td>
                                    <td>
                                        <div class="radio-group">
                                            <label class="radio-label">
                                                <input type="radio" name="status[{{ $s->id }}]" value="h" {{ $status == 'h' ? 'checked' : '' }}> Hadir
                                            </label>
                                            <label class="radio-label">
                                                <input type="radio" name="status[{{ $s->id }}]" value="s" {{ $status == 's' ? 'checked' : '' }}> Sakit
                                            </label>
                                            <label class="radio-label">
                                                <input type="radio" name="status[{{ $s->id }}]" value="i" {{ $status == 'i' ? 'checked' : '' }}> Izin
                                            </label>
                                            <label class="radio-label">
                                                <input type="radio" name="status[{{ $s->id }}]" value="a" {{ $status == 'a' ? 'checked' : '' }}> Alpa
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan[{{ $s->id }}]" value="{{ $keterangan }}" class="input-ket" placeholder="Opsional">
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 30px;">Belum ada data siswa.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if(count($siswa) > 0)
                    <div style="text-align: right;">
                        <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Absensi</button>
                    </div>
                    @endif
                </form>
            </div>
        </main>
    </div>
</body>
</html>
