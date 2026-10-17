<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Kelola Mata Pelajaran','description' => 'Manajemen data mata pelajaran kurikulum','position' => 'Administrator','initials' => 'AD']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kelola Mata Pelajaran','description' => 'Manajemen data mata pelajaran kurikulum','position' => 'Administrator','initials' => 'AD']); ?>

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px; flex-wrap: wrap; gap: 14px;">
            <div style="font-size: 18px; font-weight: bold; color: #1e293b; display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                <span><i class="fa-solid fa-book"></i> Daftar Mata Pelajaran</span>
                <form action="" method="GET" style="display: flex; align-items: center;">
                    <div style="position: relative; display: flex; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 12px; gap: 8px;">
                        <i class="fa-solid fa-filter" style="color: #64748b; font-size: 14px;"></i>
                        <select name="sekolah_id" onchange="this.form.submit()" style="background: transparent; border: none; outline: none; font-size: 14px; color: #334155; font-weight: 600; cursor: pointer; padding-right: 8px;">
                            <option value="">Semua Jenjang</option>
                            <?php $__currentLoopData = $data_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($s->id); ?>" <?php echo e(($sekolah_id ?? '') == $s->id ? 'selected' : ''); ?>><?php echo e(strtoupper($s->jenis)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </form>
            </div>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <a href="/sk/bobot-penilaian" style="background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; padding: 10px 16px; border-radius: 8px; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.2s; font-size: 14px;">
                    <i class="fa-solid fa-sliders"></i> Atur Bobot & KKM
                </a>
                <button onclick="openModal('addModal')" style="background: #177455; color: white; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: background 0.2s; font-size: 14px;">
                    <i class="fa-solid fa-plus"></i> Tambah Mapel
                </button>
            </div>
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
                    <th style="width: 60px; text-align: center;">No.</th>
                    <th>Nama Mata Pelajaran</th>
                    <th style="width: 120px; text-align: center;">Standar KKM</th>
                    <th style="width: 150px; text-align: center;">Aksi</th>
                </tr>
             <?php $__env->endSlot(); ?>

            <?php if(count($data_mapel) > 0): ?>
                <?php $__currentLoopData = $data_mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="text-align: center;"><?php echo e($index + 1); ?></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: #f1f5f3; color: #64748b; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-book-open"></i>
                                </div>
                                <div>
                                    <strong style="display: block; color: #1e293b;"><?php echo e($m->nama_mapel); ?></strong>
                                    <span style="font-size: 12px; color: #64748b;">ID: MAPEL-<?php echo e(str_pad($m->id, 3, '0', STR_PAD_LEFT)); ?></span>
                                </div>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <span style="display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-size: 13px; background: #fef3c7; color: #92400e; border: 1px solid #fde68a;">
                                <?php echo e($m->kkm ?? 75); ?>

                            </span>
                        </td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 8px; justify-content: center;">
                                <button onclick="editMapel(<?php echo e($m->id); ?>, '<?php echo e(addslashes($m->nama_mapel)); ?>', '<?php echo e($m->sekolah_id); ?>', '<?php echo e($m->kkm ?? 75); ?>')" style="background: #e9f2ff; color: #3875c5; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button onclick="deleteMapel(<?php echo e($m->id); ?>, '<?php echo e(addslashes($m->nama_mapel)); ?>')" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Hapus">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center; padding: 40px; color: #64748b;">
                        <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                        Belum ada data mata pelajaran yang terdaftar.
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

    <!-- Modal Tambah -->
    <?php if (isset($component)) { $__componentOriginale960230fd71228156fe70d1ba75c1455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960230fd71228156fe70d1ba75c1455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.modal','data' => ['id' => 'addModal','title' => 'Tambah Mata Pelajaran','icon' => 'fa-book-medical','iconColor' => '#166534','iconBg' => '#dcfce7']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'addModal','title' => 'Tambah Mata Pelajaran','icon' => 'fa-book-medical','iconColor' => '#166534','iconBg' => '#dcfce7']); ?>
        <form action="/sk/simpan-mapel" method="POST">
            <?php echo csrf_field(); ?>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Jenjang Sekolah</label>
                <select name="sekolah_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Jenjang --</option>
                    <?php $__currentLoopData = $data_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s->id); ?>"><?php echo e(strtoupper($s->jenis)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" required placeholder="Contoh: Pendidikan Agama Islam" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;" autocomplete="off">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nilai KKM (Kriteria Ketuntasan Minimal)</label>
                <input type="number" name="kkm" value="75" min="0" max="100" required placeholder="Standar: 75" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                <small style="color: #64748b; font-size: 12px; margin-top: 4px; display: block;">Skala nilai 0 - 100 (Default: 75)</small>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('addModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #177455; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan Data</button>
            </div>
        </form>
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

    <!-- Modal Edit -->
    <?php if (isset($component)) { $__componentOriginale960230fd71228156fe70d1ba75c1455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960230fd71228156fe70d1ba75c1455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.modal','data' => ['id' => 'editModal','title' => 'Edit Mata Pelajaran','icon' => 'fa-pen-to-square','iconColor' => '#3875c5','iconBg' => '#e9f2ff']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'editModal','title' => 'Edit Mata Pelajaran','icon' => 'fa-pen-to-square','iconColor' => '#3875c5','iconBg' => '#e9f2ff']); ?>
        <form id="editForm" method="POST">
            <?php echo csrf_field(); ?>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Jenjang Sekolah</label>
                <select name="sekolah_id" id="editSekolah" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Jenjang --</option>
                    <?php $__currentLoopData = $data_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s->id); ?>"><?php echo e(strtoupper($s->jenis)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" id="editInput" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;" autocomplete="off">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nilai KKM (Kriteria Ketuntasan Minimal)</label>
                <input type="number" name="kkm" id="editKkm" min="0" max="100" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('editModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #3875c5; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan Perubahan</button>
            </div>
        </form>
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
        <p style="margin-bottom: 20px; color: #475569; line-height: 1.5;">Anda yakin ingin menghapus <strong id="deleteMapelName" style="color: #1e293b;"></strong>? Data yang dihapus tidak dapat dipulihkan.</p>
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
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }
        
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        function editMapel(id, nama, sekolah_id, kkm) {
            document.getElementById('editForm').action = "/sk/update-mapel/" + id;
            document.getElementById('editInput').value = nama;
            document.getElementById('editKkm').value = kkm || 75;
            if (sekolah_id) {
                document.getElementById('editSekolah').value = sekolah_id;
            } else {
                document.getElementById('editSekolah').value = "";
            }
            openModal('editModal');
        }

        let deleteIdTarget = null;
        function deleteMapel(id, nama) {
            deleteIdTarget = id;
            document.getElementById('deleteMapelName').textContent = nama;
            openModal('deleteModal');
        }

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            if (deleteIdTarget) {
                window.location.href = "/sk/hapus-mapel/" + deleteIdTarget;
            }
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



<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/admin/kelolaMapel.blade.php ENDPATH**/ ?>