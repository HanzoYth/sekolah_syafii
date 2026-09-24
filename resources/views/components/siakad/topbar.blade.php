@props([
    'name' => null,
    'position' => 'Pengguna SIAKAD',
    'initials' => 'SK',
    'title' => 'SIAKAD',
    'description' => 'Kelola informasi akademik sekolah dalam satu tempat.',
])

<link rel="stylesheet" href="{{ asset('css/modul/siakad/shared/components.css') }}?v={{ time() }}">

<header class="siakad-topbar">
    <div class="siakad-topbar-pattern" aria-hidden="true"></div>
    <div class="siakad-topbar-content">
        <div class="siakad-topbar-title">
            <p class="siakad-arabic">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
            <div>
                <p class="siakad-topbar-kicker">SISTEM INFORMASI AKADEMIK</p>
                <h1>{{ $title }}</h1>
                <p>{{ $description }}</p>
            </div>
        </div>

        <div class="siakad-topbar-actions">
            <div class="siakad-date" aria-label="Tanggal hari ini"><i class="fa-regular fa-calendar-days"></i><span>{{ now()->translatedFormat('l, d F Y') }}</span></div>
            <button class="siakad-notification" type="button" aria-label="Notifikasi"><i class="fa-regular fa-bell"></i><span></span></button>
            <div class="siakad-profile" aria-label="Profil {{ $name ?? session('nama', 'Pengguna SIAKAD') }}">
                <span class="siakad-profile-avatar">{{ $initials }}</span>
                <span class="siakad-profile-detail"><strong>{{ $name ?? session('nama', 'Pengguna SIAKAD') }}</strong><small>{{ $position }}</small></span>
                <i class="fa-solid fa-chevron-down siakad-profile-chevron" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</header>
