<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Modul Layanan — Sekolah Islam Al-Qur'an Imam Syafi'i</title>

    <!-- Google Fonts: Poppins & Amiri -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/module.css') }}?v={{ time() }}">
</head>
<body>

    @php
        $roleCode = session('role');
        $userGuru = ($roleCode === 'g') ? (App\Models\guru::find(session('id')) ?? (session('id_akun') ? App\Models\guru::where('user_id', session('id_akun'))->first() : null)) : null;
        $roleLabel = match ($roleCode) {
            'a' => 'Administrator',
            'g' => 'Guru & Staf',
            's' => 'Santri / Siswa',
            'b' => 'Bendahara',
            'o' => 'Operator',
            'p' => 'Keamanan',
            'y' => 'Ketua Yayasan',
            default => 'Pengguna Portal',
        };
        if ($userGuru) {
            if ($userGuru->kepala_sekolah == 1) {
                $roleLabel = 'Kepala Sekolah';
            } elseif ($userGuru->wakil_sekolah == 1) {
                $roleLabel = 'Wakil Kepala Sekolah';
            } elseif ($userGuru->bendahara == 1) {
                $roleLabel = 'Bendahara';
            }
        }
    @endphp

    <!-- Latar Parallax & Ornamen Islami -->
    <div class="mod-bg-layer" style="background-image: url('{{ asset('img/bg_skl.jpeg') }}?v={{ time() }}');" data-mouse-speed="-14"></div>
    <div class="mod-pattern-overlay" data-mouse-speed="18"></div>
    <div class="mod-glow-orb"></div>

    <!-- Container Utama -->
    <div class="module-container">

        <!-- Baris Atas: Brand Sekolah & Info Akun Login -->
        <div class="module-topbar">
            <a href="/" class="module-brand">
                <img src="{{ asset('img/logo.png') }}?v={{ time() }}" alt="Logo Sekolah">
                <div class="module-brand-text">
                    <strong>Sekolah Qur'an Imam Syafi'i</strong>
                    <small>Portal Sistem Informasi Terpadu</small>
                </div>
            </a>

            <div class="user-greeting-pill">
                <span class="user-avatar-icon"><i class="fa-solid fa-user-check"></i></span>
                <span>Halo, <strong>{{ session('nama') ?? 'Pengguna' }}</strong></span>
                <span class="user-role-badge">{{ $roleLabel }}</span>
            </div>
        </div>

        <!-- Header Dalam Container -->
        <div class="module-header">
            <p class="basmalah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
            <h2>Pilih Portal Layanan</h2>
            <p class="subtitle">Silakan pilih modul sistem informasi yang ingin Anda akses sesuai hak akses akun Anda</p>
        </div>

        <!-- Grid Kartu Modul -->
        <div class="module-grid">
            {{-- 1. MODUL SIAKAD --}}
            @if ($roleCode == 'a' || $roleCode == 'g' || $roleCode == 's' || $roleCode == 'b')
                @if ($roleCode == 'a')
                    <a href="/sk/das" class="module-card siakad tilt-card">
                        <div>
                            <div class="card-top-row">
                                <div class="icon-wrapper">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <span class="module-tag">Akademik</span>
                            </div>
                            <h3>Modul SIAKAD</h3>
                            <p>Sistem Informasi Akademik untuk pengelolaan kelas, jadwal pelajaran, presensi, penilaian, dan rapor santri.</p>
                        </div>
                        <div class="card-action">
                            <span>Buka SIAKAD</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </a>
                @elseif ($roleCode == 'g')
                    @php
                        $isKepsek = $userGuru && ($userGuru->kepala_sekolah == 1 || $userGuru->wakil_sekolah == 1);
                        $isBendahara = $userGuru && ($userGuru->bendahara == 1);
                        $siakadUrl = ($isKepsek || $isBendahara) ? '/sk/das' : '/sk/dsg';
                    @endphp
                    @if ($userGuru && (!$userGuru->satpam && !$userGuru->operator || $isBendahara || $isKepsek))
                        <a href="{{ $siakadUrl }}" class="module-card siakad tilt-card">
                            <div>
                                <div class="card-top-row">
                                    <div class="icon-wrapper">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </div>
                                    @if($isKepsek)
                                        <span class="module-tag">{{ $userGuru->kepala_sekolah == 1 ? 'Kepala Sekolah' : 'Wakil Kepala' }}</span>
                                    @elseif($isBendahara)
                                        <span class="module-tag">Keuangan & Kas</span>
                                    @else
                                        <span class="module-tag">Akademik</span>
                                    @endif
                                </div>
                                <h3>Modul SIAKAD</h3>
                                @if($isKepsek)
                                    <p>Sistem Informasi Akademik untuk pengawasan kurikulum, jadwal pelajaran, rombel kelas, dan rapor santri.</p>
                                @elseif($isBendahara)
                                    <p>Sistem Informasi Administrasi Keuangan untuk pengelolaan tagihan IPP, uang pangkal, pembayaran, dan slip keuangan.</p>
                                @else
                                    <p>Sistem Informasi Akademik untuk pengelolaan jadwal mengajar, presensi mapel, input nilai, dan wali kelas.</p>
                                @endif
                            </div>
                            <div class="card-action">
                                <span>Buka SIAKAD</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                        </a>
                    @endif
                @else
                    <a href="/sk/dbs" class="module-card siakad tilt-card">
                        <div>
                            <div class="card-top-row">
                                <div class="icon-wrapper">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <span class="module-tag">Akademik</span>
                            </div>
                            <h3>Modul SIAKAD</h3>
                            <p>Sistem Informasi Akademik untuk memantau jadwal pelajaran, rekap kehadiran, pengumuman, dan nilai rapor.</p>
                        </div>
                        <div class="card-action">
                            <span>Buka SIAKAD</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </a>
                @endif
            @endif

            {{-- 2. MODUL TAHFIDZ --}}
            @if ($roleCode == 'a' || $roleCode == 'g' || $roleCode == 's')
                @if ($roleCode == 'g')
                    @if ($userGuru && !$userGuru->bendahara && !$userGuru->satpam && !$userGuru->operator)
                        <a href="/tf/gr/dash" class="module-card tahfidz tilt-card">
                            <div>
                                <div class="card-top-row">
                                    <div class="icon-wrapper">
                                        <i class="fa-solid fa-book-quran"></i>
                                    </div>
                                    <span class="module-tag">Al-Qur'an</span>
                                </div>
                                <h3>Modul Tahfidz</h3>
                                <p>Sistem monitoring halaqah Al-Qur'an, setoran mutaba'ah harian, ziyadah, muraja'ah, dan capaian juz santri.</p>
                            </div>
                            <div class="card-action">
                                <span>Buka Tahfidz</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                        </a>
                    @endif
                @elseif ($roleCode == 's')
                    <a href="/tf/sw/dass" class="module-card tahfidz tilt-card">
                        <div>
                            <div class="card-top-row">
                                <div class="icon-wrapper">
                                    <i class="fa-solid fa-book-quran"></i>
                                </div>
                                <span class="module-tag">Al-Qur'an</span>
                            </div>
                            <h3>Modul Tahfidz</h3>
                            <p>Sistem monitoring hafalan Al-Qur'an, riwayat setoran mutaba'ah harian, dan progres capaian juz santri.</p>
                        </div>
                        <div class="card-action">
                            <span>Buka Tahfidz</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </a>
                @else
                    <a href="/tf/das" class="module-card tahfidz tilt-card">
                        <div>
                            <div class="card-top-row">
                                <div class="icon-wrapper">
                                    <i class="fa-solid fa-book-quran"></i>
                                </div>
                                <span class="module-tag">Al-Qur'an</span>
                            </div>
                            <h3>Modul Tahfidz</h3>
                            <p>Sistem manajemen halaqah Al-Qur'an, monitoring setoran mutaba'ah harian, dan rekapitulasi juz santri.</p>
                        </div>
                        <div class="card-action">
                            <span>Buka Tahfidz</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </a>
                @endif
            @endif

            {{-- 3. MODUL GURU / STAF --}}
            @if ($roleCode == 'a' || $roleCode == 'g')
                <a href="{{ $roleCode == 'a' ? '/gr/dasa' : '/gr/das' }}" class="module-card guru tilt-card">
                    <div>
                        <div class="card-top-row">
                            <div class="icon-wrapper">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                            <span class="module-tag">Kepegawaian</span>
                        </div>
                        <h3>Modul Guru & Staf</h3>
                        <p>Sistem presensi kehadiran guru/staf, pengajuan izin, kelola cabang, serta informasi administrasi kepegawaian.</p>
                    </div>
                    <div class="card-action">
                        <span>Buka Guru & Staf</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            @endif

            {{-- 4. MODUL KETUA YAYASAN --}}
            @if ($roleCode == 'y')
                <a href="{{ $roleCode == 'a' ? '/gr/dasa' : '/gr/das' }}" class="module-card guru tilt-card">
                    <div>
                        <div class="card-top-row">
                            <div class="icon-wrapper">
                                <i class="fa-solid fa-building-columns"></i>
                            </div>
                            <span class="module-tag">Eksekutif</span>
                        </div>
                        <h3>Modul Ketua Yayasan</h3>
                        <p>Portal pemantauan kehadiran, laporan kepegawaian, serta pengawasan operasional Yayasan Pendidikan.</p>
                    </div>
                    <div class="card-action">
                        <span>Buka Modul Yayasan</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            @endif
        </div>

        <!-- Footer Dalam Container -->
        <div class="module-footer">
            <a href="/" class="btn-home-link">
                <i class="fa-solid fa-house"></i> Ke Beranda Website
            </a>
            <a href="/reg/logout" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar Akun
            </a>
        </div>

    </div>

    <script>
        // Efek Parallax Halus pada Latar & 3D Tilt pada Kartu Modul
        (function () {
            if (!window.matchMedia || !window.matchMedia('(hover: hover)').matches) return;

            var layers = [].slice.call(document.querySelectorAll('[data-mouse-speed]'));
            var tx = 0, ty = 0, cx = 0, cy = 0;

            document.addEventListener('mousemove', function (e) {
                tx = (e.clientX / window.innerWidth) - 0.5;
                ty = (e.clientY / window.innerHeight) - 0.5;
            });

            function tick() {
                cx += (tx - cx) * 0.08;
                cy += (ty - cy) * 0.08;
                layers.forEach(function (el) {
                    var spd = parseFloat(el.getAttribute('data-mouse-speed')) || 12;
                    el.style.transform = 'translate3d(' + (cx * spd).toFixed(1) + 'px, ' + (cy * spd).toFixed(1) + 'px, 0)';
                });
                requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);

            // 3D Tilt pada Kartu Modul
            var cards = document.querySelectorAll('.tilt-card');
            cards.forEach(function (card) {
                card.addEventListener('mousemove', function (e) {
                    var r = card.getBoundingClientRect();
                    var x = (e.clientX - r.left) / r.width - 0.5;
                    var y = (e.clientY - r.top) / r.height - 0.5;
                    card.style.transform = 'perspective(700px) rotateY(' + (x * 8).toFixed(1) + 'deg) rotateX(' + (-y * 8).toFixed(1) + 'deg) translateY(-7px)';
                });
                card.addEventListener('mouseleave', function () {
                    card.style.transform = '';
                });
            });
        })();
    </script>
</body>
</html>
