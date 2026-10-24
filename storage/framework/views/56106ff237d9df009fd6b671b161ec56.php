<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Setoran Hafalan - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri (islami/elegan) + Poppins (body) -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/inputlaporan.css')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container">

        <!-- WADAH TEMPLATE SIDEBAR -->
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

            <!-- 1. PAGE HEADER -->
            <div class="page-header">
                <div class="page-header-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Input Setoran</span></p>
                    <h1>Form Input Setoran Hafalan</h1>
                </div>
                <div class="page-header-right">
                    <div class="date-nav">
                        <div class="date-nav-current">
                            <i class="fa-regular fa-calendar"></i>
                            <input type="date" name="tanggal_setoran" value="2026-06-23">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. FILTER PILIH KELAS & HALAQAH -->
            <div class="filter-toolbar-card">
                <div class="filter-group">
                    <label><i class="fa-solid fa-school"></i> Pilih Kelas</label>
                    <select class="form-control-select">
                        <option value="1a" selected>Kelas 1A</option>
                        <option value="1b">Kelas 1B</option>
                        <option value="2a">Kelas 2A</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label><i class="fa-solid fa-users-rectangle"></i> Pilih Halaqah</label>
                    <select class="form-control-select">
                        <option value="1" selected>Halaqah 1 (Ustadz Ahmad)</option>
                        <option value="2">Halaqah 2 (Ustadzah Aisyah)</option>
                    </select>
                </div>
                <div class="filter-action">
                    <button type="button" class="btn-filter-apply"><i class="fa-solid fa-rotate"></i> Muat Data Siswa</button>
                </div>
            </div>

            <!-- 3. FORM UTAMA INPUT SETORAN -->
            <form action="" method="POST">
                <?php echo csrf_field(); ?>
                
                <!-- KARTU INFORMASI UTAMA SETORAN -->
                <div class="form-card-main">
                    <div class="form-row-grid">
                        <div class="form-group-custom">
                            <label>Tanggal*</label>
                            <input type="text" class="input-control" value="Okt 20, 2026" readonly>
                        </div>
                        <div class="form-group-custom">
                            <label>Halaqah</label>
                            <select class="input-control select-arrow">
                                <option value="" selected disabled>Pilih salah satu opsi</option>
                                <option value="1">Halaqah 1</option>
                                <option value="2">Halaqah 2</option>
                            </select>
                        </div>
                        <div class="form-group-custom">
                            <label>Nama Siswa*</label>
                            <select class="input-control select-arrow">
                                <option value="" selected disabled>Pilih salah satu opsi</option>
                                <option value="1">Ali</option>
                                <option value="2">Budi</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row-grid mt-15">
                        <div class="form-group-custom">
                            <label>Juz</label>
                            <div class="input-with-icon">
                                <input type="text" class="input-control" value="Juz 1">
                                <span class="input-icons-right"><i class="fa-solid fa-xmark"></i> <i class="fa-solid fa-chevron-down"></i></span>
                            </div>
                        </div>
                        <div class="form-group-custom">
                            <label>Target Harian (baris)</label>
                            <input type="text" class="input-control" placeholder="">
                        </div>
                        <div class="form-group-custom">
                            <label>Jumlah Baris</label>
                            <input type="text" class="input-control" placeholder="">
                        </div>
                        <div class="form-group-custom">
                            <label>Capaian Target*</label>
                            <select class="input-control select-arrow">
                                <option value="Tercapai" selected>Tercapai</option>
                                <option value="Tidak Tercapai">Tidak Tercapai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 1. SETORAN ZIYADAH (HAFALAN BARU) -->
                <div class="setoran-section-card">
                    <div class="section-card-header">
                        <div class="section-title-left">
                            <i class="fa-solid fa-book-open"></i>
                            <h4>1. Setoran Ziyadah (Hafalan Baru)</h4>
                        </div>
                    </div>

                    <div class="section-card-body">
                        <div class="ziyadah-item-box">
                            <div class="ziyadah-item-toolbar">
                                <span class="drag-icon"><i class="fa-solid fa-arrows-up-down"></i></span>
                                <div class="toolbar-actions-right">
                                    <button type="button" class="btn-icon-action" title="Hapus"><i class="fa-solid fa-trash-can"></i></button>
                                    <button type="button" class="btn-icon-action" title="Tutup"><i class="fa-solid fa-chevron-up"></i></button>
                                </div>
                            </div>

                            <div class="form-row-grid">
                                <div class="form-group-custom">
                                    <label>Surah</label>
                                    <select class="input-control select-arrow" name="ziyadah_surah">
                                        <option value="" selected disabled>Pilih salah satu opsi</option>
                                        <option value="annaba">An-Naba</option>
                                        <option value="an-naziat">An-Nazi'at</option>
                                    </select>
                                </div>
                                <div class="form-group-custom">
                                    <label>Ayat Dari</label>
                                    <select class="input-control select-arrow" name="ziyadah_ayat_dari">
                                        <option value="" selected disabled>Pilih salah satu opsi</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="form-group-custom">
                                    <label>Sampai</label>
                                    <select class="input-control select-arrow" name="ziyadah_ayat_sampai">
                                        <option value="" selected disabled>Pilih salah satu opsi</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-20">
                            <button type="button" class="btn-add-ziyadah">+ Tambah Setoran Ziyadah</button>
                        </div>
                    </div>
                </div>

                <!-- 2. SETORAN MUROJAAH -->
                <div class="setoran-section-card">
                    <div class="section-card-header">
                        <div class="section-title-left">
                            <i class="fa-solid fa-rotate-right"></i>
                            <h4>2. Setoran Murojaah (Pengulangan)</h4>
                        </div>
                    </div>

                    <div class="section-card-body">
                        <div class="ziyadah-item-box">
                            <div class="ziyadah-item-toolbar">
                                <span class="drag-icon"><i class="fa-solid fa-arrows-up-down"></i></span>
                                <div class="toolbar-actions-right">
                                    <button type="button" class="btn-icon-action" title="Hapus"><i class="fa-solid fa-trash-can"></i></button>
                                    <button type="button" class="btn-icon-action" title="Tutup"><i class="fa-solid fa-chevron-up"></i></button>
                                </div>
                            </div>

                            <div class="form-row-grid">
                                <div class="form-group-custom">
                                    <label>Surah Murojaah</label>
                                    <select class="input-control select-arrow" name="murojaah_surah">
                                        <option value="" selected disabled>Pilih salah satu opsi</option>
                                        <option value="annaba">An-Naba</option>
                                        <option value="an-naziat">An-Nazi'at</option>
                                    </select>
                                </div>
                                <div class="form-group-custom">
                                    <label>Ayat Dari</label>
                                    <select class="input-control select-arrow" name="murojaah_ayat_dari">
                                        <option value="" selected disabled>Pilih salah satu opsi</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="form-group-custom">
                                    <label>Sampai</label>
                                    <select class="input-control select-arrow" name="murojaah_ayat_sampai">
                                        <option value="" selected disabled>Pilih salah satu opsi</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-20">
                            <button type="button" class="btn-add-ziyadah">+ Tambah Setoran Murojaah</button>
                        </div>
                    </div>
                </div>

                <!-- 3. PR ZIYADAH (PERSIAPAN DI RUMAH) -->
                <div class="setoran-section-card">
                    <div class="section-card-header">
                        <div class="section-title-left">
                            <i class="fa-solid fa-house-chimney"></i>
                            <h4>3. PR Ziyadah (Persiapan di Rumah)</h4>
                        </div>
                    </div>

                    <div class="section-card-body">
                        <div class="ziyadah-item-box">
                            <div class="ziyadah-item-toolbar">
                                <span class="drag-icon"><i class="fa-solid fa-arrows-up-down"></i></span>
                                <div class="toolbar-actions-right">
                                    <button type="button" class="btn-icon-action" title="Hapus"><i class="fa-solid fa-trash-can"></i></button>
                                    <button type="button" class="btn-icon-action" title="Tutup"><i class="fa-solid fa-chevron-up"></i></button>
                                </div>
                            </div>

                            <div class="form-row-grid">
                                <div class="form-group-custom">
                                    <label>Surah</label>
                                    <select class="input-control select-arrow" name="pr_ziyadah_surah">
                                        <option value="" selected disabled>Pilih salah satu opsi</option>
                                        <option value="annaba">An-Naba</option>
                                        <option value="an-naziat">An-Nazi'at</option>
                                    </select>
                                </div>
                                <div class="form-group-custom">
                                    <label>Ayat Dari</label>
                                    <select class="input-control select-arrow" name="pr_ziyadah_ayat_dari">
                                        <option value="" selected disabled>Pilih salah satu opsi</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="form-group-custom">
                                    <label>Sampai</label>
                                    <select class="input-control select-arrow" name="pr_ziyadah_ayat_sampai">
                                        <option value="" selected disabled>Pilih salah satu opsi</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-20">
                            <button type="button" class="btn-add-ziyadah">Tambah PR Ziyadah</button>
                        </div>
                    </div>
                </div>

                <!-- 4. PR MUROJAAH (PERSIAPAN DI RUMAH) -->
                <div class="setoran-section-card">
                    <div class="section-card-header">
                        <div class="section-title-left">
                            <i class="fa-solid fa-house-chimney-crack"></i>
                            <h4>4. PR Murojaah (Persiapan di Rumah)</h4>
                        </div>
                    </div>

                    <div class="section-card-body">
                        <div class="ziyadah-item-box">
                            <div class="ziyadah-item-toolbar">
                                <span class="drag-icon"><i class="fa-solid fa-arrows-up-down"></i></span>
                                <div class="toolbar-actions-right">
                                    <button type="button" class="btn-icon-action" title="Hapus"><i class="fa-solid fa-trash-can"></i></button>
                                    <button type="button" class="btn-icon-action" title="Tutup"><i class="fa-solid fa-chevron-up"></i></button>
                                </div>
                            </div>

                            <div class="form-row-grid">
                                <div class="form-group-custom">
                                    <label>Surah</label>
                                    <select class="input-control select-arrow" name="pr_murojaah_surah">
                                        <option value="" selected disabled>Pilih salah satu opsi</option>
                                        <option value="annaba">An-Naba</option>
                                        <option value="an-naziat">An-Nazi'at</option>
                                    </select>
                                </div>
                                <div class="form-group-custom">
                                    <label>Ayat Dari</label>
                                    <select class="input-control select-arrow" name="pr_murojaah_ayat_dari">
                                        <option value="" selected disabled>Pilih salah satu opsi</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="form-group-custom">
                                    <label>Sampai</label>
                                    <select class="input-control select-arrow" name="pr_murojaah_ayat_sampai">
                                        <option value="" selected disabled>Pilih salah satu opsi</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-20">
                            <button type="button" class="btn-add-ziyadah">Tambah PR Murojaah</button>
                        </div>
                    </div>
                </div>

                <!-- KONDISI HAFALAN & CATATAN -->
                <div class="form-card-main">
                    <div class="form-row-split">
                        <!-- KONDISI HAFALAN (RADIO BUTTON) -->
                        <div class="kondisi-hafalan-group">
                            <label class="label-maroon">Kondisi Hafalan*</label>
                            <div class="radio-inline-options">
                                <label class="radio-option">
                                    <input type="radio" name="kondisi_hafalan" value="Lancar" checked>
                                    <span class="radio-custom"></span>
                                    Lancar
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="kondisi_hafalan" value="Belum Lancar">
                                    <span class="radio-custom"></span>
                                    Belum Lancar
                                </label>
                            </div>
                        </div>

                        <!-- CATATAN (TEXTAREA) -->
                        <div class="catatan-group">
                            <label class="label-maroon">Catatan (opsional)</label>
                            <textarea name="catatan" class="input-control textarea-control" placeholder="Tuliskan catatan jika ada..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL AKSI BAWAH -->
                <div class="bottom-action-bar">
                    <button type="submit" class="btn-action-submit">Buat</button>
                    <button type="button" class="btn-action-outline">Buat & buat lainnya</button>
                    <button type="button" class="btn-action-cancel">Batal</button>
                </div>

            </form>

        </main>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/guru/inputlaporan.blade.php ENDPATH**/ ?>