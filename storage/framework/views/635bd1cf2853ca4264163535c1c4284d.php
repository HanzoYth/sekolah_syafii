<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan Tahfiz - Digital Tahfiz</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama & CSS Khusus Riwayat Laporan -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/dashboard.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/riwayat-laporan.css')); ?>?v=<?php echo e(time()); ?>">
    
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container">

        <!-- SIDEBAR GURU -->
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
                    <h2>Riwayat Laporan Hafalan Siswa</h2>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell" title="Notifikasi"></i>
                    <i class="fa-regular fa-user" title="Profil Guru"></i>
                </div>
            </header>

            <!-- CARD FILTER & PERIODE LAPORAN -->
            <div class="table-card form-card">
                <div class="card-header-title">
                    <h4><i class="fa-solid fa-filter"></i> Filter & Periode Laporan</h4>
                    <span class="detail-header-tag"><i class="fa-solid fa-calendar-days"></i> Filter Data</span>
                </div>

                <form action="" method="GET" class="filter-box form-grid-4">
                    <!-- Opsi Rentang Waktu (Harian / Mingguan / Bulanan) -->
                    <div class="filter-group">
                        <label for="periode">Rentang Laporan</label>
                        <select id="periode" name="periode" onchange="toggleFilterFields(this.value)">
                            <option value="semua" <?php echo e(request('periode') == 'semua' ? 'selected' : ''); ?>>Semua Laporan</option>
                            <option value="harian" <?php echo e(request('periode', 'harian') == 'harian' ? 'selected' : ''); ?>>Harian</option>
                            <option value="mingguan" <?php echo e(request('periode') == 'mingguan' ? 'selected' : ''); ?>>Mingguan</option>
                            <option value="bulanan" <?php echo e(request('periode') == 'bulanan' ? 'selected' : ''); ?>>Bulanan</option>
                        </select>
                    </div>

                    <!-- Filter Tanggal Spesifik (Harian) -->
                    <div class="filter-group filter-dynamic" id="field-harian">
                        <label for="tanggal">Pilih Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" value="<?php echo e(request('tanggal', date('Y-m-d'))); ?>">
                    </div>

                    <!-- Filter Minggu/Tanggal Mulai (Mingguan) -->
                    <div class="filter-group filter-dynamic" id="field-mingguan" style="display: none;">
                        <label for="minggu_ke">Pilih Minggu Ke-</label>
                        <input type="week" id="minggu_ke" name="minggu_ke" value="<?php echo e(request('minggu_ke')); ?>">
                    </div>

                    <!-- Filter Bulan & Tahun (Bulanan) -->
                    <div class="filter-group filter-dynamic" id="field-bulanan" style="display: none;">
                        <label for="bulan_tahun">Pilih Bulan & Tahun</label>
                        <input type="month" id="bulan_tahun" name="bulan_tahun" value="<?php echo e(request('bulan_tahun', date('Y-m'))); ?>">
                    </div>

                    <!-- Filter Siswa Specific -->
                    <div class="filter-group">
                        <label for="siswa_id">Pilih Siswa</label>
                        <select id="siswa_id" name="siswa_id">
                            <option value="">-- Semua Siswa --</option>
                            <option value="222301001" <?php echo e(request('siswa_id') == '222301001' ? 'selected' : ''); ?>>Ahmad Fauzi</option>
                            <option value="222301002" <?php echo e(request('siswa_id') == '222301002' ? 'selected' : ''); ?>>Aisyah Nurbalqis</option>
                            <option value="222301003" <?php echo e(request('siswa_id') == '222301003' ? 'selected' : ''); ?>>Muhammad Bilal</option>
                        </select>
                    </div>

                    <!-- Tombol Terapkan Filter -->
                    <div class="filter-group filter-btn-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn-sm btn-submit w-100">
                            <i class="fa-solid fa-magnifying-glass"></i> Tampilkan
                        </button>
                    </div>
                </form>
            </div>

            <!-- TABLE REKAP LAPORAN SISWA -->
            <div class="table-card">
                <div class="search-filter-bar">
                    <h4><i class="fa-solid fa-clock-rotate-left"></i> Daftar Rekap Laporan</h4>
                    <div class="action-right">
                        <!-- Tombol Export PDF -->
                        <a href="" target="_blank" class="btn-action-outline btn-pdf">
                            <i class="fa-solid fa-file-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-compact">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Siswa</th>
                                <th>Juz</th>
                                <th>Setoran Ziyadah</th>
                                <th>Setoran Murojaah</th>
                                <th>Baris</th>
                                <th>Status Target</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Item Laporan 1 -->
                            <tr>
                                <td>1</td>
                                <td>16/10/2026</td>
                                <td>
                                    <div class="student-name-cell">
                                        <div class="student-avatar">AF</div>
                                        <span class="cell-strong">Ahmad Fauzi</span>
                                    </div>
                                </td>
                                <td>Juz 30</td>
                                <td>Surah An-Naba' (1-20)</td>
                                <td>Surah An-Nazi'at (1-15)</td>
                                <td>15 / 15</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                                <td class="text-center">
                                    <button type="button" class="btn-xs btn-detail-laporan"
                                        data-tanggal="16/10/2026"
                                        data-nama="Ahmad Fauzi"
                                        data-nisn="222301001"
                                        data-juz="Juz 30"
                                        data-target="15 Baris"
                                        data-jumlah="15 Baris"
                                        data-status="Tercapai"
                                        data-ziyadah="Surah An-Naba' (1-20)"
                                        data-murojaah="Surah An-Nazi'at (1-15)"
                                        data-prziyadah="Surah An-Naba' (21-40)"
                                        data-prmurojaah="Surah An-Naba' (1-20)">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Item Laporan 2 -->
                            <tr>
                                <td>2</td>
                                <td>16/10/2026</td>
                                <td>
                                    <div class="student-name-cell">
                                        <div class="student-avatar">AN</div>
                                        <span class="cell-strong">Aisyah Nurbalqis</span>
                                    </div>
                                </td>
                                <td>Juz 30</td>
                                <td>Surah An-Nazi'at (1-15)</td>
                                <td>Surah Abasa (1-15)</td>
                                <td>15 / 15</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                                <td class="text-center">
                                    <button type="button" class="btn-xs btn-detail-laporan"
                                        data-tanggal="16/10/2026"
                                        data-nama="Aisyah Nurbalqis"
                                        data-nisn="222301002"
                                        data-juz="Juz 30"
                                        data-target="15 Baris"
                                        data-jumlah="15 Baris"
                                        data-status="Tercapai"
                                        data-ziyadah="Surah An-Nazi'at (1-15)"
                                        data-murojaah="Surah Abasa (1-15)"
                                        data-prziyadah="Surah An-Nazi'at (16-30)"
                                        data-prmurojaah="Surah An-Nazi'at (1-15)">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Item Laporan 3 -->
                            <tr>
                                <td>3</td>
                                <td>15/10/2026</td>
                                <td>
                                    <div class="student-name-cell">
                                        <div class="student-avatar" style="background: var(--gold-gradient); color: var(--primary-darker);">MB</div>
                                        <span class="cell-strong">Muhammad Bilal</span>
                                    </div>
                                </td>
                                <td>Juz 30</td>
                                <td>Surah Abasa (1-10)</td>
                                <td>Surah Takwir (1-10)</td>
                                <td>10 / 15</td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Belum Tercapai</span></td>
                                <td class="text-center">
                                    <button type="button" class="btn-xs btn-detail-laporan" style="background: var(--red-bg); color: var(--red-text); border-color: var(--border-color);"
                                        data-tanggal="15/10/2026"
                                        data-nama="Muhammad Bilal"
                                        data-nisn="222301003"
                                        data-juz="Juz 30"
                                        data-target="15 Baris"
                                        data-jumlah="10 Baris"
                                        data-status="Belum Tercapai"
                                        data-ziyadah="Surah Abasa (1-10)"
                                        data-murojaah="Surah Takwir (1-10)"
                                        data-prziyadah="Ulangi Surah Abasa (1-10)"
                                        data-prmurojaah="Murojaah Surah Takwir">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL POP-UP DETAIL LAPORAN SISWA -->
    <div class="modal-overlay" id="detailLaporanModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3><i class="fa-solid fa-book-open-reader"></i> Detail Laporan Setoran</h3>
                <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-detail-list">
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Setoran:</span>
                        <span class="detail-value" id="modalTanggal">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nama Siswa / NISN:</span>
                        <span class="detail-value" id="modalSiswa">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Capaian Juz:</span>
                        <span class="detail-value" id="modalJuz">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Target / Disetor:</span>
                        <span class="detail-value" id="modalBaris">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status Target:</span>
                        <span class="detail-value" id="modalStatus">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Setoran Ziyadah:</span>
                        <span class="detail-value text-green" id="modalZiyadah">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Setoran Murojaah:</span>
                        <span class="detail-value style-gold" id="modalMurojaah">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">PR Ziyadah:</span>
                        <span class="detail-value" id="modalPrZiyadah">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">PR Murojaah:</span>
                        <span class="detail-value" id="modalPrMurojaah">-</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-close-modal" onclick="closeModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT MODAL & TOGGLE FILTER -->
    <script>
        function toggleFilterFields(val) {
            document.querySelectorAll('.filter-dynamic').forEach(el => el.style.display = 'none');
            if (val === 'harian') {
                document.getElementById('field-harian').style.display = 'flex';
            } else if (val === 'mingguan') {
                document.getElementById('field-mingguan').style.display = 'flex';
            } else if (val === 'bulanan') {
                document.getElementById('field-bulanan').style.display = 'flex';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi tampilan filter awal
            const selectedPeriode = document.getElementById('periode').value;
            toggleFilterFields(selectedPeriode);

            // Trigger Modal Pop-up Detail Laporan
            const detailButtons = document.querySelectorAll('.btn-detail-laporan');
            const modal = document.getElementById('detailLaporanModal');

            detailButtons.forEach(button => {
                button.addEventListener('click', function () {
                    document.getElementById('modalTanggal').innerText = this.getAttribute('data-tanggal');
                    document.getElementById('modalSiswa').innerText = this.getAttribute('data-nama') + ' (' + this.getAttribute('data-nisn') + ')';
                    document.getElementById('modalJuz').innerText = this.getAttribute('data-juz');
                    document.getElementById('modalBaris').innerText = this.getAttribute('data-jumlah') + ' / ' + this.getAttribute('data-target');
                    document.getElementById('modalStatus').innerText = this.getAttribute('data-status');
                    document.getElementById('modalZiyadah').innerText = this.getAttribute('data-ziyadah');
                    document.getElementById('modalMurojaah').innerText = this.getAttribute('data-murojaah');
                    document.getElementById('modalPrZiyadah').innerText = this.getAttribute('data-prziyadah');
                    document.getElementById('modalPrMurojaah').innerText = this.getAttribute('data-prmurojaah');

                    modal.classList.add('active');
                });
            });
        });

        function closeModal() {
            document.getElementById('detailLaporanModal').classList.remove('active');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('detailLaporanModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\tahfiz\guru\riwayat.blade.php ENDPATH**/ ?>