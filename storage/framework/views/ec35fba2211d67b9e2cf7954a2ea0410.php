<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Jadwal Mengajar','description' => 'Kelola dan pantau agenda sesi pembelajaran Anda.','position' => 'Guru SIAKAD','initials' => 'GR']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Jadwal Mengajar','description' => 'Kelola dan pantau agenda sesi pembelajaran Anda.','position' => 'Guru SIAKAD','initials' => 'GR']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Jadwal Mengajar</span>
        </li>
     <?php $__env->endSlot(); ?>

    <!-- Top Summary Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                <i class="fa-solid fa-calendar-check text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Sesi Mengajar</p>
                <h3 class="text-2xl font-bold text-slate-800"><?php echo e(count($jadwal)); ?></h3>
                <p class="text-xs text-slate-400 mt-1">Jadwal tatap muka terdaftar</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <i class="fa-solid fa-chalkboard-user text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Kelas yang Diampu</p>
                <h3 class="text-2xl font-bold text-slate-800"><?php echo e($jadwal->pluck('kelas_id')->unique()->count()); ?></h3>
                <p class="text-xs text-slate-400 mt-1">Rombongan belajar aktif</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                <i class="fa-solid fa-book-open text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Mata Pelajaran</p>
                <h3 class="text-2xl font-bold text-slate-800"><?php echo e($jadwal->pluck('mapel_id')->unique()->count()); ?></h3>
                <p class="text-xs text-slate-400 mt-1">Bidang studi penugasan</p>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
            <div>
                <h3 class="text-base font-semibold text-slate-800">Daftar Jadwal Mengajar</h3>
                <p class="text-sm text-slate-500">Rincian hari, jam, kelas, dan mata pelajaran Anda</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                    <i class="fa-solid fa-clock mr-1.5 text-xs"></i> <?php echo e(count($jadwal)); ?> Sesi Terjadwal
                </span>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Hari</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Jam Pelajaran</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Ruangan</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if(count($jadwal) > 0): ?>
                        <?php $__currentLoopData = $jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-100 text-emerald-800 uppercase tracking-wide">
                                        <?php echo e(ucfirst($j->hari)); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2 text-sm text-slate-700">
                                        <i class="fa-regular fa-clock text-slate-400 text-xs"></i>
                                        <span class="font-medium"><?php echo e(substr($j->jam_pelajaran->jam_mulai ?? '-', 0, 5)); ?> - <?php echo e(substr($j->jam_pelajaran->jam_selesai ?? '-', 0, 5)); ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                        <i class="fa-solid fa-users text-[10px] mr-1.5"></i> <?php echo e($j->kelas->nama_ruang ?? ($j->kelas->nama_kelas ?? '-')); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-slate-800"><?php echo e($j->mata_pelajaran->nama_mapel ?? '-'); ?></div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    <i class="fa-solid fa-door-open text-slate-400 mr-1 text-xs"></i> <?php echo e($j->kelas->nama_ruang ?? ($j->kelas->nama_kelas ?? '-')); ?>

                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="/sk/ass" class="text-xs font-semibold px-2.5 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors">
                                            Absen
                                        </a>
                                        <a href="/sk/input-nilai-detail/<?php echo e($j->id); ?>" class="text-xs font-semibold px-2.5 py-1.5 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 transition-colors">
                                            Nilai
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-folder-open text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-medium text-slate-700">Belum Ada Jadwal Mengajar</h4>
                                <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Jadwal mengajar belum diatur atau Anda belum ditugaskan ke mata pelajaran pada rombel aktif.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
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