<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Role & Hak Akses Khusus</title>

    <!-- FontAwesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS khusus tanpa sidebar -->
    <link rel="stylesheet" href="{{ asset('css/identitas.css') }}">
</head>
<body>

    <!-- Container Utama Full Width (Tanpa Sidebar) -->
    <main class="full-page-wrapper">
        <div class="form-card-container">
            
            <!-- Banner Header Islami Premium -->
            <div class="islamic-banner">
                <div class="banner-content">
                    <div class="bismillah-text">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
                    <div class="banner-title">
                        <h2>Form Pengaturan Role & Klasifikasi Pengguna</h2>
                        <p>Kelola entitas identitas, jenis akses, dan peran khusus staf pengajar serta siswa.</p>
                    </div>
                </div>
                <div class="banner-badge">
                    <i class="fa-solid fa-user-shield"></i> Fitur Khusus
                </div>
            </div>

            <form action="/add/idnt" method="POST" id="form-role-khusus">
                @csrf

                <!-- Section 1: Role & Identitas -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-id-card-clip"></i>
                        <h4>Akses Utama & Identitas</h4>
                    </div>
                    <input type="hidden" value="{{$jumlah}}" id="total">

                    <div class="form-grid-2">
                        <!-- 1. Input Jenis Role -->
                        <div class="form-group">
                            <label for="role_type"><i class="fa-solid fa-user-tag"></i> Jenis Role</label>
                            <select id="role_type" name="role_type" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Role Pengguna --</option>
                                <option value="a">Admin</option>
                                <option value="g">Guru</option>
                                <option value="s">Siswa</option>
                            </select>
                        </div>

                        <!-- 2. Input Kode Identitas + Tombol Generate -->
                        <div class="form-group">
                            <label for="kode_identitas"><i class="fa-solid fa-key"></i> Kode Identitas Sistem</label>
                            <div class="input-action-group">
                                <input type="text" id="kode_identitas" name="kode_identitas" class="form-control readonly-input" placeholder="pilih role....." readonly required>  
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Action Buttons -->
                <div class="form-actions-footer">
                    <button type="button" class="btn-cancel" onclick="kembali()">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </button>
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Data Pengguna
                    </button>
                </div>

            </form>

        </div>
    </main>

    <!-- JS untuk memanggil logika generate kamu -->
    <script src="{{asset('js/identitas.js')}}"></script>
</body>
</html>