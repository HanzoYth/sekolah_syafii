<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Cabang - Sekolah Al-Qur'an Imam Syafi'i</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">  
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <!-- CSS Khusus Dashboard Cabang -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/guru/cabang_guru.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container">
        
        <!-- Sidebar Guru -->
        <?php if (isset($component)) { $__componentOriginale234f8d1d87fff37708f17b59eb20f90 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale234f8d1d87fff37708f17b59eb20f90 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar_guru','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar_guru'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale234f8d1d87fff37708f17b59eb20f90)): ?>
<?php $attributes = $__attributesOriginale234f8d1d87fff37708f17b59eb20f90; ?>
<?php unset($__attributesOriginale234f8d1d87fff37708f17b59eb20f90); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale234f8d1d87fff37708f17b59eb20f90)): ?>
<?php $component = $__componentOriginale234f8d1d87fff37708f17b59eb20f90; ?>
<?php unset($__componentOriginale234f8d1d87fff37708f17b59eb20f90); ?>
<?php endif; ?>

        <!-- MAIN CONTENT AREA WITH ISOLATED SCOPE -->
        <main class="main-content cabang-page-wrapper">
            
            <!-- HEADER / TOPBAR DASHBOARD -->
            <header class="topbar">
                <div class="topbar-title">
                    <h2>Kelola Cabang</h2>
                    <p>Manajemen data lokasi dan cabang sekolah</p>
                </div>
                
                <!-- FITUR LOGO TAMBAH (TRIGGER MODAL) -->
                <button class="btn-add-trigger" id="btnOpenModal">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Cabang</span>
                </button>
            </header>

            <!-- ISI KONTEN UTAMA (DAFTAR CABANG) -->
            <section class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h3>Daftar Cabang Aktif</h3>
                        <span class="badge">Total: <?php echo e($jumlah); ?> Cabang</span>
                    </div>
                    
                    <!-- Tabel Data Cabang -->
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Cabang</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Status</th> <!-- KELOLA STATUS -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="branchTableBody">
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <input type="hidden" value="<?php echo e($value->id); ?>" class="branch-id">
                                        <td><?php echo e($no); ?></td>
                                        <td class="branch-name"><?php echo e($value->nama_cabang); ?></td>
                                        <td><?php echo e(Carbon\Carbon::parse($value->creted_at)->translatedFormat('d M Y')); ?></td>
                                        
                                        <!-- STATUS BADGE -->
                                        <td>
                                            <?php if(isset($value->aktif) && !$value->aktif): ?>
                                                <span class="status-badge inactive">
                                                    <i class="fa-solid fa-circle-xmark"></i> Nonaktif
                                                </span>
                                            <?php else: ?>
                                                <span class="status-badge active">
                                                    <i class="fa-solid fa-circle-check"></i> Aktif
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <button class="btn-action edit" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button class="btn-action deactivate btn-deactivate-trigger" title="Nonaktifkan Cabang">
                                                <i class="fa-solid fa-power-off"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <p style="display: none;"><?php echo e($no++); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <!-- ========================================== -->
    <!-- MODAL POPUP INPUT TAMBAH CABANG          -->
    <!-- ========================================== -->
    <div class="modal-overlay" id="modalBranch">
        <div class="modal-card">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title">
                    <i class="fa-solid fa-building-circle-check"></i>
                    <h3>Tambah Cabang Baru</h3>
                </div>
                <button class="btn-close" id="btnCloseModal">&times;</button>
            </div>

            <!-- Modal Body / Form Input -->
            <form id="formAddBranch" action="/gr/tcb" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="input-group">
                        <label for="namaCabang">Nama Cabang <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-school"></i>
                            <input type="text" id="namaCabang" name="nama_cabang" placeholder="Contoh: Cabang Surabaya" required autocomplete="off">
                        </div>
                    </div>
                </div>

                <!-- Modal Footer / Action Button -->
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="btnCancelModal">Batal</button>
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-plus"></i> Tambahkan Cabang
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL POPUP KONFIRMASI NONAKTIFKAN CABANG -->
    <!-- ========================================== -->
    <div class="modal-overlay" id="modalDeactivate">
        <div class="modal-card modal-confirm-card">
            <div class="confirm-icon-wrapper">
                <div class="pulse-ring"></div>
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="confirm-body">
                <h3>Rubah Status Cabang?</h3>
                <p>Apakah Anda yakin ingin merubah status <strong id="targetBranchName">Cabang Ini</strong>?</p>
                <span class="confirm-notice">status Cabang yang dirubah akan mempengaruhi para ustadz/h yang bersangkutan dengan Cabang ini.</span>
            </div>
            <div class="confirm-footer">
                <button type="button" class="btn-cancel-confirm" id="btnCancelDeactivate">Batal</button>
                <a href="#" id="btnConfirmDeactivate" class="btn-deactivate-action">
                    <i class="fa-solid fa-power-off"></i> Ya, ubah status
                </a>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginal0681b545d180d4f9d8ad2ed4614031e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0681b545d180d4f9d8ad2ed4614031e2 = $attributes; } ?>
<?php $component = App\View\Components\Warning::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('warning'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Warning::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0681b545d180d4f9d8ad2ed4614031e2)): ?>
<?php $attributes = $__attributesOriginal0681b545d180d4f9d8ad2ed4614031e2; ?>
<?php unset($__attributesOriginal0681b545d180d4f9d8ad2ed4614031e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0681b545d180d4f9d8ad2ed4614031e2)): ?>
<?php $component = $__componentOriginal0681b545d180d4f9d8ad2ed4614031e2; ?>
<?php unset($__componentOriginal0681b545d180d4f9d8ad2ed4614031e2); ?>
<?php endif; ?>
    <!-- JAVASCRIPT INTERAKSI MODAL -->
    <script>
        // Modal Tambah Cabang
        const btnOpenModal = document.getElementById('btnOpenModal');
        const btnCloseModal = document.getElementById('btnCloseModal');
        const btnCancelModal = document.getElementById('btnCancelModal');
        const modalBranch = document.getElementById('modalBranch');
        const formAddBranch = document.getElementById('formAddBranch');
        const namaCabangInput = document.getElementById('namaCabang');

        // Modal Nonaktifkan
        const modalDeactivate = document.getElementById('modalDeactivate');
        const btnCancelDeactivate = document.getElementById('btnCancelDeactivate');
        const btnConfirmDeactivate = document.getElementById('btnConfirmDeactivate');
        const targetBranchName = document.getElementById('targetBranchName');
        const btnDeactivateTriggers = document.querySelectorAll('.btn-deactivate-trigger');

        const tombol_edit = document.querySelectorAll(".edit")

        // Buka Modal Tambah
        btnOpenModal.addEventListener('click', () => {
            modalBranch.classList.add('active');
            namaCabangInput.focus();
        });

        // Tutup Modal Tambah
        const closeModal = () => {
            modalBranch.classList.remove('active');
            formAddBranch.reset();
        };

        btnCloseModal.addEventListener('click', closeModal);
        btnCancelModal.addEventListener('click', closeModal);

        modalBranch.addEventListener('click', (e) => {
            if (e.target === modalBranch) closeModal();
        });

        // Event Modal Konfirmasi Nonaktifkan
        btnDeactivateTriggers.forEach((button) => {
            button.addEventListener('click', (e) => {
                const row = e.target.closest('tr');
                const branchId = row.querySelector('.branch-id').value;
                const branchName = row.querySelector('.branch-name').innerText;

                // Set nama cabang di teks modal & atur URL redirect
                targetBranchName.innerText = `"${branchName}"`;
                btnConfirmDeactivate.href = "/gr/nkt/" + branchId;

                // Tampilkan modal
                modalDeactivate.classList.add('active');
            });
        });

        // Tutup Modal Nonaktifkan
        const closeDeactivateModal = () => {
            modalDeactivate.classList.remove('active');
        };

        btnCancelDeactivate.addEventListener('click', closeDeactivateModal);

        modalDeactivate.addEventListener('click', (e) => {
            if (e.target === modalDeactivate) closeDeactivateModal();
        });

        tombol_edit.forEach((item) => {
            item.addEventListener('click',(e) => {
                const row = e.target.closest("tr");
                window.location.href = "/gr/sta/" + row.querySelector('.branch-id').value;
            })
        })
    </script>
</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/guru/a/tambah_cabang.blade.php ENDPATH**/ ?>