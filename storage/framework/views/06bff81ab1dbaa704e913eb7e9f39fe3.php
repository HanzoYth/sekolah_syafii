<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Slip Pembayaran & Rekap Kehadiran Mengajar','description' => 'Rekapitulasi kehadiran sesi mengajar bulanan dan informasi insentif/honorarium pendidik.','position' => 'Guru SIAKAD','initials' => 'GR']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Slip Pembayaran & Rekap Kehadiran Mengajar','description' => 'Rekapitulasi kehadiran sesi mengajar bulanan dan informasi insentif/honorarium pendidik.','position' => 'Guru SIAKAD','initials' => 'GR']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Slip Pembayaran & Kehadiran</span>
        </li>
     <?php $__env->endSlot(); ?>

    <?php
        $totalSesiTercatat = isset($riwayat_absen) ? $riwayat_absen->count() : 0;
        $totalTepatWaktu = isset($riwayat_absen) ? $riwayat_absen->where('status', 'tepat_waktu')->count() : 0;
        $totalTerlambat = isset($riwayat_absen) ? $riwayat_absen->where('status', 'terlambat')->count() : 0;
    ?>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 no-print">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-calendar-week"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Beban Jadwal Mingguan</p>
                <h3 class="text-xl font-bold text-slate-800"><?php echo e($total_jadwal_mingguan ?? 0); ?> Sesi</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Jadwal mengajar aktif</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Total Kehadiran Mengajar</p>
                <h3 class="text-xl font-bold text-slate-800"><?php echo e($totalSesiTercatat); ?> Sesi</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Akumulasi terealisasi</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Sesi Tepat Waktu</p>
                <h3 class="text-xl font-bold text-emerald-600"><?php echo e($totalTepatWaktu); ?> Sesi</h3>
                <p class="text-[11px] text-emerald-700 font-semibold mt-0.5">Disiplin &le; 5 menit</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Sesi Terlambat</p>
                <h3 class="text-xl font-bold text-amber-600"><?php echo e($totalTerlambat); ?> Sesi</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Lewat toleransi 5 menit</p>
            </div>
        </div>
    </div>

    <!-- Tabel Rekapitulasi Bulanan & Slip Kehadiran Mengajar -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8 no-print">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-800">Rekapitulasi Kehadiran Mengajar & Slip Bulanan</h3>
                <p class="text-xs text-slate-500">Dasar perhitungan tunjangan kehadiran mengajar bulanan berdasarkan presensi aktual di kelas</p>
            </div>

            <div class="relative w-full sm:w-64">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" id="slipSearch" placeholder="Cari periode bulan..."
                       class="w-full pl-9 pr-4 py-2 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 font-medium focus:outline-none focus:border-emerald-500">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        <th class="px-5 py-3.5 w-14 text-center">No</th>
                        <th class="px-5 py-3.5">Periode Bulan</th>
                        <th class="px-5 py-3.5">Status Kepegawaian</th>
                        <th class="px-5 py-3.5 text-center">Total Sesi</th>
                        <th class="px-5 py-3.5 text-center">Tepat Waktu</th>
                        <th class="px-5 py-3.5 text-center">Terlambat</th>
                        <th class="px-5 py-3.5 text-center">Indeks Disiplin</th>
                        <th class="px-5 py-3.5 text-center">Status Verifikasi</th>
                        <th class="px-5 py-3.5 text-center">Cetak Bukti</th>
                    </tr>
                </thead>
                <tbody id="slipRows" class="divide-y divide-slate-100 text-sm">
                    <?php if(isset($rekap_bulanan) && $rekap_bulanan->count() > 0): ?>
                        <?php $__currentLoopData = $rekap_bulanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $indeks = $rb['total_sesi'] > 0 ? round(($rb['tepat_waktu'] / $rb['total_sesi']) * 100) : 100;
                                $statusPegawai = ($guru && $guru->guru_tetap) ? 'Guru Tetap' : (($guru && $guru->guru_honor) ? 'Guru Honor' : 'Guru Pengajar');
                            ?>
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="px-5 py-4 text-center text-slate-400 font-medium"><?php echo e($loop->iteration); ?></td>
                                <td class="px-5 py-4">
                                    <span class="font-bold text-slate-800 block"><?php echo e($rb['label_bulan']); ?></span>
                                    <span class="text-xs text-slate-400">Rekap Presensi Mengajar</span>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-slate-100 text-slate-700">
                                        <?php echo e($statusPegawai); ?>

                                    </span>
                                </td>
                                <td class="px-5 py-4 text-center font-bold text-slate-800"><?php echo e($rb['total_sesi']); ?> Sesi</td>
                                <td class="px-5 py-4 text-center">
                                    <span class="px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 font-bold text-xs"><?php echo e($rb['tepat_waktu']); ?></span>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <span class="px-2.5 py-1 rounded-md <?php echo e($rb['terlambat'] > 0 ? 'bg-amber-50 text-amber-700' : 'bg-slate-50 text-slate-500'); ?> font-bold text-xs"><?php echo e($rb['terlambat']); ?></span>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <span class="font-bold <?php echo e($indeks >= 90 ? 'text-emerald-600' : ($indeks >= 75 ? 'text-amber-600' : 'text-rose-600')); ?>"><?php echo e($indeks); ?>%</span>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                        <i class="fa-solid fa-circle-check mr-1.5 text-[10px]"></i> Tercatat Sistem
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <button type="button" 
                                            onclick="cetakSlipPeriode('<?php echo e($rb['label_bulan']); ?>', '<?php echo e($rb['total_sesi']); ?>', '<?php echo e($rb['tepat_waktu']); ?>', '<?php echo e($rb['terlambat']); ?>', '<?php echo e($indeks); ?>%', '<?php echo e($statusPegawai); ?>')"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-bold transition-colors">
                                        <i class="fa-solid fa-print"></i> Cetak Slip
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <?php
                            $bulanSekarang = \Carbon\Carbon::now()->translatedFormat('F Y');
                            $statusPegawai = ($guru && $guru->guru_tetap) ? 'Guru Tetap' : (($guru && $guru->guru_honor) ? 'Guru Honor' : 'Guru Pengajar');
                        ?>
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-5 py-4 text-center text-slate-400 font-medium">1</td>
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-800 block"><?php echo e($bulanSekarang); ?> (Periode Berjalan)</span>
                                <span class="text-xs text-slate-400">Menunggu realisasi presensi mengajar</span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-slate-100 text-slate-700">
                                    <?php echo e($statusPegawai); ?>

                                </span>
                            </td>
                            <td class="px-5 py-4 text-center font-bold text-slate-800">0 Sesi</td>
                            <td class="px-5 py-4 text-center"><span class="text-xs text-slate-400">0</span></td>
                            <td class="px-5 py-4 text-center"><span class="text-xs text-slate-400">0</span></td>
                            <td class="px-5 py-4 text-center"><span class="text-xs text-slate-400">-</span></td>
                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                    Periode Aktif
                                </span>
                            </td>
                            <td class="px-5 py-4 text-center">
                                <button type="button" 
                                        onclick="cetakSlipPeriode('<?php echo e($bulanSekarang); ?>', '0', '0', '0', '100%', '<?php echo e($statusPegawai); ?>')"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                                    <i class="fa-solid fa-print"></i> Cetak Slip
                                </button>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Area Bukti Cetak Slip Kehadiran & Honorarium -->
    <div id="slipPrintContainer" class="hidden print-area bg-white rounded-xl border border-slate-300 p-8 max-w-2xl mx-auto mb-8">
        <div class="text-center border-b-2 border-slate-800 pb-4 mb-6">
            <h2 class="text-lg font-extrabold uppercase text-slate-900">Bukti Rekapitulasi Kehadiran Mengajar & Slip Pendidik</h2>
            <p class="text-xs font-semibold text-slate-600 mt-1">Sistem Informasi Akademik (SIAKAD) • Periode: <span id="printPeriode">-</span></p>
        </div>

        <div class="grid grid-cols-2 gap-4 text-xs sm:text-sm mb-6">
            <div>
                <p class="text-slate-500">Nama Pendidik:</p>
                <p class="font-bold text-slate-900"><?php echo e($guru->nama ?? auth()->user()->name ?? '-'); ?></p>
            </div>
            <div>
                <p class="text-slate-500">NIG / Nomor Induk:</p>
                <p class="font-mono font-bold text-slate-900"><?php echo e($guru->nig ?? '-'); ?></p>
            </div>
            <div>
                <p class="text-slate-500">Status Kepegawaian:</p>
                <p class="font-bold text-slate-900" id="printStatusPegawai">-</p>
            </div>
            <div>
                <p class="text-slate-500">Beban Jadwal Mingguan:</p>
                <p class="font-bold text-slate-900"><?php echo e($total_jadwal_mingguan ?? 0); ?> Sesi / Minggu</p>
            </div>
        </div>

        <table class="w-full border-collapse border border-slate-400 text-sm mb-6">
            <thead>
                <tr class="bg-slate-100">
                    <th class="border border-slate-400 px-3 py-2 text-left">Komponen Kinerja Mengajar</th>
                    <th class="border border-slate-400 px-3 py-2 text-center w-36">Capaian</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-slate-400 px-3 py-2">Total Sesi Kehadiran Mengajar</td>
                    <td class="border border-slate-400 px-3 py-2 text-center font-bold"><span id="printTotalSesi">0</span> Sesi</td>
                </tr>
                <tr>
                    <td class="border border-slate-400 px-3 py-2">Kehadiran Tepat Waktu (&le; 5 Menit Toleransi)</td>
                    <td class="border border-slate-400 px-3 py-2 text-center font-bold text-emerald-800"><span id="printTepatWaktu">0</span> Sesi</td>
                </tr>
                <tr>
                    <td class="border border-slate-400 px-3 py-2">Kehadiran Terlambat (&gt; 5 Menit)</td>
                    <td class="border border-slate-400 px-3 py-2 text-center font-bold text-amber-800"><span id="printTerlambat">0</span> Sesi</td>
                </tr>
                <tr class="bg-slate-50 font-bold">
                    <td class="border border-slate-400 px-3 py-2">Indeks Ketepatan Waktu Mengajar</td>
                    <td class="border border-slate-400 px-3 py-2 text-center" id="printIndeks">100%</td>
                </tr>
            </tbody>
        </table>

        <div class="flex justify-between items-end text-xs text-slate-600 mt-10">
            <div>
                <p>Dicetak otomatis melalui SIAKAD pada <?php echo e(date('d/m/Y H:i')); ?></p>
            </div>
            <div class="text-center">
                <p class="mb-14">Bagian Keuangan / Akademik</p>
                <p class="font-bold underline">............................................</p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('slipSearch')?.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('#slipRows tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
            });
        });

        function cetakSlipPeriode(periode, totalSesi, tepatWaktu, terlambat, indeks, statusPegawai) {
            document.getElementById('printPeriode').textContent = periode;
            document.getElementById('printTotalSesi').textContent = totalSesi;
            document.getElementById('printTepatWaktu').textContent = tepatWaktu;
            document.getElementById('printTerlambat').textContent = terlambat;
            document.getElementById('printIndeks').textContent = indeks;
            document.getElementById('printStatusPegawai').textContent = statusPegawai;

            const container = document.getElementById('slipPrintContainer');
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/guru/slipPembayaran.blade.php ENDPATH**/ ?>