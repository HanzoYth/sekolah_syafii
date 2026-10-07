<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jadwal - SIAKAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/tambahKelas.css') }}?v={{ time() }}">
    
    <style>
        .class-content { max-width: 1200px; margin: 0 auto; }
        .form-grid-3 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; margin-top: 15px; }
        @media (max-width: 992px) { .form-grid-3 { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 600px) { .form-grid-3 { grid-template-columns: 1fr; } }
        
        /* === STYLE KHUSUS TABEL DATA SISWA === */
        .students-card { border: 1px solid #dce8e2; border-radius: 18px; background: #ffffff; box-shadow: 0 12px 30px rgba(27, 65, 50, .08); overflow: hidden; margin-bottom: 25px; }
        .card-header { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 21px 24px; border-bottom: 1px solid #dce8e2; }
        .card-header h2 { margin: 0 0 4px; font-size: 1.03rem; color: #18332c; }
        .card-header p { margin: 0; color: #6b7b75; font-size: .88rem; }
        .result-counter { padding: 6px 10px; border-radius: 999px; background: #e5f4ed; color: #276247; font-size: .75rem; font-weight: 700; }
        
        .table-wrapper { overflow-x: auto; }
        .ds-table { width: 100%; min-width: 760px; border-collapse: collapse; text-align: left; }
        .ds-table th { padding: 13px 18px; background: #f3f8f5; color: #547166; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; border-bottom: none; }
        .ds-table td { padding: 14px 18px; border-top: 1px solid #edf2ef; font-size: .83rem; color: #18332c; }
        .ds-table tbody tr { transition: background .16s ease; }
        .ds-table tbody tr:hover { background: #f8fcf9; }
        
        .number-column { width: 58px; text-align: center; color: #7b8b84; }
        .action-column { width: 110px; text-align: center; }
        
        .student-cell { display: flex; align-items: center; gap: 11px; }
        .student-avatar { width: 38px; height: 38px; flex: 0 0 38px; border-radius: 50%; object-fit: cover; border: 2px solid #e6f1eb; }
        .avatar-fallback { display: grid; place-items: center; background: #e5f2eb; color: #4a7963; }
        .student-cell strong { display: block; color: #18332c; font-size: .84rem; }
        .student-cell span { display: block; margin-top: 2px; color: #6b7b75; font-size: .72rem; }
        
        .class-badge { display: inline-flex; align-items: center; padding: 5px 9px; border-radius: 7px; background: #f1f5f3; color: #466358; font-size: .72rem; font-weight: 600; white-space: nowrap; }
        .badge-hari { background: #eef2ff; color: #4338ca; text-transform: capitalize; }
        
        .action-btn-ds { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; font-size: .85rem; text-decoration: none; transition: .16s ease; margin: 0 2px; }
        .action-btn-ds.edit { background: #e9f2ff; color: #3875c5; }
        .action-btn-ds.edit:hover { background: #3875c5; color: #fff; }
        .action-btn-ds.delete { background: #f8e9e9; color: #b34d4d; }
        .action-btn-ds.delete:hover { background: #b34d4d; color: #fff; }
        
        .empty-row td { padding: 42px 18px; color: #6b7b75; text-align: center; }
        .empty-row i { margin-right: 7px; color: #90a69b; }
    </style>
</head>
<body>
    @php
        $totalJadwal = count($data_jadwal);
    @endphp

    <div class="dashboard-container admin-class-page">
        <x-sidebar_siakad />
        
        <main class="main-content">
            <x-siakad.topbar 
                title="Kelola Jadwal Pelajaran" 
                description="Atur penempatan jadwal mengajar guru dan kelas." 
                position="Admin SIAKAD" 
                initials="AD" 
            />

            <div class="class-content">
                <section class="class-heading" aria-labelledby="page-title">
                    <div>
                        <span class="section-eyebrow"><i class="fa-solid fa-calendar-days"></i> Manajemen Akademik</span>
                        <h1 id="page-title">Kelola Jadwal Pelajaran</h1>
                        <p>Atur penempatan guru, jam mengajar, dan mata pelajaran dalam satu kelas.</p>
                    </div>
                </section>

                <section class="class-form-card" style="margin-bottom: 25px;">
                    <div class="form-card-heading">
                        <span class="heading-icon"><i class="fa-solid fa-calendar-plus"></i></span>
                        <div>
                            <h2>Tambah Jadwal Baru</h2>
                            <p>Isikan formulir ini untuk menugaskan jadwal ke sistem.</p>
                        </div>
                    </div>

                    <form action="/sk/simpan-jadwal" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="form-grid-3">
                                <div class="form-field">
                                    <label><i class="fa-solid fa-calendar-days"></i> Tahun Ajaran</label>
                                    <div class="input-wrap">
                                        <i class="fa-solid fa-calendar"></i>
                                        <select name="tahun_ajaran_id" required>
                                            <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                            @foreach($data_tahun as $t)
                                                <option value="{{ $t->id }}">{{ $t->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-field">
                                    <label><i class="fa-solid fa-door-open"></i> Kelas</label>
                                    <div class="input-wrap">
                                        <i class="fa-solid fa-layer-group"></i>
                                        <select name="kelas_id" required>
                                            <option value="" disabled selected>Pilih Kelas</option>
                                            @foreach($data_kelas as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label><i class="fa-solid fa-chalkboard-user"></i> Guru Pengajar</label>
                                    <div class="input-wrap">
                                        <i class="fa-solid fa-user-tie"></i>
                                        <select name="guru_id" required>
                                            <option value="" disabled selected>Pilih Guru</option>
                                            @foreach($data_guru as $g)
                                                <option value="{{ $g->id }}">{{ $g->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label><i class="fa-solid fa-book"></i> Mata Pelajaran</label>
                                    <div class="input-wrap">
                                        <i class="fa-solid fa-bookmark"></i>
                                        <select name="mapel_id" required>
                                            <option value="" disabled selected>Pilih Mapel</option>
                                            @foreach($data_mapel as $m)
                                                <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label><i class="fa-solid fa-sun"></i> Hari</label>
                                    <div class="input-wrap">
                                        <i class="fa-regular fa-calendar-check"></i>
                                        <select name="hari" required>
                                            <option value="" disabled selected>Pilih Hari</option>
                                            <option value="senin">Senin</option>
                                            <option value="selasa">Selasa</option>
                                            <option value="rabu">Rabu</option>
                                            <option value="kamis">Kamis</option>
                                            <option value="jumat">Jumat</option>
                                            <option value="sabtu">Sabtu</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label><i class="fa-regular fa-clock"></i> Jam Pelajaran</label>
                                    <div class="input-wrap">
                                        <i class="fa-solid fa-clock"></i>
                                        <select name="jam_pelajaran_id" required>
                                            <option value="" disabled selected>Pilih Jam</option>
                                            @foreach($data_jam as $jam)
                                                <option value="{{ $jam->id }}">{{ $jam->nama_jam }} ({{ $jam->jam_mulai }} - {{ $jam->jam_selesai }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="button button-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan Jadwal</button>
                        </div>
                    </form>
                </section>

                <!-- TABEL ALA DATA SISWA -->
                <section class="students-card" aria-labelledby="table-title">
                    <div class="card-header">
                        <div>
                            <h2 id="table-title">Daftar Jadwal Terdaftar</h2>
                            <p>Daftar seluruh jadwal pelajaran yang telah masuk ke dalam sistem.</p>
                        </div>
                        <span class="result-counter">{{ $totalJadwal }} jadwal</span>
                    </div>

                    <div class="table-wrapper">
                        <table class="ds-table">
                            <thead>
                                <tr>
                                    <th class="number-column">No.</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru Pengajar</th>
                                    <th class="action-column">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data_jadwal as $index => $j)
                                <tr>
                                    <td class="number-column">{{ $index + 1 }}</td>
                                    <td>
                                        <span class="class-badge badge-hari">
                                            <i class="fa-regular fa-calendar" style="margin-right: 4px;"></i> {{ $j->hari }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="student-cell">
                                            <div>
                                                <strong>{{ $j->jam_pelajaran->nama_jam ?? '-' }}</strong>
                                                <span>{{ $j->jam_pelajaran->jam_mulai ?? '-' }} - {{ $j->jam_pelajaran->jam_selesai ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="class-badge"><i class="fa-solid fa-layer-group" style="margin-right: 4px;"></i> {{ $j->kelas->nama_kelas ?? '-' }}</span></td>
                                    <td><strong>{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</strong></td>
                                    <td>
                                        <div class="student-cell">
                                            @if(!empty($j->guru->url_foto))
                                                <img src="{{ url('/file/' . $j->guru->url_foto) }}" class="student-avatar" alt="Foto {{ $j->guru->nama ?? '' }}" style="object-fit: cover;">
                                            @else
                                                <span class="student-avatar avatar-fallback"><i class="fa-solid fa-user-tie"></i></span>
                                            @endif
                                            <div>
                                                <strong>{{ $j->guru->nama ?? '-' }}</strong>
                                                <span>T.A: {{ $j->tahun_ajaran->nama ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="action-column"><div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 5px; white-space: nowrap;"><a href="/sk/edit-jadwal/{{ $j->id }}" class="action-btn-ds edit" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a><a href="/sk/hapus-jadwal/{{ $j->id }}" class="action-btn-ds delete" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini? Tindakan ini tidak dapat dibatalkan.');">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a></div></td>
                                </tr>
                                @empty
                                <tr class="empty-row">
                                    <td colspan="7">
                                        <i class="fa-solid fa-calendar-xmark" style="font-size: 2rem; display:block; margin: 0 auto 10px; color:#c6d6ce;"></i>
                                        Belum ada data jadwal pelajaran.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <x-warning />
</body>
</html>
