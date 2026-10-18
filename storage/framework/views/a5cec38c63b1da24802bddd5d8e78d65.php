<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa Tahfiz - Digital Tahfiz</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama & CSS Khusus Daftar Siswa -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/dashboard.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/siswag.css')); ?>?v=<?php echo e(time()); ?>">
    
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container">

        <!-- SIDEBAR GURU / ADMIN -->
        <?php if (isset($component)) { $__componentOriginal84bdda8141b034a96f80d0303326857e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84bdda8141b034a96f80d0303326857e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar_tahfiz','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar_tahfiz'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal84bdda8141b034a96f80d0303326857e)): ?>
<?php $attributes = $__attributesOriginal84bdda8141b034a96f80d0303326857e; ?>
<?php unset($__attributesOriginal84bdda8141b034a96f80d0303326857e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal84bdda8141b034a96f80d0303326857e)): ?>
<?php $component = $__componentOriginal84bdda8141b034a96f80d0303326857e; ?>
<?php unset($__componentOriginal84bdda8141b034a96f80d0303326857e); ?>
<?php endif; ?>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <div>
                    <h2>Daftar Seluruh Siswa Tahfiz</h2>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell" title="Notifikasi"></i>
                    <i class="fa-regular fa-user" title="Profil Pengguna"></i>
                </div>
            </header>

            <!-- STATISTIK RINGKAS SISWA -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>36 Siswa</h3>
                    <p>Total Siswa Aktif</p>
                </div>
                <div class="stat-card" style="border-top-color: var(--primary-color);">
                    <h3 class="text-green">3 Halaqah</h3>
                    <p>Jumlah Halaqah Binaan</p>
                </div>
                <div class="stat-card" style="border-top-color: var(--gold);">
                    <h3 style="color: var(--gold);">1.8 Juz</h3>
                    <p>Rata-rata Hafalan</p>
                </div>
                <div class="stat-card" style="border-top-color: var(--yellow-text);">
                    <h3 style="color: var(--yellow-text);">94%</h3>
                    <p>Kehadiran Setoran</p>
                </div>
            </div>

            <!-- FILTER & PENCARIAN SISWA -->
            <div class="table-card mb-20">
                <div class="card-header-title">
                    <h4><i class="fa-solid fa-filter"></i> Filter & Cari Data Siswa</h4>
                    <span class="detail-header-tag"><i class="fa-solid fa-graduation-cap"></i> Data Pembelajaran</span>
                </div>

                <form action="" method="GET" class="filter-box form-grid-3">
                    <div class="filter-group">
                        <label for="search">Cari Nama / NISN</label>
                        <input type="text" id="search" name="search" placeholder="Ketik nama atau NISN..." value="<?php echo e(request('search')); ?>">
                    </div>

                    <div class="filter-group">
                        <label for="halaqah_id">Filter Halaqah</label>
                        <select id="halaqah_id" name="halaqah_id">
                            <option value="">-- Semua Halaqah --</option>
                            <option value="1" <?php echo e(request('halaqah_id') == '1' ? 'selected' : ''); ?>>Halaqah 1 (Ustadz Ahmad)</option>
                            <option value="2" <?php echo e(request('halaqah_id') == '2' ? 'selected' : ''); ?>>Halaqah 2 (Ustadzah Aisyah)</option>
                            <option value="3" <?php echo e(request('halaqah_id') == '3' ? 'selected' : ''); ?>>Halaqah 3 (Ustadz Fajar)</option>
                        </select>
                    </div>

                    <div class="filter-group filter-btn-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn-sm btn-submit w-100">
                            <i class="fa-solid fa-magnifying-glass"></i> Cari Siswa
                        </button>
                    </div>
                </form>
            </div>

            <!-- KATALOG SISWA (GRID KARTU SISWA) -->
            <div class="table-card">
                <div class="search-filter-bar">
                    <h4><i class="fa-solid fa-users"></i> Katalog Siswa</h4>
                    <span class="detail-header-tag"><i class="fa-solid fa-hand-pointer"></i> Klik Siswa Untuk Detail Profil</span>
                </div>

                <div class="student-cards-grid">
                    
                    <!-- KARTU SISWA 1 (Ahmad Fauzi) -->
                    <div class="student-item-card">
                        <div class="student-card-header">
                            <div class="student-avatar">AF</div>
                            <div class="student-card-identity">
                                <h4>Ahmad Fauzi</h4>
                                <span class="student-nisn"><i class="fa-solid fa-id-card"></i> NISN: 222301001</span>
                            </div>
                        </div>
                        <div class="student-card-body">
                            <div class="info-row">
                                <span><i class="fa-solid fa-users-rectangle"></i> Halaqah:</span>
                                <strong>Halaqah 1</strong>
                            </div>
                            <div class="info-row">
                                <span><i class="fa-solid fa-book-quran"></i> Hafalan:</span>
                                <strong>Juz 30 (1.5 Juz)</strong>
                            </div>
                            <div class="info-row">
                                <span><i class="fa-solid fa-user-shield"></i> Wali:</span>
                                <span>Bpk. Rahmat</span>
                            </div>
                        </div>
                        <div class="student-card-footer">
                            <button type="button" class="btn-view-profile" onclick="openProfilModal({
                                nama: 'Ahmad Fauzi',
                                nisn: '222301001',
                                avatar: 'AF',
                                halaqah: 'Halaqah 1 (Ustadz Ahmad)',
                                hafalan: 'Juz 30 — An-Naba\' (1-20)',
                                wali: 'Bpk. Rahmat Hidayat',
                                kontak: '+62 812-3456-7890',
                                total: '1.5 Juz'
                            })">
                                Lihat Profil & Progres <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- KARTU SISWA 2 (Aisyah Nurbalqis) -->
                    <div class="student-item-card">
                        <div class="student-card-header">
                            <div class="student-avatar" style="background: linear-gradient(135deg, #10B981 0%, #047857 100%);">AN</div>
                            <div class="student-card-identity">
                                <h4>Aisyah Nurbalqis</h4>
                                <span class="student-nisn"><i class="fa-solid fa-id-card"></i> NISN: 222301002</span>
                            </div>
                        </div>
                        <div class="student-card-body">
                            <div class="info-row">
                                <span><i class="fa-solid fa-users-rectangle"></i> Halaqah:</span>
                                <strong>Halaqah 1</strong>
                            </div>
                            <div class="info-row">
                                <span><i class="fa-solid fa-book-quran"></i> Hafalan:</span>
                                <strong>Juz 30 (2.0 Juz)</strong>
                            </div>
                            <div class="info-row">
                                <span><i class="fa-solid fa-user-shield"></i> Wali:</span>
                                <span>Bpk. Abdullah</span>
                            </div>
                        </div>
                        <div class="student-card-footer">
                            <button type="button" class="btn-view-profile" onclick="openProfilModal({
                                nama: 'Aisyah Nurbalqis',
                                nisn: '222301002',
                                avatar: 'AN',
                                halaqah: 'Halaqah 1 (Ustadz Ahmad)',
                                hafalan: 'Juz 30 — An-Nazi\'at (1-15)',
                                wali: 'Bpk. Abdullah',
                                kontak: '+62 812-9876-5432',
                                total: '2.0 Juz'
                            })">
                                Lihat Profil & Progres <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- KARTU SISWA 3 (Muhammad Bilal) -->
                    <div class="student-item-card">
                        <div class="student-card-header">
                            <div class="student-avatar" style="background: var(--gold-gradient); color: var(--primary-darker);">MB</div>
                            <div class="student-card-identity">
                                <h4>Muhammad Bilal</h4>
                                <span class="student-nisn"><i class="fa-solid fa-id-card"></i> NISN: 222301003</span>
                            </div>
                        </div>
                        <div class="student-card-body">
                            <div class="info-row">
                                <span><i class="fa-solid fa-users-rectangle"></i> Halaqah:</span>
                                <strong>Halaqah 2</strong>
                            </div>
                            <div class="info-row">
                                <span><i class="fa-solid fa-book-quran"></i> Hafalan:</span>
                                <strong>Juz 29 (1.0 Juz)</strong>
                            </div>
                            <div class="info-row">
                                <span><i class="fa-solid fa-user-shield"></i> Wali:</span>
                                <span>Bpk. Farhan</span>
                            </div>
                        </div>
                        <div class="student-card-footer">
                            <button type="button" class="btn-view-profile" onclick="openProfilModal({
                                nama: 'Muhammad Bilal',
                                nisn: '222301003',
                                avatar: 'MB',
                                halaqah: 'Halaqah 2 (Ustadzah Aisyah)',
                                hafalan: 'Juz 29 — Al-Mulk (1-15)',
                                wali: 'Bpk. Farhan',
                                kontak: '+62 813-5555-4444',
                                total: '1.0 Juz'
                            })">
                                Lihat Profil & Progres <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- KARTU SISWA 4 (Fatimah Az-Zahra) -->
                    <div class="student-item-card">
                        <div class="student-card-header">
                            <div class="student-avatar" style="background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%);">FA</div>
                            <div class="student-card-identity">
                                <h4>Fatimah Az-Zahra</h4>
                                <span class="student-nisn"><i class="fa-solid fa-id-card"></i> NISN: 222301004</span>
                            </div>
                        </div>
                        <div class="student-card-body">
                            <div class="info-row">
                                <span><i class="fa-solid fa-users-rectangle"></i> Halaqah:</span>
                                <strong>Halaqah 2</strong>
                            </div>
                            <div class="info-row">
                                <span><i class="fa-solid fa-book-quran"></i> Hafalan:</span>
                                <strong>Juz 30 (2.5 Juz)</strong>
                            </div>
                            <div class="info-row">
                                <span><i class="fa-solid fa-user-shield"></i> Wali:</span>
                                <span>Bpk. Usman</span>
                            </div>
                        </div>
                        <div class="student-card-footer">
                            <button type="button" class="btn-view-profile" onclick="openProfilModal({
                                nama: 'Fatimah Az-Zahra',
                                nisn: '222301004',
                                avatar: 'FA',
                                halaqah: 'Halaqah 2 (Ustadzah Aisyah)',
                                hafalan: 'Juz 30 — Al-Infitar (1-19)',
                                wali: 'Bpk. Usman',
                                kontak: '+62 811-2233-4455',
                                total: '2.5 Juz'
                            })">
                                Lihat Profil & Progres <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>

    <!-- MODAL POP-UP PROFIL SISWA -->
    <div class="modal-overlay" id="profilModal">
        <div class="modal-container modal-profile-container">
            <div class="modal-header">
                <h3><i class="fa-solid fa-user-graduate"></i> Profil & Progres Hafalan Siswa</h3>
                <button type="button" class="modal-close" onclick="closeProfilModal()">&times;</button>
            </div>
            <div class="modal-body profile-modal-body">
                
                <!-- KARTU UTAMA PROFIL SISWA -->
                <div class="profile-header-card">
                    <div class="profile-avatar-wrapper">
                        <div class="profile-avatar-large" id="modalAvatar">AF</div>
                        <span class="badge success status-online-badge"><i class="fa-solid fa-circle"></i> Aktif</span>
                    </div>
                    <div class="profile-info-content">
                        <div class="profile-title-row">
                            <h3 id="modalNama">Ahmad Fauzi</h3>
                            <span class="badge-gold"><i class="fa-solid fa-graduation-cap"></i> Kelas 1A</span>
                        </div>
                        <p class="profile-username"><i class="fa-solid fa-user-gear"></i> Username / NISN: <strong id="modalNisn">222301001</strong></p>
                        
                        <div class="profile-details-grid">
                            <div class="profile-detail-item">
                                <i class="fa-solid fa-users-rectangle"></i>
                                <div>
                                    <small>Halaqah</small>
                                    <p id="modalHalaqah">Halaqah 1 (Ustadz Ahmad)</p>
                                </div>
                            </div>
                            <div class="profile-detail-item">
                                <i class="fa-solid fa-book-quran"></i>
                                <div>
                                    <small>Hafalan Saat Ini</small>
                                    <p id="modalHafalan">Juz 30 — An-Naba' (1-20)</p>
                                </div>
                            </div>
                            <div class="profile-detail-item">
                                <i class="fa-solid fa-user-shield"></i>
                                <div>
                                    <small>Wali Murid</small>
                                    <p id="modalWali">Bpk. Rahmat Hidayat</p>
                                </div>
                            </div>
                            <div class="profile-detail-item">
                                <i class="fa-solid fa-phone"></i>
                                <div>
                                    <small>Kontak Wali</small>
                                    <p id="modalKontak">+62 812-3456-7890</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RINGKASAN STATISTIK HAFALAN -->
                <div class="stats-grid stats-grid-modal">
                    <div class="stat-card">
                        <h3 id="modalTotalHafalan">1.5 Juz</h3>
                        <p>Total Tercapai</p>
                    </div>
                    <div class="stat-card" style="border-top-color: var(--primary-color);">
                        <h3 class="text-green">2.0 Juz</h3>
                        <p>Target Semester</p>
                    </div>
                    <div class="stat-card" style="border-top-color: var(--gold);">
                        <h3 style="color: var(--gold);">92%</h3>
                        <p>Kelancaran (Mutqin)</p>
                    </div>
                    <div class="stat-card" style="border-top-color: var(--yellow-text);">
                        <h3 style="color: var(--yellow-text);">Juz 30</h3>
                        <p>Murojaah Terakhir</p>
                    </div>
                </div>

                <!-- GRAFIK & KELANCARAN -->
                <div class="detail-row mb-20">
                    <div class="detail-box">
                        <div class="card-header-title">
                            <h4><i class="fa-solid fa-chart-column"></i> Grafik Progres Setoran</h4>
                            <span class="detail-header-tag">Tahun 2026/2027</span>
                        </div>
                        <div class="chart-box">
                            <div class="dummy-chart">
                                <div class="bar" style="height: 40%;"></div>
                                <div class="bar" style="height: 60%;"></div>
                                <div class="bar" style="height: 75%;"></div>
                                <div class="bar" style="height: 90%;"></div>
                                <div class="bar" style="height: 0%; opacity: 0.3;"></div>
                                <div class="bar" style="height: 0%; opacity: 0.3;"></div>
                            </div>
                            <div class="chart-labels">
                                <span>Jul</span><span>Agt</span><span>Sep</span><span>Okt</span><span>Nov</span><span>Des</span>
                            </div>
                        </div>
                    </div>

                    <div class="detail-box">
                        <div class="card-header-title">
                            <h4><i class="fa-solid fa-pie-chart"></i> Kelancaran Hafalan</h4>
                            <span class="detail-header-tag">Kualitas</span>
                        </div>
                        <div class="modal-detail-list mt-15">
                            <div class="detail-item">
                                <span class="detail-label"><i class="fa-solid fa-circle text-green"></i> Mutqin (Sangat Lancar)</span>
                                <span class="detail-value text-green">80% (16 Hal)</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label"><i class="fa-solid fa-circle style-gold"></i> Jayyid (Lancar)</span>
                                <span class="detail-value style-gold">15% (3 Hal)</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label"><i class="fa-solid fa-circle text-danger"></i> Ziyadah Baru</span>
                                <span class="detail-value text-danger">5% (1 Hal)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TABEL RINCIAN CAPAIAN -->
                <div class="table-card mb-0">
                    <div class="card-header-title">
                        <h4><i class="fa-solid fa-list-check"></i> Rincian Capaian Surah & Juz</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table-compact">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Juz</th>
                                    <th>Nama Surah</th>
                                    <th>Ayat Terhafal</th>
                                    <th>Nilai</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Juz 30</td>
                                    <td>Surah An-Naba'</td>
                                    <td>Ayat 1 – 20</td>
                                    <td><strong>88 (A)</strong></td>
                                    <td><span class="badge success">Mutqin</span></td>
                                    <td>16/10/2026</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Juz 30</td>
                                    <td>Surah An-Nazi'at</td>
                                    <td>Ayat 1 – 46</td>
                                    <td><strong>92 (A+)</strong></td>
                                    <td><span class="badge success">Mutqin</span></td>
                                    <td>10/10/2026</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="" target="_blank" class="btn-pdf-modal"><i class="fa-solid fa-file-pdf"></i> Cetak Rapor Hafalan</a>
                <button type="button" class="btn-close-modal" onclick="closeProfilModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- SCRIPT TRIGGER MODAL -->
    <script>
        function openProfilModal(data) {
            document.getElementById('modalNama').innerText = data.nama;
            document.getElementById('modalNisn').innerText = data.nisn;
            document.getElementById('modalAvatar').innerText = data.avatar;
            document.getElementById('modalHalaqah').innerText = data.halaqah;
            document.getElementById('modalHafalan').innerText = data.hafalan;
            document.getElementById('modalWali').innerText = data.wali;
            document.getElementById('modalKontak').innerText = data.kontak;
            document.getElementById('modalTotalHafalan').innerText = data.total;

            document.getElementById('profilModal').classList.add('active');
        }

        function closeProfilModal() {
            document.getElementById('profilModal').classList.remove('active');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('profilModal');
            if (event.target === modal) {
                closeProfilModal();
            }
        }
    </script>
</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/guru/siswa.blade.php ENDPATH**/ ?>