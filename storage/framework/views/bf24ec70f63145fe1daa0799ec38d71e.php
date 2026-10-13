<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Jadwal Pelajaran, Absensi & Jurnal Belajar','description' => 'Pantau jadwal pelajaran mingguan, jurnal materi yang diajarkan guru, serta rekapitulasi kehadiran ananda '.e($siswa->nama).'.','position' => 'Siswa / Orang Tua','initials' => 'SW']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Jadwal Pelajaran, Absensi & Jurnal Belajar','description' => 'Pantau jadwal pelajaran mingguan, jurnal materi yang diajarkan guru, serta rekapitulasi kehadiran ananda '.e($siswa->nama).'.','position' => 'Siswa / Orang Tua','initials' => 'SW']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/dbs" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Jadwal & Absensi</span>
        </li>
     <?php $__env->endSlot(); ?>

    <?php
        $activeTab = $tab ?? request('tab', 'jadwal');
        $namaKelas = $siswa->kelas->nama_ruang ?? ($siswa->kelas->nama_kelas ?? 'Belum Ada Kelas');
    ?>

    <!-- Top Rekap Kehadiran Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-3.5 col-span-2 sm:col-span-1">
            <div class="w-10 h-10 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-chart-pie"></i>
            </div>
            <div>
                <span class="block text-xl font-bold text-slate-800"><?php echo e($rekap_absen['persentase'] ?? 100); ?>%</span>
                <span class="text-[11px] font-semibold text-slate-500 uppercase">Kehadiran</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <div>
                <span class="block text-xl font-bold text-emerald-700"><?php echo e($rekap_absen['h'] ?? 0); ?></span>
                <span class="text-[11px] font-semibold text-emerald-800 uppercase">Hadir (H)</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-amber-200 p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-notes-medical"></i>
            </div>
            <div>
                <span class="block text-xl font-bold text-amber-700"><?php echo e($rekap_absen['s'] ?? 0); ?></span>
                <span class="text-[11px] font-semibold text-amber-800 uppercase">Sakit (S)</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            <div>
                <span class="block text-xl font-bold text-blue-700"><?php echo e($rekap_absen['i'] ?? 0); ?></span>
                <span class="text-[11px] font-semibold text-blue-800 uppercase">Izin (I)</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-rose-200 p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-user-xmark"></i>
            </div>
            <div>
                <span class="block text-xl font-bold text-rose-700"><?php echo e($rekap_absen['a'] ?? 0); ?></span>
                <span class="text-[11px] font-semibold text-rose-800 uppercase">Alpa (A)</span>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="inline-flex flex-wrap p-1.5 rounded-xl bg-slate-200/70 border border-slate-200 gap-1">
            <a href="/sk/jadwal-siswa?tab=jadwal" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all <?php echo e($activeTab === 'jadwal' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800'); ?>">
                <i class="fa-solid fa-calendar-week"></i>
                <span>Jadwal Pelajaran (<?php echo e($jadwal->count()); ?>)</span>
            </a>
            <a href="/sk/jadwal-siswa?tab=absensi_mapel" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all <?php echo e($activeTab === 'absensi_mapel' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800'); ?>">
                <i class="fa-solid fa-book-open-reader"></i>
                <span>Absensi Mapel & Jurnal Belajar (<?php echo e(isset($riwayat_absensi_mapel) ? $riwayat_absensi_mapel->count() : 0); ?>)</span>
            </a>
            <a href="/sk/jadwal-siswa?tab=absensi_harian" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all <?php echo e($activeTab === 'absensi_harian' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800'); ?>">
                <i class="fa-solid fa-clipboard-user"></i>
                <span>Presensi Harian Wali Kelas (<?php echo e(isset($riwayat_absensi_harian) ? $riwayat_absensi_harian->count() : 0); ?>)</span>
            </a>
        </div>

        <div class="flex items-center gap-2 text-xs text-slate-600 bg-white px-3.5 py-2 rounded-xl border border-slate-200 shadow-sm self-start sm:self-auto">
            <i class="fa-solid fa-school text-emerald-600"></i>
            <span>Kelas: <strong><?php echo e($namaKelas); ?></strong></span>
            <?php if(isset($wallas) && $wallas && $wallas->guru): ?>
                <span class="text-slate-300">|</span>
                <span>Walas: <strong><?php echo e($wallas->guru->nama); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>

    <?php if($activeTab === 'absensi_mapel'): ?>
        <!-- TAB 2: RIWAYAT ABSENSI MAPEL & JURNAL MATERI GURU -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Riwayat Kehadiran Per Mata Pelajaran & Jurnal Belajar</h3>
                    <p class="text-xs text-slate-500">Rekaman kehadiran siswa pada setiap jam pelajaran beserta pokok bahasan materi yang diajarkan oleh Guru Pengajar</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                    Kehadiran Sesi Mapel: <?php echo e($rekap_absen_mapel['persentase'] ?? 100); ?>% (<?php echo e($rekap_absen_mapel['h'] ?? 0); ?>/<?php echo e($rekap_absen_mapel['total'] ?? 0); ?> Sesi)
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            <th class="px-5 py-3.5 w-12 text-center">No</th>
                            <th class="px-5 py-3.5">Tanggal & Waktu</th>
                            <th class="px-5 py-3.5">Mata Pelajaran</th>
                            <th class="px-5 py-3.5">Guru Pengajar</th>
                            <th class="px-5 py-3.5">Jurnal Materi & Kegiatan Belajar</th>
                            <th class="px-5 py-3.5 text-center">Kehadiran Siswa</th>
                            <th class="px-5 py-3.5">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php if(isset($riwayat_absensi_mapel) && $riwayat_absensi_mapel->count() > 0): ?>
                            <?php $__currentLoopData = $riwayat_absensi_mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="px-5 py-4 text-center text-slate-400 font-medium"><?php echo e($loop->iteration); ?></td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <span class="font-bold text-slate-800 block"><?php echo e(\Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd, D MMM Y')); ?></span>
                                        <?php if($item->jadwal && $item->jadwal->jam_pelajaran): ?>
                                            <span class="text-xs text-slate-400 font-mono">
                                                <?php echo e(substr($item->jadwal->jam_pelajaran->jam_mulai, 0, 5)); ?> - <?php echo e(substr($item->jadwal->jam_pelajaran->jam_selesai, 0, 5)); ?> WIB
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="font-bold text-slate-800"><?php echo e($item->jadwal->mata_pelajaran->nama_mapel ?? '-'); ?></span>
                                    </td>
                                    <td class="px-5 py-4 text-slate-700 font-medium">
                                        <?php echo e($item->jadwal->guru->nama ?? ($item->guru->nama ?? '-')); ?>

                                    </td>
                                    <td class="px-5 py-4">
                                        <?php if(!empty($item->jurnal_materi)): ?>
                                            <span class="font-semibold text-emerald-800 block text-xs">
                                                <i class="fa-solid fa-book-bookmark text-[10px] mr-1 text-emerald-600"></i><?php echo e($item->jurnal_materi); ?>

                                            </span>
                                            <?php if(!empty($item->jurnal_catatan)): ?>
                                                <span class="text-[11px] text-slate-500 italic block mt-0.5">"<?php echo e($item->jurnal_catatan); ?>"</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="text-xs text-slate-400 italic">Materi belum dicatat</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <?php if($item->status == 'h'): ?>
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-check mr-1 text-[10px]"></i> Hadir
                                            </span>
                                        <?php elseif($item->status == 's'): ?>
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                                <i class="fa-solid fa-notes-medical mr-1 text-[10px]"></i> Sakit
                                            </span>
                                        <?php elseif($item->status == 'i'): ?>
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                                <i class="fa-solid fa-envelope-open mr-1 text-[10px]"></i> Izin
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                                                <i class="fa-solid fa-xmark mr-1 text-[10px]"></i> Alpa
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-4 text-xs text-slate-500">
                                        <?php echo e($item->keterangan ?: '-'); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                        <i class="fa-solid fa-book-open text-2xl"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-700">Belum Ada Riwayat Absensi Sesi Mata Pelajaran</h4>
                                    <p class="text-xs text-slate-400 mt-1">Data presensi mapel dan jurnal materi belajar akan muncul setelah Guru Pengajar melakukan absensi di kelas.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php elseif($activeTab === 'absensi_harian'): ?>
        <!-- TAB 3: RIWAYAT PRESENSI HARIAN WALI KELAS -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Riwayat Presensi Harian Kelas (Wali Kelas)</h3>
                    <p class="text-xs text-slate-500">Catatan kehadiran harian yang direkap oleh Wali Kelas sebagai dasar laporan ketidakhadiran di Rapor</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                    Total Hari Efektif Tercatat: <?php echo e(isset($riwayat_absensi_harian) ? $riwayat_absensi_harian->count() : 0); ?> Hari
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            <th class="px-5 py-3.5 w-14 text-center">No</th>
                            <th class="px-5 py-3.5">Hari & Tanggal</th>
                            <th class="px-5 py-3.5">Kelas</th>
                            <th class="px-5 py-3.5">Dicatat Oleh</th>
                            <th class="px-5 py-3.5 text-center">Status Kehadiran</th>
                            <th class="px-5 py-3.5">Keterangan Wali Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php if(isset($riwayat_absensi_harian) && $riwayat_absensi_harian->count() > 0): ?>
                            <?php $__currentLoopData = $riwayat_absensi_harian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="px-5 py-4 text-center text-slate-400 font-medium"><?php echo e($loop->iteration); ?></td>
                                    <td class="px-5 py-4 font-bold text-slate-800">
                                        <?php echo e(\Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd, D MMMM Y')); ?>

                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="px-2.5 py-1 rounded-md bg-slate-100 text-slate-700 text-xs font-semibold"><?php echo e($namaKelas); ?></span>
                                    </td>
                                    <td class="px-5 py-4 text-slate-600">
                                        <?php echo e($item->guru->nama ?? ($wallas->guru->nama ?? 'Wali Kelas')); ?>

                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <?php if($item->status == 'h'): ?>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-circle-check mr-1.5 text-[10px]"></i> Hadir
                                            </span>
                                        <?php elseif($item->status == 's'): ?>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                                <i class="fa-solid fa-notes-medical mr-1.5 text-[10px]"></i> Sakit
                                            </span>
                                        <?php elseif($item->status == 'i'): ?>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                                <i class="fa-solid fa-envelope-open mr-1.5 text-[10px]"></i> Izin
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                                                <i class="fa-solid fa-triangle-exclamation mr-1.5 text-[10px]"></i> Tanpa Keterangan (Alpa)
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-4 text-xs text-slate-500">
                                        <?php echo e($item->keterangan ?: '-'); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                        <i class="fa-solid fa-clipboard-user text-2xl"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-700">Belum Ada Presensi Harian Wali Kelas</h4>
                                    <p class="text-xs text-slate-400 mt-1">Data presensi harian akan muncul setelah Wali Kelas menginput daftar hadir kelas.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php else: ?>
        <!-- TAB 1: JADWAL PELAJARAN HARI INI & MINGGUAN -->
        <?php if(isset($jadwal_hari_ini) && $jadwal_hari_ini->count() > 0): ?>
            <div class="bg-white rounded-xl shadow-sm border border-emerald-200 overflow-hidden mb-8">
                <div class="px-6 py-4 bg-emerald-50/60 border-b border-emerald-200 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center text-sm">
                            <i class="fa-solid fa-calendar-day"></i>
                        </span>
                        <div>
                            <h3 class="text-sm font-bold text-slate-800">Jadwal Pelajaran Hari Ini (<?php echo e($hari_ini_label); ?>)</h3>
                            <p class="text-xs text-slate-500">Status kehadiran guru pengajar, materi hari ini, dan presensi ananda di kelas</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                <th class="px-5 py-3 w-12 text-center">No</th>
                                <th class="px-5 py-3">Waktu</th>
                                <th class="px-5 py-3">Mata Pelajaran</th>
                                <th class="px-5 py-3">Guru Pengajar</th>
                                <th class="px-5 py-3">Materi Hari Ini</th>
                                <th class="px-5 py-3 text-center">Status Guru</th>
                                <th class="px-5 py-3 text-center">Presensi Siswa</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <?php $__currentLoopData = $jadwal_hari_ini; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $ag = $absensi_guru_hari_ini[$j->id] ?? null;
                                    $as = $absensi_siswa_hari_ini[$j->id] ?? null;
                                ?>
                                <tr class="hover:bg-slate-50/60">
                                    <td class="px-5 py-3.5 text-center text-slate-400 font-medium"><?php echo e($loop->iteration); ?></td>
                                    <td class="px-5 py-3.5 font-mono text-xs font-bold text-slate-700 whitespace-nowrap">
                                        <?php echo e(substr($j->jam_pelajaran->jam_mulai ?? '', 0, 5)); ?> - <?php echo e(substr($j->jam_pelajaran->jam_selesai ?? '', 0, 5)); ?> WIB
                                    </td>
                                    <td class="px-5 py-3.5 font-bold text-slate-800"><?php echo e($j->mata_pelajaran->nama_mapel ?? '-'); ?></td>
                                    <td class="px-5 py-3.5 text-slate-700"><?php echo e($j->guru->nama ?? '-'); ?></td>
                                    <td class="px-5 py-3.5 text-xs">
                                        <?php if($ag && $ag->materi): ?>
                                            <span class="font-semibold text-emerald-800"><?php echo e($ag->materi); ?></span>
                                        <?php else: ?>
                                            <span class="text-slate-400 italic">Belum diisi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <?php if($ag): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-check mr-1 text-[10px]"></i> Hadir (<?php echo e(substr($ag->jam_masuk, 0, 5)); ?>)
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                                                Terjadwal
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <?php if($as): ?>
                                            <?php if($as->status == 'h'): ?>
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">Hadir</span>
                                            <?php elseif($as->status == 's'): ?>
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">Sakit</span>
                                            <?php elseif($as->status == 'i'): ?>
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800">Izin</span>
                                            <?php else: ?>
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800">Alpa</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="text-xs text-slate-400">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <!-- Jadwal Pelajaran Mingguan Lengkap -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Jadwal Mata Pelajaran Mingguan (<?php echo e($namaKelas); ?>)</h3>
                    <p class="text-xs text-slate-500">Susunan jadwal belajar dari hari Senin hingga Sabtu</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                    Total <?php echo e($jadwal->count()); ?> Sesi Pelajaran / Minggu
                </span>
            </div>

            <div class="p-6">
                <?php if($jadwal->count() > 0): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php $__currentLoopData = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $list_hari = isset($jadwal_per_hari) ? $jadwal_per_hari->get($hari, collect()) : $jadwal->filter(fn($item) => strtolower($item->hari) === $hari);
                            ?>
                            <?php if($list_hari->count() > 0): ?>
                                <div class="border border-slate-200 rounded-xl overflow-hidden flex flex-col">
                                    <div class="px-4 py-3 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                                        <span class="text-xs font-extrabold uppercase tracking-wider text-slate-800 flex items-center gap-2">
                                            <i class="fa-solid fa-calendar-day text-emerald-600"></i> Hari <?php echo e(ucfirst($hari)); ?>

                                        </span>
                                        <span class="text-[11px] font-semibold text-slate-500"><?php echo e($list_hari->count()); ?> Mapel</span>
                                    </div>
                                    <div class="divide-y divide-slate-100">
                                        <?php $__currentLoopData = $list_hari; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="p-4 hover:bg-slate-50/60 transition-colors flex items-center justify-between gap-3">
                                                <div>
                                                    <h4 class="text-sm font-bold text-slate-800"><?php echo e($j->mata_pelajaran->nama_mapel ?? '-'); ?></h4>
                                                    <p class="text-xs text-slate-500 mt-0.5">
                                                        <i class="fa-solid fa-chalkboard-user text-[10px] mr-1 text-slate-400"></i> <?php echo e($j->guru->nama ?? '-'); ?>

                                                    </p>
                                                </div>
                                                <div class="text-right flex-shrink-0">
                                                    <span class="inline-block px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200 font-mono text-xs font-bold">
                                                        <?php echo e(substr($j->jam_pelajaran->jam_mulai ?? '-', 0, 5)); ?> - <?php echo e(substr($j->jam_pelajaran->jam_selesai ?? '-', 0, 5)); ?>

                                                    </span>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="py-12 text-center text-slate-500">
                        <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                            <i class="fa-solid fa-calendar-xmark text-2xl"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-700">Belum Ada Jadwal Pelajaran</h4>
                        <p class="text-xs text-slate-400 mt-1">Jadwal pelajaran untuk kelas <?php echo e($namaKelas); ?> belum diatur oleh Admin Akademik.</p>
                    </div>
                <?php endif; ?>
            </div>
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/siswa/jadwalSiswa.blade.php ENDPATH**/ ?>