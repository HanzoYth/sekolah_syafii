<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Satpam - Sekolah Al-Qur'an Imam Syafi'i</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
    <!-- CSS Form Admin -->
    <link rel="stylesheet" href="{{ asset('css/modul/guru/formulir_admin.css') }}?v={{ time() }}">
</head>
<body>

    <!-- CONTAINER UTAMA -->
    <div class="form-guru-container">
        
        <!-- HEADER / TOPBAR -->
        <header class="topbar">
            <div class="topbar-title">
                <h2>Tambah Data Satpam</h2>
                <p>Input data pribadi Satpam</p>
            </div>
            <a href="/reg" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </header>

        <!-- KONTEN FORM -->
        <section class="content-body">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-user-plus"></i> Formulir Bio Data Satpam</h3>
                </div>

                <form id="formGuru" action="/sp/tbsp" method="POST" enctype="multipart/form-data">
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
                        <div class="form-group">
                            <label for="tanggalLahir">Agama<span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-calendar-days"></i>
                                <input type="text" id="agama" name="agama" class="form-control" required placeholder="Agama">
                            </div>
                        </div>

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

                        <div class="form-group">
                            <label for="jenisKelamin">Cabang <span class="required">*</span></label>
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

                        <!-- 7. ALAMAT LENGKAP -->
                        <div class="form-group full-width">
                            <label for="alamat">Alamat Lengkap <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-map-location-dot"></i>
                                <textarea id="alamat" name="alamat" placeholder="Masukkan alamat domisili lengkap..." required></textarea>
                            </div>
                        </div>

                    </div>

                    <!-- BUTTON ACTIONS -->
                    <div class="form-actions">
                        <button type="reset" class="btn-reset" id="btnReset">Reset</button>
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Data Satpam
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