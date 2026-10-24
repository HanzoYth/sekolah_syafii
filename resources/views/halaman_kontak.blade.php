@php($activePage = 'kontak')
@extends('layouts.public')

@section('title', "Lokasi & Kontak — Sekolah Islam Al-Qur'an Imam Syafi'i")
@section('hero_bg', asset('img/bg_skl.jpeg'))
@section('breadcrumb', 'Lokasi & Kontak')
@section('eyebrow_icon', 'fa-solid fa-map-location-dot')
@section('eyebrow_text', 'Hubungi Kami')
@section('hero_title')
    Lokasi Kampus & <span class="highlight">Layanan Informasi</span>
@endsection
@section('hero_desc', "Kunjungi langsung kampus Sekolah Islam Al-Qur'an Imam Syafi'i di Kota Palu atau hubungi layanan administrasi kami pada jam kerja.")
@section('hero_actions')
    <a href="https://www.google.com/maps?q=-0.9267058875927435,119.87149370241973" target="_blank" rel="noopener" class="btn-secondary">
        <i class="fa-solid fa-route"></i> Buka Rute Google Maps
    </a>
    <a href="/prof?halaman=ppdb" class="btn-secondary">
        <i class="fa-solid fa-user-plus"></i> Panduan PPDB
    </a>
@endsection
@section('wave_color', '#ffffff')

@section('content')
    <!-- ======== 1. INFORMASI KONTAK & PETA INTERAKTIF LEAFLET ======== -->
    <section class="section parallax-section">
        <div class="parallax-ring spin" style="left: -220px; bottom: -180px;" data-parallax-speed="0.14"></div>

        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-eyebrow"><i class="fa-solid fa-building"></i> Sekretariat & Kampus</span>
                <h2 class="section-title">Informasi Kontak & Peta Lokasi</h2>
                <p class="section-subtitle">
                    Kami menyambut hangat kunjungan orang tua/wali calon santri untuk melihat langsung lingkungan belajar dan berkonsultasi mengenai pendidikan putra-putrinya.
                </p>
            </div>

            <div class="kontak-grid">
                <div class="kontak-info" data-aos="fade-right">
                    <ul>
                        <li>
                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                            <div>
                                <strong>Alamat Kampus</strong>
                                <span>Kota Palu, Sulawesi Tengah (Klik penanda pada peta di samping untuk navigasi langsung ke Google Maps)</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-clock" aria-hidden="true"></i>
                            <div>
                                <strong>Jam Layanan Sekretariat & Tata Usaha</strong>
                                <span>Senin – Sabtu: 07.30 – 15.30 WITA (Hari Ahad & Libur Nasional Tutup)</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-users-gear" aria-hidden="true"></i>
                            <div>
                                <strong>Layanan Konsultasi PPDB</strong>
                                <span>Tersedia layanan informasi pendaftaran jenjang TK/PAUD, SD, dan SMP setiap hari kerja di ruang Tata Usaha</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-laptop" aria-hidden="true"></i>
                            <div>
                                <strong>Portal Sistem Akademik (SIAKAD)</strong>
                                <span>Siswa, Guru, dan Admin dapat masuk kapan saja secara daring melalui halaman <a href="/reg" style="color: var(--primary); font-weight: 600; text-decoration: underline;">Login Sistem SIAKAD</a></span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="kontak-map" data-aos="fade-left">
                    <div id="map" role="region" aria-label="Peta lokasi sekolah"
                         style="width:100%;height:100%;min-height:400px;position:relative;z-index:0;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 2. PANDUAN KUNJUNGAN & AKSES CEPAT ======== -->
    <section class="section alt parallax-section">
        <div class="container">
            <div class="syarat-grid">
                <div class="kontak-form-card" data-aos="fade-right">
                    <h3><i class="fa-solid fa-paper-plane" style="color: var(--primary);"></i> Kirim Pesan / Pertanyaan Cepat</h3>
                    <p>Isi data singkat di bawah ini untuk menyiapkan pesan konsultasi terkait PPDB atau informasi akademik:</p>
                    <form id="quickContactForm" onsubmit="return false;">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="qcNama">Nama Orang Tua / Wali</label>
                                <input type="text" id="qcNama" class="form-control" placeholder="Contoh: Bapak Ahmad" required>
                            </div>
                            <div class="form-group">
                                <label for="qcJenjang">Jenjang yang Diminati</label>
                                <select id="qcJenjang" class="form-control">
                                    <option value="TK / PAUD Al-Qur'an">TK / PAUD Al-Qur'an</option>
                                    <option value="SD Islam Terpadu">SD Islam Terpadu</option>
                                    <option value="SMP Islam Terpadu">SMP Islam Terpadu</option>
                                    <option value="Informasi Umum / SIAKAD">Informasi Umum / SIAKAD</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qcPesan">Pertanyaan / Keperluan</label>
                            <textarea id="qcPesan" class="form-control" placeholder="Tuliskan pertanyaan Anda seputar pendaftaran, kurikulum, atau jadwal kunjungan..." required></textarea>
                        </div>
                        <button type="submit" class="btn-started" style="width: 100%; justify-content: center; border: none; cursor: pointer;">
                            <i class="fa-solid fa-check-circle"></i> Siapkan Ringkasan Pesan
                        </button>
                        <div id="qcAlert" style="display:none; margin-top: 14px; padding: 14px 16px; border-radius: 12px; background: var(--primary-soft); color: var(--primary-dark); font-size: 0.88rem; border: 1px solid rgba(20,90,50,0.2);"></div>
                    </form>
                </div>

                <div class="syarat-card" data-aos="fade-left">
                    <h3><i class="fa-solid fa-compass" style="color: var(--primary);"></i> Panduan Kunjungan ke Sekolah</h3>
                    <ul>
                        <li><i class="fa-solid fa-circle-check"></i><span><strong>Waktu Terbaik Berkunjung:</strong> Pukul 08.00 – 11.30 WITA jika ingin sekaligus melihat suasana halaqah pagi dan kegiatan belajar santri.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span><strong>Adab Berpakaian:</strong> Pengunjung dan tamu sekolah diharapkan mengenakan pakaian yang sopan, rapi, dan menutup aurat sesuai syariat Islam.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span><strong>Registrasi Tamu:</strong> Silakan melapor terlebih dahulu kepada petugas keamanan atau meja layanan sekretariat setibanya di lingkungan kampus.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span><strong>Akses Portal Daring:</strong> Bagi wali santri aktif yang membutuhkan bantuan akun SIAKAD, silakan menghubungi Admin SIAKAD di ruang Tata Usaha.</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    (function () {
        var form = document.getElementById('quickContactForm');
        var alertBox = document.getElementById('qcAlert');
        if (!form || !alertBox) return;
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var nama = document.getElementById('qcNama').value.trim();
            var jenjang = document.getElementById('qcJenjang').value;
            var pesan = document.getElementById('qcPesan').value.trim();
            if (!nama || !pesan) return;
            alertBox.style.display = 'block';
            alertBox.innerHTML = '<strong>Ringkasan Pesan Siap:</strong><br>' +
                'Assalamu\'alaikum, saya <strong>' + nama.replace(/</g, '&lt;') + '</strong> ingin menanyakan informasi terkait <strong>' + jenjang + '</strong>: <em>"' + pesan.replace(/</g, '&lt;') + '"</em>.<br><br>' +
                'Silakan sampaikan pesan ini saat mengunjungi sekretariat atau lanjutkan melalui <a href="/reg" style="color:var(--primary);font-weight:700;text-decoration:underline;">Portal Pendaftaran / SIAKAD &rarr;</a>';
        });
    })();
</script>
@endpush

