<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Jadwal Mengajar','description' => 'Jadwal mata pelajaran yang Anda ampu','position' => 'Guru SIAKAD','initials' => 'GR']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Jadwal Mengajar','description' => 'Jadwal mata pelajaran yang Anda ampu','position' => 'Guru SIAKAD','initials' => 'GR']); ?>

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #1e293b; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px;">
            <i class="fa-solid fa-calendar-week"></i> Jadwal Mengajar Anda
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
                    <th>Hari</th>
                    <th>Jam Pelajaran</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Ruangan</th>
                </tr>
             <?php $__env->endSlot(); ?>

            <?php if(count($jadwal) > 0): ?>
                <?php $__currentLoopData = $jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold;">
                                <?php echo e(ucfirst($j->hari)); ?>

                            </span>
                        </td>
                        <td><?php echo e($j->jam_pelajaran->jam_mulai ?? '-'); ?> - <?php echo e($j->jam_pelajaran->jam_selesai ?? '-'); ?></td>
                        <td>
                            <span style="background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold;">
                                <?php echo e($j->kelas->nama_ruang ?? ($j->kelas->nama_kelas ?? '-')); ?>

                            </span>
                        </td>
                        <td><strong><?php echo e($j->mata_pelajaran->nama_mapel ?? '-'); ?></strong></td>
                        <td><?php echo e($j->kelas->nama_ruang ?? ($j->kelas->nama_kelas ?? '-')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px;">
                        <i class="fa-solid fa-folder-open" style="font-size: 24px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                        Belum ada jadwal mengajar yang diatur untuk Anda.
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/guru/jadwalMengajar.blade.php ENDPATH**/ ?>