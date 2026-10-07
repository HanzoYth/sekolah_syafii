<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Staf - Sekolah Al-Qur'an Imam Syafi'i</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
    <!-- CSS Form Guru -->
    <link rel="stylesheet" href="{{ asset('css/modul/guru/formulir_guru.css') }}?v={{ time() }}">
</head>
<body>

    <!-- CONTAINER UTAMA -->
    <div class="form-guru-container">

        <x-warning />
        <!-- HEADER / TOPBAR -->
        <header class="topbar">
            <div class="topbar-title">
                <h2>Tambah Data Staf</h2>
                <p>Input data pribadi dan status penugasan pengampu</p>
            </div>
            <a href="/reg" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </header>

        <!-- KONTEN FORM -->
        <section class="content-body">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-user-plus"></i> Formulir Bio Data Staf</h3>
                </div>

                <form id="formGuru" action="/gr/tbgr" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        <!-- 1. NAMA LENGKAP -->
                        <div class="form-group">
                            <label for="namaGuru">Nama Lengkap <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" id="namaGuru" name="nama" placeholder="Contoh: Ustadz Ahmad, S.Pd." required autocomplete="off">
                            </div>
                        </div>

                        <!-- 2. NOMOR NIG -->
                        <div class="form-group">
                            <label for="nomorNig">Nomor Induk Tergantung Anda Punya <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-id-card"></i>
                                <input type="text" id="nomorNig" name="nig" placeholder="Contoh: 19920812202401" required autocomplete="off">
                            </div>
                        </div>

                        <!-- 3. TEMPAT LAHIR -->
                        <div class="form-group">
                            <label for="tempatLahir">Tempat Lahir <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-location-dot"></i>
                                <input type="text" id="tempatLahir" name="tempat_lahir" placeholder="Contoh: Jakarta" required autocomplete="off">
                            </div>
                        </div>

                        <!-- 4. TANGGAL LAHIR -->
                        <div class="form-group">
                            <label for="tanggalLahir">Tanggal Lahir <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-calendar-days"></i>
                                <input type="date" id="tanggalLahir" name="tanggal_lahir" required>
                            </div>
                        </div>

                        <!-- AGAMA -->
                        <div class="form-group">
                            <label for="agama">Agama <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-star-and-crescent"></i>
                                <input type="text" id="agama" name="agama" class="form-control" required placeholder="Agama">
                            </div>
                        </div>

                        <!-- 5. PENDIDIKAN TERAKHIR -->
                        <div class="form-group">
                            <label for="pendidikanTerakhir">Pendidikan Terakhir <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-graduation-cap"></i>
                                <select id="pendidikanTerakhir" name="pendidikan_terakhir" required>
                                    <option value="" disabled selected>-- Pilih Pendidikan --</option>
                                    <option value="smp">SMP / Sederajat</option>
                                    <option value="sma">SMA / MA / Sederajat</option>
                                    <option value="s1">S1 (Sarjana)</option>
                                    <option value="s2">S2 (Magister)</option>
                                    <option value="s3">S3 (Doktor)</option>
                                </select>
                            </div>
                        </div>

                        <!-- CABANG -->
                        <div class="form-group">
                            <label for="cabangSekolah">Cabang Sekolah <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-building-columns"></i>
                                <select id="cabangSekolah" name="cabang_id" required>
                                    <option value="" disabled selected>-- Pilih Cabang --</option>
                                    @foreach($cabang as $value)
                                        <option value="{{$value->id}}">{{$value->nama_cabang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <!-- JENIS KELAMIN -->
                        <div class="form-group">
                            <label for="jenisKelamin">Jenis Kelamin <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-venus-mars"></i>
                                <select id="jenisKelamin" name="jenis_kelamin" required>
                                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                    <option value="l">Laki-laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <!-- ===== JABATAN / POSISI (default: Guru) ===== -->
                        <div class="form-group" id="groupJabatan">
                            <label for="jabatan">Jabatan / Posisi <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-user-tie"></i>
                                <select id="jabatan" name="jabatan" required>
                                    <option value="guru" selected>Guru</option>
                                    <option value="bendahara">Bendahara</option>
                                    <option value="operator">Operator</option>
                                    <option value="satpam">Satpam</option>
                                </select>
                            </div>
                        </div>

                        <!-- JENIS SEKOLAH (hanya untuk Guru) -->
                        <div class="form-group guru-only">
                            <label for="jenisSekolah">Jenis Sekolah <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-building-columns"></i>
                                <select id="jenisSekolah" name="sekolah_id" required>
                                    <option value="" disabled selected>-- Pilih jenis sekolah --</option>
                                    @foreach($sekolah as $value)
                                        <option value="{{$value->id}}">{{$value->jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- 6. UPLOAD FOTO & PREVIEW (selalu tampil) -->
                        <div class="form-group full-width">
                            <label for="inputFoto">Foto Profil Staf</label>
                            <div class="photo-preview-container">
                                <div class="input-wrapper file-input-wrapper">
                                    <i class="fa-solid fa-image"></i>
                                    <input type="file" id="inputFoto" name="foto" accept="image/*">
                                </div>
                                <div class="avatar-preview" id="avatarPreview">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION BERKAS DOKUMEN ENKRIPSI/LAMPIRAN (hanya untuk Guru) -->
                        <div class="form-group full-width guru-only">
                            <div class="document-section-title">
                                <i class="fa-solid fa-folder-open"></i> Lampiran Dokumen Berkas
                            </div>
                        </div>

                        <!-- 7. UPLOAD KTP (hanya untuk Guru) -->
                        <div class="form-group guru-only">
                            <label for="inputKtp">File KTP <span class="required">*</span></label>
                            <div class="input-wrapper file-input-wrapper">
                                <i class="fa-solid fa-address-card"></i>
                                <input type="file" id="inputKtp" name="file_ktp" accept="application/pdf,image/jpeg,image/png,image/jpg"  required class="doc-file-input">
                            </div>
                            <small class="file-name-preview" id="previewKtp">Belum ada file dipilih</small>
                        </div>

                        <!-- 8. UPLOAD KK (hanya untuk Guru) -->
                        <div class="form-group guru-only">
                            <label for="inputKk">File Kartu Keluarga (KK) <span class="required">*</span></label>
                            <div class="input-wrapper file-input-wrapper">
                                <i class="fa-solid fa-users"></i>
                                <input type="file" id="inputKk" name="file_kk" accept="application/pdf,image/jpeg,image/png,image/jpg"  required class="doc-file-input">
                            </div>
                            <small class="file-name-preview" id="previewKk">Belum ada file dipilih</small>
                        </div>

                        <!-- 9. UPLOAD IJAZAH TERAKHIR (hanya untuk Guru) -->
                        <div class="form-group full-width guru-only">
                            <label for="inputIjazah">File Ijazah Terakhir <span class="required">*</span></label>
                            <div class="input-wrapper file-input-wrapper">
                                <i class="fa-solid fa-file-certificate"></i>
                                <input type="file" id="inputIjazah" name="file_ijazah" accept="application/pdf,image/jpeg,image/png,image/jpg"  required class="doc-file-input">
                            </div>
                            <small class="file-name-preview" id="previewIjazah">Belum ada file dipilih</small>
                        </div>

                        <!-- 10. ALAMAT LENGKAP -->
                        <div class="form-group full-width">
                            <label for="alamat">Alamat Lengkap <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-map-location-dot" style="top: 16px;"></i>
                                <textarea id="alamat" name="alamat" placeholder="Masukkan alamat domisili lengkap..." required></textarea>
                            </div>
                        </div>

                        <!-- 11. CHECKBOX KELOMPOK 1 (STATUS KEPEGAWAIAN) (hanya untuk Guru) -->
                        <div class="form-group full-width guru-only">
                            <div class="checkbox-section">
                                <div class="checkbox-section-title">
                                    <i class="fa-solid fa-briefcase"></i> Status Kepegawaian Guru
                                </div>
                                <div class="checkbox-group-inline">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="honor" value="0" class="chk-kepegawaian">
                                        <span>Guru Honor</span>
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="tetap" value="0" class="chk-kepegawaian">
                                        <span>Guru Tetap</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- 12. CHECKBOX KELOMPOK 2 (PERAN TAHFIZ) (hanya untuk Guru) -->
                        <div class="form-group full-width guru-only">
                            <div class="checkbox-section">
                                <div class="checkbox-section-title">
                                    <i class="fa-solid fa-book-quran"></i> Peran Penugasan Tahfiz
                                </div>
                                <div class="checkbox-group-inline">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="koordinator" value="0" class="chk-tahfiz">
                                        <span>Koordinator Tahfiz</span>
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="pengampu" value="0" class="chk-tahfiz">
                                        <span>Pengampu Tahfiz</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BUTTON ACTIONS -->
                    <div class="form-actions">
                        <button type="reset" class="btn-reset" id="btnReset">Reset</button>
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Data Staf
                        </button>
                    </div>
                </form>

            </div>
        </section>
    </div>
    <x-warning />
    <!-- JAVASCRIPT LOGIC -->
    <script>
        // Helper Mutual Exclusion untuk Checkbox
        function makeExclusive(selector) {
            const list = document.querySelectorAll(selector);
            list.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        this.value = 1;
                        list.forEach(other => {
                            if (other !== this) {
                                other.checked = false;
                                other.value = 0;
                            }
                        });
                    }
                });
            });
        }

        makeExclusive('.chk-kepegawaian');
        makeExclusive('.chk-tahfiz');

        // Logic Preview Upload Foto Profil
        const inputFoto = document.getElementById('inputFoto');
        const avatarPreview = document.getElementById('avatarPreview');

        inputFoto.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.innerHTML = `<img src="${e.target.result}" alt="Preview Foto">`;
                };
                reader.readAsDataURL(file);
            }
        });

        // Helper Handler Preview Nama Berkas Dokumen
        function bindFilePreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            input.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    preview.textContent = `File dipilih: ${this.files[0].name}`;
                    preview.classList.add('active');
                } else {
                    preview.textContent = 'Belum ada file dipilih';
                    preview.classList.remove('active');
                }
            });
        }

        bindFilePreview('inputKtp', 'previewKtp');
        bindFilePreview('inputKk', 'previewKk');
        bindFilePreview('inputIjazah', 'previewIjazah');

        // ===== Logic Tampil/Sembunyi berdasarkan Jabatan =====
        const selectJabatan = document.getElementById('jabatan');
        const groupJabatan = document.getElementById('groupJabatan');
        const guruOnlyBlocks = document.querySelectorAll('.guru-only');

        function resetFilePreviews() {
            document.querySelectorAll('.file-name-preview').forEach(el => {
                el.textContent = 'Belum ada file dipilih';
                el.classList.remove('active');
            });
        }

        function applyJabatan() {
            const isGuru = selectJabatan.value === 'guru';

            guruOnlyBlocks.forEach(block => {
                block.style.display = isGuru ? '' : 'none';

                // Field yang disembunyikan di-disable: tidak divalidasi (required)
                // dan tidak ikut terkirim ke server.
                block.querySelectorAll('input, select, textarea').forEach(field => {
                    field.disabled = !isGuru;

                    if (!isGuru) {
                        if (field.type === 'checkbox') {
                            field.checked = false;
                            field.value = 0;
                        } else if (field.type === 'file') {
                            field.value = '';
                        } else if (field.tagName === 'SELECT') {
                            field.selectedIndex = 1;
                        }
                    }
                });
            });

            if (!isGuru) resetFilePreviews();

            // Kalau Jenis Sekolah hilang, Jabatan dibuat selebar penuh agar rapi
            groupJabatan.classList.toggle('full-width', !isGuru);
        }

        selectJabatan.addEventListener('change', applyJabatan);
        applyJabatan(); // jalankan saat halaman pertama dimuat

        // Reset Handler
        document.getElementById('btnReset').addEventListener('click', () => {
            avatarPreview.innerHTML = `<i class="fa-solid fa-user"></i>`;
            resetFilePreviews();
            // Tunggu form selesai reset (Jabatan kembali ke Guru), lalu terapkan tampilannya
            setTimeout(applyJabatan, 0);
        });
    </script>
</body>
</html>