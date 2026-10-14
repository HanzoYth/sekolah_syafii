<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Cetak Rapor Siswa','description' => 'Kelola dan cetak dokumen hasil capaian belajar siswa kelas perwalian Anda.','position' => 'Guru Wali Kelas','initials' => 'GR']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Cetak Rapor Siswa','description' => 'Kelola dan cetak dokumen hasil capaian belajar siswa kelas perwalian Anda.','position' => 'Guru Wali Kelas','initials' => 'GR']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Cetak Rapor Siswa</span>
        </li>
     <?php $__env->endSlot(); ?>

    <!-- Tab Switcher: Manajemen Nilai vs Cetak Rapor -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200">
            <a href="/sk/rapor-walas?tab=nilai" class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-600 hover:text-slate-900 flex items-center gap-2 transition-all">
                <i class="fa-solid fa-sliders"></i> Manajemen & Leger Nilai Kelas
            </a>
            <a href="/sk/rapor-walas" class="px-4 py-2 rounded-lg text-xs font-bold bg-white text-emerald-700 shadow-sm border border-slate-200/80 flex items-center gap-2 transition-all">
                <i class="fa-solid fa-file-contract"></i> Cetak Rapor Siswa
            </a>
        </div>

        <a href="/sk/rapor-walas?tab=nilai" class="inline-flex items-center px-3.5 py-2 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-bold transition-colors">
            <i class="fa-solid fa-pen-to-square mr-1.5"></i> Kelola Nilai dari Guru Pengajar
        </a>
    </div>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-violet-50 text-violet-600 rounded-lg">
                <i class="fa-solid fa-school text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Kelas Perwalian</p>
                <h3 class="text-2xl font-bold text-slate-800"><?php echo e($wallas->ruangKelas->nama_ruang ?? 'Kelas'); ?></h3>
                <p class="text-xs text-slate-400 mt-1">Rombongan belajar binaan</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                <i class="fa-solid fa-file-circle-check text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Siswa Terdaftar</p>
                <h3 class="text-2xl font-bold text-slate-800"><?php echo e(count($siswa)); ?></h3>
                <p class="text-xs text-slate-400 mt-1">Berkas rapor siswa siap cetak</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <i class="fa-solid fa-print text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Progres Nilai Mapel</p>
                <h3 class="text-xl font-bold text-slate-800"><?php echo e($stats_nilai['mapel_sudah_input'] ?? 0); ?> / <?php echo e($stats_nilai['total_mapel'] ?? 0); ?> Mapel</h3>
                <p class="text-xs text-emerald-600 font-medium mt-1"><i class="fa-solid fa-circle-check text-[10px] mr-1"></i>Rata-rata Kelas: <?php echo e(number_format($stats_nilai['rata_kelas'] ?? 0, 1)); ?></p>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
            <div>
                <h3 class="text-base font-semibold text-slate-800">Daftar Siswa Kelas <?php echo e($wallas->ruangKelas->nama_ruang ?? 'Kelas'); ?></h3>
                <p class="text-sm text-slate-500">Pilih siswa untuk melihat pratinjau nilai dan mencetak lembar rapor</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                <i class="fa-solid fa-users mr-1.5 text-xs"></i> <?php echo e(count($siswa)); ?> Siswa
            </span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider w-16 text-center">No</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">NIS</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama Lengkap Siswa</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-center">Kelengkapan Nilai</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-center">Rata-Rata & Peringkat</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if(isset($leger_siswa) && count($leger_siswa) > 0): ?>
                        <?php $__currentLoopData = $leger_siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $s = $row->siswa; ?>
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="px-6 py-4 text-sm text-slate-500 text-center font-medium"><?php echo e($index + 1); ?></td>
                                <td class="px-6 py-4 text-sm font-mono text-slate-600"><?php echo e($s->nis ?? '-'); ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                            <?php echo e(substr($s->nama, 0, 2)); ?>

                                        </div>
                                        <span class="text-sm font-semibold text-slate-800"><?php echo e($s->nama); ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if(strtoupper($s->gender) == 'P' || strtolower($s->gender) == 'perempuan'): ?>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-50 text-rose-700 border border-rose-100">
                                            <i class="fa-solid fa-venus text-[10px] mr-1"></i> Perempuan
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                            <i class="fa-solid fa-mars text-[10px] mr-1"></i> Laki-laki
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold <?php echo e($row->mapel_terisi >= $row->total_mapel && $row->total_mapel > 0 ? 'bg-emerald-100 text-emerald-800' : ($row->mapel_terisi > 0 ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-600')); ?>">
                                        <?php echo e($row->mapel_terisi); ?> / <?php echo e($row->total_mapel); ?> Mapel
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <?php if($row->mapel_terisi > 0): ?>
                                        <span class="font-bold text-slate-800"><?php echo e(number_format($row->rata_rata, 1)); ?></span>
                                        <span class="ml-1.5 px-2 py-0.5 rounded text-[11px] font-bold bg-slate-100 text-slate-700">#<?php echo e($row->peringkat); ?></span>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400">Belum ada nilai</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="/sk/detail-rapor-walas/<?php echo e($s->id); ?>" class="inline-flex items-center px-3.5 py-1.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-xs font-semibold transition-colors shadow-sm">
                                        <i class="fa-solid fa-print mr-1.5"></i> Lihat & Cetak Rapor
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-users-slash text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-medium text-slate-700">Belum Ada Siswa</h4>
                                <p class="text-xs text-slate-400 mt-1">Belum ada data siswa di kelas perwalian ini.</p>
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/guru/raporWalas.blade.php ENDPATH**/ ?>