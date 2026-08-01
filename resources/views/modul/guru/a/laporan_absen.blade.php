<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS Guru - Laporan Absensi</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&family=Source+Serif+4:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/modul/guru/laporan_absensi.css')}}">
</head>
<body>

    <div class="app-layout">
        
        <!-- SIDEBAR -->
        <x-sidebar_guru />

        <!-- MAIN CONTENT AREA -->
        <main class="main-content">
            
            <!-- TOP NAVBAR -->
            <header class="topbar">
                <div class="page-title">
                    <h2>Laporan Absensi Guru</h2>
                    <p>Rekapitulasi dan pemantauan kehadiran guru harian / bulanan</p>
                </div>
                <div class="topbar-actions">
                    <button class="icon-btn" title="Notifikasi">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot"></span>
                    </button>
                    <div class="user-profile">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=200" alt="Foto Profil">
                        <div class="user-info">
                            <span class="name">Administrator</span>
                            <span class="role">Modul Guru</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <div class="content-body">

                <!-- 1. FILTER / INPUT FORM SECTION -->
                <div class="card filter-card">
                    <div class="card-header">
                        <h4><i class="fa-solid fa-filter"></i> Filter Laporan Absensi</h4>
                    </div>
                    <div class="card-body">
                        <div class="filter-form">
                            <!-- Input Nama -->
                            <div class="form-group">
                                <label for="nama"><i class="fa-solid fa-user"></i> Nama Guru</label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Cari nama guru...">
                            </div>

                            <!-- Input Tanggal / Tahun -->
                            <div class="form-group">
                                <label for="tanggal"><i class="fa-solid fa-calendar-days"></i> Tanggal / Periode</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control">
                            </div>

                            <!-- Input Status Kehadiran -->
                            <div class="form-group">
                                <label for="status"><i class="fa-solid fa-list-check"></i> Status Kehadiran</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="">-- Semua Status --</option>
                                    <option value="h">Hadir (Tepat Waktu)</option>
                                    <option value="i">Izin</option>
                                    <option value="s">Sakit</option>
                                    <option value="a">Tanpa Keterangan</option>
                                </select>
                            </div>

                            <!-- Tombol Filter -->
                            <div class="form-actions">
                                <button type="button" class="btn btn-primary" id="tampilkan">
                                    <i class="fa-solid fa-magnifying-glass"></i> Tampilkan
                                </button>
                                <button type="button" class="btn btn-outline" id="reset">
                                    <i class="fa-solid fa-rotate-left"></i> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. DAFTAR NAMA-NAMA GURU (ABSENSI) -->
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fa-solid fa-clipboard-user"></i> Daftar Kehadiran Guru</h4>
                        <span class="date-badge">Rabu, 29 Juli 2026</span>
                    </div>
                    <div class="card-body">
                        
                        <div class="attendance-list">
                            @foreach ($data as $value)
                                <!-- ITEM ABSENSI -->
                                <div class="attendance-card">
                                    <div class="teacher-info">
                                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=200" alt="Foto Guru">
                                        <div class="details">
                                            <h5>{{$value->getGuru->nama}}</h5>
                                            <span class="nip">NIP. 19850712 201001 1 002</span>
                                        </div>
                                    </div>

                                    <div class="attendance-details">
                                        <!-- Lokasi -->
                                        <div class="meta-item" title="Lokasi Absen">
                                            <i class="fa-solid fa-location-dot icon-location"></i>
                                            <span>{{$value->getLokasi->nama_lokasi}}</span>
                                        </div>

                                        <!-- Logo Exit (Jam Masuk - Keluar) -->
                                        <div class="meta-item" title="Jam Masuk">
                                            <i class="fa-solid fa-right-from-bracket icon-exit"></i>
                                            <span>{{\Carbon\Carbon::parse($value->waktu_masuk)->format("H:i")}} WITA</span>
                                        </div>

                                        <!-- Terlambat -->
                                        <div class="meta-item" title="Durasi Keterlambatan">
                                            <i class="fa-solid fa-clock icon-late"></i>
                                            <span>Terlambat: <strong>{{$value->terlambat_menit}} Menit</strong></span>
                                        </div>

                                        <!-- Tanggal -->
                                        <div class="meta-item" title="Tanggal Absen">
                                            <i class="fa-regular fa-calendar icon-date"></i>
                                            <span class="tanggal" data-tanggal = "{{$value->tgl_masuk}}">{{ \Carbon\Carbon::parse($value->tgl_masuk)->translatedFormat('d M Y') }}</span>
                                        </div>

                                        <!-- Status -->
                                        @if ($value->status_kehadiran == 'h')
                                            <div class="meta-item meta-item-status" id="status_kehadiran">
                                                <span class="status-tag tag-success" data-sts = "h">Hadir</span>
                                            </div>
                                        @elseif ($value->status_kehadiran == "i" || $value->status_kehadiran == "s")
                                            <div class="meta-item meta-item-status">
                                                <span class="status-tag tag-info" data-sts = {{$value->status_kehadiran == "i" ? "i" : "s"}}>{{$value->status_kehadiran == "i" ? "Izin" : "Sakit"}}</span>
                                            </div>
                                        @else
                                            <div class="meta-item meta-item-status">
                                                <span class="status-tag tag-warning" data-sts="a">Alpha</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div> <!-- /attendance-list -->
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="{{'/js/modul/guru/laporan_absen.js'}}"></script>
</body>
</html>