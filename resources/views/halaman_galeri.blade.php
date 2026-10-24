@php($activePage = 'galeri')
@extends('layouts.public')

@section('title', "Galeri Kegiatan & Prestasi — Sekolah Islam Al-Qur'an Imam Syafi'i")
@section('hero_bg', asset('img/ft_1.jpeg'))
@section('breadcrumb', 'Galeri & Kegiatan')
@section('eyebrow_icon', 'fa-solid fa-camera-retro')
@section('eyebrow_text', 'Dokumentasi Aktivitas')
@section('hero_title')
    Galeri Kegiatan & <span class="highlight">Prestasi Santri</span>
@endsection
@section('hero_desc', "Potret suasana halaqah Al-Qur'an, kegiatan belajar mengajar, pembinaan adab harian, serta agenda evaluasi capaian santri.")
@section('hero_actions')
    <a href="/prof?halaman=program" class="btn-secondary">
        <i class="fa-solid fa-book-open-reader"></i> Lihat Program Unggulan
    </a>
    <a href="/prof?halaman=ppdb" class="btn-secondary">
        <i class="fa-solid fa-user-plus"></i> Info PPDB
    </a>
@endsection
@section('wave_color', '#ffffff')

@section('content')
    <!-- ======== 1. GALERI FOTO INTERAKTIF DENGAN FILTER & LIGHTBOX ======== -->
    <section class="section parallax-section">
        <div class="parallax-ring spin" style="right: -220px; top: 80px;" data-parallax-speed="-0.15"></div>

        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-eyebrow"><i class="fa-solid fa-images"></i> Dokumentasi Visual</span>
                <h2 class="section-title">Potret Aktivitas & Keseharian Santri</h2>
                <p class="section-subtitle">
                    Klik pada foto untuk memperbesar tampilan (Lightbox) atau gunakan tombol filter kategori di bawah ini.
                </p>
            </div>

            <!-- Filter Kategori Galeri -->
            <div class="galeri-filter-bar" data-aos="fade-up">
                <button type="button" class="galeri-filter-btn active" data-filter="all">Semua Kegiatan</button>
                <button type="button" class="galeri-filter-btn" data-filter="tahfizh">Halaqah & Tahfizh</button>
                <button type="button" class="galeri-filter-btn" data-filter="kbm">Kegiatan Belajar</button>
                <button type="button" class="galeri-filter-btn" data-filter="lingkungan">Lingkungan & Evaluasi</button>
            </div>

            <!-- Grid Galeri -->
            <div class="galeri-grid" id="galeriGrid">
                <figure class="galeri-item" data-category="tahfizh" data-aos="fade-up">
                    <button type="button" class="galeri-btn" data-lightbox
                        data-full="{{ asset('img/ft_2.jpeg') }}" data-caption="Halaqah Tahfizhul Qur'an — Setoran hafalan dan perbaikan tajwid bersama muhaffizh">
                        <img src="{{ asset('img/ft_2.jpeg') }}" alt="Halaqah Tahfizhul Qur'an" loading="lazy">
                        <span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </button>
                    <figcaption>
                        <span class="badge"><i class="fa-solid fa-book-quran"></i> Halaqah & Tahfizh</span>
                        <h3>Talaqqi & Setoran Hafalan</h3>
                        <p>Bimbingan intensif bacaan dan setoran hafalan Al-Qur'an secara berhadapan langsung dengan pengajar.</p>
                    </figcaption>
                </figure>

                <figure class="galeri-item" data-category="kbm" data-aos="fade-up" data-aos-delay="80">
                    <button type="button" class="galeri-btn" data-lightbox
                        data-full="{{ asset('img/ft_1.jpeg') }}" data-caption="Kegiatan Belajar Mengajar — Suasana pembelajaran interaktif di kelas">
                        <img src="{{ asset('img/ft_1.jpeg') }}" alt="Kegiatan Belajar Mengajar" loading="lazy">
                        <span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </button>
                    <figcaption>
                        <span class="badge"><i class="fa-solid fa-chalkboard-user"></i> Kegiatan Belajar</span>
                        <h3>Pembelajaran Kelas Terpadu</h3>
                        <p>Suasana belajar yang aktif, tertib, dan menyenangkan dengan pendampingan penuh dari para ustadz/ustadzah.</p>
                    </figcaption>
                </figure>

                <figure class="galeri-item" data-category="tahfizh" data-aos="fade-up" data-aos-delay="160">
                    <button type="button" class="galeri-btn" data-lightbox
                        data-full="{{ asset('img/foto_1.jpeg') }}" data-caption="Muraja'ah Bersama — Penguatan hafalan rutin setiap pagi sebelum memulai pelajaran">
                        <img src="{{ asset('img/foto_1.jpeg') }}" alt="Muraja'ah Bersama" loading="lazy">
                        <span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </button>
                    <figcaption>
                        <span class="badge"><i class="fa-solid fa-repeat"></i> Halaqah & Tahfizh</span>
                        <h3>Muraja'ah Pagi Terjadwal</h3>
                        <p>Rutinitas menjaga kualitas hafalan lama agar tetap kokoh (mutqin) di dalam ingatan peserta didik.</p>
                    </figcaption>
                </figure>

                <figure class="galeri-item" data-category="kbm" data-aos="fade-up">
                    <button type="button" class="galeri-btn" data-lightbox
                        data-full="{{ asset('img/foto_2.jpeg') }}" data-caption="Pembinaan Adab & Praktek Ibadah — Penanaman akhlak mulia sejak dini">
                        <img src="{{ asset('img/foto_2.jpeg') }}" alt="Pembinaan Adab dan Ibadah" loading="lazy">
                        <span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </button>
                    <figcaption>
                        <span class="badge"><i class="fa-solid fa-hands-holding-child"></i> Kegiatan Belajar</span>
                        <h3>Pembinaan Adab & Ibadah</h3>
                        <p>Praktek langsung tata cara wudhu, sholat sesuai sunnah, serta adab pergaulan sehari-hari.</p>
                    </figcaption>
                </figure>

                <figure class="galeri-item" data-category="lingkungan" data-aos="fade-up" data-aos-delay="80">
                    <button type="button" class="galeri-btn" data-lightbox
                        data-full="{{ asset('img/bg_skl.jpeg') }}" data-caption="Lingkungan Sekolah Islam Al-Qur'an Imam Syafi'i yang asri dan kondusif">
                        <img src="{{ asset('img/bg_skl.jpeg') }}" alt="Lingkungan Sekolah" loading="lazy">
                        <span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </button>
                    <figcaption>
                        <span class="badge"><i class="fa-solid fa-school"></i> Lingkungan Sekolah</span>
                        <h3>Suasana Kampus yang Kondusif</h3>
                        <p>Area sekolah yang tenang dan mendukung konsentrasi santri dalam menuntut ilmu dan menghafal.</p>
                    </figcaption>
                </figure>

                <figure class="galeri-item" data-category="lingkungan" data-aos="fade-up" data-aos-delay="160">
                    <button type="button" class="galeri-btn" data-lightbox
                        data-full="{{ asset('img/ft_1.jpeg') }}" data-caption="Evaluasi & Tasmi' Hafalan — Uji kelancaran hafalan santri secara berkala">
                        <img src="{{ asset('img/ft_1.jpeg') }}" alt="Evaluasi dan Tasmi Hafalan" loading="lazy">
                        <span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </button>
                    <figcaption>
                        <span class="badge"><i class="fa-solid fa-award"></i> Evaluasi & Capaian</span>
                        <h3>Ujian Tasmi' & Evaluasi</h3>
                        <p>Uji publik kelancaran hafalan per juz sebagai tolok ukur ketuntasan sebelum melanjutkan ke juz berikutnya.</p>
                    </figcaption>
                </figure>
            </div>

            <!-- Sorotan Fokus Prestasi & Kompetensi Santri -->
            <div class="prestasi-strip" data-aos="fade-up">
                <div class="prestasi-strip-header">
                    <h3>Fokus Capaian & Prestasi Peserta Didik</h3>
                    <p>Setiap peserta didik dibina untuk meraih keunggulan dalam 3 pilar kompetensi utama:</p>
                </div>
                <div class="prestasi-grid">
                    <div class="prestasi-card">
                        <div class="prestasi-icon"><i class="fa-solid fa-trophy"></i></div>
                        <div>
                            <span class="badge" style="background: rgba(212,175,55,0.22); color: var(--accent-light);">Pilar 1</span>
                            <h4>Musabaqah Hifzhil Qur'an</h4>
                            <p>Kesiapan mental dan kualitas bacaan santri dalam mengikuti ajang MHQ & ujian tasmi' berkala.</p>
                        </div>
                    </div>
                    <div class="prestasi-card">
                        <div class="prestasi-icon"><i class="fa-solid fa-medal"></i></div>
                        <div>
                            <span class="badge" style="background: rgba(212,175,55,0.22); color: var(--accent-light);">Pilar 2</span>
                            <h4>Kompetensi Bahasa & Diniyah</h4>
                            <p>Penguasaan materi hafalan hadits, doa harian, fiqih ibadah, serta percakapan bahasa Arab.</p>
                        </div>
                    </div>
                    <div class="prestasi-card">
                        <div class="prestasi-icon"><i class="fa-solid fa-star"></i></div>
                        <div>
                            <span class="badge" style="background: rgba(212,175,55,0.22); color: var(--accent-light);">Pilar 3</span>
                            <h4>Ketuntasan Akademik & Rapor</h4>
                            <p>Pemantauan nilai akademik dan kehadiran secara transparan melalui sistem rapor digital SIAKAD.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 2. AGENDA KEGIATAN RUTIN & TAHUNAN ======== -->
    <section class="section alt parallax-section">
        <div class="parallax-ring spin" style="left: -200px; top: 60px;" data-parallax-speed="0.16"></div>

        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-eyebrow"><i class="fa-solid fa-calendar-Alt"></i> Program Kegiatan</span>
                <h2 class="section-title">Agenda Pembinaan Berkala</h2>
                <p class="section-subtitle">
                    Selain kegiatan belajar harian, sekolah menyelenggarakan agenda rutin untuk menguatkan motivasi dan ukhuwah santri.
                </p>
            </div>

            <div class="fasilitas-grid">
                <div class="fasilitas-card" data-parallax-speed="-0.04" data-aos="fade-up">
                    <div class="fasilitas-icon"><i class="fa-solid fa-microphone-lines"></i></div>
                    <h4>Majelis Tasmi' Hafalan</h4>
                    <p>Kegiatan memperdengarkan hafalan Al-Qur'an 1 juz atau lebih dalam sekali duduk di hadapan muhaffizh dan teman-teman.</p>
                </div>
                <div class="fasilitas-card" data-parallax-speed="0.04" data-aos="fade-up" data-aos-delay="60">
                    <div class="fasilitas-icon"><i class="fa-solid fa-award"></i></div>
                    <h4>Pekan Musabaqah Internal</h4>
                    <p>Perlombaan tahfizh, cerdas cermat diniyah, adzan, dan pidato bahasa Arab/Indonesia antar santri setiap semester.</p>
                </div>
                <div class="fasilitas-card" data-parallax-speed="-0.04" data-aos="fade-up" data-aos-delay="120">
                    <div class="fasilitas-icon"><i class="fa-solid fa-campground"></i></div>
                    <h4>Rihlah & Edukasi Alam</h4>
                    <p>Kegiatan belajar di luar kelas untuk mentadabburi ciptaan Allah, melatih kemandirian, dan mempererat ukhuwah.</p>
                </div>
                <div class="fasilitas-card" data-parallax-speed="0.04" data-aos="fade-up" data-aos-delay="180">
                    <div class="fasilitas-icon"><i class="fa-solid fa-users"></i></div>
                    <h4>Pertemuan Wali Santri</h4>
                    <p>Forum silaturahmi, kajian parenting Islami, dan konsultasi perkembangan hafalan serta rapor akademik santri.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

