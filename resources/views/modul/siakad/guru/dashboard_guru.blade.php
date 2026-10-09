<x-siakad-layout>
    <x-slot name="title">Dashboard Guru</x-slot>
    <x-slot name="subtitle">Selamat datang kembali, {{ $guru->nama ?? 'Guru' }}.</x-slot>
    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <span class="text-slate-700">Dashboard</span>
        </li>
    </x-slot>

    <!-- Top Stats -->
    <div class="overview-section">
        <div class="overview-stat-grid">
            <div class="overview-stat-card">
                <div class="stat-icon emerald">
                    <i class="fa-solid fa-chalkboard text-xl"></i>
                </div>
                <div>
                    <span class="text-sm font-medium">Kelas Diampu</span>
                    <strong>{{ $kelas_diampu->count() }}</strong>
                    <small>Kelas aktif</small>
                </div>
            </div>

            <div class="overview-stat-card">
                <div class="stat-icon gold">
                    <i class="fa-solid fa-clock text-xl"></i>
                </div>
                <div>
                    <span class="text-sm font-medium">Jadwal Hari Ini</span>
                    <strong>{{ $jadwal_hari_ini->count() }}</strong>
                    <small>Sesi mengajar ({{ $nama_hari }})</small>
                </div>
            </div>

            <div class="overview-stat-card">
                <div class="stat-icon blue">
                    <i class="fa-solid fa-user-tie text-xl"></i>
                </div>
                <div>
                    <span class="text-sm font-medium">Status Wali Kelas</span>
                    <strong style="font-size: 18px;">
                        @if($wallas)
                            {{ $wallas->ruangKelas->nama_ruang ?? 'Aktif' }}
                        @else
                            -
                        @endif
                    </strong>
                    <small>Wali Kelas</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="overview-main-grid">
        
        <!-- Jadwal Mengajar Hari Ini -->
        <div class="dashboard-panel">
            <div class="panel-heading">
                <h2>Jadwal Hari Ini ({{ $nama_hari }})</h2>
                <span class="updated-label">Agenda mengajar Anda</span>
            </div>
            
            <ul class="overview-list">
                @if($jadwal_hari_ini->count() > 0)
                    @foreach($jadwal_hari_ini as $jadwal)
                    <li>
                        <div class="calendar-date">
                            <strong>{{ \Carbon\Carbon::parse($jadwal->jam_pelajaran->jam_mulai)->format('H') }}</strong>
                            <span>{{ \Carbon\Carbon::parse($jadwal->jam_pelajaran->jam_mulai)->format('i') }}</span>
                        </div>
                        <div>
                            <strong>{{ $jadwal->mata_pelajaran->nama_pelajaran ?? '-' }}</strong>
                            <p>Kelas {{ $jadwal->kelas->nama_kelas ?? '-' }} - {{ \Carbon\Carbon::parse($jadwal->jam_pelajaran->jam_selesai)->format('H:i') }}</p>
                        </div>
                    </li>
                    @endforeach
                @else
                    <li style="text-align: center; display: block; padding: 30px 0;">
                        <i class="fa-solid fa-mug-hot" style="font-size: 30px; color: #cbd5e1; margin-bottom: 10px;"></i>
                        <p>Tidak ada jadwal mengajar hari ini.</p>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Kelas yang Diampu -->
        <div class="dashboard-panel">
            <div class="panel-heading">
                <h2>Kelas yang Diampu</h2>
                <span class="updated-label">Daftar kelas</span>
            </div>
            
            <ul class="overview-list">
                @if($kelas_diampu->count() > 0)
                    @foreach($kelas_diampu as $kelas)
                    <li>
                        <div class="list-icon slate">
                            <i class="fa-solid fa-chalkboard-user"></i>
                        </div>
                        <div>
                            <strong>Kelas {{ $kelas->nama_kelas }}</strong>
                            <p>
                                @if($wallas && $wallas->kelas_id == $kelas->id)
                                    Wali Kelas & Guru Mapel
                                @else
                                    Guru Mapel
                                @endif
                            </p>
                        </div>
                    </li>
                    @endforeach
                @else
                    <li style="text-align: center; display: block; padding: 20px 0;">
                        <p>Belum ada kelas yang diampu.</p>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</x-siakad-layout>
