<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/modul/guru/pengumuman.css') }}">
</head>
<body>

<div class="app-container">

    <!-- AREA SIDEBAR -->
    <x-sidebar_guru />

    <!-- AREA UTAMA Halaman Pengumuman -->
    <main class="main-content">
        <div class="main-wrapper">

            <!-- TOPBAR HEADER & TOMBOL TAMBAH -->
            <header class="topbar">
                <div class="topbar-title">
                    <h2>Daftar Pengumuman</h2>
                    <p>Kelola seluruh informasi dan pengumuman untuk guru & staf</p>
                </div>
                @if ($data_guru->kepala_sekolah)
                    <button class="btn btn-primary" onclick="openModal('modalTambah')">
                        <i class="fa-solid fa-plus"></i> Tambah Pengumuman
                    </button>
                @endif
            </header>

            <!-- CARD TABEL PENGUMUMAN (DATA MANUAL / HARDCODED) -->
            <div class="card">
                <div class="table-responsive">
                    <table class="table-pengumuman">
                        <thead>
                            <tr>
                                <th style="width: 45%;">Judul Pengumuman</th>
                                <th style="width: 25%;">Tanggal Dibuat</th>
                                <th style="width: 30%; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_pengumuman as $value)
                                <tr>
                                    <td><strong>{{$value->judul}}</strong></td>
                                    <td>
                                        <i class="fa-regular fa-calendar-days" style="color: var(--text-muted); margin-right: 6px;"></i> 
                                        {{Carbon\Carbon::parse($value->tanggal)->translatedFormat("d M Y")}}
                                    </td>
                                    <td>
                                        <div class="action-group" style="justify-content: center;">
                                            <!-- Tombol Detail (Mata) -->
                                            <button class="btn btn-icon btn-view" title="Lihat Detail" 
                                                onclick="openDetailModal('{{$value->judul}}', '{{$value->tanggal}}', '{{$value->isi}}')">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            @if ($data_guru->kepala_sekolah)
                                                <!-- Tombol Edit -->
                                                <button class="btn btn-icon btn-edit" title="Edit Pengumuman" 
                                                    onclick="openEditModal('{{$value->id}}', '{{$value->judul}}', '{{$value->tanggal}}', '{{$value->isi}}')">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <!-- Tombol Hapus -->
                                                <button class="btn btn-icon btn-delete" title="Hapus Pengumuman" onclick="confirmDelete('1')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            @endif
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
     1. MODAL POP-UP TAMBAH PENGUMUMAN
     ========================================================================== -->
<div class="modal-overlay" id="modalTambah">
    <div class="modal-container">
        <div class="modal-header">
            <h3><i class="fa-solid fa-bullhorn" style="color: var(--primary-color); margin-right: 8px;"></i> Buat Pengumuman Baru</h3>
            <button class="btn-close" onclick="closeModal('modalTambah')">&times;</button>
        </div>
        <form method="POST" action="/gr/tbpggr">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="judul_tambah">Judul Pengumuman</label>
                    <input type="text" id="judul_tambah" name="judul" class="form-control" placeholder="Masukkan judul pengumuman..." required>
                </div>
                <div class="form-group">
                    <label for="tanggal_tambah">Tanggal Pengumuman</label>
                    <input type="date" id="tanggal_tambah" name="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="isi_tambah">Isi Pengumuman</label>
                    <textarea id="isi_tambah" name="isi" class="form-control" placeholder="Tuliskan detail pengumuman di sini..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambah')">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Simpan Pengumuman</button>
            </div>
        </form>
    </div>
</div>

<!-- ==========================================================================
     2. MODAL POP-UP EDIT PENGUMUMAN
     ========================================================================== -->
<div class="modal-overlay" id="modalEdit">
    <div class="modal-container">
        <div class="modal-header">
            <h3><i class="fa-solid fa-pen-to-square" style="color: var(--warning-color); margin-right: 8px;"></i> Edit Pengumuman</h3>
            <button class="btn-close" onclick="closeModal('modalEdit')">&times;</button>
        </div>
        <form method="POST" action="/gr/edpggr">
            @csrf
            <input type="hidden" name="id_pengumuman" value="0" id="id_pengumuman">
            <div class="modal-body">
                <div class="form-group">
                    <label for="judul_edit">Judul Pengumuman</label>
                    <input type="text" id="judul_edit" name="judul" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_edit">Tanggal Pengumuman</label>
                    <input type="date" id="tanggal_edit" name="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="isi_edit">Isi Pengumuman</label>
                    <textarea id="isi_edit" name="isi" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalEdit')">Batal</button>
                <button type="submit" class="btn btn-primary" style="background-color: var(--warning-color);"><i class="fa-solid fa-floppy-disk"></i> Perbarui</button>
            </div>
        </form>
    </div>
</div>

<!-- ==========================================================================
     3. MODAL POP-UP DETAIL PENGUMUMAN (BARU)
     ========================================================================== -->
<div class="modal-overlay" id="modalDetail">
    <div class="modal-container">
        <div class="modal-header">
            <h3><i class="fa-solid fa-circle-info" style="color: #0284c7; margin-right: 8px;"></i> Detail Pengumuman</h3>
            <button class="btn-close" onclick="closeModal('modalDetail')">&times;</button>
        </div>
        <div class="modal-body">
            <div class="detail-group" style="margin-bottom: 12px;">
                <h4 id="detail_judul" style="font-size: 1.1rem; color: var(--text-main); margin-bottom: 6px;">-</h4>
                <p style="font-size: 0.85rem; color: var(--text-muted);">
                    <i class="fa-regular fa-calendar-days" style="margin-right: 4px;"></i> 
                    <span id="detail_tanggal">-</span>
                </p>
            </div>
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 12px 0;">
            <div class="detail-group">
                <label style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 6px;">Isi Informasi:</label>
                <p id="detail_isi" style="font-size: 0.95rem; color: var(--text-main); line-height: 1.6; white-space: pre-line;"></p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('modalDetail')">Tutup</button>
        </div>
    </div>
</div>

<!-- SCRIPT JS INTERAKSI MODAL -->
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.add('active');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
    }

    // Fungsi mengisi modal Edit
    function openEditModal(id, judul, tanggal, isi) {
        document.getElementById("id_pengumuman").value = id;
        document.getElementById('judul_edit').value = judul;
        document.getElementById('tanggal_edit').value = tanggal;
        document.getElementById('isi_edit').value = isi;
        openModal('modalEdit');
    }

    // Fungsi mengisi modal Detail (Lihat)
    function openDetailModal(judul, tanggal, isi) {
        document.getElementById('detail_judul').innerText = judul;
        document.getElementById('detail_tanggal').innerText = tanggal;
        document.getElementById('detail_isi').innerText = isi;
        openModal('modalDetail');
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('modal-overlay')) {
            event.target.classList.remove('active');
        }
    }

    function handleSubmit(event, modalId) {
        event.preventDefault();
        alert('Data berhasil diproses!');
        closeModal(modalId);
    }

    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')) {
            alert('Pengumuman dengan ID ' + id + ' berhasil dihapus!');
        }
    }
</script>

</body>
</html>