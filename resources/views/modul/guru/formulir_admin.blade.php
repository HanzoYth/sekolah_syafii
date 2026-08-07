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
    <link rel="stylesheet" href="{{ asset('css/modul/guru/formulir_admin.css') }}">
</head>
<body>

    <!-- CONTAINER UTAMA -->
    <div class="form-guru-container">
        
        <!-- HEADER / TOPBAR -->
        <header class="topbar">
            <div class="topbar-title">
                <h2>Tambah Data admin</h2>
                <p>Input data pribadi admin</p>
            </div>
            <a href="javascript:history.back()" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </header>

        <!-- KONTEN FORM -->
        <section class="content-body">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-user-plus"></i> Formulir Bio Data admin</h3>
                </div>

                <!-- Tambahkan enctype="multipart/form-data" untuk unggah file -->
                <form id="formGuru" action="/ad/tbad" method="POST" enctype="multipart/form-data">
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

                        <!-- 6. PENDIDIKAN TERAKHIR -->
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

                        <!-- 7. UPLOAD FOTO & PREVIEW (DIBERBAIKI) -->
                        <div class="form-group full-width">
                            <label for="inputFoto">Foto Profil Admin</label>
                            <div class="photo-preview-container">
                                <div class="input-wrapper" style="flex: 1;">
                                    <i class="fa-solid fa-image"></i>
                                    <input type="file" id="inputFoto" name="foto" accept="image/*">
                                </div>
                                <div class="avatar-preview" id="avatarPreview">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </div>

                        <!-- 8. ALAMAT LENGKAP -->
                        <div class="form-group full-width">
                            <label for="alamat">Alamat Lengkap <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-map-location-dot" style="top: 16px;"></i>
                                <textarea id="alamat" name="alamat" placeholder="Masukkan alamat domisili lengkap..." required></textarea>
                            </div>
                        </div>

                    </div>

                    <!-- BUTTON ACTIONS -->
                    <div class="form-actions">
                        <button type="reset" class="btn-reset" id="btnReset">Reset</button>
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Data Admin
                        </button>
                    </div>
                </form>

            </div>
        </section>

    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        const inputFoto = document.getElementById('inputFoto');
        const avatarPreview = document.getElementById('avatarPreview');
        const defaultAvatarHtml = '<i class="fa-solid fa-user"></i>';

        // Live Preview Foto File Lokal
        inputFoto.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.innerHTML = `<img src="${e.target.result}" alt="Preview Foto" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`;
                };
                reader.readAsDataURL(file);
            } else {
                avatarPreview.innerHTML = defaultAvatarHtml;
            }
        });

        // Reset Handler
        document.getElementById('btnReset').addEventListener('click', () => {
            setTimeout(() => {
                avatarPreview.innerHTML = defaultAvatarHtml;
            }, 10);
        });
    </script>
</body>
</html>