<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Kelola Kelas','description' => 'Buat dan manajemen ruang kelas untuk tahun ajaran berjalan.','position' => 'Administrator','initials' => 'AD']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kelola Kelas','description' => 'Buat dan manajemen ruang kelas untuk tahun ajaran berjalan.','position' => 'Administrator','initials' => 'AD']); ?>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Form Tambah Kelas -->
        <div class="lg:col-span-4" style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); align-self: start;">
            <div style="font-size: 18px; font-weight: bold; color: #1e293b; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px;">
                <i class="fa-solid fa-school"></i> Buat Kelas Baru
            </div>

            <form action="/sk/simpan-kelas" method="POST">
                <?php echo csrf_field(); ?>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Jenjang Sekolah</label>
                    <select name="tingkat_sekolah" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <option value="">Pilih Jenjang</option>
                        <option value="TK">Taman Kanak-kanak (TK)</option>
                        <option value="SD">Sekolah Dasar (SD)</option>
                        <option value="SMP">Sekolah Menengah Pertama (SMP)</option>
                    </select>
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Tingkat Kelas (Angka)</label>
                    <select name="no_kelas" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <option value="">Pilih Tingkat</option>
                        <option value="A">TK A</option>
                        <option value="B">TK B</option>
                        <?php for($i=1; $i<=9; $i++): ?>
                            <option value="<?php echo e($i); ?>">Kelas <?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div style="margin-bottom: 25px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nama / Tipe Pararel</label>
                    <input type="text" name="tipe_kelas" required placeholder="Contoh: UNGGULAN, REGULER, IPA 1" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;" autocomplete="off">
                </div>

                <button type="submit" style="width: 100%; padding: 12px; border: none; background: #177455; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Kelas
                </button>
            </form>
        </div>

        <!-- Tabel Daftar Kelas -->
        <div class="lg:col-span-8" style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <div style="font-size: 18px; font-weight: bold; color: #1e293b; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px;">
                <i class="fa-solid fa-list"></i> Daftar Ruang Kelas
            </div>

            <?php if (isset($component)) { $__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.table','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                 <?php $__env->slot('thead', null, []); ?> 
                    <tr>
                        <th style="width: 50px; text-align: center;">No</th>
                        <th>Nama Kelas</th>
                        <th style="width: 100px; text-align: center;">Aksi</th>
                    </tr>
                 <?php $__env->endSlot(); ?>

                <?php if(count($data_kelas) > 0): ?>
                    <?php $__currentLoopData = $data_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="text-align: center;"><?php echo e($index + 1); ?></td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 6px; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-chalkboard-user"></i>
                                    </div>
                                    <strong><?php echo e($k->nama_kelas); ?></strong>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <button onclick="deleteKelas(<?php echo e($k->id); ?>)" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Hapus Kelas">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center; padding: 40px; color: #64748b;">
                            <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                            Belum ada ruang kelas yang dibuat.
                        </td>
                    </tr>
                <?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880)): ?>
<?php $attributes = $__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880; ?>
<?php unset($__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880)): ?>
<?php $component = $__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880; ?>
<?php unset($__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880); ?>
<?php endif; ?>
        </div>
    </div>

    <!-- Modal Delete -->
    <?php if (isset($component)) { $__componentOriginale960230fd71228156fe70d1ba75c1455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960230fd71228156fe70d1ba75c1455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.modal','data' => ['id' => 'deleteModal','title' => 'Konfirmasi Hapus','icon' => 'fa-triangle-exclamation','iconColor' => '#b34d4d','iconBg' => '#f8e9e9']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'deleteModal','title' => 'Konfirmasi Hapus','icon' => 'fa-triangle-exclamation','iconColor' => '#b34d4d','iconBg' => '#f8e9e9']); ?>
        <p style="margin-bottom: 20px; color: #475569; line-height: 1.5;">Anda yakin ingin menghapus kelas ini? Menghapus kelas akan menghapus keterkaitan data lainnya seperti jadwal dan siswa.</p>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeModal('deleteModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
            <button type="button" id="btnConfirmDelete" style="padding: 10px 16px; border: none; background: #b34d4d; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Ya, Hapus</button>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $attributes = $__attributesOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__attributesOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $component = $__componentOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__componentOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>

    <script>
        function openModal(id) { document.getElementById(id).style.display = 'flex'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }
        
        let deleteIdTarget = null;
        function deleteKelas(id) {
            deleteIdTarget = id;
            openModal('deleteModal');
        }

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            if (deleteIdTarget) window.location.href = "/sk/hapus-kelas/" + deleteIdTarget;
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14)): ?>
<?php $attributes = $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14; ?>
<?php unset($__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14)): ?>
<?php $component = $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14; ?>
<?php unset($__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14); ?>
<?php endif; ?>



<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/admin/tambahKelas.blade.php ENDPATH**/ ?>