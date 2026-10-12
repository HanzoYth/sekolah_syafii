<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Kenaikan Kelas & Kelulusan','pageTitle' => 'Kenaikan Kelas & Kelulusan','pageDescription' => 'Pindahkan siswa ke kelas tingkat selanjutnya atau tetapkan kelulusan secara massal.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kenaikan Kelas & Kelulusan','pageTitle' => 'Kenaikan Kelas & Kelulusan','pageDescription' => 'Pindahkan siswa ke kelas tingkat selanjutnya atau tetapkan kelulusan secara massal.']); ?>
    
    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin-bottom: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px;">
            <div style="font-size: 18px; font-weight: bold; color: #1e293b; display: flex; align-items: center; gap: 15px;">
                <span><i class="fa-solid fa-graduation-cap" style="color: #0d5c3a;"></i> Kenaikan Kelas & Kelulusan</span>
            </div>
            
            <form action="" method="GET" style="display: flex; align-items: center;">
                <input type="hidden" name="kelas_id" value="<?php echo e($kelas_id ?? ''); ?>">
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

        <form method="GET" action="/sk/kenaikan-kelas" style="display: flex; gap: 15px; align-items: flex-end;">
            <input type="hidden" name="sekolah_id" value="<?php echo e($sekolah_id ?? ''); ?>">
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Pilih Kelas Asal</label>
                <select name="kelas_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Rombongan Belajar --</option>
                    <?php $__currentLoopData = $data_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k->id); ?>" <?php echo e($kelas_id == $k->id ? 'selected' : ''); ?>><?php echo e($k->nama_ruang); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <button type="submit" style="padding: 10px 20px; border: none; background: #3875c5; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-filter"></i> Tampilkan
            </button>
        </form>
    </div>

    <?php if($kelas_id): ?>
        <?php if($siswa->count() > 0): ?>
            <form method="POST" action="/sk/proses-kenaikan-kelas">
                <?php echo csrf_field(); ?>
                <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 20px; display: flex; gap: 20px; align-items: flex-end;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px;">Aksi Eksekusi</label>
                        <select name="aksi" id="aksi-select" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" onchange="toggleKelasTujuan()">
                            <option value="naik">Naik / Pindah Kelas</option>
                            <option value="lulus">Lulus (Alumni)</option>
                        </select>
                    </div>
                    
                    <div style="flex: 1;" id="kelas-tujuan-wrapper">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px;">Pilih Kelas Tujuan</label>
                        <select name="kelas_tujuan" id="kelas-tujuan" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                            <option value="">-- Pilih Kelas --</option>
                            <?php $__currentLoopData = $data_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($k->id != $kelas_id): ?>
                                    <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama_ruang); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div>
                        <?php if (isset($component)) { $__componentOriginale6e6f7a66e97b67f13b8594a97b4f4e6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale6e6f7a66e97b67f13b8594a97b4f4e6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.button','data' => ['type' => 'submit','icon' => 'fa-solid fa-paper-plane']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','icon' => 'fa-solid fa-paper-plane']); ?>Proses Terpilih <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale6e6f7a66e97b67f13b8594a97b4f4e6)): ?>
<?php $attributes = $__attributesOriginale6e6f7a66e97b67f13b8594a97b4f4e6; ?>
<?php unset($__attributesOriginale6e6f7a66e97b67f13b8594a97b4f4e6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale6e6f7a66e97b67f13b8594a97b4f4e6)): ?>
<?php $component = $__componentOriginale6e6f7a66e97b67f13b8594a97b4f4e6; ?>
<?php unset($__componentOriginale6e6f7a66e97b67f13b8594a97b4f4e6); ?>
<?php endif; ?>
                    </div>
                </div>

                <?php
                    $tableHeaders = ['Pilih', 'NIS', 'Nama Siswa', 'Gender', 'Status'];
                ?>
                <?php if (isset($component)) { $__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.table','data' => ['headers' => $tableHeaders]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableHeaders)]); ?>
                    <tr>
                        <td colspan="5" style="background: #f1f5f9; padding: 10px 16px;">
                            <label style="cursor: pointer; font-weight: bold; display: flex; align-items: center; gap: 10px;">
                                <input type="checkbox" id="check-all" onclick="toggleCheckAll()" style="width: 18px; height: 18px;">
                                Pilih Semua Siswa di Bawah
                            </label>
                        </td>
                    </tr>
                    <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="width: 50px; text-align: center;">
                            <input type="checkbox" name="siswa_id[]" value="<?php echo e($s->id); ?>" class="check-siswa" style="width: 18px; height: 18px;">
                        </td>
                        <td><?php echo e($s->nis); ?></td>
                        <td><strong><?php echo e($s->nama); ?></strong></td>
                        <td><?php echo e($s->gender == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                        <td><span style="background:#dcfce7; color:#15803d; padding:4px 8px; border-radius:4px; font-size:12px;">Aktif</span></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            </form>
            
            <script>
                function toggleCheckAll() {
                    const checkAll = document.getElementById('check-all');
                    const checkboxes = document.querySelectorAll('.check-siswa');
                    checkboxes.forEach(cb => cb.checked = checkAll.checked);
                }
                
                function toggleKelasTujuan() {
                    const aksi = document.getElementById('aksi-select').value;
                    const wrapper = document.getElementById('kelas-tujuan-wrapper');
                    const select = document.getElementById('kelas-tujuan');
                    
                    if (aksi === 'lulus') {
                        wrapper.style.display = 'none';
                        select.removeAttribute('required');
                    } else {
                        wrapper.style.display = 'block';
                        select.setAttribute('required', 'required');
                    }
                }
                // Run on load
                toggleKelasTujuan();
            </script>
        <?php else: ?>
            <div style="text-align: center; padding: 40px; color: #64748b; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px;">
                <i class="fa-solid fa-folder-open" style="font-size: 32px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
                Tidak ada siswa aktif yang ditemukan di kelas ini.
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div style="text-align: center; padding: 40px; color: #64748b; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px;">
            <i class="fa-solid fa-folder-open" style="font-size: 32px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
            Silakan pilih kelas asal terlebih dahulu dari menu *dropdown* di atas.
        </div>
    <?php endif; ?>
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




<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/admin/kenaikanKelas.blade.php ENDPATH**/ ?>