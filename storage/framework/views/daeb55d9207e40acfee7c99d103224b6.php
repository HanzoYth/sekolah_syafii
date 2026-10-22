<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Slip Pembayaran & Monitoring Guru','description' => 'Pantau aktivitas mengajar, status kepegawaian (Tetap/Honor/Wali Kelas), serta rekapitulasi slip presensi dan honorarium guru.','position' => 'Admin SIAKAD','initials' => 'AD']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Slip Pembayaran & Monitoring Guru','description' => 'Pantau aktivitas mengajar, status kepegawaian (Tetap/Honor/Wali Kelas), serta rekapitulasi slip presensi dan honorarium guru.','position' => 'Admin SIAKAD','initials' => 'AD']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/das" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Slip Pembayaran & Kinerja Guru</span>
        </li>
     <?php $__env->endSlot(); ?>

    <!-- KPI Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6 no-print">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Guru</p>
                <h4 class="text-xl font-bold text-slate-800"><?php echo e($stats['total_guru']); ?></h4>
                <p class="text-[11px] text-slate-400 truncate">Pendidik aktif</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Guru Tetap</p>
                <h4 class="text-xl font-bold text-emerald-700"><?php echo e($stats['guru_tetap']); ?></h4>
                <p class="text-[11px] text-slate-400 truncate">Pegawai tetap</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Guru Honor</p>
                <h4 class="text-xl font-bold text-amber-700"><?php echo e($stats['guru_honor']); ?></h4>
                <p class="text-[11px] text-slate-400 truncate">Tenaga honorer</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Wali Kelas</p>
                <h4 class="text-xl font-bold text-purple-700"><?php echo e($stats['total_wallas']); ?></h4>
                <p class="text-[11px] text-slate-400 truncate">Pembimbing rombel</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Realisasi Sesi</p>
                <h4 class="text-xl font-bold text-teal-700"><?php echo e($stats['total_sesi_bulan']); ?> Sesi</h4>
                <p class="text-[11px] text-teal-600 font-semibold truncate"><?php echo e($stats['rata_disiplin']); ?>% Tepat Waktu</p>
            </div>
        </div>
    </div>

    <!-- Filter & Toolbar -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 mb-6 no-print">
        <form method="GET" action="/sk/gsp" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 flex-1">
                <!-- Periode Bulan -->
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1">Periode Bulan</label>
                    <div class="relative">
                        <i class="fa-regular fa-calendar absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="month" name="bulan" value="<?php echo e($bulan); ?>" onchange="this.form.submit()"
                               class="w-full pl-8 pr-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-semibold focus:outline-none focus:border-emerald-500 focus:bg-white transition-colors cursor-pointer">
                    </div>
                </div>

                <!-- Filter Jenjang -->
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1">Unit / Jenjang</label>
                    <select name="sekolah_id" onchange="this.form.submit()"
                            class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-semibold focus:outline-none focus:border-emerald-500 focus:bg-white transition-colors cursor-pointer">
                        <option value="">Semua Jenjang</option>
                        <?php $__currentLoopData = $data_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>" <?php echo e(($sekolah_id ?? '') == $s->id ? 'selected' : ''); ?>>
                                <?php echo e(strtoupper($s->jenis)); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Filter Status Kepegawaian -->
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1">Status Kepegawaian</label>
                    <select name="status" onchange="this.form.submit()"
                            class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-semibold focus:outline-none focus:border-emerald-500 focus:bg-white transition-colors cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="tetap" <?php echo e(($status_pegawai ?? '') == 'tetap' ? 'selected' : ''); ?>>Guru Tetap</option>
                        <option value="honor" <?php echo e(($status_pegawai ?? '') == 'honor' ? 'selected' : ''); ?>>Guru Honor</option>
                        <option value="wallas" <?php echo e(($status_pegawai ?? '') == 'wallas' ? 'selected' : ''); ?>>Wali Kelas Saja</option>
                    </select>
                </div>
            </div>

            <div class="flex items-end gap-2.5">
                <!-- Search Box -->
                <div class="relative w-full sm:w-64">
                    <label class="block text-xs font-semibold text-slate-500 mb-1">Pencarian Pendidik</label>
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" name="q" id="searchGuruInput" value="<?php echo e($search ?? ''); ?>" placeholder="Cari nama atau NIG..."
                               class="w-full pl-8 pr-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:outline-none focus:border-emerald-500 focus:bg-white transition-colors">
                    </div>
                </div>

                <button type="submit" class="px-3.5 py-2 text-xs font-bold bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg transition-colors flex items-center gap-1.5 self-end">
                    <i class="fa-solid fa-filter"></i> Terapkan
                </button>

                <?php if($search || $sekolah_id || $status_pegawai || $bulan != date('Y-m')): ?>
                    <a href="/sk/gsp" class="px-3 py-2 text-xs font-bold bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg transition-colors flex items-center gap-1 self-end" title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                <?php endif; ?>
            </div>

        </form>
    </div>

    <!-- Tabel Rekapitulasi & Monitoring Guru -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8 no-print">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-file-invoice-dollar text-emerald-700"></i>
                    Daftar Kinerja & Slip Pendidik ? Periode: <span class="text-emerald-700 font-extrabold"><?php echo e($carbonBulan->isoFormat('MMMM Y')); ?></span>
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Menampilkan <?php echo e(count($data_guru_rekap)); ?> guru pengajar</p>
            </div>
            <div>
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 bg-white border border-slate-200 px-3 py-1 rounded-lg">
                    <i class="fa-solid fa-calendar-check text-emerald-600"></i> <?php echo e($carbonBulan->isoFormat('MMMM Y')); ?>

                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 font-semibold text-slate-600 uppercase tracking-wider">
                        <th class="px-4 py-3.5 w-12 text-center">No</th>
                        <th class="px-4 py-3.5">Nama Guru / NIG</th>
                        <th class="px-4 py-3.5">Status & Penugasan</th>
                        <th class="px-4 py-3.5 text-center">Jadwal Mingguan</th>
                        <th class="px-4 py-3.5 text-center">Sesi Hadir (<?php echo e($carbonBulan->isoFormat('MMM')); ?>)</th>
                        <th class="px-4 py-3.5 text-center">Tepat Waktu</th>
                        <th class="px-4 py-3.5 text-center">Terlambat</th>
                        <th class="px-4 py-3.5 text-center">Indeks Disiplin</th>
                        <th class="px-4 py-3.5 text-center">Status Gaji</th>
                        <th class="px-4 py-3.5 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody id="guruTableBody" class="divide-y divide-slate-100">
                    <?php if(count($data_guru_rekap) > 0): ?>
                        <?php $__currentLoopData = $data_guru_rekap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $g = $item['guru'];
                                $wallas = $item['wallas'];
                                $statusPegawai = $g->guru_tetap ? 'Guru Tetap' : ($g->guru_honor ? 'Guru Honor' : 'Guru Pengajar');
                                $unitSekolah = $g->getSekolah ? strtoupper($g->getSekolah->jenis) : 'UMUM';
                                $indeks = $item['indeks_disiplin'];
                            ?>
                            <tr class="hover:bg-slate-50/70 transition-colors teacher-row">
                                <td class="px-4 py-3.5 text-center text-slate-400 font-medium"><?php echo e($loop->iteration); ?></td>
                                <td class="px-4 py-3.5">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-700 font-bold flex items-center justify-center text-xs flex-shrink-0 border border-emerald-100">
                                            <?php echo e(strtoupper(substr($g->nama, 0, 1))); ?>

                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-800 block text-xs"><?php echo e($g->nama); ?></span>
                                            <span class="text-[11px] text-slate-400 font-mono">NIG: <?php echo e($g->nig ?: '-'); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex flex-wrap items-center gap-1">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold <?php echo e($g->guru_tetap ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200'); ?>">
                                            <?php echo e($statusPegawai); ?>

                                        </span>
                                        <?php if($wallas && $wallas->ruangKelas): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-purple-50 text-purple-700 border border-purple-200" title="Wali Kelas <?php echo e($wallas->ruangKelas->nama_ruang); ?>">
                                                <i class="fa-solid fa-user-tie mr-1 text-[10px]"></i> Walas <?php echo e($wallas->ruangKelas->nama_ruang); ?>

                                            </span>
                                        <?php endif; ?>
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-600">
                                            <?php echo e($unitSekolah); ?>

                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-3.5 text-center font-bold text-slate-800">
                                    <?php echo e($item['jadwal_mingguan']); ?> Sesi
                                </td>
                                <td class="px-4 py-3.5 text-center font-extrabold text-slate-800">
                                    <?php echo e($item['total_sesi']); ?>

                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold text-[11px]">
                                        <?php echo e($item['tepat_waktu']); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    <span class="px-2 py-0.5 rounded <?php echo e($item['terlambat'] > 0 ? 'bg-amber-50 text-amber-700' : 'bg-slate-50 text-slate-400'); ?> font-bold text-[11px]">
                                        <?php echo e($item['terlambat']); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <div class="w-12 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                            <div class="h-1.5 rounded-full <?php echo e($indeks >= 90 ? 'bg-emerald-500' : ($indeks >= 75 ? 'bg-amber-500' : 'bg-rose-500')); ?>" style="width: <?php echo e($indeks); ?>%;"></div>
                                        </div>
                                        <span class="font-bold text-[11px] <?php echo e($indeks >= 90 ? 'text-emerald-700' : ($indeks >= 75 ? 'text-amber-700' : 'text-rose-700')); ?>">
                                            <?php echo e($indeks); ?>%
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    <?php if($item['gaji']): ?>
                                        <?php if($item['gaji']->publish): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <i class="fa-solid fa-check-circle mr-1"></i> Terbit
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                <i class="fa-solid fa-clock mr-1"></i> Draft
                                            </span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-slate-400 text-[11px]">Presensi</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button type="button" 
                                                onclick="bukaModalDetailGuru(<?php echo e(json_encode($item)); ?>, '<?php echo e($carbonBulan->isoFormat('MMMM Y')); ?>')" 
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-semibold transition-colors"
                                                title="Lihat Rincian Slip & Presensi">
                                            <i class="fa-solid fa-eye text-[11px]"></i> Detail
                                        </button>
                                        <button type="button" 
                                                onclick="cetakSlipLangsung(<?php echo e(json_encode($item)); ?>, '<?php echo e($carbonBulan->isoFormat('MMMM Y')); ?>')" 
                                                class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-xs font-bold transition-colors"
                                                title="Cetak Slip Resmi">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="px-6 py-12 text-center text-slate-500">
                                <i class="fa-solid fa-folder-open text-3xl mb-3 text-slate-300 block"></i>
                                Tidak ada data guru yang sesuai dengan kriteria filter.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL DETAIL SLIP & LOG PRESENSI GURU -->
    <div id="modalDetailGuru" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto no-print">
        <div class="bg-white rounded-2xl max-w-3xl w-full shadow-2xl transform transition-all my-8 overflow-hidden">
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg font-bold">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-slate-800" id="modalGuruNama">-</h4>
                        <p class="text-xs text-slate-500" id="modalGuruSub">-</p>
                    </div>
                </div>
                <button type="button" onclick="tutupModalDetailGuru()" class="w-8 h-8 rounded-lg bg-white border border-slate-200 hover:bg-slate-100 text-slate-400 hover:text-slate-600 flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <!-- Rangkuman Kinerja -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6 bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Beban Mingguan</span>
                        <strong class="text-sm text-slate-800 font-bold" id="modalJadwalMingguan">0 Sesi</strong>
                    </div>
                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Total Realisasi</span>
                        <strong class="text-sm text-slate-800 font-bold" id="modalTotalHadir">0 Sesi</strong>
                    </div>
                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Tepat Waktu</span>
                        <strong class="text-sm text-emerald-700 font-bold" id="modalTepatWaktu">0 Sesi</strong>
                    </div>
                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Indeks Disiplin</span>
                        <strong class="text-sm font-bold" id="modalIndeks">100%</strong>
                    </div>
                </div>

                <!-- Log Sesi Mengajar Bulan Ini -->
                <div class="mb-4">
                    <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 flex items-center justify-between">
                        <span><i class="fa-solid fa-list-check text-emerald-600 mr-1.5"></i> Riwayat Presensi Mengajar Periode Ini</span>
                        <span class="text-slate-400 text-[11px] font-normal" id="modalPeriodeLabel">-</span>
                    </h5>
                    <div class="max-h-64 overflow-y-auto border border-slate-200 rounded-xl">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead class="bg-slate-100 text-slate-600 font-semibold sticky top-0">
                                <tr>
                                    <th class="px-3 py-2 text-center w-10">No</th>
                                    <th class="px-3 py-2">Tanggal & Waktu</th>
                                    <th class="px-3 py-2">Mata Pelajaran</th>
                                    <th class="px-3 py-2">Kelas</th>
                                    <th class="px-3 py-2 text-center">Status</th>
                                    <th class="px-3 py-2">Materi</th>
                                </tr>
                            </thead>
                            <tbody id="modalLogAbsenBody" class="divide-y divide-slate-100">
                                <!-- Diisi via JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
                <button type="button" onclick="tutupModalDetailGuru()" class="px-4 py-2 text-xs font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-100 transition-colors">
                    Tutup
                </button>
                <button type="button" id="btnModalCetak" class="px-4 py-2 text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 rounded-xl transition-colors inline-flex items-center gap-1.5 shadow-sm shadow-emerald-200">
                    <i class="fa-solid fa-print"></i> Cetak Bukti Slip Pendidik
                </button>
            </div>
        </div>
    </div>

    <!-- AREA BUKTI CETAK SLIP GURU RESMI (A4 PRINT FRIENDLY) -->
    <div id="adminSlipPrintContainer" class="hidden print-area bg-white rounded-xl border border-slate-400 p-8 max-w-2xl mx-auto my-4 text-slate-900">
        <!-- Kop Slip -->
        <div class="text-center border-b-2 border-slate-900 pb-4 mb-6">
            <h2 class="text-base font-extrabold uppercase tracking-wide">YAYASAN PENDIDIKAN ISLAM SYAFI'I</h2>
            <h3 class="text-sm font-bold uppercase text-slate-700">SISTEM INFORMASI AKADEMIK (SIAKAD)</h3>
            <p class="text-xs font-medium text-slate-500 mt-1">Bukti Rekapitulasi Presensi Mengajar & Slip Honorarium Pendidik</p>
        </div>

        <!-- Info Guru -->
        <div class="grid grid-cols-2 gap-3 text-xs mb-6 bg-slate-50 p-4 rounded-lg border border-slate-300">
            <div>
                <p class="text-slate-500 text-[11px]">Nama Pendidik:</p>
                <p class="font-bold text-slate-900 text-sm" id="prnNama">-</p>
            </div>
            <div>
                <p class="text-slate-500 text-[11px]">NIG / Nomor Induk Guru:</p>
                <p class="font-mono font-bold text-slate-900 text-sm" id="prnNig">-</p>
            </div>
            <div>
                <p class="text-slate-500 text-[11px]">Status Kepegawaian:</p>
                <p class="font-bold text-slate-800" id="prnStatus">-</p>
            </div>
            <div>
                <p class="text-slate-500 text-[11px]">Periode Rekapitulasi:</p>
                <p class="font-bold text-slate-800" id="prnPeriode">-</p>
            </div>
        </div>

        <!-- Tabel Capaian -->
        <table class="w-full border-collapse border border-slate-400 text-xs mb-6">
            <thead>
                <tr class="bg-slate-100">
                    <th class="border border-slate-400 px-3 py-2 text-left">Komponen Kinerja & Presensi Mengajar</th>
                    <th class="border border-slate-400 px-3 py-2 text-center w-32">Capaian Aktual</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-slate-400 px-3 py-2">Beban Jadwal Mengajar Mingguan</td>
                    <td class="border border-slate-400 px-3 py-2 text-center font-bold" id="prnBeban">0 Sesi / Minggu</td>
                </tr>
                <tr>
                    <td class="border border-slate-400 px-3 py-2">Total Realisasi Kehadiran Mengajar Bulan Ini</td>
                    <td class="border border-slate-400 px-3 py-2 text-center font-bold" id="prnTotal">0 Sesi</td>
                </tr>
                <tr>
                    <td class="border border-slate-400 px-3 py-2">Kehadiran Tepat Waktu (&le; 5 Menit Toleransi)</td>
                    <td class="border border-slate-400 px-3 py-2 text-center font-bold text-emerald-800" id="prnTepat">0 Sesi</td>
                </tr>
                <tr>
                    <td class="border border-slate-400 px-3 py-2">Kehadiran Terlambat (&gt; 5 Menit)</td>
                    <td class="border border-slate-400 px-3 py-2 text-center font-bold text-amber-800" id="prnTerlambat">0 Sesi</td>
                </tr>
                <tr class="bg-slate-50 font-bold">
                    <td class="border border-slate-400 px-3 py-2">Indeks Ketepatan Waktu & Disiplin</td>
                    <td class="border border-slate-400 px-3 py-2 text-center font-extrabold" id="prnIndeks">100%</td>
                </tr>
            </tbody>
        </table>

        <!-- Catatan & Tanda Tangan -->
        <div class="flex justify-between items-end text-xs text-slate-600 mt-12">
            <div>
                <p class="text-[10px] text-slate-400">Dicetak melalui SIAKAD Administrator pada <?php echo e(date('d/m/Y H:i')); ?></p>
                <p class="text-[10px] text-slate-400">Dokumen sah verifikasi kehadiran akademik sekolah</p>
            </div>
            <div class="text-center w-48">
                <p class="mb-14">Bagian Keuangan & Administrasi</p>
                <p class="font-bold underline text-slate-900">............................................</p>
            </div>
        </div>
    </div>

    <script>
        let currentActiveItem = null;
        let currentPeriodeText = '';

        // Live search filter in table
        document.getElementById('searchGuruInput')?.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            document.querySelectorAll('#guruTableBody tr.teacher-row').forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(query) ? '' : 'none';
            });
        });

        // Buka Modal Detail Guru
        function bukaModalDetailGuru(item, periodeText) {
            currentActiveItem = item;
            currentPeriodeText = periodeText;

            const g = item.guru;
            const wallas = item.wallas;
            const statusPegawai = g.guru_tetap ? 'Guru Tetap' : (g.guru_honor ? 'Guru Honor' : 'Guru Pengajar');
            const unit = g.get_sekolah ? g.get_sekolah.jenis.toUpperCase() : 'UMUM';
            const walasText = wallas && wallas.ruang_kelas ? ` • Walas ${wallas.ruang_kelas.nama_ruang}` : '';

            document.getElementById('modalGuruNama').innerText = g.nama;
            document.getElementById('modalGuruSub').innerText = `NIG: ${g.nig || '-'} • ${statusPegawai}${walasText} (${unit})`;
            document.getElementById('modalPeriodeLabel').innerText = `Periode: ${periodeText}`;

            document.getElementById('modalJadwalMingguan').innerText = `${item.jadwal_mingguan} Sesi`;
            document.getElementById('modalTotalHadir').innerText = `${item.total_sesi} Sesi`;
            document.getElementById('modalTepatWaktu').innerText = `${item.tepat_waktu} Sesi`;
            
            const indeksEl = document.getElementById('modalIndeks');
            indeksEl.innerText = `${item.indeks_disiplin}%`;
            indeksEl.className = `text-sm font-bold ${item.indeks_disiplin >= 90 ? 'text-emerald-700' : (item.indeks_disiplin >= 75 ? 'text-amber-700' : 'text-rose-700')}`;

            // Render Log Absen
            const tbody = document.getElementById('modalLogAbsenBody');
            tbody.innerHTML = '';

            if (item.log_absen && item.log_absen.length > 0) {
                item.log_absen.forEach((log, index) => {
                    const mapelNama = log.jadwal && log.jadwal.mata_pelajaran ? log.jadwal.mata_pelajaran.nama_mapel : '-';
                    const kelasNama = log.jadwal && log.jadwal.kelas ? log.jadwal.kelas.nama_kelas : '-';
                    const jamMasuk = log.jam_masuk ? log.jam_masuk.substring(0, 5) : '-';
                    const isTepat = log.status === 'tepat_waktu';

                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-slate-50';
                    tr.innerHTML = `
                        <td class="px-3 py-2 text-center text-slate-400">${index + 1}</td>
                        <td class="px-3 py-2 font-medium text-slate-800">${log.tanggal} <span class="text-slate-400 text-[10px]">(${jamMasuk})</span></td>
                        <td class="px-3 py-2 font-semibold text-slate-700">${mapelNama}</td>
                        <td class="px-3 py-2 text-slate-600">${kelasNama}</td>
                        <td class="px-3 py-2 text-center">
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold ${isTepat ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'}">
                                ${isTepat ? 'Tepat Waktu' : 'Terlambat'}
                            </span>
                        </td>
                        <td class="px-3 py-2 text-slate-500 text-[11px] max-w-xs truncate" title="${log.materi || '-'}">${log.materi || '-'}</td>
                    `;
                    tbody.appendChild(tr);
                });
            } else {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-400">
                            Belum ada riwayat kehadiran mengajar yang tercatat pada periode ini.
                        </td>
                    </tr>
                `;
            }

            document.getElementById('btnModalCetak').onclick = function() {
                cetakSlipLangsung(item, periodeText);
            };

            document.getElementById('modalDetailGuru').classList.remove('hidden');
        }

        function tutupModalDetailGuru() {
            document.getElementById('modalDetailGuru').classList.add('hidden');
        }

        // Cetak Slip Resmi
        function cetakSlipLangsung(item, periodeText) {
            const g = item.guru;
            const wallas = item.wallas;
            const statusPegawai = g.guru_tetap ? 'Guru Tetap' : (g.guru_honor ? 'Guru Honor' : 'Guru Pengajar');
            const walasText = wallas && wallas.ruang_kelas ? ` (Wali Kelas ${wallas.ruang_kelas.nama_ruang})` : '';

            document.getElementById('prnNama').innerText = g.nama;
            document.getElementById('prnNig').innerText = g.nig || '-';
            document.getElementById('prnStatus').innerText = statusPegawai + walasText;
            document.getElementById('prnPeriode').innerText = periodeText;

            document.getElementById('prnBeban').innerText = `${item.jadwal_mingguan} Sesi / Minggu`;
            document.getElementById('prnTotal').innerText = `${item.total_sesi} Sesi`;
            document.getElementById('prnTepat').innerText = `${item.tepat_waktu} Sesi`;
            document.getElementById('prnTerlambat').innerText = `${item.terlambat} Sesi`;
            document.getElementById('prnIndeks').innerText = `${item.indeks_disiplin}%`;

            const container = document.getElementById('adminSlipPrintContainer');
            container.classList.remove('hidden');
            window.print();
        }
    </script>

    <style>
        @media print {
            body * { visibility: hidden; }
            .no-print { display: none !important; }
            .print-area, .print-area * { visibility: visible; }
            .print-area {
                display: block !important;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
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

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\siakad\admin\slipPembayaranGuru.blade.php ENDPATH**/ ?>