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
            <?php if (isset($component)) { $__componentOriginal1a1f63a2a79d284712d591a40114df0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a1f63a2a79d284712d591a40114df0d = $attributes; } ?>
<?php $component = App\View\Components\Siakad\Topbar::resolve(['title' => 'Detail Pembayaran','description' => 'Tinjau informasi transaksi pembayaran siswa.','position' => 'Administrator SIAKAD','initials' => 'AD'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

            
            <header class="topbar">
                <div class="topbar-left">
                    <a href="javascript:history.back()" class="btn-back">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    <h2>Detail Pembayaran SPP</h2>
                </div>

                <div class="academic-pill">
                    <i class="fa-solid fa-kaaba"></i>
                    Bismillah &middot; Transaksi Resmi SIAKAD
                </div>
            </header>

            
            <div class="detail-wrapper">
                
                
                <div class="detail-card-header">
                    <div class="islamic-pattern-overlay"></div>
                    
                    <div class="header-content">
                        <div class="basmalah-text">
                            Ø¨ÙØ³Ù’Ù…Ù Ø§Ù„Ù„ÙŽÙ‘Ù‡Ù Ø§Ù„Ø±ÙŽÙ‘Ø­Ù’Ù…ÙŽÙ°Ù†Ù Ø§Ù„Ø±ÙŽÙ‘Ø­ÙÙŠÙ…Ù
                        </div>
                        <span class="invoice-number">NO. INVOICE: #INV/202608/SPP-0142</span>
                        
                        
                        <div class="status-badge success">
                            <i class="fa-solid fa-circle-check"></i> Pembayaran Lunas
                        </div>
                    </div>
                </div>

                
                <div class="detail-card-body">
                    
                    
                    <div class="section-block">
                        <h4 class="section-title"><i class="fa-solid fa-user-graduate"></i> Informasi Siswa</h4>
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="label">Nama Lengkap</span>
                                <span class="value bold">Ali Hidayat</span>
                            </div>
                            <div class="info-item">
                                <span class="label">NIS / NISN</span>
                                <span class="value">20261001 / 0081234567</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Kelas</span>
                                <span class="value">Kelas 1A</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Tahun Ajaran</span>
                                <span class="value">2025/2026 (Ganjil)</span>
                            </div>
                        </div>
                    </div>

                    <div class="divider-islamic"><span>âœ¦ âœ¦ âœ¦</span></div>

                    
                    <div class="section-block">
                        <h4 class="section-title"><i class="fa-solid fa-receipt"></i> Rincian Tagihan</h4>
                        
                        <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch; width: 100%;">
                            <table class="receipt-table" style="min-width: 320px;">
                                <thead>
                                    <tr>
                                        <th>Deskripsi Pembayaran</th>
                                        <th>Periode</th>
                                        <th class="text-right">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>SPP Bulanan (Siswa Reguler)</td>
                                        <td>Agustus 2026</td>
                                        <td class="text-right">Rp 350.000</td>
                                    </tr>
                                    <tr>
                                        <td>Infaq / Biaya Admin</td>
                                        <td>-</td>
                                        <td class="text-right">Rp 0</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-right bold">Total Tagihan</td>
                                        <td class="text-right total-amount">Rp 350.000</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="divider-islamic"><span>âœ¦ âœ¦ âœ¦</span></div>

                    
                    <div class="section-block">
                        <h4 class="section-title"><i class="fa-solid fa-money-check-dollar"></i> Data Pembayaran</h4>
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="label">Tanggal Bayar</span>
                                <span class="value">03 Agustus 2026 (14:20 WITA)</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Metode Pembayaran</span>
                                <span class="value"><i class="fa-solid fa-building-columns"></i> Transfer Bank Syariah (BSI)</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Petugas / Kasir</span>
                                <span class="value">Siti Rahmah, S.Pd.</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Catatan</span>
                                <span class="value text-muted">Pembayaran via Virtual Account BSI</span>
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
                            <i class="fa-solid fa-print"></i> Cetak Bukti
                        </button>
                        <a href="#" class="btn-islamic-primary">
                            <i class="fa-solid fa-file-pdf"></i> Download PDF
                        </a>
                    </div>
                </div>

            </div>

        </main>
    </div>

</body>
</html>



<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\siakad\admin\detailPembayaran.blade.php ENDPATH**/ ?>