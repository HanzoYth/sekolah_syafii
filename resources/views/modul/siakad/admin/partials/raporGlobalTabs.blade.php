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
<div id="adminRaporGlobalBanner" class="hidden bg-gradient-to-r from-blue-950 via-slate-900 to-slate-800 text-white rounded-2xl p-5 mb-6 shadow-sm border border-slate-700 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div class="flex items-start gap-3">
        <div class="w-10 h-10 rounded-xl bg-blue-500/20 border border-blue-400/30 text-blue-300 flex items-center justify-center flex-shrink-0 text-lg">
            <i class="fa-solid fa-globe"></i>
        </div>
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2 py-0.5 rounded bg-blue-500/20 text-blue-300 text-[10px] font-bold uppercase tracking-wider border border-blue-400/30">Pengaturan Global Sekolah</span>
                <span class="text-xs text-slate-300 font-medium">Berlaku Semua Kelas &amp; Jenjang</span>
            </div>
            <h4 class="text-base font-bold text-white">Konfigurasi Standar Rapor Yayasan / Sekolah</h4>
            <p class="text-xs text-slate-300 mt-0.5">Perubahan pada tab global ini otomatis berlaku untuk seluruh kelas, Wali Kelas, dan Siswa di semua jenjang.</p>
        </div>
    </div>

    <button type="button" onclick="switchAdminRaporTab('kelas')" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white border border-white/20 text-xs font-bold transition-colors flex items-center gap-2 whitespace-nowrap self-start md:self-center cursor-pointer">
        <i class="fa-solid fa-arrow-left text-[11px]"></i> Kembali ke Mode Per Kelas
    </button>
</div>

<!-- ======================================================== -->
<!-- TAB GLOBAL 1: PENGESAHAN, TANGGAL & TTD KEPSEK           -->
<!-- ======================================================== -->
<div id="adminRaporPane-pengesahan" class="admin-rapor-pane hidden">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-file-signature"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Pengaturan Pengesahan &amp; Tanggal Pembagian Rapor</h3>
                    <p class="text-xs text-slate-500">Konfigurasi resmi titimangsa, tanggal cetak rapor, dan Kepala Sekolah yang berlaku global untuk seluruh lembar rapor siswa.</p>
                </div>
            </div>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200 w-fit">
                <i class="fa-solid fa-globe text-[10px]"></i> Global Semua Kelas
            </span>
        </div>

        <form id="formPengaturanRapor" action="/sk/simpan-pengaturan-rapor" method="POST" class="p-6">
            @csrf
            <div class="p-4 mb-6 rounded-xl bg-blue-50/70 border border-blue-200 text-xs text-blue-900 flex items-start gap-3">
                <i class="fa-solid fa-circle-info text-blue-600 text-base mt-0.5 flex-shrink-0"></i>
                <div>
                    <strong>Sinkronisasi Otomatis ke Wali Kelas &amp; Siswa:</strong>
                    <p class="mt-0.5 text-blue-800">Nilai tanggal pembagian rapor, nama kepala sekolah, dan tanda tangan Kepala Sekolah di bawah ini otomatis menjadi standar baku pada lembar rapor semua siswa. Bila diperbarui di sini, rapor di akun walas dan siswa langsung mengikuti pengaturan ini.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal Pembagian Rapor</label>
                    <input type="text" name="tanggal_rapor" value="{{ old('tanggal_rapor', $pengaturan_rapor->tanggal_rapor ?? '20 Desember 2025') }}" class="ref-input font-medium" placeholder="Contoh: 20 Desember 2025" required>
                    <span class="text-[11px] text-slate-400 mt-1 block">Format teks yang akan tercetak di bagian titi mangsa rapor (misal: Tinggede, 20 Desember 2025).</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tempat / Kota Penerbitan</label>
                    <input type="text" name="tempat_rapor" value="{{ old('tempat_rapor', $pengaturan_rapor->tempat_rapor ?? 'Tinggede') }}" class="ref-input font-medium" placeholder="Contoh: Tinggede" required>
                    <span class="text-[11px] text-slate-400 mt-1 block">Nama daerah / desa / kota lokasi madrasah / sekolah.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Kepala Sekolah &amp; Gelar</label>
                    <input type="text" name="nama_kepsek" value="{{ old('nama_kepsek', $pengaturan_rapor->nama_kepsek ?? 'Rajihul Haq, S.Sos') }}" class="ref-input font-medium font-bold text-slate-800" placeholder="Contoh: Rajihul Haq, S.Sos" required>
                    <span class="text-[11px] text-slate-400 mt-1 block">Nama pejabat kepala sekolah penandatangan dokumen hasil belajar.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIP / Identitas Kepsek</label>
                    <input type="text" name="nip_kepsek" value="{{ old('nip_kepsek', $pengaturan_rapor->nip_kepsek ?? '-') }}" class="ref-input font-medium" placeholder="Kosongkan atau beri tanda - jika tidak ada">
                    <span class="text-[11px] text-slate-400 mt-1 block">Nomor Induk Pegawai kepala sekolah (opsional).</span>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Template Default Catatan Wali Kelas</label>
                    <textarea name="catatan_walas_template" rows="3" class="ref-input font-normal leading-relaxed" placeholder="Tuliskan template pesan wali kelas default...">{{ old('catatan_walas_template', $pengaturan_rapor->catatan_walas_template ?? '') }}</textarea>
                    <span class="text-[11px] text-slate-400 mt-1 block">Gunakan tag <code>{nama}</code> untuk menyisipkan nama siswa secara otomatis. Template ini akan menjadi teks saran awal saat guru membuka lembar rapor.</span>
                </div>
            </div>

            <!-- Bagian Upload Tanda Tangan Kepala Sekolah (Global Otomatis Hapus Background) -->
            <div class="mb-6 pt-5 border-t border-slate-200">
                <input type="hidden" name="ttd_kepsek" id="adminInputTtdKepsek" value="{{ old('ttd_kepsek', $pengaturan_rapor->ttd_kepsek ?? '') }}">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4">
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-signature text-emerald-600"></i> Tanda Tangan Digital Kepala Sekolah
                        </h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Unggah foto atau hasil scan tanda tangan Kepala Sekolah berlatar kertas putih. Background otomatis dihapus transparan seketika di browser.</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 w-fit flex-shrink-0">
                        <i class="fa-solid fa-wand-magic-sparkles text-amber-500 text-[10px]"></i> Auto-Hapus Background Aktif
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Kartu TTD Kepala Sekolah (Global) -->
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-xs font-bold text-slate-700">Tanda Tangan Kepala Sekolah</label>
                                <span id="adminStatusTtdKepsek" class="text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-200 text-slate-600">Belum diunggah</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mb-2.5 truncate">Pejabat: <strong class="text-slate-700">{{ $pengaturan_rapor->nama_kepsek ?? 'Kepala Sekolah' }}</strong> (otomatis berlaku global)</p>

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
                            <button type="button" onclick="document.getElementById('adminFileTtdKepsek').click()" class="flex-1 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold flex items-center justify-center gap-1.5 transition-colors cursor-pointer shadow-xs">
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
                                <i class="fa-solid fa-circle-info text-blue-600"></i> Tata Kelola Tanda Tangan Rapor
                            </h5>
                            <ul class="text-[11px] text-slate-600 space-y-1.5 leading-relaxed">
                                <li><strong>TTD Kepala Sekolah:</strong> Dikelola terpusat oleh Admin di tab ini dan otomatis tampil sebagai pratinjau resmi pada seluruh rapor kelas &amp; siswa.</li>
                                <li><strong>TTD Wali Kelas:</strong> Diunggah per kelas oleh masing-masing Wali Kelas (atau Admin via pemilih kelas) di tab <strong>Cetak &amp; TTD Kelas</strong>.</li>
                            </ul>
                        </div>
                        <div class="mt-3 pt-3 border-t border-slate-200/70">
                            <button type="button" onclick="switchAdminRaporTab('kelas')" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800 transition-colors cursor-pointer">
                                <i class="fa-solid fa-pen-nib text-[11px]"></i> Atur TTD Wali Kelas per Kelas <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all shadow-md flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Pengaturan Rapor
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ======================================================== -->
<!-- TAB GLOBAL 2: MASTER PROGRAM KEGIATAN SEKOLAH (RAPOR)    -->
<!-- ======================================================== -->
<div id="adminRaporPane-kegiatan" class="admin-rapor-pane hidden">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8" id="sectionKegiatanSekolah">
        <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-700 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-mosque"></i>
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h3 class="text-base font-bold text-slate-800">Master Program Kegiatan Sekolah (Rapor)</h3>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-violet-50 text-violet-700 border border-violet-200">Global Sekolah</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">Daftar kegiatan resmi yayasan/sekolah yang wajib dinilai pada dokumen Rapor Siswa (Wali Kelas hanya menilai, kategori dikelola Admin).</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button type="button" onclick="openModal('addKegiatanModal')" style="background: #6d28d9; color: white; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; font-size: 13.5px; transition: background 0.2s;">
                    <i class="fa-solid fa-plus"></i> Tambah Kegiatan
                </button>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <x-siakad.ui.table id="tableKegiatanSekolah">
                    <x-slot name="thead">
                        <tr>
                            <th style="width: 60px; text-align: center;">No.</th>
                            <th style="width: 220px;">Nama Program Kegiatan</th>
                            <th style="width: 140px; text-align: center;">Jenjang Sasaran</th>
                            <th>Keterangan Default / Panduan Nilai</th>
                            <th style="width: 100px; text-align: center;">Status</th>
                            <th style="width: 110px; text-align: center;">Aksi</th>
                        </tr>
                    </x-slot>

                    @if(isset($data_kegiatan) && count($data_kegiatan) > 0)
                        @foreach($data_kegiatan as $idx => $keg)
                            <tr>
                                <td style="text-align: center; font-weight: 600;">{{ $idx + 1 }}</td>
                                <td>
                                    <strong style="color: #1e293b; font-size: 14px;">{{ $keg->nama_kegiatan }}</strong>
                                </td>
                                <td style="text-align: center;">
                                    <span class="badge-jenjang {{ $keg->jenjang === 'sd' ? 'badge-sd' : ($keg->jenjang === 'smp' ? 'badge-smp' : ($keg->jenjang === 'tk' ? 'badge-tk' : ($keg->jenjang === 'sma' ? 'badge-sma' : 'badge-umum'))) }}">
                                        {{ strtoupper($keg->jenjang) }}
                                    </span>
                                </td>
                                <td>
                                    <span style="color: #475569; font-size: 12.5px; line-height: 1.4; display: block;">
                                        {{ $keg->keterangan_default ?? '-' }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    @if($keg->aktif)
                                        <span style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; padding: 3px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="fa-solid fa-check"></i> Aktif
                                        </span>
                                    @else
                                        <span style="background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; padding: 3px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="fa-solid fa-xmark"></i> Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <button type="button" onclick="openEditKegiatan({{ $keg->id }}, '{{ addslashes($keg->nama_kegiatan) }}', '{{ $keg->jenjang }}', '{{ addslashes($keg->keterangan_default) }}', {{ $keg->aktif ? 'true' : 'false' }})" style="background: #e9f2ff; color: #3875c5; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center;" title="Edit Kegiatan">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" onclick="openDeleteKegiatan({{ $keg->id }}, '{{ addslashes($keg->nama_kegiatan) }}')" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center;" title="Hapus Kegiatan">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #64748b;">
                                <i class="fa-solid fa-mosque" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                                Belum ada Master Program Kegiatan Sekolah yang diatur.
                            </td>
                        </tr>
                    @endif
                </x-siakad.ui.table>
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
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h3 class="text-base font-bold text-slate-800">Master Jenis Prestasi (Template Rapor Siswa)</h3>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">Global Sekolah</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">Daftar template capaian prestasi resmi yang otomatis muncul sebagai pilihan cepat bagi Wali Kelas saat mengisi rapor siswa.</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button type="button" onclick="openModal('addPrestasiModal')" style="background: #d97706; color: white; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; font-size: 13.5px; transition: background 0.2s;">
                    <i class="fa-solid fa-plus"></i> Tambah Template Prestasi
                </button>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <x-siakad.ui.table id="tableMasterPrestasi">
                    <x-slot name="thead">
                        <tr>
                            <th style="width: 60px; text-align: center;">No.</th>
                            <th>Nama Capaian / Template Prestasi</th>
                            <th style="width: 160px; text-align: center;">Kategori Bidang</th>
                            <th style="width: 120px; text-align: center;">Jenjang</th>
                            <th style="width: 100px; text-align: center;">Status</th>
                            <th style="width: 110px; text-align: center;">Aksi</th>
                        </tr>
                    </x-slot>

                    @if(isset($data_prestasi) && count($data_prestasi) > 0)
                        @foreach($data_prestasi as $pIdx => $pres)
                            <tr>
                                <td style="text-align: center; font-weight: 600;">{{ $pIdx + 1 }}</td>
                                <td>
                                    <strong style="color: #1e293b; font-size: 14px;">{{ $pres->nama_prestasi }}</strong>
                                </td>
                                <td style="text-align: center;">
                                    <span class="badge-jenjang" style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a;">
                                        {{ $pres->kategori }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <span class="badge-jenjang {{ $pres->jenjang === 'sd' ? 'badge-sd' : ($pres->jenjang === 'smp' ? 'badge-smp' : ($pres->jenjang === 'tk' ? 'badge-tk' : ($pres->jenjang === 'sma' ? 'badge-sma' : 'badge-umum'))) }}">
                                        {{ strtoupper($pres->jenjang) }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    @if($pres->aktif)
                                        <span style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; padding: 3px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="fa-solid fa-check"></i> Aktif
                                        </span>
                                    @else
                                        <span style="background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; padding: 3px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="fa-solid fa-xmark"></i> Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <button type="button" onclick="openEditPrestasi({{ $pres->id }}, '{{ addslashes($pres->nama_prestasi) }}', '{{ $pres->kategori }}', '{{ $pres->jenjang }}', {{ $pres->aktif ? 'true' : 'false' }})" style="background: #e9f2ff; color: #3875c5; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center;" title="Edit Template Prestasi">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" onclick="openDeletePrestasi({{ $pres->id }}, '{{ addslashes($pres->nama_prestasi) }}')" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center;" title="Hapus Template Prestasi">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #64748b;">
                                <i class="fa-solid fa-trophy" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                                Belum ada Master Template Jenis Prestasi yang diatur.
                            </td>
                        </tr>
                    @endif
                </x-siakad.ui.table>
            </div>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL KEGIATAN SEKOLAH & TEMPLATE PRESTASI               -->
<!-- ======================================================== -->
<x-siakad.ui.modal id="addKegiatanModal" title="Tambah Program Kegiatan Sekolah" icon="fa-mosque" iconColor="#6d28d9" iconBg="#ede9fe">
    <form action="/sk/simpan-kegiatan-sekolah" method="POST">
        @csrf
        <div style="margin-bottom: 14px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Nama Program Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="ref-input" required maxlength="150" placeholder="Contoh: Sholat Berjamaah / Tahfidz Pagi">
        </div>
        <div style="margin-bottom: 14px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jenjang Sasaran</label>
            <select name="jenjang" class="ref-input" required>
                <option value="semua">Semua Jenjang (Global)</option>
                <option value="sd">SD</option>
                <option value="smp">SMP</option>
                <option value="sma">SMA</option>
                <option value="tk">TK</option>
            </select>
        </div>
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Keterangan Default / Panduan Nilai (Opsional)</label>
            <textarea name="keterangan_default" rows="3" class="ref-input" placeholder="Deskripsi singkat atau panduan penilaian wali kelas..."></textarea>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeModal('addKegiatanModal')" style="padding: 10px 16px; border: none; background: #f1f5f9; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
            <button type="submit" style="padding: 10px 16px; border: none; background: #6d28d9; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan Kegiatan</button>
        </div>
    </form>
</x-siakad.ui.modal>

<x-siakad.ui.modal id="editKegiatanModal" title="Edit Program Kegiatan Sekolah" icon="fa-pen-to-square" iconColor="#3875c5" iconBg="#e9f2ff">
    <form id="editKegiatanForm" method="POST">
        @csrf
        <div style="margin-bottom: 14px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Nama Program Kegiatan</label>
            <input type="text" name="nama_kegiatan" id="ekNama" class="ref-input" required maxlength="150">
        </div>
        <div style="margin-bottom: 14px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jenjang Sasaran</label>
            <select name="jenjang" id="ekJenjang" class="ref-input" required>
                <option value="semua">Semua Jenjang (Global)</option>
                <option value="sd">SD</option>
                <option value="smp">SMP</option>
                <option value="sma">SMA</option>
                <option value="tk">TK</option>
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
            <button type="submit" style="padding: 10px 16px; border: none; background: #1d4ed8; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Perbarui Kegiatan</button>
        </div>
    </form>
</x-siakad.ui.modal>

<x-siakad.ui.modal id="addPrestasiModal" title="Tambah Template Jenis Prestasi" icon="fa-trophy" iconColor="#d97706" iconBg="#fef3c7">
    <form action="/sk/simpan-master-prestasi" method="POST">
        @csrf
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
                <select name="jenjang" class="ref-input" required>
                    <option value="semua">Semua Jenjang</option>
                    <option value="sd">SD</option>
                    <option value="smp">SMP</option>
                    <option value="sma">SMA</option>
                    <option value="tk">TK</option>
                </select>
            </div>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeModal('addPrestasiModal')" style="padding: 10px 16px; border: none; background: #f1f5f9; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
            <button type="submit" style="padding: 10px 16px; border: none; background: #d97706; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan Template</button>
        </div>
    </form>
</x-siakad.ui.modal>

<x-siakad.ui.modal id="editPrestasiModal" title="Edit Template Jenis Prestasi" icon="fa-pen-to-square" iconColor="#3875c5" iconBg="#e9f2ff">
    <form id="editPrestasiForm" method="POST">
        @csrf
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
                    <option value="semua">Semua Jenjang</option>
                    <option value="sd">SD</option>
                    <option value="smp">SMP</option>
                    <option value="sma">SMA</option>
                    <option value="tk">TK</option>
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
            <button type="submit" style="padding: 10px 16px; border: none; background: #1d4ed8; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Perbarui Template</button>
        </div>
    </form>
</x-siakad.ui.modal>

<x-siakad.ui.modal id="deleteAdminRaporModal" title="Konfirmasi Hapus" icon="fa-trash-can" iconColor="#b34d4d" iconBg="#f8e9e9">
    <p style="margin-top: -10px; margin-bottom: 20px; color: #475569; line-height: 1.5; font-size: 14px;">
        Anda yakin ingin menghapus data <strong id="delAdminRaporName" style="color: #1e293b;"></strong>? Data yang dihapus tidak dapat dipulihkan.
    </p>
    <div style="display: flex; justify-content: flex-end; gap: 10px;">
        <button type="button" onclick="closeModal('deleteAdminRaporModal')" style="padding: 10px 16px; border: none; background: #f1f5f9; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
        <button type="button" id="btnConfirmDeleteAdminRapor" style="padding: 10px 16px; border: none; background: #b34d4d; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 6px;">
            <i class="fa-solid fa-trash-can"></i> Ya, Hapus
        </button>
    </div>
</x-siakad.ui.modal>

<script>
    let deleteAdminRaporTargetUrl = '';

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

    function openEditKegiatan(id, nama, jenjang, ket, aktif) {
        document.getElementById('editKegiatanForm').action = '/sk/update-kegiatan-sekolah/' + id;
        document.getElementById('ekNama').value = nama || '';
        document.getElementById('ekJenjang').value = jenjang || 'semua';
        document.getElementById('ekKet').value = ket || '';
        document.getElementById('ekAktif').checked = !!aktif;
        openModal('editKegiatanModal');
    }

    function openDeleteKegiatan(id, nama) {
        deleteAdminRaporTargetUrl = '/sk/hapus-kegiatan-sekolah/' + id;
        document.getElementById('delAdminRaporName').textContent = 'Kegiatan: ' + nama;
        openModal('deleteAdminRaporModal');
    }

    function openEditPrestasi(id, nama, kategori, jenjang, aktif) {
        document.getElementById('editPrestasiForm').action = '/sk/update-master-prestasi/' + id;
        document.getElementById('epNama').value = nama || '';
        document.getElementById('epKategori').value = kategori || 'Tahfidz';
        document.getElementById('epJenjang').value = jenjang || 'semua';
        document.getElementById('epAktif').checked = !!aktif;
        openModal('editPrestasiModal');
    }

    function openDeletePrestasi(id, nama) {
        deleteAdminRaporTargetUrl = '/sk/hapus-master-prestasi/' + id;
        document.getElementById('delAdminRaporName').textContent = 'Template Prestasi: ' + nama;
        openModal('deleteAdminRaporModal');
    }

    document.getElementById('btnConfirmDeleteAdminRapor')?.addEventListener('click', function() {
        if (deleteAdminRaporTargetUrl) {
            window.location.href = deleteAdminRaporTargetUrl;
        }
    });

    // Manajemen TTD Kepala Sekolah (Global Admin)
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
    });
</script>
