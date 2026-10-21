<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Referensi Akademik - SIAKAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/data_siswa.css') }}?v={{ time() }}">
    
    <style>
        .btn-add-ref {
            display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px;
            background: var(--student-primary); color: #fff; border: none; border-radius: 10px;
            font-family: 'Poppins', sans-serif; font-size: .84rem; font-weight: 600; cursor: pointer;
            transition: all 0.2s ease; box-shadow: 0 4px 12px rgba(23, 116, 85, .2);
        }
        .btn-add-ref:hover { background: #125e44; transform: translateY(-2px); }

        .btn-gen-jp {
            display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px;
            background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; border-radius: 10px;
            font-family: 'Poppins', sans-serif; font-size: .84rem; font-weight: 600; cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-gen-jp:hover { background: #dbeafe; transform: translateY(-2px); }

        .btn-add-break {
            display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px;
            background: #fffbeb; color: #b45309; border: 1px solid #fde68a; border-radius: 10px;
            font-family: 'Poppins', sans-serif; font-size: .84rem; font-weight: 600; cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-add-break:hover { background: #fef3c7; border-color: #f59e0b; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(245, 158, 11, .15); }

        .btn-save-gap {
            display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px;
            background: #fef08a; color: #854d0e; border: 1px solid #facc15; border-radius: 6px;
            font-family: 'Poppins', sans-serif; font-size: .75rem; font-weight: 600; cursor: pointer;
            transition: all 0.15s ease;
        }
        .btn-save-gap:hover { background: #fde047; color: #713f12; }

        .btn-chip {
            padding: 5px 12px; background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px;
            font-family: 'Poppins', sans-serif; font-size: 0.75rem; font-weight: 500; color: #475569;
            cursor: pointer; transition: all 0.15s ease;
        }
        .btn-chip:hover { background: #e2e8f0; color: #1e293b; }
        .btn-chip.active { background: #b45309; color: #fff; border-color: #b45309; }

        .break-preview-card {
            background: #fffbeb; border: 1px solid #fde68a; color: #b45309;
            padding: 11px 14px; border-radius: 10px; font-size: 0.82rem; margin-top: 14px;
            display: flex; align-items: center; gap: 10px; line-height: 1.4;
        }

        .jam-break-saved {
            background: #fffdf5 !important;
            border-left: 3px solid #f59e0b;
        }

        .action-btns { display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-action-icon {
            display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px;
            border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s;
        }
        .btn-action-edit { background: #e9f2ff; color: #3875c5; }
        .btn-action-edit:hover { background: #3875c5; color: #fff; }
        .btn-action-delete { background: #f8e9e9; color: #b34d4d; }
        .btn-action-delete:hover { background: #b34d4d; color: #fff; }

        .custom-modal-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(24, 51, 44, 0.6); backdrop-filter: blur(4px);
            display: flex; align-items: center; justify-content: center; z-index: 1000;
            opacity: 0; visibility: hidden; transition: all 0.3s ease; padding: 20px;
        }
        .custom-modal-overlay.active { opacity: 1; visibility: visible; }
        .custom-modal-card {
            background: var(--student-surface); width: 100%; max-width: 500px; border-radius: 20px;
            padding: 28px; box-shadow: 0 20px 40px rgba(0,0,0,0.12); transform: scale(0.95);
            transition: all 0.3s ease; border: 1px solid var(--student-border); font-family: 'Poppins', sans-serif;
            max-height: 90vh; overflow-y: auto;
        }
        .custom-modal-overlay.active .custom-modal-card { transform: scale(1); }
        .modal-header-icon {
            width: 54px; height: 54px; border-radius: 14px; display: grid; place-items: center;
            font-size: 1.4rem; margin-bottom: 16px;
        }
        .icon-add { background: var(--student-primary-soft); color: var(--student-primary); }
        .icon-edit { background: #e9f2ff; color: #3875c5; }
        .icon-delete { background: #f8e9e9; color: #b34d4d; }
        .custom-modal-card h3 { margin: 0 0 6px; font-size: 1.2rem; color: var(--student-ink); }
        .custom-modal-card p { margin: 0 0 18px; color: var(--student-muted); font-size: 0.85rem; line-height: 1.5; }
        
        .form-group { margin-bottom: 14px; text-align: left; }
        .form-group label { display: block; font-size: 0.82rem; font-weight: 600; margin-bottom: 5px; color: var(--student-ink); }
        .custom-input {
            width: 100%; padding: 10px 13px; border: 1px solid #cfddd6; border-radius: 10px;
            font-family: 'Poppins', sans-serif; font-size: 0.88rem; outline: none; box-sizing: border-box;
            background: #fff;
        }
        .custom-input:focus { border-color: var(--student-primary); box-shadow: 0 0 0 4px rgba(23, 116, 85, .12); }
        
        .modal-actions { display: flex; gap: 12px; margin-top: 22px; }
        .btn-modal { flex: 1; padding: 11px; border-radius: 10px; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 0.86rem; cursor: pointer; border: none; }
        .btn-cancel { background: #f1f5f3; color: var(--student-muted); }
        .btn-cancel:hover { background: #e2e8e4; color: var(--student-ink); }
        .btn-confirm-add { background: var(--student-primary); color: #fff; }
        .btn-confirm-add:hover { background: #125e44; }
        .btn-confirm-edit { background: #3875c5; color: #fff; }
        .btn-confirm-delete { background: #b34d4d; color: #fff; }

        .checkbox-group { display: flex; align-items: center; gap: 8px; margin-top: 10px; }
        .checkbox-group input { width: 18px; height: 18px; accent-color: var(--student-primary); cursor: pointer; }
        .checkbox-group label { margin: 0; cursor: pointer; font-weight: 500; }

        /* Sistem JP Info & Tabs */
        .jp-info-banner {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px;
            padding: 16px 24px; background: #f8fafc; border-bottom: 1px solid #e2e8f0;
        }
        .jp-info-box {
            display: flex; align-items: center; gap: 12px; background: #fff;
            padding: 12px 16px; border-radius: 12px; border: 1px solid #e2e8f0;
        }
        .jp-info-icon {
            width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.85rem; flex-shrink: 0;
        }
        .jp-tab-bar {
            display: flex; align-items: center; gap: 8px; padding: 14px 24px;
            background: #fff; border-bottom: 1px solid #edf2f7; flex-wrap: wrap;
        }
        .jp-tab-btn {
            padding: 7px 15px; border-radius: 8px; border: 1px solid #e2e8f0;
            background: #f8fafc; color: #475569; font-family: 'Poppins', sans-serif;
            font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .jp-tab-btn:hover { background: #f1f5f9; }
        .jp-tab-btn.active {
            background: var(--student-primary); color: #fff; border-color: var(--student-primary);
            box-shadow: 0 2px 8px rgba(23, 116, 85, .2);
        }
        .badge-jenjang {
            display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px;
            border-radius: 6px; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.02em;
        }
        .badge-sd { background: #fee2e2; color: #b91c1c; }
        .badge-smp { background: #dbeafe; color: #1d4ed8; }
        .badge-sma { background: #ede9fe; color: #6d28d9; }
        .badge-tk { background: #fef3c7; color: #b45309; }
        .badge-umum { background: #f1f5f9; color: #475569; }
        .jp-calc-preview {
            background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46;
            padding: 10px 14px; border-radius: 10px; font-size: 0.8rem; margin-bottom: 14px;
            display: flex; align-items: center; gap: 8px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container admin-students-page">
        <x-sidebar_siakad />

        <main class="main-content">
            <x-siakad.topbar title="Referensi Akademik" description="Kelola data Tahun Ajaran & Jam Pelajaran berbasis JP." position="Admin SIAKAD" initials="AD" />

            <div class="students-content">
                <section class="students-heading">
                    <div>
                        <span class="section-eyebrow"><i class="fa-solid fa-database"></i> Referensi Data</span>
                        <h1>Data Akademik & Sistem JP</h1>
                        <p>Kelola pengaturan Tahun Ajaran serta pemetaan Jam Pelajaran (JP) per jenjang sekolah.</p>
                    </div>
                </section>

                <!-- BAGIAN TAHUN AJARAN -->
                <section class="students-card" style="margin-bottom: 36px;">
                    <div class="card-header">
                        <div>
                            <h2>Tahun Ajaran</h2>
                            <p>Daftar tahun ajaran yang tersedia di sistem.</p>
                        </div>
                        <button class="btn-add-ref" onclick="openModal('addTahunModal')"><i class="fa-solid fa-plus"></i> Tambah Tahun</button>
                    </div>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th class="number-column">No.</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th class="action-column">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($data_tahun) > 0)
                                    @foreach($data_tahun as $index => $t)
                                        <tr>
                                            <td class="number-column">{{ $index + 1 }}</td>
                                            <td><strong>{{ $t->nama }}</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($t->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($t->tanggal_selesai)->format('d M Y') }}</td>
                                            <td>
                                                @if($t->aktif)
                                                    <span class="status-badge active"><i class="fa-solid fa-check"></i> Aktif</span>
                                                @else
                                                    <span class="status-badge inactive"><i class="fa-solid fa-xmark"></i> Non-Aktif</span>
                                                @endif
                                            </td>
                                            <td class="action-column">
                                                <div class="action-btns">
                                                    <button class="btn-action-icon btn-action-edit" onclick="openEditTahun({{ $t->id }}, '{{ $t->nama }}', '{{ $t->tanggal_mulai }}', '{{ $t->tanggal_selesai }}', {{ $t->aktif ? 'true' : 'false' }})">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn-action-icon btn-action-delete" onclick="openDeleteTahun({{ $t->id }}, '{{ $t->nama }}')">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="empty-row"><td colspan="5"><i class="fa-solid fa-folder-open"></i> Belum ada data Tahun Ajaran.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- BAGIAN JAM PELAJARAN (SISTEM JP PER JENJANG) -->
                <section class="students-card">
                    <div class="card-header" style="flex-wrap: wrap; gap: 12px;">
                        <div>
                            <h2>Jam Pelajaran & Jam Istirahat</h2>
                            <p>Pemetaan blok waktu pelajaran dan istirahat berdasarkan jenjang sekolah terpilih.</p>
                        </div>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <button class="btn-gen-jp" onclick="openGenerateJpModal()">
                                <i class="fa-solid fa-wand-magic-sparkles"></i> Generate Paket JP Otomatis
                            </button>
                            <button class="btn-add-break" onclick="openAddIstirahatModal()">
                                <i class="fa-solid fa-mug-hot"></i> Atur Jam Istirahat
                            </button>
                            <button class="btn-add-ref" onclick="openAddJamModal()">
                                <i class="fa-solid fa-plus"></i> Tambah Jam Satuan
                            </button>
                        </div>
                    </div>

                    <!-- Banner Informasi Standar JP -->
                    <div class="jp-info-banner">
                        <div class="jp-info-box">
                            <div class="jp-info-icon badge-sd">SD</div>
                            <div>
                                <div style="font-size: 0.82rem; font-weight: 700; color: #1e293b;">Jenjang SD (Kelas 1 - 6)</div>
                                <div style="font-size: 0.76rem; color: #64748b;">Standar: <strong>1 JP = 35 Menit</strong> (2 JP = 70 Menit)</div>
                            </div>
                        </div>
                        <div class="jp-info-box">
                            <div class="jp-info-icon badge-smp">SMP</div>
                            <div>
                                <div style="font-size: 0.82rem; font-weight: 700; color: #1e293b;">Jenjang SMP (Kelas 7 - 9)</div>
                                <div style="font-size: 0.76rem; color: #64748b;">Standar: <strong>1 JP = 45 Menit</strong> (2 JP = 90 Menit)</div>
                            </div>
                        </div>
                        <div class="jp-info-box">
                            <div class="jp-info-icon badge-tk">TK</div>
                            <div>
                                <div style="font-size: 0.82rem; font-weight: 700; color: #1e293b;">Jenjang TK (TK A & TK B)</div>
                                <div style="font-size: 0.76rem; color: #64748b;"><strong>Non-JP</strong> (Rentang waktu sesi bebas, tidak dihitung per JP)</div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Tab per Jenjang (Tanpa Tab Campuran Semua Jenjang) -->
                    <div class="jp-tab-bar">
                        @foreach($data_sekolah ?? [] as $s)
                            @php
                                $kode = strtoupper(trim($s->jenis));
                                $pakaiJp = \App\Models\jam_pelajaran::pakaiSistemJp($kode);
                                $standarMenit = \App\Models\jam_pelajaran::standarMenitPerJp($kode);
                                $jmlJam = $data_jam->where('sekolah_id', $s->id)->count();
                                $badgeClass = match(strtolower($kode)) {
                                    'sd' => 'badge-sd',
                                    'smp' => 'badge-smp',
                                    'sma', 'smk' => 'badge-sma',
                                    'tk', 'paud' => 'badge-tk',
                                    default => 'badge-umum'
                                };
                            @endphp
                            <button type="button" class="jp-tab-btn {{ $loop->first ? 'active' : '' }}" onclick="filterJamJenjang('{{ $kode }}', this, '{{ $s->id }}')">
                                <span class="badge-jenjang {{ $badgeClass }}" style="font-size:0.75rem; padding:2px 7px;">{{ $kode }}</span>
                                <span style="font-weight:600;">{{ $kode }}</span>
                                @if($pakaiJp)
                                    <span style="font-size: 0.72rem; opacity: 0.85;">(1 JP = {{ $standarMenit }}m • {{ $jmlJam }} Slot)</span>
                                @else
                                    <span style="font-size: 0.72rem; opacity: 0.85;">(Non-JP • {{ $jmlJam }} Slot)</span>
                                @endif
                            </button>
                        @endforeach
                        @php $jmlUmum = $data_jam->whereNull('sekolah_id')->count(); @endphp
                        @if($jmlUmum > 0)
                            <button type="button" class="jp-tab-btn" onclick="filterJamJenjang('UMUM', this, '')">
                                <span>Umum / Lintas Jenjang ({{ $jmlUmum }} Slot)</span>
                            </button>
                        @endif
                    </div>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th class="number-column">No.</th>
                                    <th>Jenjang</th>
                                    <th>Sesi / Jam Ke-</th>
                                    <th>Rentang Waktu</th>
                                    <th>Beban & Durasi JP</th>
                                    <th class="action-column">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="jamTableBody">
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

                                            // Cek jika ada jeda istirahat otomatis dari sesi sebelumnya pada jenjang yang sama yang belum tersimpan
                                            $jedaOtomatis = null;
                                            if (isset($prevJamByJenjang[$kode])) {
                                                $jedaOtomatis = \App\Models\jam_pelajaran::deteksiJedaIstirahat(
                                                    $prevJamByJenjang[$kode]->jam_selesai,
                                                    $j->jam_mulai
                                                );
                                            }
                                            $prevJamByJenjang[$kode] = $j;
                                        @endphp

                                        @if($jedaOtomatis)
                                            <tr class="jam-row jam-gap-row" data-jenjang="{{ $kode }}" style="background: #fefce8; border-left: 3px dashed #eab308;">
                                                <td class="number-column" style="color: #ca8a04;"><i class="fa-solid fa-hourglass-half"></i></td>
                                                <td>
                                                    <span class="badge-jenjang {{ $badgeClass }}">{{ $kode }}</span>
                                                </td>
                                                <td>
                                                    <span style="color: #854d0e; font-weight: 600;"><i class="fa-regular fa-clock" style="margin-right:4px;"></i> Jeda Belum Tersimpan</span>
                                                </td>
                                                <td>
                                                    <span style="display:inline-flex; align-items:center; gap:6px; font-weight:600; color:#854d0e;">
                                                        <i class="fa-regular fa-clock"></i>
                                                        {{ $jedaOtomatis['mulai'] }} - {{ $jedaOtomatis['selesai'] }} WIB
                                                    </span>
                                                </td>
                                                <td>
                                                    <span style="background:#fef9c3; color:#854d0e; border:1px solid #fde047; padding:4px 10px; border-radius:6px; font-size:0.76rem; font-weight:600;">
                                                        Jeda Waktu ({{ $jedaOtomatis['durasi'] }} Menit)
                                                    </span>
                                                </td>
                                                <td class="action-column" style="text-align:center;">
                                                    <button type="button" class="btn-save-gap" onclick="openAddIstirahatQuick('{{ $j->sekolah_id }}', '{{ $jedaOtomatis['mulai'] }}', '{{ $jedaOtomatis['selesai'] }}', {{ $jedaOtomatis['durasi'] }})">
                                                        <i class="fa-solid fa-plus"></i> Simpan Sbg Istirahat
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif

                                        <tr class="jam-row {{ $isIstirahatRow ? 'jam-break-saved' : '' }}" data-jenjang="{{ $kode }}" style="{{ $isIstirahatRow ? 'background: #fffdf5; border-left: 3px solid #f59e0b;' : '' }}">
                                            <td class="number-column jam-row-num">{{ $index + 1 }}</td>
                                            <td>
                                                <span class="badge-jenjang {{ $badgeClass }}">
                                                    {{ $kode }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($isIstirahatRow)
                                                    <strong style="color: #b45309;"><i class="fa-solid fa-mug-hot" style="margin-right:4px;"></i> {{ $labelSesi }}</strong>
                                                @else
                                                    <strong>{{ $labelSesi }}</strong>
                                                @endif
                                            </td>
                                            <td>
                                                <span style="display:inline-flex; align-items:center; gap:6px; font-weight:600; color:{{ $isIstirahatRow ? '#b45309' : '#1e293b' }};">
                                                    <i class="fa-regular fa-clock" style="color:{{ $isIstirahatRow ? '#d97706' : 'var(--student-primary)' }}"></i>
                                                    {{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }} WIB
                                                </span>
                                            </td>
                                            <td>
                                                @if($isIstirahatRow)
                                                    <span style="background:#fef3c7; color:#b45309; border:1px solid #fde68a; padding:4px 10px; border-radius:6px; font-size:0.78rem; font-weight:700;">
                                                        <i class="fa-solid fa-mug-hot"></i> Istirahat ({{ $durasiTotal }} Menit)
                                                    </span>
                                                @elseif($pakaiJpRow)
                                                    <span style="background:#ecfdf5; color:#047857; padding:4px 10px; border-radius:6px; font-size:0.78rem; font-weight:700;">
                                                        {{ $jmlJp }} JP
                                                    </span>
                                                    <span style="font-size:0.78rem; color:#64748b; margin-left:6px;">
                                                        ({{ $durasiTotal }} Menit • @1 JP = {{ $perJp }}m)
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
                                            <td class="action-column">
                                                <div class="action-btns">
                                                    @if($isIstirahatRow)
                                                        <button class="btn-action-icon btn-action-edit" title="Edit Jam Istirahat"
                                                            onclick="openEditIstirahat({{ $j->id }}, '{{ $j->sekolah_id ?? '' }}', '{{ addslashes($labelSesi) }}', '{{ substr($j->jam_mulai, 0, 5) }}', '{{ substr($j->jam_selesai, 0, 5) }}')">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                        <button class="btn-action-icon btn-action-delete" title="Hapus Jam Istirahat"
                                                            onclick="openDeleteJam({{ $j->id }}, 'Jam Istirahat: {{ $kode }} - {{ addslashes($labelSesi) }} ({{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }})')">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn-action-icon btn-action-edit" title="Edit Jam Pelajaran"
                                                            onclick="openEditJam({{ $j->id }}, '{{ $j->sekolah_id ?? '' }}', '{{ addslashes($j->jam_ke ?? '') }}', {{ $jmlJp ?: 1 }}, {{ $perJp }}, '{{ substr($j->jam_mulai, 0, 5) }}', '{{ substr($j->jam_selesai, 0, 5) }}')">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                        <button class="btn-action-icon btn-action-delete" title="Hapus Jam Pelajaran"
                                                            onclick="openDeleteJam({{ $j->id }}, 'Jam Pelajaran: {{ $kode }} - {{ addslashes($labelSesi) }} ({{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }})')">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="empty-row"><td colspan="6"><i class="fa-solid fa-folder-open"></i> Belum ada data Jam Pelajaran. Gunakan tombol <strong>Generate Paket JP Otomatis</strong> untuk membuat jadwal jam dengan cepat.</td></tr>
                                @endif
                                <tr id="jamEmptyRow" style="display:none;" class="empty-row">
                                    <td colspan="6" style="padding: 32px 16px; text-align: center; color: var(--student-muted);">
                                        <i class="fa-solid fa-calendar-xmark" style="font-size: 2rem; margin-bottom: 10px; color: #94a3b8; display: block;"></i>
                                        <div>Belum ada data Jam Pelajaran atau Jam Istirahat untuk jenjang <strong id="jamEmptyJenjangText"></strong>.</div>
                                        <div style="font-size: 0.8rem; margin-top: 6px; color: #94a3b8;">Gunakan tombol <strong>Generate Paket JP Otomatis</strong>, <strong>Tambah Jam Satuan</strong>, atau <strong>Atur Jam Istirahat</strong>.</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <!-- MODAL GENERATE PAKET JP OTOMATIS (KHUSUS JENJANG DENGAN SISTEM JP: SD = 35m, SMP = 45m) -->
    <div class="custom-modal-overlay" id="generateJpModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon" style="background:#eff6ff; color:#1d4ed8;"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
            <h3>Generate Paket Jam Pelajaran Otomatis</h3>
            <p>Buat urutan Jam Ke-1 s/d selesai sekaligus sesuai standar JP jenjang (SD = 35 menit/JP, SMP = 45 menit/JP). <em>(Tidak berlaku untuk TK)</em>.</p>
            <form action="/sk/simpan-jam-pelajaran" method="POST">
                @csrf
                <input type="hidden" name="mode" value="generate_paket">

                <div class="form-group">
                    <label>Pilih Jenjang Sekolah (Berbasis JP)</label>
                    <select name="sekolah_id" id="genSekolahId" class="custom-input" required onchange="onGenJenjangChange()">
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

                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Durasi 1 JP (Menit)</label>
                        <input type="number" name="durasi_per_jp" id="genDurasiJp" class="custom-input" value="35" min="15" max="90" required oninput="updateGenPreview()">
                    </div>
                    <div style="flex:1;">
                        <label>Jam Mulai Pagi</label>
                        <input type="time" name="jam_awal" id="genJamAwal" class="custom-input" value="07:00" required oninput="updateGenPreview()">
                    </div>
                </div>

                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Total JP Dalam Sehari</label>
                        <select name="total_jp_harian" id="genTotalJp" class="custom-input" onchange="updateGenPreview()">
                            <option value="6">6 JP / Hari</option>
                            <option value="7">7 JP / Hari</option>
                            <option value="8" selected>8 JP / Hari</option>
                            <option value="9">9 JP / Hari</option>
                            <option value="10">10 JP / Hari</option>
                        </select>
                    </div>
                    <div style="flex:1;">
                        <label>Pola Pembuatan Baris Slot</label>
                        <select name="jp_per_sesi" id="genJpPerSesi" class="custom-input" onchange="updateGenPreview()">
                            <option value="1" selected>Per 1 JP (Jam Ke-1, Jam Ke-2, dst.)</option>
                            <option value="2">Per 2 JP (Jam Ke-1 s/d 2, dst.)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Sisipkan Jeda Istirahat Setelah</label>
                        <select name="istirahat_setelah_jp" id="genIstirahatSetelah" class="custom-input" onchange="updateGenPreview()">
                            <option value="0">Tanpa Jeda Istirahat</option>
                            <option value="3">Setelah Jam Ke-3</option>
                            <option value="4" selected>Setelah Jam Ke-4</option>
                            <option value="5">Setelah Jam Ke-5</option>
                        </select>
                    </div>
                    <div style="flex:1;">
                        <label>Durasi Istirahat (Menit)</label>
                        <input type="number" name="durasi_istirahat" id="genDurasiIstirahat" class="custom-input" value="15" min="0" max="60" oninput="updateGenPreview()">
                    </div>
                </div>

                <div class="jp-calc-preview" id="genPreviewBox">
                    <i class="fa-solid fa-circle-info"></i>
                    <span id="genPreviewText">Pilih jenjang untuk melihat simulasi rentang jam otomatis.</span>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-add"><i class="fa-solid fa-bolt"></i> Generate Sekarang</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL TAMBAH JAM SATUAN (DENGAN KALKULATOR JP OTOMATIS) -->
    <div class="custom-modal-overlay" id="addJamModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon icon-add"><i class="fa-solid fa-clock"></i></div>
            <h3>Tambah Jam Pelajaran</h3>
            <p>Pilih jenjang dan jumlah JP, maka <strong>Jam Selesai</strong> akan dihitung otomatis (SD = 35 menit/JP, SMP = 45 menit/JP).</p>
            <form action="/sk/simpan-jam-pelajaran" method="POST">
                @csrf
                <div class="form-group">
                    <label>Jenjang Sekolah</label>
                    <select name="sekolah_id" id="addSekolahId" class="custom-input" onchange="onAddJenjangChange()">
                        <option value="" data-kode="UMUM" data-pakai-jp="1" data-menit="35">-- Umum / Semua Jenjang --</option>
                        @foreach($data_sekolah ?? [] as $s)
                            @php
                                $kode = strtoupper(trim($s->jenis));
                                $pakaiJp = \App\Models\jam_pelajaran::pakaiSistemJp($kode);
                                $menit = \App\Models\jam_pelajaran::standarMenitPerJp($kode);
                            @endphp
                            <option value="{{ $s->id }}" data-kode="{{ $kode }}" data-pakai-jp="{{ $pakaiJp ? '1' : '0' }}" data-menit="{{ $menit }}">
                                {{ $kode }} {{ $pakaiJp ? '(1 JP = ' . $menit . ' Menit)' : '(Non-JP / Rentang Waktu Bebas)' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1.2;">
                        <label>Label Sesi / Jam Ke-</label>
                        <input type="text" name="jam_ke" id="addJamKe" class="custom-input" placeholder="Contoh: Jam Ke-1 / Sesi Pagi">
                    </div>
                    <div style="flex:0.8;" id="addWrapJumlahJp">
                        <label>Jumlah JP</label>
                        <select name="jumlah_jp" id="addJumlahJp" class="custom-input" onchange="hitungJamSelesaiAdd()">
                            <option value="1" selected>1 JP</option>
                            <option value="2">2 JP</option>
                            <option value="3">3 JP</option>
                            <option value="4">4 JP</option>
                        </select>
                    </div>
                    <div style="flex:0.8;" id="addWrapDurasiJp">
                        <label>Menit / 1 JP</label>
                        <input type="number" name="durasi_per_jp" id="addDurasiPerJp" class="custom-input" value="35" min="15" max="90" oninput="hitungJamSelesaiAdd()">
                    </div>
                </div>

                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="addJamMulai" class="custom-input" value="07:00" required oninput="hitungJamSelesaiAdd()">
                    </div>
                    <div style="flex:1;">
                        <label id="addLabelJamSelesai">Jam Selesai (Otomatis)</label>
                        <input type="time" name="jam_selesai" id="addJamSelesai" class="custom-input" value="07:35" required>
                    </div>
                </div>

                <div class="jp-calc-preview">
                    <i class="fa-solid fa-calculator"></i>
                    <span id="addCalcInfo">Kalkulator JP: 1 JP &times; 35 menit = 35 menit (07:00 - 07:35)</span>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-add">Simpan Jam</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT JAM -->
    <div class="custom-modal-overlay" id="editJamModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon icon-edit"><i class="fa-solid fa-clock"></i></div>
            <h3>Edit Jam Pelajaran</h3>
            <p>Ubah jenjang, jumlah JP, atau rentang waktu pelajaran.</p>
            <form id="editJamForm" method="POST">
                @csrf
                <div class="form-group">
                    <label>Jenjang Sekolah</label>
                    <select name="sekolah_id" id="ejSekolahId" class="custom-input" onchange="onEditJenjangChange()">
                        <option value="" data-kode="UMUM" data-pakai-jp="1" data-menit="35">-- Umum / Semua Jenjang --</option>
                        @foreach($data_sekolah ?? [] as $s)
                            @php
                                $kode = strtoupper(trim($s->jenis));
                                $pakaiJp = \App\Models\jam_pelajaran::pakaiSistemJp($kode);
                                $menit = \App\Models\jam_pelajaran::standarMenitPerJp($kode);
                            @endphp
                            <option value="{{ $s->id }}" data-kode="{{ $kode }}" data-pakai-jp="{{ $pakaiJp ? '1' : '0' }}" data-menit="{{ $menit }}">
                                {{ $kode }} {{ $pakaiJp ? '(1 JP = ' . $menit . ' Menit)' : '(Non-JP / Rentang Waktu Bebas)' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1.2;">
                        <label>Label Sesi / Jam Ke-</label>
                        <input type="text" name="jam_ke" id="ejJamKe" class="custom-input" placeholder="Contoh: Jam Ke-1">
                    </div>
                    <div style="flex:0.8;" id="ejWrapJumlahJp">
                        <label>Jumlah JP</label>
                        <select name="jumlah_jp" id="ejJumlahJp" class="custom-input" onchange="hitungJamSelesaiEdit()">
                            <option value="1">1 JP</option>
                            <option value="2">2 JP</option>
                            <option value="3">3 JP</option>
                            <option value="4">4 JP</option>
                        </select>
                    </div>
                    <div style="flex:0.8;" id="ejWrapDurasiJp">
                        <label>Menit / 1 JP</label>
                        <input type="number" name="durasi_per_jp" id="ejDurasiPerJp" class="custom-input" value="35" min="15" max="90" oninput="hitungJamSelesaiEdit()">
                    </div>
                </div>
                
                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="ejMulai" class="custom-input" required oninput="hitungJamSelesaiEdit()">
                    </div>
                    <div style="flex:1;">
                        <label>Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="ejSelesai" class="custom-input" required>
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-edit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL ATUR / TAMBAH JAM ISTIRAHAT -->
    <div class="custom-modal-overlay" id="addIstirahatModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon" style="background:#fef3c7; color:#b45309;"><i class="fa-solid fa-mug-hot"></i></div>
            <h3>Atur Jam Istirahat</h3>
            <p>Tentukan slot waktu istirahat (misal: istirahat pagi, istirahat sholat & makan) untuk jenjang sekolah terpilih.</p>
            <form action="/sk/simpan-jam-pelajaran" method="POST">
                @csrf
                <input type="hidden" name="mode" value="istirahat">

                <div class="form-group">
                    <label>Jenjang Sekolah</label>
                    <select name="sekolah_id" id="addIstSekolahId" class="custom-input" required>
                        @foreach($data_sekolah ?? [] as $s)
                            @php $kode = strtoupper(trim($s->jenis)); @endphp
                            <option value="{{ $s->id }}">{{ $kode }} - Sekolah Syafi'i</option>
                        @endforeach
                        <option value="">Umum / Semua Jenjang</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama / Sesi Istirahat</label>
                    <input type="text" name="jam_ke" id="addIstNama" class="custom-input" value="Istirahat" required oninput="recalcIstSummary()">
                    <div style="display:flex; gap:6px; flex-wrap:wrap; margin-top:8px;">
                        <button type="button" class="btn-chip" onclick="setIstNama('Istirahat')">Istirahat</button>
                        <button type="button" class="btn-chip" onclick="setIstNama('Istirahat Pagi')">Istirahat Pagi</button>
                        <button type="button" class="btn-chip" onclick="setIstNama('Istirahat Siang / Dhuhur')">Istirahat Siang / Dhuhur</button>
                        <button type="button" class="btn-chip" onclick="setIstNama('Istirahat Sholat & Makan')">Istirahat Sholat & Makan</button>
                    </div>
                </div>

                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="addIstMulai" class="custom-input" value="09:45" required oninput="recalcIstSelesai()">
                    </div>
                    <div style="flex:1;">
                        <label>Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="addIstSelesai" class="custom-input" value="10:15" required oninput="recalcIstDurasiManual()">
                    </div>
                </div>

                <div class="form-group">
                    <label style="margin-bottom:6px;">Pilihan Cepat Durasi Istirahat</label>
                    <div style="display:flex; gap:6px; flex-wrap:wrap;">
                        <button type="button" class="btn-chip durasi-chip-add" data-menit="15" onclick="setIstDurasi(15, this)">15 Menit</button>
                        <button type="button" class="btn-chip durasi-chip-add" data-menit="20" onclick="setIstDurasi(20, this)">20 Menit</button>
                        <button type="button" class="btn-chip durasi-chip-add active" data-menit="30" onclick="setIstDurasi(30, this)">30 Menit</button>
                        <button type="button" class="btn-chip durasi-chip-add" data-menit="45" onclick="setIstDurasi(45, this)">45 Menit</button>
                        <button type="button" class="btn-chip durasi-chip-add" data-menit="60" onclick="setIstDurasi(60, this)">60 Menit</button>
                    </div>
                </div>

                <div class="break-preview-card" id="addIstPreviewBox">
                    <i class="fa-solid fa-circle-info" style="font-size:1.1rem; flex-shrink:0;"></i>
                    <span id="addIstSummaryText">Label: <strong>Istirahat</strong> &bull; Waktu: <strong>09:45 - 10:15 WIB</strong> (Durasi: <strong>30 Menit</strong>)</span>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal" style="background:#b45309; color:#fff;"><i class="fa-solid fa-mug-hot"></i> Simpan Jam Istirahat</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT JAM ISTIRAHAT -->
    <div class="custom-modal-overlay" id="editIstirahatModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon" style="background:#fef3c7; color:#b45309;"><i class="fa-solid fa-pen-to-square"></i></div>
            <h3>Edit Jam Istirahat</h3>
            <p>Perbarui jenjang, label, atau waktu istirahat.</p>
            <form id="editIstForm" method="POST">
                @csrf
                <input type="hidden" name="mode" value="istirahat">

                <div class="form-group">
                    <label>Jenjang Sekolah</label>
                    <select name="sekolah_id" id="editIstSekolahId" class="custom-input" required>
                        @foreach($data_sekolah ?? [] as $s)
                            @php $kode = strtoupper(trim($s->jenis)); @endphp
                            <option value="{{ $s->id }}">{{ $kode }} - Sekolah Syafi'i</option>
                        @endforeach
                        <option value="">Umum / Semua Jenjang</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama / Sesi Istirahat</label>
                    <input type="text" name="jam_ke" id="editIstNama" class="custom-input" required oninput="recalcEditIstSummary()">
                    <div style="display:flex; gap:6px; flex-wrap:wrap; margin-top:8px;">
                        <button type="button" class="btn-chip" onclick="setEditIstNama('Istirahat')">Istirahat</button>
                        <button type="button" class="btn-chip" onclick="setEditIstNama('Istirahat Pagi')">Istirahat Pagi</button>
                        <button type="button" class="btn-chip" onclick="setEditIstNama('Istirahat Siang / Dhuhur')">Istirahat Siang / Dhuhur</button>
                        <button type="button" class="btn-chip" onclick="setEditIstNama('Istirahat Sholat & Makan')">Istirahat Sholat & Makan</button>
                    </div>
                </div>

                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="editIstMulai" class="custom-input" required oninput="recalcEditIstSelesai()">
                    </div>
                    <div style="flex:1;">
                        <label>Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="editIstSelesai" class="custom-input" required oninput="recalcEditIstDurasiManual()">
                    </div>
                </div>

                <div class="form-group">
                    <label style="margin-bottom:6px;">Pilihan Cepat Durasi Istirahat</label>
                    <div style="display:flex; gap:6px; flex-wrap:wrap;">
                        <button type="button" class="btn-chip durasi-chip-edit" data-menit="15" onclick="setEditIstDurasi(15, this)">15 Menit</button>
                        <button type="button" class="btn-chip durasi-chip-edit" data-menit="20" onclick="setEditIstDurasi(20, this)">20 Menit</button>
                        <button type="button" class="btn-chip durasi-chip-edit" data-menit="30" onclick="setEditIstDurasi(30, this)">30 Menit</button>
                        <button type="button" class="btn-chip durasi-chip-edit" data-menit="45" onclick="setEditIstDurasi(45, this)">45 Menit</button>
                        <button type="button" class="btn-chip durasi-chip-edit" data-menit="60" onclick="setEditIstDurasi(60, this)">60 Menit</button>
                    </div>
                </div>

                <div class="break-preview-card" id="editIstPreviewBox">
                    <i class="fa-solid fa-circle-info" style="font-size:1.1rem; flex-shrink:0;"></i>
                    <span id="editIstSummaryText">Durasi: 30 Menit</span>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal" style="background:#b45309; color:#fff;"><i class="fa-solid fa-check"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL TAMBAH TAHUN -->
    <div class="custom-modal-overlay" id="addTahunModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon icon-add"><i class="fa-solid fa-calendar-plus"></i></div>
            <h3>Tambah Tahun Ajaran</h3>
            <form action="/sk/simpan-tahun-ajaran" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Tahun Ajaran (Contoh: 2026/2027 Ganjil)</label>
                    <input type="text" name="nama" class="custom-input" required>
                </div>
                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Mulai</label>
                        <input type="date" name="tanggal_mulai" class="custom-input" required>
                    </div>
                    <div style="flex:1;">
                        <label>Selesai</label>
                        <input type="date" name="tanggal_selesai" class="custom-input" required>
                    </div>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" name="aktif" id="chkAktifAdd" value="1" checked>
                    <label for="chkAktifAdd">Tandai sebagai Tahun Ajaran Aktif</label>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-add">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT TAHUN -->
    <div class="custom-modal-overlay" id="editTahunModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon icon-edit"><i class="fa-solid fa-calendar-check"></i></div>
            <h3>Edit Tahun Ajaran</h3>
            <form id="editTahunForm" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Tahun Ajaran</label>
                    <input type="text" name="nama" id="etNama" class="custom-input" required>
                </div>
                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Mulai</label>
                        <input type="date" name="tanggal_mulai" id="etMulai" class="custom-input" required>
                    </div>
                    <div style="flex:1;">
                        <label>Selesai</label>
                        <input type="date" name="tanggal_selesai" id="etSelesai" class="custom-input" required>
                    </div>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" name="aktif" id="etAktif" value="1">
                    <label for="etAktif">Tandai sebagai Tahun Ajaran Aktif</label>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-edit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL HAPUS UMUM -->
    <div class="custom-modal-overlay" id="deleteModal">
        <div class="custom-modal-card" style="text-align: center;">
            <div class="modal-header-icon icon-delete" style="margin: 0 auto 20px;"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h3>Konfirmasi Hapus</h3>
            <p>Anda yakin ingin menghapus <strong><span id="delName"></span></strong>? Data tidak dapat dipulihkan.</p>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                <button type="button" class="btn-modal btn-confirm-delete" id="btnConfirmDelete">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <script>
        const modals = document.querySelectorAll('.custom-modal-overlay');
        let deleteTargetUrl = '';
        let currentJenjang = '';
        let currentSekolahId = '';

        function closeAllModals() {
            modals.forEach(m => m.classList.remove('active'));
        }

        function openModal(id) {
            closeAllModals();
            const el = document.getElementById(id);
            if (el) el.classList.add('active');
        }

        // Helper konversi waktu ke menit
        function timeToMinutes(str) {
            if (!str || !str.includes(':')) return 0;
            const p = str.split(':');
            return parseInt(p[0], 10) * 60 + parseInt(p[1], 10);
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

        // Filter Tab Jenjang pada Tabel Jam Pelajaran (Filter ketat per jenjang)
        function filterJamJenjang(kode, btn, sekolahId) {
            currentJenjang = kode;
            currentSekolahId = sekolahId || '';

            document.querySelectorAll('.jp-tab-btn').forEach(b => b.classList.remove('active'));
            if (btn) btn.classList.add('active');

            let visibleIndex = 1;
            let totalVisible = 0;
            document.querySelectorAll('.jam-row').forEach(row => {
                const rowJenjang = row.getAttribute('data-jenjang');
                if (rowJenjang === kode) {
                    row.style.display = '';
                    totalVisible++;
                    if (!row.classList.contains('jam-gap-row')) {
                        const numCell = row.querySelector('.jam-row-num');
                        if (numCell) numCell.textContent = visibleIndex++;
                    }
                } else {
                    row.style.display = 'none';
                }
            });

            const emptyRow = document.getElementById('jamEmptyRow');
            if (emptyRow) {
                if (totalVisible === 0) {
                    emptyRow.style.display = '';
                    const textEl = document.getElementById('jamEmptyJenjangText');
                    if (textEl) textEl.textContent = kode;
                } else {
                    emptyRow.style.display = 'none';
                }
            }
        }

        // Open Modal Handlers dengan Pre-Select Jenjang Aktif
        function openGenerateJpModal() {
            if (currentSekolahId) {
                const sel = document.getElementById('genSekolahId');
                if (sel) {
                    sel.value = currentSekolahId;
                    onGenJenjangChange();
                }
            }
            openModal('generateJpModal');
        }

        function openAddJamModal() {
            if (currentSekolahId) {
                const sel = document.getElementById('addSekolahId');
                if (sel) {
                    sel.value = currentSekolahId;
                    onAddJenjangChange();
                }
            }
            openModal('addJamModal');
        }

        function openAddIstirahatModal() {
            if (currentSekolahId) {
                const sel = document.getElementById('addIstSekolahId');
                if (sel) sel.value = currentSekolahId;
            }
            recalcIstSelesai();
            openModal('addIstirahatModal');
        }

        function openAddIstirahatQuick(sekolahId, jamMulai, jamSelesai, durasi) {
            if (sekolahId) {
                const sel = document.getElementById('addIstSekolahId');
                if (sel) sel.value = sekolahId;
            }
            document.getElementById('addIstMulai').value = jamMulai;
            document.getElementById('addIstSelesai').value = jamSelesai;
            recalcIstDurasiManual();
            openModal('addIstirahatModal');
        }

        // FUNGSI LOGIKA JAM ISTIRAHAT (TAMBAH)
        let currentAddIstDurasi = 30;

        function setIstNama(nama) {
            document.getElementById('addIstNama').value = nama;
            recalcIstSummary();
        }

        function setIstDurasi(menit, btn) {
            currentAddIstDurasi = menit;
            document.querySelectorAll('.durasi-chip-add').forEach(c => c.classList.remove('active'));
            if (btn) btn.classList.add('active');
            recalcIstSelesai();
        }

        function recalcIstSelesai() {
            const mulai = document.getElementById('addIstMulai').value || '09:45';
            const selesai = addMinutesToTime(mulai, currentAddIstDurasi);
            document.getElementById('addIstSelesai').value = selesai;
            recalcIstSummary();
        }

        function recalcIstDurasiManual() {
            const mulai = document.getElementById('addIstMulai').value;
            const selesai = document.getElementById('addIstSelesai').value;
            if (mulai && selesai) {
                const m = timeToMinutes(mulai);
                const s = timeToMinutes(selesai);
                let diff = s - m;
                if (diff < 0) diff += 1440;
                currentAddIstDurasi = diff;
                document.querySelectorAll('.durasi-chip-add').forEach(c => {
                    if (parseInt(c.getAttribute('data-menit'), 10) === diff) {
                        c.classList.add('active');
                    } else {
                        c.classList.remove('active');
                    }
                });
            }
            recalcIstSummary();
        }

        function recalcIstSummary() {
            const nama = document.getElementById('addIstNama').value || 'Istirahat';
            const mulai = document.getElementById('addIstMulai').value || '09:45';
            const selesai = document.getElementById('addIstSelesai').value || '10:15';
            const m = timeToMinutes(mulai);
            const s = timeToMinutes(selesai);
            let diff = s - m;
            if (diff < 0) diff += 1440;
            const previewEl = document.getElementById('addIstSummaryText');
            if (previewEl) {
                previewEl.innerHTML = `Label: <strong>${nama}</strong> &bull; Waktu: <strong>${mulai} - ${selesai} WIB</strong> (Durasi: <strong>${diff} Menit</strong>)`;
            }
        }

        // FUNGSI LOGIKA JAM ISTIRAHAT (EDIT)
        let currentEditIstDurasi = 30;

        function openEditIstirahat(id, sekolahId, jamKe, mulai, selesai) {
            document.getElementById('editIstForm').action = "/sk/update-jam-pelajaran/" + id;
            document.getElementById('editIstSekolahId').value = sekolahId || '';
            document.getElementById('editIstNama').value = jamKe || 'Istirahat';
            document.getElementById('editIstMulai').value = mulai;
            document.getElementById('editIstSelesai').value = selesai;
            recalcEditIstDurasiManual();
            openModal('editIstirahatModal');
        }

        function setEditIstNama(nama) {
            document.getElementById('editIstNama').value = nama;
            recalcEditIstSummary();
        }

        function setEditIstDurasi(menit, btn) {
            currentEditIstDurasi = menit;
            document.querySelectorAll('.durasi-chip-edit').forEach(c => c.classList.remove('active'));
            if (btn) btn.classList.add('active');
            recalcEditIstSelesai();
        }

        function recalcEditIstSelesai() {
            const mulai = document.getElementById('editIstMulai').value || '09:45';
            const selesai = addMinutesToTime(mulai, currentEditIstDurasi);
            document.getElementById('editIstSelesai').value = selesai;
            recalcEditIstSummary();
        }

        function recalcEditIstDurasiManual() {
            const mulai = document.getElementById('editIstMulai').value;
            const selesai = document.getElementById('editIstSelesai').value;
            if (mulai && selesai) {
                const m = timeToMinutes(mulai);
                const s = timeToMinutes(selesai);
                let diff = s - m;
                if (diff < 0) diff += 1440;
                currentEditIstDurasi = diff;
                document.querySelectorAll('.durasi-chip-edit').forEach(c => {
                    if (parseInt(c.getAttribute('data-menit'), 10) === diff) {
                        c.classList.add('active');
                    } else {
                        c.classList.remove('active');
                    }
                });
            }
            recalcEditIstSummary();
        }

        function recalcEditIstSummary() {
            const nama = document.getElementById('editIstNama').value || 'Istirahat';
            const mulai = document.getElementById('editIstMulai').value || '09:45';
            const selesai = document.getElementById('editIstSelesai').value || '10:15';
            const m = timeToMinutes(mulai);
            const s = timeToMinutes(selesai);
            let diff = s - m;
            if (diff < 0) diff += 1440;
            const previewEl = document.getElementById('editIstSummaryText');
            if (previewEl) {
                previewEl.innerHTML = `Label: <strong>${nama}</strong> &bull; Waktu: <strong>${mulai} - ${selesai} WIB</strong> (Durasi: <strong>${diff} Menit</strong>)`;
            }
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
            if(deleteTargetUrl) window.location.href = deleteTargetUrl;
        });

        modals.forEach(m => {
            m.addEventListener('click', function(e) {
                if(e.target === m) closeAllModals();
            });
        });

        // Trigger filter pada tab pertama saat pertama kali dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const activeBtn = document.querySelector('.jp-tab-btn.active') || document.querySelector('.jp-tab-btn');
            if (activeBtn) {
                activeBtn.click();
            }
        });
    </script>

    <x-warning />
</body>
</html>
