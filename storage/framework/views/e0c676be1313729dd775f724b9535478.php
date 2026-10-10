<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Absensi Mata Pelajaran','description' => 'Kelola absensi siswa per mata pelajaran yang Anda ampu.','position' => 'Guru Pengajar','initials' => 'GP']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Absensi Mata Pelajaran','description' => 'Kelola absensi siswa per mata pelajaran yang Anda ampu.','position' => 'Guru Pengajar','initials' => 'GP']); ?>

    <style>
        .radio-group { display: flex; gap: 12px; }
        .radio-label { display: flex; align-items: center; gap: 4px; font-size: 14px; cursor: pointer; color: #475569; }
        .input-ket { width: 100%; padding: 6px 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; outline: none; transition: border-color 0.2s; }
        .input-ket:focus { border-color: #3875c5; }
        .recap-box { display: flex; gap: 16px; margin-bottom: 24px; flex-wrap: wrap; }
        .recap-item { flex: 1; min-width: 120px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; display: flex; align-items: center; gap: 15px; }
        .recap-item i { font-size: 24px; color: #94a3b8; }
        .recap-item div { display: flex; flex-direction: column; }
        .recap-item strong { font-size: 20px; color: #1e293b; }
        .recap-item span { font-size: 12px; color: #64748b; font-weight: 600; text-transform: uppercase; }
        
        .recap-item.hadir i { color: #16a34a; }
        .recap-item.sakit i { color: #eab308; }
        .recap-item.izin i { color: #3b82f6; }
        .recap-item.alpa i { color: #ef4444; }
    </style>

    <div style="background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); margin-top: 20px;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
            <div style="font-size: 16px; font-weight: bold; color: #1e293b; display: flex; align-items: center; gap: 10px;">
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #f3f4f6; color: #475569; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                Jadwal Mata Pelajaran Hari Ini
            </div>
            
            <form method="GET" action="/sk/ass" style="display: flex; gap: 10px; align-items: center;">
                <input type="date" name="tanggal" value="<?php echo e($tanggal); ?>" style="padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; font-family: inherit; color: #1e293b;">
                <select name="jadwal_id" style="padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    <option value="">-- Pilih Jadwal --</option>
                    <?php $__currentLoopData = $jadwal_hari_ini; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($j->id); ?>" <?php echo e($jadwal_id == $j->id ? "selected" : ""); ?>>
                            <?php echo e($j->mata_pelajaran->nama_pelajaran); ?> (Kelas <?php echo e($j->kelas->nama_kelas); ?>) - <?php echo e($j->jam_pelajaran->jam_mulai); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button type="submit" style="padding: 8px 16px; border: none; background: #f1f5f9; color: #334155; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px; transition: background 0.2s;">
                    Pilih
                </button>
            </form>
        </div>
        
        <?php if($jadwal_terpilih): ?>
        <div style="margin-bottom: 20px; padding: 16px; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
            <h4 style="margin: 0 0 10px 0; color: #334155;"><?php echo e($jadwal_terpilih->mata_pelajaran->nama_pelajaran); ?> - Kelas <?php echo e($jadwal_terpilih->kelas->nama_kelas); ?></h4>
            <p style="margin: 0; color: #64748b; font-size: 14px;">Waktu: <?php echo e($jadwal_terpilih->jam_pelajaran->jam_mulai); ?> s/d <?php echo e($jadwal_terpilih->jam_pelajaran->jam_selesai); ?></p>
        </div>

        <form action="/sk/simpan-absensi-mapel" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="tanggal" value="<?php echo e($tanggal); ?>">
            <input type="hidden" name="jadwal_id" value="<?php echo e($jadwal_id); ?>">
            
            <?php if (isset($component)) { $__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.table','data' => ['headers' => ['No', 'Nama Siswa', 'NIS', 'Status Kehadiran', 'Keterangan']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['No', 'Nama Siswa', 'NIS', 'Status Kehadiran', 'Keterangan'])]); ?>
                <?php if(count($siswa) > 0): ?>
                    <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $absen = $absensi_db[$s->id] ?? null;
                            $status = $absen ? $absen->status : "h"; 
                            $keterangan = $absen ? $absen->keterangan : "";
                        ?>
                    <tr>
                        <td style="text-align: center;"><?php echo e($index + 1); ?></td>
                        <td><strong><?php echo e($s->nama); ?></strong></td>
                        <td><?php echo e($s->nis); ?></td>
                        <td>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="absensi[<?php echo e($s->id); ?>][status]" value="h" <?php echo e($status == "h" ? "checked" : ""); ?>> Hadir
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="absensi[<?php echo e($s->id); ?>][status]" value="s" <?php echo e($status == "s" ? "checked" : ""); ?>> Sakit
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="absensi[<?php echo e($s->id); ?>][status]" value="i" <?php echo e($status == "i" ? "checked" : ""); ?>> Izin
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="absensi[<?php echo e($s->id); ?>][status]" value="a" <?php echo e($status == "a" ? "checked" : ""); ?>> Alpa
                                </label>
                            </div>
                        </td>
                        <td>
                            <input type="text" name="absensi[<?php echo e($s->id); ?>][keterangan]" value="<?php echo e($keterangan); ?>" class="input-ket" placeholder="Keterangan (opsional)...">
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
            
            <?php if(count($siswa) > 0): ?>
            <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                <button type="submit" style="padding: 10px 20px; border: none; background: #177455; color: white; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: background 0.2s;">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Absensi & Kehadiran Anda
                </button>
            </div>
            <?php endif; ?>
        </form>
        <?php else: ?>
        <div style="text-align: center; padding: 40px; color: #64748b; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px;">
            <i class="fa-solid fa-arrow-up" style="font-size: 32px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
            Pilih jadwal mata pelajaran terlebih dahulu.
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

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/guru/absensiMapel.blade.php ENDPATH**/ ?>