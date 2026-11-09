<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Profil Pendidik','description' => 'Tinjau informasi kepegawaian, penugasan akademik, dan data pribadi Anda yang terdaftar pada SIAKAD.','position' => 'Guru SIAKAD','initials' => 'GR']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Profil Pendidik','description' => 'Tinjau informasi kepegawaian, penugasan akademik, dan data pribadi Anda yang terdaftar pada SIAKAD.','position' => 'Guru SIAKAD','initials' => 'GR']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Profil Guru</span>
        </li>
     <?php $__env->endSlot(); ?>

    <!-- Profile Hero Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 sm:p-8 mb-8 flex flex-col sm:flex-row items-center sm:items-start gap-6">
        <div class="w-28 h-28 rounded-2xl overflow-hidden bg-emerald-50 border-4 border-white shadow-md flex-shrink-0 flex items-center justify-center text-emerald-600 text-4xl">
            <?php if(!empty($guru->url_foto)): ?>
                <img src="<?php echo e(asset('storage/' . $guru->url_foto)); ?>" alt="<?php echo e($guru->nama ?? 'Guru'); ?>" class="w-full h-full object-cover">
            <?php else: ?>
                <i class="fa-solid fa-user-tie"></i>
            <?php endif; ?>
        </div>

        <div class="flex-1 text-center sm:text-left">
            <span class="text-[11px] font-bold uppercase tracking-widest text-emerald-600 block mb-1">Tenaga Pendidik SIAKAD</span>
            <h2 class="text-2xl font-bold text-slate-800"><?php echo e($guru->nama ?? auth()->user()->name ?? 'Guru SIAKAD'); ?></h2>
            <p class="text-sm text-slate-500 font-mono mt-1">
                <i class="fa-solid fa-id-badge text-slate-400 mr-1.5"></i> NIG: <?php echo e($guru->nig ?? '-'); ?>

            </p>

            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2.5 mt-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                    <i class="fa-solid fa-circle-check text-[10px]"></i> Pendidik Aktif
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                    <i class="fa-solid fa-chalkboard-user text-[10px]"></i>
                    <?php echo e(($guru && $guru->guru_tetap) ? 'Guru Tetap' : (($guru && $guru->guru_honor) ? 'Guru Honor' : 'Guru Pengajar')); ?>

                </span>
                <?php if(isset($wallas) && $wallas): ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                        <i class="fa-solid fa-user-graduate text-[10px]"></i>
                        Wali Kelas <?php echo e($wallas->ruangKelas->nama_ruang ?? 'Aktif'); ?>

                    </span>
                <?php endif; ?>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                    <i class="fa-solid fa-clock text-[10px] text-slate-500"></i>
                    <?php echo e($total_jadwal ?? 0); ?> Sesi Mengajar / Minggu
                </span>
            </div>
        </div>
    </div>

    <!-- Detail Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Identitas Pribadi -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-800">Identitas & Data Pribadi</h3>
                    <p class="text-xs text-slate-500">Informasi biodata pendidik yang tercatat di pangkalan data sekolah</p>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Nama Lengkap</span>
                    <p class="font-bold text-slate-800"><?php echo e($guru->nama ?? '-'); ?></p>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Nomor Induk Guru (NIG)</span>
                    <p class="font-mono font-semibold text-slate-700"><?php echo e($guru->nig ?? '-'); ?></p>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Jenis Kelamin</span>
                    <p class="font-semibold text-slate-700"><?php echo e(strtolower($guru->gender ?? '') == 'p' ? 'Perempuan' : 'Laki-laki'); ?></p>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Pendidikan Terakhir</span>
                    <p class="font-semibold text-slate-700"><?php echo e(strtoupper($guru->pendidikan_terakhir ?? '-')); ?></p>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Tempat, Tanggal Lahir</span>
                    <p class="font-semibold text-slate-700">
                        <?php echo e($guru->tempat_lahir ?? '-'); ?>, <?php echo e(!empty($guru->tanggal_lahir) ? \Carbon\Carbon::parse($guru->tanggal_lahir)->translatedFormat('d F Y') : '-'); ?>

                    </p>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Agama</span>
                    <p class="font-semibold text-slate-700"><?php echo e($guru->agama ?? 'Islam'); ?></p>
                </div>
                <div class="sm:col-span-2 pt-2 border-t border-slate-100">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Alamat Domisili</span>
                    <p class="font-medium text-slate-700 leading-relaxed"><?php echo e($guru->alamat ?? '-'); ?></p>
                </div>
            </div>
        </div>

        <!-- Status Kepegawaian & Akademik -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col justify-between">
            <div>
                <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Penugasan Akademik</h3>
                        <p class="text-xs text-slate-500">Status kepegawaian & perwalian</p>
                    </div>
                </div>

                <div class="p-6 divide-y divide-slate-100 text-sm">
                    <div class="py-3 flex items-center justify-between">
                        <span class="text-slate-500 font-medium">Status Kepegawaian</span>
                        <span class="font-bold text-slate-800"><?php echo e(($guru && $guru->guru_tetap) ? 'Guru Tetap' : (($guru && $guru->guru_honor) ? 'Guru Honor' : 'Tenaga Pendidik')); ?></span>
                    </div>
                    <div class="py-3 flex items-center justify-between">
                        <span class="text-slate-500 font-medium">Tugas Wali Kelas</span>
                        <span class="font-bold text-emerald-700"><?php echo e((isset($wallas) && $wallas && $wallas->ruangKelas) ? 'Kelas ' . $wallas->ruangKelas->nama_ruang : 'Tidak Ada'); ?></span>
                    </div>
                    <div class="py-3 flex items-center justify-between">
                        <span class="text-slate-500 font-medium">Beban Mengajar</span>
                        <span class="font-bold text-slate-800"><?php echo e($total_jadwal ?? 0); ?> Sesi / Minggu</span>
                    </div>
                    <div class="py-3 flex items-center justify-between">
                        <span class="text-slate-500 font-medium">Unit Sekolah</span>
                        <span class="font-bold text-slate-800"><?php echo e($guru->getSekolah->jenis ?? '-'); ?></span>
                    </div>
                    <div class="py-3 flex items-center justify-between">
                        <span class="text-slate-500 font-medium">Cabang</span>
                        <span class="font-bold text-slate-800"><?php echo e($guru->getCabang->nama_cabang ?? '-'); ?></span>
                    </div>
                </div>
            </div>

            <div class="p-4 m-4 rounded-xl bg-slate-50 border border-slate-200 flex items-start gap-3">
                <i class="fa-solid fa-shield-halved text-emerald-600 mt-0.5"></i>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Data kepegawaian dikelola terpusat oleh Admin SIAKAD. Hubungi bagian Tata Usaha apabila terdapat perubahan biodata.
                </p>
            </div>
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/guru/profilGuru.blade.php ENDPATH**/ ?>