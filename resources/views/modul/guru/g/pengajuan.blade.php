<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengajuan Guru</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Memanggil CSS Terpisah -->
    <link rel="stylesheet" href="{{ asset('css/modul/guru/pengajuan.css') }}">
</head>
<body>

    <div class="app-container">
        <!-- SPACE UNTUK SIDEBAR -->
        <x-sidebar_guru />
        <!-- Silakan include/render komponen sidebar Anda di sini -->

        <!-- MAIN CONTENT AREA PENGAJUAN -->
        <main class="main-content">
            <div class="main-wrapper">
                
                <!-- TOPBAR HEADER -->
                <div class="topbar">
                    <div class="topbar-title">
                        <h2>Daftar Pengajuan Guru</h2>
                        <p>Kelola data permohonan izin dan sakit guru dengan mudah.</p>
                    </div>
                    <button class="btn btn-primary" onclick="openModal('modalTambah')">
                        <i class="fa-solid fa-plus"></i> Tambah Pengajuan
                    </button>
                </div>

                <!-- CARD TABLE PENGAJUAN -->
                <div class="card">
                    <div class="table-responsive">
                        <table class="table-pengajuan">
                            <thead>
                                <tr>
                                    <th>Tanggal Terbuat</th>
                                    <th>Konfirmasi</th>
                                    <th>Jenis Pengajuan</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_pengajuan as $value)
                                    @php
                                        $tanggal = Carbon\Carbon::parse($value->created_at)->translatedFormat("d M Y");
                                        $status_pengajuan = $value->status_pengajuan == "s"  ? "Sakit" : "Izin"; 
                                    @endphp
                                    <tr>
                                        <td>{{$tanggal}}</td>
                                        <td>
                                            @if ($value->konfirmasi == 'd')
                                                <span class="badge badge-success">Diterima</span>
                                            @elseif ($value->konfirmasi == 't')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-warning">Belum di Konfirmasi</span>
                                            @endif
                                        </td>

                                        @if ($status_pengajuan == "Sakit")
                                            <td><span class="badge badge-sakit">Sakit</span></td>
                                        @else
                                            <td><span class="badge badge-izin">Izin</span></td>
                                        @endif
                                        <td>
                                            <div class="action-group" style="justify-content: center;">
                                                <button class="btn btn-icon btn-view" title="Lihat Detail" onclick="openModalDetail('{{$tanggal}}','{{$status_pengajuan}}','{{$value->isi}}')">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                @if ($value->konfirmasi == 'b')
                                                    <button class="btn btn-icon btn-edit" title="Edit Pengajuan" onclick="openModalEdit('{{$value->id}}','{{$value->status_pengajuan}}','{{$value->isi}}')">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                @endif
                                                <button class="btn btn-icon btn-delete" title="Hapus Pengajuan" onclick="openModalDelete('{{$value->id}}')">
                                                    <i class="fa-solid fa-trash-can"></i>
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
       MODAL 1: TAMBAH PENGAJUAN
       ========================================================================== -->
    <div class="modal-overlay" id="modalTambah">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Tambah Pengajuan Guru</h3>
                <button class="btn-close" onclick="closeModal('modalTambah')">&times;</button>
            </div>
            <form action="/gr/tbpgjgr" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jenis_pengajuan">Jenis Pengajuan</label>
                        <select name="jenis_pengajuan" id="jenis_pengajuan" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Jenis Pengajuan --</option>
                            <option value="i">Izin</option>
                            <option value="s">Sakit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan / Alasan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Tuliskan alasan pengajuan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambah')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pengajuan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================================================
       MODAL 2: DETAIL PENGAJUAN (MATA)
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
       MODAL 3: EDIT PENGAJUAN
       ========================================================================== -->
    <div class="modal-overlay" id="modalEdit">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Edit Pengajuan Guru</h3>
                <button class="btn-close" onclick="closeModal('modalEdit')">&times;</button>
            </div>
            <form id="formEdit" action="/gr/edpgjgr" method="POST">
                @csrf
                <input type="hidden" value="" id="id_pengajuan" name="id_pengajuan">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editJenis">Jenis Pengajuan</label>
                        <select name="jenis_pengajuan" id="editJenis" class="form-control" required>
                            <option value="i">Izin</option>
                            <option value="s">Sakit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editKeterangan">Keterangan / Alasan</label>
                        <textarea name="keterangan" id="editKeterangan" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalEdit')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Pengajuan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================================================
       MODAL 4: HAPUS PENGAJUAN
       ========================================================================== -->
    <div class="modal-overlay" id="modalHapus">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Hapus Pengajuan</h3>
                <button class="btn-close" onclick="closeModal('modalHapus')">&times;</button>
            </div>
            <form id="formHapus" method="GET">
                @csrf
                <input type="hidden" value="" id="id_pengajuan" name="id_pengajuan">
                <div class="modal-body">
                    <p style="font-size: 0.95rem; color: #334155;">
                        Apakah Anda yakin ingin menghapus data pengajuan ini?.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalHapus')">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Data</button>
                </div>
            </form>
        </div>
    </div>
    <x-warning />
    <!-- SCRIPT POP-UP INTERACTIVE -->
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

        function openModalEdit(id,jenis, keterangan) {
            document.getElementById("id_pengajuan").value = parseInt(id);
            document.getElementById('editJenis').value = jenis;
            document.getElementById('editKeterangan').value = keterangan;
            openModal('modalEdit');
        }

        function openModalDelete(id) {
            document.getElementById("formHapus").action = `/gr/hppgjgr/${parseInt(id)}`
            openModal('modalHapus');
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal-overlay')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>
</html>