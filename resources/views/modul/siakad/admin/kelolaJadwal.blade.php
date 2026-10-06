<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jadwal - SIAKAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/dasboard.css') }}">
    <style>
        .jadwal-container { padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 20px; }
        .jadwal-header { font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #0d5c3a; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px; }
        .form-group { display: flex; flex-direction: column; gap: 5px; }
        .form-group label { font-size: 13px; font-weight: 600; color: #475569; }
        .form-group select, .form-group input { padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; }
        .form-group select:focus, .form-group input:focus { border-color: #0d5c3a; }
        .btn-submit { background: #0d5c3a; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; align-self: flex-start; }
        .btn-submit:hover { background: #0a462c; }
        
        .jadwal-table { width: 100%; border-collapse: collapse; text-align: left; margin-top: 20px; }
        .jadwal-table th { background: #f0fdf4; padding: 12px; font-weight: 600; color: #166534; border-bottom: 2px solid #dcfce7; }
        .jadwal-table td { padding: 12px; border-bottom: 1px solid #f1f5f9; color: #475569; }
        .jadwal-table tr:hover { background: #f8fafc; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar title="Kelola Jadwal Pelajaran" description="Atur penempatan jadwal mengajar guru dan kelas." position="Admin SIAKAD" initials="AD" />

            <div class="jadwal-container">
                <div class="jadwal-header"><i class="fa-solid fa-calendar-plus"></i> Tambah Jadwal Baru</div>
                
                @if(session('success'))
                    <div style="padding: 12px; background: #dcfce7; color: #15803d; border-radius: 6px; margin-bottom: 15px;">{{ session('success') }}</div>
                @endif

                <form action="/sk/simpan-jadwal" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" required>
                                <option value="">-- Pilih Tahun --</option>
                                @foreach($data_tahun as $t)
                                    <option value="{{ $t->id }}">{{ $t->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas_id" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($data_kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Guru Pengajar</label>
                            <select name="guru_id" required>
                                <option value="">-- Pilih Guru --</option>
                                @foreach($data_guru as $g)
                                    <option value="{{ $g->id }}">{{ $g->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select name="mapel_id" required>
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach($data_mapel as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hari</label>
                            <select name="hari" required>
                                <option value="">-- Pilih Hari --</option>
                                <option value="senin">Senin</option><option value="selasa">Selasa</option>
                                <option value="rabu">Rabu</option><option value="kamis">Kamis</option>
                                <option value="jumat">Jumat</option><option value="sabtu">Sabtu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jam Pelajaran</label>
                            <select name="jam_pelajaran_id" required>
                                <option value="">-- Pilih Jam --</option>
                                @foreach($data_jam as $jam)
                                    <option value="{{ $jam->id }}">{{ $jam->nama_jam }} ({{ $jam->jam_mulai }} - {{ $jam->jam_selesai }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-save"></i> Simpan Jadwal</button>
                </form>
            </div>

            <div class="jadwal-container">
                <div class="jadwal-header"><i class="fa-solid fa-list"></i> Daftar Jadwal Terdaftar</div>
                <div style="overflow-x: auto; width: 100%;"><table class="jadwal-table">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru Pengajar</th>
                            <th>Tahun Ajaran</th><th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_jadwal as $j)
                        <tr>
                            <td style="text-transform: capitalize;"><strong>{{ $j->hari }}</strong></td>
                            <td>{{ $j->jam_pelajaran->nama_jam ?? '-' }}<br><small>{{ $j->jam_pelajaran->jam_mulai ?? '-' }} - {{ $j->jam_pelajaran->jam_selesai ?? '-' }}</small></td>
                            <td>{{ $j->kelas->nama_kelas ?? '-' }}</td>
                            <td>{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</td>
                            <td>{{ $j->guru->nama ?? '-' }}</td>
                            <td>{{ $j->tahun_ajaran->nama ?? '-' }}</td><td><a href="/sk/edit-jadwal/{{ $j->id }}" style="color:#0284c7; margin-right:8px;"><i class="fa-solid fa-pen"></i></a><a href="/sk/hapus-jadwal/{{ $j->id }}" onclick="return confirm('Yakin ingin menghapus jadwal ini?')" style="color:#e11d48;"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                        @empty
                        <tr><td colspan="7" style="text-align: center; padding: 20px;">Belum ada data jadwal pelajaran.</td></tr>
                        @endforelse
                    </tbody>
                </table></div>
            </div>
        </main>
    </div>

    <x-warning />
</body>
</html>