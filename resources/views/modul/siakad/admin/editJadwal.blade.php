<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal - SIAKAD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
        .btn-cancel { background: #cbd5e1; color: #334155; padding: 10px 20px; border: none; border-radius: 6px; font-weight: bold; text-decoration: none; align-self: flex-start;}
    </style>
</head>
<body>
    <div class="dashboard-container">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar title="Edit Jadwal Pelajaran" description="Perbarui informasi jadwal mengajar." position="Admin SIAKAD" initials="AD" />
            <div class="jadwal-container">
                <div class="jadwal-header"><i class="fa-solid fa-pen-to-square"></i> Edit Jadwal</div>
                <form action="/sk/update-jadwal/{{ $jadwal->id }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" required>
                                @foreach($data_tahun as $t)
                                    <option value="{{ $t->id }}" {{ $jadwal->tahun_ajaran_id == $t->id ? 'selected' : '' }}>{{ $t->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas_id" required>
                                @foreach($data_kelas as $k)
                                    <option value="{{ $k->id }}" {{ $jadwal->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Guru Pengajar</label>
                            <select name="guru_id" required>
                                @foreach($data_guru as $g)
                                    <option value="{{ $g->id }}" {{ $jadwal->guru_id == $g->id ? 'selected' : '' }}>{{ $g->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select name="mapel_id" required>
                                @foreach($data_mapel as $m)
                                    <option value="{{ $m->id }}" {{ $jadwal->mapel_id == $m->id ? 'selected' : '' }}>{{ $m->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hari</label>
                            <select name="hari" required>
                                <option value="senin" {{ $jadwal->hari == 'senin' ? 'selected' : '' }}>Senin</option>
                                <option value="selasa" {{ $jadwal->hari == 'selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="rabu" {{ $jadwal->hari == 'rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="kamis" {{ $jadwal->hari == 'kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="jumat" {{ $jadwal->hari == 'jumat' ? 'selected' : '' }}>Jumat</option>
                                <option value="sabtu" {{ $jadwal->hari == 'sabtu' ? 'selected' : '' }}>Sabtu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jam Pelajaran</label>
                            <select name="jam_pelajaran_id" required>
                                @foreach($data_jam as $jam)
                                    <option value="{{ $jam->id }}" {{ $jadwal->jam_pelajaran_id == $jam->id ? 'selected' : '' }}>{{ $jam->nama_jam }} ({{ $jam->jam_mulai }} - {{ $jam->jam_selesai }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn-submit"><i class="fa-solid fa-save"></i> Simpan Perubahan</button>
                        <a href="/sk/kelola-jadwal" class="btn-cancel">Batal</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>


