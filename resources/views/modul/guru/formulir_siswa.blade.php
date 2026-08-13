<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa - Sekolah Al-Qur'an Imam Syafi'i</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Form Admin -->
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/formulir_siswa.css') }}">
</head>
<body>

    <!-- CONTAINER UTAMA -->
    <div class="form-guru-container">
        
        <!-- HEADER / TOPBAR -->
        <header class="topbar">
            <div class="topbar-title">
                <h2>Tambah Data Siswa</h2>
                <p>Input data pribadi dan akademik siswa</p>
            </div>
            <a href="/siswa" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </header>

        <!-- KONTEN FORM -->
        <section class="content-body">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-user-graduate"></i> Formulir Bio Data Siswa</h3>
                </div>

                <form id="formSiswa" action="/sk/tbss" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        
                        <!-- 1. NAMA LENGKAP ($table->string('nama')) -->
                        <div class="form-group full-width">
                            <label for="namaSiswa">Nama Lengkap <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" id="namaSiswa" name="nama" placeholder="Contoh: Abdullah Ahmad" required autocomplete="off">
                            </div>
                        </div>

                        <!-- 2. NIS ($table->string('nis')->unique()) -->
                        <div class="form-group">
                            <label for="nis">Nomor Induk Siswa (NIS) <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-id-badge"></i>
                                <input type="text" id="nis" name="nis" placeholder="Contoh: 23241001" required autocomplete="off">
                            </div>
                        </div>

                        <!-- 4. TEMPAT LAHIR ($table->string('tempat_lahir')->nullable()) -->
                        <div class="form-group">
                            <label for="tempatLahir">Tempat Lahir</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-location-dot"></i>
                                <input type="text" id="tempatLahir" name="tempat_lahir" placeholder="Contoh: Jakarta" autocomplete="off">
                            </div>
                        </div>

                        <!-- 5. TANGGAL LAHIR ($table->date('tanggal_lahir')->nullable()) -->
                        <div class="form-group">
                            <label for="tanggalLahir">Tanggal Lahir</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-calendar-days"></i>
                                <input type="date" id="tanggalLahir" name="tanggal_lahir">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenisSekolah">Jenis Sekolah <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-building-columns"></i>
                                <select id="jenisSekolah" name="sekolah_id" required>
                                    <option value="" disabled selected>-- Pilih jenis sekolah --</option>
                                    @foreach($data_jenis_sekolah as $value)
                                        <option value="{{$value->id}}">{{$value->jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- 6. JENIS KELAMIN ($table->enum('jenis_kelamin', ['l', 'p'])) -->
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

                        <!-- 7. KELAS ($table->foreignId('kelas_id')) -->
                        <div class="form-group">
                            <label for="kelasId">Kelas</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-chalkboard-user"></i>
                                <select id="kelasId" name="kelas_id">
                                    <option value="" selected>-- Pilih Kelas --</option>
                                    @foreach ($data_ruang_kelas as $value)
                                        <option value="{{$value->id}}">{{$value->nama_ruang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- 8. TAHUN AJARAN ($table->foreignId('tahun_ajaran_id')) -->
                        <div class="form-group full-width">
                            <label for="tahunAjaranId">Tahun Ajaran</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-calendar-check"></i>
                                <select id="tahunAjaranId" name="tahun_ajaran_id">
                                    <option value="" selected>-- Pilih Tahun Ajaran --</option>
                                    @foreach ($data_tahun_ajaran as $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- 9. UPLOAD FOTO / URL FOTO ($table->string('url_foto')->nullable()) -->
                        <div class="form-group full-width">
                            <label for="inputFoto">Foto Profil Siswa</label>
                            <div class="photo-preview-container">
                                <div class="avatar-preview" id="avatarPreview">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-upload"></i>
                                    <input type="file" id="inputFoto" name="url_foto" accept="image/*">
                                </div>
                            </div>
                        </div>

                        <!-- 10. ALAMAT LENGKAP ($table->string('alamat')->nullable()) -->
                        <div class="form-group full-width">
                            <label for="alamat">Alamat Lengkap</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-map-location-dot"></i>
                                <textarea id="alamat" name="alamat" placeholder="Masukkan alamat domisili siswa..."></textarea>
                            </div>
                        </div>

                    </div>

                    <!-- BUTTON ACTIONS -->
                    <div class="form-actions">
                        <button type="reset" class="btn-reset" id="btnReset">Reset</button>
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Data Siswa
                        </button>
                    </div>
                </form>

            </div>
        </section>

        <x-warning />

    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        const inputFoto = document.getElementById('inputFoto');
        const avatarPreview = document.getElementById('avatarPreview');
        const defaultAvatarHtml = '<i class="fa-solid fa-user"></i>';

        // Live Preview Foto
        inputFoto.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.innerHTML = `<img src="${e.target.result}" alt="Preview Foto">`;
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