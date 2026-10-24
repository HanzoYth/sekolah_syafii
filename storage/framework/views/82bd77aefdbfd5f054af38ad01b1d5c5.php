<?php ($activePage = 'profil'); ?>


<?php $__env->startSection('title', "Profil & Identitas — Sekolah Islam Al-Qur'an Imam Syafi'i"); ?>
<?php $__env->startSection('hero_bg', asset('img/bg_skl.jpeg')); ?>
<?php $__env->startSection('breadcrumb', 'Profil Sekolah'); ?>
<?php $__env->startSection('eyebrow_icon', 'fa-solid fa-kaaba'); ?>
<?php $__env->startSection('eyebrow_text', 'Tentang Lembaga Kami'); ?>
<?php $__env->startSection('hero_title'); ?>
    Profil & Identitas <span class="highlight">Sekolah Al-Qur'an</span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('hero_desc', "Mengenal lebih dekat visi, misi, nilai-nilai pendidikan, serta fasilitas penunjang di Sekolah Islam Al-Qur'an Imam Syafi'i."); ?>
<?php $__env->startSection('hero_actions'); ?>
    <a href="/prof?halaman=program" class="btn-secondary">
        <i class="fa-solid fa-graduation-cap"></i> Lihat Kurikulum & Program
    </a>
    <a href="/prof?halaman=ppdb" class="btn-secondary">
        <i class="fa-solid fa-user-plus"></i> Info PPDB
    </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('wave_color', '#f3f6f1'); ?>

<?php $__env->startSection('content'); ?>
    <!-- ======== 1. SEJARAH, IDENTITAS & VISI-MISI ======== -->
    <section class="section alt parallax-section">
        <div class="parallax-ring spin" style="left: -200px; top: 40px;" data-parallax-speed="0.18"></div>

        <div class="container">
            <div class="profil-grid">
                <!-- Tumpukan 2 Foto Parallax -->
                <div class="profil-visual-stack" data-aos="fade-right">
                    <div class="profil-exp-badge" data-parallax-speed="-0.16">
                        <strong>100%</strong>
                        <span>Pendidikan Berbasis<br>Al-Qur'an & Sunnah</span>
                    </div>

                    <div class="profil-main-frame" data-parallax-speed="0.06">
                        <img src="<?php echo e(asset('img/ft_2.jpeg')); ?>?v=<?php echo e(time()); ?>" alt="Santri menghafal Al-Qur'an" loading="lazy" data-parallax-img="0.16">
                    </div>

                    <div class="profil-sub-frame" data-parallax-speed="-0.18">
                        <img src="<?php echo e(asset('img/foto_2.jpeg')); ?>?v=<?php echo e(time()); ?>" alt="Kegiatan pembelajaran di kelas" loading="lazy">
                    </div>
                </div>

                <!-- Konten Profil & Visi Misi -->
                <div class="profil-content" data-aos="fade-left">
                    <span class="section-eyebrow"><i class="fa-solid fa-landmark"></i> Sejarah & Komitmen</span>
                    <h2 class="section-title left">Membangun Fondasi Iman, Ilmu & Akhlak Mulia</h2>
                    <p class="lead-text">
                        <strong>Sekolah Islam Al-Qur'an Imam Syafi'i</strong> didirikan sebagai wujud ikhtiar menghadirkan lembaga pendidikan Islam yang memadukan kemurnian akidah, ketekunan menghafal Al-Qur'an, keluhuran adab, serta penguasaan ilmu pengetahuan modern.
                    </p>
                    <p class="lead-text" style="margin-top: -8px;">
                        Dengan meneladani semangat keilmuan dan adab <em>Al-Imam Asy-Syafi'i rahimahullah</em>, kami membimbing peserta didik secara bertahap sejak usia dini (TK/PAUD, SD, hingga SMP) agar tumbuh menjadi generasi yang mencintai Al-Qur'an dan bermanfaat bagi umat.
                    </p>

                    <div class="visi-misi-cards">
                        <div class="vm-card">
                            <h3><i class="fa-solid fa-eye"></i> Visi Sekolah</h3>
                            <p>Terwujudnya generasi Rabbani yang hafizh Al-Qur'an, berakidah lurus, berakhlak mulia, dan unggul dalam ilmu pengetahuan sesuai pemahaman salafus shalih.</p>
                        </div>
                        <div class="vm-card">
                            <h3><i class="fa-solid fa-bullseye"></i> Misi Pendidikan</h3>
                            <ul>
                                <li><i class="fa-solid fa-check"></i> Menyelenggarakan pembelajaran Tahsin & Tahfizh Al-Qur'an bersanad secara sistematis.</li>
                                <li><i class="fa-solid fa-check"></i> Menanamkan akidah Ahlussunnah wal Jama'ah dan fiqih ibadah sesuai sunnah Nabi ﷺ.</li>
                                <li><i class="fa-solid fa-check"></i> Membiasakan adab Islami terhadap orang tua, guru, dan sesama dalam keseharian.</li>
                                <li><i class="fa-solid fa-check"></i> Mengembangkan kompetensi akademik, bahasa Arab, dan pemanfaatan teknologi SIAKAD.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="check-grid">
                        <div class="check-item"><i class="fa-solid fa-certificate"></i> Muhaffizh & Guru Kompeten</div>
                        <div class="check-item"><i class="fa-solid fa-book-open"></i> Kurikulum Diniyah & Nasional</div>
                        <div class="check-item"><i class="fa-solid fa-shield-heart"></i> Lingkungan Aman & Kondusif</div>
                        <div class="check-item"><i class="fa-solid fa-mobile-screen-button"></i> Sistem SIAKAD Terintegrasi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 2. SAMBUTAN & 6 NILAI INTI SANTRI ======== -->
    <section class="section parallax-section">
        <div class="parallax-ring spin" style="right: -210px; top: 100px;" data-parallax-speed="-0.15"></div>

        <div class="container">
            <!-- Kotak Pesan & Filosofi Pendidikan -->
            <div class="sambutan-box" data-aos="fade-up" style="margin-bottom: 58px;">
                <span class="section-eyebrow"><i class="fa-solid fa-quote-left"></i> Filosofi Pendidikan Kami</span>
                <h2 class="section-title left" style="margin-bottom: 14px;">Adab Sebelum Ilmu, Iman Sebelum Al-Qur'an</h2>
                <p style="color: var(--muted); line-height: 1.8; margin-bottom: 14px;">
                    Sebagaimana prinsip para ulama terdahulu termasuk Imam Malik dan Imam Syafi'i, pendidikan sejati bukan sekadar memindahkan informasi ke dalam ingatan, melainkan membentuk hati yang takut kepada Allah, lisan yang basah dengan bacaan Al-Qur'an, serta anggota tubuh yang ringan beramal shalih.
                </p>
                <p style="color: var(--primary-dark); font-weight: 600; margin: 0;">
                    — Dewan Pembina & Pengelola Sekolah Islam Al-Qur'an Imam Syafi'i
                </p>
            </div>

            <div class="section-header" data-aos="fade-up">
                <span class="section-eyebrow"><i class="fa-solid fa-gem"></i> Karakter Utama</span>
                <h2 class="section-title">6 Nilai Inti Peserta Didik</h2>
                <p class="section-subtitle">
                    Nilai-nilai utama yang ditanamkan dan dievaluasi secara berkesinambungan selama santri menempuh pendidikan di sekolah kami.
                </p>
            </div>

            <div class="values-grid">
                <div class="value-card" data-aos="fade-up">
                    <span class="value-num">01</span>
                    <div class="fasilitas-icon"><i class="fa-solid fa-mosque"></i></div>
                    <h3>Salimul Aqidah</h3>
                    <p>Memiliki keyakinan tauhid yang bersih dari kesyirikan dan khurafat sesuai tuntunan Al-Qur'an dan Sunnah.</p>
                </div>
                <div class="value-card" data-aos="fade-up" data-aos-delay="60">
                    <span class="value-num">02</span>
                    <div class="fasilitas-icon"><i class="fa-solid fa-person-praying"></i></div>
                    <h3>Shahihul Ibadah</h3>
                    <p>Terbiasa melaksanakan wudhu, sholat berjamaah, dan dzikir harian sesuai tata cara Rasulullah ﷺ.</p>
                </div>
                <div class="value-card" data-aos="fade-up" data-aos-delay="120">
                    <span class="value-num">03</span>
                    <div class="fasilitas-icon"><i class="fa-solid fa-book-quran"></i></div>
                    <h3>Muhibbul Qur'an</h3>
                    <p>Mencintai Al-Qur'an dengan membaca secara tartil, menghafalkannya, dan menjaga muraja'ah harian.</p>
                </div>
                <div class="value-card" data-aos="fade-up">
                    <span class="value-num">04</span>
                    <div class="fasilitas-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                    <h3>Matinul Khuluq</h3>
                    <p>Berakhlak santun, jujur, hormat kepada orang tua dan guru, serta menyayangi teman sebaya.</p>
                </div>
                <div class="value-card" data-aos="fade-up" data-aos-delay="60">
                    <span class="value-num">05</span>
                    <div class="fasilitas-icon"><i class="fa-solid fa-brain"></i></div>
                    <h3>Mutsaqqaful Fikri</h3>
                    <p>Berwawasan luas dalam ilmu syar'i, bahasa Arab, sains, matematika, dan literasi pengetahuan umum.</p>
                </div>
                <div class="value-card" data-aos="fade-up" data-aos-delay="120">
                    <span class="value-num">06</span>
                    <div class="fasilitas-icon"><i class="fa-solid fa-clock"></i></div>
                    <h3>Harishun 'ala Waqtihi</h3>
                    <p>Disiplin menghargai waktu, tertib mengikuti jadwal pelajaran, dan bertanggung jawab atas tugasnya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 3. FASILITAS & SARANA PRASARANA ======== -->
    <section class="section alt parallax-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-eyebrow"><i class="fa-solid fa-building-columns"></i> Sarana & Prasarana</span>
                <h2 class="section-title">Fasilitas Penunjang Pembelajaran</h2>
                <p class="section-subtitle">
                    Dirancang khusus untuk mendukung kenyamanan halaqah Al-Qur'an, kegiatan belajar mengajar di kelas, serta tumbuh kembang fisik peserta didik.
                </p>
            </div>

            <div class="fasilitas-grid">
                <div class="fasilitas-card" data-parallax-speed="-0.04" data-aos="fade-up">
                    <div class="fasilitas-icon"><i class="fa-solid fa-mosque"></i></div>
                    <h4>Mushalla & Area Halaqah</h4>
                    <p>Pusat pembinaan sholat berjamaah, setoran hafalan Al-Qur'an (talaqqi), dan majelis dzikir pagi-petang.</p>
                </div>
                <div class="fasilitas-card" data-parallax-speed="0.04" data-aos="fade-up" data-aos-delay="60">
                    <div class="fasilitas-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                    <h4>Ruang Kelas Representatif</h4>
                    <p>Ruang belajar bersih, pencahayaan alami baik, dan kapasitas terukur agar guru dapat membimbing setiap siswa secara optimal.</p>
                </div>
                <div class="fasilitas-card" data-parallax-speed="-0.04" data-aos="fade-up" data-aos-delay="120">
                    <div class="fasilitas-icon"><i class="fa-solid fa-book"></i></div>
                    <h4>Perpustakaan & Pojok Baca</h4>
                    <p>Menyediakan mushaf Al-Qur'an standar Madinah, buku sirah Nabawiyah, kitab dasar, dan buku pengayaan sains.</p>
                </div>
                <div class="fasilitas-card" data-parallax-speed="0.04" data-aos="fade-up" data-aos-delay="180">
                    <div class="fasilitas-icon"><i class="fa-solid fa-futbol"></i></div>
                    <h4>Lapangan & Area Bermain</h4>
                    <p>Sarana olahraga, aktivitas fisik terarah, dan area bermain edukatif untuk menjaga kebugaran jasmani santri.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 4. PARALLAX CTA BANNER ======== -->
    <section class="parallax-banner parallax-section">
        <div class="parallax-bg-wrap">
            <div class="parallax-bg-layer" style="background-image: url('<?php echo e(asset('img/ft_1.jpeg')); ?>?v=<?php echo e(time()); ?>');" data-parallax-bg="0.32"></div>
        </div>
        <div class="parallax-ornament-layer" data-parallax-speed="0.14"></div>
        <div class="parallax-banner-overlay"></div>

        <div class="container" style="text-align: center;">
            <div class="quote-box" data-aos="zoom-in" style="margin-bottom: 24px;">
                <p class="quote-arabic">« مَنْ سَلَكَ طَرِيقًا يَلْتَمِسُ فِيهِ عِلْمًا سَهَّلَ اللَّهُ لَهُ بِهِ طَرِيقًا إِلَى الْجَنَّةِ »</p>
                <p class="quote-translation">"Barangsiapa menempuh suatu jalan untuk menuntut ilmu, maka Allah akan mudahkan baginya jalan menuju Surga." (HR. Muslim)</p>
            </div>
            <div class="hero-btns" style="justify-content: center; margin-bottom: 0;">
                <a href="/prof?halaman=program" class="btn-started">
                    <i class="fa-solid fa-book-open-reader"></i> Pelajari Kurikulum & Program
                </a>
                <a href="/prof?halaman=ppdb" class="btn-secondary">
                    <i class="fa-solid fa-file-signature"></i> Pendaftaran Santri Baru
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\profile_sekolah.blade.php ENDPATH**/ ?>