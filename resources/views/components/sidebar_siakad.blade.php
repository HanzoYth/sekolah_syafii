<link rel="stylesheet" href="{{ asset('css/sidebar/sidebar_siakad.css') }}">

<aside class="sidebar">
    <div class="brand">
        <div class="brand-logo">🕌</div>
        <div class="brand-text">
            <h2>SIAKAD Islam</h2>
            <small>Sistem Informasi Akademik</small>
        </div>
    </div>

    <nav class="sidebar-menu">
        <ul>
            <li class="active">
                <a href="/sk/das"><span class="icon">📊</span> Dashboard</a>
            </li>

            {{-- Role Admin --}}
            @if (session("role") === 'a')
                <li class="menu-header">ADMINISTRATOR</li>
                <li><a href='/sk/ds'><span class="icon">👨‍🎓</span> Data Siswa</a></li>
                <li><a href='/sk/dw'><span class="icon">👨‍🏫</span> Data Wali Kelas</a></li>
                <li><a href="#"><span class="icon">🏫</span> Data Kelas</a></li>
                <li><a href="#"><span class="icon">⚙️</span> Pengaturan</a></li>
            @endif

            {{-- Role Guru --}}
            @if (session("role") === 'g')
                <li class="menu-header">MENU GURU</li>
                <li><a href="#"><span class="icon">👥</span> Siswa Ajar</a></li>
                <li><a href="#"><span class="icon">📅</span> Jadwal Mengajar</a></li>
                <li><a href="#"><span class="icon">📝</span> Input Nilai</a></li>
            @endif

            {{-- Role Siswa --}}
            @if (session("role") === 's')
                <li class="menu-header">MENU SISWA</li>
                <li><a href="#"><span class="icon">✅</span> Presensi Kehadiran</a></li>
                <li><a href="#"><span class="icon">📜</span> Nilai Akademik</a></li>
                <li><a href="#"><span class="icon">📢</span> Pengumuman</a></li>
            @endif
        </ul>
    </nav>

    <div class="sidebar-footer">
        <a href='/sk/das' class="btn-logout"><span class="icon">🚪</span> Keluar</a>
    </div>
</aside>