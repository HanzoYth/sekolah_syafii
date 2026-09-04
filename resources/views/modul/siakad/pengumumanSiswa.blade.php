<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Pengumuman</title>

    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/css/modul/guru/das_ad_gr.css')}}">
    <link rel="stylesheet" href="{{asset('/css/modul/siakad/pengumumanSiswa.css')}}">
</head>
<body>

    <div class="app-layout">

        <!-- INCLUDE SIDEBAR -->
        <x-sidebar_siakad />

        <!-- MAIN CONTENT AREA -->
        <main class="main-content">

            <header class="topbar">
                <div class="page-title">
                    <h2>Pengumuman</h2>
                    <p>Informasi & pemberitahuan terbaru untuk <strong>{{$data_siswa->nama}}</strong> &middot;{{$data_kelas->nama_ruang}}</p>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <div class="content-body">

                <!-- FLASH MESSAGES / ERROR TOAST -->
                @if(session('eror'))
                    <div class="alert alert-danger" id="errorToast">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
                            <div>
                                <p>
                                    <i class="fas fa-exclamation-circle" style="color: #e63946;"></i>
                                    {{ session('eror') }}
                                </p>
                            </div>
                            <button type="button" onclick="closeToast()" style="background:none; border:none; color: var(--text-light); cursor:pointer; font-size:1.1rem; line-height:1;">&times;</button>
                        </div>
                    </div>
                @endif

                <!-- DAFTAR PENGUMUMAN -->
                <div class="card card-table">
                    <div class="card-header">
                        <h4><i class="fa-solid fa-bullhorn"></i> Daftar Pengumuman</h4>
                    </div>

                    {{-- Data Dummy untuk Pengujian --}}
                    @php
                        $pengumuman_dummy = [
                            (object)[
                                'tanggal' => '28 Agu 2026',
                                'judul' => 'Libur Nasional Hari Kemerdekaan',
                                'ringkasan' => 'Kegiatan belajar mengajar diliburkan pada tanggal 17 Agustus 2026.',
                                'ditujukan' => 'Seluruh Siswa',
                                'isi' => 'Sehubungan dengan peringatan Hari Kemerdekaan Republik Indonesia, seluruh kegiatan belajar mengajar diliburkan pada tanggal 17 Agustus 2026. Kegiatan belajar mengajar akan kembali berjalan normal pada tanggal 18 Agustus 2026. Siswa dan wali murid diimbau untuk berpartisipasi dalam upacara bendera yang diadakan di lingkungan masing-masing.',
                            ],
                            (object)[
                                'tanggal' => '20 Agu 2026',
                                'judul' => 'Jadwal Ujian Tengah Semester',
                                'ringkasan' => 'Jadwal UTS semester ganjil dapat dilihat pada lampiran pengumuman.',
                                'ditujukan' => 'Kelas 1A - 6B',
                                'isi' => 'Ujian Tengah Semester (UTS) ganjil akan dilaksanakan mulai tanggal 1 September 2026 sampai dengan 5 September 2026. Siswa diharapkan hadir tepat waktu dan membawa perlengkapan ujian masing-masing. Jadwal lengkap per mata pelajaran akan dibagikan oleh wali kelas masing-masing.',
                            ],
                            (object)[
                                'tanggal' => '12 Agu 2026',
                                'judul' => 'Pembagian Rapor Semester Genap',
                                'ringkasan' => 'Rapor dapat diambil oleh wali murid di ruang tata usaha.',
                                'ditujukan' => 'Wali Murid',
                                'isi' => 'Pembagian rapor semester genap tahun ajaran 2025/2026 akan dilaksanakan pada tanggal 15 Agustus 2026 pukul 08.00 - 12.00 WITA. Rapor dapat diambil langsung oleh wali murid di ruang tata usaha dengan menunjukkan kartu identitas orang tua/wali.',
                            ],
                        ];

                        // Gunakan $list_pengumuman jika dikirim dari Controller, jika tidak ada pakai $pengumuman_dummy
                        $data_pengumuman = (isset($list_pengumuman) && count($list_pengumuman) > 0) ? $list_pengumuman : $pengumuman_dummy;
                    @endphp

                    @if (count($data_pengumuman) > 0)
                        <div class="table-wrap">
                            <table class="payment-table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Judul Pengumuman</th>
                                        <th>Ditujukan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pengumuman as $item)
                                        <tr>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>
                                                <div class="cell-jenis">
                                                    <strong>{{ $item->judul }}</strong>
                                                    @if(!empty($item->ringkasan))
                                                        <span class="sub">{{ $item->ringkasan }}</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $item->ditujukan }}</td>
                                            <td class="text-center">
                                                <button
                                                    type="button"
                                                    class="btn-action-view"
                                                    title="Lihat Detail"
                                                    data-judul="{{ $item->judul }}"
                                                    data-tanggal="{{ $item->tanggal }}"
                                                    data-ditujukan="{{ $item->ditujukan }}"
                                                    data-isi="{{ $item->isi ?? $item->ringkasan }}"
                                                    onclick="bukaDetailPengumuman(this)"
                                                >
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="table-empty">
                            <i class="fa-solid fa-bullhorn"></i>
                            <p>Belum ada pengumuman yang tersedia.</p>
                        </div>
                    @endif
                </div>

            </div>

            <!-- MODAL DETAIL PENGUMUMAN -->
            <div class="modal-overlay" id="modalPengumuman">
                <div class="modal-box">
                    <div class="modal-header">
                        <div class="modal-header-icon">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>
                        <button type="button" class="modal-close" title="Tutup" onclick="tutupDetailPengumuman()">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="modal-title" id="modalJudul">-</h3>
                        <div class="modal-meta">
                            <span class="modal-meta-item">
                                <i class="fa-regular fa-calendar"></i>
                                <span id="modalTanggal">-</span>
                            </span>
                            <span class="modal-meta-item">
                                <i class="fa-solid fa-users"></i>
                                <span id="modalDitujukan">-</span>
                            </span>
                        </div>
                        <p class="modal-isi" id="modalIsi">-</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="modal-btn-tutup" onclick="tutupDetailPengumuman()">Tutup</button>
                    </div>
                </div>
            </div>

        </main>
    </div>
<x-chatbot />
    <script>
        function closeToast() {
            const toast = document.getElementById('errorToast');
            if (toast) {
                toast.classList.add('fade-out');
                setTimeout(() => {
                    toast.remove();
                }, 400);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('errorToast');
            if (toast) {
                setTimeout(() => {
                    closeToast();
                }, 5000);
            }
        });

        // --- MODAL DETAIL PENGUMUMAN ---
        function bukaDetailPengumuman(btn) {
            const modal = document.getElementById('modalPengumuman');

            document.getElementById('modalJudul').textContent = btn.dataset.judul;
            document.getElementById('modalTanggal').textContent = btn.dataset.tanggal;
            document.getElementById('modalDitujukan').textContent = btn.dataset.ditujukan;
            document.getElementById('modalIsi').textContent = btn.dataset.isi;

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function tutupDetailPengumuman() {
            const modal = document.getElementById('modalPengumuman');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Tutup modal saat klik area luar (overlay)
        document.getElementById('modalPengumuman').addEventListener('click', (e) => {
            if (e.target.id === 'modalPengumuman') {
                tutupDetailPengumuman();
            }
        });

        // Tutup modal dengan tombol ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                tutupDetailPengumuman();
            }
        });
    </script>
</body>
</html>