@props([
    'name' => 'Ustadzah Fitri',
    'position' => 'Guru Mata Pelajaran',
    'initials' => 'UF',
    'title' => 'Dashboard Guru',
    'description' => 'Ringkasan kegiatan belajar dan kelas Anda hari ini.',
])

<header class="teacher-topbar">
    <div class="teacher-topbar-pattern" aria-hidden="true"></div>

    <div class="teacher-topbar-content">
        <div class="teacher-topbar-title">
            <p class="teacher-arabic">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
            <div>
                <p class="teacher-topbar-kicker">SISTEM INFORMASI AKADEMIK</p>
                <h1>{{ $title }}</h1>
                <p>{{ $description }}</p>
            </div>
        </div>

        <div class="teacher-topbar-actions">
            <div class="teacher-date" aria-label="Tanggal hari ini">
                <i class="fa-regular fa-calendar-days"></i>
                <span>Selasa, 04 Agustus 2026</span>
            </div>

            <button class="teacher-notification" type="button" aria-label="Notifikasi">
                <i class="fa-regular fa-bell"></i>
                <span></span>
            </button>

            <div class="teacher-profile" aria-label="Profil {{ $name }}">
                <span class="teacher-profile-avatar">{{ $initials }}</span>
                <span class="teacher-profile-detail">
                    <strong>{{ $name }}</strong>
                    <small>{{ $position }}</small>
                </span>
                <i class="fa-solid fa-chevron-down teacher-profile-chevron" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</header>
