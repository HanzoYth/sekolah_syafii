<x-siakad-layout 
    title="Data Referensi Akademik" 
    description="Kelola pengaturan Tahun Ajaran serta pemetaan Jam Pelajaran (JP) dan waktu istirahat per jenjang sekolah." 
    position="Administrator" 
    initials="AD">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/das" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Data Referensi</span>
        </li>
    </x-slot>

    <style>
        .jp-tab-btn {
            padding: 8px 16px; border-radius: 8px; border: 1px solid #e2e8f0;
            background: #f8fafc; color: #475569; font-family: inherit;
            font-size: 0.82rem; font-weight: 600; cursor: pointer; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .jp-tab-btn:hover { background: #f1f5f9; color: #1e293b; }
        .jp-tab-btn.active {
            background: #177455; color: #fff; border-color: #177455;
            box-shadow: 0 2px 8px rgba(23, 116, 85, .25);
        }
        .badge-jenjang {
            display: inline-flex; align-items: center; gap: 5px; padding: 3px 8px;
            border-radius: 6px; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.02em;
        }
        .badge-sd { background: #fee2e2; color: #b91c1c; }
        .badge-smp { background: #dbeafe; color: #1d4ed8; }
        .badge-sma { background: #ede9fe; color: #6d28d9; }
        .badge-tk { background: #fef3c7; color: #b45309; }
        .badge-umum { background: #f1f5f9; color: #475569; }
        .jam-break-row {
            background: #fffbeb !important;
            border-left: 4px solid #f59e0b;
        }
        .badge-istirahat-tag {
            display: inline-flex; align-items: center; gap: 5px;
            background: #fef3c7; color: #b45309; border: 1px solid #fde68a;
            padding: 3px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: 700;
        }
        .btn-quick-istirahat {
            display: inline-flex; align-items: center; gap: 5px;
            background: #fef3c7; color: #b45309; border: 1px solid #fde68a;
            padding: 4px 10px; border-radius: 6px; font-size: 0.74rem; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-quick-istirahat:hover {
            background: #fde68a; color: #92400e;
        }
        .ref-input {
            width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px;
            font-family: inherit; font-size: 14px; box-sizing: border-box; outline: none; background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .ref-input:focus {
            border-color: #177455;
            box-shadow: 0 0 0 3px rgba(23, 116, 85, 0.15);
        }
    </style>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3 shadow-sm">
            <i class="fa-solid fa-circle-check text-emerald-600 text-lg mt-0.5 flex-shrink-0"></i>
            <div class="flex-1">
                <p class="font-semibold text-sm">Berhasil!</p>
                <p class="text-sm mt-0.5 text-emerald-700">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-3 shadow-sm">
            <i class="fa-solid fa-circle-exclamation text-rose-600 text-lg mt-0.5 flex-shrink-0"></i>
            <div class="flex-1">
                <p class="font-semibold text-sm">Terjadi Kesalahan</p>
                <p class="text-sm mt-0.5 text-rose-700">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- ======================================================== -->
    <!-- TOP KPI STATS CARDS (REFERENSI BOBOT & KKM NILAI)         -->
    <!-- ======================================================== -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tahun Ajaran Aktif</p>
                    @php $tahunAktif = $data_tahun->firstWhere('aktif', true); @endphp
                    <h4 class="text-xl font-bold text-emerald-700 mt-1 truncate max-w-[190px]" title="{{ $tahunAktif->nama ?? 'Belum Diatur' }}">
                        {{ $tahunAktif->nama ?? 'Belum Diatur' }}
                    </h4>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 mt-2 block">{{ $data_tahun->count() }} Total Periode Terdaftar</span>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Slot Jam KBM</p>
                    <h4 class="text-2xl font-bold text-slate-800 mt-1">
                        {{ $data_jam->where('is_istirahat', false)->count() }}
                    </h4>
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 mt-2 block">Sesi jam pelajaran aktif</span>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Jam Istirahat</p>
                    <h4 class="text-2xl font-bold text-amber-700 mt-1">
                        {{ $data_jam->where('is_istirahat', true)->count() }}
                    </h4>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-mug-hot"></i>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 mt-2 block">Jeda istirahat terjadwal</span>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Jenjang Sekolah</p>
                    <h4 class="text-2xl font-bold text-indigo-700 mt-1">
                        {{ $data_sekolah->count() }}
                    </h4>
                </div>
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-school"></i>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 mt-2 block">SD (35m), SMP (45m), TK (Non-JP)</span>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- BAGIAN 1: TAHUN AJARAN                                   -->
    <!-- ======================================================== -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Tahun Ajaran</h3>
                    <p class="text-xs text-slate-500">Daftar periode tahun ajaran aktif dan riwayat kalender akademik sekolah.</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button type="button" onclick="openModal('addTahunModal')" style="background: #177455; color: white; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; font-size: 13.5px; transition: background 0.2s;">
                    <i class="fa-solid fa-plus"></i> Tambah Tahun
                </button>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <x-siakad.ui.table>
                    <x-slot name="thead">
                        <tr>
                            <th style="width: 60px; text-align: center;">No.</th>
                            <th>Tahun Ajaran</th>
                            <th>Periode Kalender</th>
                            <th style="text-align: center;">Status</th>
                            <th style="width: 110px; text-align: center;">Aksi</th>
                        </tr>
                    </x-slot>

                    @if(count($data_tahun) > 0)
                        @foreach($data_tahun as $index => $t)
                            <tr>
                                <td style="text-align: center; font-weight: 600;">{{ $index + 1 }}</td>
                                <td>
                                    <strong style="color: #1e293b; font-size: 14px;">{{ $t->nama }}</strong>
                                </td>
                                <td>
                                    <span style="color: #475569; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                                        <i class="fa-regular fa-calendar" style="color: #94a3b8;"></i>
                                        {{ \Carbon\Carbon::parse($t->tanggal_mulai)->format('d M Y') }} &mdash; {{ \Carbon\Carbon::parse($t->tanggal_selesai)->format('d M Y') }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    @if($t->aktif)
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
                                        <button type="button" onclick="openEditTahun({{ $t->id }}, '{{ addslashes($t->nama) }}', '{{ $t->tanggal_mulai }}', '{{ $t->tanggal_selesai }}', {{ $t->aktif ? 'true' : 'false' }})" style="background: #e9f2ff; color: #3875c5; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Edit Tahun Ajaran">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" onclick="openDeleteTahun({{ $t->id }}, '{{ addslashes($t->nama) }}')" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Hapus Tahun Ajaran">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: #64748b;">
                                <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                                Belum ada data Tahun Ajaran yang terdaftar.
                            </td>
                        </tr>
                    @endif
                </x-siakad.ui.table>
            </div>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- BAGIAN 2: JAM PELAJARAN (SISTEM JP PER JENJANG)          -->
    <!-- ======================================================== -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Jam Pelajaran & Waktu Istirahat (Sistem JP)</h3>
                    <p class="text-xs text-slate-500">Pemetaan blok waktu KBM per jenjang berdasarkan standar durasi JP resmi.</p>
                </div>
            </div>

            <div class="flex items-center gap-2 flex-wrap">
                <button type="button" onclick="openModalGenerateJp()" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; padding: 9px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; transition: all 0.2s;">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Generate Paket JP
                </button>
                <button type="button" onclick="openModalTambahSatuan()" style="background: #177455; color: white; border: none; padding: 9px 15px; border-radius: 8px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; font-size: 13px; transition: background 0.2s;">
                    <i class="fa-solid fa-plus"></i> Tambah Jam Satuan
                </button>
                <button type="button" onclick="openModalTambahIstirahat()" style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; padding: 9px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; transition: all 0.2s;">
                    <i class="fa-solid fa-mug-hot"></i> Tambah Jam Istirahat
                </button>
            </div>
        </div>

        <div class="p-6">
            <!-- Standar Durasi JP Banner -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-5">
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                        SD
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Jenjang SD (Kelas 1 - 6)</p>
                        <p class="text-[11px] text-slate-500">Standar: <strong class="text-rose-700">1 JP = 35 Menit</strong> (2 JP = 70m)</p>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                        SMP
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Jenjang SMP (Kelas 7 - 9)</p>
                        <p class="text-[11px] text-slate-500">Standar: <strong class="text-blue-700">1 JP = 45 Menit</strong> (2 JP = 90m)</p>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                        TK
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Jenjang TK (TK A & TK B)</p>
                        <p class="text-[11px] text-slate-500"><strong class="text-amber-700">Non-JP</strong> (Rentang waktu sesi bebas)</p>
                    </div>
                </div>
            </div>

            <!-- Tabs per Jenjang -->
            <div class="flex items-center gap-2 mb-4 flex-wrap" id="jpTabBar">
                @foreach($data_sekolah ?? [] as $index => $s)
                    @php
                        $kode = strtoupper(trim($s->jenis));
                        $pakaiJp = \App\Models\jam_pelajaran::pakaiSistemJp($kode);
                        $standarMenit = \App\Models\jam_pelajaran::standarMenitPerJp($kode);
                        $jmlJam = $data_jam->where('sekolah_id', $s->id)->count();
                        $isActive = ($index === 0);
                    @endphp
                    <button type="button" class="jp-tab-btn {{ $isActive ? 'active' : '' }}" 
                        data-jenjang-target="{{ $kode }}" 
                        data-sekolah-id="{{ $s->id }}" 
                        onclick="filterJamJenjang('{{ $kode }}', this)">
                        <i class="fa-solid fa-school"></i>
                        <span>Jenjang {{ $kode }}</span>
                        @if($pakaiJp)
                            <span class="text-[11px] opacity-80 font-normal">({{ $standarMenit }}m &bull; {{ $jmlJam }} Slot)</span>
                        @else
                            <span class="text-[11px] opacity-80 font-normal">(Non-JP &bull; {{ $jmlJam }} Slot)</span>
                        @endif
                    </button>
                @endforeach
                @php $jmlUmum = $data_jam->whereNull('sekolah_id')->count(); @endphp
                @if($jmlUmum > 0)
                    <button type="button" class="jp-tab-btn" 
                        data-jenjang-target="UMUM" 
                        data-sekolah-id="" 
                        onclick="filterJamJenjang('UMUM', this)">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Umum / Lintas ({{ $jmlUmum }})</span>
                    </button>
                @endif
            </div>

            <!-- Active Jenjang Sub-Banner -->
            <div id="activeJenjangBanner" class="p-3 bg-slate-50 rounded-lg border border-slate-200 mb-4 flex justify-between items-center flex-wrap gap-2 text-xs text-slate-600">
                <div>
                    <i class="fa-solid fa-layer-group text-emerald-600 mr-1.5"></i>
                    Menampilkan Master Jam untuk: <strong id="lblActiveJenjangTitle" class="text-slate-800">Jenjang SD</strong>
                    <span class="text-slate-400 ml-1.5 hidden sm:inline">(Acuan master waktu berlaku serentak untuk seluruh kelas pada jenjang ini)</span>
                </div>
                <div id="lblActiveJenjangStat" class="font-semibold text-slate-500"></div>
            </div>

            <!-- Table of Jam Pelajaran -->
            <div class="overflow-x-auto">
                <x-siakad.ui.table>
                    <x-slot name="thead">
                        <tr>
                            <th style="width: 50px; text-align: center;">No.</th>
                            <th style="width: 100px;">Jenjang</th>
                            <th>Sesi / Jam Ke-</th>
                            <th>Rentang Waktu</th>
                            <th>Beban & Durasi JP</th>
                            <th style="width: 110px; text-align: center;">Aksi</th>
                        </tr>
                    </x-slot>

                    <tr class="jam-empty-jenjang" id="jamEmptyState" style="display: none;">
                        <td colspan="6" style="text-align: center; padding: 40px 20px; color: #64748b;">
                            <i class="fa-solid fa-folder-open" style="font-size: 28px; color: #cbd5e1; display: block; margin-bottom: 10px;"></i>
                            Belum ada slot Jam Pelajaran atau Jam Istirahat untuk jenjang ini.<br>
                            <span style="font-size: 0.8rem; color: #94a3b8;">Gunakan tombol <strong>Generate Paket JP</strong> atau <strong>Tambah Jam Satuan / Istirahat</strong> untuk mengisi.</span>
                        </td>
                    </tr>
                    @if(count($data_jam) > 0)
                        @php $prevJamByJenjang = []; @endphp
                        @foreach($data_jam as $index => $j)
                            @php
                                $kode = $j->kode_jenjang;
                                $pakaiJpRow = $j->is_pakai_jp;
                                $isIstirahatRow = $j->is_istirahat;
                                $badgeClass = match(strtolower($kode)) {
                                    'sd' => 'badge-sd',
                                    'smp' => 'badge-smp',
                                    'sma', 'smk' => 'badge-sma',
                                    'tk', 'paud' => 'badge-tk',
                                    default => 'badge-umum'
                                };
                                $durasiTotal = $j->durasi_menit;
                                $jmlJp = $j->hitung_jp;
                                $perJp = $j->menit_per_jp;
                                $labelSesi = $j->jam_ke ?: ('Sesi ' . ($index + 1));

                                // Cek jeda istirahat otomatis dari sesi sebelumnya pada jenjang yang sama
                                $jedaOtomatis = null;
                                if (isset($prevJamByJenjang[$kode]) && !$isIstirahatRow && !$prevJamByJenjang[$kode]->is_istirahat) {
                                    $jedaOtomatis = \App\Models\jam_pelajaran::deteksiJedaIstirahat(
                                        $prevJamByJenjang[$kode]->jam_selesai,
                                        $j->jam_mulai
                                    );
                                }
                                $prevJamByJenjang[$kode] = $j;
                            @endphp

                            @if($jedaOtomatis)
                                <tr class="jam-row jam-break-row" data-jenjang="{{ $kode }}" style="background: #fffbeb;">
                                    <td style="text-align: center; color: #d97706;"><i class="fa-solid fa-mug-hot"></i></td>
                                    <td>
                                        <span class="badge-jenjang {{ $badgeClass }}">{{ $kode }}</span>
                                    </td>
                                    <td>
                                        <strong style="color: #b45309;"><i class="fa-solid fa-mug-saucer" style="margin-right:4px;"></i> JEDA ISTIRAHAT</strong>
                                        <span style="font-size:0.72rem; color:#92400e; margin-left:6px; font-style:italic;">(Otomatis)</span>
                                    </td>
                                    <td>
                                        <span style="display:inline-flex; align-items:center; gap:6px; font-weight:700; color:#b45309;">
                                            <i class="fa-regular fa-clock" style="color:#d97706;"></i>
                                            {{ $jedaOtomatis['mulai'] }} - {{ $jedaOtomatis['selesai'] }} WIB
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-istirahat-tag">
                                            <i class="fa-solid fa-mug-hot"></i> Jeda ({{ $jedaOtomatis['durasi'] }} Menit)
                                        </span>
                                    </td>
                                    <td style="text-align:center;">
                                        <button type="button" class="btn-quick-istirahat" onclick="quickAddIstirahat('{{ $j->sekolah_id }}', '{{ $jedaOtomatis['mulai'] }}', '{{ $jedaOtomatis['selesai'] }}')" title="Simpan jeda ini sebagai Jam Istirahat resmi">
                                            <i class="fa-solid fa-plus"></i> Simpan Resmi
                                        </button>
                                    </td>
                                </tr>
                            @endif

                            @if($isIstirahatRow)
                                <tr class="jam-row jam-break-row" data-jenjang="{{ $kode }}" style="background: #fffbeb; border-left: 4px solid #f59e0b;">
                                    <td style="text-align: center; color: #d97706; font-weight:700;" class="jam-row-num">{{ $index + 1 }}</td>
                                    <td>
                                        <span class="badge-jenjang {{ $badgeClass }}">
                                            {{ $kode }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong style="color: #b45309;"><i class="fa-solid fa-mug-hot" style="margin-right:6px;"></i> {{ $labelSesi }}</strong>
                                        <span style="font-size: 0.72rem; background: #fef3c7; color: #b45309; border: 1px solid #fde68a; padding: 2px 7px; border-radius: 4px; font-weight: 700; margin-left: 6px;">
                                            Jam Istirahat
                                        </span>
                                    </td>
                                    <td>
                                        <span style="display:inline-flex; align-items:center; gap:6px; font-weight:700; color:#b45309;">
                                            <i class="fa-regular fa-clock" style="color:#d97706;"></i>
                                            {{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }} WIB
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-istirahat-tag">
                                            <i class="fa-solid fa-coffee"></i> Istirahat Bebas ({{ $durasiTotal }} Menit)
                                        </span>
                                    </td>
                                    <td style="text-align: center;">
                                        <div style="display: flex; gap: 8px; justify-content: center;">
                                            <button type="button" onclick="openEditIstirahat({{ $j->id }}, '{{ $j->sekolah_id ?? '' }}', '{{ addslashes($j->jam_ke ?? '') }}', '{{ substr($j->jam_mulai, 0, 5) }}', '{{ substr($j->jam_selesai, 0, 5) }}')" style="background: #e9f2ff; color: #3875c5; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Edit Jam Istirahat">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" onclick="openDeleteJam({{ $j->id }}, 'Jam Istirahat: {{ addslashes($labelSesi) }} ({{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }})')" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Hapus Jam Istirahat">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <tr class="jam-row" data-jenjang="{{ $kode }}">
                                    <td style="text-align: center; font-weight: 600;" class="jam-row-num">{{ $index + 1 }}</td>
                                    <td>
                                        <span class="badge-jenjang {{ $badgeClass }}">
                                            {{ $kode }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong style="color: #1e293b;">{{ $labelSesi }}</strong>
                                    </td>
                                    <td>
                                        <span style="display:inline-flex; align-items:center; gap:6px; font-weight:600; color:#1e293b;">
                                            <i class="fa-regular fa-clock" style="color:#177455;"></i>
                                            {{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }} WIB
                                        </span>
                                    </td>
                                    <td>
                                        @if($pakaiJpRow)
                                            <span style="background:#ecfdf5; color:#047857; padding:4px 10px; border-radius:6px; font-size:0.78rem; font-weight:700;">
                                                {{ $jmlJp }} JP
                                            </span>
                                            <span style="font-size:0.78rem; color:#64748b; margin-left:6px;">
                                                ({{ $durasiTotal }} Menit &bull; @1 JP = {{ $perJp }}m)
                                            </span>
                                        @else
                                            <span style="background:#fef3c7; color:#b45309; padding:4px 10px; border-radius:6px; font-size:0.78rem; font-weight:700;">
                                                Non-JP (Sesi TK)
                                            </span>
                                            <span style="font-size:0.78rem; color:#64748b; margin-left:6px;">
                                                ({{ $durasiTotal }} Menit)
                                            </span>
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <div style="display: flex; gap: 8px; justify-content: center;">
                                            <button type="button" onclick="openEditJam({{ $j->id }}, '{{ $j->sekolah_id ?? '' }}', '{{ addslashes($j->jam_ke ?? '') }}', {{ $jmlJp ?: 1 }}, {{ $perJp }}, '{{ substr($j->jam_mulai, 0, 5) }}', '{{ substr($j->jam_selesai, 0, 5) }}')" style="background: #e9f2ff; color: #3875c5; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Edit Jam Pelajaran">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" onclick="openDeleteJam({{ $j->id }}, '{{ $kode }} - {{ addslashes($labelSesi) }} ({{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }})')" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Hapus Jam Pelajaran">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #64748b;">
                                <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                                Belum ada data Jam Pelajaran yang diatur.
                            </td>
                        </tr>
                    @endif
                </x-siakad.ui.table>
            </div>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- MODAL-MODAL REFERENSI AKADEMIK (DESAIN STANDAR JADWAL)   -->
    <!-- ======================================================== -->

    <!-- Modal Tambah Tahun Ajaran -->
    <x-siakad.ui.modal id="addTahunModal" title="Tambah Tahun Ajaran" icon="fa-calendar-plus" iconColor="#166534" iconBg="#dcfce7">
        <form action="/sk/simpan-tahun-ajaran" method="POST">
            @csrf
            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Nama Tahun Ajaran</label>
                <input type="text" name="nama" class="ref-input" required placeholder="Contoh: 2026/2027 Ganjil">
            </div>
            <div style="display: flex; gap: 10px; margin-bottom: 14px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="ref-input" required>
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="ref-input" required>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 22px;">
                <input type="checkbox" name="aktif" id="chkAktifAdd" value="1" checked style="width: 18px; height: 18px; accent-color: #177455; cursor: pointer;">
                <label for="chkAktifAdd" style="margin: 0; cursor: pointer; font-size: 13.5px; color: #334155; font-weight: 500;">Tandai sebagai Tahun Ajaran Aktif</label>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('addTahunModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #177455; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-save"></i> Simpan Tahun
                </button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Edit Tahun Ajaran -->
    <x-siakad.ui.modal id="editTahunModal" title="Edit Tahun Ajaran" icon="fa-calendar-check" iconColor="#3875c5" iconBg="#e9f2ff">
        <form id="editTahunForm" method="POST">
            @csrf
            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Nama Tahun Ajaran</label>
                <input type="text" name="nama" id="etNama" class="ref-input" required>
            </div>
            <div style="display: flex; gap: 10px; margin-bottom: 14px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="etMulai" class="ref-input" required>
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="etSelesai" class="ref-input" required>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 22px;">
                <input type="checkbox" name="aktif" id="etAktif" value="1" style="width: 18px; height: 18px; accent-color: #177455; cursor: pointer;">
                <label for="etAktif" style="margin: 0; cursor: pointer; font-size: 13.5px; color: #334155; font-weight: 500;">Tandai sebagai Tahun Ajaran Aktif</label>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('editTahunModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #3875c5; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Generate Paket JP Otomatis -->
    <x-siakad.ui.modal id="generateJpModal" title="Generate Paket JP Otomatis" icon="fa-wand-magic-sparkles" iconColor="#1d4ed8" iconBg="#eff6ff">
        <p style="margin-top: -10px; margin-bottom: 18px; font-size: 13px; color: #64748b; line-height: 1.5;">
            Buat urutan slot Jam Ke-1 s/d selesai sekaligus sesuai standar JP jenjang (SD = 35 menit/JP, SMP = 45 menit/JP).
        </p>
        <form action="/sk/simpan-jam-pelajaran" method="POST">
            @csrf
            <input type="hidden" name="mode" value="generate_paket">

            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Pilih Jenjang Sekolah (Berbasis JP)</label>
                <select name="sekolah_id" id="genSekolahId" class="ref-input" required onchange="onGenJenjangChange()">
                    <option value="">-- Pilih Jenjang --</option>
                    @foreach($data_sekolah ?? [] as $s)
                        @php
                            $kode = strtoupper(trim($s->jenis));
                            $pakaiJp = \App\Models\jam_pelajaran::pakaiSistemJp($kode);
                            $menit = \App\Models\jam_pelajaran::standarMenitPerJp($kode);
                        @endphp
                        @if($pakaiJp)
                            <option value="{{ $s->id }}" data-kode="{{ $kode }}" data-menit="{{ $menit }}">
                                {{ $kode }} (Standar 1 JP = {{ $menit }} Menit)
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div style="display: flex; gap: 10px; margin-bottom: 14px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Durasi 1 JP (Menit)</label>
                    <input type="number" name="durasi_per_jp" id="genDurasiJp" class="ref-input" value="35" min="15" max="90" required oninput="updateGenPreview()">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jam Mulai Pagi</label>
                    <input type="time" name="jam_awal" id="genJamAwal" class="ref-input" value="07:00" required oninput="updateGenPreview()">
                </div>
            </div>

            <div style="display: flex; gap: 10px; margin-bottom: 14px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Total JP Harian</label>
                    <select name="total_jp_harian" id="genTotalJp" class="ref-input" onchange="updateGenPreview()">
                        <option value="6">6 JP / Hari</option>
                        <option value="7">7 JP / Hari</option>
                        <option value="8" selected>8 JP / Hari</option>
                        <option value="9">9 JP / Hari</option>
                        <option value="10">10 JP / Hari</option>
                    </select>
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Pola Pembuatan</label>
                    <select name="jp_per_sesi" id="genJpPerSesi" class="ref-input" onchange="updateGenPreview()">
                        <option value="1" selected>Per 1 JP (Jam Ke-1, Jam Ke-2, dst.)</option>
                        <option value="2">Per 2 JP (Jam Ke-1 s/d 2, dst.)</option>
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 10px; margin-bottom: 14px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Sisipkan Jeda Istirahat Setelah</label>
                    <select name="istirahat_setelah_jp" id="genIstirahatSetelah" class="ref-input" onchange="updateGenPreview()">
                        <option value="0">Tanpa Jeda Istirahat</option>
                        <option value="3">Setelah Jam Ke-3</option>
                        <option value="4" selected>Setelah Jam Ke-4</option>
                        <option value="5">Setelah Jam Ke-5</option>
                    </select>
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Durasi Istirahat (Menit)</label>
                    <input type="number" name="durasi_istirahat" id="genDurasiIstirahat" class="ref-input" value="15" min="0" max="60" oninput="updateGenPreview()">
                </div>
            </div>

            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 10px 14px; border-radius: 8px; font-size: 12.5px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;" id="genPreviewBox">
                <i class="fa-solid fa-circle-info"></i>
                <span id="genPreviewText">Pilih jenjang untuk melihat simulasi rentang jam otomatis.</span>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('generateJpModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #1d4ed8; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-bolt"></i> Generate Sekarang
                </button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Tambah Jam Satuan -->
    <x-siakad.ui.modal id="addJamModal" title="Tambah Jam Pelajaran" icon="fa-clock" iconColor="#166534" iconBg="#dcfce7">
        <p style="margin-top: -10px; margin-bottom: 18px; font-size: 13px; color: #64748b; line-height: 1.5;">
            Pilih jenjang dan jumlah JP, maka <strong>Jam Selesai</strong> akan dihitung otomatis sesuai standar jenjang.
        </p>
        <form action="/sk/simpan-jam-pelajaran" method="POST">
            @csrf
            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jenjang Sekolah</label>
                <select name="sekolah_id" id="addSekolahId" class="ref-input" onchange="onAddJenjangChange()">
                    <option value="" data-kode="UMUM" data-pakai-jp="1" data-menit="35">-- Umum / Semua Jenjang --</option>
                    @foreach($data_sekolah ?? [] as $s)
                        @php
                            $kode = strtoupper(trim($s->jenis));
                            $pakaiJp = \App\Models\jam_pelajaran::pakaiSistemJp($kode);
                            $menit = \App\Models\jam_pelajaran::standarMenitPerJp($kode);
                        @endphp
                        <option value="{{ $s->id }}" data-kode="{{ $kode }}" data-pakai-jp="{{ $pakaiJp ? '1' : '0' }}" data-menit="{{ $menit }}">
                            {{ $kode }} {{ $pakaiJp ? '(1 JP = ' . $menit . ' Menit)' : '(Non-JP / Rentang Bebas)' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; gap: 10px; margin-bottom: 14px;">
                <div style="flex: 1.2;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Label Sesi / Jam Ke-</label>
                    <input type="text" name="jam_ke" id="addJamKe" class="ref-input" placeholder="Contoh: Jam Ke-1 / Sesi Pagi">
                </div>
                <div style="flex: 0.8;" id="addWrapJumlahJp">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jumlah JP</label>
                    <select name="jumlah_jp" id="addJumlahJp" class="ref-input" onchange="hitungJamSelesaiAdd()">
                        <option value="1" selected>1 JP</option>
                        <option value="2">2 JP</option>
                        <option value="3">3 JP</option>
                        <option value="4">4 JP</option>
                    </select>
                </div>
                <div style="flex: 0.8;" id="addWrapDurasiJp">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Menit / JP</label>
                    <input type="number" name="durasi_per_jp" id="addDurasiPerJp" class="ref-input" value="35" min="15" max="90" oninput="hitungJamSelesaiAdd()">
                </div>
            </div>

            <div style="display: flex; gap: 10px; margin-bottom: 14px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="addJamMulai" class="ref-input" value="07:00" required oninput="hitungJamSelesaiAdd()">
                </div>
                <div style="flex: 1;">
                    <label id="addLabelJamSelesai" style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jam Selesai (Otomatis)</label>
                    <input type="time" name="jam_selesai" id="addJamSelesai" class="ref-input" value="07:35" required>
                </div>
            </div>

            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 10px 14px; border-radius: 8px; font-size: 12.5px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-calculator"></i>
                <span id="addCalcInfo">Kalkulator JP: 1 JP &times; 35 menit = 35 menit (07:00 - 07:35)</span>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('addJamModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #177455; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-save"></i> Simpan Jam
                </button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Tambah Jam Istirahat -->
    <x-siakad.ui.modal id="addIstirahatModal" title="Tambah Jam Istirahat" icon="fa-mug-hot" iconColor="#b45309" iconBg="#fef3c7">
        <p style="margin-top: -10px; margin-bottom: 18px; font-size: 13px; color: #64748b; line-height: 1.5;">
            Atur slot jam istirahat untuk jenjang sekolah. Slot istirahat tidak dihitung sebagai beban JP dan bebas dari KBM.
        </p>
        <form action="/sk/simpan-jam-pelajaran" method="POST">
            @csrf
            <input type="hidden" name="mode" value="istirahat">

            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jenjang Sekolah</label>
                <select name="sekolah_id" id="addIstirahatSekolahId" class="ref-input" required>
                    @foreach($data_sekolah ?? [] as $s)
                        @php $kode = strtoupper(trim($s->jenis)); @endphp
                        <option value="{{ $s->id }}" data-kode="{{ $kode }}">Jenjang {{ $kode }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Label / Nama Istirahat</label>
                <input type="text" name="jam_ke" id="addIstirahatJamKe" class="ref-input" value="Istirahat 1" required placeholder="Contoh: Istirahat Pagi / Istirahat Siang & Sholat Dhuhur">
            </div>

            <div style="display: flex; gap: 10px; margin-bottom: 14px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="addIstirahatJamMulai" class="ref-input" value="09:45" required oninput="calcDurationIstirahat('add')">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="addIstirahatJamSelesai" class="ref-input" value="10:15" required oninput="calcDurationIstirahat('add')">
                </div>
            </div>

            <div style="background: #fffbeb; border: 1px solid #fde68a; color: #b45309; padding: 10px 14px; border-radius: 8px; font-size: 12.5px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-mug-hot"></i>
                <span id="addIstirahatCalcInfo">Durasi: 30 Menit (09:45 - 10:15 WIB) &bull; Bebas dari KBM</span>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('addIstirahatModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #d97706; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-check"></i> Simpan Jam Istirahat
                </button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Edit Jam Pelajaran -->
    <x-siakad.ui.modal id="editJamModal" title="Edit Jam Pelajaran" icon="fa-pen-to-square" iconColor="#3875c5" iconBg="#e9f2ff">
        <form id="editJamForm" method="POST">
            @csrf
            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jenjang Sekolah</label>
                <select name="sekolah_id" id="ejSekolahId" class="ref-input" onchange="onEditJenjangChange()">
                    <option value="" data-kode="UMUM" data-pakai-jp="1" data-menit="35">-- Umum / Semua Jenjang --</option>
                    @foreach($data_sekolah ?? [] as $s)
                        @php
                            $kode = strtoupper(trim($s->jenis));
                            $pakaiJp = \App\Models\jam_pelajaran::pakaiSistemJp($kode);
                            $menit = \App\Models\jam_pelajaran::standarMenitPerJp($kode);
                        @endphp
                        <option value="{{ $s->id }}" data-kode="{{ $kode }}" data-pakai-jp="{{ $pakaiJp ? '1' : '0' }}" data-menit="{{ $menit }}">
                            {{ $kode }} {{ $pakaiJp ? '(1 JP = ' . $menit . ' Menit)' : '(Non-JP / Rentang Bebas)' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; gap: 10px; margin-bottom: 14px;">
                <div style="flex: 1.2;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Label Sesi / Jam Ke-</label>
                    <input type="text" name="jam_ke" id="ejJamKe" class="ref-input" placeholder="Contoh: Jam Ke-1">
                </div>
                <div style="flex: 0.8;" id="ejWrapJumlahJp">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jumlah JP</label>
                    <select name="jumlah_jp" id="ejJumlahJp" class="ref-input" onchange="hitungJamSelesaiEdit()">
                        <option value="1">1 JP</option>
                        <option value="2">2 JP</option>
                        <option value="3">3 JP</option>
                        <option value="4">4 JP</option>
                    </select>
                </div>
                <div style="flex: 0.8;" id="ejWrapDurasiJp">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Menit / JP</label>
                    <input type="number" name="durasi_per_jp" id="ejDurasiPerJp" class="ref-input" value="35" min="15" max="90" oninput="hitungJamSelesaiEdit()">
                </div>
            </div>

            <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="ejMulai" class="ref-input" required oninput="hitungJamSelesaiEdit()">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="ejSelesai" class="ref-input" required>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('editJamModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #3875c5; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: gap: 6px;">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Edit Jam Istirahat -->
    <x-siakad.ui.modal id="editIstirahatModal" title="Edit Jam Istirahat" icon="fa-mug-hot" iconColor="#b45309" iconBg="#fef3c7">
        <form id="editIstirahatForm" method="POST">
            @csrf
            <input type="hidden" name="mode" value="istirahat">
            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jenjang Sekolah</label>
                <select name="sekolah_id" id="ejIstirahatSekolahId" class="ref-input" required>
                    @foreach($data_sekolah ?? [] as $s)
                        @php $kode = strtoupper(trim($s->jenis)); @endphp
                        <option value="{{ $s->id }}" data-kode="{{ $kode }}">Jenjang {{ $kode }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Label / Nama Istirahat</label>
                <input type="text" name="jam_ke" id="ejIstirahatJamKe" class="ref-input" required>
            </div>

            <div style="display: flex; gap: 10px; margin-bottom: 14px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="ejIstirahatJamMulai" class="ref-input" required oninput="calcDurationIstirahat('edit')">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="ejIstirahatJamSelesai" class="ref-input" required oninput="calcDurationIstirahat('edit')">
                </div>
            </div>

            <div style="background: #fffbeb; border: 1px solid #fde68a; color: #b45309; padding: 10px 14px; border-radius: 8px; font-size: 12.5px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-mug-hot"></i>
                <span id="ejIstirahatCalcInfo">Durasi: 30 Menit &bull; Bebas dari KBM</span>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('editIstirahatModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #d97706; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-check"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Konfirmasi Hapus -->
    <x-siakad.ui.modal id="deleteModal" title="Konfirmasi Hapus" icon="fa-triangle-exclamation" iconColor="#b34d4d" iconBg="#f8e9e9">
        <p style="margin-top: -10px; margin-bottom: 20px; color: #475569; line-height: 1.5; font-size: 14px;">
            Anda yakin ingin menghapus data <strong id="delName" style="color: #1e293b;"></strong>? Data yang dihapus tidak dapat dipulihkan.
        </p>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeModal('deleteModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
            <button type="button" id="btnConfirmDelete" style="padding: 10px 16px; border: none; background: #b34d4d; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-trash-can"></i> Ya, Hapus
            </button>
        </div>
    </x-siakad.ui.modal>

    <script>
        let deleteTargetUrl = '';

        function openModal(id) {
            const el = document.getElementById(id);
            if (el) el.style.display = 'flex';
        }

        function closeModal(id) {
            const el = document.getElementById(id);
            if (el) el.style.display = 'none';
        }

        // Helper hitung selisih menit antara dua jam "HH:MM"
        function calcDurationMinutes(startStr, endStr) {
            if (!startStr || !endStr || !startStr.includes(':') || !endStr.includes(':')) return 0;
            const p1 = startStr.split(':');
            const p2 = endStr.split(':');
            const m1 = parseInt(p1[0], 10) * 60 + parseInt(p1[1], 10);
            const m2 = parseInt(p2[0], 10) * 60 + parseInt(p2[1], 10);
            let diff = m2 - m1;
            if (diff < 0) diff += 1440;
            return diff;
        }

        function calcDurationIstirahat(mode) {
            const prefix = (mode === 'edit') ? 'ejIstirahat' : 'addIstirahat';
            const mulai = document.getElementById(prefix + 'JamMulai').value || '09:45';
            const selesai = document.getElementById(prefix + 'JamSelesai').value || '10:15';
            const durasi = calcDurationMinutes(mulai, selesai);
            const infoEl = document.getElementById(prefix + 'CalcInfo');
            if (infoEl) {
                infoEl.innerHTML = `Durasi: <strong>${durasi} Menit</strong> (${mulai} - ${selesai} WIB) &bull; Bebas dari KBM`;
            }
        }

        // Filter Tab Jenjang pada Tabel Jam Pelajaran
        function filterJamJenjang(kode, btn) {
            document.querySelectorAll('.jp-tab-btn').forEach(b => b.classList.remove('active'));
            if (btn) {
                btn.classList.add('active');
            } else {
                const targetBtn = document.querySelector(`.jp-tab-btn[data-jenjang-target="${kode}"]`);
                if (targetBtn) targetBtn.classList.add('active');
            }

            try {
                localStorage.setItem('siakad_ref_active_jenjang', kode);
            } catch (e) {}

            const titleEl = document.getElementById('lblActiveJenjangTitle');
            if (titleEl) {
                titleEl.textContent = (kode === 'UMUM') ? 'Umum / Lintas Jenjang' : `Jenjang ${kode}`;
            }

            let visibleCount = 0;
            let jpCount = 0;
            let istirahatCount = 0;

            document.querySelectorAll('.jam-row').forEach(row => {
                const rowJenjang = row.getAttribute('data-jenjang');
                if (rowJenjang === kode) {
                    row.style.display = '';
                    visibleCount++;
                    const numCell = row.querySelector('.jam-row-num');
                    if (numCell) numCell.textContent = visibleCount;

                    if (row.classList.contains('jam-break-row')) {
                        istirahatCount++;
                    } else {
                        jpCount++;
                    }
                } else {
                    row.style.display = 'none';
                }
            });

            const emptyState = document.getElementById('jamEmptyState');
            if (emptyState) {
                emptyState.style.display = (visibleCount === 0) ? '' : 'none';
            }

            const statEl = document.getElementById('lblActiveJenjangStat');
            if (statEl) {
                statEl.innerHTML = `<span style="color:#047857;">${jpCount} Sesi KBM</span> &bull; <span style="color:#b45309;">${istirahatCount} Istirahat</span> (Total: ${visibleCount} Slot)`;
            }
        }

        // Helper tambah menit ke string "HH:MM"
        function addMinutesToTime(timeStr, minutesToAdd) {
            if (!timeStr || !timeStr.includes(':')) return '07:35';
            const parts = timeStr.split(':');
            let totalMinutes = parseInt(parts[0], 10) * 60 + parseInt(parts[1], 10) + parseInt(minutesToAdd, 10);
            totalMinutes = ((totalMinutes % 1440) + 1440) % 1440;
            const hh = String(Math.floor(totalMinutes / 60)).padStart(2, '0');
            const mm = String(totalMinutes % 60).padStart(2, '0');
            return `${hh}:${mm}`;
        }

        // Buka Modal Generate Paket JP
        function openModalGenerateJp() {
            const activeBtn = document.querySelector('.jp-tab-btn.active');
            const activeSekolahId = activeBtn ? activeBtn.getAttribute('data-sekolah-id') : '';
            const sel = document.getElementById('genSekolahId');
            if (sel && activeSekolahId) {
                sel.value = activeSekolahId;
                onGenJenjangChange();
            }
            openModal('generateJpModal');
        }

        // Buka Modal Tambah Jam Satuan
        function openModalTambahSatuan() {
            const activeBtn = document.querySelector('.jp-tab-btn.active');
            const activeSekolahId = activeBtn ? activeBtn.getAttribute('data-sekolah-id') : '';
            const sel = document.getElementById('addSekolahId');
            if (sel && activeSekolahId) {
                sel.value = activeSekolahId;
            }
            onAddJenjangChange();
            openModal('addJamModal');
        }

        // Buka Modal Tambah Jam Istirahat
        function openModalTambahIstirahat(sekolahId, jamKe, mulai, selesai) {
            const sel = document.getElementById('addIstirahatSekolahId');
            if (sekolahId && sel) {
                sel.value = sekolahId;
            } else {
                const activeBtn = document.querySelector('.jp-tab-btn.active');
                const activeSekolahId = activeBtn ? activeBtn.getAttribute('data-sekolah-id') : '';
                if (activeSekolahId && sel) sel.value = activeSekolahId;
            }

            document.getElementById('addIstirahatJamKe').value = jamKe || 'Istirahat 1';
            document.getElementById('addIstirahatJamMulai').value = mulai || '09:45';
            document.getElementById('addIstirahatJamSelesai').value = selesai || '10:15';

            calcDurationIstirahat('add');
            openModal('addIstirahatModal');
        }

        // Aksi Cepat Mengubah Jeda Otomatis Menjadi Jam Istirahat Resmi
        function quickAddIstirahat(sekolahId, mulai, selesai) {
            openModalTambahIstirahat(sekolahId, 'Istirahat', mulai, selesai);
        }

        // Buka Modal Edit Khusus Jam Istirahat
        function openEditIstirahat(id, sekolahId, jamKe, mulai, selesai) {
            document.getElementById('editIstirahatForm').action = "/sk/update-jam-pelajaran/" + id;
            const sel = document.getElementById('ejIstirahatSekolahId');
            if (sel && sekolahId) sel.value = sekolahId;
            document.getElementById('ejIstirahatJamKe').value = jamKe || 'Jam Istirahat';
            document.getElementById('ejIstirahatJamMulai').value = mulai || '09:45';
            document.getElementById('ejIstirahatJamSelesai').value = selesai || '10:15';
            calcDurationIstirahat('edit');
            openModal('editIstirahatModal');
        }

        // Kalkulator JP pada Modal Tambah Jam Satuan
        function onAddJenjangChange() {
            const sel = document.getElementById('addSekolahId');
            const opt = sel.options[sel.selectedIndex];
            const pakaiJp = opt ? (opt.getAttribute('data-pakai-jp') !== '0') : true;
            const menit = opt ? (opt.getAttribute('data-menit') || 35) : 35;

            document.getElementById('addWrapJumlahJp').style.display = pakaiJp ? 'block' : 'none';
            document.getElementById('addWrapDurasiJp').style.display = pakaiJp ? 'block' : 'none';
            document.getElementById('addLabelJamSelesai').textContent = pakaiJp ? 'Jam Selesai (Otomatis)' : 'Jam Selesai';

            if (pakaiJp) {
                document.getElementById('addDurasiPerJp').value = menit;
                hitungJamSelesaiAdd();
            } else {
                document.getElementById('addCalcInfo').innerHTML = `Jenjang <strong>TK (Non-JP)</strong> tidak menggunakan perhitungan JP. Silakan tentukan Jam Mulai & Jam Selesai secara bebas.`;
            }
        }

        function hitungJamSelesaiAdd() {
            const sel = document.getElementById('addSekolahId');
            const opt = sel.options[sel.selectedIndex];
            const pakaiJp = opt ? (opt.getAttribute('data-pakai-jp') !== '0') : true;
            if (!pakaiJp) return;

            const jmlJp = parseInt(document.getElementById('addJumlahJp').value || 1, 10);
            const perJp = parseInt(document.getElementById('addDurasiPerJp').value || 35, 10);
            const mulai = document.getElementById('addJamMulai').value || '07:00';
            const totalMenit = jmlJp * perJp;
            const selesai = addMinutesToTime(mulai, totalMenit);
            document.getElementById('addJamSelesai').value = selesai;
            document.getElementById('addCalcInfo').innerHTML = `Kalkulator JP: <strong>${jmlJp} JP &times; ${perJp} menit = ${totalMenit} menit</strong> (${mulai} - ${selesai})`;
        }

        // Kalkulator JP pada Modal Edit Jam
        function onEditJenjangChange() {
            const sel = document.getElementById('ejSekolahId');
            const opt = sel.options[sel.selectedIndex];
            const pakaiJp = opt ? (opt.getAttribute('data-pakai-jp') !== '0') : true;
            const menit = opt ? (opt.getAttribute('data-menit') || 35) : 35;

            document.getElementById('ejWrapJumlahJp').style.display = pakaiJp ? 'block' : 'none';
            document.getElementById('ejWrapDurasiJp').style.display = pakaiJp ? 'block' : 'none';

            if (pakaiJp) {
                document.getElementById('ejDurasiPerJp').value = menit;
                hitungJamSelesaiEdit();
            }
        }

        function hitungJamSelesaiEdit() {
            const sel = document.getElementById('ejSekolahId');
            const opt = sel.options[sel.selectedIndex];
            const pakaiJp = opt ? (opt.getAttribute('data-pakai-jp') !== '0') : true;
            if (!pakaiJp) return;

            const jmlJp = parseInt(document.getElementById('ejJumlahJp').value || 1, 10);
            const perJp = parseInt(document.getElementById('ejDurasiPerJp').value || 35, 10);
            const mulai = document.getElementById('ejMulai').value || '07:00';
            const selesai = addMinutesToTime(mulai, jmlJp * perJp);
            document.getElementById('ejSelesai').value = selesai;
        }

        // Kalkulator Preview Generate Paket JP Otomatis
        function onGenJenjangChange() {
            const sel = document.getElementById('genSekolahId');
            const opt = sel.options[sel.selectedIndex];
            if (opt && opt.getAttribute('data-menit')) {
                document.getElementById('genDurasiJp').value = opt.getAttribute('data-menit');
            }
            updateGenPreview();
        }

        function updateGenPreview() {
            const sel = document.getElementById('genSekolahId');
            const opt = sel.options[sel.selectedIndex];
            const kode = opt && opt.getAttribute('data-kode') ? opt.getAttribute('data-kode') : 'Jenjang';
            const perJp = parseInt(document.getElementById('genDurasiJp').value || 35, 10);
            const mulai = document.getElementById('genJamAwal').value || '07:00';
            const totalJp = parseInt(document.getElementById('genTotalJp').value || 8, 10);
            const istirahatSetelah = parseInt(document.getElementById('genIstirahatSetelah').value || 0, 10);
            const durasiIstirahat = parseInt(document.getElementById('genDurasiIstirahat').value || 0, 10);

            let totalMenitBelajar = totalJp * perJp;
            if (istirahatSetelah > 0 && istirahatSetelah < totalJp) {
                totalMenitBelajar += durasiIstirahat;
            }
            const selesaiAkhir = addMinutesToTime(mulai, totalMenitBelajar);
            document.getElementById('genPreviewText').innerHTML =
                `Simulasi <strong>${kode}</strong>: ${totalJp} JP (@${perJp} menit) dimulai pukul <strong>${mulai}</strong> akan berakhir pukul <strong>${selesaiAkhir} WIB</strong>.`;
        }

        function openEditTahun(id, nama, mulai, selesai, aktif) {
            document.getElementById('editTahunForm').action = "/sk/update-tahun-ajaran/" + id;
            document.getElementById('etNama').value = nama;
            document.getElementById('etMulai').value = mulai;
            document.getElementById('etSelesai').value = selesai;
            document.getElementById('etAktif').checked = aktif;
            openModal('editTahunModal');
        }

        function openEditJam(id, sekolahId, jamKe, jmlJp, perJp, mulai, selesai) {
            document.getElementById('editJamForm').action = "/sk/update-jam-pelajaran/" + id;
            const sel = document.getElementById('ejSekolahId');
            sel.value = sekolahId || '';
            const opt = sel.options[sel.selectedIndex];
            const pakaiJp = opt ? (opt.getAttribute('data-pakai-jp') !== '0') : true;

            document.getElementById('ejWrapJumlahJp').style.display = pakaiJp ? 'block' : 'none';
            document.getElementById('ejWrapDurasiJp').style.display = pakaiJp ? 'block' : 'none';

            document.getElementById('ejJamKe').value = jamKe || '';
            document.getElementById('ejJumlahJp').value = jmlJp || 1;
            document.getElementById('ejDurasiPerJp').value = perJp || 35;
            document.getElementById('ejMulai').value = mulai;
            document.getElementById('ejSelesai').value = selesai;
            openModal('editJamModal');
        }

        function openDeleteTahun(id, nama) {
            deleteTargetUrl = "/sk/hapus-tahun-ajaran/" + id;
            document.getElementById('delName').textContent = "Tahun Ajaran: " + nama;
            openModal('deleteModal');
        }

        function openDeleteJam(id, nama) {
            deleteTargetUrl = "/sk/hapus-jam-pelajaran/" + id;
            document.getElementById('delName').textContent = nama;
            openModal('deleteModal');
        }

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            if (deleteTargetUrl) {
                window.location.href = deleteTargetUrl;
            }
        });

        // Inisialisasi Tab Jenjang Aktif saat Halaman Dimuat
        document.addEventListener('DOMContentLoaded', function() {
            let initialJenjang = null;
            try {
                initialJenjang = localStorage.getItem('siakad_ref_active_jenjang');
            } catch (e) {}

            const firstTabBtn = document.querySelector('.jp-tab-btn');
            const defaultKode = firstTabBtn ? firstTabBtn.getAttribute('data-jenjang-target') : 'SD';

            if (!initialJenjang || !document.querySelector(`.jp-tab-btn[data-jenjang-target="${initialJenjang}"]`)) {
                initialJenjang = defaultKode;
            }

            const activeBtn = document.querySelector(`.jp-tab-btn[data-jenjang-target="${initialJenjang}"]`) || firstTabBtn;
            if (activeBtn) {
                filterJamJenjang(initialJenjang, activeBtn);
            }
        });
    </script>
</x-siakad-layout>
