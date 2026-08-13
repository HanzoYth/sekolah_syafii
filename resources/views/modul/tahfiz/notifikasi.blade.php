<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - Tahfiz Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/notifikasi.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <x-sidebar_tahfiz />

        <main class="main-content">

            <!-- 1. PAGE HEADER -->
            <div class="page-header">
                <div class="page-header-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Notifikasi</span></p>
                    <h1>Notifikasi <span class="unread-count" id="unreadCount">5 belum dibaca</span></h1>
                </div>
                <div class="page-header-right">
                    <button class="btn-outline" id="btnMarkAllRead"><i class="fa-solid fa-check-double"></i> Tandai Semua Dibaca</button>
                </div>
            </div>

            <!-- 2. LIST NOTIFIKASI (dikelompokkan per tanggal) -->
            <div class="notif-list-card" id="notifListCard">

                <!-- HARI INI -->
                <p class="notif-date-label">Hari Ini</p>

                <a href="#" class="notif-item unread" data-notif-id="1">
                    <div class="notif-icon urgent"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div class="notif-content">
                        <p class="notif-title">Halaqah belum input laporan</p>
                        <p class="notif-desc">Kelas 2B - Halaqah 1 (Ustadz Fajar) belum menginput laporan hafalan hari ini.</p>
                        <span class="notif-time">2 jam lalu</span>
                    </div>
                    <span class="notif-dot"></span>
                </a>

                <a href="#" class="notif-item unread" data-notif-id="2">
                    <div class="notif-icon urgent"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div class="notif-content">
                        <p class="notif-title">Halaqah belum ada pengampu</p>
                        <p class="notif-desc">Kelas 2B - Halaqah 3 masih belum memiliki pengampu yang ditugaskan.</p>
                        <span class="notif-time">3 jam lalu</span>
                    </div>
                    <span class="notif-dot"></span>
                </a>

                <a href="#" class="notif-item unread" data-notif-id="3">
                    <div class="notif-icon positive"><i class="fa-solid fa-star"></i></div>
                    <div class="notif-content">
                        <p class="notif-title">Siswa naik juz</p>
                        <p class="notif-desc">Dafa (Kelas 1A - Halaqah 1) berhasil naik dari Juz 26 ke Juz 28 bulan ini.</p>
                        <span class="notif-time">5 jam lalu</span>
                    </div>
                    <span class="notif-dot"></span>
                </a>

                <a href="#" class="notif-item" data-notif-id="4">
                    <div class="notif-icon reminder"><i class="fa-solid fa-clock"></i></div>
                    <div class="notif-content">
                        <p class="notif-title">Pengingat input laporan</p>
                        <p class="notif-desc">Jangan lupa pantau kelengkapan laporan harian sebelum jam 21.00.</p>
                        <span class="notif-time">8 jam lalu</span>
                    </div>
                </a>

                <!-- KEMARIN -->
                <p class="notif-date-label">Kemarin</p>

                <a href="#" class="notif-item unread" data-notif-id="5">
                    <div class="notif-icon urgent"><i class="fa-solid fa-chart-line"></i></div>
                    <div class="notif-content">
                        <p class="notif-title">Konsistensi pengampu menurun</p>
                        <p class="notif-desc">Konsistensi input Ustadz Fajar turun menjadi 45% dalam 2 minggu terakhir.</p>
                        <span class="notif-time">1 hari lalu</span>
                    </div>
                    <span class="notif-dot"></span>
                </a>

                <a href="#" class="notif-item" data-notif-id="6">
                    <div class="notif-icon info"><i class="fa-solid fa-circle-info"></i></div>
                    <div class="notif-content">
                        <p class="notif-title">Pengumuman jadwal libur</p>
                        <p class="notif-desc">Kegiatan tahfiz diliburkan pada tanggal 27 Juni 2026 dalam rangka libur nasional.</p>
                        <span class="notif-time">1 hari lalu</span>
                    </div>
                </a>

                <!-- MINGGU INI -->
                <p class="notif-date-label">Minggu Ini</p>

                <a href="#" class="notif-item" data-notif-id="7">
                    <div class="notif-icon positive"><i class="fa-solid fa-trophy"></i></div>
                    <div class="notif-content">
                        <p class="notif-title">Halaqah paling konsisten</p>
                        <p class="notif-desc">Kelas 3A - Halaqah 1 menjadi halaqah paling konsisten minggu ini dengan capaian 98%.</p>
                        <span class="notif-time">4 hari lalu</span>
                    </div>
                </a>

                <a href="#" class="notif-item" data-notif-id="8">
                    <div class="notif-icon reminder"><i class="fa-solid fa-user-clock"></i></div>
                    <div class="notif-content">
                        <p class="notif-title">Pengampu berstatus cuti</p>
                        <p class="notif-desc">Ustadzah Rina sedang cuti. Pastikan halaqah-nya sudah dialihkan sementara.</p>
                        <span class="notif-time">5 hari lalu</span>
                    </div>
                </a>

                <!-- 7. EMPTY STATE (tampil kalau belum ada notifikasi sama sekali) -->
                {{--
                <div class="empty-state">
                    <i class="fa-solid fa-bell-slash"></i>
                    <h4>Belum ada notifikasi</h4>
                    <p>Semua pemberitahuan akan muncul di sini.</p>
                </div>
                --}}

            </div>

        </main>
    </div>

    <script>
        // Update angka "X belum dibaca" di header sesuai sisa item .unread saat ini.
        // Kalau sudah 0, badge-nya disembunyikan sekalian (bukan nampilin "0 belum dibaca").
        function updateUnreadBadge() {
            const sisa = document.querySelectorAll('.notif-item.unread').length;
            const badge = document.getElementById('unreadCount');
            if (sisa === 0) {
                badge.style.display = 'none';
            } else {
                badge.textContent = sisa + ' belum dibaca';
                badge.style.display = '';
            }
        }

        // Hapus status "belum dibaca" dari satu item (visual instan)
        function markAsRead(item) {
            if (!item.classList.contains('unread')) return;
            item.classList.remove('unread');
            const dot = item.querySelector('.notif-dot');
            if (dot) dot.remove();

            updateUnreadBadge();

            // TODO: simpan status "sudah dibaca" ke database supaya tidak balik lagi
            // saat halaman di-refresh. Contoh (sesuaikan endpoint & CSRF token Anda):
            //
            // fetch(`/notifikasi/${item.dataset.notifId}/baca`, {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            //     }
            // });
        }

        // Klik satu notifikasi -> langsung hilang status unread-nya
        document.querySelectorAll('.notif-item').forEach(item => {
            item.addEventListener('click', () => markAsRead(item));
        });

        // Tombol "Tandai Semua Dibaca" -> hilangkan semua status unread sekaligus
        document.getElementById('btnMarkAllRead').addEventListener('click', () => {
            document.querySelectorAll('.notif-item.unread').forEach(item => markAsRead(item));

            // TODO: panggil endpoint "tandai semua dibaca" di backend, contoh:
            // fetch('/notifikasi/tandai-semua-dibaca', { method: 'POST', headers: {...} });
        });
    </script>

</body>
</html>