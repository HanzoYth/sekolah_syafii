<?php
    $riwayat = isset($riwayat_pembayaran) ? (is_array($riwayat_pembayaran) ? collect($riwayat_pembayaran) : $riwayat_pembayaran) : collect();
    $totalTagihan = $riwayat->sum('nominal');
    $totalDibayar = $riwayat->sum(fn($item) => $item->dibayar ?? ($item->status === 'lunas' ? $item->nominal : 0));
    $sisaTagihan = max(0, $totalTagihan - $totalDibayar);
    $tagihanAktif = $riwayat->filter(fn($item) => $item->status !== 'lunas')->values();
    $namaKelas = $data_kelas->nama_ruang ?? 'Belum Ada Kelas';
    $namaTahun = $tahun_aktif->nama ?? '2026/2027';
?>
<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Riwayat & Tagihan Pembayaran Siswa','description' => 'Pantau status tagihan SPP/IPP bulanan, Uang Pangkal, Dana Pendidikan, dan cetak bukti pembayaran.','position' => 'Siswa / Orang Tua','initials' => 'SW']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Riwayat & Tagihan Pembayaran Siswa','description' => 'Pantau status tagihan SPP/IPP bulanan, Uang Pangkal, Dana Pendidikan, dan cetak bukti pembayaran.','position' => 'Siswa / Orang Tua','initials' => 'SW']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/dbs" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Riwayat Pembayaran</span>
        </li>
     <?php $__env->endSlot(); ?>

    <!-- KPI Cards -->
    <div class="no-print grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-slate-100 text-slate-700 rounded-lg">
                <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Tagihan Tercatat</p>
                <h3 class="text-2xl font-bold text-slate-800">Rp <?php echo e(number_format($totalTagihan, 0, ',', '.')); ?></h3>
                <p class="text-xs text-slate-400 mt-1"><?php echo e($riwayat->count()); ?> item tagihan administrasi</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                <i class="fa-solid fa-circle-check text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Sudah Dibayar</p>
                <h3 class="text-2xl font-bold text-emerald-600">Rp <?php echo e(number_format($totalDibayar, 0, ',', '.')); ?></h3>
                <p class="text-xs text-slate-400 mt-1"><?php echo e($riwayat->count() - $tagihanAktif->count()); ?> tagihan telah lunas</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 <?php echo e($sisaTagihan > 0 ? 'bg-rose-50 text-rose-600' : 'bg-blue-50 text-blue-600'); ?> rounded-lg">
                <i class="fa-solid <?php echo e($sisaTagihan > 0 ? 'fa-clock' : 'fa-shield-check'); ?> text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Sisa Tagihan / Tunggakan</p>
                <h3 class="text-2xl font-bold <?php echo e($sisaTagihan > 0 ? 'text-rose-600' : 'text-slate-800'); ?>">Rp <?php echo e(number_format($sisaTagihan, 0, ',', '.')); ?></h3>
                <p class="text-xs text-slate-400 mt-1"><?php echo e($tagihanAktif->count()); ?> tagihan menunggu pelunasan</p>
            </div>
        </div>
    </div>

    <!-- Tagihan Aktif & Informasi Pembayaran -->
    <div class="no-print grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Daftar Tagihan Aktif -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Tagihan Aktif / Menunggu Pelunasan</h3>
                    <p class="text-xs text-slate-500">Daftar tagihan yang diterbitkan oleh bagian Keuangan / Admin SIAKAD</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold <?php echo e($tagihanAktif->count() > 0 ? 'bg-rose-100 text-rose-800' : 'bg-emerald-100 text-emerald-800'); ?>">
                    <?php echo e($tagihanAktif->count()); ?> Tagihan Aktif
                </span>
            </div>

            <div class="p-6">
                <?php if($tagihanAktif->count() > 0): ?>
                    <div class="space-y-3">
                        <?php $__currentLoopData = $tagihanAktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tagihan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-4 rounded-xl border border-rose-200 bg-rose-50/30 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex items-start gap-3.5">
                                    <div class="w-10 h-10 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <i class="fa-solid fa-wallet"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-800"><?php echo e($tagihan->nama_tagihan); ?></h4>
                                        <p class="text-xs text-slate-500 mt-0.5"><?php echo e($tagihan->keterangan); ?></p>
                                        <span class="inline-flex items-center gap-1 text-[11px] text-slate-400 mt-1">
                                            <i class="fa-regular fa-calendar"></i> Terbit: <?php echo e($tagihan->tanggal); ?>

                                        </span>
                                    </div>
                                </div>
                                <div class="sm:text-right flex sm:flex-col items-center sm:items-end justify-between border-t sm:border-t-0 pt-2 sm:pt-0 border-rose-100">
                                    <div>
                                        <span class="text-[11px] text-slate-400 block">Sisa Tagihan:</span>
                                        <strong class="text-base font-extrabold text-rose-600">Rp <?php echo e(number_format($tagihan->sisa ?? $tagihan->nominal, 0, ',', '.')); ?></strong>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-100 text-rose-800 mt-1">
                                        Belum Lunas
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="py-10 text-center bg-emerald-50/40 border border-dashed border-emerald-200 rounded-xl">
                        <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-800">Tidak Ada Tunggakan Tagihan</h4>
                        <p class="text-xs text-slate-500 mt-1">Terima kasih, seluruh tagihan administrasi pada periode ini telah lunas.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Informasi Layanan Loket Keuangan -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between">
            <div>
                <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg mb-4">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
                <h3 class="text-base font-bold text-slate-800">Informasi Layanan Pembayaran</h3>
                <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                    Pembayaran SPP/IPP, Uang Pangkal, dan Dana Pendidikan diverifikasi oleh Admin Keuangan Sekolah.
                </p>

                <div class="mt-5 space-y-3 p-4 rounded-xl bg-slate-50 border border-slate-100 text-xs text-slate-600">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-regular fa-clock text-emerald-600 w-4 text-center"></i>
                        <span>Senin – Jumat, 07.30 – 14.00 WIB</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-location-dot text-emerald-600 w-4 text-center"></i>
                        <span>Loket Administrasi & Tata Usaha</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-user-graduate text-emerald-600 w-4 text-center"></i>
                        <span>NIS Siswa: <strong class="font-mono text-slate-800"><?php echo e($data_siswa->nis ?? '-'); ?></strong></span>
                    </div>
                </div>
            </div>

            <p class="text-[11px] text-slate-400 mt-4 pt-3 border-t border-slate-100">
                Simpan bukti cetak kwitansi sebagai arsip pembayaran resmi.
            </p>
        </div>
    </div>

    <!-- Tabel Riwayat Seluruh Transaksi & Tagihan -->
    <div class="no-print bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-800">Arsip & Riwayat Tagihan Pembayaran</h3>
                <p class="text-xs text-slate-500">Daftar lengkap seluruh tagihan dan pembayaran yang tercatat untuk <?php echo e($data_siswa->nama ?? 'Siswa'); ?></p>
            </div>

            <div class="relative w-full sm:w-64">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" id="paymentSearch" placeholder="Cari nama atau jenis tagihan..."
                       class="w-full pl-9 pr-4 py-2 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 font-medium focus:outline-none focus:border-emerald-500">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        <th class="px-5 py-3.5">Tanggal</th>
                        <th class="px-5 py-3.5">Rincian Tagihan</th>
                        <th class="px-5 py-3.5">Kategori</th>
                        <th class="px-5 py-3.5 text-right">Nominal Tagihan</th>
                        <th class="px-5 py-3.5 text-right">Terbayar</th>
                        <th class="px-5 py-3.5 text-center">Status</th>
                        <th class="px-5 py-3.5 text-center">Kwitansi</th>
                    </tr>
                </thead>
                <tbody id="paymentRows" class="divide-y divide-slate-100 text-sm">
                    <?php if($riwayat->count() > 0): ?>
                        <?php $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="px-5 py-4 text-xs text-slate-500 whitespace-nowrap"><?php echo e($item->tanggal); ?></td>
                                <td class="px-5 py-4">
                                    <span class="font-bold text-slate-800 block"><?php echo e($item->nama_tagihan); ?></span>
                                    <span class="text-xs text-slate-400"><?php echo e($item->keterangan); ?></span>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-slate-100 text-slate-700">
                                        <?php echo e($item->jenis); ?>

                                    </span>
                                </td>
                                <td class="px-5 py-4 text-right font-mono font-semibold text-slate-700">
                                    Rp <?php echo e(number_format($item->nominal, 0, ',', '.')); ?>

                                </td>
                                <td class="px-5 py-4 text-right font-mono font-bold text-emerald-700">
                                    Rp <?php echo e(number_format($item->dibayar ?? ($item->status === 'lunas' ? $item->nominal : 0), 0, ',', '.')); ?>

                                </td>
                                <td class="px-5 py-4 text-center">
                                    <?php if($item->status === 'lunas'): ?>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                            <i class="fa-solid fa-circle-check mr-1 text-[10px]"></i> Lunas
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                                            <i class="fa-solid fa-clock mr-1 text-[10px]"></i> Belum Lunas
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <button type="button"
                                            onclick="cetakKwitansi('<?php echo e($item->id ?? 'INV'); ?>', '<?php echo e($item->tanggal); ?>', '<?php echo e(addslashes($item->nama_tagihan)); ?>', '<?php echo e($item->jenis); ?>', '<?php echo e(number_format($item->nominal, 0, ',', '.')); ?>', '<?php echo e(number_format($item->dibayar ?? ($item->status === 'lunas' ? $item->nominal : 0), 0, ',', '.')); ?>', '<?php echo e($item->status === 'lunas' ? 'LUNAS' : 'BELUM LUNAS'); ?>')"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-bold transition-colors">
                                        <i class="fa-solid fa-print"></i> Cetak
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-receipt text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700">Belum Ada Riwayat Tagihan</h4>
                                <p class="text-xs text-slate-400 mt-1">Belum ada data tagihan SPP/IPP, Uang Pangkal, atau Pendidikan yang diterbitkan untuk akun Anda.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Area Cetak Kwitansi Pembayaran Siswa -->
    <div id="kwitansiPrintArea" class="hidden print-area bg-white border border-slate-300 rounded-xl p-8 max-w-2xl mx-auto">
        <div class="text-center border-b-2 border-slate-800 pb-4 mb-6">
            <h2 class="text-lg font-extrabold uppercase text-slate-900">Bukti Tagihan & Kwitansi Pembayaran Siswa</h2>
            <p class="text-xs font-semibold text-slate-600 mt-1">Sistem Informasi Akademik (SIAKAD) &bull; Tahun Ajaran <?php echo e($namaTahun); ?></p>
        </div>

        <div class="grid grid-cols-2 gap-4 text-xs sm:text-sm mb-6">
            <div>
                <p class="text-slate-500">Nama Siswa:</p>
                <p class="font-bold text-slate-900"><?php echo e($data_siswa->nama ?? '-'); ?></p>
            </div>
            <div>
                <p class="text-slate-500">NIS / Kelas:</p>
                <p class="font-bold text-slate-900"><?php echo e($data_siswa->nis ?? '-'); ?> / <?php echo e($namaKelas); ?></p>
            </div>
            <div>
                <p class="text-slate-500">Nomor Referensi:</p>
                <p class="font-mono font-bold text-slate-900" id="kwId">-</p>
            </div>
            <div>
                <p class="text-slate-500">Tanggal Tagihan:</p>
                <p class="font-bold text-slate-900" id="kwTanggal">-</p>
            </div>
        </div>

        <table class="w-full border-collapse border border-slate-400 text-sm mb-6">
            <thead>
                <tr class="bg-slate-100">
                    <th class="border border-slate-400 px-3 py-2 text-left">Deskripsi Tagihan</th>
                    <th class="border border-slate-400 px-3 py-2 text-center">Kategori</th>
                    <th class="border border-slate-400 px-3 py-2 text-right">Nominal</th>
                    <th class="border border-slate-400 px-3 py-2 text-right">Dibayar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-slate-400 px-3 py-2.5 font-semibold" id="kwNama">-</td>
                    <td class="border border-slate-400 px-3 py-2.5 text-center" id="kwJenis">-</td>
                    <td class="border border-slate-400 px-3 py-2.5 text-right font-mono">Rp <span id="kwNominal">0</span></td>
                    <td class="border border-slate-400 px-3 py-2.5 text-right font-mono font-bold">Rp <span id="kwDibayar">0</span></td>
                </tr>
                <tr class="bg-slate-50 font-bold">
                    <td colspan="2" class="border border-slate-400 px-3 py-2 text-right">Status Pembayaran:</td>
                    <td colspan="2" class="border border-slate-400 px-3 py-2 text-center" id="kwStatus">LUNAS</td>
                </tr>
            </tbody>
        </table>

        <div class="flex justify-between items-end text-xs text-slate-600 mt-10">
            <div>
                <p>Dicetak melalui Portal Siswa SIAKAD pada <?php echo e(date('d/m/Y H:i')); ?></p>
            </div>
            <div class="text-center">
                <p class="mb-14">Administrasi Keuangan Sekolah</p>
                <p class="font-bold underline">............................................</p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('paymentSearch')?.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('#paymentRows tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
            });
        });

        function cetakKwitansi(id, tanggal, nama, jenis, nominal, dibayar, status) {
            document.getElementById('kwId').textContent = id;
            document.getElementById('kwTanggal').textContent = tanggal;
            document.getElementById('kwNama').textContent = nama;
            document.getElementById('kwJenis').textContent = jenis;
            document.getElementById('kwNominal').textContent = nominal;
            document.getElementById('kwDibayar').textContent = dibayar;
            document.getElementById('kwStatus').textContent = status;

            const area = document.getElementById('kwitansiPrintArea');
            area.classList.remove('hidden');
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/siswa/pembayaranSiswa.blade.php ENDPATH**/ ?>