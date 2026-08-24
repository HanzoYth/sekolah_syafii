<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Pengajuan Guru</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Memanggil CSS Terpisah -->
    <link rel="stylesheet" href="{{ asset('css/modul/guru/kelola_pengajuan.css') }}">
</head>
<body>

    <div class="app-container">
        <!-- SIDEBAR -->
        <x-sidebar_guru />

        <!-- MAIN CONTENT AREA -->
        <main class="main-content">
            <div class="main-wrapper">
                
                <!-- TOPBAR HEADER -->
                <div class="topbar">
                    <div class="topbar-title">
                        <h2>Persetujuan Pengajuan Guru</h2>
                        <p>Kelola dan berikan persetujuan permohonan izin atau sakit guru.</p>
                    </div>
                </div>

                <!-- CARD TABLE PENGAJUAN -->
                <div class="card">
                    <div class="table-responsive">
                        <table class="table-pengajuan">
                            <thead>
                                <tr>
                                    <th>Nama Guru</th>
                                    <th>Tanggal Terbuat</th>
                                    <th>Status Konfirmasi</th>
                                    <th>Jenis Pengajuan</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_pengajuan as $value)
                                    @php
                                        $data_guru = App\Models\guru::where("id",$value->guru_id)->first()->nama;
                                        $tanggal = Carbon\Carbon::parse($value->created_at)->translatedFormat("d M Y");
                                        $status_pengajuan = $value->status_pengajuan == "s" ? "Sakit" : "Izin"; 
                                    @endphp
                                    <tr>
                                        <td>{{$data_guru}}</td>
                                        <td>{{$tanggal}}</td>
                                        <td>
                                            @if ($value->konfirmasi == 'd')
                                                <span class="badge badge-success">Diterima</span>
                                            @elseif ($value->konfirmasi == 't')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($status_pengajuan == "Sakit")
                                                <span class="badge badge-sakit">Sakit</span>
                                            @else
                                                <span class="badge badge-izin">Izin</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-group" style="justify-content: center;">
                                                <!-- Tombol Detail -->
                                                <button class="btn btn-icon btn-view" title="Lihat Detail" onclick="openModalDetail('{{$tanggal}}','{{$status_pengajuan}}','{{$value->isi}}')">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                
                                                <!-- Tombol Terima -->
                                                <button class="btn btn-icon btn-accept" title="Terima Pengajuan" onclick="openModalApprove('{{$value->id}}')">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>

                                                <!-- Tombol Tolak -->
                                                <button class="btn btn-icon btn-reject" title="Tolak Pengajuan" onclick="openModalReject('{{$value->id}}')">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- ==========================================================================
        MODAL 1: DETAIL PENGAJUAN
    ========================================================================== -->
    <div class="modal-overlay" id="modalDetail">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Detail Pengajuan</h3>
                <button class="btn-close" onclick="closeModal('modalDetail')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-item">
                    <span class="detail-label">Tanggal Terbuat</span>
                    <span class="detail-value" id="detailTanggal">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Jenis Pengajuan</span>
                    <span class="detail-value" id="detailJenis">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Keterangan / Alasan</span>
                    <span class="detail-value" id="detailKeterangan" style="font-weight: 400; color: #475569;">-</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalDetail')">Tutup</button>
            </div>
        </div>
    </div>

    <!-- ==========================================================================
        MODAL 2: KONFIRMASI TERIMA
    ========================================================================== -->
    <div class="modal-overlay" id="modalApprove">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Terima Pengajuan</h3>
                <button class="btn-close" onclick="closeModal('modalApprove')">&times;</button>
            </div>
            <form id="formApprove" action="" method="GET">
                @csrf
                <div class="modal-body">
                    <p style="font-size: 0.95rem; color: #334155;">
                        Apakah Anda yakin ingin <strong>menerima</strong> permohonan pengajuan ini?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalApprove')">Batal</button>
                    <button type="submit" class="btn btn-success">Ya, Terima</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================================================
        MODAL 3: KONFIRMASI TOLAK
    ========================================================================== -->
    <div class="modal-overlay" id="modalReject">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Tolak Pengajuan</h3>
                <button class="btn-close" onclick="closeModal('modalReject')">&times;</button>
            </div>
            <form id="formReject" action="" method="GET">
                @csrf
                <div class="modal-body">
                    <p style="font-size: 0.95rem; color: #334155;">
                        Apakah Anda yakin ingin <strong>menolak</strong> permohonan pengajuan ini?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalReject')">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Pengajuan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT INTERACTIVE -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        function openModalDetail(tanggal, jenis, keterangan) {
            document.getElementById('detailTanggal').innerText = tanggal;
            document.getElementById('detailJenis').innerText = jenis;
            document.getElementById('detailKeterangan').innerText = keterangan || '-';
            openModal('modalDetail');
        }

        function openModalApprove(id) {
            document.getElementById("formApprove").action = `/gr/acpggr/${id}`;
            openModal('modalApprove');
        }

        function openModalReject(id) {
            document.getElementById("formReject").action = `/gr/rjpggr/${id}`;
            openModal('modalReject');
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal-overlay')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>
</html>