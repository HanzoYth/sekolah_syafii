<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Laporan Kehadiran Mengajar Guru','description' => 'Pantau ketepatan waktu guru saat mengajar di kelas.','position' => 'Admin SIAKAD','initials' => 'AD']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Laporan Kehadiran Mengajar Guru','description' => 'Pantau ketepatan waktu guru saat mengajar di kelas.','position' => 'Admin SIAKAD','initials' => 'AD']); ?>

    <div style="padding: 24px; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; margin-top: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <div style="font-size: 18px; font-weight: bold; color: #1e293b; display: flex; align-items: center; gap: 10px;">
                <div style="width: 40px; height: 40px; border-radius: 8px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                Data Kehadiran Guru
            </div>

            <form method="GET" style="display: flex; gap: 10px; align-items: center;">
                <label for="tanggal" style="font-size: 14px; font-weight: 500; color: #475569;">Pilih Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" value="<?php echo e($tanggal); ?>" style="padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #334155;">
                <button type="submit" style="padding: 8px 16px; background: #177455; color: #fff; border: none; border-radius: 6px; font-weight: 500; cursor: pointer; transition: background 0.2s;">
                    Filter
                </button>
            </form>
        </div>

        <?php
            $tableHeaders = ['No', 'Guru', 'Mata Pelajaran', 'Kelas', 'Jam', 'Waktu Masuk', 'Status'];
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
            <?php if(count($absensi_guru) > 0): ?>
                <?php $__currentLoopData = $absensi_guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $absen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="text-align: center;"><?php echo e($loop->iteration); ?></td>
                    <td><strong><?php echo e($absen->guru->nama); ?></strong></td>
                    <td><?php echo e($absen->jadwal->mapel->nama_pelajaran ?? '-'); ?></td>
                    <td><?php echo e($absen->jadwal->kelas->nama_ruang ?? '-'); ?></td>
                    <td><?php echo e($absen->jadwal->jam_pelajaran->jam_mulai ?? '-'); ?> - <?php echo e($absen->jadwal->jam_pelajaran->jam_selesai ?? '-'); ?></td>
                    <td><?php echo e($absen->jam_masuk); ?></td>
                    <td>
                        <?php if($absen->status == 'tepat_waktu'): ?>
                            <span style="display: inline-flex; align-items: center; gap: 4px; background:#dcfce7; color:#166534; padding:4px 10px; border-radius:20px; font-size:12px; font-weight: 600;">
                                <i class="fa-solid fa-circle-check"></i> Tepat Waktu
                            </span>
                        <?php elseif($absen->status == 'terlambat'): ?>
                            <span style="display: inline-flex; align-items: center; gap: 4px; background:#fef3c7; color:#b45309; padding:4px 10px; border-radius:20px; font-size:12px; font-weight: 600;">
                                <i class="fa-solid fa-clock-rotate-left"></i> Terlambat
                            </span>
                        <?php else: ?>
                            <span style="display: inline-flex; align-items: center; gap: 4px; background:#fee2e2; color:#b91c1c; padding:4px 10px; border-radius:20px; font-size:12px; font-weight: 600;">
                                <i class="fa-solid fa-circle-xmark"></i> Alpa
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px 20px; color: #64748b;">
                        <i class="fa-solid fa-folder-open" style="font-size: 32px; color: #cbd5e1; margin-bottom: 12px; display: block;"></i>
                        Belum ada data kehadiran guru pada tanggal ini.
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/admin/laporanAbsensiGuru.blade.php ENDPATH**/ ?>