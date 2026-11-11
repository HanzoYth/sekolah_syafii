<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai Raport Tahfizh Al-Qur'an — SDQU Imam Syafi'i</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama Dashboard & Rapor Tahfiz -->
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/dashboard.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/rapor_walas.css') }}?v={{ time() }}">
    
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- SIDEBAR TAHFIZ -->
        <x-sidebar_tahfiz />

        <!-- MAIN CONTENT -->
        <main class="main-content" style="padding-bottom: 90px;">

            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <div>
                    <h2>Input Nilai Raport Tahfizh Al-Qur'an</h2>
                    <p style="font-size: 13px; color: var(--text-muted); margin-top: 4px;">
                        Form input nilai ujian tahfidzh (Ujian 1, Ujian 2, Ujian Akhir x2), kenaikan juz, capaian target hafalan, dan catatan pengampu halaqah.
                    </p>
                </div>
                <div class="topbar-icons">
                    @php
                        $raporUrl = request()->is('tf/gr/rapor*') || request()->is('tf/gr/input-nilai*')
                            ? url('/tf/gr/rapor?kelas_id='.$kelas_id)
                            : url('/tf/gr/rp?view=rapor&kelas_id='.$kelas_id);
                    @endphp
                    <a href="{{ $raporUrl }}" title="Ke Halaman Cetak Rapor" class="btn-tahfiz-secondary" style="padding: 6px 12px; font-size: 12px;">
                        <i class="fa-solid fa-file-contract"></i> Cetak Rapor
                    </a>
                    <a href="/tf/gr/dash" title="Dashboard Guru" style="color: var(--text-muted); text-decoration: none;">
                        <i class="fa-solid fa-house"></i>
                    </a>
                </div>
            </header>

            {{-- NOTIFIKASI SUCCESS --}}
            @if(session('success'))
                <div style="background: #E8F5E9; border: 1px solid #A5D6A7; color: #1B5E20; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-circle-check" style="font-size: 18px;"></i>
                        <div>
                            <strong style="font-size: 13px;">Berhasil!</strong>
                            <p style="font-size: 12px; margin: 0;">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: #1B5E20;">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            <!-- PILIH KELAS & INFO TAHUN AKADEMIK -->
            <div class="rapor-toolbar-card">
                <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                    <label for="selectKelas" style="font-size: 13px; font-weight: 700; color: var(--primary-dark);">
                        <i class="fa-solid fa-school"></i> Pilih Rombongan Belajar:
                    </label>
                    <select id="selectKelas" onchange="changeKelas(this.value)" style="padding: 8px 16px; border-radius: 10px; border: 1.5px solid var(--primary-color); font-size: 13px; background: #FAF8F2; font-weight: 700; color: var(--text-dark);">
                        @foreach($daftar_semua_kelas as $k)
                            <option value="{{ $k->id }}" {{ $kelas_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_ruang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="display: flex; align-items: center; gap: 10px; font-size: 12px; color: var(--text-muted);">
                    <span><i class="fa-solid fa-calendar-check text-emerald-600"></i> Semester: <strong>{{ ($tahun_aktif->semester ?? 1) == 1 ? '1 (Ganjil)' : '2 (Genap)' }}</strong></span>
                    <span>•</span>
                    <span>Tahun: <strong>{{ $tahun_aktif->nama ?? '2025/2026' }}</strong></span>
                    <span>•</span>
                    <span>Lembaga: <strong>SDQU Imam Syafi’i</strong></span>
                </div>
            </div>

            <!-- FORM UTAMA INPUT NILAI MASSAL -->
            @php
                $formAction = request()->is('tf/gr/input-nilai*')
                    ? url('/tf/gr/simpan-massal-nilai')
                    : url('/tf/gr/simpan-massal-nilai');
            @endphp
            <form action="{{ $formAction }}" method="POST" id="formInputNilai">
                @csrf
                <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">

                <!-- ============================================================ -->
                <!-- SECTION 1: MASTER PENGATURAN TARGET & PENGESAHAN KELAS       -->
                <!-- ============================================================ -->
                <div class="input-nilai-card">
                    <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 12px; margin-bottom: 16px;">
                        <h4 style="font-size: 15px; font-weight: 700; color: var(--primary-dark); margin: 0; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-book-quran text-emerald-600"></i> Pengaturan Target Tahfidz & Pengesahan Dokumen
                        </h4>
                        <span style="font-size: 11px; background: var(--gold-light); color: var(--gold); padding: 3px 10px; border-radius: 6px; font-weight: 700;">
                            Berlaku untuk Rombel Ini
                        </span>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 14px; margin-bottom: 14px;">
                        <div class="editor-form-group" style="margin: 0;">
                            <label>Target Hafalan Semester:</label>
                            <input type="text" name="target_semester" class="editor-form-control" value="1 Juz" required>
                        </div>
                        <div class="editor-form-group" style="margin: 0;">
                            <label>Target Total Hafalan:</label>
                            <input type="text" name="target_total" class="editor-form-control" value="9 Juz" required>
                        </div>
                        <div class="editor-form-group" style="margin: 0;">
                            <label>Tempat & Tanggal Titimangsa:</label>
                            <div style="display: flex; gap: 6px;">
                                <input type="text" name="tempat_rapor" class="editor-form-control" style="width: 90px;" value="Sigi" required>
                                <input type="text" name="tanggal_rapor" class="editor-form-control" value="20 Desember 2025" required>
                            </div>
                        </div>
                        <div class="editor-form-group" style="margin: 0;">
                            <label>Pengampu Halaqah (Kiri):</label>
                            <input type="text" name="nama_pengampu" class="editor-form-control" value="{{ $default_template['nama_pengampu'] ?? 'USTADZAH PENGAMPU HALAQAH' }}" required>
                        </div>
                        <div class="editor-form-group" style="margin: 0;">
                            <label>Wali Kelas (Kanan):</label>
                            <input type="text" name="nama_walas" class="editor-form-control" value="{{ $default_template['nama_walas'] ?? 'NURUL ZHAFIRAH PUTRI' }}" required>
                            <input type="hidden" name="role_pengampu_label" value="Wali Kelas 6">
                        </div>
                        <div class="editor-form-group" style="margin: 0;">
                            <label>Kepala Sekolah (Tengah Bawah):</label>
                            <input type="text" name="nama_kepsek" class="editor-form-control" value="{{ $default_template['nama_kepsek'] ?? 'NABILAH TUL ISLAMIYAH S.Pd.,S.Q' }}" required>
                        </div>
                    </div>

                    <!-- Keterangan Standar Predikat Sesuai Format Resmi -->
                    <div style="background: #F4F0E6; border: 1px solid var(--border-color); border-radius: 8px; padding: 10px 14px; font-size: 11.5px; color: #222;">
                        <strong style="color: var(--primary-dark);"><i class="fa-solid fa-scale-balanced"></i> Rumus & Skala Predikat Resmi SDQU:</strong><br>
                        <span>Jumlah = Ujian 1 + Ujian 2 + (Ujian Akhir × 2) &nbsp;•&nbsp; Nilai Rata-rata = Jumlah ÷ 4</span><br>
                        <span style="font-weight: 700; color: #333; margin-top: 3px; display: inline-block;">
                            Mumtaz/A: 91–100 &nbsp;|&nbsp; Jayyid Jiddan/B: 83–90 &nbsp;|&nbsp; Jayyid/C: 72–82 &nbsp;|&nbsp; Maqbul/D: 61–71 &nbsp;|&nbsp; Dha’if/E: &lt;60
                        </span>
                    </div>
                </div>

                <!-- ============================================================ -->
                <!-- SECTION 2: TOOLBAR AKSI CEPAT & FILTER PENCARIAN              -->
                <!-- ============================================================ -->
                <div class="batch-action-toolbar">
                    <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                        <span style="font-size: 12px; font-weight: 700; color: var(--text-dark);">
                            <i class="fa-solid fa-wand-magic-sparkles text-emerald-600"></i> Aksi Cepat:
                        </span>
                        <button type="button" onclick="setTemplateValues()" class="quick-fill-btn bsh" title="Isi semua dengan contoh nilai standar">
                            <i class="fa-solid fa-fill-drip"></i> Isi Nilai Standar (75, 92, 75)
                        </button>
                        <button type="button" onclick="recalcAllRows()" class="quick-fill-btn sb" title="Hitung ulang semua rata-rata & predikat">
                            <i class="fa-solid fa-calculator"></i> Hitung Ulang Semua
                        </button>
                    </div>

                    <div class="rapor-search-box">
                        <i class="fa-solid fa-magnifying-glass" style="color: #999; font-size: 12px;"></i>
                        <input type="text" id="searchSantriInput" placeholder="Cari santri..." onkeyup="filterSantriTable()">
                    </div>
                </div>

                <!-- ============================================================ -->
                <!-- SECTION 3: TABEL MATRIKS PENILAIAN TAHFIDZ SELURUH SANTRI     -->
                <!-- ============================================================ -->
                <div class="rapor-table-card">
                    <div class="rapor-table-header">
                        <h4>
                            <i class="fa-solid fa-list-check text-emerald-600"></i>
                            Daftar Santri — {{ $currentKelas->nama_ruang ?? 'Kelas 6' }} ({{ count($siswa) }} Santri)
                        </h4>
                        <div style="font-size: 12px; color: var(--text-muted);">
                            Nilai Rata-rata dan Predikat akan otomatis dihitung saat Anda mengetik nilai ujian.
                        </div>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="rapor-table" id="tableInputNilai">
                            <thead>
                                <tr>
                                    <th style="width: 35px; text-align: center;">No</th>
                                    <th style="min-width: 170px;">Santri & Orang Tua</th>
                                    <th style="min-width: 80px; text-align: center;">Ujian 1</th>
                                    <th style="min-width: 80px; text-align: center;">Ujian 2</th>
                                    <th style="min-width: 95px; text-align: center;">Ujian Akhir (×2)</th>
                                    <th style="min-width: 120px; text-align: center;">Rata-rata & Predikat</th>
                                    <th style="min-width: 130px; text-align: center;">Kenaikan Juz</th>
                                    <th style="min-width: 170px;">Pencapaian Semester</th>
                                    <th style="min-width: 150px;">Total Hafalan</th>
                                    <th style="min-width: 110px; text-align: center;">Target Tercapai?</th>
                                    <th style="width: 65px; text-align: right;">Cetak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($siswa as $index => $s)
                                    @php
                                        $eval = $evaluasi_list->get($s->id);
                                        $u1 = $eval->ujian_1 ?? 75.0;
                                        $u2 = $eval->ujian_2 ?? 92.0;
                                        $ua = $eval->ujian_akhir ?? 75.0;
                                        $jml = $u1 + $u2 + ($ua * 2);
                                        $rata = round($jml / 4, 1);
                                        $pred = \App\Models\evaluasi_rapor_tahfidz::calculatePredikat($rata);

                                        $initials = collect(explode(' ', $s->nama))->map(fn($part) => substr($part, 0, 1))->take(2)->join('');

                                        $detailUrl = request()->is('tf/gr/input-nilai*') || request()->is('tf/gr/rapor*')
                                            ? url('/tf/gr/detail-rapor/'.$s->id)
                                            : url('/tf/gr/rp?view=detail_rapor&siswa_id='.$s->id);
                                    @endphp
                                    <tr class="santri-input-row" data-id="{{ $s->id }}">
                                        <td style="text-align: center; font-weight: 600; color: #666;">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="rapor-student-cell">
                                                <div class="rapor-student-avatar">
                                                    {{ strtoupper($initials) }}
                                                </div>
                                                <div class="rapor-student-meta">
                                                    <h5 style="margin: 0; font-size: 13px;">{{ $s->nama }}</h5>
                                                    <div style="margin-top: 3px;">
                                                        <input type="text" name="nilai[{{ $s->id }}][orang_tua]" class="editor-form-control" style="font-size: 11px; padding: 3px 6px;" value="{{ $eval->orang_tua ?? 'Bpk. ZULFIKAR ABDUN & Ibu NAZMA SYAWIE' }}" placeholder="Nama Orang Tua/Wali">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Ujian 1 -->
                                        <td style="text-align: center;">
                                            <input type="number" step="0.1" name="nilai[{{ $s->id }}][ujian_1]" id="u1_{{ $s->id }}" class="editor-form-control row-u1" style="text-align: center; font-weight: 700; width: 70px; padding: 6px 4px;" value="{{ $u1 }}" oninput="recalcRow({{ $s->id }})">
                                        </td>

                                        <!-- Ujian 2 -->
                                        <td style="text-align: center;">
                                            <input type="number" step="0.1" name="nilai[{{ $s->id }}][ujian_2]" id="u2_{{ $s->id }}" class="editor-form-control row-u2" style="text-align: center; font-weight: 700; width: 70px; padding: 6px 4px;" value="{{ $u2 }}" oninput="recalcRow({{ $s->id }})">
                                        </td>

                                        <!-- Ujian Akhir (x 2) -->
                                        <td style="text-align: center;">
                                            <input type="number" step="0.1" name="nilai[{{ $s->id }}][ujian_akhir]" id="ua_{{ $s->id }}" class="editor-form-control row-ua" style="text-align: center; font-weight: 700; width: 75px; padding: 6px 4px;" value="{{ $ua }}" oninput="recalcRow({{ $s->id }})">
                                        </td>

                                        <!-- Rata-rata & Predikat Auto -->
                                        <td style="text-align: center;">
                                            <div style="font-weight: 800; font-size: 13px; color: var(--primary-dark);" id="rataText_{{ $s->id }}">
                                                {{ number_format($rata, 1, ',', '') }}
                                            </div>
                                            <span class="rapor-badge bsh" style="margin-top: 2px;" id="predBadge_{{ $s->id }}">{{ $pred }}</span>
                                        </td>

                                        <!-- Kenaikan Juz -->
                                        <td>
                                            <div style="display: flex; gap: 4px;">
                                                <input type="text" name="nilai[{{ $s->id }}][kenaikan_juz_nomor]" class="editor-form-control" style="font-size: 11px; padding: 5px; width: 55px;" value="{{ $eval->kenaikan_juz_nomor ?? '25' }}" placeholder="Juz">
                                                <input type="text" name="nilai[{{ $s->id }}][kenaikan_juz_predikat]" class="editor-form-control" style="font-size: 11px; padding: 5px;" value="{{ $eval->kenaikan_juz_predikat ?? 'Jayyid/C' }}" placeholder="Predikat">
                                            </div>
                                        </td>

                                        <!-- Pencapaian Semester -->
                                        <td>
                                            <input type="text" name="nilai[{{ $s->id }}][tercapai_semester]" class="editor-form-control" style="font-size: 11px; padding: 5px;" value="{{ $eval->tercapai_semester ?? '<1 Juz (19 Hal) (Az-Zukhruf 32 – Az-Zumar 22)' }}">
                                        </td>

                                        <!-- Total Hafalan -->
                                        <td>
                                            <input type="text" name="nilai[{{ $s->id }}][tercapai_total]" class="editor-form-control" style="font-size: 11px; padding: 5px;" value="{{ $eval->tercapai_total ?? '6,5 Juz (An-nas – Az-Zumar 22)' }}">
                                        </td>

                                        <!-- Target Tercapai? -->
                                        <td style="font-size: 11px; text-align: center;">
                                            @php
                                                $semIya = ($eval->tercapai_target_semester ?? false);
                                                $klsIya = ($eval->tercapai_target_kelas ?? false);
                                            @endphp
                                            <div style="display: flex; flex-direction: column; gap: 4px; align-items: center;">
                                                <label style="cursor: pointer; display: flex; align-items: center; gap: 3px;" title="Target Semester Tercapai">
                                                    <input type="checkbox" name="nilai[{{ $s->id }}][tercapai_target_semester]" value="1" {{ $semIya ? 'checked' : '' }}>
                                                    <span>Target Sem</span>
                                                </label>
                                                <label style="cursor: pointer; display: flex; align-items: center; gap: 3px;" title="Target Kelas Tercapai">
                                                    <input type="checkbox" name="nilai[{{ $s->id }}][tercapai_target_kelas]" value="1" {{ $klsIya ? 'checked' : '' }}>
                                                    <span>Target Kls</span>
                                                </label>
                                            </div>
                                        </td>

                                        <!-- Hidden Inputs untuk Catatan agar tetap aman jika tidak diubah di modal -->
                                        <input type="hidden" name="nilai[{{ $s->id }}][catatan_bacaan]" value="{{ $eval->catatan_bacaan ?? $default_template['catatan_bacaan'] }}">
                                        <input type="hidden" name="nilai[{{ $s->id }}][catatan_hafalan]" value="{{ $eval->catatan_hafalan ?? $default_template['catatan_hafalan'] }}">
                                        <input type="hidden" name="nilai[{{ $s->id }}][catatan_akhlak]" value="{{ $eval->catatan_akhlak ?? $default_template['catatan_akhlak'] }}">

                                        <!-- Aksi Rapor -->
                                        <td style="text-align: right; white-space: nowrap;">
                                            <a href="{{ $detailUrl }}" target="_blank" class="btn-tahfiz-secondary" style="padding: 6px 10px; font-size: 11px;" title="Lihat & Cetak Raport">
                                                <i class="fa-solid fa-print"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" style="text-align: center; padding: 40px; color: #888;">
                                            Belum ada data santri pada rombel ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ============================================================ -->
                <!-- FLOATING STICKY ACTION BAR UNTUK SIMPAN MASSAL              -->
                <!-- ============================================================ -->
                <div class="sticky-save-bar">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <span style="font-size: 13px; font-weight: 700; color: var(--primary-dark);">
                            <i class="fa-solid fa-layer-group text-emerald-600"></i> Total: {{ count($siswa) }} Santri Rombel
                        </span>
                        <span style="font-size: 12px; color: var(--text-muted);">
                            Data ujian, target, dan capaian hafalan akan otomatis masuk ke lembar cetak raport tahfizh.
                        </span>
                    </div>

                    <div style="display: flex; align-items: center; gap: 10px;">
                        <a href="{{ $raporUrl }}" class="btn-tahfiz-secondary">
                            <i class="fa-solid fa-arrow-left"></i> Kembali ke Rapor
                        </a>
                        <button type="submit" id="btnSimpanMassal" class="btn-tahfiz-primary" style="padding: 10px 24px; font-size: 13px;">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Seluruh Nilai Rapor
                        </button>
                    </div>
                </div>

            </form>

        </main>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        function changeKelas(kelasId) {
            const url = new URL(window.location.href);
            url.searchParams.set('kelas_id', kelasId);
            window.location.href = url.toString();
        }

        function calculatePredikat(num) {
            if (num >= 91) return 'Mumtaz/A';
            if (num >= 83) return 'Jayyid Jiddan/B';
            if (num >= 72) return 'Jayyid/C';
            if (num >= 61) return 'Maqbul/D';
            return 'Dha’if/E';
        }

        function recalcRow(siswaId) {
            const u1 = parseFloat(document.getElementById(`u1_${siswaId}`).value) || 0;
            const u2 = parseFloat(document.getElementById(`u2_${siswaId}`).value) || 0;
            const ua = parseFloat(document.getElementById(`ua_${siswaId}`).value) || 0;

            const jumlah = u1 + u2 + (ua * 2);
            const rata = Math.round((jumlah / 4) * 10) / 10;
            const predikat = calculatePredikat(rata);

            document.getElementById(`rataText_${siswaId}`).innerText = rata.toFixed(1).replace('.', ',');
            const badge = document.getElementById(`predBadge_${siswaId}`);
            badge.innerText = predikat;

            if (rata >= 91) badge.className = 'rapor-badge sb';
            else if (rata >= 83) badge.className = 'rapor-badge bsh';
            else if (rata >= 72) badge.className = 'rapor-badge bsh';
            else if (rata >= 61) badge.className = 'rapor-badge mb';
            else badge.className = 'rapor-badge bb';
        }

        function setTemplateValues() {
            document.querySelectorAll('.row-u1').forEach(i => i.value = 75);
            document.querySelectorAll('.row-u2').forEach(i => i.value = 92);
            document.querySelectorAll('.row-ua').forEach(i => i.value = 75);
            recalcAllRows();
        }

        function recalcAllRows() {
            document.querySelectorAll('tr.santri-input-row').forEach(row => {
                const id = row.getAttribute('data-id');
                if (id) recalcRow(id);
            });
        }

        function filterSantriTable() {
            const query = document.getElementById('searchSantriInput').value.toLowerCase();
            const rows = document.querySelectorAll('#tableInputNilai tbody tr.santri-input-row');
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        }

        document.getElementById('formInputNilai').addEventListener('submit', function(e) {
            const btn = document.getElementById('btnSimpanMassal');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan Nilai...';
        });
    </script>
</body>
</html>
