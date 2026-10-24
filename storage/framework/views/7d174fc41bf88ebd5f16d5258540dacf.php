<?php ($activePage = 'ppdb'); ?>


<?php $__env->startSection('title', "Informasi PPDB — Sekolah Islam Al-Qur'an Imam Syafi'i"); ?>
<?php $__env->startSection('hero_bg', asset('img/bg_skl.jpeg')); ?>
<?php $__env->startSection('breadcrumb', 'Informasi PPDB'); ?>
<?php $__env->startSection('eyebrow_icon', 'fa-solid fa-calendar-check'); ?>
<?php $__env->startSection('eyebrow_text', 'Penerimaan Peserta Didik Baru'); ?>
<?php $__env->startSection('hero_title'); ?>
    Panduan & Alur <span class="highlight">Pendaftaran PPDB</span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('hero_desc', "Bergabunglah bersama keluarga besar Sekolah Islam Al-Qur'an Imam Syafi'i untuk menyiapkan generasi penghafal Al-Qur'an yang berilmu dan beradab."); ?>
<?php $__env->startSection('hero_actions'); ?>
    <a href="/prof?halaman=kontak" class="btn-secondary">
        <i class="fa-brands fa-whatsapp"></i> Konsultasi Panitia PPDB
    </a>
    <a href="/prof?halaman=program" class="btn-secondary">
        <i class="fa-solid fa-graduation-cap"></i> Lihat Jenjang Pendidikan
    </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('wave_color', '#f3f6f1'); ?>

<?php $__env->startSection('content'); ?>
    <!-- ======== 1. ALUR PENDAFTARAN 4 TAHAP & PERSYARATAN BERKAS ======== -->
    <section class="section ppdb-section parallax-section">
        <div class="container">
            <!-- Parallax Banner PPDB -->
            <div class="ppdb-banner" data-aos="zoom-in">
                <div class="parallax-bg-wrap">
                    <div class="parallax-bg-layer" style="background-image: url('<?php echo e(asset('img/bg_skl.jpeg')); ?>?v=<?php echo e(time()); ?>');" data-parallax-bg="0.28"></div>
                </div>
                <div class="parallax-ornament-layer" data-parallax-speed="0.12"></div>
                <div class="ppdb-banner-overlay"></div>

                <div class="ppdb-banner-content">
                    <span class="section-eyebrow light"><i class="fa-solid fa-route"></i> Tahapan Seleksi</span>
                    <h2>4 Langkah Mudah Pendaftaran Santri Baru</h2>
                    <p>
                        Proses pendaftaran dirancang mudah dan terarah, baik secara daring melalui portal sistem maupun kunjungan langsung ke sekretariat sekolah:
                    </p>

                    <div class="ppdb-steps-grid">
                        <div class="ppdb-step">
                            <span class="ppdb-step-num">1</span>
                            <h4>Registrasi Akun / Formulir</h4>
                            <p>Daftar secara daring melalui portal atau mengambil formulir langsung di sekretariat PPDB sekolah.</p>
                        </div>
                        <div class="ppdb-step">
                            <span class="ppdb-step-num">2</span>
                            <h4>Verifikasi Berkas</h4>
                            <p>Serahkan dokumen persyaratan administrasi seperti KK, Akta Kelahiran, dan pas foto calon siswa.</p>
                        </div>
                        <div class="ppdb-step">
                            <span class="ppdb-step-num">3</span>
                            <h4>Observasi & Pemetaan</h4>
                            <p>Observasi kesiapan belajar, pemetaan bacaan Al-Qur'an awal, serta wawancara orang tua/wali.</p>
                        </div>
                        <div class="ppdb-step">
                            <span class="ppdb-step-num">4</span>
                            <h4>Daftar Ulang & Masuk</h4>
                            <p>Pengumuman kelulusan, penyelesaian administrasi daftar ulang, dan aktivasi akun SIAKAD siswa.</p>
                        </div>
                    </div>

                    <div class="ppdb-btns">
                        <a href="/reg" class="btn-started">
                            <i class="fa-solid fa-file-signature"></i> Masuk Portal Pendaftaran / SIAKAD
                        </a>
                        <a href="/prof?halaman=kontak" class="btn-secondary">
                            <i class="fa-solid fa-location-dot"></i> Kunjungi Sekretariat Sekolah
                        </a>
                    </div>
                </div>
            </div>

            <!-- Rincian Persyaratan Dokumen & Ketentuan Jenjang -->
            <div class="syarat-grid" style="margin-top: 52px;">
                <div class="syarat-card" data-aos="fade-right">
                    <h3><i class="fa-solid fa-folder-open" style="color: var(--primary);"></i> Dokumen Persyaratan Administrasi</h3>
                    <ul>
                        <li><i class="fa-solid fa-circle-check"></i><span>Mengisi formulir pendaftaran peserta didik baru dengan lengkap dan benar.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Fotokopi Akta Kelahiran calon peserta didik (2 lembar).</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Fotokopi Kartu Keluarga (KK) dan KTP kedua orang tua/wali (2 lembar).</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Pas foto berwarna terbaru ukuran 3x4 (4 lembar) berpakaian rapi dan sopan (berjilbab bagi putri).</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Fotokopi Ijazah / Surat Keterangan Lulus atau Rapor jenjang sebelumnya (khusus pendaftaran SD lanjutan & SMP).</span></li>
                    </ul>
                </div>

                <div class="syarat-card" data-aos="fade-left">
                    <h3><i class="fa-solid fa-user-graduate" style="color: var(--primary);"></i> Ketentuan Umum Calon Peserta Didik</h3>
                    <ul>
                        <li><i class="fa-solid fa-circle-check"></i><span><strong>Jenjang TK / PAUD:</strong> Mencukupi batas usia minimal kelompok bermain/TK serta siap belajar bersosialisasi.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span><strong>Jenjang SD Islam Terpadu:</strong> Berusia minimal 6 tahun pada bulan Juli tahun ajaran berjalan (tidak wajib sudah lancar membaca Al-Qur'an).</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span><strong>Jenjang SMP Islam Terpadu:</strong> Telah menyelesaikan pendidikan tingkat SD/MI sederajat dan memiliki semangat menghafal Al-Qur'an.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span><strong>Komitmen Bersama:</strong> Orang tua/wali bersedia bekerja sama dengan sekolah dalam menyelaraskan pembinaan ibadah dan adab anak di rumah.</span></li>
                    </ul>
                </div>
            </div>

            <!-- FAQ Accordion -->
            <div class="faq-wrapper" data-aos="fade-up">
                <div class="faq-head">
                    <span class="section-eyebrow"><i class="fa-solid fa-circle-question"></i> Tanya Jawab (FAQ)</span>
                    <h3>Pertanyaan Seputar Pendaftaran</h3>
                </div>
                <div class="faq-list">
                    <details open>
                        <summary>Bagaimana cara mendaftar sebagai santri baru?</summary>
                        <p>Pendaftaran dapat dilakukan dengan mengunjungi langsung sekretariat Sekolah Islam Al-Qur'an Imam Syafi'i pada jam kerja (Senin–Sabtu pukul 07.30–15.30 WITA), atau mengakses tombol <strong>Login Sistem / Portal SIAKAD</strong> untuk registrasi akun awal.</p>
                    </details>
                    <details>
                        <summary>Apakah calon siswa harus sudah lancar membaca Al-Qur'an saat mendaftar?</summary>
                        <p>Tidak harus. Setiap siswa baru akan mengikuti pemetaan kemampuan awal (placement test) dan akan dibimbing dari dasar melalui program <strong>Tahsin</strong> sebelum melanjutkan ke tahap <strong>Tahfizhul Qur'an</strong> sesuai kemampuannya.</p>
                    </details>
                    <details>
                        <summary>Apakah menerima siswa pindahan dari sekolah lain?</summary>
                        <p>Penerimaan siswa pindahan bergantung pada ketersediaan kuota bangku di kelas yang dituju serta hasil observasi kesetaraan kurikulum diniyah dan akademik. Silakan hubungi panitia PPDB untuk mengecek kuota terkini.</p>
                    </details>
                    <details>
                        <summary>Bagaimana orang tua memantau perkembangan nilai, jadwal, dan SPP anak?</summary>
                        <p>Sekolah telah dilengkapi dengan sistem <strong>SIAKAD Digital</strong>. Orang tua dan siswa dapat masuk melalui menu <strong>Login Sistem</strong> menggunakan HP maupun komputer untuk melihat jadwal harian, jurnal materi guru, absensi, nilai rapor, hingga rincian pembayaran.</p>
                    </details>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\halaman_ppdb.blade.php ENDPATH**/ ?>