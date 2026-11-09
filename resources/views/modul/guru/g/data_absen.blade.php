<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Absensi Guru - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/modul/guru/edit_absen_guru.css')}}?v={{ time() }}">

    <style>
        /* Styling Tambahan untuk State Loading pada Tombol */
        .btn-modal-confirm:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<div class="dashboard-container" id="content">
    <main class="main-wrapper">
        
        <input type="hidden" value="{{$data_guru->id}}" id="id_guru">
        
        <!-- TOPBAR HEADER -->
        <header class="topbar">
            <div class="topbar-left">
                <div class="topbar-title">
                    <h2>Detail & Rekap Absensi Guru</h2>
                    <p>Laporan Kehadiran Bulanan Tenaga Pengajar</p>
                </div>
            </div>
        </header>

        <!-- CARD INFORMASI & REKAP STATISTIK GURU -->
        <div class="col-12" style="margin-bottom: 24px;">
            <div class="card">
                <div class="card-header">
                    <div class="header-icon icon-info">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div>
                        <h3>Informasi & Ringkasan Kehadiran</h3>
                        <p class="subtitle">Data identitas dan rekapitulasi presensi bulan ini</p>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Informasi Utama Guru -->
                    <div class="grid-cols-2" style="margin-bottom: 20px; border-bottom: 1px solid #e5e7eb; padding-bottom: 16px;">
                        <div class="form-group">
                            <label for="nama_guru">Nama Lengkap Guru</label>
                            <input type="text" id="nama_guru" class="form-control readonly" value="{{$data_guru->nama}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="cabang_guru">Cabang / Unit</label>
                            <input type="text" id="cabang_guru" class="form-control readonly" value="{{$data_cabang->nama_cabang}}" readonly>
                        </div>
                    </div>

                    <!-- Rekap Statistik Absensi -->
                    <div class="stats-grid">
                        <div class="stat-box stat-hadir">
                            <span class="stat-label">Jumlah Hadir</span>
                            <span class="stat-value">{{$jumlah_hadir}} <small style="font-size: 0.8rem; font-weight: 500;">Hari</small></span>
                        </div>
                        <div class="stat-box stat-izin">
                            <span class="stat-label">Jumlah Izin</span>
                            <span class="stat-value">{{$jumlah_izin}} <small style="font-size: 0.8rem; font-weight: 500;">Hari</small></span>
                        </div>
                        <div class="stat-box stat-sakit">
                            <span class="stat-label">Jumlah Sakit</span>
                            <span class="stat-value">{{$jumlah_sakit}} <small style="font-size: 0.8rem; font-weight: 500;">Hari</small></span>
                        </div>
                        <div class="stat-box stat-terlambat">
                            <span class="stat-label">Total Terlambat</span>
                            <span class="stat-value">{{$terlambat}} <small style="font-size: 0.8rem; font-weight: 500;">Menit</small></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD TABEL DAFTAR ABSENSI BULAN INI -->
        <div class="col-12" id="area_print">
            <div class="card">
                <div class="card-header card-header-filter">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="header-icon icon-income">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div>
                            <h3>Daftar Presensi Bulan Ini</h3>
                            <p class="subtitle">Riwayat presensi dari awal hingga akhir bulan</p>
                        </div>
                    </div>

                    <!-- KELOMPOK FILTER & TOMBOL AKSI -->
                    <div class="filter-and-actions">
                        <!-- FORM FILTER PERIODE BULAN -->
                        <form action="/gr/edklabs/{{$id_guru}}" method="GET" class="filter-form">
                            <div class="filter-input-group">
                                <i class="fa-solid fa-calendar"></i>
                                <input type="month" name="bulan" id="filter_bulan" value="{{ request('bulan', date('Y-m')) }}">
                            </div>
                            <button type="submit" class="btn-filter">
                                <i class="fa-solid fa-magnifying-glass"></i> Cari
                            </button>
                        </form>

                        <!-- TOMBOL AKSI UTAMA -->
                        <div class="action-buttons-group">
                            <button type="button" class="btn-action btn-print" id="btnPrintModalTrigger" title="Cetak atau Kirim Laporan">
                                <i class="fa-solid fa-print"></i>
                                <span>Cetak / Kirim</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body" style="padding: 0;">
                    <div class="table-responsive">
                        <table class="table-presensi">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk - Keluar</th>
                                    <th>Lokasi Presensi</th>
                                    <th>Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tanggal as $tgl)
                                    @if (App\Models\tanggal_merah::where("cabang_id",$data_guru->cabang_id)->where("tanggal",$tgl->tanggal_bulan)->exists())
                                        <tr class="row-holiday">
                                            <td style="font-weight: 600;">{{$tgl->hari}}</td>
                                            <td>{{Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('d M Y')}}</td>
                                            <td colspan="3" class="holiday-label" style="text-align: center;">
                                                <i class="fa-solid fa-mug-hot"></i> {{App\Models\tanggal_merah::where("cabang_id",$data_guru->cabang_id)->where("tanggal",$tgl->tanggal_bulan)->first()->keterangan}}
                                            </td>
                                        </tr>
                                    @elseif (App\Models\master_absen_guru::where("guru_id",$id_guru)->where("tgl_masuk",$tgl->tanggal_bulan)->exists())
                                    
                                        @if (App\Models\master_absen_guru::where("guru_id",$id_guru)->where("tgl_masuk",$tgl->tanggal_bulan)->first()->status_kehadiran == "h")
                                            <tr>
                                                <td style="font-weight: 500;">{{$tgl->hari}}</td>
                                                <td>{{Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('d M Y')}}</td>
                                                <td>
                                                    <span class="time-badge"><i class="fa-regular fa-clock"></i> {{App\Models\master_absen_guru::where("guru_id",$id_guru)->where("tgl_masuk",$tgl->tanggal_bulan)->first()->waktu_masuk}} - {{App\Models\master_absen_guru::where("guru_id",$id_guru)->where("tgl_masuk",$tgl->tanggal_bulan)->first()->waktu_keluar}}</span>
                                                </td>
                                                <td>
                                                    <div class="location-badge">
                                                        <i class="fa-solid fa-location-dot" style="color: #ef4444;"></i>
                                                        <span>{{$nama_lokasi}}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Hadir</span>
                                                </td>
                                            </tr>

                                        @elseif (App\Models\master_absen_guru::where("guru_id",$id_guru)->where("tgl_masuk",$tgl->tanggal_bulan)->first()->status_kehadiran == "i")
                                            <tr>
                                                <td style="font-weight: 500;">{{$tgl->hari}}</td>
                                                <td>{{Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('d M Y')}}</td>
                                                <td><span style="color: #9ca3af;">-</span></td>
                                                <td><span style="color: #9ca3af;">-</span></td>
                                                <td>
                                                    <span class="badge badge-warning">Izin</span>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td style="font-weight: 500;">{{$tgl->hari}}</td>
                                                <td>{{Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('d M Y')}}</td>
                                                <td><span style="color: #9ca3af;">-</span></td>
                                                <td><span style="color: #9ca3af;">-</span></td>
                                                <td>
                                                    <span class="badge badge-info">Sakit</span>
                                                </td>
                                            </tr>
                                        @endif
                                    @else
                                        @if (strtolower(Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('l')) == "minggu")
                                            <tr class="row-holiday">
                                                <td style="font-weight: 600;">{{$tgl->hari}}</td>
                                                <td>{{Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('d M Y')}}</td>
                                                <td colspan="3" class="holiday-label" style="text-align: center;">
                                                    <i class="fa-solid fa-mug-hot"></i> Libur (Libur Akhir Pekan)
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td style="font-weight: 500;">{{$tgl->hari}}</td>
                                                <td>{{Carbon\Carbon::parse($tgl->tanggal_bulan)->translatedFormat('d M Y')}}</td>
                                                <td><span style="color: #9ca3af;">-</span></td>
                                                <td><span style="color: #9ca3af;">-</span></td>
                                                <td>
                                                    <span class="badge badge-warning">Tidak Hadir</span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<!-- ========================================== -->
<!-- MODAL POP-UP PILIHAN CETAK / KIRIM         -->
<!-- ========================================== -->
<div class="modal-overlay" id="actionModal">
    <div class="modal-card">
        <div class="modal-header">
            <h3><i class="fa-solid fa-file-invoice"></i> Opsi Laporan Absensi</h3>
            <button type="button" class="modal-close-btn" id="modalCloseBtn">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="modal-body">
            <p>Silakan pilih tindakan untuk rekapitulasi absensi guru ini. Aktifkan toggle di bawah untuk mengirim laporan otomatis atau biarkan non-aktif untuk mencetak dokumen.</p>
            
            <!-- Switch Checklist Toggle -->
            <div class="switch-container">
                <div class="switch-label-wrapper">
                    <span class="switch-title" id="switchStatusText">Cetak Dokumen (PDF)</span>
                    <span class="switch-desc">Geser untuk beralih ke mode pengiriman laporan</span>
                </div>
                <label class="switch">
                    <input type="checkbox" id="actionToggle">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-modal-cancel" id="modalCancelBtn">Batal</button>
            <button type="button" class="btn-modal-confirm" id="modalConfirmBtn">Lanjutkan</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<!-- SCRIPT INTERAKSI MODAL, LOADING & AKSI -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnTrigger = document.getElementById('btnPrintModalTrigger');
        const modalOverlay = document.getElementById('actionModal');
        const modalCloseBtn = document.getElementById('modalCloseBtn');
        const modalCancelBtn = document.getElementById('modalCancelBtn');
        const modalConfirmBtn = document.getElementById('modalConfirmBtn');
        const actionToggle = document.getElementById('actionToggle');
        const switchStatusText = document.getElementById('switchStatusText');
        const idGuru = document.getElementById("id_guru");
        
        // Buka Modal
        btnTrigger.addEventListener('click', function () {
            modalOverlay.classList.add('active');
        });

        // Tutup Modal
        function closeModal() {
            modalOverlay.classList.remove('active');
        }

        modalCloseBtn.addEventListener('click', closeModal);
        modalCancelBtn.addEventListener('click', closeModal);
        modalOverlay.addEventListener('click', function (e) {
            if (e.target === modalOverlay) closeModal();
        });

        // Ubah teks label interaktif saat toggle digeser
        actionToggle.addEventListener('change', function () {
            if (this.checked) {
                switchStatusText.textContent = "Kirim Laporan (Email)";
            } else {
                switchStatusText.textContent = "Cetak Dokumen (PDF)";
            }
        });

        async function KirimFile(){
            const areaPrint = document.getElementById('area_print');

            // Ubah tombol ke state Loading
            modalConfirmBtn.disabled = true;
            modalCancelBtn.disabled = true;
            modalConfirmBtn.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...`;

            try {
                // 1. Buat PDF Blob
                const pdfBlob = await html2pdf()
                    .from(areaPrint)
                    .outputPdf('blob');
                const formData = new FormData();
                formData.append('file', pdfBlob, 'absensi.pdf');

                // 3. Ambil CSRF Token
                const token = document.querySelector('meta[name="csrf-token"]').content;

                // 4. Kirim ke Laravel
                const response = await fetch(`/flabsgr/${idGuru.value}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: formData
                });     
                const result = await response.json();

                alert(result.message);
                closeModal();
            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan saat mengirim laporan.');
            } finally {
                // Kembalikan tombol ke state normal setelah selesai (sukses/gagal)
                modalConfirmBtn.disabled = false;
                modalCancelBtn.disabled = false;
                modalConfirmBtn.innerHTML = `Lanjutkan`;
            }
        }

        // Tombol Konfirmasi Aksi
        modalConfirmBtn.addEventListener('click', async function () {
            if (actionToggle.checked) {
                await KirimFile();
            } else {
                closeModal();
                window.print();
            }
        });
    });
</script>

</body>
</html>