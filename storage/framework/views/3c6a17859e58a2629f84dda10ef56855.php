<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengajuan Guru</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Memanggil CSS Terpisah -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/guru/pengajuan.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="app-container">
        <!-- SPACE UNTUK SIDEBAR -->
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
        <!-- Silakan include/render komponen sidebar Anda di sini -->

        <!-- MAIN CONTENT AREA PENGAJUAN -->
        <main class="main-content">
            <div class="main-wrapper">
                
                <!-- TOPBAR HEADER -->
                <div class="topbar">
                    <div class="topbar-title">
                        <h2>Daftar Pengajuan Guru</h2>
                        <p>Kelola data permohonan izin dan sakit guru dengan mudah.</p>
                    </div>
                    <button class="btn btn-primary" onclick="openModal('modalTambah')">
                        <i class="fa-solid fa-plus"></i> Tambah Pengajuan
                    </button>
                </div>

                <!-- CARD TABLE PENGAJUAN -->
                <div class="card">
                    <div class="table-responsive">
                        <table class="table-pengajuan">
                            <thead>
                                <tr>
                                    <th>Tanggal Terbuat</th>
                                    <th>Konfirmasi</th>
                                    <th>Jenis Pengajuan</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $data_pengajuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $tanggal = Carbon\Carbon::parse($value->created_at)->translatedFormat("d M Y");
                                        $status_pengajuan = $value->status_pengajuan == "s"  ? "Sakit" : "Izin"; 
                                    ?>
                                    <tr>
                                        <td><?php echo e($tanggal); ?></td>
                                        <td>
                                            <?php if($value->konfirmasi == 'd'): ?>
                                                <span class="badge badge-success">Diterima</span>
                                            <?php elseif($value->konfirmasi == 't'): ?>
                                                <span class="badge badge-danger">Ditolak</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Belum di Konfirmasi</span>
                                            <?php endif; ?>
                                        </td>

                                        <?php if($status_pengajuan == "Sakit"): ?>
                                            <td><span class="badge badge-sakit">Sakit</span></td>
                                        <?php else: ?>
                                            <td><span class="badge badge-izin">Izin</span></td>
                                        <?php endif; ?>
                                        <td>
                                            <div class="action-group" style="justify-content: center;">
                                                <button class="btn btn-icon btn-view" title="Lihat Detail" onclick="openModalDetail('<?php echo e($tanggal); ?>','<?php echo e($status_pengajuan); ?>','<?php echo e($value->isi); ?>')">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <?php if($value->konfirmasi == 'b'): ?>
                                                    <button class="btn btn-icon btn-edit" title="Edit Pengajuan" onclick="openModalEdit('<?php echo e($value->id); ?>','<?php echo e($value->status_pengajuan); ?>','<?php echo e($value->isi); ?>')">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                <?php endif; ?>
                                                <button class="btn btn-icon btn-delete" title="Hapus Pengajuan" onclick="openModalDelete('<?php echo e($value->id); ?>')">
                                                    <i class="fa-solid fa-trash-can"></i>
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
       MODAL 1: TAMBAH PENGAJUAN
       ========================================================================== -->
    <div class="modal-overlay" id="modalTambah">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Tambah Pengajuan Guru</h3>
                <button class="btn-close" onclick="closeModal('modalTambah')">&times;</button>
            </div>
            <form action="/gr/tbpgjgr" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jenis_pengajuan">Jenis Pengajuan</label>
                        <select name="jenis_pengajuan" id="jenis_pengajuan" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Jenis Pengajuan --</option>
                            <option value="i">Izin</option>
                            <option value="s">Sakit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan / Alasan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Tuliskan alasan pengajuan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambah')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pengajuan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================================================
       MODAL 2: DETAIL PENGAJUAN (MATA)
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
       MODAL 3: EDIT PENGAJUAN
       ========================================================================== -->
    <div class="modal-overlay" id="modalEdit">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Edit Pengajuan Guru</h3>
                <button class="btn-close" onclick="closeModal('modalEdit')">&times;</button>
            </div>
            <form id="formEdit" action="/gr/edpgjgr" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" value="" id="id_pengajuan" name="id_pengajuan">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editJenis">Jenis Pengajuan</label>
                        <select name="jenis_pengajuan" id="editJenis" class="form-control" required>
                            <option value="i">Izin</option>
                            <option value="s">Sakit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editKeterangan">Keterangan / Alasan</label>
                        <textarea name="keterangan" id="editKeterangan" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalEdit')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Pengajuan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================================================
       MODAL 4: HAPUS PENGAJUAN
       ========================================================================== -->
    <div class="modal-overlay" id="modalHapus">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Hapus Pengajuan</h3>
                <button class="btn-close" onclick="closeModal('modalHapus')">&times;</button>
            </div>
            <form id="formHapus" method="GET">
                <?php echo csrf_field(); ?>
                <input type="hidden" value="" id="id_pengajuan" name="id_pengajuan">
                <div class="modal-body">
                    <p style="font-size: 0.95rem; color: #334155;">
                        Apakah Anda yakin ingin menghapus data pengajuan ini?.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalHapus')">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Data</button>
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
    <!-- SCRIPT POP-UP INTERACTIVE -->
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

        function openModalEdit(id,jenis, keterangan) {
            document.getElementById("id_pengajuan").value = parseInt(id);
            document.getElementById('editJenis').value = jenis;
            document.getElementById('editKeterangan').value = keterangan;
            openModal('modalEdit');
        }

        function openModalDelete(id) {
            document.getElementById("formHapus").action = `/gr/hppgjgr/${parseInt(id)}`
            openModal('modalHapus');
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal-overlay')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/guru/g/pengajuan.blade.php ENDPATH**/ ?>