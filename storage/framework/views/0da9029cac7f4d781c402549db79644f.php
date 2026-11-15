<?php
    $isAdmin = session('role') === 'a';
    $initialAdminTab = ($isAdmin && in_array(request('tab'), ['pengesahan', 'kegiatan', 'template_prestasi']))
        ? request('tab')
        : 'kelas';
?>

<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => ''.e($isAdmin ? 'Manajemen Rapor Siswa' : 'Cetak & Evaluasi Rapor Santri').'','description' => ''.e($isAdmin ? 'Pusat manajemen rapor siswa, tanda tangan wali kelas, pengesahan kepala sekolah, program kegiatan, dan template prestasi.' : 'Kelola rekap nilai, catatan wali kelas, prestasi, dan cetak dokumen rapor santri.').'','position' => ''.e($isAdmin ? 'Administrator SIAKAD' : 'Guru Wali Kelas').'','initials' => ''.e($isAdmin ? 'AD' : 'GR').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($isAdmin ? 'Manajemen Rapor Siswa' : 'Cetak & Evaluasi Rapor Santri').'','description' => ''.e($isAdmin ? 'Pusat manajemen rapor siswa, tanda tangan wali kelas, pengesahan kepala sekolah, program kegiatan, dan template prestasi.' : 'Kelola rekap nilai, catatan wali kelas, prestasi, dan cetak dokumen rapor santri.').'','position' => ''.e($isAdmin ? 'Administrator SIAKAD' : 'Guru Wali Kelas').'','initials' => ''.e($isAdmin ? 'AD' : 'GR').'']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="<?php echo e($isAdmin ? '/sk/ds' : '/sk/dsg'); ?>" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium"><?php echo e($isAdmin ? 'Rapor Siswa' : 'Cetak Rapor'); ?></span>
        </li>
     <?php $__env->endSlot(); ?>

    <?php if(session('success')): ?>
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-500 text-white flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-wider text-emerald-900">Berhasil Disimpan</h5>
                    <p class="text-xs text-emerald-700 mt-0.5"><?php echo e(session('success')); ?></p>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 text-sm">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-rose-500 text-white flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-wider text-rose-900">Terjadi Kesalahan</h5>
                    <p class="text-xs text-rose-700 mt-0.5"><?php echo e(session('error')); ?></p>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 text-sm">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 shadow-sm">
            <div class="flex items-center gap-2 font-bold text-xs uppercase tracking-wider text-rose-900 mb-1">
                <i class="fa-solid fa-triangle-exclamation text-rose-600"></i> Validasi Gagal
            </div>
            <ul class="list-disc pl-5 text-xs text-rose-700 space-y-0.5">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if($isAdmin): ?>
        <!-- Navigasi Pusat Rapor Admin (Pemisahan Jelas: Per Kelas vs Global Sekolah) -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 mb-6 shadow-xs flex flex-col xl:flex-row xl:items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-1.5 flex items-center gap-1">
                    <i class="fa-solid fa-chalkboard-user text-emerald-600"></i> Per Kelas:
                </span>
                <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200 gap-1">
                    <button type="button" id="adminTabBtn-kelas" onclick="switchAdminRaporTab('kelas')" class="admin-rapor-tab-btn px-3.5 py-2 rounded-lg text-xs font-bold flex items-center gap-2 transition-all cursor-pointer <?php echo e($initialAdminTab === 'kelas' ? 'bg-white text-emerald-700 shadow-xs border border-slate-200/80' : 'text-slate-600 hover:text-slate-900'); ?>">
                        <i class="fa-solid fa-file-contract"></i> Cetak &amp; TTD Kelas
                    </button>
                    <a href="/sk/rapor-walas?tab=nilai&kelas_id=<?php echo e($wallas->kelas_id ?? ''); ?>" class="px-3.5 py-2 rounded-lg text-xs font-semibold text-slate-600 hover:text-slate-900 flex items-center gap-2 transition-all">
                        <i class="fa-solid fa-sliders"></i> Leger Nilai Kelas
                    </a>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-blue-600 px-1.5 flex items-center gap-1">
                    <i class="fa-solid fa-globe"></i> Global Sekolah (Semua Kelas):
                </span>
                <div class="inline-flex flex-wrap p-1 rounded-xl bg-blue-50/60 border border-blue-200/70 gap-1">
                    <button type="button" id="adminTabBtn-pengesahan" onclick="switchAdminRaporTab('pengesahan')" class="admin-rapor-tab-btn px-3.5 py-2 rounded-lg text-xs font-bold flex items-center gap-2 transition-all cursor-pointer <?php echo e($initialAdminTab === 'pengesahan' ? 'bg-blue-700 text-white shadow-xs' : 'text-slate-600 hover:text-blue-800 hover:bg-white/70'); ?>">
                        <i class="fa-solid fa-file-signature"></i> Pengesahan &amp; TTD Kepsek
                    </button>
                    <button type="button" id="adminTabBtn-kegiatan" onclick="switchAdminRaporTab('kegiatan')" class="admin-rapor-tab-btn px-3.5 py-2 rounded-lg text-xs font-bold flex items-center gap-2 transition-all cursor-pointer <?php echo e($initialAdminTab === 'kegiatan' ? 'bg-violet-700 text-white shadow-xs' : 'text-slate-600 hover:text-violet-800 hover:bg-white/70'); ?>">
                        <i class="fa-solid fa-mosque"></i> Program Kegiatan Sekolah
                    </button>
                    <button type="button" id="adminTabBtn-template_prestasi" onclick="switchAdminRaporTab('template_prestasi')" class="admin-rapor-tab-btn px-3.5 py-2 rounded-lg text-xs font-bold flex items-center gap-2 transition-all cursor-pointer <?php echo e($initialAdminTab === 'template_prestasi' ? 'bg-amber-600 text-white shadow-xs' : 'text-slate-600 hover:text-amber-800 hover:bg-white/70'); ?>">
                        <i class="fa-solid fa-trophy"></i> Template Jenis Prestasi
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Admin Switcher Kelas (Hanya untuk Admin & Mode Per Kelas) -->
    <?php if($isAdmin && isset($daftar_semua_kelas) && $daftar_semua_kelas->isNotEmpty()): ?>
        <div id="adminClassSwitcherWrapper" class="<?php echo e($initialAdminTab === 'kelas' ? '' : 'hidden'); ?> bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-2xl p-5 mb-6 shadow-sm border border-slate-700 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-white flex items-center gap-2">
                        Mode Administrator Rapor
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">Per Kelas</span>
                    </h4>
                    <p class="text-xs text-slate-300 mt-0.5">Pilih rombongan belajar untuk mengelola catatan, prestasi, TTD Wali Kelas, dan cetak rapor siswa.</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <label for="selectKelasAdmin" class="text-xs text-slate-300 font-medium whitespace-nowrap">Pilih Kelas:</label>
                <select id="selectKelasAdmin" onchange="location.href='/sk/rapor-walas?kelas_id=' + this.value" class="text-xs bg-slate-800 border border-slate-600 text-white rounded-xl px-3.5 py-2 focus:ring-emerald-500 focus:border-emerald-500 font-semibold shadow-inner">
                    <?php $__currentLoopData = $daftar_semua_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($rk->id); ?>" <?php echo e(($wallas->kelas_id ?? null) == $rk->id ? 'selected' : ''); ?>>
                            <?php echo e($rk->nama_ruang); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    <?php endif; ?>

    <div id="adminRaporPane-kelas" class="admin-rapor-pane <?php echo e($initialAdminTab === 'kelas' ? '' : 'hidden'); ?>">
    <!-- Tab Switcher: Manajemen Nilai vs Cetak Rapor -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <?php if(!$isAdmin): ?>
            <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200">
                <a href="/sk/rapor-walas?tab=nilai" class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-600 hover:text-slate-900 flex items-center gap-2 transition-all">
                    <i class="fa-solid fa-sliders"></i> Leger Nilai
                </a>
                <a href="/sk/rapor-walas" class="px-4 py-2 rounded-lg text-xs font-bold bg-white text-emerald-700 shadow-sm border border-slate-200/80 flex items-center gap-2 transition-all">
                    <i class="fa-solid fa-file-contract"></i> Cetak Rapor
                </a>
            </div>
        <?php else: ?>
            <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                <i class="fa-solid fa-chalkboard text-emerald-600"></i>
                <span>Kelas Aktif: <strong class="text-slate-800"><?php echo e($wallas->kelas->nama_ruang ?? '-'); ?></strong></span>
            </div>
        <?php endif; ?>

        <div class="flex items-center gap-2">
            <a href="/sk/rapor-walas?print=massal<?php echo e($isAdmin ? '&kelas_id='.($wallas->kelas_id ?? '') : ''); ?>" target="_blank" class="inline-flex items-center px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition-all shadow-sm gap-2">
                <i class="fa-solid fa-print"></i> Cetak Seluruh Rapor Kelas (Massal)
            </a>
            <?php if(!$isAdmin): ?>
                <a href="/sk/rapor-walas?tab=nilai" class="inline-flex items-center px-3.5 py-2 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-bold transition-colors">
                    <i class="fa-solid fa-sliders mr-1.5"></i> Leger Nilai
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
            <div class="p-3 bg-violet-50 text-violet-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-school text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Kelas Binaan</p>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-800 break-words leading-snug mt-0.5"><?php echo e($wallas->ruangKelas->nama_ruang ?? 'Kelas'); ?></h3>
                <p class="text-xs text-slate-400 mt-1 truncate">Wali: <?php echo e($wallas->guru->nama ?? 'Belum Ditentukan'); ?></p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-file-circle-check text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Total Siswa Terdaftar</p>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate"><?php echo e(count($siswa)); ?></h3>
                <p class="text-xs text-slate-400 mt-1 truncate">Berkas rapor siswa siap cetak</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0 sm:col-span-2 lg:col-span-1">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-print text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Progres Nilai Mapel</p>
                <h3 class="text-xl font-bold text-slate-800 mt-0.5 truncate"><?php echo e($stats_nilai['mapel_sudah_input'] ?? 0); ?> / <?php echo e($stats_nilai['total_mapel'] ?? 0); ?> Mapel</h3>
                <p class="text-xs text-emerald-600 font-medium mt-1 truncate"><i class="fa-solid fa-circle-check text-[10px] mr-1"></i>Rata-rata Kelas: <?php echo e(number_format($stats_nilai['rata_kelas'] ?? 0, 1)); ?></p>
            </div>
        </div>
    </div>


    <!-- Banner Info Program Kegiatan Sekolah Yang Dinilai Pada Rapor -->
    <?php if(isset($daftar_kegiatan_sekolah) && $daftar_kegiatan_sekolah->isNotEmpty()): ?>
        <div class="mb-8 bg-white border border-slate-200 rounded-2xl p-4 sm:p-5 shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-mosque"></i>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-800">Master Program Kegiatan Sekolah (Rapor)</h4>
                        <p class="text-[11px] text-slate-500">Daftar kegiatan resmi dari Admin yang dinilai pada lembar rapor santri. Klik <strong>Detail Rapor</strong> santri untuk mengevaluasi predikat & narasinya.</p>
                    </div>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200/60 w-fit">
                    <i class="fa-solid fa-list-check mr-1.5"></i> <?php echo e($daftar_kegiatan_sekolah->count()); ?> Kegiatan Aktif
                </span>
            </div>
            <div class="flex flex-wrap gap-2 pt-3 border-t border-slate-100">
                <?php $__currentLoopData = $daftar_kegiatan_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dkeg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 font-medium">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <strong class="text-slate-800"><?php echo e($dkeg->nama_kegiatan); ?></strong>
                        <?php if($dkeg->jenjang !== 'semua'): ?>
                            <span class="text-[10px] uppercase font-bold text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded border border-indigo-200"><?php echo e($dkeg->jenjang); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>


    <!-- ======================================================== -->
    <!-- PENGESAHAN TANDA TANGAN DIGITAL RAPOR (LEVEL KELAS)      -->
    <!-- ======================================================== -->
    <?php
        $hasWallasRecord = isset($wallas->id);
        $currentTtdWalas = $wallas->ttd_walas ?? null;
        $currentTtdKepsek = $pengaturan_rapor->ttd_kepsek ?? null;
    ?>
    <div class="mb-8 bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4 pb-3 border-b border-slate-100">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center justify-center text-sm flex-shrink-0">
                    <i class="fa-solid fa-signature"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-800">Pengesahan Tanda Tangan Rapor — <?php echo e($wallas->ruangKelas->nama_ruang ?? 'Kelas'); ?></h4>
                    <p class="text-[11px] text-slate-500">Unggah TTD Wali Kelas sekali di sini — otomatis tampil di seluruh rapor siswa, Cetak Massal, dan akun Santri.</p>
                </div>
            </div>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 w-fit flex-shrink-0">
                <i class="fa-solid fa-wand-magic-sparkles text-amber-500 text-[10px]"></i> Auto-Hapus Background Aktif
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Kolom Kiri: Upload TTD Wali Kelas (Per Kelas) -->
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-bold text-slate-700">Tanda Tangan Wali Kelas</label>
                        <span id="walasCardStatusTtd" class="text-[10px] font-semibold px-2 py-0.5 rounded <?php echo e(!empty($currentTtdWalas) ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600'); ?>">
                            <?php echo e(!empty($currentTtdWalas) ? 'Aktif (Tersimpan)' : 'Belum diunggah'); ?>

                        </span>
                    </div>
                    <p class="text-[11px] text-slate-500 mb-2.5 truncate">Wali Kelas: <strong class="text-slate-700"><?php echo e($wallas->guru->nama ?? 'Belum Ditugaskan'); ?></strong></p>

                    <div class="h-24 rounded-lg border-2 border-dashed border-slate-300 bg-white flex items-center justify-center relative overflow-hidden mb-3">
                        <img id="walasCardThumbTtd" src="<?php echo e($currentTtdWalas ?? ''); ?>" alt="TTD Wali Kelas" class="max-h-20 max-w-full object-contain <?php echo e(!empty($currentTtdWalas) ? '' : 'hidden'); ?>" style="mix-blend-mode: multiply;" />
                        <div id="walasCardPlaceholderTtd" class="text-center text-slate-400 <?php echo e(!empty($currentTtdWalas) ? 'hidden' : ''); ?>">
                            <i class="fa-solid fa-file-signature text-2xl mb-1 text-slate-300 block"></i>
                            <span class="text-[11px]">Belum ada tanda tangan</span>
                        </div>
                    </div>
                </div>

                <?php if($hasWallasRecord): ?>
                    <div>
                        <div class="flex items-center gap-2">
                            <input type="file" id="walasCardFileTtd" accept="image/*" class="hidden" onchange="handleClassWalasSignatureUpload(this)">
                            <button type="button" onclick="document.getElementById('walasCardFileTtd').click()" class="flex-1 px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold flex items-center justify-center gap-1.5 transition-colors cursor-pointer shadow-xs">
                                <i class="fa-solid fa-arrow-up-from-bracket text-[11px]"></i> Upload TTD Wali Kelas
                            </button>
                            <button type="button" id="walasCardBtnHapus" onclick="removeClassWalasSignature()" class="px-3 py-2 bg-slate-200 hover:bg-rose-100 hover:text-rose-700 text-slate-600 rounded-lg text-xs font-semibold transition-colors cursor-pointer <?php echo e(!empty($currentTtdWalas) ? '' : 'hidden'); ?>" title="Hapus tanda tangan wali kelas">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                        <p id="walasCardSyncMsg" class="text-[11px] text-slate-400 mt-2 hidden"></p>
                    </div>
                <?php else: ?>
                    <div class="p-2.5 rounded-lg bg-amber-50 border border-amber-200 text-[11px] text-amber-800 flex items-center justify-between gap-2">
                        <span>Tugaskan Wali Kelas terlebih dahulu untuk mengunggah TTD kelas ini.</span>
                        <a href="/sk/kelola-wali-kelas" class="font-bold underline whitespace-nowrap">Atur Walas</a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Kolom Kanan: Preview TTD Kepala Sekolah (Read-Only dari Admin) -->
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-bold text-slate-700">Tanda Tangan Kepala Sekolah</label>
                        <?php if(!empty($currentTtdKepsek)): ?>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-blue-100 text-blue-800">Aktif dari Admin</span>
                        <?php else: ?>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-amber-100 text-amber-800">Belum Diunggah Admin</span>
                        <?php endif; ?>
                    </div>
                    <p class="text-[11px] text-slate-500 mb-2.5 truncate">Kepala Sekolah: <strong class="text-slate-700"><?php echo e($pengaturan_rapor->nama_kepsek ?? 'Rajihul Haq, S.Sos'); ?></strong></p>

                    <div class="h-24 rounded-lg border-2 border-dashed border-slate-300 bg-white flex items-center justify-center relative overflow-hidden mb-3">
                        <?php if(!empty($currentTtdKepsek)): ?>
                            <img src="<?php echo e($currentTtdKepsek); ?>" alt="TTD Kepala Sekolah" class="max-h-20 max-w-full object-contain" style="mix-blend-mode: multiply;" />
                        <?php else: ?>
                            <div class="text-center text-slate-400">
                                <i class="fa-solid fa-stamp text-2xl mb-1 text-slate-300 block"></i>
                                <span class="text-[11px]">Menunggu TTD Kepala Sekolah dari Admin</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="flex items-center justify-between text-[11px] text-slate-500 pt-1">
                    <?php if(session('role') === 'a'): ?>
                        <span>Dikelola terpusat pada tab Pengesahan Rapor.</span>
                        <button type="button" onclick="switchAdminRaporTab('pengesahan')" class="text-blue-600 hover:text-blue-800 font-bold whitespace-nowrap ml-2 cursor-pointer">
                            Atur TTD Kepsek <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </button>
                    <?php else: ?>
                        <span><i class="fa-solid fa-lock text-[10px] mr-1 text-slate-400"></i> Pratinjau resmi (hanya Admin yang dapat mengubah TTD Kepala Sekolah).</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- DAFTAR CETAK RAPOR SISWA                                 -->
    <!-- ======================================================== -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Daftar Siswa Kelas <?php echo e($wallas->ruangKelas->nama_ruang ?? 'Kelas'); ?></h3>
                    <p class="text-sm text-slate-500">Pilih siswa untuk melihat pratinjau nilai dan mencetak lembar rapor</p>
                </div>
                <div class="flex flex-wrap items-center gap-2.5">
                    <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200 gap-1" role="group" aria-label="Urutkan Daftar Rapor Siswa">
                        <button type="button" data-sort-table="tableRaporWalas" data-sort-mode="name" onclick="window.sortSiakadRankingTable('tableRaporWalas', 'name', this)"
                                class="rapor-sort-btn px-3 py-1.5 rounded-lg text-[11px] font-bold bg-white text-emerald-700 shadow-sm border border-slate-200/80 transition-all cursor-pointer flex items-center gap-1.5">
                            <i class="fa-solid fa-arrow-down-a-z"></i> Nama
                        </button>
                        <button type="button" data-sort-table="tableRaporWalas" data-sort-mode="rank" onclick="window.sortSiakadRankingTable('tableRaporWalas', 'rank', this)"
                                class="rapor-sort-btn px-3 py-1.5 rounded-lg text-[11px] font-semibold text-slate-600 hover:text-amber-700 transition-all cursor-pointer flex items-center gap-1.5">
                            <i class="fa-solid fa-crown text-amber-500"></i> Peringkat
                        </button>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                        <i class="fa-solid fa-users mr-1.5 text-xs"></i> <?php echo e(count($siswa)); ?> Siswa
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="tableRaporWalas">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider w-14 text-center">No</th>
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">NIS</th>
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama Lengkap Siswa</th>
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-center">Kelengkapan Nilai</th>
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-center">Rata-Rata & Peringkat</th>
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if(isset($leger_siswa) && count($leger_siswa) > 0): ?>
                            <?php $__currentLoopData = $leger_siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $s = $row->siswa;
                                    $rankNum = is_numeric($row->peringkat) ? (int) $row->peringkat : 999999;
                                    $rowRankClass = $rankNum === 1
                                        ? 'siakad-rank-row-1'
                                        : ($rankNum === 2 ? 'siakad-rank-row-2' : ($rankNum === 3 ? 'siakad-rank-row-3' : ''));
                                    $avatarRankClass = $rankNum === 1
                                        ? 'bg-gradient-to-br from-amber-300 to-amber-500 text-amber-950 ring-1 ring-amber-400/70'
                                        : ($rankNum === 2 ? 'bg-gradient-to-br from-slate-200 to-slate-400 text-slate-900 ring-1 ring-slate-400/60'
                                        : ($rankNum === 3 ? 'bg-gradient-to-br from-orange-200 to-orange-400 text-orange-950 ring-1 ring-orange-400/60'
                                        : 'bg-slate-100 text-slate-700'));
                                ?>
                                <tr class="<?php echo e($rowRankClass); ?> hover:bg-slate-50/60 transition-colors"
                                    data-orig-index="<?php echo e($index + 1); ?>"
                                    data-rank="<?php echo e($rankNum); ?>">
                                    <td class="px-4 py-4 text-sm text-slate-500 text-center font-medium" data-row-number="true"><?php echo e($index + 1); ?></td>
                                    <td class="px-4 py-4 text-sm font-mono text-slate-600 whitespace-nowrap"><?php echo e($s->nis ?? '-'); ?></td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full <?php echo e($avatarRankClass); ?> flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                                <?php echo e(substr($s->nama, 0, 2)); ?>

                                            </div>
                                            <span class="text-sm font-semibold <?php echo e($rankNum <= 3 ? 'text-slate-900' : 'text-slate-800'); ?>"><?php echo e($s->nama); ?></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
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
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold <?php echo e($row->mapel_terisi >= $row->total_mapel && $row->total_mapel > 0 ? 'bg-emerald-100 text-emerald-800' : ($row->mapel_terisi > 0 ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-600')); ?>">
                                            <?php echo e($row->mapel_terisi); ?> / <?php echo e($row->total_mapel); ?> Mapel
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <?php if($row->mapel_terisi > 0): ?>
                                            <div class="inline-flex items-center justify-center gap-2">
                                                <span class="font-bold text-slate-800"><?php echo e(number_format($row->rata_rata, 1)); ?></span>
                                                <?php if (isset($component)) { $__componentOriginal857dd9638daa2acd55509dbe6d317237 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal857dd9638daa2acd55509dbe6d317237 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.rank-badge','data' => ['rank' => $row->peringkat,'variant' => 'compact']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.rank-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rank' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($row->peringkat),'variant' => 'compact']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal857dd9638daa2acd55509dbe6d317237)): ?>
<?php $attributes = $__attributesOriginal857dd9638daa2acd55509dbe6d317237; ?>
<?php unset($__attributesOriginal857dd9638daa2acd55509dbe6d317237); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal857dd9638daa2acd55509dbe6d317237)): ?>
<?php $component = $__componentOriginal857dd9638daa2acd55509dbe6d317237; ?>
<?php unset($__componentOriginal857dd9638daa2acd55509dbe6d317237); ?>
<?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-xs text-slate-400">Belum ada nilai</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-4 text-right whitespace-nowrap">
                                        <a href="/sk/detail-rapor-walas/<?php echo e($s->id); ?>" class="inline-flex items-center px-3.5 py-1.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-xs font-semibold transition-colors shadow-sm whitespace-nowrap">
                                            <i class="fa-solid fa-print mr-1.5"></i> Cetak Rapor
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
    </div><!-- /#adminRaporPane-kelas -->

    <?php if($isAdmin): ?>
        <?php echo $__env->make('modul.siakad.admin.partials.raporGlobalTabs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalff9b50f29f4bda0654a541b64a4d7075 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff9b50f29f4bda0654a541b64a4d7075 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.signature-script','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.signature-script'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff9b50f29f4bda0654a541b64a4d7075)): ?>
<?php $attributes = $__attributesOriginalff9b50f29f4bda0654a541b64a4d7075; ?>
<?php unset($__attributesOriginalff9b50f29f4bda0654a541b64a4d7075); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff9b50f29f4bda0654a541b64a4d7075)): ?>
<?php $component = $__componentOriginalff9b50f29f4bda0654a541b64a4d7075; ?>
<?php unset($__componentOriginalff9b50f29f4bda0654a541b64a4d7075); ?>
<?php endif; ?>
    <script>
        function switchAdminRaporTab(tab, updateUrl = true) {
            const validTabs = ['kelas', 'pengesahan', 'kegiatan', 'template_prestasi'];
            if (!validTabs.includes(tab)) {
                tab = 'kelas';
            }

            document.querySelectorAll('.admin-rapor-pane').forEach(el => el.classList.add('hidden'));
            const activePane = document.getElementById('adminRaporPane-' + tab);
            if (activePane) {
                activePane.classList.remove('hidden');
            }

            const classSwitcher = document.getElementById('adminClassSwitcherWrapper');
            const globalBanner = document.getElementById('adminRaporGlobalBanner');
            if (classSwitcher) {
                classSwitcher.classList.toggle('hidden', tab !== 'kelas');
            }
            if (globalBanner) {
                globalBanner.classList.toggle('hidden', tab === 'kelas');
            }

            const btnStyles = {
                kelas: {
                    active: ['bg-white', 'text-emerald-700', 'shadow-xs', 'border', 'border-slate-200/80'],
                    inactive: ['text-slate-600', 'hover:text-slate-900']
                },
                pengesahan: {
                    active: ['bg-blue-700', 'text-white', 'shadow-xs'],
                    inactive: ['text-slate-600', 'hover:text-blue-800', 'hover:bg-white/70']
                },
                kegiatan: {
                    active: ['bg-violet-700', 'text-white', 'shadow-xs'],
                    inactive: ['text-slate-600', 'hover:text-violet-800', 'hover:bg-white/70']
                },
                template_prestasi: {
                    active: ['bg-amber-600', 'text-white', 'shadow-xs'],
                    inactive: ['text-slate-600', 'hover:text-amber-800', 'hover:bg-white/70']
                }
            };

            Object.keys(btnStyles).forEach(key => {
                const btn = document.getElementById('adminTabBtn-' + key);
                if (!btn) return;
                const style = btnStyles[key];
                btn.classList.remove(...style.active, ...style.inactive);
                if (key === tab) {
                    btn.classList.add(...style.active);
                } else {
                    btn.classList.add(...style.inactive);
                }
            });

            if (updateUrl) {
                try {
                    const url = new URL(window.location);
                    if (tab === 'kelas') {
                        url.searchParams.delete('tab');
                    } else {
                        url.searchParams.set('tab', tab);
                    }
                    window.history.replaceState({}, '', url);
                } catch (e) {}
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            <?php if($isAdmin): ?>
                switchAdminRaporTab('<?php echo e($initialAdminTab); ?>', false);
            <?php endif; ?>
        });
    </script>
    <script>
        function updateClassWalasSignatureUI(dataUrl, message, isError = false) {
            const thumb = document.getElementById('walasCardThumbTtd');
            const placeholder = document.getElementById('walasCardPlaceholderTtd');
            const statusEl = document.getElementById('walasCardStatusTtd');
            const btnHapus = document.getElementById('walasCardBtnHapus');
            const syncMsg = document.getElementById('walasCardSyncMsg');

            if (dataUrl) {
                if (thumb) { thumb.src = dataUrl; thumb.classList.remove('hidden'); }
                if (placeholder) placeholder.classList.add('hidden');
                if (statusEl) {
                    statusEl.textContent = 'Aktif (Tersimpan)';
                    statusEl.className = 'text-[10px] font-semibold px-2 py-0.5 rounded bg-emerald-100 text-emerald-800';
                }
                if (btnHapus) btnHapus.classList.remove('hidden');
            } else {
                if (thumb) { thumb.src = ''; thumb.classList.add('hidden'); }
                if (placeholder) placeholder.classList.remove('hidden');
                if (statusEl) {
                    statusEl.textContent = 'Belum diunggah';
                    statusEl.className = 'text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-200 text-slate-600';
                }
                if (btnHapus) btnHapus.classList.add('hidden');
            }

            if (syncMsg && message) {
                syncMsg.textContent = message;
                syncMsg.className = 'text-[11px] mt-2 font-medium ' + (isError ? 'text-rose-600' : 'text-emerald-700');
                syncMsg.classList.remove('hidden');
            }
        }

        async function saveClassWalasSignature(dataUrl) {
            const syncMsg = document.getElementById('walasCardSyncMsg');
            if (syncMsg) {
                syncMsg.textContent = 'Menyimpan tanda tangan kelas ke database...';
                syncMsg.className = 'text-[11px] mt-2 font-medium text-slate-500';
                syncMsg.classList.remove('hidden');
            }

            try {
                const response = await fetch('/sk/simpan-massal-prestasi-walas', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        action: 'simpan_ttd_walas',
                        kelas_id: <?php echo e($wallas->kelas_id ?? 'null'); ?>,
                        ttd_walas: dataUrl || ''
                    })
                });
                const resJson = await response.json().catch(() => ({}));
                if (response.ok && resJson.success) {
                    updateClassWalasSignatureUI(dataUrl, resJson.message || 'Berhasil disimpan ke database.');
                } else {
                    updateClassWalasSignatureUI(null, resJson.message || 'Gagal menyimpan tanda tangan ke database.', true);
                }
            } catch (err) {
                updateClassWalasSignatureUI(dataUrl, 'Gagal terhubung ke server saat menyimpan TTD.', true);
            }
        }

        function handleClassWalasSignatureUpload(inputEl) {
            const file = inputEl.files && inputEl.files[0];
            if (!file) return;

            removeSignatureBackground(file, function(pngDataUrl) {
                updateClassWalasSignatureUI(pngDataUrl, 'Memproses gambar transparan...');
                saveClassWalasSignature(pngDataUrl);
            });
            inputEl.value = '';
        }

        function removeClassWalasSignature() {
            updateClassWalasSignatureUI('', 'Menghapus tanda tangan kelas...');
            saveClassWalasSignature('');
        }
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
<?php endif; ?><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/guru/raporWalas.blade.php ENDPATH**/ ?>