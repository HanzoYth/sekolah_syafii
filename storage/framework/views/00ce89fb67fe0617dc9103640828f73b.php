<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran - SIAKAD</title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/siakad/detail_pembayaran.css')); ?>">
    <style>
        @media print {
            body * { visibility: hidden !important; }
            .detail-wrapper, .detail-wrapper * { visibility: visible !important; }
            .detail-wrapper {
                position: fixed !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 10mm 15mm !important;
                border: none !important;
                box-shadow: none !important;
                background: #ffffff !important;
            }
            .no-print, .sidebar, #sidebar, .mobile-hamburger-btn, .sidebar-overlay, .detail-card-footer, .action-buttons, .btn-back {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        
        <?php if (isset($component)) { $__componentOriginal5aec4545c59eb84aeaa1ffd6241385c4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5aec4545c59eb84aeaa1ffd6241385c4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar_siakad','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar_siakad'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5aec4545c59eb84aeaa1ffd6241385c4)): ?>
<?php $attributes = $__attributesOriginal5aec4545c59eb84aeaa1ffd6241385c4; ?>
<?php unset($__attributesOriginal5aec4545c59eb84aeaa1ffd6241385c4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5aec4545c59eb84aeaa1ffd6241385c4)): ?>
<?php $component = $__componentOriginal5aec4545c59eb84aeaa1ffd6241385c4; ?>
<?php unset($__componentOriginal5aec4545c59eb84aeaa1ffd6241385c4); ?>
<?php endif; ?>

        
        <main class="main-content">
            <?php
                $siswa = $slip->siswa ?? null;
                $nama_siswa = $siswa->nama ?? 'Siswa SIAKAD';
                $nis_siswa = $siswa->nis ?? '-';
                $kelas_siswa = ($siswa && $siswa->kelas) ? $siswa->kelas->nama_ruang : 'Belum Ditentukan';
                $sekolah_siswa = ($siswa && $siswa->sekolah) ? $siswa->sekolah->jenis : 'SMAIT Imam Syafii';
                $tahun_ajaran = ($siswa && $siswa->tahunAjaran) ? $siswa->tahunAjaran->nama : '2026/2027';
                $invoice = $invoice_no ?? ('INV/SKD/' . date('Ym') . '/' . str_pad($slip->id ?? 1, 4, '0', STR_PAD_LEFT));
                $tgl_bayar = ($slip && $slip->created_at) ? \Carbon\Carbon::parse($slip->created_at)->locale('id')->isoFormat('D MMMM Y (HH:mm [WITA])') : date('d M Y');
                $nom = $nominal ?? ($slip->nominal ?? 0);
                $bayar = $dibayar ?? ($slip->jumlah_dibayar ?? ($slip->jumlah_di_bayar ?? 0));
                $sisa_tagihan = max(0, $nom - $bayar);
                $lunas = $isLunas ?? ($bayar >= $nom && $nom > 0);
                $deskripsi = $jenis_label ?? 'Pembayaran SIAKAD';
                $periode = $periode_label ?? '-';
            ?>

            <?php if (isset($component)) { $__componentOriginal1a1f63a2a79d284712d591a40114df0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a1f63a2a79d284712d591a40114df0d = $attributes; } ?>
<?php $component = App\View\Components\Siakad\Topbar::resolve(['title' => 'Detail Transaksi '.e($deskripsi).'','description' => 'Tinjau rincian resmi transaksi pembayaran santri/siswa.','position' => ''.e(session('role') === 'a' ? 'Administrator Keuangan' : 'Bendahara Sekolah').'','initials' => 'DP'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.topbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Siakad\Topbar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1a1f63a2a79d284712d591a40114df0d)): ?>
<?php $attributes = $__attributesOriginal1a1f63a2a79d284712d591a40114df0d; ?>
<?php unset($__attributesOriginal1a1f63a2a79d284712d591a40114df0d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a1f63a2a79d284712d591a40114df0d)): ?>
<?php $component = $__componentOriginal1a1f63a2a79d284712d591a40114df0d; ?>
<?php unset($__componentOriginal1a1f63a2a79d284712d591a40114df0d); ?>
<?php endif; ?>

            
            <div style="display: flex; justify-content: space-between; align-items: center; max-width: 850px; margin: 0 auto 16px auto;" class="no-print">
                <a href="/sk/ppl" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Riwayat
                </a>
                <div class="academic-pill">
                    <i class="fa-solid fa-kaaba"></i> Bismillah &middot; Transaksi Resmi SIAKAD
                </div>
            </div>

            
            <div class="detail-wrapper">
                
                
                <div class="detail-card-header">
                    <div class="islamic-pattern-overlay"></div>
                    
                    <div class="header-content">
                        <div class="basmalah-text">
                            بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                        </div>
                        <span class="invoice-number">NO. INVOICE: #<?php echo e($invoice); ?></span>
                        
                        
                        <div class="status-badge <?php echo e($lunas ? 'success' : ($bayar > 0 ? 'warning' : 'danger')); ?>">
                            <?php if($lunas): ?>
                                <i class="fa-solid fa-circle-check"></i> Pembayaran Lunas
                            <?php elseif($bayar > 0): ?>
                                <i class="fa-solid fa-clock-rotate-left"></i> Dicicil (Sebagian)
                            <?php else: ?>
                                <i class="fa-solid fa-triangle-exclamation"></i> Menunggak (Belum Bayar)
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <div class="detail-card-body">
                    
                    
                    <div class="section-block">
                        <h4 class="section-title"><i class="fa-solid fa-user-graduate"></i> Informasi Siswa</h4>
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="label">Nama Lengkap</span>
                                <span class="value bold"><?php echo e($nama_siswa); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="label">NIS / Identitas</span>
                                <span class="value"><?php echo e($nis_siswa); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="label">Kelas</span>
                                <span class="value"><?php echo e($kelas_siswa); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="label">Unit / Sekolah</span>
                                <span class="value"><?php echo e($sekolah_siswa); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="label">Tahun Ajaran</span>
                                <span class="value"><?php echo e($tahun_ajaran); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="divider-islamic"><span>✦ ✦ ✦</span></div>

                    
                    <div class="section-block">
                        <h4 class="section-title"><i class="fa-solid fa-receipt"></i> Rincian Tagihan</h4>
                        
                        <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch; width: 100%;">
                            <table class="receipt-table" style="min-width: 320px;">
                                <thead>
                                    <tr>
                                        <th>Deskripsi Pembayaran</th>
                                        <th>Periode</th>
                                        <th class="text-right">Nominal Tagihan</th>
                                        <th class="text-right">Jumlah Terbayar</th>
                                        <th class="text-right">Sisa Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong><?php echo e($deskripsi); ?></strong></td>
                                        <td><?php echo e($periode); ?></td>
                                        <td class="text-right">Rp <?php echo e(number_format($nom, 0, ',', '.')); ?></td>
                                        <td class="text-right text-success font-bold">Rp <?php echo e(number_format($bayar, 0, ',', '.')); ?></td>
                                        <td class="text-right <?php echo e($sisa_tagihan > 0 ? 'text-danger font-bold' : ''); ?>">Rp <?php echo e(number_format($sisa_tagihan, 0, ',', '.')); ?></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right bold">Total Terbayar:</td>
                                        <td class="text-right total-amount">Rp <?php echo e(number_format($bayar, 0, ',', '.')); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="divider-islamic"><span>✦ ✦ ✦</span></div>

                    
                    <div class="section-block">
                        <h4 class="section-title"><i class="fa-solid fa-money-check-dollar"></i> Data Pembayaran</h4>
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="label">Tanggal Bayar</span>
                                <span class="value"><?php echo e($tgl_bayar); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="label">Metode Pembayaran</span>
                                <span class="value"><i class="fa-solid fa-building-columns"></i> Tunai di Kasir / Transfer Bank</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Petugas Verifikasi</span>
                                <span class="value">Bendahara / Petugas Keuangan SIAKAD</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Status Administrasi</span>
                                <span class="value bold <?php echo e($lunas ? 'text-success' : 'text-danger'); ?>">
                                    <?php echo e($lunas ? 'Telah Terverifikasi Lunas' : ($bayar > 0 ? 'Pembayaran Sebagian (Dicicil)' : 'Belum Melakukan Pembayaran')); ?>

                                </span>
                            </div>
                        </div>
                    </div>

                </div>

                
                <div class="detail-card-footer">
                    <div class="islamic-quote">
                        <i class="fa-solid fa-quote-left"></i>
                        <span>"Sesungguhnya Allah menyukai seseorang yang apabila bekerja, ia melakukannya dengan ihsan (profesional)."</span>
                    </div>

                    <div class="action-buttons">
                        <button onclick="window.print()" class="btn-islamic-secondary">
                            <i class="fa-solid fa-print"></i> Cetak Bukti Kuitansi
                        </button>
                        <a href="/sk/ssp?id=<?php echo e($slip->id ?? ''); ?>&type=<?php echo e($type ?? 'ipp'); ?>" class="btn-islamic-primary">
                            <i class="fa-solid fa-file-pdf"></i> Download PDF
                        </a>
                    </div>
                </div>

            </div>

        </main>
    </div>

</body>
</html>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/admin/detailPembayaran.blade.php ENDPATH**/ ?>