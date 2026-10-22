<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Pengajuan Guru</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Memanggil CSS Terpisah -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/guru/kelola_pengajuan.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="app-container">
        <!-- SIDEBAR -->
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

        <!-- MAIN CONTENT AREA -->
        <main class="main-content">
            <div class="main-wrapper">
                
                <!-- TOPBAR HEADER -->
                <div class="topbar">
                    <div class="topbar-title">
                        <h2>Persetujuan Pengajuan Guru</h2>
                        <p>Kelola dan berikan persetujuan permohonan izin atau sakit guru.</p>
                    </div>
                </div>

                <!-- CARD TABLE PENGAJUAN -->
                <div class="card">
                    <div class="table-responsive">
                        <table class="table-pengajuan">
                            <thead>
                                <tr>
                                    <th>Nama Guru</th>
                                    <th>Tanggal Terbuat</th>
                                    <th>Status Konfirmasi</th>
                                    <th>Jenis Pengajuan</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $data_pengajuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $data_guru = App\Models\guru::where("id",$value->guru_id)->first()->nama;
                                        $tanggal = Carbon\Carbon::parse($value->created_at)->translatedFormat("d M Y");
                                        $status_pengajuan = $value->status_pengajuan == "s" ? "Sakit" : "Izin"; 
                                    ?>
                                    <tr>
                                        <td><?php echo e($data_guru); ?></td>
                                        <td><?php echo e($tanggal); ?></td>
                                        <td>
                                            <?php if($value->konfirmasi == 'd'): ?>
                                                <span class="badge badge-success">Diterima</span>
                                            <?php elseif($value->konfirmasi == 't'): ?>
                                                <span class="badge badge-danger">Ditolak</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($status_pengajuan == "Sakit"): ?>
                                                <span class="badge badge-sakit">Sakit</span>
                                            <?php else: ?>
                                                <span class="badge badge-izin">Izin</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="action-group" style="justify-content: center;">
                                                <!-- Tombol Detail -->
                                                <button class="btn btn-icon btn-view" title="Lihat Detail" onclick="openModalDetail('<?php echo e($tanggal); ?>','<?php echo e($status_pengajuan); ?>','<?php echo e($value->isi); ?>')">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                
                                                <!-- Tombol Terima -->
                                                <button class="btn btn-icon btn-accept" title="Terima Pengajuan" onclick="openModalApprove('<?php echo e($value->id); ?>')">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>

                                                <!-- Tombol Tolak -->
                                                <button class="btn btn-icon btn-reject" title="Tolak Pengajuan" onclick="openModalReject('<?php echo e($value->id); ?>')">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- ==========================================================================
        MODAL 1: DETAIL PENGAJUAN
    ========================================================================== -->
    <div class="modal-overlay" id="modalDetail">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Detail Pengajuan</h3>
                <button class="btn-close" onclick="closeModal('modalDetail')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-item">
                    <span class="detail-label">Tanggal Terbuat</span>
                    <span class="detail-value" id="detailTanggal">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Jenis Pengajuan</span>
                    <span class="detail-value" id="detailJenis">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Keterangan / Alasan</span>
                    <span class="detail-value" id="detailKeterangan" style="font-weight: 400; color: #475569;">-</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalDetail')">Tutup</button>
            </div>
        </div>
    </div>

    <!-- ==========================================================================
        MODAL 2: KONFIRMASI TERIMA
    ========================================================================== -->
    <div class="modal-overlay" id="modalApprove">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Terima Pengajuan</h3>
                <button class="btn-close" onclick="closeModal('modalApprove')">&times;</button>
            </div>
            <form id="formApprove" action="" method="GET">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <p style="font-size: 0.95rem; color: #334155;">
                        Apakah Anda yakin ingin <strong>menerima</strong> permohonan pengajuan ini?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalApprove')">Batal</button>
                    <button type="submit" class="btn btn-success">Ya, Terima</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================================================
        MODAL 3: KONFIRMASI TOLAK
    ========================================================================== -->
    <div class="modal-overlay" id="modalReject">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Tolak Pengajuan</h3>
                <button class="btn-close" onclick="closeModal('modalReject')">&times;</button>
            </div>
            <form id="formReject" action="" method="GET">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <p style="font-size: 0.95rem; color: #334155;">
                        Apakah Anda yakin ingin <strong>menolak</strong> permohonan pengajuan ini?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalReject')">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Pengajuan</button>
                </div>
            </form>
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
    <!-- SCRIPT INTERACTIVE -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        function openModalDetail(tanggal, jenis, keterangan) {
            document.getElementById('detailTanggal').innerText = tanggal;
            document.getElementById('detailJenis').innerText = jenis;
            document.getElementById('detailKeterangan').innerText = keterangan || '-';
            openModal('modalDetail');
        }

        function openModalApprove(id) {
            document.getElementById("formApprove").action = `/gr/acpggr/${id}`;
            openModal('modalApprove');
        }

        function openModalReject(id) {
            document.getElementById("formReject").action = `/gr/rjpggr/${id}`;
            openModal('modalReject');
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal-overlay')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>
</html><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\guru\a\kelola_pengajuan.blade.php ENDPATH**/ ?>