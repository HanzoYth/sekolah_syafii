<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Laporan Kehadiran Mengajar Guru','description' => 'Pantau presensi masuk kelas dan ketepatan waktu guru pengajar (toleransi 5 menit).','position' => 'Admin SIAKAD','initials' => 'AD']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Laporan Kehadiran Mengajar Guru','description' => 'Pantau presensi masuk kelas dan ketepatan waktu guru pengajar (toleransi 5 menit).','position' => 'Admin SIAKAD','initials' => 'AD']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/das" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Laporan Kehadiran Guru</span>
        </li>
     <?php $__env->endSlot(); ?>

    <!-- KPI Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <i class="fa-solid fa-calendar-check text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Sesi Hari Ini</p>
                <h3 class="text-2xl font-bold text-slate-800"><?php echo e($stats['total_sesi']); ?></h3>
                <p class="text-xs text-slate-400 mt-1">Jadwal pelajaran aktif</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                <i class="fa-solid fa-circle-check text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Tepat Waktu</p>
                <h3 class="text-2xl font-bold text-emerald-600"><?php echo e($stats['tepat_waktu']); ?></h3>
                <p class="text-xs text-slate-400 mt-1">Masuk &le; toleransi 5 mnt</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                <i class="fa-solid fa-clock-rotate-left text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Terlambat</p>
                <h3 class="text-2xl font-bold text-amber-600"><?php echo e($stats['terlambat']); ?></h3>
                <p class="text-xs text-slate-400 mt-1">Lewat batas toleransi</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-rose-50 text-rose-600 rounded-lg">
                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Belum Absen Masuk</p>
                <h3 class="text-2xl font-bold text-rose-600"><?php echo e($stats['belum_absen']); ?></h3>
                <p class="text-xs text-slate-400 mt-1">Menunggu kehadiran guru</p>
            </div>
        </div>
    </div>

    <!-- Filter & Toolbar -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
        <form method="GET" action="/sk/laporan-absensi-guru" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                    <i class="fa-solid fa-user-clock"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Filter Kehadiran Mengajar</h3>
                    <p class="text-xs text-slate-500">Pilih tanggal dan status kehadiran untuk melihat monitoring guru</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <div class="relative">
                    <i class="fa-regular fa-calendar absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="date" name="tanggal" value="<?php echo e($tanggal); ?>" 
                           class="pl-9 pr-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:outline-none focus:border-emerald-500 transition-colors w-full sm:w-auto">
                </div>

                <div class="relative sm:w-44">
                    <select name="status" class="w-full pl-3 pr-8 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:outline-none focus:border-emerald-500 transition-colors appearance-none cursor-pointer">
                        <option value="semua" <?php echo e($status_filter == 'semua' ? 'selected' : ''); ?>>Semua Status</option>
                        <option value="tepat_waktu" <?php echo e($status_filter == 'tepat_waktu' ? 'selected' : ''); ?>>Tepat Waktu</option>
                        <option value="terlambat" <?php echo e($status_filter == 'terlambat' ? 'selected' : ''); ?>>Terlambat</option>
                        <option value="belum_absen" <?php echo e($status_filter == 'belum_absen' ? 'selected' : ''); ?>>Belum Absen</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                </div>

                <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-semibold transition-colors flex items-center justify-center gap-2 shadow-sm">
                    <i class="fa-solid fa-filter text-xs"></i> Terapkan
                </button>
            </div>
        </form>
    </div>

    <!-- Tabel Data Kehadiran Mengajar Guru -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-base font-bold text-slate-800">Data Presensi Masuk Kelas Per Mata Pelajaran</h3>
                <p class="text-xs text-slate-500">Daftar kehadiran sesi mengajar pada: <strong class="text-slate-700"><?php echo e($hari_indonesia); ?></strong></p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                    <i class="fa-solid fa-stopwatch mr-1.5 text-xs"></i> Toleransi Keterlambatan: 5 Menit
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        <th class="px-5 py-3.5 w-12 text-center">No</th>
                        <th class="px-5 py-3.5">Guru Pengajar</th>
                        <th class="px-5 py-3.5">Mata Pelajaran</th>
                        <th class="px-5 py-3.5">Kelas</th>
                        <th class="px-5 py-3.5">Jadwal Sesi</th>
                        <th class="px-5 py-3.5">Batas Toleransi</th>
                        <th class="px-5 py-3.5">Waktu Masuk</th>
                        <th class="px-5 py-3.5 text-center">Status Kehadiran</th>
                        <th class="px-5 py-3.5 text-center">Presensi Siswa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    <?php if($laporan->count() > 0): ?>
                        <?php $__currentLoopData = $laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="px-5 py-4 text-center text-slate-400 font-medium"><?php echo e($loop->iteration); ?></td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                            <?php echo e(substr($item->guru->nama ?? 'G', 0, 2)); ?>

                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-800 block"><?php echo e($item->guru->nama ?? '-'); ?></span>
                                            <span class="text-xs text-slate-400 font-mono"><?php echo e($item->guru->nip ?? ($item->guru->nomor_induk ?? '')); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="font-semibold text-slate-800 block"><?php echo e($item->mata_pelajaran->nama_mapel ?? '-'); ?></span>
                                    <?php if(!empty($item->materi)): ?>
                                        <span class="text-xs text-emerald-700 font-medium block mt-0.5">
                                            <i class="fa-solid fa-book-bookmark text-[10px] mr-1"></i><?php echo e($item->materi); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700">
                                        <?php echo e($item->kelas->nama_kelas ?? ($item->kelas->nama_ruang ?? '-')); ?>

                                    </span>
                                </td>
                                <td class="px-5 py-4 font-mono text-xs text-slate-600 whitespace-nowrap">
                                    <i class="fa-regular fa-clock text-slate-400 mr-1"></i>
                                    <?php echo e($item->jam_mulai); ?> - <?php echo e($item->jam_selesai); ?> WIB
                                </td>
                                <td class="px-5 py-4 font-mono text-xs text-amber-700 whitespace-nowrap font-semibold">
                                    <?php echo e($item->jam_batas_toleransi); ?> WIB
                                </td>
                                <td class="px-5 py-4 font-mono text-xs text-slate-700 whitespace-nowrap">
                                    <?php if($item->jam_masuk): ?>
                                        <span class="font-bold text-slate-800"><?php echo e(substr($item->jam_masuk, 0, 5)); ?> WIB</span>
                                    <?php else: ?>
                                        <span class="text-slate-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <?php if($item->status == 'tepat_waktu'): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                            <i class="fa-solid fa-circle-check mr-1.5 text-xs"></i> Tepat Waktu
                                        </span>
                                    <?php elseif($item->status == 'terlambat'): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                            <i class="fa-solid fa-clock-rotate-left mr-1.5 text-xs"></i> Terlambat
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                            <i class="fa-solid fa-circle-xmark mr-1.5 text-xs"></i> Belum Masuk
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <?php if($item->rekap_siswa['total'] > 0): ?>
                                        <div class="inline-flex items-center gap-1.5 text-xs font-medium">
                                            <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold" title="Hadir"><?php echo e($item->rekap_siswa['hadir']); ?> H</span>
                                            <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-700 font-bold" title="Sakit"><?php echo e($item->rekap_siswa['sakit']); ?> S</span>
                                            <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-700 font-bold" title="Izin"><?php echo e($item->rekap_siswa['izin']); ?> I</span>
                                            <span class="px-2 py-0.5 rounded bg-rose-50 text-rose-700 font-bold" title="Alpa"><?php echo e($item->rekap_siswa['alpa']); ?> A</span>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400 italic">Belum diabsen</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-folder-open text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-semibold text-slate-700">Tidak Ada Data</h4>
                                <p class="text-xs text-slate-400 mt-1">Tidak ditemukan jadwal atau presensi mengajar guru pada kriteria filter ini.</p>
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/admin/laporanAbsensiGuru.blade.php ENDPATH**/ ?>