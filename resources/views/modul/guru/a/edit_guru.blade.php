<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Guru - Dashboard Tahfiz</title>
    <!-- Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/edit_guru.css')}}?v={{ time() }}">
</head>
<body>

    <div class="edit-container">
        
        <!-- HEADER & TOMBOL KEMBALI -->
        <div class="edit-header">
            <a href="/gr/klgr" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <div class="header-title">
                <h2>Edit Profil Guru</h2>
                <p>Perbarui jabatan guru.</p>
            </div>
        </div>

        <!-- FORM CARD EDIT DATA GURU -->
        <div class="edit-card">
            <form action="/gr/updgr" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $data_guru->id ?? '1' }}" name="id_guru" id="id_guru">  
                
                <!-- SECTION 1: FOTO PROFIL & FOTO UPLOAD -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-image"></i> Foto Profil
                    </div>
                    <div class="photo-upload-wrapper">
                        <!-- Tampilan Foto yang Ada Saat Ini -->
                        <img src="{{ isset($data_guru->url_foto) ? route('file.show', $data_guru->url_foto) : 'https://via.placeholder.com/100' }}" alt="Foto Profil Guru" class="photo-preview" id="previewFoto" required>
                    </div>
                </div>

                <!-- SECTION 2: BIODATA PRIBADI GURU -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-user-gear"></i> Biodata Pribadi
                    </div>
                    
                    <div class="form-grid">
                        <!-- Nama Lengkap -->
                        <div class="form-group">
                            <label for="nama">Nama Lengkap & Gelar</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="{{ $data_guru->nama ?? 'Ahmad Fauzi, S.Pd.' }}" readonly>
                        </div>

                        <!-- NIG (Nomor Induk Guru) -->
                        <div class="form-group">
                            <label for="nig">NIG (Nomor Induk Guru)</label>
                            <input type="text" id="nig" name="nig" class="form-control" value="{{ $data_guru->nig ?? '19850101202301' }}" readonly>
                        </div>
                        <!-- Nomor Wa -->
                        <div class="form-group">
                            <label for="wa">WA (Nomor WA Aktif)</label>
                            <input type="text" id="wa" name="wa" class="form-control" value="{{ $nomor_wa ?? '081234567890' }}" readonly>
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" value="{{ $data_guru->tempat_lahir ?? 'Jakarta' }}" readonly>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ $data_guru->tanggal_lahir ?? '1990-05-15' }}" readonly>
                        </div>

                        <!-- Agama -->
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <input type="text" id="agama" name="agama" class="form-control" value="{{ $data_guru->agama ?? 'Islam' }}" readonly>
                        </div>

                        <!-- Pendidikan Terakhir -->
                        <div class="form-group">
                            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                            <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="form-control" disabled>
                                <option value="" disabled>-- Pilih Pendidikan --</option>
                                <option value="smp" {{ ($data_guru->pendidikan_terakhir ?? '') == 'smp' ? 'selected' : '' }}>SMP / Sederajat</option>
                                <option value="sma" {{ ($data_guru->pendidikan_terakhir ?? '') == 'sma' ? 'selected' : '' }}>SMA / MA / Sederajat</option>
                                <option value="s1" {{ ($data_guru->pendidikan_terakhir ?? 's1') == 's1' ? 'selected' : '' }}>S1 (Sarjana)</option>
                                <option value="s2" {{ ($data_guru->pendidikan_terakhir ?? '') == 's2' ? 'selected' : '' }}>S2 (Magister)</option>
                                <option value="s3" {{ ($data_guru->pendidikan_terakhir ?? '') == 's3' ? 'selected' : '' }}>S3 (Doktor)</option>
                            </select>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="form-group span-2">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" class="form-control" rows="3" readonly>{{ $data_guru->alamat ?? 'Jl. Pendidikan No. 45, Jakarta Selatan' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: JABATAN & PENUGASAN -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-briefcase"></i> Status & Peran Guru
                    </div>

                    <div class="checkbox-grid">
                        <label class="checkbox-card">
                            <input type="checkbox" name="guru_tetap" value="1" {{ ($data_guru->guru_tetap ?? true) ? 'checked' : '' }}>
                            <span>Guru Tetap</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="guru_honor" value="0" {{ ($data_guru->guru_honor ?? false) ? 'checked' : '' }}>
                            <span>Guru Honor</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="pengampu_tahfiz" value="1" {{ ($data_guru->pengampu_tahfiz ?? true) ? 'checked' : '' }}>
                            <span>Pengampu Tahfiz</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="koordinator_tahfiz" value="0" {{ ($data_guru->koordinator_tahfiz ?? false) ? 'checked' : '' }}>
                            <span>Koordinator Tahfiz</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="kepala_sekolah" value="0" {{ ($data_guru->kepala_sekolah ?? false) ? 'checked' : '' }}>
                            <span>Kepala Sekolah</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="wakil_sekolah" value="0" {{ ($data_guru->wakil_sekolah ?? false) ? 'checked' : '' }}>
                            <span>Wakil Kepala Sekolah</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="asisten" value="0" {{ ($data_guru->ast_krk ?? false) ? 'checked' : '' }}>
                            <span>Asisten Kurikulum</span>
                        </label>
                    </div>
                </div>

                <!-- SECTION 4: CABANG & SEKOLAH -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-school"></i> Penempatan Unit
                    </div>

                    <div class="form-grid">
                        <!-- Cabang ID -->
                        <div class="form-group">
                            <label for="cabang_id">Cabang Unit</label>
                            <select id="cabang_id" name="cabang_id" class="form-control" required>
                                <option value="">-- Pilih Cabang --</option>
                                @if(isset($data_cabang))
                                    @foreach ($data_cabang as $cb)
                                        <option value="{{ $cb->id }}" {{ $cb->id == ($data_guru->cabang_id ?? '') ? 'selected' : '' }}>{{ $cb->nama_cabang }}</option>
                                    @endforeach
                                @else
                                    <option value="1" selected>Cabang Pusat - Jakarta</option>
                                    <option value="2">Cabang Cabang 2 - Bandung</option>
                                @endif
                            </select>
                        </div>

                        <!-- Sekolah ID -->
                        <div class="form-group">
                            <label for="sekolah_id">Unit Sekolah</label>
                            <select id="sekolah_id" name="sekolah_id" class="form-control" required>
                                <option value="">-- Pilih Sekolah --</option>
                                @if(isset($data_jenis_sekolah))
                                    @foreach ($data_jenis_sekolah as $djs)
                                        <option value="{{ $djs->id }}" {{ $djs->id == ($data_guru->sekolah_id ?? '') ? 'selected' : '' }}>{{ $djs->jenis }}</option>
                                    @endforeach
                                @else
                                    <option value="1" selected>SMP Tahfiz</option>
                                    <option value="2">SMA Tahfiz</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <!-- SECTION 5: TUGAS WALI KELAS -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-user-graduate"></i> Penugasan Wali Kelas
                    </div>

                    <div class="form-grid">
                        <!-- Checkbox Status Wali Kelas -->
                        <div class="form-group">
                            <label class="checkbox-card">
                                <input type="checkbox" id="is_wali_kelas" name="is_wali_kelas" value="1" {{ ($cek_wallas ?? true) ? 'checked' : '' }}>
                                <span>Bertugas Sebagai Wali Kelas</span>
                            </label>
                        </div>

                        <!-- Select Pilihan Kelas -->
                        <div class="form-group">
                            <label for="kelas_id">Pilih Kelas Binaan</label>
                            <select id="kelas_id" name="kelas_id" class="form-control">
                                <option value="">-- Pilih Kelas --</option>
                                @if(isset($data_kelas))
                                    @foreach ($data_kelas as $value)
                                        <option value="{{ $value->id }}" {{ $value->nama_ruang == ($nama_kelas ?? '') ? 'selected' : '' }}>{{ $value->nama_ruang }}</option>
                                    @endforeach
                                @else
                                    <option value="1" selected>Kelas 7-A</option>
                                    <option value="2">Kelas 8-B</option>
                                    <option value="3">Kelas 9-C</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <!-- SECTION 6: JADWAL PIKET (DENGAN DATA DUMMY) -->
                <div class="form-section">
                    <div class="section-title section-title-flex">
                        <span><i class="fa-solid fa-calendar-days"></i> Jadwal Piket Guru</span>
                        <button type="button" class="btn-add-piket" id="btnAddPiket">
                            <i class="fa-solid fa-plus"></i> Tambah Piket
                        </button>
                    </div>

                    <div id="piketContainer" class="piket-container">
                        @php
                            // Data Dummy Jadwal Piket jika dari Backend belum dikirim
                            $dummyPiket = collect([
                                (object)['tanggal' => '2026-03-23', 'waktu' => '07:00'],
                                (object)['tanggal' => '2026-03-25', 'waktu' => '13:00'],
                                (object)['tanggal' => '2026-03-27', 'waktu' => '07:00']
                            ]);

                            $listPiket = (isset($data_piket) && count($data_piket) > 0) ? $data_piket :$dummyPiket;
                        @endphp

                        @foreach($listPiket as $piket)
                            <div class="piket-item">
                                <div class="form-group flex-1">
                                    <label>Tanggal Piket</label>
                                    <input type="date" name="piket_tanggal[]" class="form-control" value="{{ $piket->tanggal }}" required>
                                </div>
                                <div class="form-group flex-1">
                                    <label>Waktu Piket (Jam & Menit)</label>
                                    <input type="time" name="piket_waktu[]" class="form-control" value="{{ $piket->waktu }}" required>
                                </div>
                                <button type="button" class="btn-remove-piket btnRemovePiket" title="Hapus Piket">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <p id="emptyPiketNote" class="text-muted-note" style="display: none;">
                        Belum ada jadwal piket ditambahkan. Klik tombol <strong>+ Tambah Piket</strong> di atas.
                    </p>
                </div>

                <!-- TOMBOL SIMPAN -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>

    </div>

    <!-- Script Preview Foto, Checkbox Handlers & Dynamic Piket -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('previewFoto');
                output.src = reader.result;
            }
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        // Handler Checkbox General
        document.querySelectorAll(".checkbox-card input[type='checkbox']").forEach(checkbox => {
            checkbox.addEventListener('change', (e) => {
                e.target.value = e.target.checked ? 1 : 0;
            });
        });

        // Handler Khusus Wali Kelas
        const checkWaliKelas = document.getElementById('is_wali_kelas');
        const selectKelas = document.getElementById('kelas_id');

        function updateWaliKelasState() {
            if (checkWaliKelas.checked) {
                checkWaliKelas.value = 1;
                selectKelas.removeAttribute('disabled');
                selectKelas.setAttribute('required', 'required');
            } else {
                checkWaliKelas.value = 0;
                selectKelas.setAttribute('disabled', 'disabled');
                selectKelas.removeAttribute('required');
                selectKelas.value = "";
            }
        }

        if (checkWaliKelas) {
            updateWaliKelasState();
            checkWaliKelas.addEventListener('change', updateWaliKelasState);
        }

        // HANDLER DYNAMIC JADWAL PIKET
        const btnAddPiket = document.getElementById('btnAddPiket');
        const piketContainer = document.getElementById('piketContainer');
        const emptyPiketNote = document.getElementById('emptyPiketNote');

        function checkEmptyNote() {
            if (piketContainer.children.length === 0) {
                emptyPiketNote.style.display = 'block';
            } else {
                emptyPiketNote.style.display = 'none';
            }
        }

        // Jalankan pengecekan catatan kosong saat halaman pertama dimuat
        checkEmptyNote();

        // Event Tambah Baris Piket Baru
        btnAddPiket.addEventListener('click', function() {
            const piketRow = document.createElement('div');
            piketRow.className = 'piket-item';
            
            piketRow.innerHTML = `
                <div class="form-group flex-1">
                    <label>Tanggal Piket</label>
                    <input type="date" name="piket_tanggal[]" class="form-control" required>
                </div>
                <div class="form-group flex-1">
                    <label>Waktu Piket (Jam & Menit)</label>
                    <input type="time" name="piket_waktu[]" class="form-control" required>
                </div>
                <button type="button" class="btn-remove-piket btnRemovePiket" title="Hapus Piket">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            `;

            piketContainer.appendChild(piketRow);
            checkEmptyNote();
        });

        // Event Hapus Baris Piket
        piketContainer.addEventListener('click', function(e) {
            const removeBtn = e.target.closest('.btnRemovePiket');
            if (removeBtn) {
                const item = removeBtn.closest('.piket-item');
                if (item) {
                    item.remove();
                    checkEmptyNote();
                }
            }
        });
    </script>
</body>
</html>