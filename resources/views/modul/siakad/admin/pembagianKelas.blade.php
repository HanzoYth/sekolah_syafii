<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembagian Kelas - SIAKAD Islamic Smart School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pembagianKelas.css') }}?v={{ time() }}">
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}">
</head>
<body>

<div class="app-shell">
    <x-sidebar_siakad />

    <main class="main-content">
        <div class="pembagian-content">
            <header class="page-header">
                <div>
                    <span class="page-eyebrow"><i class="fa-solid fa-users-viewfinder"></i> Rombongan Belajar</span>
                    <h1 class="page-title">Pembagian Ruang Kelas</h1>
                    <p class="page-desc">Kelola dan tempatkan siswa ke dalam ruang kelas (Rombel) yang sesuai.</p>
                </div>
            </header>

            @if(session('success'))
            <div class="alert-toast">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="alert-toast error">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
            @endif

            <!-- FILTER KELAS -->
            <div class="filter-card">
                <form action="/sk/pembagian-kelas" method="GET" style="display: flex; width: 100%; gap: 16px; align-items: flex-end;">
                    <div class="form-group" style="flex: 1;">
                        <label for="kelas_id">Pilih Ruang Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="custom-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($data_kelas as $k)
                                <option value="{{ $k->id }}" {{ $kelas_id == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_ruang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i> Tampilkan
                    </button>
                </form>
            </div>

            @if($kelas_id && $kelas_terpilih)
            <div class="split-layout">
                <!-- PANEL KIRI: SISWA BELUM ADA KELAS -->
                <div class="panel-card">
                    <div class="panel-header">
                        <h3>Siswa Belum Masuk Kelas</h3>
                        <span class="badge-count">{{ $siswa_belum_ada_kelas->count() }}</span>
                    </div>
                    
                    <form action="/sk/simpan-pembagian-kelas" method="POST" id="formTambah">
                        @csrf
                        <input type="hidden" name="kelas_id" value="{{ $kelas_terpilih->id }}">
                        <div class="panel-body">
                            @if($siswa_belum_ada_kelas->count() > 0)
                                <ul class="student-list">
                                    @foreach($siswa_belum_ada_kelas as $s)
                                    <li class="student-item">
                                        <div class="student-info">
                                            <input type="checkbox" name="siswa_ids[]" value="{{ $s->id }}" id="s_{{ $s->id }}" class="student-checkbox">
                                            <label for="s_{{ $s->id }}" class="student-info" style="cursor: pointer; margin:0;">
                                                <div class="student-avatar">{{ substr($s->nama, 0, 1) }}</div>
                                                <div>
                                                    <p class="student-name">{{ $s->nama }}</p>
                                                    <p class="student-nis">NIS: {{ $s->nis ?? '-' }}</p>
                                                </div>
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="empty-state">
                                    <i class="fa-solid fa-check-double"></i>
                                    <p>Semua siswa sudah masuk ke kelas.</p>
                                </div>
                            @endif
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;" {{ $siswa_belum_ada_kelas->count() == 0 ? 'disabled' : '' }}>
                                <i class="fa-solid fa-arrow-right-to-bracket"></i> Masukkan ke Kelas Terpilih
                            </button>
                        </div>
                    </form>
                </div>

                <!-- PANEL KANAN: SISWA DALAM KELAS INI -->
                <div class="panel-card">
                    <div class="panel-header" style="background: #f0f9ff; border-bottom-color: #bae6fd;">
                        <h3 style="color: #0369a1;">Siswa {{ $kelas_terpilih->nama_ruang }}</h3>
                        <span class="badge-count" style="background: #e0f2fe; color: #0284c7;">{{ $siswa_kelas_ini->count() }}</span>
                    </div>
                    <div class="panel-body">
                        @if($siswa_kelas_ini->count() > 0)
                            <ul class="student-list">
                                @foreach($siswa_kelas_ini as $s)
                                <li class="student-item">
                                    <div class="student-info">
                                        <div class="student-avatar" style="background: #dbeafe; color: #1e3a8a;">{{ substr($s->nama, 0, 1) }}</div>
                                        <div>
                                            <p class="student-name">{{ $s->nama }}</p>
                                            <p class="student-nis">NIS: {{ $s->nis ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <a href="/sk/hapus-anggota-kelas/{{ $s->id }}" class="btn-remove" title="Keluarkan dari kelas ini" onclick="return confirm('Keluarkan {{ $s->nama }} dari kelas ini?')">
                                        <i class="fa-solid fa-user-minus"></i>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="empty-state">
                                <i class="fa-solid fa-box-open"></i>
                                <p>Belum ada siswa di kelas ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="panel-card" style="min-height: 300px; justify-content: center; align-items: center;">
                <div class="empty-state">
                    <i class="fa-solid fa-arrow-pointer"></i>
                    <p>Silakan pilih ruang kelas terlebih dahulu pada filter di atas.</p>
                </div>
            </div>
            @endif

        </div>
    </main>
</div>

</body>
</html>

