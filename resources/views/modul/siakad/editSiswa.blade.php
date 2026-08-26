<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa - Islamic Smart School</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/modul/siakad/editsiswa.css')}}">
</head>
<body>

<div class="app-shell">
    

    <div class="main-content">
        <header class="topbar">
            <div class="topbar-inner">
                <div class="topbar-title">
                    <span class="font-arabic">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</span>
                    <h1>Edit Data Santri / Siswa</h1>
                    <p>Perbarui Informasi Profil dan Akademik Siswa</p>
                </div>
                <a href="{{ url()->previous() }}" class="btn btn-outline">
                    <i class="fa-solid fa-arrow-left"></i> Batal
                </a>
            </div>
        </header>

        <main class="page">
            <div class="card form-card">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h3 class="card-title"><i class="fa-solid fa-user-pen"></i> Data Pribadi Siswa</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nisn">NISN <span class="required">*</span></label>
                            <input type="text" id="nisn" name="nisn" value="0051234567" required>
                        </div>
                        <div class="form-group">
                            <label for="nis">NIS <span class="required">*</span></label>
                            <input type="text" id="nis" name="nis" value="202301" required>
                        </div>
                        <div class="form-group full-width">
                            <label for="nama_lengkap">Nama Lengkap <span class="required">*</span></label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="Ahmad Al-Fatih" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L" selected>Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas <span class="required">*</span></label>
                            <select id="kelas" name="kelas" required>
                                <option value="X-A Tahfidz" selected>X-A Tahfidz</option>
                                <option value="XI-B IPA">XI-B IPA</option>
                                <option value="XII-A IPS">XII-A IPS</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label for="foto">Foto Profil Siswa</label>
                            <input type="file" id="foto" name="foto" class="file-input">
                            <small class="help-text">Format: JPG, PNG. Maksimal 2MB.</small>
                        </div>
                    </div>

                    <h3 class="card-title mt-20"><i class="fa-solid fa-people-roof"></i> Data Orang Tua / Wali</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" id="nama_ayah" name="nama_ayah" value="Muhammad Ibrahim">
                        </div>
                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" id="nama_ibu" name="nama_ibu" value="Siti Aminah">
                        </div>
                        <div class="form-group full-width">
                            <label for="no_wa">No. WhatsApp Orang Tua</label>
                            <input type="text" id="no_wa" name="no_wa" value="081234567890">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-gold">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

</body>
</html>