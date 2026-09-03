<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Tambah Ruang Kelas</title>
    
    <!-- Font Poppins & FontAwesome Icon -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Load CSS Terpisah -->
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/tambahKelas.css') }}">
</head>
<body>

    <x-sidebar_siakad />

    {{-- Main Container --}}
    <div class="main-content">
        
        <!-- Topbar Section -->
        <div class="topbar">
            <div class="topbar-left">
                <span class="topbar-eyebrow">MODUL SIAKAD</span>
                <h2>Tambah Ruang Kelas</h2>
            </div>
            <div class="topbar-icons">
                <div class="academic-pill">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>T.A. 2025/2026</span>
                </div>
                <div class="icon-bell-wrap">
                    <i class="fa-regular fa-bell"></i>
                </div>
            </div>
        </div>

        <!-- Form Card Container -->
        <div class="form-card">
            
            <!-- Form Header -->
            <div class="form-header">
                <div class="form-header-icon">
                    <i class="fa-solid fa-door-open"></i>
                </div>
                <div class="form-header-text">
                    <h3>Formulir Kelas Baru</h3>
                    <p>Lengkapi detail jenjang, nomor, dan tipe kelas di bawah ini.</p>
                </div>
            </div>

            <!-- Form Input -->
            <form action="/sk/simpan-kelas" method="POST">
                @csrf

                <div class="form-body">

                    <!-- Input 1: Select Tingkat Sekolah -->
                    <div class="form-field">
                        <label for="tingkat_sekolah">
                            <i class="fa-solid fa-school"></i> Tingkat / Jenjang Sekolah
                        </label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-layer-group"></i>
                            <select name="tingkat_sekolah" id="tingkat_sekolah" required>
                                <option value="" disabled selected>-- Pilih Jenjang Sekolah --</option>
                                <option value="TK">TK (Taman Kanak-Kanak)</option>
                                <option value="SD">SD (Sekolah Dasar)</option>
                                <option value="SMP">SMP (Sekolah Menengah Pertama)</option>
                                <option value="SMA">SMA (Sekolah Menengah Atas)</option>
                            </select>
                        </div>
                        <span class="field-hint">Pilih tingkatan pendidikan untuk kelas yang dibuat.</span>
                    </div>

                    <!-- Row Grid untuk Input 2 & 3 -->
                    <div class="form-row">
                        
                        <!-- Input 2: Select Nomor / Tingkat Kelas (1 - 12) -->
                        <div class="form-field">
                            <label for="no_kelas">
                                <i class="fa-solid fa-arrow-down-1-9"></i> Nomor / Tingkat Kelas
                            </label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-hashtag"></i>
                                <select name="no_kelas" id="no_kelas" required>
                                    <option value="" disabled selected>-- Pilih Tingkat (1 - 12) --</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">Tingkat / Kelas {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <span class="field-hint">Pilih angka tingkat kelas dari 1 hingga 12.</span>
                        </div>

                        <!-- Input 3: Select Tipe Kelas -->
                        <div class="form-field">
                            <label for="tipe_kelas">
                                <i class="fa-solid fa-font"></i> Tipe / Nama Paralel Kelas
                            </label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-shapes"></i>
                                <select name="tipe_kelas" id="tipe_kelas" required>
                                    <option value="" disabled selected>-- Pilih Tipe / Jurusan --</option>
                                    <option value="A">Kelas A</option>
                                    <option value="B">Kelas B</option>
                                    <option value="C">Kelas C</option>
                                    <option value="IPA 1">IPA 1</option>
                                    <option value="IPA 2">IPA 2</option>
                                    <option value="IPS 1">IPS 1</option>
                                    <option value="IPS 2">IPS 2</option>
                                    <option value="REGULER">Reguler</option>
                                    <option value="UNGGULAN">Unggulan</option>
                                </select>
                            </div>
                            <span class="field-hint">Pilih rombel atau jurusan paralel kelas.</span>
                        </div>

                    </div>

                </div>

                <!-- Form Footer Buttons -->
                <div class="form-footer">
                    <a href="javascript:history.back()" class="btn-form-cancel">Batal</a>
                    <button type="submit" class="btn-form-save">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Kelas
                    </button>
                </div>

            </form>

        </div>

    </div>

    <x-warning />

</body>
</html>