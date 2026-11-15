<style>
    .badge-jenjang {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.02em;
    }
    .badge-sd { background: #fee2e2; color: #b91c1c; }
    .badge-smp { background: #dbeafe; color: #1d4ed8; }
    .badge-sma { background: #ede9fe; color: #6d28d9; }
    .badge-tk { background: #fef3c7; color: #b45309; }
    .badge-umum { background: #f1f5f9; color: #475569; }
    .ref-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-family: inherit;
        font-size: 14px;
        box-sizing: border-box;
        outline: none;
        background: #fff;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .ref-input:focus {
        border-color: #177455;
        box-shadow: 0 0 0 3px rgba(23, 116, 85, 0.15);
    }
</style>

<!-- Banner Mode Global (Muncul saat Admin membuka tab Global Sekolah) -->
<div id="adminRaporGlobalBanner" class="hidden bg-gradient-to-r from-emerald-900 via-emerald-800 to-emerald-700 text-white rounded-2xl p-5 mb-6 shadow-sm border border-emerald-700/80 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div class="flex items-start gap-3">
        <div class="w-10 h-10 rounded-xl bg-emerald-500/20 border border-emerald-300/30 text-emerald-100 flex items-center justify-center flex-shrink-0 text-lg">
            <i class="fa-solid fa-globe"></i>
        </div>
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2 py-0.5 rounded bg-emerald-950/40 text-emerald-100 text-[10px] font-bold uppercase tracking-wider border border-emerald-400/30">Pengaturan Global Sekolah</span>
                <span class="text-xs text-emerald-100/90 font-medium">Berlaku Semua Kelas &amp; Jenjang</span>
            </div>
            <h4 class="text-base font-bold text-white">Konfigurasi Standar Rapor Yayasan / Sekolah</h4>
            <p class="text-xs text-emerald-100/90 mt-0.5">Perubahan pada tab global ini otomatis berlaku untuk seluruh kelas, Wali Kelas, dan Siswa di semua jenjang.</p>
        </div>
    </div>

    <button type="button" onclick="switchAdminRaporTab('kelas')" class="px-3.5 py-2 rounded-xl bg-white/15 hover:bg-white/25 text-white border border-white/25 text-xs font-bold transition-colors flex items-center gap-1.5 whitespace-nowrap self-start md:self-center cursor-pointer">
        <i class="fa-solid fa-arrow-left text-[11px]"></i> Mode Kelas
    </button>
</div>

<!-- ======================================================== -->
<!-- TAB GLOBAL 1: PENGESAHAN, TANGGAL & TTD KEPSEK           -->
<!-- ======================================================== -->
<?php
    $pengaturanMapAdminRaw = $pengaturan_per_jenjang ?? [];
    $pengaturanMapAdmin = [];
    foreach (['tk', 'sd', 'smp'] as $jKeyDefault) {
        $pengaturanMapAdmin[$jKeyDefault] = $pengaturanMapAdminRaw[$jKeyDefault] ?? [
            'jenjang' => $jKeyDefault,
            'is_custom' => false,
            'tempat_rapor' => $pengaturan_rapor->tempat_rapor ?? 'Tinggede',
            'tanggal_rapor' => $pengaturan_rapor->tanggal_rapor ?? '20 Desember 2025',
            'nama_kepsek' => $pengaturan_rapor->nama_kepsek ?? 'Rajihul Haq, S.Sos',
            'nip_kepsek' => $pengaturan_rapor->nip_kepsek ?? '-',
            'catatan_walas_template' => $pengaturan_rapor->catatan_walas_template ?? '',
            'ttd_kepsek' => $pengaturan_rapor->ttd_kepsek ?? null,
        ];
    }
    $activePengaturanJenjang = old('jenjang', $selected_pengaturan_jenjang ?? 'tk');
    if (!array_key_exists($activePengaturanJenjang, $pengaturanMapAdmin)) {
        $activePengaturanJenjang = in_array($kelas_jenjang ?? '', ['tk', 'sd', 'smp'], true) ? $kelas_jenjang : 'tk';
    }
    $activeConfig = $pengaturanMapAdmin[$activePengaturanJenjang];
    $jenjangTabMeta = [
        'tk' => ['label' => 'TK Qur\'an', 'short' => 'TK', 'icon' => 'fa-child-reaching'],
        'sd' => ['label' => 'SD Qur\'an', 'short' => 'SD', 'icon' => 'fa-school'],
        'smp' => ['label' => 'SMP Qur\'an', 'short' => 'SMP', 'icon' => 'fa-graduation-cap'],
    ];
    $initialFilterJenjang = $selected_filter_jenjang ?? 'all';
    if (!in_array($initialFilterJenjang, ['all', 'tk', 'sd', 'smp', 'semua', 'sma'], true)) {
        $initialFilterJenjang = 'all';
    }
?>
<div id="adminRaporPane-pengesahan" class="admin-rapor-pane hidden">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-file-signature"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Pengaturan Pengesahan &amp; Tanggal Pembagian Rapor</h3>
                    <p class="text-xs text-slate-500">Atur Kepala Sekolah, NIP, tanggal cetak rapor, dan TTD Kepsek secara terpisah untuk masing-masing jenjang (TK, SD, SMP).</p>
                </div>
            </div>
            <span id="adminPengaturanActiveBadge" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 w-fit whitespace-nowrap">
                <i class="fa-solid fa-layer-group text-[10px]"></i>
                <span>Jenjang <?php echo e(strtoupper($activePengaturanJenjang)); ?></span>
            </span>
        </div>

        <form id="formPengaturanRapor" action="/sk/simpan-pengaturan-rapor" method="POST" class="p-6">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="jenjang" id="adminPengaturanJenjangInput" value="<?php echo e($activePengaturanJenjang); ?>">

            <!-- Pemilih Jenjang Sekolah (TK / SD / SMP) -->
            <div class="mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-filter text-emerald-700"></i> Pilih Jenjang Sekolah yang Diatur:
                    </label>
                    <span class="text-[11px] text-slate-500">Klik jenjang untuk mengatur Kepala Sekolah &amp; TTD khusus jenjang tersebut</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3" id="adminPengaturanJenjangCards">
                    <?php $__currentLoopData = $jenjangTabMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jKey => $jInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $cfg = $pengaturanMapAdmin[$jKey] ?? [];
                            $isSelected = ($activePengaturanJenjang === $jKey);
                            $isCustom = !empty($cfg['is_custom']);
                        ?>
                        <button type="button"
                                onclick="selectAdminPengesahanJenjang('<?php echo e($jKey); ?>', true)"
                                id="pengesahanJenjangBtn-<?php echo e($jKey); ?>"
                                data-jenjang="<?php echo e($jKey); ?>"
                                class="text-left p-3.5 rounded-xl border transition-all cursor-pointer flex flex-col justify-between gap-2 <?php echo e($isSelected ? 'bg-emerald-50/80 border-emerald-600 ring-2 ring-emerald-500/20 shadow-xs' : 'bg-white border-slate-200 hover:border-emerald-300 hover:bg-slate-50/70'); ?>">
                            <div class="flex items-center justify-between gap-2">
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold <?php echo e($isSelected ? 'text-emerald-800' : 'text-slate-800'); ?>">
                                    <i class="fa-solid <?php echo e($jInfo['icon']); ?> text-emerald-700"></i>
                                    <?php echo e($jInfo['label']); ?>

                                </span>
                                <span id="pengesahanJenjangStatus-<?php echo e($jKey); ?>" class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase <?php echo e($isCustom ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-500 border border-slate-200'); ?>">
                                    <?php echo e($isCustom ? 'Khusus' : 'Belum Diatur'); ?>

                                </span>
                            </div>
                            <div class="text-[11px] text-slate-500 truncate">
                                Kepsek: <strong id="pengesahanJenjangKepsek-<?php echo e($jKey); ?>" class="text-slate-700"><?php echo e($cfg['nama_kepsek'] ?? '-'); ?></strong>
                            </div>
                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div id="adminPengaturanStatusNote" class="p-4 mb-6 rounded-xl <?php echo e($activeConfig['is_custom'] ? 'bg-emerald-50/70 border border-emerald-200 text-emerald-900' : 'bg-slate-50 border border-slate-200 text-slate-700'); ?> text-xs flex items-start gap-3">
                <i class="fa-solid fa-circle-info <?php echo e($activeConfig['is_custom'] ? 'text-emerald-700' : 'text-slate-500'); ?> text-base mt-0.5 flex-shrink-0"></i>
                <div>
                    <strong id="adminPengaturanStatusTitle">
                        <?php if($activeConfig['is_custom']): ?>
                            Pengaturan Khusus Jenjang <?php echo e(strtoupper($activePengaturanJenjang)); ?> Aktif:
                        <?php else: ?>
                            Jenjang <?php echo e(strtoupper($activePengaturanJenjang)); ?> Belum Diatur Khusus:
                        <?php endif; ?>
                    </strong>
                    <p id="adminPengaturanStatusDesc" class="mt-0.5">
                        <?php if($activeConfig['is_custom']): ?>
                            Seluruh rapor siswa, cetak massal, dan leger kelas di jenjang <?php echo e(strtoupper($activePengaturanJenjang)); ?> otomatis memakai data Kepala Sekolah &amp; TTD di bawah ini.
                        <?php else: ?>
                            Kolom di bawah sementara menampilkan data awal. Ubah nama Kepala Sekolah / TTD sesuai pejabat jenjang <?php echo e(strtoupper($activePengaturanJenjang)); ?> lalu klik Simpan.
                        <?php endif; ?>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal Pembagian Rapor</label>
                    <input type="text" id="adminInputTanggalRapor" name="tanggal_rapor" value="<?php echo e(old('tanggal_rapor', $activeConfig['tanggal_rapor'] ?? '20 Desember 2025')); ?>" class="ref-input font-medium" placeholder="Contoh: 20 Desember 2025" required>
                    <span class="text-[11px] text-slate-400 mt-1 block">Format teks yang akan tercetak di bagian titi mangsa rapor (misal: 20 Desember 2025).</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tempat / Kota Penerbitan</label>
                    <input type="text" id="adminInputTempatRapor" name="tempat_rapor" value="<?php echo e(old('tempat_rapor', $activeConfig['tempat_rapor'] ?? 'Tinggede')); ?>" class="ref-input font-medium" placeholder="Contoh: Tinggede" required>
                    <span class="text-[11px] text-slate-400 mt-1 block">Nama daerah / desa / kota lokasi madrasah / sekolah.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Kepala Sekolah &amp; Gelar</label>
                    <input type="text" id="adminInputNamaKepsek" name="nama_kepsek" value="<?php echo e(old('nama_kepsek', $activeConfig['nama_kepsek'] ?? 'Rajihul Haq, S.Sos')); ?>" oninput="syncAdminKepsekNamePreview(this.value)" class="ref-input font-medium font-bold text-slate-800" placeholder="Contoh: Ustadzah Aisyah, S.Pd" required>
                    <span class="text-[11px] text-slate-400 mt-1 block">Nama pejabat kepala sekolah sesuai jenjang yang dipilih di atas.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIP / Identitas Kepsek</label>
                    <input type="text" id="adminInputNipKepsek" name="nip_kepsek" value="<?php echo e(old('nip_kepsek', $activeConfig['nip_kepsek'] ?? '-')); ?>" class="ref-input font-medium" placeholder="Kosongkan atau beri tanda - jika tidak ada">
                    <span class="text-[11px] text-slate-400 mt-1 block">Nomor Induk Pegawai kepala sekolah (opsional).</span>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Template Default Catatan Wali Kelas</label>
                    <textarea id="adminInputTemplateCatatan" name="catatan_walas_template" rows="3" class="ref-input font-normal leading-relaxed" placeholder="Tuliskan template pesan wali kelas default..."><?php echo e(old('catatan_walas_template', $activeConfig['catatan_walas_template'] ?? '')); ?></textarea>
                    <span class="text-[11px] text-slate-400 mt-1 block">Gunakan tag <code>{nama}</code> untuk menyisipkan nama siswa secara otomatis. Template ini akan menjadi teks saran awal saat guru membuka lembar rapor.</span>
                </div>
            </div>

            <!-- Bagian Upload Tanda Tangan Kepala Sekolah (Per Jenjang Otomatis Hapus Background) -->
            <div class="mb-6 pt-5 border-t border-slate-200">
                <input type="hidden" name="ttd_kepsek" id="adminInputTtdKepsek" value="<?php echo e(old('ttd_kepsek', $activeConfig['ttd_kepsek'] ?? '')); ?>">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4">
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-signature text-emerald-700"></i> Tanda Tangan Digital Kepala Sekolah (<span id="adminTtdJenjangLabel"><?php echo e(strtoupper($activePengaturanJenjang)); ?></span>)
                        </h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Unggah foto atau hasil scan tanda tangan Kepala Sekolah berlatar kertas putih. Background otomatis dihapus transparan seketika di browser.</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 w-fit flex-shrink-0">
                        <i class="fa-solid fa-wand-magic-sparkles text-emerald-600 text-[10px]"></i> Auto-Hapus Background Aktif
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Kartu TTD Kepala Sekolah -->
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-xs font-bold text-slate-700">Tanda Tangan Kepala Sekolah</label>
                                <span id="adminStatusTtdKepsek" class="text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-200 text-slate-600">Belum diunggah</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mb-2.5 truncate">Pejabat: <strong id="adminPreviewNamaKepsek" class="text-slate-700"><?php echo e($activeConfig['nama_kepsek'] ?? 'Kepala Sekolah'); ?></strong></p>

                            <div id="adminBoxPreviewTtdKepsek" class="h-24 rounded-lg border-2 border-dashed border-slate-300 bg-white flex items-center justify-center relative overflow-hidden mb-3">
                                <img id="adminThumbTtdKepsek" src="" alt="TTD Kepala Sekolah" class="max-h-20 max-w-full object-contain hidden" style="mix-blend-mode: multiply;" />
                                <div id="adminPlaceholderTtdKepsek" class="text-center text-slate-400">
                                    <i class="fa-solid fa-file-signature text-2xl mb-1 text-slate-300 block"></i>
                                    <span class="text-[11px]">Belum ada tanda tangan</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="file" id="adminFileTtdKepsek" accept="image/*" class="hidden" onchange="handleAdminSignatureUpload(this)">
                            <button type="button" onclick="document.getElementById('adminFileTtdKepsek').click()" class="flex-1 px-3 py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-xs font-bold flex items-center justify-center gap-1.5 transition-colors cursor-pointer shadow-xs whitespace-nowrap">
                                <i class="fa-solid fa-arrow-up-from-bracket text-[11px]"></i> Upload TTD Kepsek
                            </button>
                            <button type="button" id="adminBtnHapusTtdKepsek" onclick="removeAdminSignature()" class="px-3 py-2 bg-slate-200 hover:bg-rose-100 hover:text-rose-700 text-slate-600 rounded-lg text-xs font-semibold transition-colors hidden cursor-pointer" title="Hapus tanda tangan kepala sekolah">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Info Pembagian TTD Wali Kelas -->
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/40 flex flex-col justify-between">
                        <div>
                            <h5 class="text-xs font-bold text-slate-700 flex items-center gap-1.5 mb-1.5">
                                <i class="fa-solid fa-circle-info text-emerald-700"></i> Tata Kelola Pengesahan Per Jenjang
                            </h5>
                            <ul class="text-[11px] text-slate-600 space-y-1.5 leading-relaxed">
                                <li><strong>TTD &amp; Nama Kepsek Per Jenjang:</strong> Pilih jenjang TK, SD, atau SMP di atas untuk menetapkan masing-masing Kepala Sekolah dan TTD resminya.</li>
                                <li><strong>TTD Wali Kelas:</strong> Diunggah per kelas oleh masing-masing Wali Kelas (atau Admin via pemilih kelas) di tab <strong>Rapor &amp; TTD</strong>.</li>
                            </ul>
                        </div>
                        <div class="mt-3 pt-3 border-t border-slate-200/70">
                            <button type="button" onclick="switchAdminRaporTab('kelas')" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800 transition-colors cursor-pointer whitespace-nowrap">
                                <i class="fa-solid fa-pen-nib text-[11px]"></i> TTD Wali Kelas <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" id="btnSubmitPengaturanRapor" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition-all shadow-md flex items-center gap-2 cursor-pointer whitespace-nowrap">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan (<span id="btnSavePengaturanJenjangText"><?php echo e(strtoupper($activePengaturanJenjang)); ?></span>)
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ======================================================== -->
<!-- TAB GLOBAL 2: MASTER PROGRAM KEGIATAN SEKOLAH (RAPOR)    -->
<!-- ======================================================== -->
<?php
    $kegiatanCounts = [
        'all' => isset($data_kegiatan) ? count($data_kegiatan) : 0,
        'tk' => isset($data_kegiatan) ? $data_kegiatan->where('jenjang', 'tk')->count() : 0,
        'sd' => isset($data_kegiatan) ? $data_kegiatan->where('jenjang', 'sd')->count() : 0,
        'smp' => isset($data_kegiatan) ? $data_kegiatan->where('jenjang', 'smp')->count() : 0,
        'semua' => isset($data_kegiatan) ? $data_kegiatan->where('jenjang', 'semua')->count() : 0,
    ];
    $prestasiCounts = [
        'all' => isset($data_prestasi) ? count($data_prestasi) : 0,
        'tk' => isset($data_prestasi) ? $data_prestasi->where('jenjang', 'tk')->count() : 0,
        'sd' => isset($data_prestasi) ? $data_prestasi->where('jenjang', 'sd')->count() : 0,
        'smp' => isset($data_prestasi) ? $data_prestasi->where('jenjang', 'smp')->count() : 0,
        'semua' => isset($data_prestasi) ? $data_prestasi->where('jenjang', 'semua')->count() : 0,
    ];
?>
<div id="adminRaporPane-kegiatan" class="admin-rapor-pane hidden">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8" id="sectionKegiatanSekolah">
        <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-mosque"></i>
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h3 class="text-base font-bold text-slate-800">Master Program Kegiatan Sekolah (Rapor)</h3>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">Per Jenjang &amp; Global</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">Daftar kegiatan resmi yang tampil otomatis sesuai jenjang TK, SD, SMP, atau semua jenjang pada dokumen Rapor Siswa.</p>
                </div>
            </div>

            <div class="flex items-center gap-2 flex-shrink-0">
                <button type="button" onclick="openAddKegiatanModal()" class="px-4 py-2 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold cursor-pointer inline-flex items-center gap-1.5 transition-colors shadow-xs whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> Tambah
                </button>
            </div>
        </div>

        <div class="p-6">
            <!-- Filter Jenjang Program Kegiatan -->
            <div class="flex flex-wrap items-center justify-between gap-3 pb-4 mb-2 border-b border-slate-100">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mr-1 flex items-center gap-1 whitespace-nowrap">
                        <i class="fa-solid fa-filter text-emerald-700"></i> Filter Jenjang:
                    </span>
                    <button type="button" onclick="filterAdminJenjangTable('kegiatan', 'all')" data-kegiatan-filter="all" class="kegiatan-filter-btn px-3 py-1.5 rounded-lg text-xs font-bold transition-all cursor-pointer bg-emerald-700 text-white shadow-xs whitespace-nowrap">
                        Semua (<?php echo e($kegiatanCounts['all']); ?>)
                    </button>
                    <button type="button" onclick="filterAdminJenjangTable('kegiatan', 'tk')" data-kegiatan-filter="tk" class="kegiatan-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all cursor-pointer bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-800 whitespace-nowrap">
                        TK (<?php echo e($kegiatanCounts['tk']); ?>)
                    </button>
                    <button type="button" onclick="filterAdminJenjangTable('kegiatan', 'sd')" data-kegiatan-filter="sd" class="kegiatan-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all cursor-pointer bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-800 whitespace-nowrap">
                        SD (<?php echo e($kegiatanCounts['sd']); ?>)
                    </button>
                    <button type="button" onclick="filterAdminJenjangTable('kegiatan', 'smp')" data-kegiatan-filter="smp" class="kegiatan-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all cursor-pointer bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-800 whitespace-nowrap">
                        SMP (<?php echo e($kegiatanCounts['smp']); ?>)
                    </button>
                    <button type="button" onclick="filterAdminJenjangTable('kegiatan', 'semua')" data-kegiatan-filter="semua" class="kegiatan-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all cursor-pointer bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-800 whitespace-nowrap">
                        Umum (<?php echo e($kegiatanCounts['semua']); ?>)
                    </button>
                </div>
                <label class="inline-flex items-center gap-1.5 text-[11px] font-medium text-slate-600 cursor-pointer select-none">
                    <input type="checkbox" id="kegiatanIncludeGlobal" onchange="reapplyKegiatanFilter()" class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600">
                    <span>Sertakan item Global (Semua) saat memfilter TK/SD/SMP</span>
                </label>
            </div>

            <div class="overflow-x-auto">
                <?php if (isset($component)) { $__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.table','data' => ['id' => 'tableKegiatanSekolah']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'tableKegiatanSekolah']); ?>
                     <?php $__env->slot('thead', null, []); ?> 
                        <tr>
                            <th style="width: 60px; text-align: center;">No.</th>
                            <th style="width: 220px;">Nama Program Kegiatan</th>
                            <th style="width: 140px; text-align: center;">Jenjang Sasaran</th>
                            <th>Keterangan Default / Panduan Nilai</th>
                            <th style="width: 100px; text-align: center;">Status</th>
                            <th style="width: 110px; text-align: center;">Aksi</th>
                        </tr>
                     <?php $__env->endSlot(); ?>

                    <?php if(isset($data_kegiatan) && count($data_kegiatan) > 0): ?>
                        <?php $__currentLoopData = $data_kegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $keg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="kegiatan-row" data-jenjang="<?php echo e(strtolower(trim($keg->jenjang ?: 'semua'))); ?>">
                                <td class="kegiatan-row-no" style="text-align: center; font-weight: 600;"><?php echo e($idx + 1); ?></td>
                                <td>
                                    <strong style="color: #1e293b; font-size: 14px;"><?php echo e($keg->nama_kegiatan); ?></strong>
                                </td>
                                <td style="text-align: center;">
                                    <span class="badge-jenjang <?php echo e($keg->jenjang === 'sd' ? 'badge-sd' : ($keg->jenjang === 'smp' ? 'badge-smp' : ($keg->jenjang === 'tk' ? 'badge-tk' : ($keg->jenjang === 'sma' ? 'badge-sma' : 'badge-umum')))); ?>">
                                        <?php echo e(strtoupper($keg->jenjang === 'semua' ? 'SEMUA' : $keg->jenjang)); ?>

                                    </span>
                                </td>
                                <td>
                                    <span style="color: #475569; font-size: 12.5px; line-height: 1.4; display: block;">
                                        <?php echo e($keg->keterangan_default ?? '-'); ?>

                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <?php if($keg->aktif): ?>
                                        <span style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; padding: 3px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="fa-solid fa-check"></i> Aktif
                                        </span>
                                    <?php else: ?>
                                        <span style="background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; padding: 3px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="fa-solid fa-xmark"></i> Non-Aktif
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <button type="button" onclick="openEditKegiatan(<?php echo e($keg->id); ?>, '<?php echo e(addslashes($keg->nama_kegiatan)); ?>', '<?php echo e($keg->jenjang); ?>', '<?php echo e(addslashes($keg->keterangan_default)); ?>', <?php echo e($keg->aktif ? 'true' : 'false'); ?>)" style="background: #e9f2ff; color: #3875c5; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center;" title="Edit Kegiatan">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" onclick="openDeleteKegiatan(<?php echo e($keg->id); ?>, '<?php echo e(addslashes($keg->nama_kegiatan)); ?>')" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center;" title="Hapus Kegiatan">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr id="kegiatanFilterEmptyRow" data-empty-state="true" style="display: none;">
                            <td colspan="6" style="text-align: center; padding: 32px; color: #64748b;">
                                <i class="fa-solid fa-filter-circle-xmark" style="font-size: 26px; margin-bottom: 8px; display: block; color: #cbd5e1;"></i>
                                Belum ada program kegiatan khusus untuk filter jenjang ini.
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #64748b;">
                                <i class="fa-solid fa-mosque" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                                Belum ada Master Program Kegiatan Sekolah yang diatur.
                            </td>
                        </tr>
                    <?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880)): ?>
<?php $attributes = $__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880; ?>
<?php unset($__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880)): ?>
<?php $component = $__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880; ?>
<?php unset($__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- TAB GLOBAL 3: MASTER JENIS PRESTASI (TEMPLATE RAPOR)     -->
<!-- ======================================================== -->
<div id="adminRaporPane-template_prestasi" class="admin-rapor-pane hidden">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h3 class="text-base font-bold text-slate-800">Master Jenis Prestasi (Template Rapor Siswa)</h3>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">Per Jenjang &amp; Global</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">Daftar template capaian prestasi resmi sesuai jenjang (TK, SD, SMP, atau semua jenjang) yang otomatis tampil sebagai pilihan cepat Wali Kelas.</p>
                </div>
            </div>

            <div class="flex items-center gap-2 flex-shrink-0">
                <button type="button" onclick="openAddPrestasiModal()" class="px-4 py-2 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold cursor-pointer inline-flex items-center gap-1.5 transition-colors shadow-xs whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> Tambah
                </button>
            </div>
        </div>

        <div class="p-6">
            <!-- Filter Jenjang Template Jenis Prestasi -->
            <div class="flex flex-wrap items-center justify-between gap-3 pb-4 mb-2 border-b border-slate-100">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mr-1 flex items-center gap-1 whitespace-nowrap">
                        <i class="fa-solid fa-filter text-emerald-700"></i> Filter Jenjang:
                    </span>
                    <button type="button" onclick="filterAdminJenjangTable('prestasi', 'all')" data-prestasi-filter="all" class="prestasi-filter-btn px-3 py-1.5 rounded-lg text-xs font-bold transition-all cursor-pointer bg-emerald-700 text-white shadow-xs whitespace-nowrap">
                        Semua (<?php echo e($prestasiCounts['all']); ?>)
                    </button>
                    <button type="button" onclick="filterAdminJenjangTable('prestasi', 'tk')" data-prestasi-filter="tk" class="prestasi-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all cursor-pointer bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-800 whitespace-nowrap">
                        TK (<?php echo e($prestasiCounts['tk']); ?>)
                    </button>
                    <button type="button" onclick="filterAdminJenjangTable('prestasi', 'sd')" data-prestasi-filter="sd" class="prestasi-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all cursor-pointer bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-800 whitespace-nowrap">
                        SD (<?php echo e($prestasiCounts['sd']); ?>)
                    </button>
                    <button type="button" onclick="filterAdminJenjangTable('prestasi', 'smp')" data-prestasi-filter="smp" class="prestasi-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all cursor-pointer bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-800 whitespace-nowrap">
                        SMP (<?php echo e($prestasiCounts['smp']); ?>)
                    </button>
                    <button type="button" onclick="filterAdminJenjangTable('prestasi', 'semua')" data-prestasi-filter="semua" class="prestasi-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all cursor-pointer bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-800 whitespace-nowrap">
                        Umum (<?php echo e($prestasiCounts['semua']); ?>)
                    </button>
                </div>
                <label class="inline-flex items-center gap-1.5 text-[11px] font-medium text-slate-600 cursor-pointer select-none">
                    <input type="checkbox" id="prestasiIncludeGlobal" onchange="reapplyPrestasiFilter()" class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600">
                    <span>Sertakan item Global (Semua) saat memfilter TK/SD/SMP</span>
                </label>
            </div>

            <div class="overflow-x-auto">
                <?php if (isset($component)) { $__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.table','data' => ['id' => 'tableMasterPrestasi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'tableMasterPrestasi']); ?>
                     <?php $__env->slot('thead', null, []); ?> 
                        <tr>
                            <th style="width: 60px; text-align: center;">No.</th>
                            <th>Nama Capaian / Template Prestasi</th>
                            <th style="width: 160px; text-align: center;">Kategori Bidang</th>
                            <th style="width: 120px; text-align: center;">Jenjang</th>
                            <th style="width: 100px; text-align: center;">Status</th>
                            <th style="width: 110px; text-align: center;">Aksi</th>
                        </tr>
                     <?php $__env->endSlot(); ?>

                    <?php if(isset($data_prestasi) && count($data_prestasi) > 0): ?>
                        <?php $__currentLoopData = $data_prestasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pIdx => $pres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="prestasi-row" data-jenjang="<?php echo e(strtolower(trim($pres->jenjang ?: 'semua'))); ?>">
                                <td class="prestasi-row-no" style="text-align: center; font-weight: 600;"><?php echo e($pIdx + 1); ?></td>
                                <td>
                                    <strong style="color: #1e293b; font-size: 14px;"><?php echo e($pres->nama_prestasi); ?></strong>
                                </td>
                                <td style="text-align: center;">
                                    <span class="badge-jenjang" style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a;">
                                        <?php echo e($pres->kategori); ?>

                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <span class="badge-jenjang <?php echo e($pres->jenjang === 'sd' ? 'badge-sd' : ($pres->jenjang === 'smp' ? 'badge-smp' : ($pres->jenjang === 'tk' ? 'badge-tk' : ($pres->jenjang === 'sma' ? 'badge-sma' : 'badge-umum')))); ?>">
                                        <?php echo e(strtoupper($pres->jenjang === 'semua' ? 'SEMUA' : $pres->jenjang)); ?>

                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <?php if($pres->aktif): ?>
                                        <span style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; padding: 3px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="fa-solid fa-check"></i> Aktif
                                        </span>
                                    <?php else: ?>
                                        <span style="background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; padding: 3px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="fa-solid fa-xmark"></i> Non-Aktif
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <button type="button" onclick="openEditPrestasi(<?php echo e($pres->id); ?>, '<?php echo e(addslashes($pres->nama_prestasi)); ?>', '<?php echo e($pres->kategori); ?>', '<?php echo e($pres->jenjang); ?>', <?php echo e($pres->aktif ? 'true' : 'false'); ?>)" style="background: #e9f2ff; color: #3875c5; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center;" title="Edit Template Prestasi">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" onclick="openDeletePrestasi(<?php echo e($pres->id); ?>, '<?php echo e(addslashes($pres->nama_prestasi)); ?>')" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center;" title="Hapus Template Prestasi">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr id="prestasiFilterEmptyRow" data-empty-state="true" style="display: none;">
                            <td colspan="6" style="text-align: center; padding: 32px; color: #64748b;">
                                <i class="fa-solid fa-filter-circle-xmark" style="font-size: 26px; margin-bottom: 8px; display: block; color: #cbd5e1;"></i>
                                Belum ada template jenis prestasi khusus untuk filter jenjang ini.
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #64748b;">
                                <i class="fa-solid fa-trophy" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                                Belum ada Master Template Jenis Prestasi yang diatur.
                            </td>
                        </tr>
                    <?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880)): ?>
<?php $attributes = $__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880; ?>
<?php unset($__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880)): ?>
<?php $component = $__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880; ?>
<?php unset($__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL KEGIATAN SEKOLAH & TEMPLATE PRESTASI               -->
<!-- ======================================================== -->
<?php if (isset($component)) { $__componentOriginale960230fd71228156fe70d1ba75c1455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960230fd71228156fe70d1ba75c1455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.modal','data' => ['id' => 'addKegiatanModal','title' => 'Tambah Program Kegiatan Sekolah','icon' => 'fa-mosque','iconColor' => '#047857','iconBg' => '#ecfdf5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'addKegiatanModal','title' => 'Tambah Program Kegiatan Sekolah','icon' => 'fa-mosque','iconColor' => '#047857','iconBg' => '#ecfdf5']); ?>
    <form action="/sk/simpan-kegiatan-sekolah" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="filter_jenjang" id="addKegiatanFilterJenjang" value="">
        <div style="margin-bottom: 14px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Nama Program Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="ref-input" required maxlength="150" placeholder="Contoh: Sholat Berjamaah / Tahfidz Pagi">
        </div>
        <div style="margin-bottom: 14px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jenjang Sasaran</label>
            <select name="jenjang" id="addKegiatanJenjang" class="ref-input" required>
                <option value="semua">Semua Jenjang (TK, SD, SMP)</option>
                <option value="tk">TK</option>
                <option value="sd">SD</option>
                <option value="smp">SMP</option>
                <option value="sma">SMA</option>
            </select>
        </div>
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Keterangan Default / Panduan Nilai (Opsional)</label>
            <textarea name="keterangan_default" rows="3" class="ref-input" placeholder="Deskripsi singkat atau panduan penilaian wali kelas..."></textarea>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeModal('addKegiatanModal')" style="padding: 10px 16px; border: none; background: #f1f5f9; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
            <button type="submit" style="padding: 10px 16px; border: none; background: #047857; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan</button>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $attributes = $__attributesOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__attributesOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $component = $__componentOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__componentOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginale960230fd71228156fe70d1ba75c1455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960230fd71228156fe70d1ba75c1455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.modal','data' => ['id' => 'editKegiatanModal','title' => 'Edit Program Kegiatan Sekolah','icon' => 'fa-pen-to-square','iconColor' => '#047857','iconBg' => '#ecfdf5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'editKegiatanModal','title' => 'Edit Program Kegiatan Sekolah','icon' => 'fa-pen-to-square','iconColor' => '#047857','iconBg' => '#ecfdf5']); ?>
    <form id="editKegiatanForm" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="filter_jenjang" id="editKegiatanFilterJenjang" value="">
        <div style="margin-bottom: 14px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Nama Program Kegiatan</label>
            <input type="text" name="nama_kegiatan" id="ekNama" class="ref-input" required maxlength="150">
        </div>
        <div style="margin-bottom: 14px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jenjang Sasaran</label>
            <select name="jenjang" id="ekJenjang" class="ref-input" required>
                <option value="semua">Semua Jenjang (TK, SD, SMP)</option>
                <option value="tk">TK</option>
                <option value="sd">SD</option>
                <option value="smp">SMP</option>
                <option value="sma">SMA</option>
            </select>
        </div>
        <div style="margin-bottom: 14px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Keterangan Default / Panduan Nilai (Opsional)</label>
            <textarea name="keterangan_default" id="ekKet" rows="3" class="ref-input"></textarea>
        </div>
        <div style="margin-bottom: 20px;">
            <input type="hidden" name="aktif" value="0">
            <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13.5px; color: #334155; font-weight: 600;">
                <input type="checkbox" name="aktif" id="ekAktif" value="1" style="width: 16px; height: 16px; accent-color: #177455;">
                Kegiatan Aktif (Muncul di Penilaian Rapor Wali Kelas)
            </label>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeModal('editKegiatanModal')" style="padding: 10px 16px; border: none; background: #f1f5f9; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
            <button type="submit" style="padding: 10px 16px; border: none; background: #047857; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Perbarui</button>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $attributes = $__attributesOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__attributesOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $component = $__componentOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__componentOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginale960230fd71228156fe70d1ba75c1455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960230fd71228156fe70d1ba75c1455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.modal','data' => ['id' => 'addPrestasiModal','title' => 'Tambah Template Jenis Prestasi','icon' => 'fa-trophy','iconColor' => '#047857','iconBg' => '#ecfdf5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'addPrestasiModal','title' => 'Tambah Template Jenis Prestasi','icon' => 'fa-trophy','iconColor' => '#047857','iconBg' => '#ecfdf5']); ?>
    <form id="addPrestasiForm" action="/sk/simpan-pengaturan-rapor" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="_master_action" value="simpan_master_prestasi">
        <input type="hidden" name="filter_jenjang" id="addPrestasiFilterJenjang" value="">
        <div style="margin-bottom: 14px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Nama Capaian / Template Prestasi</label>
            <input type="text" name="nama_prestasi" class="ref-input" required maxlength="200" placeholder="Contoh: Juara 1 MHQ Tingkat Sekolah">
        </div>
        <div style="display: flex; gap: 10px; margin-bottom: 20px;">
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Kategori Bidang</label>
                <select name="kategori" class="ref-input" required>
                    <option value="Tahfidz">Tahfidz</option>
                    <option value="Lomba">Lomba</option>
                    <option value="Bahasa">Bahasa</option>
                    <option value="Karakter">Karakter</option>
                    <option value="Akademik">Akademik</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jenjang</label>
                <select name="jenjang" id="addPrestasiJenjang" class="ref-input" required>
                    <option value="semua">Semua Jenjang (TK, SD, SMP)</option>
                    <option value="tk">TK</option>
                    <option value="sd">SD</option>
                    <option value="smp">SMP</option>
                    <option value="sma">SMA</option>
                </select>
            </div>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeModal('addPrestasiModal')" style="padding: 10px 16px; border: none; background: #f1f5f9; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
            <button type="submit" style="padding: 10px 16px; border: none; background: #047857; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan</button>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $attributes = $__attributesOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__attributesOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $component = $__componentOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__componentOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginale960230fd71228156fe70d1ba75c1455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960230fd71228156fe70d1ba75c1455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.modal','data' => ['id' => 'editPrestasiModal','title' => 'Edit Template Jenis Prestasi','icon' => 'fa-pen-to-square','iconColor' => '#047857','iconBg' => '#ecfdf5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'editPrestasiModal','title' => 'Edit Template Jenis Prestasi','icon' => 'fa-pen-to-square','iconColor' => '#047857','iconBg' => '#ecfdf5']); ?>
    <form id="editPrestasiForm" action="/sk/simpan-pengaturan-rapor" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="_master_action" value="update_master_prestasi">
        <input type="hidden" name="prestasi_id" id="epId" value="">
        <input type="hidden" name="filter_jenjang" id="editPrestasiFilterJenjang" value="">
        <div style="margin-bottom: 14px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Nama Capaian / Template Prestasi</label>
            <input type="text" name="nama_prestasi" id="epNama" class="ref-input" required maxlength="200">
        </div>
        <div style="display: flex; gap: 10px; margin-bottom: 14px;">
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Kategori Bidang</label>
                <select name="kategori" id="epKategori" class="ref-input" required>
                    <option value="Tahfidz">Tahfidz</option>
                    <option value="Lomba">Lomba</option>
                    <option value="Bahasa">Bahasa</option>
                    <option value="Karakter">Karakter</option>
                    <option value="Akademik">Akademik</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jenjang</label>
                <select name="jenjang" id="epJenjang" class="ref-input" required>
                    <option value="semua">Semua Jenjang (TK, SD, SMP)</option>
                    <option value="tk">TK</option>
                    <option value="sd">SD</option>
                    <option value="smp">SMP</option>
                    <option value="sma">SMA</option>
                </select>
            </div>
        </div>
        <div style="margin-bottom: 20px;">
            <input type="hidden" name="aktif" value="0">
            <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13.5px; color: #334155; font-weight: 600;">
                <input type="checkbox" name="aktif" id="epAktif" value="1" style="width: 16px; height: 16px; accent-color: #177455;">
                Template Aktif (Muncul di Pilihan Cepat Wali Kelas)
            </label>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeModal('editPrestasiModal')" style="padding: 10px 16px; border: none; background: #f1f5f9; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
            <button type="submit" style="padding: 10px 16px; border: none; background: #047857; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Perbarui</button>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $attributes = $__attributesOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__attributesOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $component = $__componentOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__componentOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>

<form id="deleteMasterPrestasiForm" action="/sk/simpan-pengaturan-rapor" method="POST" class="hidden">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="_master_action" value="hapus_master_prestasi">
    <input type="hidden" name="prestasi_id" id="delPrestasiIdInput" value="">
    <input type="hidden" name="filter_jenjang" id="delPrestasiFilterJenjang" value="">
</form>

<?php if (isset($component)) { $__componentOriginale960230fd71228156fe70d1ba75c1455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960230fd71228156fe70d1ba75c1455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.modal','data' => ['id' => 'deleteAdminRaporModal','title' => 'Konfirmasi Hapus','icon' => 'fa-trash-can','iconColor' => '#b34d4d','iconBg' => '#f8e9e9']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'deleteAdminRaporModal','title' => 'Konfirmasi Hapus','icon' => 'fa-trash-can','iconColor' => '#b34d4d','iconBg' => '#f8e9e9']); ?>
    <p style="margin-top: -10px; margin-bottom: 20px; color: #475569; line-height: 1.5; font-size: 14px;">
        Anda yakin ingin menghapus data <strong id="delAdminRaporName" style="color: #1e293b;"></strong>? Data yang dihapus tidak dapat dipulihkan.
    </p>
    <div style="display: flex; justify-content: flex-end; gap: 10px;">
        <button type="button" onclick="closeModal('deleteAdminRaporModal')" style="padding: 10px 16px; border: none; background: #f1f5f9; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
        <button type="button" id="btnConfirmDeleteAdminRapor" style="padding: 10px 16px; border: none; background: #b34d4d; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 6px;">
            <i class="fa-solid fa-trash-can"></i> Ya, Hapus
        </button>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $attributes = $__attributesOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__attributesOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $component = $__componentOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__componentOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>

<script>
    const ADMIN_PENGATURAN_MAP = <?php echo json_encode($pengaturanMapAdmin, 15, 512) ?>;
    window.__activeKegiatanFilter = 'all';
    window.__activePrestasiFilter = 'all';

    let deleteAdminRaporTargetUrl = '';
    let deleteAdminRaporMode = '';
    let deleteAdminPrestasiId = '';

    if (typeof window.openModal !== 'function') {
        window.openModal = function(id) {
            const el = document.getElementById(id);
            if (el) el.style.display = 'flex';
        };
    }

    if (typeof window.closeModal !== 'function') {
        window.closeModal = function(id) {
            const el = document.getElementById(id);
            if (el) el.style.display = 'none';
        };
    }

    function selectAdminPengesahanJenjang(jenjang, updateUrl = true) {
        if (!['tk', 'sd', 'smp'].includes(jenjang)) {
            jenjang = 'tk';
        }
        const cfg = ADMIN_PENGATURAN_MAP[jenjang] || ADMIN_PENGATURAN_MAP['tk'] || {};
        const jInput = document.getElementById('adminPengaturanJenjangInput');
        if (jInput) jInput.value = jenjang;

        const elTanggal = document.getElementById('adminInputTanggalRapor');
        const elTempat = document.getElementById('adminInputTempatRapor');
        const elKepsek = document.getElementById('adminInputNamaKepsek');
        const elNip = document.getElementById('adminInputNipKepsek');
        const elCat = document.getElementById('adminInputTemplateCatatan');
        const elTtd = document.getElementById('adminInputTtdKepsek');

        if (elTanggal) elTanggal.value = cfg.tanggal_rapor || '20 Desember 2025';
        if (elTempat) elTempat.value = cfg.tempat_rapor || 'Tinggede';
        if (elKepsek) elKepsek.value = cfg.nama_kepsek || '';
        if (elNip) elNip.value = cfg.nip_kepsek || '-';
        if (elCat) elCat.value = cfg.catatan_walas_template || '';
        if (elTtd) elTtd.value = cfg.ttd_kepsek || '';

        syncAdminKepsekNamePreview(cfg.nama_kepsek || 'Kepala Sekolah');
        syncAdminSignatureCard();

        const upperLabel = jenjang.toUpperCase();
        const badgeEl = document.getElementById('adminPengaturanActiveBadge');
        if (badgeEl) {
            const span = badgeEl.querySelector('span');
            if (span) span.textContent = 'Jenjang ' + upperLabel;
        }
        const ttdLabelEl = document.getElementById('adminTtdJenjangLabel');
        if (ttdLabelEl) ttdLabelEl.textContent = upperLabel;
        const saveTextEl = document.getElementById('btnSavePengaturanJenjangText');
        if (saveTextEl) saveTextEl.textContent = upperLabel;

        // Highlight card buttons (satu tema hijau)
        document.querySelectorAll('#adminPengaturanJenjangCards button[data-jenjang]').forEach(btn => {
            const isSel = btn.getAttribute('data-jenjang') === jenjang;
            btn.className = 'text-left p-3.5 rounded-xl border transition-all cursor-pointer flex flex-col justify-between gap-2 ' +
                (isSel ? 'bg-emerald-50/80 border-emerald-600 ring-2 ring-emerald-500/20 shadow-xs' : 'bg-white border-slate-200 hover:border-emerald-300 hover:bg-slate-50/70');
        });

        // Update status info note
        const noteEl = document.getElementById('adminPengaturanStatusNote');
        const titleEl = document.getElementById('adminPengaturanStatusTitle');
        const descEl = document.getElementById('adminPengaturanStatusDesc');
        if (noteEl && titleEl && descEl) {
            const icon = noteEl.querySelector('i');
            if (cfg.is_custom) {
                noteEl.className = 'p-4 mb-6 rounded-xl bg-emerald-50/70 border border-emerald-200 text-emerald-900 text-xs flex items-start gap-3';
                if (icon) icon.className = 'fa-solid fa-circle-info text-emerald-700 text-base mt-0.5 flex-shrink-0';
                titleEl.textContent = 'Pengaturan Khusus Jenjang ' + upperLabel + ' Aktif:';
                descEl.textContent = 'Seluruh rapor siswa, cetak massal, dan leger kelas di jenjang ' + upperLabel + ' otomatis memakai data Kepala Sekolah & TTD di bawah ini.';
            } else {
                noteEl.className = 'p-4 mb-6 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 text-xs flex items-start gap-3';
                if (icon) icon.className = 'fa-solid fa-circle-info text-slate-500 text-base mt-0.5 flex-shrink-0';
                titleEl.textContent = 'Jenjang ' + upperLabel + ' Belum Diatur Khusus:';
                descEl.textContent = 'Kolom di bawah sementara menampilkan data awal. Ubah nama Kepala Sekolah / TTD sesuai pejabat jenjang ' + upperLabel + ' lalu klik Simpan.';
            }
        }

        if (updateUrl) {
            try {
                const url = new URL(window.location);
                if (url.searchParams.get('tab') === 'pengesahan') {
                    url.searchParams.set('jenjang', jenjang);
                    window.history.replaceState({}, '', url);
                }
            } catch (e) {}
        }
    }

    function syncAdminKepsekNamePreview(val) {
        const preview = document.getElementById('adminPreviewNamaKepsek');
        if (preview) {
            preview.textContent = (val || '').trim() || 'Kepala Sekolah';
        }
    }

    function filterAdminJenjangTable(type, filterVal, updateUrl = true) {
        const isKegiatan = (type === 'kegiatan');
        if (isKegiatan) {
            window.__activeKegiatanFilter = filterVal;
        } else {
            window.__activePrestasiFilter = filterVal;
        }

        const includeGlobal = document.getElementById(isKegiatan ? 'kegiatanIncludeGlobal' : 'prestasiIncludeGlobal')?.checked || false;
        const activeBg = 'bg-emerald-700 text-white shadow-xs font-bold';
        const btnSelector = isKegiatan ? '.kegiatan-filter-btn' : '.prestasi-filter-btn';
        const btnAttr = isKegiatan ? 'data-kegiatan-filter' : 'data-prestasi-filter';

        document.querySelectorAll(btnSelector).forEach(btn => {
            const val = btn.getAttribute(btnAttr);
            btn.className = (isKegiatan ? 'kegiatan-filter-btn' : 'prestasi-filter-btn') +
                ' px-3 py-1.5 rounded-lg text-xs transition-all cursor-pointer whitespace-nowrap ' +
                (val === filterVal ? activeBg : 'font-semibold bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-800');
        });

        const rowSelector = isKegiatan ? '#tableKegiatanSekolah tr.kegiatan-row' : '#tableMasterPrestasi tr.prestasi-row';
        const noSelector = isKegiatan ? '.kegiatan-row-no' : '.prestasi-row-no';
        let visibleCount = 0;

        document.querySelectorAll(rowSelector).forEach(row => {
            const rowJenjang = (row.getAttribute('data-jenjang') || 'semua').toLowerCase();
            const matchDirect = (filterVal === 'all') || (rowJenjang === filterVal);
            const matchGlobal = includeGlobal && ['tk', 'sd', 'smp'].includes(filterVal) && rowJenjang === 'semua';

            if (matchDirect || matchGlobal) {
                row.removeAttribute('data-filtered-out');
                visibleCount++;
                const noCell = row.querySelector(noSelector);
                if (noCell) noCell.textContent = visibleCount;
            } else {
                row.setAttribute('data-filtered-out', 'true');
            }
        });

        const emptyRow = document.getElementById(isKegiatan ? 'kegiatanFilterEmptyRow' : 'prestasiFilterEmptyRow');
        if (emptyRow) {
            emptyRow.style.display = visibleCount === 0 ? 'table-row' : 'none';
        }

        if (updateUrl) {
            try {
                const url = new URL(window.location);
                const expectedTab = isKegiatan ? 'kegiatan' : 'template_prestasi';
                if (url.searchParams.get('tab') === expectedTab) {
                    if (filterVal === 'all') {
                        url.searchParams.delete('jenjang');
                    } else {
                        url.searchParams.set('jenjang', filterVal);
                    }
                    window.history.replaceState({}, '', url);
                }
            } catch (e) {}
        }

        if (typeof window.refreshSiakadPagination === 'function') {
            window.refreshSiakadPagination();
        }
    }

    function reapplyKegiatanFilter() {
        filterAdminJenjangTable('kegiatan', window.__activeKegiatanFilter || 'all', false);
    }

    function reapplyPrestasiFilter() {
        filterAdminJenjangTable('prestasi', window.__activePrestasiFilter || 'all', false);
    }

    function openAddKegiatanModal() {
        const activeFilter = window.__activeKegiatanFilter || 'all';
        const filterInput = document.getElementById('addKegiatanFilterJenjang');
        if (filterInput) filterInput.value = activeFilter !== 'all' ? activeFilter : '';

        const selectEl = document.getElementById('addKegiatanJenjang');
        if (selectEl) {
            selectEl.value = ['tk', 'sd', 'smp', 'semua'].includes(activeFilter) ? activeFilter : 'semua';
        }
        openModal('addKegiatanModal');
    }

    function openAddPrestasiModal() {
        const activeFilter = window.__activePrestasiFilter || 'all';
        const filterInput = document.getElementById('addPrestasiFilterJenjang');
        if (filterInput) filterInput.value = activeFilter !== 'all' ? activeFilter : '';

        const selectEl = document.getElementById('addPrestasiJenjang');
        if (selectEl) {
            selectEl.value = ['tk', 'sd', 'smp', 'semua'].includes(activeFilter) ? activeFilter : 'semua';
        }
        openModal('addPrestasiModal');
    }

    function openEditKegiatan(id, nama, jenjang, ket, aktif) {
        const activeFilter = window.__activeKegiatanFilter || 'all';
        document.getElementById('editKegiatanForm').action = '/sk/update-kegiatan-sekolah/' + id;
        const filterInput = document.getElementById('editKegiatanFilterJenjang');
        if (filterInput) filterInput.value = activeFilter !== 'all' ? activeFilter : '';
        document.getElementById('ekNama').value = nama || '';
        document.getElementById('ekJenjang').value = jenjang || 'semua';
        document.getElementById('ekKet').value = ket || '';
        document.getElementById('ekAktif').checked = !!aktif;
        openModal('editKegiatanModal');
    }

    function openDeleteKegiatan(id, nama) {
        const activeFilter = window.__activeKegiatanFilter || 'all';
        const suffix = (activeFilter && activeFilter !== 'all') ? ('?filter_jenjang=' + encodeURIComponent(activeFilter)) : '';
        deleteAdminRaporMode = 'kegiatan';
        deleteAdminRaporTargetUrl = '/sk/hapus-kegiatan-sekolah/' + id + suffix;
        document.getElementById('delAdminRaporName').textContent = 'Kegiatan: ' + nama;
        openModal('deleteAdminRaporModal');
    }

    function openEditPrestasi(id, nama, kategori, jenjang, aktif) {
        const activeFilter = window.__activePrestasiFilter || 'all';
        document.getElementById('epId').value = id;
        const filterInput = document.getElementById('editPrestasiFilterJenjang');
        if (filterInput) filterInput.value = activeFilter !== 'all' ? activeFilter : '';
        document.getElementById('epNama').value = nama || '';
        document.getElementById('epKategori').value = kategori || 'Tahfidz';
        document.getElementById('epJenjang').value = jenjang || 'semua';
        document.getElementById('epAktif').checked = !!aktif;
        openModal('editPrestasiModal');
    }

    function openDeletePrestasi(id, nama) {
        deleteAdminRaporMode = 'prestasi';
        deleteAdminPrestasiId = id;
        document.getElementById('delAdminRaporName').textContent = 'Template Prestasi: ' + nama;
        openModal('deleteAdminRaporModal');
    }

    document.getElementById('btnConfirmDeleteAdminRapor')?.addEventListener('click', function() {
        if (deleteAdminRaporMode === 'prestasi' && deleteAdminPrestasiId) {
            const activeFilter = window.__activePrestasiFilter || 'all';
            document.getElementById('delPrestasiIdInput').value = deleteAdminPrestasiId;
            document.getElementById('delPrestasiFilterJenjang').value = activeFilter !== 'all' ? activeFilter : '';
            document.getElementById('deleteMasterPrestasiForm').submit();
            return;
        }
        if (deleteAdminRaporTargetUrl) {
            window.location.href = deleteAdminRaporTargetUrl;
        }
    });

    // Manajemen TTD Kepala Sekolah (Per Jenjang)
    function syncAdminSignatureCard() {
        const val = document.getElementById('adminInputTtdKepsek')?.value || '';
        const img = document.getElementById('adminThumbTtdKepsek');
        const placeholder = document.getElementById('adminPlaceholderTtdKepsek');
        const status = document.getElementById('adminStatusTtdKepsek');
        const btnHapus = document.getElementById('adminBtnHapusTtdKepsek');

        if (!img || !placeholder || !status) return;

        if (val.trim() !== '') {
            img.src = val;
            img.classList.remove('hidden');
            placeholder.classList.add('hidden');
            status.textContent = 'Terunggah';
            status.className = 'text-[10px] font-semibold px-2 py-0.5 rounded bg-emerald-100 text-emerald-700';
            if (btnHapus) btnHapus.classList.remove('hidden');
        } else {
            img.src = '';
            img.classList.add('hidden');
            placeholder.classList.remove('hidden');
            status.textContent = 'Belum diunggah';
            status.className = 'text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-200 text-slate-600';
            if (btnHapus) btnHapus.classList.add('hidden');
        }
    }

    function handleAdminSignatureUpload(input) {
        if (!input.files || !input.files[0]) return;
        const status = document.getElementById('adminStatusTtdKepsek');
        const hiddenInput = document.getElementById('adminInputTtdKepsek');

        if (status) {
            status.textContent = 'Memproses...';
            status.className = 'text-[10px] font-semibold px-2 py-0.5 rounded bg-amber-100 text-amber-700';
        }

        if (typeof window.removeSignatureBackground === 'function') {
            window.removeSignatureBackground(input.files[0], function(transparentPng) {
                if (hiddenInput) hiddenInput.value = transparentPng;
                syncAdminSignatureCard();
            });
        } else {
            if (window.SiakadAlert) {
                window.SiakadAlert.warning('Komponen Belum Siap', 'Komponen pemroses tanda tangan belum siap. Silakan muat ulang halaman.');
            } else {
                alert('Komponen pemroses tanda tangan belum siap. Silakan muat ulang halaman.');
            }
            syncAdminSignatureCard();
        }

        input.value = '';
    }

    function removeAdminSignature() {
        const hiddenInput = document.getElementById('adminInputTtdKepsek');
        if (hiddenInput) hiddenInput.value = '';
        syncAdminSignatureCard();
    }

    document.addEventListener('DOMContentLoaded', function() {
        syncAdminSignatureCard();

        const params = new URLSearchParams(window.location.search);
        const tabParam = params.get('tab');
        const initialFilter = <?php echo json_encode($initialFilterJenjang, 15, 512) ?>;

        if (tabParam === 'kegiatan' && initialFilter && initialFilter !== 'all') {
            filterAdminJenjangTable('kegiatan', initialFilter, false);
        } else if (tabParam === 'template_prestasi' && initialFilter && initialFilter !== 'all') {
            filterAdminJenjangTable('prestasi', initialFilter, false);
        }
    });
</script>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/admin/partials/raporGlobalTabs.blade.php ENDPATH**/ ?>