<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Islamic Smart School</title>

    <!-- Font Inter & Arabic -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS custom murni, tanpa Tailwind / Vite -->    
    <link rel="stylesheet" href="{{asset('css/modul/siakad/data_siswa.css')}}">
</head>
<body>

<div class="app-shell">

    <!-- ============================= SIDEBAR ============================= -->
    <x-sidebar_siakad />

    <!-- ========================= KONTEN UTAMA ========================= -->
    <div class="main-content">

        <!-- Header / Topbar -->
        <header class="topbar">
            <div class="topbar-inner">
                <div class="topbar-title">
                    <span class="font-arabic">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</span>
                    <h1>Sistem Informasi Data Siswa</h1>
                    <p>Mewujudkan Generasi Rabbani, Berakhlak Mulia &amp; Berprestasi</p>
                </div>
                <div>
                    <a href="#" class="btn btn-gold">
                        <i class="fa-solid fa-user-plus"></i> Tambah Siswa Baru
                    </a>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="page">

            <!-- Notifikasi -->
            <div class="alert" id="alert">
                <div class="alert-left">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Data siswa berhasil dimuat.</span>
                </div>
                <button class="alert-close" onclick="document.getElementById('alert').remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Card Tabel -->
            <div class="card">

                <!-- Toolbar & Filter -->
                <div class="toolbar">
                    <form action="#" method="GET" class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="search" placeholder="Cari NIS, Nama, atau Kelas...">
                    </form>
                    <div class="toolbar-meta">
                        <i class="fa-solid fa-users"></i>
                        <span>Total Siswa: <strong>3</strong> Santri/Siswa</span>
                    </div>
                </div>

                <!-- Tabel Data Siswa -->
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-center">No</th>
                                <th>Foto</th>
                                <th>NISN / NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Kelas</th>
                                <th class="col-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Baris 1 (Laki-laki) -->
                            <tr>
                                <td class="col-center row-number">1</td>
                                <td>
                                    <div class="avatar">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                </td>
                                <td class="student-id">
                                    <strong>0051234567</strong> / 202301
                                </td>
                                <td class="student-name">Ahmad Al-Fatih</td>
                                <td>
                                    <span class="badge badge-laki">
                                        <i class="fa-solid fa-mars"></i> Laki-laki
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-kelas">X-A Tahfidz</span>
                                </td>
                                <td class="col-center">
                                    <div class="actions">
                                        <a href='/sk/dls' class="btn-icon btn-icon-view" data-tooltip="Detail Siswa">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href='/sk/dts' class="btn-icon btn-icon-edit" data-tooltip="Edit Data">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button type="button" class="btn-icon btn-icon-delete" data-tooltip="Hapus Siswa"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Contoh baris empty state (hapus/comment kalau data ada) -->
                            <!--
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="fa-solid fa-inbox"></i>
                                    Belum ada data siswa.
                                </td>
                            </tr>
                            -->
                        </tbody>
                    </table>
                </div>

                <!-- Footer Card / Pagination -->
                <div class="card-footer">
                    <span class="card-footer-info">Menampilkan 3 dari 3 data siswa aktif</span>
                    <div class="pagination">
                        <button disabled>Sebelumnya</button>
                        <button class="active">1</button>
                        <button disabled>Selanjutnya</button>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<script>
    // Toggle sidebar untuk tampilan mobile (di bawah 1024px)
    // Tambahkan tombol hamburger di topbar jika ingin memicu ini, contoh:
    // <button onclick="document.getElementById('sidebar').classList.toggle('is-open')">☰</button>
</script>

</body>
</html>