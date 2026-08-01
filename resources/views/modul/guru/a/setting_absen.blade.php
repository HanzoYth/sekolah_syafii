<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Absensi & Lokasi Valid</title>

    <!-- FontAwesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Leaflet CSS & Google Fonts -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Pengaturan Absensi -->
    <link rel="stylesheet" href="{{ asset('css/modul/guru/setting_absen.css') }}">
</head>
<body>
    <x-sidebar_guru />

    <!-- Main Wrapper agar tidak tertutup Sidebar -->
    <main class="main-wrapper">
        <div class="presensi-container">
            
            <!-- Banner Header Top -->
            <div class="islamic-banner">
                <div class="banner-content">
                    <div class="bismillah-text">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
                    <div class="banner-title">
                        <h2>Pengaturan Lokasi & Jam Kerja Presensi</h2>
                        <p>Konfigurasi titik koordinat GPS, radius jangkauan validasi, dan jam operasional harian.</p>
                    </div>
                </div>
                <div class="banner-badge">
                    <i class="fa-solid fa-shield-halved"></i> Panel Administrator
                </div>
            </div>

            <form action="/gr/crtabs" method="POST" id="form-pengaturan-absensi">
                @csrf
                <div class="presensi-grid">
                    
                    <!-- Panel Kiri: Map Interaktif & Detail Koordinat -->
                    <div class="card-panel">
                        <div class="panel-header">
                            <div class="panel-header-title">
                                <i class="fa-solid fa-map-location-dot"></i>
                                <div>
                                    <h4>Peta & Titik Lokasi Valid</h4>
                                    <small>Tentukan titik pusat dan jangkauan radius presensi</small>
                                </div>
                            </div>
                            <span class="badge-hint"><i class="fa-solid fa-hand-pointer"></i> Drag Pin / Klik Peta</span>
                        </div>

                        <!-- Peta Leaflet -->
                        <div id="map-setting"></div>

                        <!-- Input Nama Tempat & Radius -->
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="nama_lokasi"><i class="fa-solid fa-building"></i> Nama Lokasi / Gedung</label>
                                <input type="text" id="nama_lokasi" name="nama_lokasi" class="form-control" placeholder="Contoh: Gedung Utama Sekolah" value="{{$lokasi->nama_lokasi}}" required>
                            </div>
                            <div class="form-group short-input">
                                <label for="radius"><i class="fa-solid fa-circle-dot"></i> Radius (Meter)</label>
                                <div class="input-with-suffix">
                                    <input type="number" id="radius" name="radius" class="form-control" value="{{$lokasi->radius}}" min="10" max="5000" required>
                                    <span class="suffix">m</span>
                                </div>
                            </div>
                        </div>

                        <!-- Input Koordinat (Latitude & Longitude) -->
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="latitude"><i class="fa-solid fa-location-crosshairs"></i> Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-control readonly-input" value="{{$lokasi->latitude}}" required>
                            </div>
                            <div class="form-group">
                                <label for="longitude"><i class="fa-solid fa-location-crosshairs"></i> Longitude</label>
                                <input type="text" id="longitude" name="longitude" class="form-control readonly-input" value="{{$lokasi->longitude}}"  required>
                            </div>
                        </div>

                        <div class="coordinate-info-box">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Geser pin merah atau klik area peta untuk memperbarui nilai latitude & longitude secara otomatis.</span>
                        </div>
                    </div>

                    <!-- Panel Kanan: Atur Jam Kerja (Senin - Sabtu) -->
                    <div class="card-panel panel-right">
                        <div>
                            <div class="panel-header">
                                <div class="panel-header-title">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <div>
                                        <h4>Jadwal Jam Kerja Operasional</h4>
                                        <small>Batas waktu presensi masuk & pulang (Senin - Sabtu)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="schedule-container">
                                <!-- Hari Senin -->
                                <div class="schedule-row">
                                    <div class="day-label"><i class="fa-regular fa-calendar-check"></i> Senin</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_senin" value="{{$waktu[0]->waktu_masuk}}" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_senin" value="{{$waktu[0]->waktu_keluar}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hari Selasa -->
                                <div class="schedule-row">
                                    <div class="day-label"><i class="fa-regular fa-calendar-check"></i> Selasa</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_selasa" value="{{$waktu[1]->waktu_masuk}}" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_selasa" value="{{$waktu[1]->waktu_keluar}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hari Rabu -->
                                <div class="schedule-row">
                                    <div class="day-label"><i class="fa-regular fa-calendar-check"></i> Rabu</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_rabu" value="{{$waktu[2]->waktu_masuk}}" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_rabu" value="{{$waktu[2]->waktu_keluar}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hari Kamis -->
                                <div class="schedule-row">
                                    <div class="day-label"><i class="fa-regular fa-calendar-check"></i> Kamis</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_kamis" value="{{$waktu[3]->waktu_masuk}}" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_kamis" value="{{$waktu[3]->waktu_keluar}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hari Jumat -->
                                <div class="schedule-row jumat-highlight">
                                    <div class="day-label"><i class="fa-solid fa-star"></i> Jumat</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_jumat" value="{{$waktu[4]->waktu_masuk}}" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_jumat" value="{{$waktu[4]->waktu_keluar}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hari Sabtu -->
                                <div class="schedule-row">
                                    <div class="day-label"><i class="fa-regular fa-calendar-check"></i> Sabtu</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_sabtu" value="{{$waktu[5]->waktu_masuk}}" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_sabtu" value="{{$waktu[5]->waktu_keluar}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="action-footer">
                            <button type="submit" class="btn-save">
                                <i class="fa-solid fa-floppy-disk"></i> Simpan Seluruh Pengaturan
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </main>

    <!-- Leaflet JS & Script Map Interaktif -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('js/modul/guru/setting_absen.js') }}"></script>
</body>
</html>