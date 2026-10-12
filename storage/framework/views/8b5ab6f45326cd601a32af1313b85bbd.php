<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Pembagian Kelas Siswa','description' => 'Atur penempatan siswa ke dalam ruang kelas masing-masing.','position' => 'Administrator','initials' => 'AD']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pembagian Kelas Siswa','description' => 'Atur penempatan siswa ke dalam ruang kelas masing-masing.','position' => 'Administrator','initials' => 'AD']); ?>

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin-bottom: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px;">
            <div style="font-size: 18px; font-weight: bold; color: #1e293b; display: flex; align-items: center; gap: 15px;">
                <span><i class="fa-solid fa-users-cog"></i> Pembagian Kelas</span>
                <form action="" method="GET" style="display: flex; align-items: center;">
                    <input type="hidden" name="kelas_id" value="<?php echo e($kelas_id); ?>">
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
        </div>

        <form method="GET" action="/sk/pembagian-kelas" style="display: flex; gap: 15px; align-items: flex-end;">
            <input type="hidden" name="sekolah_id" value="<?php echo e($sekolah_id ?? ''); ?>">
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Pilih Ruang Kelas</label>
                <select name="kelas_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Kelas --</option>
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
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
        
        <!-- KOLOM KIRI: SISWA BELUM ADA KELAS -->
        <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <div style="font-size: 16px; font-weight: bold; color: #b45309; margin-bottom: 15px; border-bottom: 2px solid #fef3c7; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa-solid fa-users-slash"></i> Belum Memiliki Kelas</span>
                <span style="background: #fef3c7; color: #b45309; padding: 2px 8px; border-radius: 12px; font-size: 12px;"><?php echo e(count($siswa_belum_ada_kelas)); ?> Siswa</span>
            </div>

            <form action="/sk/simpan-pembagian-kelas" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="kelas_id" value="<?php echo e($kelas_id); ?>">
                
                <div style="max-height: 400px; overflow-y: auto; margin-bottom: 15px; border: 1px solid #e2e8f0; border-radius: 8px;">
                    <?php if(count($siswa_belum_ada_kelas) > 0): ?>
                        <?php $__currentLoopData = $siswa_belum_ada_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label style="display: flex; align-items: center; gap: 12px; padding: 12px; border-bottom: 1px solid #f1f5f9; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <input type="checkbox" name="siswa_ids[]" value="<?php echo e($s->id); ?>" style="width: 18px; height: 18px; accent-color: #166534;">
                                <div>
                                    <strong style="display: block; color: #1e293b;"><?php echo e($s->nama); ?></strong>
                                    <span style="font-size: 12px; color: #64748b;">NIS: <?php echo e($s->nis); ?></span>
                                </div>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div style="padding: 30px; text-align: center; color: #94a3b8;">
                            <i class="fa-solid fa-check-circle" style="font-size: 24px; margin-bottom: 10px; color: #cbd5e1; display: block;"></i>
                            Semua siswa sudah masuk kelas.
                        </div>
                    <?php endif; ?>
                </div>

                <?php if(count($siswa_belum_ada_kelas) > 0): ?>
                    <button type="submit" style="width: 100%; padding: 12px; border: none; background: #177455; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Masukkan ke Kelas Ini
                    </button>
                <?php endif; ?>
            </form>
        </div>

        <!-- KOLOM KANAN: SISWA DI DALAM KELAS -->
        <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <div style="font-size: 16px; font-weight: bold; color: #1e293b; margin-bottom: 15px; border-bottom: 2px solid #dcfce7; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa-solid fa-users"></i> Anggota Kelas Saat Ini</span>
                <span style="background: #dcfce7; color: #166534; padding: 2px 8px; border-radius: 12px; font-size: 12px;"><?php echo e(count($siswa_di_kelas)); ?> Siswa</span>
            </div>

            <div style="max-height: 400px; overflow-y: auto; margin-bottom: 15px; border: 1px solid #e2e8f0; border-radius: 8px;">
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
                            <th style="width: 40px; text-align: center;">No</th>
                            <th>Siswa</th>
                            <th style="width: 60px; text-align: center;">Aksi</th>
                        </tr>
                     <?php $__env->endSlot(); ?>
                    
                    <?php if(count($siswa_di_kelas) > 0): ?>
                        <?php $__currentLoopData = $siswa_di_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="text-align: center;"><?php echo e($index + 1); ?></td>
                                <td>
                                    <strong style="display: block; color: #1e293b;"><?php echo e($s->nama); ?></strong>
                                    <span style="font-size: 12px; color: #64748b;">NIS: <?php echo e($s->nis); ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <a href="/sk/hapus-anggota-kelas/<?php echo e($s->id); ?>" style="display: inline-flex; background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; text-decoration: none; align-items: center; justify-content: center; transition: all 0.2s;" title="Keluarkan dari kelas">
                                        <i class="fa-solid fa-user-xmark"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 30px; color: #94a3b8;">
                                <i class="fa-solid fa-users-slash" style="font-size: 24px; margin-bottom: 10px; color: #cbd5e1; display: block;"></i>
                                Kelas ini masih kosong.
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
    </div>
    <?php else: ?>
        <div style="background: white; border-radius: 12px; padding: 40px; text-align: center; color: #64748b; border: 2px dashed #cbd5e1;">
            <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 15px; color: #94a3b8; display: block;"></i>
            Silakan pilih kelas terlebih dahulu untuk mengatur anggota kelas.
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



<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/admin/pembagianKelas.blade.php ENDPATH**/ ?>