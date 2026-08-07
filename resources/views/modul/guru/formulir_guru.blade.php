<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Guru - Sekolah Al-Qur'an Imam Syafi'i</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Form Guru -->
    <link rel="stylesheet" href="{{ asset('css/modul/guru/formulir_guru.css') }}">
</head>
<body>

    <!-- CONTAINER UTAMA -->
    <div class="form-guru-container">
        
        <!-- HEADER / TOPBAR -->
        <header class="topbar">
            <div class="topbar-title">
                <h2>Tambah Data Guru</h2>
                <p>Input data pribadi dan status penugasan pengampu</p>
            </div>
            <a href="javascript:history.back()" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </header>

        <!-- KONTEN FORM -->
        <section class="content-body">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-user-plus"></i> Formulir Bio Data Guru</h3>
                </div>
<<<<<<< HEAD

                <!-- Tambahkan enctype="multipart/form-data" untuk unggah file -->
=======
                <!-- DITAMBAHKAN enctype="multipart/form-data" UNTUK UPLOAD FILE -->
>>>>>>> e141cbf3358a111b5d7a626006416436fa7e3d20
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
                            <label for="nomorNig">Nomor Induk Guru (NIG) <span class="required">*</span></label>
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
<<<<<<< HEAD

=======
>>>>>>> e141cbf3358a111b5d7a626006416436fa7e3d20
                        <!-- JENIS SEKOLAH -->
                        <div class="form-group">
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
<<<<<<< HEAD

                        <!-- 6. UPLOAD FOTO & PREVIEW (BAGIAN DIBERBAIKI) -->
                        <div class="form-group full-width">
                            <label for="inputFoto">Foto Profil Guru</label>
=======
                        <!-- 6. UPLOAD FOTO & PREVIEW (DIUBAH MENJADI FILE INPUT) -->
                        <div class="form-group full-width">
                            <label for="inputFoto">Foto Profil</label>
>>>>>>> e141cbf3358a111b5d7a626006416436fa7e3d20
                            <div class="photo-preview-container">
                                <div class="input-wrapper file-input-wrapper" style="flex: 1;">
                                    <i class="fa-solid fa-image"></i>
<<<<<<< HEAD
                                    <input type="file" id="inputFoto" name="foto" accept="image/*">
=======
                                    <input type="file" id="inputFoto" name="foto">
>>>>>>> e141cbf3358a111b5d7a626006416436fa7e3d20
                                </div>
                                <div class="avatar-preview" id="avatarPreview">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </div>

                        <!-- 7. ALAMAT LENGKAP -->
                        <div class="form-group full-width">
                            <label for="alamat">Alamat Lengkap <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-map-location-dot" style="top: 16px;"></i>
                                <textarea id="alamat" name="alamat" placeholder="Masukkan alamat domisili lengkap..." required></textarea>
                            </div>
                        </div>

                        <!-- 8. CHECKBOX KELOMPOK 1 (STATUS KEPEGAWAIAN) -->
                        <div class="form-group full-width">
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
                        <!-- 9. CHECKBOX KELOMPOK 2 (PERAN TAHFIZ) -->
                        <div class="form-group full-width">
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
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Data Guru
                        </button>
                    </div>
                </form>

            </div>
        </section>
    </div>
    <!-- JAVASCRIPT LOGIC -->
    <script>
        // Fungsi Helper Mutual Exclusion (Hanya 1 Pilihan yang Aktif)
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
<<<<<<< HEAD
                            };
=======
                            }
>>>>>>> e141cbf3358a111b5d7a626006416436fa7e3d20
                        });
                    }
                });
            });
        }

        // Penerapan Mutual Exclusion untuk masing-masing kelompok
        makeExclusive('.chk-kepegawaian');
        makeExclusive('.chk-tahfiz');

<<<<<<< HEAD
        // Logic Preview Upload Foto
        const inputFoto = document.getElementById('inputFoto');
        const avatarPreview = document.getElementById('avatarPreview');

        inputFoto.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.innerHTML = `<img src="${e.target.result}" alt="Preview Foto" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`;
=======
        // Handling Preview Gambar & Reset
        const inputFoto = document.getElementById('inputFoto');
        const avatarPreview = document.getElementById('avatarPreview');

        inputFoto.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    avatarPreview.innerHTML = `<img src="${event.target.result}" alt="Preview Foto">`;
>>>>>>> e141cbf3358a111b5d7a626006416436fa7e3d20
                };
                reader.readAsDataURL(file);
            }
        });

        // Reset Handler
        document.getElementById('btnReset').addEventListener('click', () => {
            avatarPreview.innerHTML = `<i class="fa-solid fa-user"></i>`;
        });
    </script>
</body>
</html>