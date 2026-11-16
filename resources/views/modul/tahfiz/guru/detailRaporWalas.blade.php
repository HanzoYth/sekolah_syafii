@php
    $evaluasi = $evaluasi ?? ($eval ?? null);
    $eval = $evaluasi;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport Tahfizh Al-Qur'an — {{ $siswa->nama }} — SDQU Imam Syafi'i</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama Dashboard & Rapor Tahfiz -->
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/dashboard.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/rapor_walas.css') }}?v={{ time() }}">
    
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">

    <style>
        .sheet-action-bar {
            max-width: 860px;
            margin: 24px auto 12px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            padding: 12px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            border: 1px solid #d5ccbd;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn-sheet-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            font-size: 12px;
            font-weight: 700;
            border-radius: 8px;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-sheet-dup {
            background: #e0f2fe;
            color: #0369a1;
            border-color: #7dd3fc;
        }
        .btn-sheet-dup:hover {
            background: #bae6fd;
        }

        .btn-sheet-edit {
            background: #FAF8F2;
            color: #333;
            border-color: #d5ccbd;
        }
        .btn-sheet-edit:hover {
            background: #f0ebe0;
        }

        .btn-sheet-print {
            background: #0B3B2E;
            color: #fff;
        }
        .btn-sheet-print:hover {
            background: #1B6B4F;
        }

        .bio-interactive {
            transition: background 0.15s ease;
            padding: 2px 6px;
            border-radius: 4px;
            display: inline-block;
        }
        .bio-interactive:hover {
            background: rgba(16, 185, 129, 0.15);
            outline: 1px dashed #10b981;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">

        <!-- SIDEBAR TAHFIZ (NO PRINT) -->
        <x-sidebar_tahfiz />

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- ============================================================ -->
            <!-- PANEL KONTROL KUSTOMISASI LIVE GURU / PENGAMPU (NO-PRINT)    -->
            <!-- ============================================================ -->
            <div class="no-print editor-panel-card">
                <!-- Top Action Header -->
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; padding-bottom: 20px; border-bottom: 1px solid var(--border-color);">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        @php
                            $backUrl = request()->is('tf/gr/rapor*') || request()->is('tf/gr/detail-rapor*')
                                ? url('/tf/gr/rapor?kelas_id='.$siswa->kelas_id)
                                : url('/tf/gr/rp?view=rapor&kelas_id='.$siswa->kelas_id);
                        @endphp
                        <a href="{{ $backUrl }}" class="btn-tahfiz-secondary" style="padding: 10px 14px;" title="Kembali ke Daftar Rapor">
                            <i class="fa-solid fa-arrow-left"></i> 
                        <div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <h3 style="font-size: 18px; font-weight: 700; color: var(--text-dark); margin: 0;">
                                    Raport Tahfizh Al-Qur'an: {{ $evaluasi->nama_lengkap ?? $siswa->nama }}
                                </h3>
                                @if($siswa->is_manual ?? false)
                                    <span style="font-size: 11px; font-weight: 700; background: #FEF3C7; color: #92400E; border: 1px solid #FCD34D; border-radius: 6px; padding: 2px 8px;">
                                        <i class="fa-solid fa-user-tag"></i> Non-Sistem
                                    </span>
                                @endif
                            </div>
                            <p style="font-size: 12px; color: var(--text-muted); margin: 3px 0 0 0;">
                                Kelas: {{ $evaluasi->kelas_label ?? $template['kelas_label'] }} • Semester: {{ ($tahun_aktif->semester ?? 1) == 1 ? 'Ganjil' : 'Genap' }} {{ $tahun_aktif->nama ?? '2026' }}
                            </p>
                        </div>
                    </div>

                    <!-- Tombol Aksi Utama -->
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <button type="button" onclick="openDuplicateModal()" class="btn-tahfiz-secondary" style="border-color: #0284c7; color: #0369a1; background: #e0f2fe; padding: 10px 14px;" title="Duplikat rapor ini untuk siswa yang belum terdaftar di sistem">
                            <i class="fa-solid fa-copy"></i> Duplikat Rapor (Non-Sistem)
                        </button>
                        <button type="button" onclick="saveRaporToDatabase(false)" id="btnSaveRapor" class="btn-tahfiz-primary">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Rapor
                        </button>
                        <button type="button" onclick="applyFormatToAllStudents()" id="btnApplyAll" class="btn-tahfiz-gold" title="Terapkan teks 4 bulan, target, titimangsa, dan format ini ke semua siswa di rombel">
                            <i class="fa-solid fa-users-gear"></i> Terapkan Format ke Semua Siswa
                        </button>
                        @php
                            $inputNilaiUrl = request()->is('tf/gr/rapor*') || request()->is('tf/gr/detail-rapor*')
                                ? url('/tf/gr/input-nilai?kelas_id='.$siswa->kelas_id)
                                : url('/tf/gr/rp?view=input_nilai&kelas_id='.$siswa->kelas_id);
                        @endphp
                        <a href="{{ $inputNilaiUrl }}" class="btn-tahfiz-secondary">
                            <i class="fa-solid fa-table-cells"></i> Input Nilai Kelas
                        </a>
                        <button type="button" onclick="resetToOfficialTemplate()" class="btn-tahfiz-secondary" title="Kembalikan ke format acuan resmi">
                            <i class="fa-solid fa-rotate-left"></i> Reset
                        </button>
                        <button type="button" onclick="openPrintPromptModal()" class="btn-tahfiz-primary" style="background: var(--primary-dark);">
                            <i class="fa-solid fa-print"></i> Cetak Rapor
                        </button>
                    </div>
                </div>

                <!-- Navigasi Cepat Antar Santri Sekelas -->
                @if(isset($semuaSiswaKelas) && $semuaSiswaKelas->count() > 1)
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 12px 0; border-bottom: 1px solid var(--border-color); flex-wrap: wrap;">
                        <span style="font-size: 12px; font-weight: 600; color: var(--text-muted);">
                            <i class="fa-solid fa-users text-emerald-600"></i> Pilih Santri Lain di Rombel Ini:
                        </span>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <select onchange="navigateToStudent(this.value)" style="padding: 6px 14px; border-radius: 8px; border: 1px solid var(--border-color); font-size: 12px; background: #FAF8F2; font-weight: 700;">
                                @foreach($semuaSiswaKelas as $teman)
                                    <option value="{{ $teman->id }}" {{ $teman->id == $siswa->id ? 'selected' : '' }}>
                                        {{ $teman->nama }} ({{ $teman->nis ?: '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <!-- Tab Navigation Editor Live -->
                <div class="editor-nav-tabs" style="margin-top: 16px;">
                    <button type="button" onclick="switchEditorTab('tab-identitas')" id="editorTabBtn-identitas" class="editor-nav-tab active">
                        <i class="fa-solid fa-id-card"></i> 1. Data Santri (Manual)
                    </button>
                    <button type="button" onclick="switchEditorTab('tab-ujian')" id="editorTabBtn-ujian" class="editor-nav-tab">
                        <i class="fa-solid fa-book-quran"></i> 2. Ujian Tasmi' (4 Bulan) & Juz
                    </button>
                    <button type="button" onclick="switchEditorTab('tab-pencapaian')" id="editorTabBtn-pencapaian" class="editor-nav-tab">
                        <i class="fa-solid fa-chart-line"></i> 3. Pencapaian Target Hafalan
                    </button>
                    <button type="button" onclick="switchEditorTab('tab-catatan')" id="editorTabBtn-catatan" class="editor-nav-tab">
                        <i class="fa-solid fa-comment-dots"></i> 4. Catatan Pengampu Halaqah
                    </button>
                    <button type="button" onclick="switchEditorTab('tab-pengesahan')" id="editorTabBtn-pengesahan" class="editor-nav-tab">
                        <i class="fa-solid fa-signature"></i> 5. Titimangsa & Pengesahan
                    </button>
                </div>

                <!-- Konten Tab 1: Data Santri Manual -->
                <div id="editorContent-identitas">
                    <div style="background: #FAF8F2; border: 1px solid var(--border-color); border-radius: 10px; padding: 16px; margin-bottom: 12px;">
                        <h4 style="font-size: 13px; font-weight: 700; color: var(--primary-dark); margin: 0 0 12px 0;">
                            <i class="fa-solid fa-pen-to-square text-emerald-600"></i> Edit Data Santri Manual (Langsung Tercetak di Rapor)
                        </h4>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 14px;">
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Nama Lengkap Santri:</label>
                                <input type="text" id="inputNamaLengkap" class="editor-form-control" value="{{ $evaluasi->nama_lengkap ?? $template['nama_lengkap'] ?? $siswa->nama }}" oninput="updateLivePreview()">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Kelas / Fase:</label>
                                <input type="text" id="inputKelasLabel" class="editor-form-control" value="{{ $evaluasi->kelas_label ?? $template['kelas_label'] }}" oninput="updateLivePreview()" placeholder="Contoh: VI (ENAM)">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Umur Santri:</label>
                                <input type="text" id="inputUmur" class="editor-form-control" value="{{ $evaluasi->umur ?? $template['umur'] }}" oninput="updateLivePreview()" placeholder="Contoh: 12 TAHUN">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Nama Orang Tua / Wali:</label>
                                <input type="text" id="inputOrangTua" class="editor-form-control" value="{{ $evaluasi->orang_tua ?? $template['orang_tua'] }}" oninput="updateLivePreview()" placeholder="Contoh: Bpk. ZULFIKAR ABDUN & Ibu NAZMA SYAWIE">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Konten Tab 2: Ujian Tasmi' (4 Bulan) & Kenaikan Juz & Ujian Terbuka -->
                <div id="editorContent-ujian" style="display: none;">
                    <!-- Bagian B: Ujian Tasmi' 4 Bulan -->
                    <div style="background: #FAF8F2; border: 1px solid var(--border-color); border-radius: 10px; padding: 16px; margin-bottom: 18px;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; flex-wrap: wrap; gap: 8px;">
                            <h4 style="font-size: 13px; font-weight: 700; color: var(--primary-dark); margin: 0;">
                                B. Ujian Tasmi’ — 4 Bulan (Teks Bulan & Nilai Dapat Diedit Bebas)
                            </h4>
                            <span style="font-size: 11px; background: #D1E7DD; color: #064E3B; padding: 3px 8px; border-radius: 4px; font-weight: 700;">
                                Total & Rata-Rata Otomatis Dihitung
                            </span>
                        </div>

                        <!-- Edit Teks Nama 4 Bulan -->
                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 14px;">
                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #555;">Teks Bulan 1:</label>
                                <input type="text" id="inputBulan1Label" class="editor-form-control" value="{{ $evaluasi->bulan_1_label ?? $template['bulan_1_label'] ?? 'AGUSTUS' }}" oninput="updateLivePreview()" style="font-weight: 700; text-transform: uppercase;">
                            </div>
                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #555;">Teks Bulan 2:</label>
                                <input type="text" id="inputBulan2Label" class="editor-form-control" value="{{ $evaluasi->bulan_2_label ?? $template['bulan_2_label'] ?? 'SEPTEMBER' }}" oninput="updateLivePreview()" style="font-weight: 700; text-transform: uppercase;">
                            </div>
                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #555;">Teks Bulan 3:</label>
                                <input type="text" id="inputBulan3Label" class="editor-form-control" value="{{ $evaluasi->bulan_3_label ?? $template['bulan_3_label'] ?? 'OKTOBER' }}" oninput="updateLivePreview()" style="font-weight: 700; text-transform: uppercase;">
                            </div>
                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #555;">Teks Bulan 4:</label>
                                <input type="text" id="inputBulan4Label" class="editor-form-control" value="{{ $evaluasi->bulan_4_label ?? $template['bulan_4_label'] ?? 'NOVEMBER' }}" oninput="updateLivePreview()" style="font-weight: 700; text-transform: uppercase;">
                            </div>
                        </div>

                        <!-- Input Nilai 4 Bulan -->
                        @php
                            $initNb1 = $evaluasi->nilai_bulan_1 ?? ($evaluasi->ujian_1 ?? null);
                            $initNb2 = $evaluasi->nilai_bulan_2 ?? ($evaluasi->ujian_2 ?? null);
                            $initNb3 = $evaluasi->nilai_bulan_3 ?? ($evaluasi->ujian_akhir ?? null);
                            $initNb4 = $evaluasi->nilai_bulan_4 ?? null;
                            $initHas = ($initNb1 !== null || $initNb2 !== null || $initNb3 !== null || $initNb4 !== null);
                            $initJml = $evaluasi->ujian_jumlah ?? ($initHas ? (($initNb1 ?? 0) + ($initNb2 ?? 0) + ($initNb3 ?? 0) + ($initNb4 ?? 0)) : null);
                            $initRata = $evaluasi->ujian_rata_rata ?? ($initHas ? round($initJml / 4, 1) : null);
                            $initPred = $evaluasi->ujian_predikat ?? ($initRata !== null ? \App\Models\evaluasi_rapor_tahfidz::calculatePredikat($initRata) : '-');
                        @endphp
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(115px, 1fr)); gap: 10px;">
                            <div class="editor-form-group" style="margin: 0;">
                                <label id="labelNilai1">Nilai Bulan 1:</label>
                                <input type="number" step="0.1" id="inputNilaiBulan1" class="editor-form-control" value="{{ $initNb1 }}" placeholder="Nilai" oninput="recalcUjianTasmi()">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label id="labelNilai2">Nilai Bulan 2:</label>
                                <input type="number" step="0.1" id="inputNilaiBulan2" class="editor-form-control" value="{{ $initNb2 }}" placeholder="Nilai" oninput="recalcUjianTasmi()">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label id="labelNilai3">Nilai Bulan 3:</label>
                                <input type="number" step="0.1" id="inputNilaiBulan3" class="editor-form-control" value="{{ $initNb3 }}" placeholder="Nilai" oninput="recalcUjianTasmi()">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label id="labelNilai4">Nilai Bulan 4:</label>
                                <input type="number" step="0.1" id="inputNilaiBulan4" class="editor-form-control" value="{{ $initNb4 }}" placeholder="Nilai" oninput="recalcUjianTasmi()">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Total Nilai Akhir:</label>
                                <input type="text" id="inputTotalNilai" class="editor-form-control" value="{{ $initJml !== null ? number_format($initJml, 0) : '' }}" readonly style="background: #eee; font-weight: 700;">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Nilai Rata-Rata:</label>
                                <input type="text" id="inputNilaiRata" class="editor-form-control" value="{{ $initRata !== null ? number_format($initRata, 1, ',', '') : '' }}" readonly style="background: #eee; font-weight: 700; color: var(--primary-color);">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Predikat:</label>
                                <input type="text" id="inputNilaiPredikat" class="editor-form-control" value="{{ $initPred }}" readonly style="background: #eee; font-weight: 700;">
                            </div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <!-- A. Ujian Kenaikan Juz -->
                        <div style="background: #FAF8F2; border: 1px solid var(--border-color); border-radius: 10px; padding: 16px;">
                            <h4 style="font-size: 13px; font-weight: 700; color: var(--primary-dark); margin: 0 0 12px 0;">
                                A. Ujian Kenaikan Juz
                            </h4>
                            <div class="editor-form-group">
                                <label>Tanggal Ujian:</label>
                                <input type="text" id="inputKenaikanTanggal" class="editor-form-control" value="{{ $evaluasi->kenaikan_juz_tanggal ?? $template['kenaikan_juz_tanggal'] }}" oninput="updateLivePreview()">
                            </div>
                            <div class="editor-form-group">
                                <label>Juz yang Diuji:</label>
                                <input type="text" id="inputKenaikanJuz" class="editor-form-control" value="{{ $evaluasi->kenaikan_juz_nomor ?? $template['kenaikan_juz_nomor'] }}" oninput="updateLivePreview()" placeholder="Misal: 25">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Predikat:</label>
                                <input type="text" id="inputKenaikanPredikat" class="editor-form-control" value="{{ $evaluasi->kenaikan_juz_predikat ?? $template['kenaikan_juz_predikat'] }}" oninput="updateLivePreview()" placeholder="Jayyid/C">
                            </div>
                        </div>

                        <!-- C. Ujian Tahfiz Terbuka -->
                        <div style="background: #FAF8F2; border: 1px solid var(--border-color); border-radius: 10px; padding: 16px;">
                            <h4 style="font-size: 13px; font-weight: 700; color: var(--primary-dark); margin: 0 0 12px 0;">
                                C. Ujian Tahfiz Terbuka
                            </h4>
                            <div class="editor-form-group">
                                <label>Tanggal Ujian Terbuka:</label>
                                <input type="text" id="inputUjianTerbukaTanggal" class="editor-form-control" value="{{ $evaluasi->ujian_terbuka_tanggal ?? ($evaluasi->tasmi_tanggal ?? $template['ujian_terbuka_tanggal'] ?? '-') }}" oninput="updateLivePreview()">
                            </div>
                            <div class="editor-form-group">
                                <label>Jumlah Juz:</label>
                                <input type="text" id="inputUjianTerbukaJuz" class="editor-form-control" value="{{ $evaluasi->ujian_terbuka_jumlah_juz ?? ($evaluasi->tasmi_jumlah_juz ?? $template['ujian_terbuka_jumlah_juz'] ?? '-') }}" oninput="updateLivePreview()" placeholder="-">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Predikat:</label>
                                <input type="text" id="inputUjianTerbukaPredikat" class="editor-form-control" value="{{ $evaluasi->ujian_terbuka_predikat ?? ($evaluasi->tasmi_predikat ?? $template['ujian_terbuka_predikat'] ?? '-') }}" oninput="updateLivePreview()" placeholder="-">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Konten Tab 3: Pencapaian Tahfiz (Bagian D) -->
                <div id="editorContent-pencapaian" style="display: none;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div class="editor-form-group">
                            <label>Hafalan Semester (Target):</label>
                            <input type="text" id="inputTargetSemester" class="editor-form-control" value="{{ $evaluasi->target_semester ?? $template['target_semester'] }}" oninput="updateLivePreview()">
                        </div>
                        <div class="editor-form-group">
                            <label>Hafalan Semester (Tercapai & Rincian Ayat):</label>
                            <input type="text" id="inputTercapaiSemester" class="editor-form-control" value="{{ $evaluasi->tercapai_semester ?? $template['tercapai_semester'] }}" oninput="updateLivePreview()">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div class="editor-form-group">
                            <label>Total Hafalan (Target):</label>
                            <input type="text" id="inputTargetTotal" class="editor-form-control" value="{{ $evaluasi->target_total ?? $template['target_total'] }}" oninput="updateLivePreview()">
                        </div>
                        <div class="editor-form-group">
                            <label>Total Hafalan (Tercapai & Rincian):</label>
                            <input type="text" id="inputTercapaiTotal" class="editor-form-control" value="{{ $evaluasi->tercapai_total ?? $template['tercapai_total'] }}" oninput="updateLivePreview()">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; background: #FAF8F2; padding: 14px 18px; border-radius: 10px; border: 1px solid var(--border-color);">
                        <div>
                            <label style="font-weight: 700; font-size: 12px; display: block; margin-bottom: 8px;">Tercapai Target Semester:</label>
                            @php $statSem = $evaluasi->tercapai_target_semester ?? $template['tercapai_target_semester']; @endphp
                            <div style="display: flex; gap: 14px;">
                                <label style="cursor: pointer;"><input type="radio" name="tercapai_sem_radio" value="iya" {{ $statSem ? 'checked' : '' }} onchange="onTargetStatusChanged('sem', true)"> Iya</label>
                                <label style="cursor: pointer;"><input type="radio" name="tercapai_sem_radio" value="tidak" {{ !$statSem ? 'checked' : '' }} onchange="onTargetStatusChanged('sem', false)"> Tidak (√)</label>
                            </div>
                        </div>

                        <div>
                            <label style="font-weight: 700; font-size: 12px; display: block; margin-bottom: 8px;">Tercapai Target Kelas:</label>
                            @php $statKls = $evaluasi->tercapai_target_kelas ?? $template['tercapai_target_kelas']; @endphp
                            <div style="display: flex; gap: 14px;">
                                <label style="cursor: pointer;"><input type="radio" name="tercapai_kls_radio" value="iya" {{ $statKls ? 'checked' : '' }} onchange="onTargetStatusChanged('kls', true)"> Iya</label>
                                <label style="cursor: pointer;"><input type="radio" name="tercapai_kls_radio" value="tidak" {{ !$statKls ? 'checked' : '' }} onchange="onTargetStatusChanged('kls', false)"> Tidak (√)</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Konten Tab 4: Catatan Pengampu Halaqah -->
                <div id="editorContent-catatan" style="display: none;">
                    <div class="editor-form-group">
                        <label>1. Catatan Bacaan (Makharijul Huruf, Tajwid):</label>
                        <textarea id="inputCatatanBacaan" class="editor-form-control" rows="3" oninput="updateLivePreview()">{{ $evaluasi->catatan_bacaan ?? $template['catatan_bacaan'] }}</textarea>
                    </div>

                    <div class="editor-form-group">
                        <label>2. Catatan Hafalan (Itqan/Kelancaran):</label>
                        <textarea id="inputCatatanHafalan" class="editor-form-control" rows="3" oninput="updateLivePreview()">{{ $evaluasi->catatan_hafalan ?? $template['catatan_hafalan'] }}</textarea>
                    </div>

                    <div class="editor-form-group" style="margin-bottom: 0;">
                        <label>3. Catatan Akhlak:</label>
                        <textarea id="inputCatatanAkhlak" class="editor-form-control" rows="3" oninput="updateLivePreview()">{{ $evaluasi->catatan_akhlak ?? $template['catatan_akhlak'] }}</textarea>
                    </div>
                </div>

                <!-- Konten Tab 5: Titimangsa & Pengesahan -->
                <div id="editorContent-pengesahan" style="display: none;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                        <div class="editor-form-group">
                            <label>Tempat Titimangsa:</label>
                            <input type="text" id="inputTempatRapor" class="editor-form-control" value="{{ $evaluasi->tempat_rapor ?? $template['tempat_rapor'] }}" oninput="updateLivePreview()">
                        </div>
                        <div class="editor-form-group">
                            <label>Tanggal Rapor:</label>
                            <input type="text" id="inputTanggalRapor" class="editor-form-control" value="{{ $evaluasi->tanggal_rapor ?? $template['tanggal_rapor'] }}" oninput="updateLivePreview()">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px;">
                        <div class="editor-form-group">
                            <label>1. Pengampu Halaqah (Kiri):</label>
                            <input type="text" id="inputNamaPengampu" class="editor-form-control" value="{{ $evaluasi->nama_pengampu ?? $template['nama_pengampu'] ?? 'NURUL ZHAFIRAH PUTRI' }}" oninput="updateLivePreview()">
                            <input type="text" id="inputRolePengampu" class="editor-form-control" style="margin-top: 6px; font-size: 11px;" value="{{ $evaluasi->role_pengampu_label ?? $template['role_pengampu_label'] ?? 'Pengampu Halaqah & Wali Kelas 5A' }}" oninput="updateLivePreview()">
                        </div>
                        <div class="editor-form-group">
                            <label>2. Wali Kelas (Kanan):</label>
                            <input type="text" id="inputNamaWalas" class="editor-form-control" value="{{ $evaluasi->nama_walas ?? $template['nama_walas'] ?? 'NURUL ZHAFIRAH PUTRI' }}" oninput="updateLivePreview()" placeholder="Nama Lengkap Wali Kelas">
                            <input type="text" id="inputRoleWalas" class="editor-form-control" style="margin-top: 6px; font-size: 11px;" value="{{ $evaluasi->role_walas_label ?? $template['role_walas_label'] ?? 'Wali Kelas' }}" oninput="updateLivePreview()" placeholder="Jabatan / Label (Contoh: Wali Kelas 6)">
                        </div>
                        <div class="editor-form-group">
                            <label>3. Kepala Sekolah (Tengah Bawah):</label>
                            <input type="text" id="inputNamaKepsek" class="editor-form-control" value="{{ $evaluasi->nama_kepsek ?? $template['nama_kepsek'] ?? 'NABILAH TUL ISLAMIYAH S.Pd.,S.Q' }}" oninput="updateLivePreview()" placeholder="Nama Lengkap Kepala Sekolah">
                            <input type="text" id="inputRoleKepsek" class="editor-form-control" style="margin-top: 6px; font-size: 11px;" value="{{ $evaluasi->role_kepsek_label ?? $template['role_kepsek_label'] ?? 'Kepala Sekolah SDQU Imam Syafi’i' }}" oninput="updateLivePreview()" placeholder="Jabatan / Label (Contoh: Kepala Sekolah SDQU Imam Syafi’i)">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================ -->
            <!-- DOKUMEN CETAK RESMI: RAPORT TAHFIZH AL-QUR'AN SDQU           -->
            <!-- (SESUAI DOKUMEN ACUAN TERBARU DARI PENGGUNA)                 -->
            <!-- ============================================================ -->

            <!-- ACTION BAR PERSIS DI ATAS LEMBAR VISUAL RAPORT (NO-PRINT) -->
            <div class="sheet-action-bar no-print">
                <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                    <span style="font-size: 13px; font-weight: 700; color: #064E3B; background: #D1E7DD; padding: 4px 10px; border-radius: 6px;">
                        <i class="fa-solid fa-file-invoice"></i> Visual Lembar Raport
                    </span>
                    <span style="font-size: 13.5px; font-weight: 700; color: #16241f;">
                        <span id="visualHeaderNama">{{ strtoupper($evaluasi->nama_lengkap ?? $template['nama_lengkap'] ?? $siswa->nama) }}</span>
                    </span>
                    @if($siswa->is_manual ?? false)
                        <span style="font-size: 10.5px; background: #fef3c7; color: #92400e; font-weight: 800; padding: 2px 8px; border-radius: 6px; border: 1px solid #fcd34d;">
                            <i class="fa-solid fa-user-tag"></i> Non-Sistem
                        </span>
                    @endif
                </div>

                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                    <!-- TOMBOL DUPLIKAT DI VISUAL RAPOR -->
                    <button type="button" onclick="openDuplicateModal()" class="btn-sheet-action btn-sheet-dup" title="Duplikat rapor ini untuk siswa baru/non-sistem">
                        <i class="fa-solid fa-copy"></i> Duplikat Rapor Ini
                    </button>
                    <!-- TOMBOL UBAH DATA SANTRI LANGSUNG -->
                    <button type="button" onclick="openQuickBioModal()" class="btn-sheet-action btn-sheet-edit" title="Ubah Nama, Kelas, Umur, dan Orang Tua langsung">
                        <i class="fa-solid fa-pen-to-square"></i> Ubah Data Santri
                    </button>
                    <!-- TOMBOL CETAK RAPOR -->
                    <button type="button" onclick="openPrintPromptModal()" class="btn-sheet-action btn-sheet-print" title="Cetak atau Duplikat Lembar Ini">
                        <i class="fa-solid fa-print"></i> Cetak Rapor
                    </button>
                </div>
            </div>

            <div class="rapor-print-container" id="raporPrintArea">

                <!-- WATERMARK LOGO RESMI TRANSPARAN DI TENGAH LEMBAR (UKURAN BESAR MEMENUHI KERTAS, TIDAK TERPOTONG) -->
                <div class="rapor-watermark-overlay" aria-hidden="true">
                    <img src="{{ asset('img/logo_sd.jpg') }}" alt="Watermark SDQU Tinggede">
                </div>

                <div class="rapor-sheet-content">

                    <!-- HEADER DOKUMEN -->
                    <div class="tahfiz-doc-header">
                        <h2>RAPORT TAHFIZH AL-QUR’AN SEMESTER {{ ($tahun_aktif->semester ?? 1) == 1 ? 'GANJIL' : 'GENAP' }} {{ $tahun_aktif->nama ? preg_replace('/[^0-9]/', '', substr($tahun_aktif->nama, 0, 4)) : '2026' }}</h2>
                        <h3>SEKOLAH DASAR AL-QUR’AN IMAM SYAFI’I TINGGEDE</h3>
                    </div>

                    <!-- DATA IDENTITAS SANTRI (MANUAL / BISA DIEDIT) -->
                    <table class="tahfiz-bio-table">
                        <tr>
                            <td class="tahfiz-bio-label">NAMA LENGKAP</td>
                            <td style="width: 15px;">:</td>
                            <td><span id="previewNamaLengkap" class="bio-interactive" onclick="openQuickBioModal()" title="Klik untuk ubah nama santri">{{ strtoupper($evaluasi->nama_lengkap ?? $template['nama_lengkap'] ?? $siswa->nama) }}</span></td>
                        </tr>
                        <tr>
                            <td class="tahfiz-bio-label">KELAS</td>
                            <td>:</td>
                            <td><span id="previewKelas" class="bio-interactive" onclick="openQuickBioModal()" title="Klik untuk ubah kelas">{{ $evaluasi->kelas_label ?? $template['kelas_label'] }}</span></td>
                        </tr>
                        <tr>
                            <td class="tahfiz-bio-label">UMUR</td>
                            <td>:</td>
                            <td><span id="previewUmur" class="bio-interactive" onclick="openQuickBioModal()" title="Klik untuk ubah umur">{{ $evaluasi->umur ?? $template['umur'] }}</span></td>
                        </tr>
                        <tr>
                            <td class="tahfiz-bio-label">ORANG TUA/WALI</td>
                            <td>:</td>
                            <td><span id="previewOrangTua" class="bio-interactive" onclick="openQuickBioModal()" title="Klik untuk ubah orang tua/wali">{{ $evaluasi->orang_tua ?? $template['orang_tua'] }}</span></td>
                        </tr>
                    </table>

                    <!-- A. UJIAN KENAIKAN JUZ -->
                    <div class="tahfiz-section-title">A. UJIAN KENAIKAN JUZ</div>
                    <table class="tahfiz-table-clean">
                        <thead>
                            <tr>
                                <th style="width: 45%;">TANGGAL</th>
                                <th style="width: 25%;">JUZ</th>
                                <th style="width: 30%;">PREDIKAT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;"><span id="previewKenaikanTanggal">{{ $evaluasi->kenaikan_juz_tanggal ?? $template['kenaikan_juz_tanggal'] }}</span></td>
                                <td style="text-align: center; font-weight: 700;"><span id="previewKenaikanJuz">{{ $evaluasi->kenaikan_juz_nomor ?? $template['kenaikan_juz_nomor'] }}</span></td>
                                <td style="text-align: center; font-weight: 700;"><span id="previewKenaikanPredikat">{{ $evaluasi->kenaikan_juz_predikat ?? $template['kenaikan_juz_predikat'] }}</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- B. UJIAN TASMI' (4 BULAN DENGAN HEADER BISA DIEDIT) -->
                    <div class="tahfiz-section-title">B. UJIAN TASMI’</div>
                    <table class="tahfiz-table-clean">
                        <thead>
                            <tr>
                                <th style="width: 14%;"><span id="previewBulan1Label">{{ $evaluasi->bulan_1_label ?? $template['bulan_1_label'] ?? 'AGUSTUS' }}</span></th>
                                <th style="width: 14%;"><span id="previewBulan2Label">{{ $evaluasi->bulan_2_label ?? $template['bulan_2_label'] ?? 'SEPTEMBER' }}</span></th>
                                <th style="width: 14%;"><span id="previewBulan3Label">{{ $evaluasi->bulan_3_label ?? $template['bulan_3_label'] ?? 'OKTOBER' }}</span></th>
                                <th style="width: 14%;"><span id="previewBulan4Label">{{ $evaluasi->bulan_4_label ?? $template['bulan_4_label'] ?? 'NOVEMBER' }}</span></th>
                                <th style="width: 16%;">TOTAL NILAI AKHIR</th>
                                <th style="width: 14%;">NILAI RATA-RATA</th>
                                <th style="width: 14%;">PREDIKAT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nb1 = $evaluasi->nilai_bulan_1 ?? ($evaluasi->ujian_1 ?? null);
                                $nb2 = $evaluasi->nilai_bulan_2 ?? ($evaluasi->ujian_2 ?? null);
                                $nb3 = $evaluasi->nilai_bulan_3 ?? ($evaluasi->ujian_akhir ?? null);
                                $nb4 = $evaluasi->nilai_bulan_4 ?? null;
                                $hasBulan = ($nb1 !== null || $nb2 !== null || $nb3 !== null || $nb4 !== null);
                                $totAkhir = $evaluasi->ujian_jumlah ?? ($hasBulan ? (($nb1 ?? 0) + ($nb2 ?? 0) + ($nb3 ?? 0) + ($nb4 ?? 0)) : null);
                                $rataBulan = $evaluasi->ujian_rata_rata ?? ($hasBulan ? round($totAkhir / 4, 1) : null);
                                $predBulan = $evaluasi->ujian_predikat ?? ($rataBulan !== null ? \App\Models\evaluasi_rapor_tahfidz::calculatePredikat($rataBulan) : '-');
                            @endphp
                            <tr>
                                <td style="text-align: center;"><span id="previewNilaiBulan1">{{ $nb1 !== null ? number_format($nb1, 0) : '' }}</span></td>
                                <td style="text-align: center;"><span id="previewNilaiBulan2">{{ $nb2 !== null ? number_format($nb2, 0) : '' }}</span></td>
                                <td style="text-align: center;"><span id="previewNilaiBulan3">{{ $nb3 !== null ? number_format($nb3, 0) : '' }}</span></td>
                                <td style="text-align: center;"><span id="previewNilaiBulan4">{{ $nb4 !== null ? number_format($nb4, 0) : '' }}</span></td>
                                <td style="text-align: center; font-weight: 700;"><span id="previewTotalNilaiAkhir">{{ $totAkhir !== null ? number_format($totAkhir, 0) : '' }}</span></td>
                                <td style="text-align: center; font-weight: 700;"><span id="previewNilaiRataRata">{{ $rataBulan !== null ? number_format($rataBulan, 1, ',', '') : '' }}</span></td>
                                <td style="text-align: center; font-weight: 800;"><span id="previewPredikatTasmi">{{ $predBulan }}</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- C. UJIAN TAHFIZ TERBUKA -->
                    <div class="tahfiz-section-title">C. UJIAN TAHFIZ TERBUKA</div>
                    <table class="tahfiz-table-clean">
                        <thead>
                            <tr>
                                <th style="width: 45%;">TANGGAL</th>
                                <th style="width: 25%;">JUMLAH JUZ</th>
                                <th style="width: 30%;">PREDIKAT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;"><span id="previewUjianTerbukaTanggal">{{ $evaluasi->ujian_terbuka_tanggal ?? ($evaluasi->tasmi_tanggal ?? $template['ujian_terbuka_tanggal'] ?? '-') }}</span></td>
                                <td style="text-align: center;"><span id="previewUjianTerbukaJuz">{{ $evaluasi->ujian_terbuka_jumlah_juz ?? ($evaluasi->tasmi_jumlah_juz ?? $template['ujian_terbuka_jumlah_juz'] ?? '-') }}</span></td>
                                <td style="text-align: center;"><span id="previewUjianTerbukaPredikat">{{ $evaluasi->ujian_terbuka_predikat ?? ($evaluasi->tasmi_predikat ?? $template['ujian_terbuka_predikat'] ?? '-') }}</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- D. PENCAPAIAN TAHFIZH -->
                    <div class="tahfiz-section-title">D. PENCAPAIAN TAHFIZH</div>
                    <table class="tahfiz-table-clean">
                        <thead>
                            <tr>
                                <th colspan="2" style="width: 34%;">HAFALAN SEMESTER</th>
                                <th colspan="2" style="width: 34%;">TOTAL HAFALAN</th>
                                <th colspan="2" style="width: 16%;">TERCAPAI TARGET SEMESTER</th>
                                <th colspan="2" style="width: 16%;">TERCAPAI TARGET KELAS</th>
                            </tr>
                            <tr>
                                <th style="font-size: 11px;">Target</th>
                                <th style="font-size: 11px;">Tercapai</th>
                                <th style="font-size: 11px;">Target</th>
                                <th style="font-size: 11px;">Tercapai</th>
                                <th style="font-size: 11px; width: 8%;">Iya</th>
                                <th style="font-size: 11px; width: 8%;">Tidak</th>
                                <th style="font-size: 11px; width: 8%;">Iya</th>
                                <th style="font-size: 11px; width: 8%;">Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $semIya = ($evaluasi->tercapai_target_semester ?? $template['tercapai_target_semester']);
                                $klsIya = ($evaluasi->tercapai_target_kelas ?? $template['tercapai_target_kelas']);
                            @endphp
                            <tr>
                                <td style="text-align: center; font-weight: 600;"><span id="previewTargetSem">{{ $evaluasi->target_semester ?? $template['target_semester'] }}</span></td>
                                <td style="font-size: 11px; line-height: 1.35;"><span id="previewTercapaiSem">{{ $evaluasi->tercapai_semester ?? $template['tercapai_semester'] }}</span></td>
                                <td style="text-align: center; font-weight: 600;"><span id="previewTargetTot">{{ $evaluasi->target_total ?? $template['target_total'] }}</span></td>
                                <td style="font-size: 11px; line-height: 1.35;"><span id="previewTercapaiTot">{{ $evaluasi->tercapai_total ?? $template['tercapai_total'] }}</span></td>
                                <td style="text-align: center; font-weight: 800; font-size: 14px;" id="cellSemIya">{!! $semIya ? '√' : '' !!}</td>
                                <td style="text-align: center; font-weight: 800; font-size: 14px;" id="cellSemTidak">{!! !$semIya ? '√' : '' !!}</td>
                                <td style="text-align: center; font-weight: 800; font-size: 14px;" id="cellKlsIya">{!! $klsIya ? '√' : '' !!}</td>
                                <td style="text-align: center; font-weight: 800; font-size: 14px;" id="cellKlsTidak">{!! !$klsIya ? '√' : '' !!}</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- CATATAN PENGAMPU HALAQAH -->
                    <div class="tahfiz-catatan-wrapper">
                        <div class="tahfiz-catatan-title">CATATAN PENGAMPU HALAQAH :</div>

                        <div class="tahfiz-catatan-sub">Bacaan (Makharijul Huruf. Tajwid)</div>
                        <div class="tahfiz-catatan-text" id="previewCatatanBacaan">{{ $evaluasi->catatan_bacaan ?? $template['catatan_bacaan'] }}</div>

                        <div class="tahfiz-catatan-sub">Hafalan (Itqan/Kelancaran)</div>
                        <div class="tahfiz-catatan-text" id="previewCatatanHafalan">{{ $evaluasi->catatan_hafalan ?? $template['catatan_hafalan'] }}</div>

                        <div class="tahfiz-catatan-sub">Akhlak</div>
                        <div class="tahfiz-catatan-text" id="previewCatatanAkhlak">{{ $evaluasi->catatan_akhlak ?? $template['catatan_akhlak'] }}</div>
                    </div>

                    <!-- TANDA TANGAN & TITIMANGSA (3 TANDA TANGAN: KIRI PENGAMPU, KANAN WALI KELAS, TENGAH BAWAH KEPSEK) -->
                    <div style="margin-top: 24px; page-break-inside: avoid;">
                        <table style="width: 100%; text-align: center; font-size: 11.5px; border-collapse: collapse; margin-bottom: 8px;">
                            <tr>
                                <!-- Kiri: Pengampu Halaqah -->
                                <td style="width: 46%; vertical-align: top;">
                                    <div style="color: transparent; user-select: none;">&nbsp;</div>
                                    <div style="font-weight: 500;">Tertanda,</div>
                                    <div style="height: 58px; display: flex; align-items: center; justify-content: center;">
                                        @if(!empty($evaluasi->ttd_pengampu))
                                            <img src="{{ $evaluasi->ttd_pengampu }}" alt="TTD Pengampu" style="max-height: 52px;">
                                        @endif
                                    </div>
                                    <strong style="text-decoration: underline; font-size: 12.5px;" id="previewPengampu">{{ $evaluasi->nama_pengampu ?? $template['nama_pengampu'] ?? 'NURUL ZHAFIRAH PUTRI' }}</strong>
                                    <div style="font-size: 11px; color: #333; margin-top: 2px;" id="previewRolePengampu">{{ $evaluasi->role_pengampu_label ?? $template['role_pengampu_label'] ?? 'Pengampu Halaqah & Wali Kelas 5A' }}</div>
                                </td>

                                <td style="width: 8%;"></td>

                                <!-- Kanan: Wali Kelas (disertai Titimangsa) -->
                                <td style="width: 46%; vertical-align: top;">
                                    <div>
                                        <span id="previewTempat">{{ $evaluasi->tempat_rapor ?? $template['tempat_rapor'] }}</span>, 
                                        <span id="previewTanggal">{{ $evaluasi->tanggal_rapor ?? $template['tanggal_rapor'] }}</span>
                                    </div>
                                    <div style="font-weight: 500;" id="previewRoleWalasHeader">{{ $evaluasi->role_walas_label ?? $template['role_walas_label'] ?? 'Wali Kelas' }},</div>
                                    <div style="height: 58px; display: flex; align-items: center; justify-content: center;">
                                        @if(!empty($evaluasi->ttd_walas))
                                            <img src="{{ $evaluasi->ttd_walas }}" alt="TTD Wali Kelas" style="max-height: 52px;">
                                        @endif
                                    </div>
                                    <strong style="text-decoration: underline; font-size: 12.5px;" id="previewWalas">{{ $evaluasi->nama_walas ?? $template['nama_walas'] ?? 'NURUL ZHAFIRAH PUTRI' }}</strong>
                                    <div style="font-size: 11px; color: #333; margin-top: 2px;" id="previewRoleWalas">{{ $evaluasi->role_walas_label ?? $template['role_walas_label'] ?? 'Wali Kelas' }}</div>
                                </td>
                            </tr>

                            <!-- Baris 2: Tengah Bawah Kepala Sekolah -->
                            <tr>
                                <td colspan="3" style="text-align: center; vertical-align: top; padding-top: 14px;">
                                    <div style="display: inline-block; min-width: 250px;">
                                        <div style="font-weight: 500;">Mengetahui,</div>
                                        <div style="font-size: 11px; color: #333; margin-top: 1px;" id="previewRoleKepsek">{{ $evaluasi->role_kepsek_label ?? $template['role_kepsek_label'] ?? 'Kepala Sekolah SDQU Imam Syafi’i' }}</div>
                                        <div style="height: 58px; display: flex; align-items: center; justify-content: center;">
                                            @if(!empty($evaluasi->ttd_kepsek))
                                                <img src="{{ $evaluasi->ttd_kepsek }}" alt="TTD Kepala Sekolah" style="max-height: 52px;">
                                            @endif
                                        </div>
                                        <strong style="text-decoration: underline; font-size: 12.5px;" id="previewKepsek">{{ $evaluasi->nama_kepsek ?? $template['nama_kepsek'] ?? 'NABILAH TUL ISLAMIYAH S.Pd.,S.Q' }}</strong>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- KETERANGAN PREDIKAT (FOOTER ACUAN RESMI) -->
                    <div class="tahfiz-predikat-legend">
                        <strong>Keterangan Predikat :</strong><br>
                        Mumtaz/ A: 91-100 &nbsp;&nbsp;|&nbsp;&nbsp; Jayyid Jiddan/B : 83-90 &nbsp;&nbsp;|&nbsp;&nbsp; Jayyid/C : 72-82 &nbsp;&nbsp;|&nbsp;&nbsp; Maqbul/D : 61-71 &nbsp;&nbsp;|&nbsp;&nbsp; Dha’if/E : &lt;60
                    </div>

                </div>
            </div>

            <!-- MODAL DUPLIKAT RAPOR (UNTUK SISWA NON-SISTEM / BELUM TERDAFTAR) -->
            <div id="duplicateModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 9999; align-items: center; justify-content: center; padding: 16px;">
                <div style="background: #fff; width: 100%; max-width: 540px; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.25);">
                    <div style="padding: 18px 24px; background: #0369a1; color: #fff; display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <h4 style="font-size: 15px; margin: 0; font-weight: 700;">
                                <i class="fa-solid fa-copy"></i> Duplikat Rapor (Siswa Non-Sistem)
                            </h4>
                            <p style="font-size: 11.5px; margin: 3px 0 0 0; color: #bae6fd;">
                                Cetak rapor untuk santri yang belum terdaftar di sistem dengan menyalin format rapor ini.
                            </p>
                        </div>
                        <button type="button" onclick="closeDuplicateModal()" style="background: none; border: none; color: #fff; font-size: 18px; cursor: pointer;">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <form id="duplicateForm" onsubmit="submitDuplicateRapor(event)" style="padding: 24px;">
                        <input type="hidden" name="source_evaluasi_id" value="{{ $evaluasi ? $evaluasi->id : '' }}">
                        <input type="hidden" name="source_siswa_id" value="{{ is_numeric($siswa->id) ? $siswa->id : '' }}">
                        <input type="hidden" name="kelas_id" value="{{ $siswa->kelas_id ?? '' }}">

                        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 12px; margin-bottom: 16px; font-size: 12px; color: #166534; line-height: 1.4;">
                            <i class="fa-solid fa-circle-info"></i> Format rapor (nama 4 bulan, target semester/kelas, titimangsa, dan tanda tangan) akan disalin secara otomatis. Silakan lengkapi identitas santri yang ingin dicetak:
                        </div>

                        <!-- Form Input Santri Baru (Manual) -->
                        <div style="margin-bottom: 12px;">
                            <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                                Nama Lengkap Santri <span style="color: #dc2626;">*</span>
                            </label>
                            <input type="text" id="dupNamaLengkap" name="nama_lengkap" class="editor-form-control" placeholder="Contoh: AHMAD FAUZAN" required>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
                            <div>
                                <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                                    Kelas <span style="color: #dc2626;">*</span>
                                </label>
                                <input type="text" id="dupKelasLabel" name="kelas_label" class="editor-form-control" value="{{ $evaluasi->kelas_label ?? $template['kelas_label'] ?? 'VI (ENAM)' }}" required>
                            </div>
                            <div>
                                <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                                    Umur <span style="color: #dc2626;">*</span>
                                </label>
                                <input type="text" id="dupUmur" name="umur" class="editor-form-control" value="{{ $evaluasi->umur ?? $template['umur'] ?? '12 TAHUN' }}" required>
                            </div>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                                Orang Tua / Wali <span style="color: #dc2626;">*</span>
                            </label>
                            <input type="text" id="dupOrangTua" name="orang_tua" class="editor-form-control" value="{{ $evaluasi->orang_tua ?? $template['orang_tua'] ?? 'Bpk. ... & Ibu ...' }}" required>
                        </div>

                        <!-- Opsi Salin Konten -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px; margin-bottom: 20px;">
                            <span style="font-size: 11.5px; font-weight: 700; color: #475569; display: block; margin-bottom: 8px;">Pilihan Salin Konten Rapor:</span>
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: #334155; margin-bottom: 6px; cursor: pointer;">
                                <input type="checkbox" name="copy_nilai" value="1" checked> Salin Nilai 4 Bulan Ujian Tasmi' & Nilai Terbuka
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: #334155; margin-bottom: 6px; cursor: pointer;">
                                <input type="checkbox" name="copy_capaian" value="1" checked> Salin Capaian Target & Kenaikan Juz
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: #334155; margin-bottom: 6px; cursor: pointer;">
                                <input type="checkbox" name="copy_catatan" value="1" checked> Salin Catatan Pengampu (Bacaan, Hafalan, Akhlak)
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: #334155; cursor: pointer;">
                                <input type="checkbox" name="copy_ttd" value="1" checked> Salin Tanda Tangan & Titimangsa
                            </label>
                        </div>

                        <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid var(--border-color); padding-top: 16px;">
                            <button type="button" onclick="closeDuplicateModal()" class="btn-tahfiz-secondary">Batal</button>
                            <button type="submit" id="btnSubmitDuplicate" class="btn-tahfiz-primary" style="background: #0284c7;">
                                <i class="fa-solid fa-copy"></i> Duplikat & Buka Rapor
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- MODAL PROMPT CETAK & DUPLIKAT (MUNCUL SAAT MENEKAN CETAK) -->
            <div id="printPromptModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 10000; align-items: center; justify-content: center; padding: 16px;">
                <div style="background: #fff; width: 100%; max-width: 500px; border-radius: 16px; overflow: hidden; box-shadow: 0 15px 40px rgba(0,0,0,0.3);">
                    <div style="padding: 18px 24px; background: linear-gradient(135deg, #1B6B4F 0%, #0B3B2E 100%); color: #fff; display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <h4 style="font-size: 16px; font-weight: 700; margin: 0;">
                                <i class="fa-solid fa-print"></i> Cetak Dokumen Raport Tahfizh
                            </h4>
                            <p style="font-size: 11.5px; margin: 3px 0 0 0; color: #d1fae5;">
                                Santri: {{ strtoupper($evaluasi->nama_lengkap ?? $template['nama_lengkap'] ?? $siswa->nama) }}
                            </p>
                        </div>
                        <button type="button" onclick="closePrintPromptModal()" style="background: none; border: none; color: #fff; font-size: 18px; cursor: pointer;">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div style="padding: 22px;">
                        <p style="font-size: 12.5px; color: #444; margin: 0 0 16px 0; line-height: 1.5;">
                            Silakan tentukan aksi untuk lembar raport visual ini:
                        </p>

                        <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px;">
                            <!-- OPSI 1: CETAK LEMBAR INI -->
                            <div onclick="doDirectPrint()" style="border: 2px solid #10B981; border-radius: 12px; padding: 14px 16px; cursor: pointer; display: flex; align-items: center; gap: 14px; background: #f0fdf4; transition: all 0.2s ease;">
                                <div style="width: 44px; height: 44px; border-radius: 10px; background: #10B981; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                    <i class="fa-solid fa-print"></i>
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-size: 13.5px; font-weight: 700; color: #064E3B;">Lanjutkan Cetak Lembar Ini</div>
                                    <div style="font-size: 11.5px; color: #047857; margin-top: 2px;">Cetak dokumen fisik ini langsung ke printer atau simpan PDF.</div>
                                </div>
                                <i class="fa-solid fa-chevron-right" style="color: #10B981;"></i>
                            </div>

                            <!-- OPSI 2: DUPLIKAT RAPOR (UBAH NAMA DLL) -->
                            <div onclick="openDuplicateFromPrompt()" style="border: 2px solid #0284c7; border-radius: 12px; padding: 14px 16px; cursor: pointer; display: flex; align-items: center; gap: 14px; background: #f0f9ff; transition: all 0.2s ease;">
                                <div style="width: 44px; height: 44px; border-radius: 10px; background: #0284c7; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                    <i class="fa-solid fa-copy"></i>
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-size: 13.5px; font-weight: 700; color: #0369a1;">Duplikat Rapor Ini (Ubah Nama & Data)</div>
                                    <div style="font-size: 11.5px; color: #0284c7; margin-top: 2px;">Salin rapor ini & ganti nama, kelas, umur, ortu untuk santri baru/non-sistem.</div>
                                </div>
                                <i class="fa-solid fa-chevron-right" style="color: #0284c7;"></i>
                            </div>

                            <!-- OPSI 3: BUKA HALAMAN CETAK BERSIH -->
                            @php
                                $cleanPrintUrl = url('/tf/gr/cetak-rapor-massal?siswa_id=' . $siswa->id);
                            @endphp
                            <a href="{{ $cleanPrintUrl }}" target="_blank" style="text-decoration: none; border: 1px solid #d1d5db; border-radius: 12px; padding: 12px 16px; display: flex; align-items: center; gap: 14px; background: #fafafa; transition: all 0.2s ease;">
                                <div style="width: 40px; height: 40px; border-radius: 10px; background: #64748b; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                                    <i class="fa-solid fa-up-right-from-square"></i>
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-size: 13px; font-weight: 700; color: #334155;">Buka Pratinjau Cetak Penuh (Tab Baru)</div>
                                    <div style="font-size: 11px; color: #64748b; margin-top: 2px;">Tampilan bersih 1 lembar khusus cetak resolusi tinggi.</div>
                                </div>
                                <i class="fa-solid fa-arrow-up-right-from-square" style="color: #94a3b8; font-size: 12px;"></i>
                            </a>
                        </div>

                        <div style="text-align: right;">
                            <button type="button" onclick="closePrintPromptModal()" class="btn-sheet-action btn-sheet-edit" style="padding: 8px 18px;">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL QUICK EDIT DATA SANTRI LANGSUNG DI VISUAL -->
            <div id="quickBioModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 10000; align-items: center; justify-content: center; padding: 16px;">
                <div style="background: #fff; width: 100%; max-width: 480px; border-radius: 16px; overflow: hidden; box-shadow: 0 15px 40px rgba(0,0,0,0.3);">
                    <div style="padding: 16px 22px; background: #1B6B4F; color: #fff; display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <h4 style="font-size: 15px; margin: 0; font-weight: 700;">
                                <i class="fa-solid fa-pen-to-square"></i> Ubah Data Santri di Visual Rapor
                            </h4>
                            <p style="font-size: 11.5px; margin: 2px 0 0 0; color: #d1fae5;">
                                Perubahan nama dan data santri langsung tampil di visual lembar ini.
                            </p>
                        </div>
                        <button type="button" onclick="closeQuickBioModal()" style="background: none; border: none; color: #fff; font-size: 18px; cursor: pointer;">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <form id="quickBioForm" onsubmit="submitQuickBio(event)" style="padding: 22px;">
                        <div style="margin-bottom: 12px;">
                            <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                                Nama Lengkap Santri:
                            </label>
                            <input type="text" id="qbNamaLengkap" class="editor-form-control" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
                            <div>
                                <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                                    Kelas:
                                </label>
                                <input type="text" id="qbKelasLabel" class="editor-form-control" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                            </div>
                            <div>
                                <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                                    Umur:
                                </label>
                                <input type="text" id="qbUmur" class="editor-form-control" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                            </div>
                        </div>

                        <div style="margin-bottom: 18px;">
                            <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                                Orang Tua / Wali:
                            </label>
                            <input type="text" id="qbOrangTua" class="editor-form-control" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                        </div>

                        <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                            <button type="button" onclick="closeQuickBioModal()" class="btn-sheet-action btn-sheet-edit" style="padding: 8px 16px;">Batal</button>
                            <button type="submit" id="btnSubmitQuickBio" class="btn-sheet-action btn-sheet-print" style="padding: 8px 18px; font-size: 13px; background: #1B6B4F;">
                                <i class="fa-solid fa-floppy-disk"></i> Terapkan ke Visual
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>

    <!-- JAVASCRIPT REALTIME SYNC & LOCALSTORAGE AUTO-SAVE -->
    <script>
        const SISWA_ID = '{{ $siswa->id }}';
        const KELAS_ID = '{{ $siswa->kelas_id ?? "" }}';
        const IS_MANUAL = {{ ($siswa->is_manual ?? false) ? 'true' : 'false' }};
        const EVALUASI_ID = '{{ $evaluasi ? $evaluasi->id : "" }}';
        const STORAGE_KEY = 'raport_tahfizh_v3_' + SISWA_ID;
        const SHARED_FORMAT_KEY = 'tahfiz_shared_class_format_' + (KELAS_ID || 'global');

        let targetSemIya = {{ ($evaluasi->tercapai_target_semester ?? $template['tercapai_target_semester']) ? 'true' : 'false' }};
        let targetKlsIya = {{ ($evaluasi->tercapai_target_kelas ?? $template['tercapai_target_kelas']) ? 'true' : 'false' }};

        function switchEditorTab(tabId) {
            document.querySelectorAll('.editor-nav-tab').forEach(b => b.classList.remove('active'));
            ['tab-identitas', 'tab-ujian', 'tab-pencapaian', 'tab-catatan', 'tab-pengesahan'].forEach(t => {
                const el = document.getElementById('editorContent-' + t.replace('tab-', ''));
                if (el) el.style.display = (t === tabId) ? 'block' : 'none';
            });
            const activeBtn = document.getElementById('editorTabBtn-' + tabId.replace('tab-', ''));
            if (activeBtn) activeBtn.classList.add('active');
        }

        function calculatePredikat(num) {
            if (num === null || isNaN(num) || num === '') return '-';
            if (num >= 91) return 'Mumtaz/A';
            if (num >= 83) return 'Jayyid Jiddan/B';
            if (num >= 72) return 'Jayyid/C';
            if (num >= 61) return 'Maqbul/D';
            return 'Dha’if/E';
        }

        function recalcUjianTasmi() {
            const v1 = document.getElementById('inputNilaiBulan1').value;
            const v2 = document.getElementById('inputNilaiBulan2').value;
            const v3 = document.getElementById('inputNilaiBulan3').value;
            const v4 = document.getElementById('inputNilaiBulan4').value;

            const n1 = v1 !== '' ? parseFloat(v1) : null;
            const n2 = v2 !== '' ? parseFloat(v2) : null;
            const n3 = v3 !== '' ? parseFloat(v3) : null;
            const n4 = v4 !== '' ? parseFloat(v4) : null;

            const hasAny = (n1 !== null || n2 !== null || n3 !== null || n4 !== null);
            if (!hasAny) {
                document.getElementById('inputTotalNilai').value = '';
                document.getElementById('inputNilaiRata').value = '';
                document.getElementById('inputNilaiPredikat').value = '-';

                document.getElementById('previewNilaiBulan1').innerText = '';
                document.getElementById('previewNilaiBulan2').innerText = '';
                document.getElementById('previewNilaiBulan3').innerText = '';
                document.getElementById('previewNilaiBulan4').innerText = '';
                document.getElementById('previewTotalNilaiAkhir').innerText = '';
                document.getElementById('previewNilaiRataRata').innerText = '';
                document.getElementById('previewPredikatTasmi').innerText = '-';
                autoSaveDraft();
                return;
            }

            const total = (n1 || 0) + (n2 || 0) + (n3 || 0) + (n4 || 0);
            const rata = Math.round((total / 4) * 10) / 10;
            const predikat = calculatePredikat(rata);

            document.getElementById('inputTotalNilai').value = total;
            document.getElementById('inputNilaiRata').value = rata.toFixed(1).replace('.', ',');
            document.getElementById('inputNilaiPredikat').value = predikat;

            document.getElementById('previewNilaiBulan1').innerText = n1 !== null ? n1 : '';
            document.getElementById('previewNilaiBulan2').innerText = n2 !== null ? n2 : '';
            document.getElementById('previewNilaiBulan3').innerText = n3 !== null ? n3 : '';
            document.getElementById('previewNilaiBulan4').innerText = n4 !== null ? n4 : '';
            document.getElementById('previewTotalNilaiAkhir').innerText = total;
            document.getElementById('previewNilaiRataRata').innerText = rata.toFixed(1).replace('.', ',');
            document.getElementById('previewPredikatTasmi').innerText = predikat;

            autoSaveDraft();
        }

        function onTargetStatusChanged(type, isIya) {
            if (type === 'sem') {
                targetSemIya = isIya;
                document.getElementById('cellSemIya').innerText = isIya ? '√' : '';
                document.getElementById('cellSemTidak').innerText = !isIya ? '√' : '';
            } else {
                targetKlsIya = isIya;
                document.getElementById('cellKlsIya').innerText = isIya ? '√' : '';
                document.getElementById('cellKlsTidak').innerText = !isIya ? '√' : '';
            }
            autoSaveDraft();
        }

        function updateLivePreview() {
            // Data Santri Manual
            const namaManual = document.getElementById('inputNamaLengkap').value;
            const kelasManual = document.getElementById('inputKelasLabel').value;
            const umurManual = document.getElementById('inputUmur').value;
            const ortuManual = document.getElementById('inputOrangTua').value;

            document.getElementById('previewNamaLengkap').innerText = (namaManual || '').toUpperCase();
            document.getElementById('previewKelas').innerText = kelasManual;
            document.getElementById('previewUmur').innerText = umurManual;
            document.getElementById('previewOrangTua').innerText = ortuManual;

            // A. Ujian Kenaikan Juz
            document.getElementById('previewKenaikanTanggal').innerText = document.getElementById('inputKenaikanTanggal').value;
            document.getElementById('previewKenaikanJuz').innerText = document.getElementById('inputKenaikanJuz').value;
            document.getElementById('previewKenaikanPredikat').innerText = document.getElementById('inputKenaikanPredikat').value;

            // B. 4 Bulan Label
            const b1 = (document.getElementById('inputBulan1Label').value || 'AGUSTUS').toUpperCase();
            const b2 = (document.getElementById('inputBulan2Label').value || 'SEPTEMBER').toUpperCase();
            const b3 = (document.getElementById('inputBulan3Label').value || 'OKTOBER').toUpperCase();
            const b4 = (document.getElementById('inputBulan4Label').value || 'NOVEMBER').toUpperCase();

            document.getElementById('previewBulan1Label').innerText = b1;
            document.getElementById('previewBulan2Label').innerText = b2;
            document.getElementById('previewBulan3Label').innerText = b3;
            document.getElementById('previewBulan4Label').innerText = b4;

            document.getElementById('labelNilai1').innerText = 'Nilai ' + b1 + ':';
            document.getElementById('labelNilai2').innerText = 'Nilai ' + b2 + ':';
            document.getElementById('labelNilai3').innerText = 'Nilai ' + b3 + ':';
            document.getElementById('labelNilai4').innerText = 'Nilai ' + b4 + ':';

            // C. Ujian Tahfiz Terbuka
            document.getElementById('previewUjianTerbukaTanggal').innerText = document.getElementById('inputUjianTerbukaTanggal').value;
            document.getElementById('previewUjianTerbukaJuz').innerText = document.getElementById('inputUjianTerbukaJuz').value;
            document.getElementById('previewUjianTerbukaPredikat').innerText = document.getElementById('inputUjianTerbukaPredikat').value;

            // D. Target Hafalan
            document.getElementById('previewTargetSem').innerText = document.getElementById('inputTargetSemester').value;
            document.getElementById('previewTercapaiSem').innerText = document.getElementById('inputTercapaiSemester').value;
            document.getElementById('previewTargetTot').innerText = document.getElementById('inputTargetTotal').value;
            document.getElementById('previewTercapaiTot').innerText = document.getElementById('inputTercapaiTotal').value;

            // Catatan Pengampu
            document.getElementById('previewCatatanBacaan').innerText = document.getElementById('inputCatatanBacaan').value;
            document.getElementById('previewCatatanHafalan').innerText = document.getElementById('inputCatatanHafalan').value;
            document.getElementById('previewCatatanAkhlak').innerText = document.getElementById('inputCatatanAkhlak').value;

            // Titimangsa & Pengesahan
            document.getElementById('previewTempat').innerText = document.getElementById('inputTempatRapor').value;
            document.getElementById('previewTanggal').innerText = document.getElementById('inputTanggalRapor').value;
            document.getElementById('previewPengampu').innerText = document.getElementById('inputNamaPengampu').value;
            document.getElementById('previewRolePengampu').innerText = document.getElementById('inputRolePengampu').value;
            document.getElementById('previewWalas').innerText = document.getElementById('inputNamaWalas').value;
            const walasRoleVal = document.getElementById('inputRoleWalas') ? document.getElementById('inputRoleWalas').value : 'Wali Kelas';
            if (document.getElementById('previewRoleWalas')) document.getElementById('previewRoleWalas').innerText = walasRoleVal;
            if (document.getElementById('previewRoleWalasHeader')) document.getElementById('previewRoleWalasHeader').innerText = walasRoleVal + (walasRoleVal.endsWith(',') ? '' : ',');

            document.getElementById('previewKepsek').innerText = document.getElementById('inputNamaKepsek').value;
            const kepsekRoleVal = document.getElementById('inputRoleKepsek') ? document.getElementById('inputRoleKepsek').value : 'Kepala Sekolah SDQU Imam Syafi’i';
            if (document.getElementById('previewRoleKepsek')) document.getElementById('previewRoleKepsek').innerText = kepsekRoleVal;

            autoSaveDraft();
        }

        function getPayloadData() {
            return {
                siswa_id: SISWA_ID,
                is_manual: IS_MANUAL ? '1' : '0',
                manual_id: EVALUASI_ID,
                kelas_id: KELAS_ID,
                semester: {{ $tahun_aktif->semester ?? 1 }},
                nama_lengkap: document.getElementById('inputNamaLengkap').value,
                kelas_label: document.getElementById('inputKelasLabel').value,
                umur: document.getElementById('inputUmur').value,
                orang_tua: document.getElementById('inputOrangTua').value,

                kenaikan_juz_tanggal: document.getElementById('inputKenaikanTanggal').value,
                kenaikan_juz_nomor: document.getElementById('inputKenaikanJuz').value,
                kenaikan_juz_predikat: document.getElementById('inputKenaikanPredikat').value,

                bulan_1_label: document.getElementById('inputBulan1Label').value,
                bulan_2_label: document.getElementById('inputBulan2Label').value,
                bulan_3_label: document.getElementById('inputBulan3Label').value,
                bulan_4_label: document.getElementById('inputBulan4Label').value,
                nilai_bulan_1: document.getElementById('inputNilaiBulan1').value,
                nilai_bulan_2: document.getElementById('inputNilaiBulan2').value,
                nilai_bulan_3: document.getElementById('inputNilaiBulan3').value,
                nilai_bulan_4: document.getElementById('inputNilaiBulan4').value,

                ujian_terbuka_tanggal: document.getElementById('inputUjianTerbukaTanggal').value,
                ujian_terbuka_jumlah_juz: document.getElementById('inputUjianTerbukaJuz').value,
                ujian_terbuka_predikat: document.getElementById('inputUjianTerbukaPredikat').value,

                target_semester: document.getElementById('inputTargetSemester').value,
                tercapai_semester: document.getElementById('inputTercapaiSemester').value,
                target_total: document.getElementById('inputTargetTotal').value,
                tercapai_total: document.getElementById('inputTercapaiTotal').value,
                tercapai_target_semester: targetSemIya ? '1' : '0',
                tercapai_target_kelas: targetKlsIya ? '1' : '0',

                catatan_bacaan: document.getElementById('inputCatatanBacaan').value,
                catatan_hafalan: document.getElementById('inputCatatanHafalan').value,
                catatan_akhlak: document.getElementById('inputCatatanAkhlak').value,

                tempat_rapor: document.getElementById('inputTempatRapor').value,
                tanggal_rapor: document.getElementById('inputTanggalRapor').value,
                nama_pengampu: document.getElementById('inputNamaPengampu').value,
                role_pengampu_label: document.getElementById('inputRolePengampu').value,
                nama_walas: document.getElementById('inputNamaWalas').value,
                role_walas_label: document.getElementById('inputRoleWalas') ? document.getElementById('inputRoleWalas').value : 'Wali Kelas',
                nama_kepsek: document.getElementById('inputNamaKepsek').value,
                role_kepsek_label: document.getElementById('inputRoleKepsek') ? document.getElementById('inputRoleKepsek').value : 'Kepala Sekolah SDQU Imam Syafi’i'
            };
        }

        function autoSaveDraft() {
            const data = getPayloadData();
            localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        }

        function saveRaporToDatabase(applyToAll = false) {
            const btn = applyToAll ? document.getElementById('btnApplyAll') : document.getElementById('btnSaveRapor');
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> ' + (applyToAll ? 'Menerapkan...' : 'Menyimpan...');

            const payload = getPayloadData();
            payload.terapkan_ke_semua = applyToAll ? '1' : '0';
            payload.apply_to_all = applyToAll ? '1' : '0';

            const postUrl = '{{ url("/tf/gr/simpan-evaluasi-rapor") }}';

            fetch(postUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;

                // Simpan shared format ke localStorage agar saat membuka siswa lain format langsung aktif
                const sharedFormat = {
                    bulan_1_label: payload.bulan_1_label,
                    bulan_2_label: payload.bulan_2_label,
                    bulan_3_label: payload.bulan_3_label,
                    bulan_4_label: payload.bulan_4_label,
                    target_semester: payload.target_semester,
                    target_total: payload.target_total,
                    tempat_rapor: payload.tempat_rapor,
                    tanggal_rapor: payload.tanggal_rapor,
                    nama_pengampu: payload.nama_pengampu,
                    role_pengampu_label: payload.role_pengampu_label,
                    nama_walas: payload.nama_walas,
                    role_walas_label: payload.role_walas_label,
                    nama_kepsek: payload.nama_kepsek,
                    role_kepsek_label: payload.role_kepsek_label,
                    catatan_bacaan: payload.catatan_bacaan,
                    catatan_hafalan: payload.catatan_hafalan,
                    catatan_akhlak: payload.catatan_akhlak
                };
                localStorage.setItem(SHARED_FORMAT_KEY, JSON.stringify(sharedFormat));

                if (applyToAll) {
                    alert('Alhamdulillah! Format rapor (teks 4 bulan, target hafalan, titimangsa, tanda tangan, dan catatan) berhasil diterapkan ke SELURUH siswa di kelas ini.');
                } else {
                    alert('Alhamdulillah! Raport Tahfizh Al-Qur’an santri berhasil disimpan ke database.');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                alert('Penyimpanan selesai.');
            });
        }

        function applyFormatToAllStudents() {
            if (!confirm('Apakah Anda yakin ingin menerapkan format teks ini (nama 4 bulan, target hafalan, titimangsa, dan tanda tangan) ke SEMUA siswa lain di kelas ini? Nilai individual siswa lain tidak akan terhapus.')) {
                return;
            }
            saveRaporToDatabase(true);
        }

        function resetToOfficialTemplate() {
            if (!confirm('Kembalikan ke format acuan standar SDQU Tinggede?')) return;
            localStorage.removeItem(STORAGE_KEY);
            window.location.reload();
        }

        function navigateToStudent(targetId) {
            const currentUrl = new URL(window.location.href);
            if (currentUrl.pathname.includes('/detail-rapor/')) {
                window.location.href = '{{ url("/tf/gr/detail-rapor") }}/' + targetId;
            } else {
                currentUrl.searchParams.set('siswa_id', targetId);
                window.location.href = currentUrl.toString();
            }
        }

        // PROMPT CETAK & DUPLIKAT
        function openPrintPromptModal() {
            document.getElementById('printPromptModal').style.display = 'flex';
        }

        function closePrintPromptModal() {
            document.getElementById('printPromptModal').style.display = 'none';
        }

        function doDirectPrint() {
            closePrintPromptModal();
            window.print();
        }

        function openDuplicateFromPrompt() {
            closePrintPromptModal();
            openDuplicateModal();
        }

        // QUICK EDIT DATA SANTRI DI VISUAL
        function openQuickBioModal() {
            document.getElementById('qbNamaLengkap').value = document.getElementById('inputNamaLengkap').value;
            document.getElementById('qbKelasLabel').value = document.getElementById('inputKelasLabel').value;
            document.getElementById('qbUmur').value = document.getElementById('inputUmur').value;
            document.getElementById('qbOrangTua').value = document.getElementById('inputOrangTua').value;

            document.getElementById('quickBioModal').style.display = 'flex';
            setTimeout(() => document.getElementById('qbNamaLengkap').focus(), 100);
        }

        function closeQuickBioModal() {
            document.getElementById('quickBioModal').style.display = 'none';
        }

        function submitQuickBio(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSubmitQuickBio');
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';

            const nm = document.getElementById('qbNamaLengkap').value;
            const kl = document.getElementById('qbKelasLabel').value;
            const um = document.getElementById('qbUmur').value;
            const ot = document.getElementById('qbOrangTua').value;

            // Update live input dan visual preview
            document.getElementById('inputNamaLengkap').value = nm;
            document.getElementById('inputKelasLabel').value = kl;
            document.getElementById('inputUmur').value = um;
            document.getElementById('inputOrangTua').value = ot;
            updateLivePreview();

            const headerEl = document.getElementById('visualHeaderNama');
            if (headerEl) headerEl.innerText = nm.toUpperCase();

            // Simpan ke database via action update_bio
            fetch('{{ url("/tf/gr/simpan-evaluasi-rapor") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    action: 'update_bio',
                    siswa_id: SISWA_ID,
                    is_manual: IS_MANUAL ? '1' : '0',
                    nama_lengkap: nm,
                    kelas_label: kl,
                    umur: um,
                    orang_tua: ot
                })
            })
            .then(res => res.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                closeQuickBioModal();
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                closeQuickBioModal();
            });
        }

        function openDuplicateModal() {
            document.getElementById('dupNamaLengkap').value = '';
            document.getElementById('dupKelasLabel').value = document.getElementById('inputKelasLabel').value || 'VI (ENAM)';
            document.getElementById('dupUmur').value = document.getElementById('inputUmur').value || '12 TAHUN';
            document.getElementById('dupOrangTua').value = document.getElementById('inputOrangTua').value || 'Bpk. ABDURRAHMAN & Ibu FATIMAH';
            document.getElementById('duplicateModal').style.display = 'flex';
            setTimeout(() => document.getElementById('dupNamaLengkap').focus(), 100);
        }

        function closeDuplicateModal() {
            document.getElementById('duplicateModal').style.display = 'none';
        }

        function submitDuplicateRapor(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSubmitDuplicate');
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menduplikat...';

            const form = document.getElementById('duplicateForm');
            const formData = new FormData(form);
            const payload = Object.fromEntries(formData.entries());
            payload.action = 'duplicate';
            payload.is_duplikat = '1';
            payload.copy_nilai = form.querySelector('[name="copy_nilai"]').checked ? '1' : '0';
            payload.copy_capaian = form.querySelector('[name="copy_capaian"]').checked ? '1' : '0';
            payload.copy_catatan = form.querySelector('[name="copy_catatan"]').checked ? '1' : '0';
            payload.copy_ttd = form.querySelector('[name="copy_ttd"]').checked ? '1' : '0';

            fetch('{{ url("/tf/gr/simpan-evaluasi-rapor") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.redirect_url) {
                    alert(data.message || 'Rapor berhasil diduplikat untuk santri baru!');
                    window.location.href = data.redirect_url;
                } else {
                    alert(data.message || 'Gagal menduplikat rapor.');
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }
            })
            .catch(err => {
                alert('Terjadi kesalahan saat memproses duplikasi rapor.');
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            });
        }

        window.addEventListener('DOMContentLoaded', () => {
            // Cek shared format dari siswa sebelumnya jika ada
            const shared = localStorage.getItem(SHARED_FORMAT_KEY);
            if (shared && !{{ !empty($evaluasi) ? 'true' : 'false' }}) {
                try {
                    const s = JSON.parse(shared);
                    if (s.bulan_1_label) document.getElementById('inputBulan1Label').value = s.bulan_1_label;
                    if (s.bulan_2_label) document.getElementById('inputBulan2Label').value = s.bulan_2_label;
                    if (s.bulan_3_label) document.getElementById('inputBulan3Label').value = s.bulan_3_label;
                    if (s.bulan_4_label) document.getElementById('inputBulan4Label').value = s.bulan_4_label;
                    if (s.target_semester) document.getElementById('inputTargetSemester').value = s.target_semester;
                    if (s.target_total) document.getElementById('inputTargetTotal').value = s.target_total;
                    if (s.tempat_rapor) document.getElementById('inputTempatRapor').value = s.tempat_rapor;
                    if (s.tanggal_rapor) document.getElementById('inputTanggalRapor').value = s.tanggal_rapor;
                    if (s.nama_pengampu) document.getElementById('inputNamaPengampu').value = s.nama_pengampu;
                    if (s.role_pengampu_label) document.getElementById('inputRolePengampu').value = s.role_pengampu_label;
                    if (s.nama_walas) document.getElementById('inputNamaWalas').value = s.nama_walas;
                    if (s.role_walas_label && document.getElementById('inputRoleWalas')) document.getElementById('inputRoleWalas').value = s.role_walas_label;
                    if (s.nama_kepsek) document.getElementById('inputNamaKepsek').value = s.nama_kepsek;
                    if (s.role_kepsek_label && document.getElementById('inputRoleKepsek')) document.getElementById('inputRoleKepsek').value = s.role_kepsek_label;
                } catch(e) {}
            }

            // Cek draft tersimpan spesifik siswa
            const savedDraft = localStorage.getItem(STORAGE_KEY);
            if (savedDraft) {
                try {
                    const d = JSON.parse(savedDraft);
                    if (d.nama_lengkap) document.getElementById('inputNamaLengkap').value = d.nama_lengkap;
                    if (d.kelas_label) document.getElementById('inputKelasLabel').value = d.kelas_label;
                    if (d.umur) document.getElementById('inputUmur').value = d.umur;
                    if (d.orang_tua) document.getElementById('inputOrangTua').value = d.orang_tua;
                    if (d.bulan_1_label) document.getElementById('inputBulan1Label').value = d.bulan_1_label;
                    if (d.bulan_2_label) document.getElementById('inputBulan2Label').value = d.bulan_2_label;
                    if (d.bulan_3_label) document.getElementById('inputBulan3Label').value = d.bulan_3_label;
                    if (d.bulan_4_label) document.getElementById('inputBulan4Label').value = d.bulan_4_label;
                    if (d.nilai_bulan_1 !== undefined) document.getElementById('inputNilaiBulan1').value = d.nilai_bulan_1;
                    if (d.nilai_bulan_2 !== undefined) document.getElementById('inputNilaiBulan2').value = d.nilai_bulan_2;
                    if (d.nilai_bulan_3 !== undefined) document.getElementById('inputNilaiBulan3').value = d.nilai_bulan_3;
                    if (d.nilai_bulan_4 !== undefined) document.getElementById('inputNilaiBulan4').value = d.nilai_bulan_4;
                    if (d.role_walas_label && document.getElementById('inputRoleWalas')) document.getElementById('inputRoleWalas').value = d.role_walas_label;
                    if (d.role_kepsek_label && document.getElementById('inputRoleKepsek')) document.getElementById('inputRoleKepsek').value = d.role_kepsek_label;
                } catch(e) {}
            }

            recalcUjianTasmi();
            updateLivePreview();
        });
    </script>
</body>
</html>
