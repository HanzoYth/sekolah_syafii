<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Cetak Rapor Siswa','description' => 'Laporan Hasil Belajar (Rapor) digital ananda '.e($siswa->nama).' sesuai standar Kurikulum Merdeka & Pesantren.','position' => 'Guru Wali Kelas','initials' => 'WK']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Cetak Rapor Siswa','description' => 'Laporan Hasil Belajar (Rapor) digital ananda '.e($siswa->nama).' sesuai standar Kurikulum Merdeka & Pesantren.','position' => 'Guru Wali Kelas','initials' => 'WK']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <a href="/sk/rapor-walas" class="text-slate-500 hover:text-emerald-600 transition-colors">Rapor & Leger</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium"><?php echo e($siswa->nama); ?></span>
        </li>
     <?php $__env->endSlot(); ?>

    <!-- ============================================================ -->
    <!-- PANEL KONTROL KUSTOMISASI WALI KELAS (NO-PRINT)             -->
    <!-- ============================================================ -->
    <div class="no-print bg-white rounded-2xl shadow-sm border border-slate-200/90 p-5 sm:p-6 mb-6">
        <!-- Top Toolbar -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <a href="/sk/rapor-walas" class="w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors shadow-xs">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                </a>
                <div>
                    <div class="flex items-center gap-2">
                        <h3 class="text-base sm:text-lg font-bold text-slate-800">Kustomisasi Rapor: <?php echo e($siswa->nama); ?></h3>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">Sesuaikan catatan, kegiatan sekolah, dan prestasi santri secara live sebelum mencetak.</p>
                </div>
            </div>

            <div class="flex items-center gap-2 flex-wrap">
                <button type="button" onclick="syncToDatabase(true)" id="btnManualSaveDb" class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-xs flex items-center gap-1.5">
                    <i class="fa-solid fa-floppy-disk text-[11px]"></i> Simpan Rapor
                </button>
                <button type="button" onclick="resetToDefaultTemplates()" class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors flex items-center gap-1.5">
                    <i class="fa-solid fa-rotate-left text-[11px]"></i> Reset Template
                </button>
                <a href="/sk/rapor-walas?tab=nilai<?php echo e(session('role') === 'a' ? '&kelas_id='.$siswa->kelas_id : ''); ?>" class="px-3.5 py-2 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 text-xs font-bold transition-colors flex items-center gap-1.5">
                    <i class="fa-solid fa-sliders text-[11px]"></i> Edit Nilai
                </a>
                <button type="button" onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition-all shadow-sm hover:shadow flex items-center gap-2">
                    <i class="fa-solid fa-print"></i> Cetak Dokumen Rapor
                </button>
            </div>
        </div>

        <!-- Tab Navigation Panel Kontrol -->
        <div class="mt-5 border-b border-slate-200">
            <nav class="flex space-x-2 sm:space-x-4 overflow-x-auto pb-px" id="editorTabs">
                <button type="button" onclick="switchEditorTab('tab-catatan')" id="tabBtn-catatan" class="tab-btn active px-3.5 py-2 text-xs font-bold border-b-2 border-emerald-600 text-emerald-700 flex items-center gap-1.5 whitespace-nowrap">
                    <i class="fa-solid fa-comment-dots"></i> 1. Catatan Wali Kelas
                </button>
                <button type="button" onclick="switchEditorTab('tab-kegiatan')" id="tabBtn-kegiatan" class="tab-btn px-3.5 py-2 text-xs font-semibold border-b-2 border-transparent text-slate-500 hover:text-slate-800 flex items-center gap-1.5 whitespace-nowrap">
                    <i class="fa-solid fa-mosque"></i> 2. Program Kegiatan Sekolah
                </button>
                <button type="button" onclick="switchEditorTab('tab-prestasi')" id="tabBtn-prestasi" class="tab-btn px-3.5 py-2 text-xs font-semibold border-b-2 border-transparent text-slate-500 hover:text-slate-800 flex items-center gap-1.5 whitespace-nowrap">
                    <i class="fa-solid fa-trophy"></i> 3. Jenis Prestasi
                </button>
                <button type="button" onclick="switchEditorTab('tab-pengesahan')" id="tabBtn-pengesahan" class="tab-btn px-3.5 py-2 text-xs font-semibold border-b-2 border-transparent text-slate-500 hover:text-slate-800 flex items-center gap-1.5 whitespace-nowrap">
                    <i class="fa-solid fa-file-signature"></i> 4. Pengesahan & Tanggal
                </button>
            </nav>
        </div>

        <!-- Konten Tab 1: Catatan Wali Kelas -->
        <div id="tabContent-catatan" class="tab-content py-4">
            <div class="flex flex-col lg:flex-row gap-5">
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-pen-fancy text-emerald-600"></i> Isi Catatan Wali Kelas
                        </label>
                        <span class="text-[11px] text-slate-400">Dapat diedit bebas per siswa</span>
                    </div>
                    <textarea id="inputCatatanWalas" rows="4" oninput="handleCatatanInput(this.value)"
                              class="w-full px-3.5 py-2.5 text-sm bg-slate-50/70 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:border-emerald-500 focus:bg-white transition-all leading-relaxed"
                              placeholder="Tuliskan catatan wali kelas untuk ananda..."></textarea>
                    
                    <!-- Quick Template Pills -->
                    <div class="mt-3">
                        <span class="text-[11px] font-bold text-slate-500 block mb-1.5">⚡ Pilih Template Cepat:</span>
                        <div class="flex flex-wrap gap-1.5">
                            <button type="button" onclick="applyCatatanTemplate(1)" class="px-2.5 py-1 text-[11px] font-medium bg-emerald-50 text-emerald-700 hover:bg-emerald-100 rounded-lg border border-emerald-200 transition-colors">
                                🌟 Standar Dokumen (Zaky)
                            </button>
                            <button type="button" onclick="applyCatatanTemplate(2)" class="px-2.5 py-1 text-[11px] font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg border border-blue-200 transition-colors">
                                💎 Prestasi Sangat Baik (Mumtaz)
                            </button>
                            <button type="button" onclick="applyCatatanTemplate(3)" class="px-2.5 py-1 text-[11px] font-medium bg-amber-50 text-amber-700 hover:bg-amber-100 rounded-lg border border-amber-200 transition-colors">
                                📘 Baik & Berkembang (Jayyid)
                            </button>
                            <button type="button" onclick="applyCatatanTemplate(4)" class="px-2.5 py-1 text-[11px] font-medium bg-rose-50 text-rose-700 hover:bg-rose-100 rounded-lg border border-rose-200 transition-colors">
                                💡 Motivasi Peningkatan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Info Box Ringkasan -->
                <div class="w-full lg:w-72 bg-slate-50 rounded-xl p-4 border border-slate-200 flex flex-col justify-between">
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-600 mb-3 pb-2 border-b border-slate-200">Ringkasan Akademik</h4>
                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Jumlah Nilai:</span>
                                <span class="font-bold text-slate-800"><?php echo e(number_format($total_nilai_akhir ?? 0, 0)); ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Rata-rata:</span>
                                <span class="font-extrabold text-emerald-700 text-sm"><?php echo e(number_format($rata_rata_rapor ?? 0, 0)); ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Total Mapel:</span>
                                <span class="font-bold text-slate-800"><?php echo e(count($rekap_nilai)); ?> Mapel</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Ketidakhadiran:</span>
                                <span class="font-bold text-slate-800"><?php echo e(($rekap_absensi['sakit'] ?? 0) + ($rekap_absensi['izin'] ?? 0) + ($rekap_absensi['alpa'] ?? 0)); ?> Hari</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200 text-[11px] text-slate-500 flex items-center gap-1.5">
                        <i class="fa-solid fa-watermark text-slate-400"></i>
                        <span>Watermark: <strong class="text-slate-700 uppercase"><?php echo e($raporMeta['jenjang'] === 'tk' ? 'Kosong (Tanpa Logo)' : 'Logo ' . $raporMeta['jenjang']); ?></strong></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Tab 2: Program Kegiatan Sekolah -->
        <div id="tabContent-kegiatan" class="tab-content hidden py-4">
            <div class="mb-3 flex items-center justify-between">
                <div>
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Kelola 4 Program Kegiatan Sekolah</h4>
                    <p class="text-xs text-slate-500">Ubah predikat untuk mengganti keterangan otomatis, atau edit kalimat secara langsung per santri.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="kegiatanEditorList">
                <!-- Di-render dinamis oleh JavaScript -->
            </div>
        </div>

        <!-- Konten Tab 3: Jenis Prestasi -->
        <div id="tabContent-prestasi" class="tab-content hidden py-4">
            <div class="mb-3 flex items-center justify-between">
                <div>
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Kelola Prestasi Santri</h4>
                    <p class="text-xs text-slate-500">Tambahkan capaian hafalan Al-Qur'an, lomba, atau prestasi lainnya.</p>
                </div>
                <button type="button" onclick="addPrestasiRow()" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold flex items-center gap-1.5 transition-colors">
                    <i class="fa-solid fa-plus text-[10px]"></i> Tambah Baris
                </button>
            </div>

            <div class="space-y-2.5" id="prestasiEditorList">
                <!-- Di-render dinamis oleh JavaScript -->
            </div>

            <div class="mt-3">
                <span class="text-[11px] font-semibold text-slate-500 block mb-1.5">⚡ Template Prestasi Resmi (Dikelola Admin):</span>
                <div class="flex flex-wrap gap-1.5">
                    <?php if(isset($raporMeta['daftar_preset_prestasi']) && count($raporMeta['daftar_preset_prestasi']) > 0): ?>
                        <?php $__currentLoopData = $raporMeta['daftar_preset_prestasi']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" 
                                    data-preset="<?php echo e($preset); ?>" 
                                    onclick="addPrestasiPreset(this.getAttribute('data-preset'))" 
                                    class="px-2.5 py-1 text-[11px] font-medium bg-amber-50 hover:bg-amber-100 text-amber-800 rounded-lg border border-amber-200 transition-colors flex items-center gap-1 cursor-pointer">
                                <i class="fa-solid fa-plus text-[9px] text-amber-600"></i> <?php echo e($preset); ?>

                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <button type="button" 
                                data-preset="Tasmi hafalan juz 30 & 29 sekali duduk" 
                                onclick="addPrestasiPreset(this.getAttribute('data-preset'))" 
                                class="px-2.5 py-1 text-[11px] font-medium bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg border border-slate-200 flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-plus text-[9px]"></i> Tasmi hafalan juz 30 & 29 sekali duduk
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Konten Tab 4: Pengesahan & Tanggal -->
        <div id="tabContent-pengesahan" class="tab-content hidden py-4">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Titimangsa (Tempat & Tanggal)
                    </label>
                    <input type="text" id="inputTanggalRapor" oninput="handleTanggalInput(this.value)"
                           value="<?php echo e($raporMeta['tanggal_rapor']); ?>"
                           class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-300 rounded-lg text-slate-800 focus:outline-none focus:border-emerald-500 focus:bg-white">
                    <span class="text-[10px] text-slate-400 mt-1 block">Contoh: Sigi, 20 Desember 2025</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Kepala Sekolah
                    </label>
                    <input type="text" id="inputNamaKepsek" oninput="handleKepsekInput(this.value)"
                           value="<?php echo e($raporMeta['nama_kepsek']); ?>"
                           class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-300 rounded-lg text-slate-800 focus:outline-none focus:border-emerald-500 focus:bg-white">
                    <span class="text-[10px] text-slate-400 mt-1 block">Pejabat Kepala Sekolah pengesah</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Wali Kelas
                    </label>
                    <input type="text" id="inputNamaWalas" oninput="handleWalasInput(this.value)"
                           value="<?php echo e($wallas->guru->nama ?? 'Wali Kelas'); ?>"
                           class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-300 rounded-lg text-slate-800 focus:outline-none focus:border-emerald-500 focus:bg-white">
                    <span class="text-[10px] text-slate-400 mt-1 block">Nama wali kelas pengampu</span>
                </div>
            </div>

            <!-- Bagian Upload Tanda Tangan Digital Resmi (Otomatis Transparan) -->
            <div class="mt-6 pt-5 border-t border-slate-200">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-signature text-emerald-600"></i> Upload Tanda Tangan Digital
                        </h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Unggah foto/scan tanda tangan. Latar belakang kertas otomatis dihapus transparan seketika.</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 w-fit">
                        <i class="fa-solid fa-wand-magic-sparkles text-amber-500 text-[10px]"></i> Auto-Hapus Background Aktif
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Kartu TTD Wali Kelas -->
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-xs font-bold text-slate-700">Tanda Tangan Wali Kelas</label>
                                <span id="statusTtdWalas" class="text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-200 text-slate-600">Belum diunggah</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mb-2.5 truncate">Wali Kelas: <strong class="text-slate-700"><?php echo e($wallas->guru->nama ?? 'Wali Kelas'); ?></strong></p>

                            <!-- Pratinjau TTD Walas -->
                            <div id="boxPreviewTtdWalas" class="h-24 rounded-lg border-2 border-dashed border-slate-300 bg-white flex items-center justify-center relative overflow-hidden mb-3">
                                <img id="thumbTtdWalas" src="" alt="TTD Walas" class="max-h-20 max-w-full object-contain hidden" style="mix-blend-mode: multiply;" />
                                <div id="placeholderTtdWalas" class="text-center text-slate-400">
                                    <i class="fa-solid fa-file-signature text-2xl mb-1 text-slate-300 block"></i>
                                    <span class="text-[11px]">Belum ada tanda tangan</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="file" id="fileTtdWalas" accept="image/*" class="hidden" onchange="handleSignatureUpload(this, 'walas')">
                            <button type="button" onclick="document.getElementById('fileTtdWalas').click()" class="flex-1 px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold flex items-center justify-center gap-1.5 transition-colors cursor-pointer shadow-xs">
                                <i class="fa-solid fa-arrow-up-from-bracket text-[11px]"></i> Upload TTD Walas
                            </button>
                            <button type="button" id="btnHapusTtdWalas" onclick="removeSignature('walas')" class="px-3 py-2 bg-slate-200 hover:bg-rose-100 hover:text-rose-700 text-slate-600 rounded-lg text-xs font-semibold transition-colors hidden cursor-pointer" title="Hapus tanda tangan">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Kartu TTD Kepala Sekolah -->
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-xs font-bold text-slate-700">Tanda Tangan Kepala Sekolah</label>
                                <span id="statusTtdKepsek" class="text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-200 text-slate-600">Belum diunggah</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mb-2.5 truncate">Kepala Sekolah: <strong class="text-slate-700"><?php echo e($raporMeta['nama_kepsek']); ?></strong></p>

                            <!-- Pratinjau TTD Kepsek -->
                            <div id="boxPreviewTtdKepsek" class="h-24 rounded-lg border-2 border-dashed border-slate-300 bg-white flex items-center justify-center relative overflow-hidden mb-3">
                                <img id="thumbTtdKepsek" src="" alt="TTD Kepsek" class="max-h-20 max-w-full object-contain hidden" style="mix-blend-mode: multiply;" />
                                <div id="placeholderTtdKepsek" class="text-center text-slate-400">
                                    <i class="fa-solid fa-file-signature text-2xl mb-1 text-slate-300 block"></i>
                                    <span class="text-[11px]">Belum ada tanda tangan</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="file" id="fileTtdKepsek" accept="image/*" class="hidden" onchange="handleSignatureUpload(this, 'kepsek')">
                            <button type="button" onclick="document.getElementById('fileTtdKepsek').click()" class="flex-1 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold flex items-center justify-center gap-1.5 transition-colors cursor-pointer shadow-xs">
                                <i class="fa-solid fa-arrow-up-from-bracket text-[11px]"></i> Upload TTD Kepsek
                            </button>
                            <button type="button" id="btnHapusTtdKepsek" onclick="removeSignature('kepsek')" class="px-3 py-2 bg-slate-200 hover:bg-rose-100 hover:text-rose-700 text-slate-600 rounded-lg text-xs font-semibold transition-colors hidden cursor-pointer" title="Hapus tanda tangan">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- DOKUMEN RAPOR RESMI (AREA CETAK / PRINT AREA)                -->
    <!-- SESUAI ACUAN FILE WORD (zaky.docx)                           -->
    <!-- ============================================================ -->
    <div class="print-area bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sm:p-12 text-slate-900 relative overflow-hidden">
        
        <!-- WATERMARK LOGO TRANSPARAN DI TENGAH LEMBAR RAPOR -->
        <!-- SD: Logo SD Qu | SMP: Logo SMP Qu | TK: KOSONG TANPA LOGO -->
        <?php if(!empty($raporMeta['watermark_logo'])): ?>
            <div class="watermark-overlay" aria-hidden="true">
                <img src="<?php echo e($raporMeta['watermark_logo']); ?>" alt="Watermark Lembaga" class="watermark-image">
            </div>
        <?php endif; ?>

        <div class="rapor-content-container relative z-10">
            <!-- 1. IDENTITAS SISWA & SEKOLAH (2 KOLOM KOP) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-1.5 text-xs sm:text-sm font-sans mb-6 pb-4 border-b border-slate-300">
                <!-- Kolom Kiri -->
                <div class="space-y-1">
                    <div class="flex">
                        <span class="w-28 sm:w-32 font-bold text-slate-800">Nama Sekolah</span>
                        <span class="mr-2 font-bold">:</span>
                        <span class="font-bold text-slate-900 uppercase"><?php echo e($raporMeta['nama_sekolah']); ?></span>
                    </div>
                    <div class="flex">
                        <span class="w-28 sm:w-32 font-semibold text-slate-700">Nama</span>
                        <span class="mr-2">:</span>
                        <span class="font-bold text-slate-900 uppercase"><?php echo e($siswa->nama); ?></span>
                    </div>
                    <div class="flex">
                        <span class="w-28 sm:w-32 font-semibold text-slate-700">NISN</span>
                        <span class="mr-2">:</span>
                        <span class="font-mono font-medium text-slate-800"><?php echo e($siswa->nis ?? '-'); ?></span>
                    </div>
                    <div class="flex items-start">
                        <span class="w-28 sm:w-32 font-semibold text-slate-700 flex-shrink-0">Alamat</span>
                        <span class="mr-2 flex-shrink-0">:</span>
                        <span class="text-slate-800 leading-tight"><?php echo e($raporMeta['alamat_sekolah']); ?></span>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-1 md:pl-4">
                    <div class="flex">
                        <span class="w-32 sm:w-36 font-semibold text-slate-700">Kelas</span>
                        <span class="mr-2">:</span>
                        <span class="font-bold text-slate-900"><?php echo e($raporMeta['kelas_label']); ?></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 sm:w-36 font-semibold text-slate-700">Fase</span>
                        <span class="mr-2">:</span>
                        <span class="font-bold text-slate-900"><?php echo e($raporMeta['fase']); ?></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 sm:w-36 font-semibold text-slate-700">Semester</span>
                        <span class="mr-2">:</span>
                        <span class="text-slate-900 font-medium"><?php echo e(($tahun_aktif->semester ?? 1) == 1 ? '1 / Ganjil' : '2 / Genap'); ?></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 sm:w-36 font-semibold text-slate-700">Tahun Pelajaran</span>
                        <span class="mr-2">:</span>
                        <span class="font-semibold text-slate-900"><?php echo e($tahun_aktif->nama ?? '2025/2026'); ?></span>
                    </div>
                </div>
            </div>

            <!-- 2. JUDUL RAPOR -->
            <div class="text-center my-6">
                <h1 class="text-lg sm:text-xl font-extrabold tracking-wider uppercase text-slate-900">LAPORAN HASIL BELAJAR</h1>
            </div>

            <!-- 3. TABEL CAPAIAN KOMPETENSI (NILAI AKADEMIK) -->
            <div class="mb-6 overflow-x-auto">
                <table data-no-paginate="true" class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                    <thead>
                        <tr class="bg-slate-100/90 text-slate-900 font-bold text-center">
                            <th class="border border-slate-800 px-2 py-2.5 w-12">No</th>
                            <th class="border border-slate-800 px-3 py-2.5 text-left w-52 sm:w-60">Mata Pelajaran</th>
                            <th class="border border-slate-800 px-2 py-2.5 w-16">Nilai</th>
                            <th class="border border-slate-800 px-3 py-2.5 text-left">Capaian Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($rekap_nilai) > 0): ?>
                            <?php $__currentLoopData = $rekap_nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mapel => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $adaNilai = !empty($data['ada_nilai']);
                                    $na = $data['nilai_akhir'];
                                    $kkm = $data['kkm'] ?? 75;
                                ?>
                                <tr>
                                    <td class="border border-slate-800 px-2 py-2.5 text-center font-medium align-top"><?php echo e($loop->iteration); ?></td>
                                    <td class="border border-slate-800 px-3 py-2.5 font-semibold text-slate-900 align-top"><?php echo e($mapel); ?></td>
                                    <td class="border border-slate-800 px-2 py-2.5 text-center font-bold text-slate-900 align-top">
                                        <?php echo e($adaNilai ? number_format($na, 0) : '-'); ?>

                                    </td>
                                    <td class="border border-slate-800 px-3 py-2 text-xs sm:text-xs text-slate-800 leading-relaxed text-justify align-top">
                                        <?php echo e($data['deskripsi']); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <!-- Baris Jumlah & Rata-rata Sesuai Dokumen Word -->
                            <tr class="font-bold bg-slate-50/60">
                                <td colspan="2" class="border border-slate-800 px-4 py-2 text-left font-bold">Jumlah</td>
                                <td class="border border-slate-800 px-2 py-2 text-center font-extrabold"><?php echo e(number_format($total_nilai_akhir ?? 0, 0)); ?></td>
                                <td class="border border-slate-800 px-3 py-2 bg-slate-50/30"></td>
                            </tr>
                            <tr class="font-bold bg-slate-50/60">
                                <td colspan="2" class="border border-slate-800 px-4 py-2 text-left font-bold">Rata-rata</td>
                                <td class="border border-slate-800 px-2 py-2 text-center font-extrabold"><?php echo e(number_format($rata_rata_rapor ?? 0, 0)); ?></td>
                                <td class="border border-slate-800 px-3 py-2 bg-slate-50/30"></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="border border-slate-800 px-4 py-6 text-center text-slate-500 italic">
                                    Belum ada data mata pelajaran atau nilai yang tercatat untuk siswa ini.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- 4. TABEL PROGRAM KEGIATAN SEKOLAH (SESUAI DOKUMEN WORD) -->
            <div class="mb-6 overflow-x-auto">
                <table data-no-paginate="true" class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                    <thead>
                        <tr class="bg-slate-100/90 text-slate-900 font-bold text-center">
                            <th class="border border-slate-800 px-2 py-2.5 w-12">No</th>
                            <th class="border border-slate-800 px-3 py-2.5 text-left w-52 sm:w-60">Program Kegiatan Sekolah</th>
                            <th class="border border-slate-800 px-3 py-2.5 text-left">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="previewKegiatanTableBody">
                        <!-- Diisi via JavaScript / Default -->
                        <?php $__currentLoopData = $raporMeta['kegiatan_sekolah_default']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="border border-slate-800 px-2 py-2.5 text-center font-medium align-top"><?php echo e($loop->iteration); ?></td>
                                <td class="border border-slate-800 px-3 py-2.5 font-semibold text-slate-900 align-top"><?php echo e($keg['kegiatan']); ?></td>
                                <td class="border border-slate-800 px-3 py-2 text-xs sm:text-xs text-slate-800 leading-relaxed align-top"><?php echo e($keg['keterangan']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- 5. TABEL JENIS PRESTASI (SESUAI DOKUMEN WORD) -->
            <div class="mb-6 overflow-x-auto">
                <table data-no-paginate="true" class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                    <thead>
                        <tr class="bg-slate-100/90 text-slate-900 font-bold text-center">
                            <th class="border border-slate-800 px-2 py-2.5 w-12">No</th>
                            <th class="border border-slate-800 px-3 py-2.5 text-left">Jenis Prestasi</th>
                        </tr>
                    </thead>
                    <tbody id="previewPrestasiTableBody">
                        <!-- Diisi via JavaScript / Default -->
                        <?php $__empty_1 = true; $__currentLoopData = $raporMeta['prestasi_default']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="border border-slate-800 px-2 py-2.5 text-center font-medium align-top"><?php echo e($loop->iteration); ?></td>
                                <td class="border border-slate-800 px-3 py-2.5 text-slate-900 font-medium align-top"><?php echo e($pres); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td class="border border-slate-800 px-2 py-2 text-center">-</td>
                                <td class="border border-slate-800 px-3 py-2 text-slate-500 italic">Tidak ada catatan prestasi khusus semester ini.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- 6. TABEL KETIDAKHADIRAN (SESUAI DOKUMEN WORD) -->
            <div class="mb-6 overflow-x-auto w-full sm:w-80">
                <table data-no-paginate="true" class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                    <tbody>
                        <tr>
                            <td class="border border-slate-800 px-3.5 py-1.5 font-medium w-48">Sakit</td>
                            <td class="border border-slate-800 px-3.5 py-1.5 text-center font-bold"><?php echo e($rekap_absensi['sakit'] ?? 0); ?></td>
                        </tr>
                        <tr>
                            <td class="border border-slate-800 px-3.5 py-1.5 font-medium">Izin</td>
                            <td class="border border-slate-800 px-3.5 py-1.5 text-center font-bold"><?php echo e($rekap_absensi['izin'] ?? 0); ?></td>
                        </tr>
                        <tr>
                            <td class="border border-slate-800 px-3.5 py-1.5 font-medium">Tanpa Keterangan</td>
                            <td class="border border-slate-800 px-3.5 py-1.5 text-center font-bold"><?php echo e($rekap_absensi['alpa'] ?? 0); ?></td>
                        </tr>
                        <tr class="bg-slate-100/70 font-bold">
                            <td class="border border-slate-800 px-3.5 py-1.5">Jumlah</td>
                            <td class="border border-slate-800 px-3.5 py-1.5 text-center font-extrabold">
                                <?php echo e(($rekap_absensi['sakit'] ?? 0) + ($rekap_absensi['izin'] ?? 0) + ($rekap_absensi['alpa'] ?? 0)); ?>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- 7. KOTAK CATATAN WALI KELAS (SESUAI DOKUMEN WORD) -->
            <div class="mb-8">
                <div class="border border-slate-800 p-0 overflow-hidden">
                    <div class="bg-slate-100/90 px-3.5 py-2 border-b border-slate-800 font-bold text-xs sm:text-sm text-slate-900">
                        Catatan Wali Kelas
                    </div>
                    <div id="previewCatatanWalas" class="p-4 text-xs sm:text-sm text-slate-800 leading-relaxed whitespace-pre-line min-h-[90px]">
<?php echo e($raporMeta['catatan_walas_default']); ?>

                    </div>
                </div>
            </div>

            <!-- 8. TANDA TANGAN PENGESAHAN 3 KOLOM (SESUAI DOKUMEN WORD) -->
            <div class="grid grid-cols-3 gap-4 pt-4 text-xs sm:text-sm text-center">
                <!-- Kolom 1: Orang Tua / Wali -->
                <div class="flex flex-col justify-between h-44">
                    <div>
                        <p class="font-medium text-slate-800 leading-tight">Mengetahui</p>
                        <p class="font-medium text-slate-800 leading-tight">Orang Tua/Wali,</p>
                    </div>
                    <div class="h-20 flex items-center justify-center my-0.5 relative">
                        <!-- Ruang kosong tanda tangan basah pulpen orang tua -->
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 tracking-wider">....................................................</p>
                    </div>
                </div>

                <!-- Kolom 2: Wali Kelas -->
                <div class="flex flex-col justify-between h-44">
                    <div>
                        <p class="font-medium text-slate-800 leading-tight">&nbsp;</p>
                        <p class="font-medium text-slate-800 leading-tight">Wali Kelas <?php echo e($raporMeta['kelas_label']); ?>,</p>
                    </div>
                    <div class="h-20 flex items-center justify-center my-0.5 relative">
                        <img id="previewTtdWalas" src="" alt="Tanda Tangan Wali Kelas" class="max-h-20 max-w-[150px] object-contain hidden" style="mix-blend-mode: multiply;" />
                    </div>
                    <div>
                        <p id="previewWalasNama" class="font-bold underline text-slate-900">
                            <?php echo e($wallas->guru->nama ?? '....................................................'); ?>

                        </p>
                        <?php if(!empty($wallas->guru->nig)): ?>
                            <p class="text-[11px] text-slate-600 mt-0.5">NIG. <?php echo e($wallas->guru->nig); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Kolom 3: Kepala Sekolah -->
                <div class="flex flex-col justify-between h-44">
                    <div>
                        <p id="previewTanggalRapor" class="font-medium text-slate-800 leading-tight">
                            Sigi, <?php echo e($raporMeta['tanggal_rapor']); ?>

                        </p>
                        <p class="font-medium text-slate-800 leading-tight">Kepala Sekolah,</p>
                    </div>
                    <div class="h-20 flex items-center justify-center my-0.5 relative">
                        <img id="previewTtdKepsek" src="" alt="Tanda Tangan Kepala Sekolah" class="max-h-20 max-w-[150px] object-contain hidden" style="mix-blend-mode: multiply;" />
                    </div>
                    <div>
                        <p id="previewKepsekNama" class="font-bold underline text-slate-900">
                            <?php echo e($raporMeta['nama_kepsek']); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- JAVASCRIPT KUSTOMISASI LIVE & AUTO-SAVE (LOCALSTORAGE)        -->
    <!-- ============================================================ -->
    <script>
        const SISWA_ID = <?php echo e($siswa->id); ?>;
        const SISWA_NAMA = <?php echo json_encode($siswa->nama, 15, 512) ?>;
        const STORAGE_KEY = 'siakad_rapor_custom_' + SISWA_ID;

        // Template Standar Baku
        const DEFAULT_STATE = {
            catatan: <?php echo json_encode($raporMeta['catatan_walas_default'], 15, 512) ?>,
            tanggal: <?php echo json_encode($raporMeta['tanggal_rapor'], 15, 512) ?>,
            kepsek: <?php echo json_encode($raporMeta['nama_kepsek'], 15, 512) ?>,
            walas: <?php echo json_encode($wallas->guru->nama ?? 'Wali Kelas', 15, 512) ?>,
            kegiatan: <?php echo json_encode($raporMeta['kegiatan_sekolah_default'], 15, 512) ?>,
            prestasi: <?php echo json_encode($raporMeta['prestasi_default'], 15, 512) ?>,
            ttd_walas: <?php echo json_encode($raporMeta['ttd_walas'] ?? null, 15, 512) ?>,
            ttd_kepsek: <?php echo json_encode($raporMeta['ttd_kepsek'] ?? null, 15, 512) ?>
        };

        // Bank Template Keterangan Kegiatan Berdasarkan Predikat
        const TEMPLATE_KEGIATAN = {
            'Mabit': {
                'Sangat baik': 'Sangat baik, Mengikuti kegiatan Mabit dengan antusias dan melaksanakan ibadah secara mandiri dan berjamaah dengan disiplin',
                'Baik': 'Baik, Mengikuti kegiatan Mabit dengan tertib dan melaksanakan ibadah berjamaah dengan baik',
                'Cukup baik': 'Cukup baik, Perlu peningkatan kedisiplinan bangun qiyamul lail saat pelaksanaan mabit',
                'Perlu bimbingan': 'Perlu bimbingan dan dorongan dalam mengikuti rangkaian kegiatan ibadah malam mabit'
            },
            'Dzikir Pagi': {
                'Sangat baik': 'Sangat baik, Berpartisipasi aktif dalam kegiatan dzikir pagi serta menjaga adab selama kegiatan berlangsung',
                'Baik': 'Baik, Mengikuti dzikir pagi dengan khusyuk dan tertib',
                'Cukup baik': 'Cukup baik, Perlu pembiasaan merutinkan hafalan doa dzikir pagi',
                'Perlu bimbingan': 'Perlu perhatian khusus agar lebih fokus dan menjaga adab saat dzikir pagi'
            },
            'Ilqai Kalimat': {
                'Sangat baik': 'Sangat baik, Menunjukkan rasa percaya diri tinggi dan kelancaran berbicara di depan umum melalui kegiatan ini',
                'Baik': 'Baik, Menunjukkan kemampuan berbicara di depan umum melalui kegiatan ini dengan baik',
                'Cukup baik': 'Cukup baik, Masih perlu melatih keberanian dan intonasi saat tampil di depan audiens',
                'Perlu bimbingan': 'Perlu bimbingan dalam menyusun teks kultum dan melatih keberanian tampil'
            },
            'Puasa Sunnah Kamis': {
                'Sangat baik': 'Sangat baik, Istiqomah menjalankan puasa sunnah hari Kamis dengan penuh keikhlasan',
                'Baik': 'Baik, Mampu melaksanakan puasa sunnah Kamis dengan tertib',
                'Cukup baik': 'Cukup baik, Perlu peningkatan kebiasaan puasa Sunnah kamis secara rutin',
                'Perlu bimbingan': 'Perlu motivasi keluarga dan pembiasaan bertahap untuk puasa sunnah Kamis'
            }
        };

        // State Aktif
        let state = JSON.parse(JSON.stringify(DEFAULT_STATE));

        // Load dari localStorage saat pertama dibuka
        function loadCustomState() {
            try {
                const saved = localStorage.getItem(STORAGE_KEY);
                if (saved) {
                    const parsed = JSON.parse(saved);
                    // Selalu sinkronkan kegiatan dari DEFAULT_STATE agar kegiatan baru dari Admin otomatis muncul
                    if (parsed.kegiatan && Array.isArray(parsed.kegiatan)) {
                        const savedMap = {};
                        parsed.kegiatan.forEach(k => { if (k && k.kegiatan) savedMap[k.kegiatan] = k; });
                        const mergedKegiatan = DEFAULT_STATE.kegiatan.map(defKeg => {
                            return savedMap[defKeg.kegiatan] ? savedMap[defKeg.kegiatan] : defKeg;
                        });
                        parsed.kegiatan.forEach(k => {
                            if (k && k.kegiatan && !DEFAULT_STATE.kegiatan.some(d => d.kegiatan === k.kegiatan)) {
                                mergedKegiatan.push(k);
                            }
                        });
                        parsed.kegiatan = mergedKegiatan;
                    }
                    state = { ...DEFAULT_STATE, ...parsed };
                    // Prioritaskan selalu data riil dari MySQL jika sudah disimpan oleh Wali Kelas
                    if (<?php echo json_encode(!empty($raporMeta['has_evaluasi_db']), 15, 512) ?>) {
                        state.catatan = DEFAULT_STATE.catatan;
                    }
                    if (<?php echo json_encode(!empty($raporMeta['has_prestasi_db']), 15, 512) ?>) {
                        state.prestasi = DEFAULT_STATE.prestasi;
                    }
                }

                // Fallback TTD bersama satu kelas/sekolah jika belum di-set khusus
                if (!state.ttd_walas) {
                    try {
                        const sharedWalas = localStorage.getItem('siakad_shared_ttd_walas_<?php echo e($wallas->kelas_id ?? "0"); ?>');
                        if (sharedWalas) state.ttd_walas = sharedWalas;
                    } catch(e){}
                }
                if (!state.ttd_kepsek) {
                    try {
                        const sharedKepsek = localStorage.getItem('siakad_shared_ttd_kepsek');
                        if (sharedKepsek) state.ttd_kepsek = sharedKepsek;
                    } catch(e){}
                }
            } catch (e) {
                console.error('Error loading state:', e);
            }
            populateEditorFields();
            renderLivePreview();
        }

        // Simpan ke localStorage & Debounced Auto-Sync ke MySQL Database
        let dbSyncTimer = null;
        function saveState(immediateSync = false) {
            try {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
            } catch (e) {
                console.error('Error saving state:', e);
            }
            renderLivePreview();

            // Auto-sync ke database MySQL
            clearTimeout(dbSyncTimer);
            if (immediateSync) {
                syncToDatabase(false);
            } else {
                dbSyncTimer = setTimeout(() => {
                    syncToDatabase(false);
                }, 800);
            }
        }

        async function syncToDatabase(isManualClick = false) {
            const btn = document.getElementById('btnManualSaveDb');
            if (btn && isManualClick) {
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-[11px]"></i> Menyimpan...';
            }

            try {
                const response = await fetch('/sk/simpan-evaluasi-rapor', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        siswa_id: SISWA_ID,
                        catatan_walas: state.catatan,
                        kegiatan: state.kegiatan,
                        prestasi: state.prestasi,
                        tanggal_rapor: state.tanggal,
                        nama_kepsek: state.kepsek,
                        nama_walas: state.walas,
                        ttd_walas: state.ttd_walas,
                        ttd_kepsek: state.ttd_kepsek,
                        tahun_ajaran_id: <?php echo e($tahun_aktif->id ?? 'null'); ?>,
                        semester: <?php echo e(($tahun_aktif->semester ?? 1) == 2 ? 2 : 1); ?>

                    })
                });

                if (response.ok) {
                    if (btn && isManualClick) {
                        btn.innerHTML = '<i class="fa-solid fa-check text-[11px]"></i> Tersimpan!';
                        setTimeout(() => {
                            btn.disabled = false;
                            btn.innerHTML = '<i class="fa-solid fa-floppy-disk text-[11px]"></i> Simpan Rapor';
                        }, 1500);
                    }
                } else {
                    if (btn && isManualClick) {
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fa-solid fa-triangle-exclamation text-[11px]"></i> Coba Lagi';
                    }
                }
            } catch (err) {
                console.warn('Sync DB network fallback:', err);
                if (btn && isManualClick) {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-triangle-exclamation text-[11px]"></i> Coba Lagi';
                }
            }
        }

        // Tab Switcher
        function switchEditorTab(tabId) {
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'border-emerald-600', 'text-emerald-700');
                btn.classList.add('border-transparent', 'text-slate-500');
            });
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            const activeBtn = document.getElementById('tabBtn-' + tabId.replace('tab-', ''));
            if (activeBtn) {
                activeBtn.classList.add('active', 'border-emerald-600', 'text-emerald-700');
                activeBtn.classList.remove('border-transparent', 'text-slate-500');
            }

            const activeContent = document.getElementById('tabContent-' + tabId.replace('tab-', ''));
            if (activeContent) {
                activeContent.classList.remove('hidden');
            }
        }

        // Isi form editor dengan nilai state
        function populateEditorFields() {
            // Tab 1: Catatan
            const inputCatatan = document.getElementById('inputCatatanWalas');
            if (inputCatatan) inputCatatan.value = state.catatan;

            // Tab 4: Pengesahan
            const inputTanggal = document.getElementById('inputTanggalRapor');
            if (inputTanggal) inputTanggal.value = state.tanggal;
            const inputKepsek = document.getElementById('inputNamaKepsek');
            if (inputKepsek) inputKepsek.value = state.kepsek;
            const inputWalas = document.getElementById('inputNamaWalas');
            if (inputWalas) inputWalas.value = state.walas;

            // Tab 2: Kegiatan List
            renderKegiatanEditor();

            // Tab 3: Prestasi List
            renderPrestasiEditor();
        }

        // Render Editor Kegiatan
        function renderKegiatanEditor() {
            const container = document.getElementById('kegiatanEditorList');
            if (!container) return;

            container.innerHTML = state.kegiatan.map((item, index) => {
                return `
                    <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-slate-800">${index + 1}. ${item.kegiatan}</span>
                            <select onchange="handleKegiatanPredikatChange(${index}, this.value)" 
                                    class="text-xs bg-white border border-slate-300 rounded-lg px-2.5 py-1 text-slate-700 font-semibold focus:outline-none focus:border-emerald-500">
                                <option value="Sangat baik" ${item.predikat === 'Sangat baik' ? 'selected' : ''}>Sangat baik</option>
                                <option value="Baik" ${item.predikat === 'Baik' ? 'selected' : ''}>Baik</option>
                                <option value="Cukup baik" ${item.predikat === 'Cukup baik' ? 'selected' : ''}>Cukup baik</option>
                                <option value="Perlu bimbingan" ${item.predikat === 'Perlu bimbingan' ? 'selected' : ''}>Perlu bimbingan</option>
                            </select>
                        </div>
                        <textarea oninput="handleKegiatanTextChange(${index}, this.value)" rows="2"
                                  class="w-full text-xs px-2.5 py-2 bg-white border border-slate-200 rounded-lg text-slate-800 focus:outline-none focus:border-emerald-500">${item.keterangan}</textarea>
                    </div>
                `;
            }).join('');
        }

        // Render Editor Prestasi
        function renderPrestasiEditor() {
            const container = document.getElementById('prestasiEditorList');
            if (!container) return;

            if (state.prestasi.length === 0) {
                container.innerHTML = `
                    <div class="p-3 bg-slate-50 rounded-xl border border-dashed border-slate-300 text-center text-xs text-slate-400">
                        Belum ada prestasi yang dicatat. Klik tombol "+ Tambah Baris" di atas untuk menambahkan.
                    </div>
                `;
                return;
            }

            container.innerHTML = state.prestasi.map((item, index) => {
                return `
                    <div class="flex items-center gap-2">
                        <span class="w-6 text-xs text-center font-bold text-slate-500">${index + 1}.</span>
                        <input type="text" value="${escapeHtml(item)}" oninput="handlePrestasiTextChange(${index}, this.value)"
                               class="flex-1 text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-800 focus:bg-white focus:outline-none focus:border-emerald-500"
                               placeholder="Tuliskan nama prestasi santri...">
                        <button type="button" onclick="removePrestasiRow(${index})" class="w-8 h-8 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 flex items-center justify-center text-xs transition-colors">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                `;
            }).join('');
        }

        // Update DOM Area Cetak Live
        function renderLivePreview() {
            // 1. Catatan Walas
            const boxCatatan = document.getElementById('previewCatatanWalas');
            if (boxCatatan) boxCatatan.textContent = state.catatan;

            // 2. Kegiatan Table
            const bodyKegiatan = document.getElementById('previewKegiatanTableBody');
            if (bodyKegiatan) {
                bodyKegiatan.innerHTML = state.kegiatan.map((item, idx) => `
                    <tr>
                        <td class="border border-slate-800 px-2 py-2.5 text-center font-medium align-top">${idx + 1}</td>
                        <td class="border border-slate-800 px-3 py-2.5 font-semibold text-slate-900 align-top">${escapeHtml(item.kegiatan)}</td>
                        <td class="border border-slate-800 px-3 py-2 text-xs sm:text-xs text-slate-800 leading-relaxed align-top">${escapeHtml(item.keterangan)}</td>
                    </tr>
                `).join('');
            }

            // 3. Prestasi Table
            const bodyPrestasi = document.getElementById('previewPrestasiTableBody');
            if (bodyPrestasi) {
                if (state.prestasi.length === 0) {
                    bodyPrestasi.innerHTML = `
                        <tr>
                            <td class="border border-slate-800 px-2 py-2 text-center">-</td>
                            <td class="border border-slate-800 px-3 py-2 text-slate-500 italic">Tidak ada catatan prestasi khusus semester ini.</td>
                        </tr>
                    `;
                } else {
                    bodyPrestasi.innerHTML = state.prestasi.map((item, idx) => `
                        <tr>
                            <td class="border border-slate-800 px-2 py-2.5 text-center font-medium align-top">${idx + 1}</td>
                            <td class="border border-slate-800 px-3 py-2.5 text-slate-900 font-medium align-top">${escapeHtml(item)}</td>
                        </tr>
                    `).join('');
                }
            }

            // 4. Pengesahan
            const elTanggal = document.getElementById('previewTanggalRapor');
            if (elTanggal) elTanggal.textContent = `Sigi, ${state.tanggal}`;
            const elKepsek = document.getElementById('previewKepsekNama');
            if (elKepsek) elKepsek.textContent = state.kepsek;
            const elWalas = document.getElementById('previewWalasNama');
            if (elWalas) elWalas.textContent = state.walas;

            // Render Gambar TTD Walas di Lembar Rapor
            const imgTtdWalas = document.getElementById('previewTtdWalas');
            if (imgTtdWalas) {
                if (state.ttd_walas) {
                    imgTtdWalas.src = state.ttd_walas;
                    imgTtdWalas.classList.remove('hidden');
                } else {
                    imgTtdWalas.src = '';
                    imgTtdWalas.classList.add('hidden');
                }
            }

            // Render Gambar TTD Kepsek di Lembar Rapor
            const imgTtdKepsek = document.getElementById('previewTtdKepsek');
            if (imgTtdKepsek) {
                if (state.ttd_kepsek) {
                    imgTtdKepsek.src = state.ttd_kepsek;
                    imgTtdKepsek.classList.remove('hidden');
                } else {
                    imgTtdKepsek.src = '';
                    imgTtdKepsek.classList.add('hidden');
                }
            }

            updateSignatureUI();
        }

        // Input Handlers
        function handleCatatanInput(val) {
            state.catatan = val;
            saveState();
        }

        function handleTanggalInput(val) {
            state.tanggal = val;
            saveState();
        }

        function handleKepsekInput(val) {
            state.kepsek = val;
            saveState();
        }

        function handleWalasInput(val) {
            state.walas = val;
            saveState();
        }

        // Update UI Kartu Upload TTD di Tab 4
        function updateSignatureUI() {
            // Walas
            const thumbWalas = document.getElementById('thumbTtdWalas');
            const placeholderWalas = document.getElementById('placeholderTtdWalas');
            const statusWalas = document.getElementById('statusTtdWalas');
            const btnHapusWalas = document.getElementById('btnHapusTtdWalas');

            if (state.ttd_walas) {
                if (thumbWalas) { thumbWalas.src = state.ttd_walas; thumbWalas.classList.remove('hidden'); }
                if (placeholderWalas) placeholderWalas.classList.add('hidden');
                if (statusWalas) {
                    statusWalas.textContent = 'Aktif (Transparan)';
                    statusWalas.className = 'text-[10px] font-semibold px-2 py-0.5 rounded bg-emerald-100 text-emerald-800';
                }
                if (btnHapusWalas) btnHapusWalas.classList.remove('hidden');
            } else {
                if (thumbWalas) { thumbWalas.src = ''; thumbWalas.classList.add('hidden'); }
                if (placeholderWalas) placeholderWalas.classList.remove('hidden');
                if (statusWalas) {
                    statusWalas.textContent = 'Belum diunggah';
                    statusWalas.className = 'text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-200 text-slate-600';
                }
                if (btnHapusWalas) btnHapusWalas.classList.add('hidden');
            }

            // Kepsek
            const thumbKepsek = document.getElementById('thumbTtdKepsek');
            const placeholderKepsek = document.getElementById('placeholderTtdKepsek');
            const statusKepsek = document.getElementById('statusTtdKepsek');
            const btnHapusKepsek = document.getElementById('btnHapusTtdKepsek');

            if (state.ttd_kepsek) {
                if (thumbKepsek) { thumbKepsek.src = state.ttd_kepsek; thumbKepsek.classList.remove('hidden'); }
                if (placeholderKepsek) placeholderKepsek.classList.add('hidden');
                if (statusKepsek) {
                    statusKepsek.textContent = 'Aktif (Transparan)';
                    statusKepsek.className = 'text-[10px] font-semibold px-2 py-0.5 rounded bg-emerald-100 text-emerald-800';
                }
                if (btnHapusKepsek) btnHapusKepsek.classList.remove('hidden');
            } else {
                if (thumbKepsek) { thumbKepsek.src = ''; thumbKepsek.classList.add('hidden'); }
                if (placeholderKepsek) placeholderKepsek.classList.remove('hidden');
                if (statusKepsek) {
                    statusKepsek.textContent = 'Belum diunggah';
                    statusKepsek.className = 'text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-200 text-slate-600';
                }
                if (btnHapusKepsek) btnHapusKepsek.classList.add('hidden');
            }
        }

        // Algoritma Penghapus Background Tanda Tangan Otomatis (HTML5 Canvas Pixel Filter)
        // Kecepatan proses: ~10-30 milidetik (instan) di browser pengguna
        function removeSignatureBackground(file, callback) {
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    let width = img.width;
                    let height = img.height;
                    const maxW = 600;
                    if (width > maxW) {
                        height = Math.round((height * maxW) / width);
                        width = maxW;
                    }

                    const canvas = document.createElement('canvas');
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    const imgData = ctx.getImageData(0, 0, width, height);
                    const d = imgData.data;

                    // Nilai threshold kecerahan (0-255). Kertas putih/terang biasanya > 195
                    const threshold = 205;

                    for (let i = 0; i < d.length; i += 4) {
                        const r = d[i];
                        const g = d[i + 1];
                        const b = d[i + 2];
                        const luminance = 0.299 * r + 0.587 * g + 0.114 * b;

                        if (luminance >= threshold) {
                            // Latar belakang kertas putih/krem diubah menjadi 100% transparan
                            d[i + 3] = 0;
                        } else {
                            // Goresan tinta gelap: buat transparan bertingkat halus (antialiased)
                            const factor = (threshold - luminance) / threshold;
                            d[i + 3] = Math.min(255, Math.max(0, Math.round(factor * 340)));
                        }
                    }

                    ctx.putImageData(imgData, 0, 0);
                    callback(canvas.toDataURL('image/png'));
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        function handleSignatureUpload(inputEl, role) {
            const file = inputEl.files && inputEl.files[0];
            if (!file) return;

            removeSignatureBackground(file, function(pngDataUrl) {
                if (role === 'walas') {
                    state.ttd_walas = pngDataUrl;
                    try { localStorage.setItem('siakad_shared_ttd_walas_<?php echo e($wallas->kelas_id ?? "0"); ?>', pngDataUrl); } catch(e){}
                } else if (role === 'kepsek') {
                    state.ttd_kepsek = pngDataUrl;
                    try { localStorage.setItem('siakad_shared_ttd_kepsek', pngDataUrl); } catch(e){}
                }
                updateSignatureUI();
                saveState();
            });
            inputEl.value = '';
        }

        function removeSignature(role) {
            if (role === 'walas') {
                state.ttd_walas = null;
                try { localStorage.removeItem('siakad_shared_ttd_walas_<?php echo e($wallas->kelas_id ?? "0"); ?>'); } catch(e){}
            } else if (role === 'kepsek') {
                state.ttd_kepsek = null;
                try { localStorage.removeItem('siakad_shared_ttd_kepsek'); } catch(e){}
            }
            updateSignatureUI();
            saveState();
        }

        // Template Catatan Picker
        function applyCatatanTemplate(type) {
            let t = '';
            if (type === 1) {
                t = `Alhamdulillah ${SISWA_NAMA} mulai menunjukkan semangat belajar yang lebih baik dan keberanian untuk bertanya dalam memahami materi. Hasil belajar ananda semakin menunjukkan kemajuan.\n\nHarapan ustadzah, ananda dapat lebih fokus dan konsisten dalam belajar, memanfaatkan waktu dengan efektif, serta melibatkan Allah dalam proses belajar.\n\nBaarakAllahu fiik nak shalih`;
            } else if (type === 2) {
                t = `Alhamdulillah ananda ${SISWA_NAMA} menunjukkan prestasi akademik yang sangat memuaskan, akhlak yang mulia, serta keteladanan yang baik di kelas. Pertahankan kebiasaan muroja'ah hafalan dan terus kembangkan bakat ananda.\n\nSemoga Allah Ta'ala senantiasa memberkahi ilmu dan langkah ananda ke depan.`;
            } else if (type === 3) {
                t = `Alhamdulillah ananda ${SISWA_NAMA} telah mengikuti seluruh rangkaian kegiatan belajar dan ibadah dengan tertib dan tuntas. Diharapkan pada semester berikutnya ananda lebih aktif dalam diskusi dan melatih kemandirian belajar.\n\nJazakallahu khairan atas usaha terbaik ananda.`;
            } else if (type === 4) {
                t = `Ananda ${SISWA_NAMA} memiliki potensi besar untuk terus berkembang. Ustadz/Ustadzah berpesan agar ananda lebih disiplin membagi waktu belajar dan bermain di rumah, meningkatkan konsentrasi saat pelajaran, serta senantiasa berdoa memohon kemudahan kepada Allah.`;
            }

            state.catatan = t;
            const inputCatatan = document.getElementById('inputCatatanWalas');
            if (inputCatatan) inputCatatan.value = t;
            saveState();
        }

        // Kegiatan Handlers
        function handleKegiatanPredikatChange(index, predikat) {
            state.kegiatan[index].predikat = predikat;
            const namaKeg = state.kegiatan[index].kegiatan;
            if (TEMPLATE_KEGIATAN[namaKeg] && TEMPLATE_KEGIATAN[namaKeg][predikat]) {
                state.kegiatan[index].keterangan = TEMPLATE_KEGIATAN[namaKeg][predikat];
            } else {
                state.kegiatan[index].keterangan = `${predikat}, aktif dan berpartisipasi dalam kegiatan ${namaKeg}.`;
            }
            renderKegiatanEditor();
            saveState();
        }

        function handleKegiatanTextChange(index, val) {
            state.kegiatan[index].keterangan = val;
            saveState();
        }

        // Prestasi Handlers
        function addPrestasiRow() {
            if (!Array.isArray(state.prestasi)) {
                state.prestasi = [];
            }
            state.prestasi.push('');
            renderPrestasiEditor();
            saveState();
            setTimeout(() => {
                const inputs = document.querySelectorAll('#prestasiEditorList input');
                if (inputs.length > 0) {
                    inputs[inputs.length - 1].focus();
                }
            }, 50);
        }

        function addPrestasiPreset(text) {
            if (!text || typeof text !== 'string') return;
            const cleanText = text.trim();
            if (!cleanText) return;

            if (!Array.isArray(state.prestasi)) {
                state.prestasi = [];
            }

            // Ganti baris kosong jika ada, jika tidak tambahkan baris baru (hindari duplikasi tepat sama)
            const emptyIdx = state.prestasi.findIndex(p => !p || String(p).trim() === '');
            if (emptyIdx !== -1) {
                state.prestasi[emptyIdx] = cleanText;
            } else if (!state.prestasi.includes(cleanText)) {
                state.prestasi.push(cleanText);
            }

            renderPrestasiEditor();
            saveState();
        }

        function removePrestasiRow(index) {
            state.prestasi.splice(index, 1);
            renderPrestasiEditor();
            saveState();
        }

        function handlePrestasiTextChange(index, val) {
            state.prestasi[index] = val;
            saveState();
        }

        function openModal(id) {
            const el = document.getElementById(id);
            if (el) el.style.display = 'flex';
        }

        function closeModal(id) {
            const el = document.getElementById(id);
            if (el) el.style.display = 'none';
        }

        // Reset
        function resetToDefaultTemplates() {
            openModal('resetTemplateModal');
        }

        function executeResetTemplate() {
            closeModal('resetTemplateModal');
            localStorage.removeItem(STORAGE_KEY);
            state = JSON.parse(JSON.stringify(DEFAULT_STATE));
            populateEditorFields();
            renderLivePreview();
            saveState(true);
        }

        function escapeHtml(text) {
            if (!text) return '';
            return String(text)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // Jalankan saat halaman siap
        document.addEventListener('DOMContentLoaded', loadCustomState);
    </script>

    <!-- ============================================================ -->
    <!-- STYLING WATERMARK & PRINT MEDIA KHUSUS RAPOR                -->
    <!-- ============================================================ -->
    <style>
        /* WATERMARK TRANSPARAN DI TENGAH LEMBAR RAPOR */
        .watermark-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 480px;
            max-width: 85%;
            pointer-events: none;
            user-select: none;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .watermark-image {
            width: 100%;
            height: auto;
            opacity: 0.07;
            filter: contrast(110%) brightness(95%);
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .rapor-content-container {
            position: relative;
            z-index: 2;
        }

        /* MEDIA PRINT UNTUK KERTAS RESMI */
        @media print {
            body * { visibility: hidden; }
            .no-print { display: none !important; }
            .print-area, .print-area * { visibility: visible; }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                border: none !important;
                box-shadow: none !important;
                padding: 10mm 12mm !important;
                margin: 0 !important;
                background: white !important;
                color: #000 !important;
            }

            .watermark-overlay {
                position: absolute !important;
                top: 50% !important;
                left: 50% !important;
                transform: translate(-50%, -50%) !important;
                display: flex !important;
                visibility: visible !important;
            }

            .watermark-image {
                visibility: visible !important;
                opacity: 0.08 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            table {
                border-collapse: collapse !important;
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            th, td {
                border-color: #000 !important;
            }
        }
    </style>
    <!-- Modal Konfirmasi Reset Template -->
    <?php if (isset($component)) { $__componentOriginale960230fd71228156fe70d1ba75c1455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960230fd71228156fe70d1ba75c1455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.modal','data' => ['id' => 'resetTemplateModal','title' => 'Konfirmasi Reset Template','icon' => 'fa-rotate-left','iconColor' => '#d97706','iconBg' => '#fef3c7']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'resetTemplateModal','title' => 'Konfirmasi Reset Template','icon' => 'fa-rotate-left','iconColor' => '#d97706','iconBg' => '#fef3c7']); ?>
        <div class="text-xs sm:text-sm text-slate-600 leading-relaxed space-y-3">
            <p>
                Apakah Anda yakin ingin mengembalikan seluruh <strong>catatan wali kelas, evaluasi kegiatan sekolah, dan prestasi</strong> santri ini ke pengaturan <strong>template standar (default)</strong>?
            </p>
            <div class="p-3 bg-amber-50 rounded-xl border border-amber-200 text-xs text-amber-800 flex items-start gap-2.5">
                <i class="fa-solid fa-triangle-exclamation text-amber-600 mt-0.5 text-sm flex-shrink-0"></i>
                <span>Teks catatan atau narasi khusus yang sudah Anda modifikasi secara individu akan digantikan kembali sesuai kalimat panduan awal dari Admin/Yayasan.</span>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
            <button type="button" onclick="closeModal('resetTemplateModal')" style="padding: 9px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px;">
                Batal
            </button>
            <button type="button" onclick="executeResetTemplate()" style="padding: 9px 18px; border: none; background: #d97706; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-rotate-left"></i> Ya, Reset ke Default
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/guru/detailRaporWalas.blade.php ENDPATH**/ ?>