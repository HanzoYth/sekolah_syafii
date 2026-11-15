<?php
    $isAdmin = session('role') === 'a';
?>

<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => ''.e($isAdmin ? 'Monitoring Leger Nilai Kelas' : 'Manajemen Nilai Kelas').'','description' => ''.e($isAdmin ? 'Pantau progres penginputan nilai guru pengajar, rekap nilai seluruh siswa, peringkat, dan cetak dokumen leger kelas.' : 'Pantau, tinjau, dan atur nilai seluruh mata pelajaran yang diinput oleh guru pengajar di kelas perwalian Anda.').'','position' => ''.e($isAdmin ? 'Administrator SIAKAD' : 'Guru Wali Kelas').'','initials' => ''.e($isAdmin ? 'AD' : 'WK').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($isAdmin ? 'Monitoring Leger Nilai Kelas' : 'Manajemen Nilai Kelas').'','description' => ''.e($isAdmin ? 'Pantau progres penginputan nilai guru pengajar, rekap nilai seluruh siswa, peringkat, dan cetak dokumen leger kelas.' : 'Pantau, tinjau, dan atur nilai seluruh mata pelajaran yang diinput oleh guru pengajar di kelas perwalian Anda.').'','position' => ''.e($isAdmin ? 'Administrator SIAKAD' : 'Guru Wali Kelas').'','initials' => ''.e($isAdmin ? 'AD' : 'WK').'']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="<?php echo e($isAdmin ? '/sk/das' : '/sk/dsg'); ?>" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <?php if($isAdmin): ?>
            <li class="flex items-center">
                <a href="/sk/rapor-walas?kelas_id=<?php echo e($wallas->kelas_id ?? ''); ?>" class="text-slate-500 hover:text-emerald-600 transition-colors">Rapor Siswa</a>
                <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
            </li>
            <li class="flex items-center">
                <span class="text-slate-700 font-medium">Leger Nilai Kelas</span>
            </li>
        <?php else: ?>
            <li class="flex items-center">
                <span class="text-slate-700 font-medium">Manajemen Nilai Kelas</span>
            </li>
        <?php endif; ?>
     <?php $__env->endSlot(); ?>

    <?php if($isAdmin): ?>
        <!-- Navigasi Pusat Rapor Admin (Konsisten dengan halaman Rapor Siswa) -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 mb-6 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500 px-1.5 flex items-center gap-1 whitespace-nowrap">
                    <i class="fa-solid fa-chalkboard-user text-emerald-700"></i> Per Kelas:
                </span>
                <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200 gap-1">
                    <a href="/sk/rapor-walas?kelas_id=<?php echo e($wallas->kelas_id ?? ''); ?>" class="px-3.5 py-2 rounded-lg text-xs font-bold text-slate-600 hover:text-emerald-800 hover:bg-white/80 flex items-center gap-1.5 transition-all whitespace-nowrap">
                        <i class="fa-solid fa-file-contract"></i> Rapor &amp; TTD
                    </a>
                    <span class="px-3.5 py-2 rounded-lg text-xs font-bold bg-emerald-700 text-white shadow-xs flex items-center gap-1.5 whitespace-nowrap">
                        <i class="fa-solid fa-sliders"></i> Leger Nilai
                    </span>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 px-1.5 flex items-center gap-1 whitespace-nowrap">
                    <i class="fa-solid fa-globe"></i> Global:
                </span>
                <div class="inline-flex flex-wrap p-1 rounded-xl bg-slate-100 border border-slate-200 gap-1">
                    <a href="/sk/rapor-walas?tab=pengesahan" class="px-3.5 py-2 rounded-lg text-xs font-bold text-slate-600 hover:text-emerald-800 hover:bg-white/80 flex items-center gap-1.5 transition-all whitespace-nowrap">
                        <i class="fa-solid fa-file-signature"></i> Pengesahan
                    </a>
                    <a href="/sk/rapor-walas?tab=kegiatan" class="px-3.5 py-2 rounded-lg text-xs font-bold text-slate-600 hover:text-emerald-800 hover:bg-white/80 flex items-center gap-1.5 transition-all whitespace-nowrap">
                        <i class="fa-solid fa-mosque"></i> Kegiatan
                    </a>
                    <a href="/sk/rapor-walas?tab=template_prestasi" class="px-3.5 py-2 rounded-lg text-xs font-bold text-slate-600 hover:text-emerald-800 hover:bg-white/80 flex items-center gap-1.5 transition-all whitespace-nowrap">
                        <i class="fa-solid fa-trophy"></i> Prestasi
                    </a>
                </div>
            </div>
        </div>

        <?php if(isset($daftar_semua_kelas) && $daftar_semua_kelas->isNotEmpty()): ?>
            <div class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-emerald-700 text-white rounded-2xl p-5 mb-6 shadow-sm border border-emerald-700/80 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 border border-emerald-300/30 text-emerald-100 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-chart-simple"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white flex items-center gap-2">
                            Mode Monitoring Leger Nilai Admin
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-950/40 text-emerald-100 border border-emerald-400/30">Read-Only</span>
                        </h4>
                        <p class="text-xs text-emerald-100/90 mt-0.5">Pilih kelas untuk memantau kelengkapan input nilai guru pengajar dan mencetak dokumen leger kelas.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <label for="selectKelasAdminLeger" class="text-xs text-emerald-100 font-medium whitespace-nowrap">Pilih Kelas:</label>
                    <select id="selectKelasAdminLeger" onchange="location.href='/sk/rapor-walas?tab=nilai&kelas_id=' + this.value" class="text-xs bg-emerald-950/60 border border-emerald-400/40 text-white rounded-xl px-3.5 py-2 focus:ring-emerald-400 focus:border-emerald-400 font-semibold shadow-inner">
                        <?php $__currentLoopData = $daftar_semua_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($rk->id); ?>" <?php echo e(($wallas->kelas_id ?? null) == $rk->id ? 'selected' : ''); ?>>
                                <?php echo e($rk->nama_ruang); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Tab Switcher & Action Bar -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <?php if(!$isAdmin): ?>
            <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200">
                <a href="/sk/rapor-walas?tab=nilai" class="px-4 py-2 rounded-lg text-xs font-bold bg-white text-emerald-700 shadow-sm border border-slate-200/80 flex items-center gap-2 transition-all">
                    <i class="fa-solid fa-sliders"></i> Leger Nilai
                </a>
                <a href="/sk/rapor-walas" class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-600 hover:text-slate-900 flex items-center gap-2 transition-all">
                    <i class="fa-solid fa-file-contract"></i> Cetak Rapor
                </a>
            </div>
        <?php else: ?>
            <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                <i class="fa-solid fa-chalkboard text-emerald-600"></i>
                <span>Kelas Aktif: <strong class="text-slate-800"><?php echo e($wallas->ruangKelas->nama_ruang ?? '-'); ?></strong></span>
                <span class="text-slate-300">&bull;</span>
                <span>Wali Kelas: <strong class="text-slate-700"><?php echo e($wallas->guru->nama ?? '-'); ?></strong></span>
            </div>
        <?php endif; ?>

        <div class="flex items-center gap-2.5">
            <a href="/sk/rapor-walas?tab=nilai&print=leger<?php echo e($isAdmin ? '&kelas_id='.($wallas->kelas_id ?? '') : ''); ?>" target="_blank" class="inline-flex items-center px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition-all shadow-sm gap-2">
                <i class="fa-solid fa-print"></i> Cetak Leger Nilai (Landscape)
            </a>
            <?php if($isAdmin): ?>
                <span class="hidden sm:inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-50 text-blue-800 border border-blue-200 text-xs font-semibold">
                    <i class="fa-solid fa-eye mr-1.5 text-blue-600"></i> Mode Monitoring Admin
                </span>
            <?php else: ?>
                <span class="hidden sm:inline-flex items-center px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-semibold">
                    <i class="fa-solid fa-shield-halved mr-1.5 text-emerald-600"></i> Akses Wali Kelas
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Top KPI Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
            <div class="p-3 bg-violet-50 text-violet-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-school text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate"><?php echo e($isAdmin ? 'Kelas Terpilih' : 'Kelas Perwalian'); ?></p>
                <h3 class="text-xl font-bold text-slate-800 break-words leading-snug mt-0.5"><?php echo e($wallas->ruangKelas->nama_ruang ?? '-'); ?></h3>
                <p class="text-xs text-slate-400 mt-1 truncate"><?php echo e(count($siswa)); ?> siswa aktif</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-book-open text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Progres Input Pengajar</p>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate"><?php echo e($stats_nilai['mapel_sudah_input']); ?> <span class="text-xs sm:text-sm font-normal text-slate-400">/ <?php echo e($stats_nilai['total_mapel']); ?> Mapel</span></h3>
                <p class="text-xs text-slate-400 mt-1 truncate"><?php echo e($stats_nilai['mapel_lengkap']); ?> mapel sudah lengkap 100%</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-chart-line text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Rata-Rata Kelas</p>
                <h3 class="text-xl sm:text-2xl font-bold text-emerald-600 mt-0.5 truncate"><?php echo e(number_format($stats_nilai['rata_kelas'], 1)); ?></h3>
                <p class="text-xs text-slate-400 mt-1 truncate">Akumulasi nilai akhir terbobot</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-scale-balanced text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Komponen Evaluasi</p>
                <h3 class="text-lg sm:text-xl font-bold text-slate-800 mt-0.5 truncate"><?php echo e(count($jenis_penilaian)); ?> Komponen</h3>
                <p class="text-xs text-slate-400 mt-1 truncate">Tugas, UH, UTS, & UAS</p>
            </div>
        </div>
    </div>

    <!-- BAGIAN 1: DAFTAR MATA PELAJARAN & MANAJEMEN NILAI PENGAJAR -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Daftar Nilai Mata Pelajaran (Inputan Guru Pengajar)</h3>
                    <?php if($isAdmin): ?>
                        <p class="text-xs text-slate-500">Pantau progres kelengkapan penginputan nilai oleh masing-masing guru pengajar (mode monitoring read-only)</p>
                    <?php else: ?>
                        <p class="text-xs text-slate-500">Klik tombol <strong>Atur / Edit Nilai</strong> untuk memeriksa atau menyesuaikan rincian nilai siswa pada mata pelajaran terkait</p>
                    <?php endif; ?>
                </div>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                <i class="fa-solid fa-layer-group mr-1.5 text-xs"></i> <?php echo e($rekap_mapel->count()); ?> Mata Pelajaran
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        <th class="px-5 py-3.5 w-12 text-center">No</th>
                        <th class="px-5 py-3.5">Mata Pelajaran</th>
                        <th class="px-5 py-3.5">Guru Pengajar</th>
                        <th class="px-5 py-3.5 text-center">KKM</th>
                        <th class="px-5 py-3.5">Progres Input Nilai</th>
                        <th class="px-5 py-3.5 text-center">Rata-Rata</th>
                        <th class="px-5 py-3.5 text-center">Ketuntasan</th>
                        <th class="px-5 py-3.5 text-center w-44"><?php echo e($isAdmin ? 'Status Monitoring' : 'Aksi Wali Kelas'); ?></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    <?php if($rekap_mapel->count() > 0): ?>
                        <?php $__currentLoopData = $rekap_mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $persen = $m->total_siswa > 0 ? round(($m->siswa_dinilai / $m->total_siswa) * 100) : 0;
                            ?>
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="px-5 py-4 text-center text-slate-400 font-medium"><?php echo e($loop->iteration); ?></td>
                                <td class="px-5 py-4">
                                    <span class="font-bold text-slate-800 block"><?php echo e($m->nama_mapel); ?></span>
                                    <span class="text-xs text-slate-400"><?php echo e($m->hari); ?> • <?php echo e($m->jam_mulai); ?> - <?php echo e($m->jam_selesai); ?> WIB</span>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center space-x-2.5">
                                        <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                            <?php echo e(substr($m->guru_nama, 0, 2)); ?>

                                        </div>
                                        <span class="font-medium text-slate-700"><?php echo e($m->guru_nama); ?></span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                        <?php echo e($m->kkm); ?>

                                    </span>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-between text-xs mb-1">
                                        <span class="font-semibold text-slate-700"><?php echo e($m->siswa_dinilai); ?> / <?php echo e($m->total_siswa); ?> Siswa</span>
                                        <?php if($m->status_input === 'lengkap'): ?>
                                            <span class="text-emerald-600 font-bold"><i class="fa-solid fa-circle-check mr-1"></i>Lengkap</span>
                                        <?php elseif($m->status_input === 'sebagian'): ?>
                                            <span class="text-amber-600 font-semibold">Proses (<?php echo e($persen); ?>%)</span>
                                        <?php else: ?>
                                            <span class="text-rose-600 font-semibold">Belum Diinput</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full rounded-full <?php echo e($m->status_input === 'lengkap' ? 'bg-emerald-500' : ($m->status_input === 'sebagian' ? 'bg-amber-500' : 'bg-slate-300')); ?>" style="width: <?php echo e($persen); ?>%"></div>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <?php if($m->siswa_dinilai > 0): ?>
                                        <span class="text-base font-extrabold <?php echo e($m->rata_rata >= $m->kkm ? 'text-emerald-700' : 'text-rose-600'); ?>">
                                            <?php echo e(number_format($m->rata_rata, 1)); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <?php if($m->siswa_dinilai > 0): ?>
                                        <div class="inline-flex items-center gap-1.5 text-xs">
                                            <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold border border-emerald-200" title="Tuntas KKM">
                                                <?php echo e($m->siswa_tuntas); ?> Tuntas
                                            </span>
                                            <?php if($m->siswa_remedi > 0): ?>
                                                <span class="px-2 py-0.5 rounded bg-rose-50 text-rose-700 font-bold border border-rose-200" title="Di Bawah KKM">
                                                    <?php echo e($m->siswa_remedi); ?> Remedi
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400 italic">Menunggu nilai</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <?php if($isAdmin): ?>
                                        <?php if($m->status_input === 'lengkap'): ?>
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold">
                                                <i class="fa-solid fa-circle-check mr-1.5"></i> Selesai Diinput
                                            </span>
                                        <?php elseif($m->status_input === 'sebagian'): ?>
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold">
                                                <i class="fa-solid fa-clock mr-1.5"></i> Proses Pengisian
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg bg-slate-100 text-slate-600 border border-slate-200 text-xs font-semibold">
                                                <i class="fa-solid fa-hourglass-start mr-1.5"></i> Belum Diinput
                                            </span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="/sk/input-nilai-detail/<?php echo e($m->jadwal_id); ?>?from=walas" 
                                           class="inline-flex items-center px-3.5 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-sm">
                                            <i class="fa-solid fa-pen-to-square mr-1.5"></i> Edit Nilai
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-book-open text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700">Belum Ada Mata Pelajaran Terjadwal</h4>
                                <p class="text-xs text-slate-400 mt-1">Jadwal mata pelajaran untuk kelas <?php echo e($wallas->ruangKelas->nama_ruang ?? '-'); ?> belum diatur oleh Admin.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- BAGIAN 2: TABEL LEGER NILAI KELAS (REKAPITULASI SEMUA MATA PELAJARAN) -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                    <i class="fa-solid fa-table-list"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Leger Nilai Seluruh Siswa: <?php echo e($wallas->ruangKelas->nama_ruang ?? '-'); ?></h3>
                    <p class="text-xs text-slate-500">Rekapitulasi nilai akhir seluruh mata pelajaran, rata-rata capaian, dan peringkat kelas</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2.5 w-full lg:w-auto flex-shrink-0 justify-end">
                <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200 gap-1 flex-shrink-0 self-start sm:self-auto" role="group" aria-label="Urutkan Leger Siswa">
                    <button type="button" data-sort-table="tableLeger" data-sort-mode="name" onclick="window.sortSiakadRankingTable('tableLeger', 'name', this)"
                            class="leger-sort-btn px-3 py-1.5 rounded-lg text-[11px] font-bold bg-white text-emerald-700 shadow-sm border border-slate-200/80 transition-all cursor-pointer flex items-center gap-1.5 whitespace-nowrap">
                        <i class="fa-solid fa-arrow-down-a-z"></i> Nama
                    </button>
                    <button type="button" data-sort-table="tableLeger" data-sort-mode="rank" onclick="window.sortSiakadRankingTable('tableLeger', 'rank', this)"
                            class="leger-sort-btn px-3 py-1.5 rounded-lg text-[11px] font-semibold text-slate-600 hover:text-amber-700 transition-all cursor-pointer flex items-center gap-1.5 whitespace-nowrap">
                        <i class="fa-solid fa-crown text-amber-500"></i> Peringkat
                    </button>
                </div>

                <div class="relative w-full sm:w-56">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" id="searchLeger" onkeyup="filterLeger()" placeholder="Cari nama atau NIS siswa..." 
                           class="w-full pl-9 pr-3 py-2 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:border-emerald-500 transition-colors">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="tableLeger">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        <th class="px-4 py-3.5 w-12 text-center">No</th>
                        <th class="px-4 py-3.5 min-w-[200px]">Nama Lengkap Siswa</th>
                        <?php $__currentLoopData = $rekap_mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="px-3 py-3.5 text-center min-w-[110px]" title="Pengajar: <?php echo e($m->guru_nama); ?> (KKM: <?php echo e($m->kkm); ?>)">
                                <span class="block text-[11px] font-bold text-slate-700 leading-tight"><?php echo e($m->nama_mapel); ?></span>
                                <span class="text-[10px] font-normal text-slate-400">KKM: <?php echo e($m->kkm); ?></span>
                            </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <th class="px-4 py-3.5 text-center bg-slate-100/70">Total</th>
                        <th class="px-4 py-3.5 text-center bg-slate-100/70">Rata-Rata</th>
                        <th class="px-4 py-3.5 text-center">Predikat</th>
                        <th class="px-4 py-3.5 text-center">Peringkat</th>
                        <th class="px-4 py-3.5 text-center">Rapor</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    <?php if($leger_siswa->count() > 0): ?>
                        <?php $__currentLoopData = $leger_siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $rankNum = is_numeric($row->peringkat) ? (int) $row->peringkat : 999999;
                                $isTop3Row = $rankNum <= 3;
                                $rowRankClass = $rankNum === 1
                                    ? 'siakad-rank-row-1'
                                    : ($rankNum === 2 ? 'siakad-rank-row-2' : ($rankNum === 3 ? 'siakad-rank-row-3' : ''));
                                $avatarRankClass = $rankNum === 1
                                    ? 'bg-gradient-to-br from-amber-300 to-amber-500 text-amber-950 ring-1 ring-amber-400/70'
                                    : ($rankNum === 2 ? 'bg-gradient-to-br from-slate-200 to-slate-400 text-slate-900 ring-1 ring-slate-400/60'
                                    : ($rankNum === 3 ? 'bg-gradient-to-br from-orange-200 to-orange-400 text-orange-950 ring-1 ring-orange-400/60'
                                    : 'bg-slate-100 text-slate-700'));
                            ?>
                            <tr class="leger-row <?php echo e($rowRankClass); ?> hover:bg-slate-50/70 transition-colors"
                                data-orig-index="<?php echo e($loop->iteration); ?>"
                                data-rank="<?php echo e($rankNum); ?>"
                                data-search="<?php echo e(strtolower($row->siswa->nama . ' ' . ($row->siswa->nis ?? ''))); ?>">
                                <td class="px-4 py-3.5 text-center text-slate-400 font-medium" data-row-number="true"><?php echo e($loop->iteration); ?></td>
                                <td class="px-4 py-3.5">
                                    <div class="flex items-center space-x-2.5">
                                        <div class="w-7 h-7 rounded-full <?php echo e($avatarRankClass); ?> flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                            <?php echo e(substr($row->siswa->nama, 0, 2)); ?>

                                        </div>
                                        <div>
                                            <span class="font-bold <?php echo e($isTop3Row ? 'text-slate-900' : 'text-slate-800'); ?> block leading-tight"><?php echo e($row->siswa->nama); ?></span>
                                            <span class="text-[11px] font-mono text-slate-400">NIS: <?php echo e($row->siswa->nis ?? '-'); ?></span>
                                        </div>
                                    </div>
                                </td>

                                <?php $__currentLoopData = $rekap_mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $cell = $row->nilai_mapel[$m->mapel_id] ?? ['ada' => false, 'nilai_akhir' => null, 'tuntas' => false];
                                    ?>
                                    <td class="px-3 py-3.5 text-center">
                                        <?php if($cell['ada']): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold <?php echo e($cell['tuntas'] ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200'); ?>">
                                                <?php echo e(number_format($cell['nilai_akhir'], 1)); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-xs text-slate-300">-</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <td class="px-4 py-3.5 text-center font-bold text-slate-800 bg-slate-50/50">
                                    <?php echo e($row->mapel_terisi > 0 ? number_format($row->total_nilai, 1) : '-'); ?>

                                </td>
                                <td class="px-4 py-3.5 text-center font-extrabold text-emerald-700 bg-slate-50/50">
                                    <?php echo e($row->mapel_terisi > 0 ? number_format($row->rata_rata, 1) : '-'); ?>

                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    <?php if($row->predikat !== '-'): ?>
                                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-bold <?php echo e($row->predikat == 'A' ? 'bg-blue-100 text-blue-800' : ($row->predikat == 'B' ? 'bg-emerald-100 text-emerald-800' : ($row->predikat == 'C' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800'))); ?>">
                                            <?php echo e($row->predikat); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    <?php if (isset($component)) { $__componentOriginal857dd9638daa2acd55509dbe6d317237 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal857dd9638daa2acd55509dbe6d317237 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.rank-badge','data' => ['rank' => $row->peringkat,'variant' => 'table']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.rank-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rank' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($row->peringkat),'variant' => 'table']); ?>
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
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    <a href="/sk/detail-rapor-walas/<?php echo e($row->siswa->id); ?>" 
                                       class="inline-flex items-center px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-200 text-xs font-semibold transition-colors" title="Lihat & Cetak Rapor">
                                        <i class="fa-solid fa-print mr-1"></i> Rapor
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="<?php echo e(7 + $rekap_mapel->count()); ?>" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-users-slash text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700">Belum Ada Siswa</h4>
                                <p class="text-xs text-slate-400 mt-1">Belum ada peserta didik terdaftar di kelas perwalian ini.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function filterLeger() {
            const q = (document.getElementById('searchLeger').value || '').toLowerCase();
            document.querySelectorAll('.leger-row').forEach(function(row) {
                const text = row.getAttribute('data-search') || '';
                const show = text.includes(q);
                row.setAttribute('data-filtered-out', show ? 'false' : 'true');
            });
            if (window.refreshSiakadPagination) window.refreshSiakadPagination();
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
<?php endif; ?>

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/guru/manajemenNilaiWalas.blade.php ENDPATH**/ ?>