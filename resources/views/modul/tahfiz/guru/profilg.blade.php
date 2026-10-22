<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru Tahfiz - Digital Tahfiz</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama & CSS Khusus Profil Guru -->
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/dashboard.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/profilg.css') }}?v={{ time() }}">
    
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- SIDEBAR GURU -->
        <x-sidebar_tahfiz />

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <div>
                    <h2>Profil & Akun Pengajar Tahfiz</h2>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell" title="Notifikasi"></i>
                    <i class="fa-regular fa-user" title="Profil Guru"></i>
                </div>
            </header>

            <!-- KARTU HEADER UTAMA PROFIL GURU -->
            <div class="teacher-profile-header-card">
                <div class="teacher-avatar-container">
                    <div class="teacher-avatar-large">UA</div>
                    <span class="badge-status-online"><i class="fa-solid fa-circle"></i> Pengajar Aktif</span>
                </div>
                <div class="teacher-main-info">
                    <div class="teacher-name-row">
                        <h3>Ustadz Ahmad Fauzi, S.Pd.I.</h3>
                        <span class="badge-gold"><i class="fa-solid fa-award"></i> Musyrif Tahfiz Utama</span>
                    </div>
                    <p class="teacher-nip"><i class="fa-solid fa-id-badge"></i> NIP / NIPY: 19880412 201503 1 002</p>

                    <div class="teacher-meta-grid">
                        <div class="teacher-meta-item">
                            <i class="fa-solid fa-users-rectangle"></i>
                            <div>
                                <small>Halaqah Binaan</small>
                                <strong>Halaqah 1 (Ula)</strong>
                            </div>
                        </div>
                        <div class="teacher-meta-item">
                            <i class="fa-solid fa-envelope"></i>
                            <div>
                                <small>Email Resmi</small>
                                <strong>ahmad.fauzi@sekolah.sch.id</strong>
                            </div>
                        </div>
                        <div class="teacher-meta-item">
                            <i class="fa-solid fa-phone"></i>
                            <div>
                                <small>No. WhatsApp</small>
                                <strong>+62 812-3456-7890</strong>
                            </div>
                        </div>
                        <div class="teacher-meta-item">
                            <i class="fa-solid fa-calendar-check"></i>
                            <div>
                                <small>Tahun Bergabung</small>
                                <strong>2018 (6 Tahun)</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="teacher-action-btns">
                    <button type="button" class="btn-action-primary" onclick="openEditProfilModal()">
                        <i class="fa-solid fa-pen-to-square"></i> Edit Profil
                    </button>
                    <button type="button" class="btn-action-secondary" onclick="openGantiPasswordModal()">
                        <i class="fa-solid fa-key"></i> Ubah Password
                    </button>
                </div>
            </div>

            <!-- STATISTIK RINGKAS AKTIVITAS MENGAJAR -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>12 Siswa</h3>
                    <p>Siswa Dalam Halaqah</p>
                </div>
                <div class="stat-card" style="border-top-color: var(--primary-color);">
                    <h3 class="text-green">128 Setoran</h3>
                    <p>Bulan Ini (Okt 2026)</p>
                </div>
                <div class="stat-card" style="border-top-color: var(--gold);">
                    <h3 style="color: var(--gold);">24.5 Juz</h3>
                    <p>Total Capaian Kelompok</p>
                </div>
                <div class="stat-card" style="border-top-color: var(--yellow-text);">
                    <h3 style="color: var(--yellow-text);">96%</h3>
                    <p>Kehadiran Mengajar</p>
                </div>
            </div>

            <!-- GRID DETAIL INFORMASI & KELOMPOK HALAQAH -->
            <div class="profile-content-grid">
                
                <!-- KIRI: BIODATA & SERTIFIKASI GURU -->
                <div class="table-card mb-0">
                    <div class="card-header-title">
                        <h4><i class="fa-solid fa-address-card"></i> Informasi & Biografi Guru</h4>
                        <span class="detail-header-tag"><i class="fa-solid fa-circle-check"></i> Terverifikasi</span>
                    </div>

                    <div class="bio-detail-list">
                        <div class="bio-item">
                            <span class="bio-label"><i class="fa-solid fa-book-quran"></i> Sanad / Sanad Hafalan:</span>
                            <span class="bio-value">Riwayat Hafsh 'an 'Aashim (30 Juz)</span>
                        </div>
                        <div class="bio-item">
                            <span class="bio-label"><i class="fa-solid fa-graduation-cap"></i> Pendidikan Terakhir:</span>
                            <span class="bio-value">S1 Pendidikan Agama Islam - PTIQ Jakarta</span>
                        </div>
                        <div class="bio-item">
                            <span class="bio-label"><i class="fa-solid fa-map-location-dot"></i> Alamat Domisili:</span>
                            <span class="bio-value">Jl. Pesantren Tahfiz No. 12, Kompleks Bina Qur'ani</span>
                        </div>
                        <div class="bio-item">
                            <span class="bio-label"><i class="fa-solid fa-clock"></i> Jadwal Mengajar:</span>
                            <span class="bio-value">Senin – Jumat (Subuh & Ba'da Asar)</span>
                        </div>
                    </div>

                    <div class="card-header-title mt-20">
                        <h4><i class="fa-solid fa-certificate"></i> Sertifikasi & Kompetensi</h4>
                    </div>
                    <div class="competency-tags">
                        <span class="tag-badge"><i class="fa-solid fa-check"></i> Syahadah Tahfiz 30 Juz</span>
                        <span class="tag-badge"><i class="fa-solid fa-check"></i> Sertifikat Tajwid & Makhraj</span>
                        <span class="tag-badge"><i class="fa-solid fa-check"></i> Pelatihan Metode Ummi</span>
                        <span class="tag-badge"><i class="fa-solid fa-check"></i> Lisensi Pengajar Standar Nasional</span>
                    </div>
                </div>

                <!-- KANAN: DAFTAR HALAQAH BINAAN SANG GURU -->
                <div class="table-card mb-0">
                    <div class="card-header-title">
                        <h4><i class="fa-solid fa-layer-group"></i> Ringkasan Halaqah Binaan</h4>
                        <span class="detail-header-tag"><i class="fa-solid fa-user-group"></i> 12 Santri/Siswa</span>
                    </div>

                    <div class="halaqah-summary-box">
                        <div class="halaqah-info-header">
                            <div>
                                <h5>Halaqah 1 (Ula - Pagi)</h5>
                                <p><i class="fa-solid fa-location-dot"></i> Ruang Kelas 1A / Musala Utama</p>
                            </div>
                            <span class="badge-gold">Aktif Semester Ini</span>
                        </div>

                        <div class="table-responsive mt-10">
                            <table class="table-compact">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Hafalan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><strong>Ahmad Fauzi</strong></td>
                                        <td>Juz 30 (1.5 Juz)</td>
                                        <td><span class="badge-status-sm success">Lancar</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><strong>Aisyah Nurbalqis</strong></td>
                                        <td>Juz 30 (2.0 Juz)</td>
                                        <td><span class="badge-status-sm success">Lancar</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><strong>Muhammad Bilal</strong></td>
                                        <td>Juz 29 (1.0 Juz)</td>
                                        <td><span class="badge-status-sm warning">Muraja'ah</span></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><strong>Fatimah Az-Zahra</strong></td>
                                        <td>Juz 30 (2.5 Juz)</td>
                                        <td><span class="badge-status-sm success">Lancar</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <!-- MODAL EDIT PROFIL GURU -->
    <div class="modal-overlay" id="editProfilModal">
        <div class="modal-container modal-profile-container">
            <div class="modal-header">
                <h3><i class="fa-solid fa-user-pen"></i> Edit Profil Pengajar</h3>
                <button type="button" class="modal-close" onclick="closeEditProfilModal()">&times;</button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body profile-modal-body">
                    <div class="form-group-modal">
                        <label for="nama_lengkap">Nama Lengkap & Gelar</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="Ustadz Ahmad Fauzi, S.Pd.I.">
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group-modal">
                            <label for="email">Email Resmi</label>
                            <input type="email" id="email" name="email" value="ahmad.fauzi@sekolah.sch.id">
                        </div>
                        <div class="form-group-modal">
                            <label for="telepon">No. WhatsApp</label>
                            <input type="text" id="telepon" name="telepon" value="+62 812-3456-7890">
                        </div>
                    </div>
                    <div class="form-group-modal">
                        <label for="alamat">Alamat Domisili</label>
                        <textarea id="alamat" name="alamat" rows="2">Jl. Pesantren Tahfiz No. 12, Kompleks Bina Qur'ani</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-close-modal" onclick="closeEditProfilModal()">Batal</button>
                    <button type="submit" class="btn-action-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL UBAH PASSWORD -->
    <div class="modal-overlay" id="gantiPasswordModal">
        <div class="modal-container" style="max-width: 480px;">
            <div class="modal-header">
                <h3><i class="fa-solid fa-key"></i> Ubah Password Akun</h3>
                <button type="button" class="modal-close" onclick="closeGantiPasswordModal()">&times;</button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group-modal">
                        <label for="password_lama">Password Saat Ini</label>
                        <input type="password" id="password_lama" name="password_lama" placeholder="Ketik password lama">
                    </div>
                    <div class="form-group-modal">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" id="password_baru" name="password_baru" placeholder="Ketik password baru (min 8 karakter)">
                    </div>
                    <div class="form-group-modal">
                        <label for="konfirmasi_password">Konfirmasi Password Baru</label>
                        <input type="password" id="konfirmasi_password" name="konfirmasi_password" placeholder="Ketik ulang password baru">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-close-modal" onclick="closeGantiPasswordModal()">Batal</button>
                    <button type="submit" class="btn-action-primary"><i class="fa-solid fa-shield-halved"></i> Update Password</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT TRIGGER MODAL -->
    <script>
        function openEditProfilModal() {
            document.getElementById('editProfilModal').classList.add('active');
        }
        function closeEditProfilModal() {
            document.getElementById('editProfilModal').classList.remove('active');
        }

        function openGantiPasswordModal() {
            document.getElementById('gantiPasswordModal').classList.add('active');
        }
        function closeGantiPasswordModal() {
            document.getElementById('gantiPasswordModal').classList.remove('active');
        }

        window.onclick = function(event) {
            const editModal = document.getElementById('editProfilModal');
            const passModal = document.getElementById('gantiPasswordModal');
            if (event.target === editModal) closeEditProfilModal();
            if (event.target === passModal) closeGantiPasswordModal();
        }
    </script>
</body>
</html>