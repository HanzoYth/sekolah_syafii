<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Data Siswa Wali Kelas','description' => 'Daftar siswa yang berada di bawah perwalian Anda.','position' => 'Guru Wali Kelas','initials' => 'GR']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Siswa Wali Kelas','description' => 'Daftar siswa yang berada di bawah perwalian Anda.','position' => 'Guru Wali Kelas','initials' => 'GR']); ?>

    <div style="padding: 24px; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; margin-top: 20px;">
        <?php if($wallas): ?>
            <div style="font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #1e293b; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px; display: flex; align-items: center; gap: 10px;">
                <div style="width: 40px; height: 40px; border-radius: 8px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-users-rectangle"></i>
                </div>
                Rombongan Belajar: <?php echo e($wallas->ruangKelas->nama_ruang ?? '-'); ?>

            </div>
            
            <?php if (isset($component)) { $__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.table','data' => ['headers' => ['No', 'NIS', 'Nama Lengkap', 'Jenis Kelamin', 'Status']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['No', 'NIS', 'Nama Lengkap', 'Jenis Kelamin', 'Status'])]); ?>
                <?php if(count($siswa) > 0): ?>
                    <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="text-align: center;"><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($s->nis); ?></td>
                        <td><strong><?php echo e($s->nama); ?></strong></td>
                        <td><?php echo e($s->gender == 'p' ? 'Perempuan' : 'Laki-laki'); ?></td>
                        <td style="text-align: center;">
                            <span style="display: inline-flex; align-items: center; gap: 4px; background:#dcfce7; color:#166534; padding:4px 10px; border-radius:20px; font-size:12px; font-weight: 600;">
                                <i class="fa-solid fa-circle-check"></i> Aktif
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px 20px; color: #64748b;">
                            <i class="fa-solid fa-folder-open" style="font-size: 32px; color: #cbd5e1; margin-bottom: 12px; display: block;"></i>
                            Belum ada data siswa di kelas ini.
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
            <div style="font-size: 18px; font-weight: bold; margin: 40px 0 20px; color: #1e293b; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px; display: flex; align-items: center; gap: 10px;">
                <div style="width: 40px; height: 40px; border-radius: 8px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-calendar-week"></i>
                </div>
                Jadwal Mengajar Kelas
            </div>

            <?php $__currentLoopData = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($jadwal_mingguan[$hari]) && $jadwal_mingguan[$hari]->count() > 0): ?>
                    <h4 style="margin-top: 20px; color: #334155; font-size: 16px;"><i class="fa-solid fa-calendar-day" style="color: #177455; margin-right: 8px;"></i> Hari <?php echo e(ucfirst($hari)); ?></h4>
                    <?php if (isset($component)) { $__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.table','data' => ['headers' => ['Jam', 'Waktu', 'Mata Pelajaran', 'Guru Pengajar']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Jam', 'Waktu', 'Mata Pelajaran', 'Guru Pengajar'])]); ?>
                        <?php $__currentLoopData = $jadwal_mingguan[$hari]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($j->jam_pelajaran->nama_jam); ?></td>
                                <td><?php echo e(substr($j->jam_pelajaran->jam_mulai, 0, 5)); ?> - <?php echo e(substr($j->jam_pelajaran->jam_selesai, 0, 5)); ?></td>
                                <td><strong><?php echo e($j->mata_pelajaran->nama_pelajaran); ?></strong></td>
                                <td><?php echo e($j->guru->nama); ?></td>
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
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php else: ?>
            <div style="text-align: center; padding: 40px; color: #64748b; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px;">
                <i class="fa-solid fa-ban" style="font-size: 32px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
                Anda saat ini tidak ditugaskan sebagai Wali Kelas.
            </div>
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/guru/dataWaliKelas.blade.php ENDPATH**/ ?>