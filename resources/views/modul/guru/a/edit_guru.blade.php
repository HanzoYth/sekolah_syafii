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
    <link rel="stylesheet" href="{{ asset('css/modul/guru/edit_guru.css')}}">
</head>
<body>

    <div class="edit-container">
        
        <!-- HEADER & TOMBOL KEMBALI -->
        <div class="edit-header">
            <a href="kelola-guru.html" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <div class="header-title">
                <h2>Edit Profil Guru</h2>
                <p>Perbarui informasi biodata, jabatan, serta akun akses guru.</p>
            </div>
        </div>

        <!-- FORM CARD EDIT DATA GURU -->
        <div class="edit-card">
            <form action="#" method="POST" enctype="multipart/form-data">
                
                <!-- SECTION 1: FOTO PROFIL & FOTO UPLOAD -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-image"></i> Foto Profil
                    </div>
                    <div class="photo-upload-wrapper">
                        <!-- Tampilan Foto yang Ada Saat Ini -->
                        <img src="https://via.placeholder.com/150" alt="Foto Profil Guru" class="photo-preview" id="previewFoto">
                        
                        <div class="photo-input-group">
                            <label for="url_foto">Pilih Foto Baru</label>
                            <input type="file" id="url_foto" name="url_foto" class="file-input" accept="image/*" onchange="previewImage(event)">
                            <small class="text-muted">Format: JPG, PNG, atau WEBP (Maksimal 2MB)</small>
                        </div>
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
                            <input type="text" id="nama" name="nama" class="form-control" value="Ahmad Syarifuddin, S.Pd." required>
                        </div>

                        <!-- NIG (Nomor Induk Guru) -->
                        <div class="form-group">
                            <label for="nig">NIG (Nomor Induk Guru)</label>
                            <input type="text" id="nig" name="nig" class="form-control" value="19850712001" required>
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" value="Makassar" required>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="1985-07-12" required>
                        </div>

                        <!-- Agama -->
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <input type="text" id="agama" name="agama" class="form-control" value="Islam" required>
                        </div>

                        <!-- Pendidikan Terakhir -->
                        <div class="form-group">
                            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                            <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="form-control" required>
                                <option value="S1" selected>S1 - Sarjana</option>
                                <option value="S2">S2 - Magister</option>
                                <option value="S3">S3 - Doktor</option>
                                <option value="D3">D3 - Diploma</option>
                                <option value="SMA">SMA / MA Equivalent</option>
                            </select>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="form-group span-2">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" class="form-control" rows="3" required>Jl. Sultan Alauddin No. 45, Tamalate, Kota Makassar</textarea>
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
                            <input type="checkbox" name="guru_tetap" value="1" checked>
                            <span>Guru Tetap</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="guru_honor" value="1">
                            <span>Guru Honor</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="pengampu_tahfiz" value="1" checked>
                            <span>Pengampu Tahfiz</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="koordinator_tahfiz" value="1">
                            <span>Koordinator Tahfiz</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="kepala_sekolah" value="1">
                            <span>Kepala Sekolah</span>
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
                                <option value="1" selected>Cabang Pusat Makassar</option>
                                <option value="2">Cabang Gowa</option>
                                <option value="3">Cabang Maros</option>
                            </select>
                        </div>

                        <!-- Sekolah ID -->
                        <div class="form-group">
                            <label for="sekolah_id">Unit Sekolah</label>
                            <select id="sekolah_id" name="sekolah_id" class="form-control" required>
                                <option value="">-- Pilih Sekolah --</option>
                                <option value="101" selected>SMA Islam Terpadu</option>
                                <option value="102">SMP Islam Terpadu</option>
                                <option value="103">SD Islam Terpadu</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- SECTION 5: DATA AKUN (AKSES LOGIN) -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-key"></i> Data Akun Login
                    </div>

                    <div class="form-grid">
                        <!-- Username -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="ahmadsyarif" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="ahmad.syarif@sekolah.sch.id" required>
                        </div>

                        <!-- Password -->
                        <div class="form-group span-2">
                            <label for="password">Password Baru <small style="color: var(--text-muted); font-weight: normal;">(Kosongkan jika tidak ingin mengubah password)</small></label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password baru">
                        </div>
                    </div>
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

    <!-- Script Sederhana Preview Foto -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('previewFoto');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>