<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Absensi & Rekap Kehadiran Kelas','description' => 'Kelola presensi harian siswa perwalian dan pantau rekapitulasi kehadiran akumulatif semester.','position' => 'Guru Wali Kelas','initials' => 'WK']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Absensi & Rekap Kehadiran Kelas','description' => 'Kelola presensi harian siswa perwalian dan pantau rekapitulasi kehadiran akumulatif semester.','position' => 'Guru Wali Kelas','initials' => 'WK']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Absensi Kelas (<?php echo e($wallas->ruangKelas->nama_ruang ?? '-'); ?>)</span>
        </li>
     <?php $__env->endSlot(); ?>

    <style>
        /* Mobile Card View untuk Konsolidasi Absensi Siswa Wali Kelas */
        @media (max-width: 768px) {
            .walas-absensi-wrapper {
                background: #f8fafc;
                padding: 12px 10px !important;
            }
            .walas-absensi-table, 
            .walas-absensi-table thead, 
            .walas-absensi-table tbody, 
            .walas-absensi-table tr, 
            .walas-absensi-table td {
                display: block !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }
            .walas-absensi-table {
                min-width: 0 !important;
                border: none !important;
            }
            .walas-absensi-table thead {
                display: none !important;
            }
            .walas-absensi-row {
                background: #ffffff !important;
                border: 1px solid #e2e8f0 !important;
                border-radius: 14px !important;
                margin-bottom: 12px !important;
                padding: 14px !important;
                box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05) !important;
                transition: all 0.2s ease !important;
            }
            .walas-absensi-row td {
                padding: 0 !important;
                border: none !important;
            }
            .walas-absensi-row td.col-no,
            .walas-absensi-row td.col-nis {
                display: none !important;
            }
            .walas-absensi-row td.col-nama {
                margin-bottom: 10px !important;
            }
            .walas-absensi-row td.col-status-harian {
                margin-bottom: 10px !important;
            }
            .walas-absensi-row td.col-mapel {
                margin-bottom: 10px !important;
                background: #f8fafc !important;
                padding: 10px 12px !important;
                border-radius: 10px !important;
                border: 1px solid #f1f5f9 !important;
            }
            .walas-absensi-row td.col-catatan {
                padding-top: 4px !important;
            }
        }
    </style>

    <?php if(session('success')): ?>
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3 shadow-sm">
            <i class="fa-solid fa-circle-check text-emerald-600 text-lg mt-0.5"></i>
            <div>
                <p class="font-semibold text-sm">Berhasil!</p>
                <p class="text-sm mt-0.5"><?php echo e(session('success')); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php
        $activeTab = $tab ?? request('tab', 'harian');
    ?>

    <!-- Header & Tab Switcher -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="inline-flex flex-wrap p-1.5 rounded-xl bg-slate-200/70 border border-slate-200 self-start gap-1">
            <a href="/sk/absensi-walas?tab=harian&tanggal=<?php echo e($tanggal); ?>" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all <?php echo e($activeTab !== 'rekap' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800'); ?>">
                <i class="fa-solid fa-clipboard-user"></i>
                <span>Input Absensi Harian</span>
            </a>
            <a href="/sk/absensi-walas?tab=rekap&tanggal=<?php echo e($tanggal); ?>" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all <?php echo e($activeTab === 'rekap' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800'); ?>">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Rekap Akumulasi Semester</span>
            </a>
        </div>

        <form method="GET" action="/sk/absensi-walas" class="flex flex-wrap items-center gap-2.5">
            <input type="hidden" name="tab" value="<?php echo e($activeTab); ?>">
            <div class="relative">
                <i class="fa-regular fa-calendar absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="date" name="tanggal" value="<?php echo e($tanggal); ?>" 
                       class="pl-9 pr-3 py-2 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 font-semibold focus:outline-none focus:border-emerald-500 shadow-sm">
            </div>
            <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition-colors shadow-sm flex items-center gap-1.5">
                <i class="fa-solid fa-filter text-[10px]"></i> Tampilkan
            </button>
        </form>
    </div>

    <?php if($activeTab === 'rekap'): ?>
        <!-- TAB 2: REKAP AKUMULASI KEHADIRAN SEMESTER -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="fa-solid fa-school"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500">Kelas Perwalian</p>
                    <h3 class="text-xl font-bold text-slate-800"><?php echo e($wallas->ruangKelas->nama_ruang ?? '-'); ?></h3>
                    <p class="text-[11px] text-slate-400 mt-0.5"><?php echo e(count($siswa)); ?> Peserta Didik</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500">Total Hari Efektif Tercatat</p>
                    <h3 class="text-xl font-bold text-slate-800"><?php echo e($total_hari_efektif ?? 0); ?> Hari</h3>
                    <p class="text-[11px] text-emerald-600 font-semibold mt-0.5">Presensi Harian Wali Kelas</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="fa-solid fa-file-contract"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500">Sinkronisasi Rapor</p>
                    <h3 class="text-base font-bold text-slate-800">Otomatis Terhubung</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Total S/I/A masuk ke cetak rapor</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Tabel Rekapitulasi Kehadiran Siswa (Akumulasi Semester)</h3>
                    <p class="text-xs text-slate-500">Pantau siswa yang sering izin, sakit, atau tanpa keterangan (alpa) untuk pembinaan lebih lanjut</p>
                </div>
                <a href="/sk/rapor-walas" class="inline-flex items-center px-3.5 py-2 rounded-lg bg-slate-800 hover:bg-slate-900 text-white text-xs font-semibold transition-colors self-start sm:self-auto">
                    <i class="fa-solid fa-print mr-1.5"></i> Cetak Rapor
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            <th class="px-5 py-3.5 w-14 text-center">No</th>
                            <th class="px-5 py-3.5">NIS</th>
                            <th class="px-5 py-3.5">Nama Lengkap Siswa</th>
                            <th class="px-5 py-3.5 text-center">Hadir (H)</th>
                            <th class="px-5 py-3.5 text-center">Sakit (S)</th>
                            <th class="px-5 py-3.5 text-center">Izin (I)</th>
                            <th class="px-5 py-3.5 text-center">Alpa (A)</th>
                            <th class="px-5 py-3.5 text-center">Persentase Hadir</th>
                            <th class="px-5 py-3.5 text-center">Evaluasi Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php if(count($siswa) > 0): ?>
                            <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $rk = $rekap_akumulasi[$s->id] ?? ['hadir' => 0, 'sakit' => 0, 'izin' => 0, 'alpa' => 0, 'total' => 0, 'persentase' => 0];
                                    $pct = $rk['persentase'];
                                ?>
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="px-5 py-3.5 text-center text-slate-400 font-medium"><?php echo e($loop->iteration); ?></td>
                                    <td class="px-5 py-3.5 font-mono text-xs text-slate-500"><?php echo e($s->nis ?? '-'); ?></td>
                                    <td class="px-5 py-3.5 font-semibold text-slate-800"><?php echo e($s->nama); ?></td>
                                    <td class="px-5 py-3.5 text-center">
                                        <span class="px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 font-bold text-xs"><?php echo e($rk['hadir']); ?></span>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <span class="px-2.5 py-1 rounded-md bg-amber-50 text-amber-700 font-bold text-xs"><?php echo e($rk['sakit']); ?></span>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <span class="px-2.5 py-1 rounded-md bg-blue-50 text-blue-700 font-bold text-xs"><?php echo e($rk['izin']); ?></span>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <span class="px-2.5 py-1 rounded-md <?php echo e($rk['alpa'] > 0 ? 'bg-rose-100 text-rose-800' : 'bg-slate-50 text-slate-500'); ?> font-bold text-xs"><?php echo e($rk['alpa']); ?></span>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <?php if($rk['total'] > 0): ?>
                                            <div class="inline-flex items-center gap-2">
                                                <div class="w-16 h-2 bg-slate-100 rounded-full overflow-hidden">
                                                    <div class="h-full <?php echo e($pct >= 90 ? 'bg-emerald-500' : ($pct >= 75 ? 'bg-amber-500' : 'bg-rose-500')); ?>" style="width: <?php echo e($pct); ?>%"></div>
                                                </div>
                                                <span class="text-xs font-bold text-slate-700"><?php echo e($pct); ?>%</span>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-xs text-slate-400">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <?php if($rk['total'] == 0): ?>
                                            <span class="text-xs text-slate-400 italic">Belum ada data</span>
                                        <?php elseif($rk['alpa'] >= 3 || $pct < 75): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                                                <i class="fa-solid fa-triangle-exclamation mr-1 text-[10px]"></i> Perlu Pembinaan
                                            </span>
                                        <?php elseif($pct >= 90): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-circle-check mr-1 text-[10px]"></i> Disiplin Baik
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                                Cukup
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center text-slate-500">Belum ada siswa di kelas ini.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>


        <?php if($jadwal_hari_ini->count() > 0): ?>
        <!-- Kartu Sesi Jadwal Pelajaran Hari Ini -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">
                    <i class="fa-solid fa-calendar-day mr-1.5"></i> Sesi Mengajar di Kelas Hari Ini (<?php echo e($hari_indonesia); ?>)
                </span>
                <span class="text-xs text-slate-400">Total: <?php echo e($jadwal_hari_ini->count()); ?> Mata Pelajaran</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                <?php $__currentLoopData = $jadwal_hari_ini; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $guruAbsen = $absensi_guru_hari_ini->get($j->id);
                        $jamStr = $j->jam_pelajaran ? substr($j->jam_pelajaran->jam_mulai, 0, 5) . ' - ' . substr($j->jam_pelajaran->jam_selesai, 0, 5) . ' WIB' : '-';
                    ?>
                    <div class="p-3 rounded-lg border <?php echo e($guruAbsen ? 'bg-emerald-50/40 border-emerald-200' : 'bg-slate-50 border-slate-200'); ?> flex items-start justify-between gap-2">
                        <div>
                            <span class="text-xs font-bold text-slate-800 block truncate"><?php echo e($j->mata_pelajaran->nama_mapel ?? '-'); ?></span>
                            <span class="text-[11px] text-slate-500 block truncate"><?php echo e($j->guru->nama ?? 'Guru'); ?> • <?php echo e($jamStr); ?></span>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold <?php echo e($guruAbsen ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600'); ?> flex-shrink-0">
                            <?php echo e($guruAbsen ? 'Sudah Diabsen' : 'Belum Diabsen'); ?>

                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- KPI Ringkasan Kehadiran Hari Ini -->
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-slate-800"><?php echo e($rekap['total']); ?></span>
                    <span class="text-[11px] font-semibold text-slate-500 uppercase">Total Siswa</span>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-4 flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-emerald-700"><?php echo e($rekap['hadir']); ?></span>
                    <span class="text-[11px] font-semibold text-emerald-800 uppercase">Hadir</span>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-amber-200 p-4 flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-amber-700"><?php echo e($rekap['sakit']); ?></span>
                    <span class="text-[11px] font-semibold text-amber-800 uppercase">Sakit</span>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-4 flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-blue-700"><?php echo e($rekap['izin']); ?></span>
                    <span class="text-[11px] font-semibold text-blue-800 uppercase">Izin</span>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-rose-200 p-4 flex items-center gap-3.5 col-span-2 sm:col-span-1">
                <div class="w-10 h-10 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-user-xmark"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-rose-700"><?php echo e($rekap['alpa']); ?></span>
                    <span class="text-[11px] font-semibold text-rose-800 uppercase">Alpa</span>
                </div>
            </div>
        </div>

        <!-- Tabel Konsolidasi & Verifikasi Wali Kelas -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Presensi Terkonsolidasi: Kelas <?php echo e($wallas->ruangKelas->nama_ruang ?? '-'); ?></h3>
                        <p class="text-xs text-slate-500">Tanggal: <strong><?php echo e(\Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y')); ?></strong></p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-100">
                        <i class="fa-solid fa-eye mr-1.5 text-emerald-600"></i> Mode Pemantauan
                    </span>
                </div>
            </div>

            <!-- Pencarian Cepat Siswa (Mobile & Desktop) -->
            <?php if(count($siswa) > 0): ?>
                <div class="px-4 sm:px-6 py-2.5 bg-white border-b border-slate-200">
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" id="inputCariSiswaWalas" placeholder="Cari nama atau NIS siswa..." oninput="onCariSiswaWalas(this.value)"
                               class="w-full pl-9 pr-8 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:bg-white transition-colors">
                        <button type="button" id="btnHapusCariSiswaWalas" onclick="resetCariSiswaWalas()" style="display: none;" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs p-1">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div id="msgSearchEmptyWalas" style="display: none;" class="text-xs text-slate-400 text-center py-4">
                        Tidak ada siswa dengan nama atau NIS tersebut.
                    </div>
                </div>
            <?php endif; ?>

            <div class="overflow-x-auto walas-absensi-wrapper">
                    <table class="w-full text-left border-collapse walas-absensi-table">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                <th class="px-5 py-3.5 w-12 text-center col-no">No</th>
                                <th class="px-5 py-3.5 col-nis">NIS</th>
                                <th class="px-5 py-3.5 col-nama">Nama Peserta Didik</th>
                                <th class="px-5 py-3.5 col-mapel">Presensi Sesi Mapel Hari Ini</th>
                                <th class="px-5 py-3.5 text-center col-status-harian">Status Harian Kelas</th>
                                <th class="px-5 py-3.5 col-catatan">Catatan / Surat Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <?php if(count($siswa) > 0): ?>
                                <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $info = $konsolidasi_siswa[$s->id] ?? [
                                            'status' => 'h',
                                            'sumber' => 'belum',
                                            'keterangan' => '',
                                            'mapel_info' => [],
                                            'total_mapel_hadir' => 0,
                                            'total_mapel_sesi' => 0
                                        ];
                                        $status = $info['status'];
                                        $sumber = $info['sumber'];
                                        $keterangan = $info['keterangan'];
                                        $mapels = $info['mapel_info'];
                                        $isFemale = strtolower($s->gender ?? '') === 'p';
                                    ?>
                                    <tr class="walas-absensi-row hover:bg-slate-50/60 transition-colors" data-nama="<?php echo e(strtolower($s->nama)); ?>" data-nis="<?php echo e(strtolower($s->nis ?? '')); ?>">
                                        <td class="px-5 py-3.5 text-center text-slate-400 font-medium col-no"><?php echo e($loop->iteration); ?></td>
                                        <td class="px-5 py-3.5 font-mono text-xs text-slate-500 col-nis"><?php echo e($s->nis ?? '-'); ?></td>
                                        <td class="px-5 py-3.5 col-nama">
                                            <div class="flex items-center justify-between gap-3">
                                                <div class="flex items-center space-x-3 min-w-0">
                                                    <div class="w-8 h-8 rounded-xl <?php echo e($isFemale ? 'bg-pink-100 text-pink-700' : 'bg-emerald-100 text-emerald-700'); ?> flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                                        <?php echo e(strtoupper(substr($s->nama, 0, 2))); ?>

                                                    </div>
                                                    <div class="min-w-0">
                                                        <span class="font-bold text-slate-800 text-sm block truncate"><?php echo e($s->nama); ?></span>
                                                        <span class="font-mono text-[11px] text-slate-400 md:hidden block">NIS: <?php echo e($s->nis ?? '-'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="md:hidden flex-shrink-0">
                                                    <?php if($sumber === 'belum'): ?>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                                            Belum Diabsen
                                                        </span>
                                                    <?php elseif($status === 'h'): ?>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                            Hadir
                                                        </span>
                                                    <?php elseif($status === 's'): ?>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                                            Sakit
                                                        </span>
                                                    <?php elseif($status === 'i'): ?>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                                            Izin
                                                        </span>
                                                    <?php elseif($status === 'a'): ?>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-800 border border-rose-200">
                                                            Alpa
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5 col-mapel">
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1.5 md:hidden">
                                                <i class="fa-solid fa-book-open mr-1 text-slate-400"></i> Presensi Sesi Mapel Hari Ini:
                                            </span>
                                            <?php if(count($mapels) > 0): ?>
                                                <div class="flex flex-wrap items-center gap-1.5 max-w-sm">
                                                    <?php $__currentLoopData = $mapels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($mp['status_siswa'] === 'h'): ?>
                                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200" title="<?php echo e($mp['mapel']); ?> (<?php echo e($mp['guru']); ?>): Hadir">
                                                                <i class="fa-solid fa-check text-[9px] mr-1"></i> <?php echo e($mp['mapel']); ?>: Hadir
                                                            </span>
                                                        <?php elseif($mp['status_siswa'] === 's'): ?>
                                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-amber-50 text-amber-800 border border-amber-200" title="<?php echo e($mp['mapel']); ?> (<?php echo e($mp['guru']); ?>): Sakit">
                                                                <i class="fa-solid fa-heart-pulse text-[9px] mr-1"></i> <?php echo e($mp['mapel']); ?>: Sakit
                                                            </span>
                                                        <?php elseif($mp['status_siswa'] === 'i'): ?>
                                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-blue-50 text-blue-800 border border-blue-200" title="<?php echo e($mp['mapel']); ?> (<?php echo e($mp['guru']); ?>): Izin">
                                                                <i class="fa-solid fa-envelope-open text-[9px] mr-1"></i> <?php echo e($mp['mapel']); ?>: Izin
                                                            </span>
                                                        <?php elseif($mp['status_siswa'] === 'a'): ?>
                                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-rose-100 text-rose-800 border border-rose-200" title="<?php echo e($mp['mapel']); ?> (<?php echo e($mp['guru']); ?>): Alpa / Tidak Hadir">
                                                                <i class="fa-solid fa-xmark text-[9px] mr-1"></i> <?php echo e($mp['mapel']); ?>: Alpa
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-500 border border-slate-200" title="<?php echo e($mp['mapel']); ?> (<?php echo e($mp['guru']); ?>): Belum Diabsen">
                                                                <i class="fa-regular fa-clock text-[9px] mr-1"></i> <?php echo e($mp['mapel']); ?>

                                                            </span>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-400 italic">Tidak ada jadwal sesi mapel pada hari ini</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-5 py-3.5 text-center col-status-harian hidden md:table-cell">
                                            <?php if($sumber === 'belum'): ?>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                                    <i class="fa-regular fa-clock mr-1 text-[10px]"></i> Belum Diabsen
                                                </span>
                                            <?php elseif($status === 'h'): ?>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    <i class="fa-solid fa-circle-check mr-1 text-[10px]"></i> Hadir
                                                </span>
                                            <?php elseif($status === 's'): ?>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                                    <i class="fa-solid fa-heart-pulse mr-1 text-[10px]"></i> Sakit
                                                </span>
                                            <?php elseif($status === 'i'): ?>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-800 border border-blue-200">
                                                    <i class="fa-solid fa-envelope-open mr-1 text-[10px]"></i> Izin
                                                </span>
                                            <?php elseif($status === 'a'): ?>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">
                                                    <i class="fa-solid fa-circle-xmark mr-1 text-[10px]"></i> Alpa
                                                </span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                                    -
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-5 py-3.5 col-catatan">
                                            <?php if(!empty($keterangan)): ?>
                                                <span class="text-xs text-slate-700 font-medium bg-slate-50 border border-slate-200 px-2.5 py-1 rounded-lg inline-block">
                                                    <i class="fa-regular fa-comment-dots text-slate-400 mr-1 md:hidden"></i><?php echo e($keterangan); ?>

                                                </span>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-400 italic hidden md:inline">-</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                        <i class="fa-solid fa-folder-open text-2xl text-slate-300 mb-2 block"></i>
                                        Belum ada peserta didik yang terdaftar di kelas rombel ini.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

        </div>
    <?php endif; ?>

    <script>
        function onCariSiswaWalas(val) {
            const query = (val || '').toLowerCase().trim();
            const btnHapus = document.getElementById('btnHapusCariSiswaWalas');
            if (btnHapus) {
                btnHapus.style.display = query.length > 0 ? 'block' : 'none';
            }

            let matchCount = 0;
            document.querySelectorAll('.walas-absensi-row').forEach(function(row) {
                const nama = (row.getAttribute('data-nama') || '').toLowerCase();
                const nis = (row.getAttribute('data-nis') || '').toLowerCase();
                if (!query || nama.includes(query) || nis.includes(query)) {
                    row.style.setProperty('display', '', '');
                    matchCount++;
                } else {
                    row.style.setProperty('display', 'none', 'important');
                }
            });

            const msgEmpty = document.getElementById('msgSearchEmptyWalas');
            if (msgEmpty) {
                msgEmpty.style.display = (matchCount === 0) ? 'block' : 'none';
            }
        }

        function resetCariSiswaWalas() {
            const input = document.getElementById('inputCariSiswaWalas');
            if (input) {
                input.value = '';
                onCariSiswaWalas('');
            }
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\siakad\guru\absensisiswa.blade.php ENDPATH**/ ?>