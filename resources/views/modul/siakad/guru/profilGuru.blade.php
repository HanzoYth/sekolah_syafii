<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru - SIAKAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/teacher/dashboard.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/teacher/profile.css') }}?v={{ time() }}">
</head>
<body>
    <div class="dashboard-container">
        <x-siakad.sidebar />

        <main class="main-content teacher-profile-page">
            <x-siakad.topbar
                :name="session('nama', 'Ustadzah Fitri')"
                position="Guru Mata Pelajaran"
                initials="UF"
                title="Profil Guru"
                description="Informasi akun dan peran Anda pada SIAKAD."
            />

            <section class="profile-card">
                <div class="profile-card-header">
                    <span class="profile-avatar">UF</span>
                    <div>
                        <p class="profile-kicker">AKUN GURU</p>
                        <h1>{{ session('nama', 'Ustadzah Fitri') }}</h1>
                        <p>Guru Mata Pelajaran</p>
                    </div>
                </div>

                <div class="profile-details">
                    <div><span><i class="fa-solid fa-user"></i> Nama</span><strong>{{ session('nama', 'Ustadzah Fitri') }}</strong></div>
                    <div><span><i class="fa-solid fa-briefcase"></i> Jabatan</span><strong>Guru Mata Pelajaran</strong></div>
                    <div><span><i class="fa-solid fa-shield-halved"></i> Akses</span><strong>Guru SIAKAD</strong></div>
                    <div><span><i class="fa-solid fa-envelope"></i> Email</span><strong>{{ session('email', 'Belum tersedia') }}</strong></div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
