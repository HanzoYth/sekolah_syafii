<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas & Halaqah - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/kelas_halaqah.css')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container">

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

        <main class="main-content">

            <!-- 1. PAGE HEADER -->
            <div class="page-header">
                <div class="page-header-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Kelas & Halaqah</span></p>
                    <h1>Kelas & Halaqah</h1>
                </div>
                <div class="page-header-right">
                    <button class="btn-outline" onclick="openModal('modalTambahKelas')"><i class="fa-solid fa-school"></i> Tambah Kelas</button>
                    <button class="btn-primary-gold" onclick="openModal('modalTambahHalaqah')"><i class="fa-solid fa-plus"></i> Tambah Halaqah</button>
                </div>
            </div>

            <!-- 2. RINGKASAN SINGKAT -->
            <div class="quick-stats">
                <div class="stat-pill">
                    <i class="fa-solid fa-school"></i>
                    <div>
                        <h4>6</h4>
                        <p>Total Kelas</p>
                    </div>
                </div>
                <div class="stat-pill">
                    <i class="fa-solid fa-book-quran"></i>
                    <div>
                        <h4>15</h4>
                        <p>Total Halaqah</p>
                    </div>
                </div>
                <div class="stat-pill alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <h4>2</h4>
                        <p>Halaqah Belum Ada Pengampu</p>
                    </div>
                </div>
            </div>

            <!-- 3. FILTER & PENCARIAN -->
            <div class="toolbar-box">
                <div class="search-field">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari nama halaqah, kelas, atau pengampu...">
                </div>
                <div class="toolbar-filters">
                    <select>
                        <option>Semua Kelas</option>
                        <option>Kelas 1A</option>
                        <option>Kelas 1B</option>
                        <option>Kelas 2A</option>
                        <option>Kelas 2B</option>
                        <option>Kelas 3A</option>
                    </select>
                    <select>
                        <option>Semua Status</option>
                        <option>Ada Pengampu</option>
                        <option>Belum Ada Pengampu</option>
                    </select>
                </div>
            </div>

            <!-- 4. TABEL EXPANDABLE DETAIL KELAS & HALAQAH -->
            <div class="table-card">
                <div class="table-responsive">
                    <table class="table-expandable">
                        <thead>
                            <tr>
                                <th style="width: 80px;" class="text-center">DETAIL</th>
                                <th>NAMA KELAS</th>
                                <th class="text-center">TOTAL HALAQAH</th>
                                <th class="text-center">TOTAL SISWA</th>
                                <th class="text-center" style="width: 100px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- BARIS KELAS 1A -->
                            <tr class="row-parent expanded" onclick="toggleClassRow(this)">
                                <td class="text-center">
                                    <i class="fa-solid fa-chevron-down toggle-icon"></i>
                                    <span class="cid-badge">CID: 24</span>
                                </td>
                                <td>
                                    <div class="class-name-cell">
                                        <i class="fa-solid fa-graduation-cap icon-class"></i>
                                        <strong>1A</strong>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="count-pill"><i class="fa-solid fa-users"></i> 2</span>
                                </td>
                                <td class="text-center">
                                    <span class="count-pill"><i class="fa-solid fa-user-large"></i> 16</span>
                                </td>
                                <td class="text-center" onclick="event.stopPropagation();">
                                    <div class="action-icons-row">
                                        <button title="Lihat Detail Kelas" class="btn-action-icon danger-icon" onclick="openModal('modalDetailKelas')"><i class="fa-regular fa-eye"></i></button>
                                        <button title="Edit Kelas" class="btn-action-icon" onclick="openModal('modalEditKelas')"><i class="fa-regular fa-pen-to-square"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <!-- DETAIL KELAS 1A (KARTU HALAQAH) -->
                            <tr class="row-detail active">
                                <td colspan="5">
                                    <div class="class-detail-container">
                                        <div class="class-detail-header">
                                            <i class="fa-solid fa-users-gear"></i>
                                            <div>
                                                <h4>Daftar Halaqah</h4>
                                                <p>Mengelola kelompok belajar di kelas 1A</p>
                                            </div>
                                        </div>

                                        <div class="halaqah-grid">
                                            <div class="halaqah-card">
                                                <span class="hid-badge">HID: 59</span>
                                                <div class="halaqah-card-header">
                                                    <h5>Halaqah 1</h5>
                                                    <div class="halaqah-card-top-right">
                                                        <span class="student-count-badge"><i class="fa-solid fa-user-group"></i> 8 Siswa</span>
                                                        <!-- TOMBOL AKSI PADA KARTU HALAQAH -->
                                                        <div class="halaqah-action-icons">
                                                            <button title="Lihat Detail & Siswa Halaqah" class="btn-halaqah-action" onclick="openModal('modalSiswaHalaqah')"><i class="fa-regular fa-eye"></i></button>
                                                            <button title="Edit Halaqah" class="btn-halaqah-action" onclick="openModal('modalEditHalaqah')"><i class="fa-regular fa-pen-to-square"></i></button>
                                                            <button title="Ganti Pengampu" class="btn-halaqah-action" onclick="openModal('modalGantiPengampu')"><i class="fa-solid fa-user-pen"></i></button>
                                                            <button title="Hapus Halaqah" class="btn-halaqah-action danger" onclick="openModal('modalHapusHalaqah')"><i class="fa-regular fa-trash-can"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="guru-info-box">
                                                    <div class="guru-avatar text-avatar">US</div>
                                                    <div class="guru-details">
                                                        <span class="guru-label">GURU PENGAMPU</span>
                                                        <h6>Ustadzah Suhartini, S.IP</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- 5. MODAL TAMBAH KELAS -->
    <div class="modal-overlay" id="modalTambahKelas">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Tambah Kelas</h3>
                <button class="modal-close" onclick="closeModal('modalTambahKelas')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kelas</label>
                    <input type="text" placeholder="Contoh: Kelas 4A">
                </div>
                <div class="form-group">
                    <label>Keterangan (opsional)</label>
                    <input type="text" placeholder="Contoh: Kelas pagi">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="closeModal('modalTambahKelas')">Batal</button>
                <button class="btn-primary-gold">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 6. MODAL DETAIL KELAS -->
    <div class="modal-overlay" id="modalDetailKelas">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Detail Kelas</h3>
                <button class="modal-close" onclick="closeModal('modalDetailKelas')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="modal-detail-content">
                    <div class="detail-item-row">
                        <span class="d-label">ID Kelas (CID)</span>
                        <span class="d-value cid-badge">CID: 24</span>
                    </div>
                    <div class="detail-item-row">
                        <span class="d-label">Nama Kelas</span>
                        <span class="d-value cell-strong">Kelas 1A</span>
                    </div>
                    <div class="detail-item-row">
                        <span class="d-label">Total Halaqah</span>
                        <span class="d-value">1 Halaqah</span>
                    </div>
                    <div class="detail-item-row">
                        <span class="d-label">Total Siswa</span>
                        <span class="d-value">16 Siswa</span>
                    </div>
                    <div class="detail-item-row">
                        <span class="d-label">Keterangan / Deskripsi</span>
                        <span class="d-value text-muted">Kelas reguler program tahfiz pagi hari.</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-primary-gold" onclick="closeModal('modalDetailKelas')">Tutup</button>
            </div>
        </div>
    </div>

    <!-- 7. MODAL EDIT KELAS -->
    <div class="modal-overlay" id="modalEditKelas">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Edit Kelas</h3>
                <button class="modal-close" onclick="closeModal('modalEditKelas')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kelas</label>
                    <input type="text" value="Kelas 1A" placeholder="Masukkan nama kelas">
                </div>
                <div class="form-group">
                    <label>Keterangan / Deskripsi</label>
                    <textarea rows="3" class="form-textarea" placeholder="Masukkan keterangan kelas...">Kelas reguler program tahfiz pagi hari.</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="closeModal('modalEditKelas')">Batal</button>
                <button class="btn-primary-gold">Simpan Perubahan</button>
            </div>
        </div>
    </div>

    <!-- 8. MODAL TAMBAH HALAQAH -->
    <div class="modal-overlay" id="modalTambahHalaqah">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Tambah Halaqah</h3>
                <button class="modal-close" onclick="closeModal('modalTambahHalaqah')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Halaqah</label>
                    <input type="text" placeholder="Contoh: Halaqah 4">
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select>
                        <option>Pilih kelas...</option>
                        <option>Kelas 1A</option>
                        <option>Kelas 1B</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pengampu</label>
                    <select>
                        <option>Pilih pengampu...</option>
                        <option>Ustadzah Suhartini, S.IP</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="closeModal('modalTambahHalaqah')">Batal</button>
                <button class="btn-primary-gold">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 9. MODAL POP-UP SISWA HALAQAH (LOGS MATA - BARU) -->
    <div class="modal-overlay" id="modalSiswaHalaqah">
        <div class="modal-box modal-lg">
            <div class="modal-header">
                <div>
                    <h3>Detail & Daftar Siswa Halaqah</h3>
                    <p class="text-sm text-muted">Halaqah 1 — Kelas 1A (HID: 59)</p>
                </div>
                <button class="modal-close" onclick="closeModal('modalSiswaHalaqah')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="halaqah-summary-banner">
                    <div class="guru-info-box">
                        <div class="guru-avatar text-avatar">US</div>
                        <div class="guru-details">
                            <span class="guru-label">GURU PENGAMPU</span>
                            <h6>Ustadzah Suhartini, S.IP</h6>
                        </div>
                    </div>
                    <div class="summary-stat-pill">
                        <i class="fa-solid fa-user-group"></i>
                        <div>
                            <strong>8 Siswa</strong>
                            <span>Terdaftar</span>
                        </div>
                    </div>
                </div>

                <h4 class="section-subtitle"><i class="fa-solid fa-list-ol"></i> Anggota Siswa Halaqah</h4>
                
                <div class="table-responsive">
                    <table class="table-modal-siswa">
                        <thead>
                            <tr>
                                <th style="width: 40px;">NO</th>
                                <th>NAMA SISWA</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td><strong class="cell-strong">Razak ganteng</strong></td>
                             
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td><strong class="cell-strong">Razak ganteng sekali</strong></td>
                              
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td><strong class="cell-strong">Razak artis tiktok</strong></td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-primary-gold" onclick="closeModal('modalSiswaHalaqah')">Tutup</button>
            </div>
        </div>
    </div>

    <!-- 10. MODAL EDIT HALAQAH (BARU) -->
    <div class="modal-overlay" id="modalEditHalaqah">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Edit Informasi Halaqah</h3>
                <button class="modal-close" onclick="closeModal('modalEditHalaqah')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Halaqah</label>
                    <input type="text" value="Halaqah 1">
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select>
                        <option selected>Kelas 1A</option>
                        <option>Kelas 1B</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Target Harian (baris)</label>
                        <input type="number" value="5">
                    </div>
                    <div class="form-group">
                        <label>Kapasitas Siswa</label>
                        <input type="number" value="15">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="closeModal('modalEditHalaqah')">Batal</button>
                <button class="btn-primary-gold">Simpan Perubahan</button>
            </div>
        </div>
    </div>

    <!-- 11. MODAL GANTI PENGAMPU (BARU) -->
    <div class="modal-overlay" id="modalGantiPengampu">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Ganti Guru Pengampu</h3>
                <button class="modal-close" onclick="closeModal('modalGantiPengampu')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="guru-current-card mb-10">
                    <span class="guru-label">PENGAMPU SAAT INI</span>
                    <h6>Ustadzah Suhartini, S.IP</h6>
                </div>
                <div class="form-group mt-15">
                    <label>Pilih Guru Pengampu Baru</label>
                    <select>
                        <option value="">Pilih pengampu...</option>
                        <option value="1">Ustadzah Rayhanah Qurratu 'Aini</option>
                        <option value="2">Ustadz Ahmad</option>
                        <option value="3">Ustadz Abdullah</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="closeModal('modalGantiPengampu')">Batal</button>
                <button class="btn-primary-gold">Update Pengampu</button>
            </div>
        </div>
    </div>

    <!-- 12. MODAL HAPUS HALAQAH (BARU) -->
    <div class="modal-overlay" id="modalHapusHalaqah">
        <div class="modal-box modal-confirm">
            <div class="modal-body text-center">
                <div class="icon-danger-circle mb-10">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
                <h3>Hapus Halaqah?</h3>
                <p class="text-sm text-muted">Apakah Anda yakin ingin menghapus <strong>Halaqah 1</strong>? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer center-footer">
                <button class="btn-back" onclick="closeModal('modalHapusHalaqah')">Batal</button>
                <button class="btn-danger-solid">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <!-- SCRIPT INTERAKTIF AKORDION & MODAL -->
    <script>
        function toggleClassRow(row) {
            const nextRow = row.nextElementSibling;
            const icon = row.querySelector('.toggle-icon');

            if (nextRow && nextRow.classList.contains('row-detail')) {
                row.classList.toggle('expanded');
                nextRow.classList.toggle('active');

                if (row.classList.contains('expanded')) {
                    icon.classList.remove('fa-chevron-right');
                    icon.classList.add('fa-chevron-down');
                } else {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-right');
                }
            }
        }

        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }
    </script>

</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views//modul/tahfiz/kelashalaqah.blade.php ENDPATH**/ ?>