<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi Guru - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/edit_absen_guru.css') }}">
</head>
<body>

<div class="dashboard-container">
    <main class="main-wrapper">
        
        <!-- TOPBAR HEADER -->
        <header class="topbar">
            <div class="topbar-left">
                <a href="javascript:history.back()" class="btn-back" title="Kembali">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div class="topbar-title">
                    <h2>Edit & Tambah Absensi Guru</h2>
                    <p>Kelola riwayat data kehadiran guru secara terstruktur</p>
                </div>
            </div>
        </header>

        <!-- FORM UTAMA -->
        <form action="/gr/keabs/update" method="POST" id="formEditAbsen">
            @csrf
            <!-- ID Guru disimpan secara tertutup jika diperlukan -->
            <input type="hidden" name="guru_id" value="{{ $guru->id ?? '' }}">

            <div class="form-grid">
                
                <!-- CARD INFORMASI GURU -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="header-icon icon-info">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <div>
                                <h3>Informasi Tenaga Pengajar</h3>
                                <p class="subtitle">Data identitas utama guru yang akan diubah riwayat absensinya</p>
                            </div>
                        </div>
                        
                        <div class="card-body grid-cols-3">
                            <div class="form-group">
                                <label for="nama_guru">Nama Lengkap Guru</label>
                                <input type="text" id="nama_guru" class="form-control readonly" value="{{ $data_guru->nama}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nig_guru">Nomor Induk Guru (NIG)</label>
                                <input type="text" id="nig_guru" class="form-control readonly" value="{{ $data_guru->nig }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="cabang_guru">Cabang / Unit</label>
                                <input type="text" id="cabang_guru" class="form-control readonly" value="{{ $data_cabang->nama_cabang}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD FORM INPUT DINAMIS ABSENSI -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="justify-content: space-between;">
                            <div style="display: flex; align-items: center; gap: 14px;">
                                <div class="header-icon icon-income">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </div>
                                <div>
                                    <h3>Riwayat & Input Kehadiran</h3>
                                    <p class="subtitle">Tambahkan tanggal dan sesuaikan status absensi guru</p>
                                </div>
                            </div>

                            <!-- TOMBOL TAMBAH INPUT BARIS -->
                            <button type="button" class="btn-add" id="btnAddRow">
                                <i class="fa-solid fa-plus"></i>
                                <span>Tambah Baris Absensi</span>
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="dynamic-list" id="absensiList">
                                
                                <!-- BARIS BAWAAN (DEFAULT ROW / DATA EKSISTING) -->
                                <div class="dynamic-row">
                                    <div class="form-group flex-2">
                                        <label>Tanggal Absensi</label>
                                        <input type="date" name="tanggal[]" class="form-control" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="form-group flex-2">
                                        <label>Status Kehadiran</label>
                                        <select name="status[]" class="form-control">
                                            <option value="h" selected>Hadir</option>
                                            <option value="i">Izin</option>
                                            <option value="s">Sakit</option>
                                            <option value="a">Alpa</option>
                                        </select>
                                    </div>
                                    <div class="form-group align-self-end">
                                        <button type="button" class="btn-remove-row" onclick="removeRow(this)" title="Hapus Baris">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- CARD FOOTER UNTUK SIMPAN -->
                        <div class="dynamic-section" style="margin-top: 24px; display: flex; justify-content: flex-end;">
                            <button type="submit" class="btn-primary">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>Simpan Perubahan Absensi</span>
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </main>
</div>

<!-- JAVASCRIPT UNTUK DYNAMIC INPUT -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnAddRow = document.getElementById('btnAddRow');
        const absensiList = document.getElementById('absensiList');

        // Fungsi Tambah Baris Input Absensi
        btnAddRow.addEventListener('click', function() {
            const row = document.createElement('div');
            row.classList.add('dynamic-row');

            // Format Tanggal Hari Ini untuk default input
            const today = new Date().toISOString().split('T')[0];

            row.innerHTML = `
                <div class="form-group flex-2">
                    <label>Tanggal Absensi</label>
                    <input type="date" name="tanggal[]" class="form-control" value="${today}" required>
                </div>
                <div class="form-group flex-2">
                    <label>Status Kehadiran</label>
                    <select name="status[]" class="form-control">
                        <option value="h">Hadir</option>
                        <option value="i">Izin</option>
                        <option value="s">Sakit</option>
                        <option value="a">Alpa</option>
                    </select>
                </div>
                <div class="form-group flex-2">
                    <label>Keterangan (Opsional)</label>
                    <input type="text" name="keterangan[]" class="form-control" placeholder="Contoh: Datang terlambat / Surat Dokter">
                </div>
                <div class="form-group align-self-end">
                    <button type="button" class="btn-remove-row" onclick="removeRow(this)" title="Hapus Baris">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            `;

            absensiList.appendChild(row);
        });
    });

    // Fungsi Hapus Baris Input
    function removeRow(element) {
        const rows = document.querySelectorAll('.dynamic-row');
        if (rows.length > 1) {
            element.closest('.dynamic-row').remove();
        } else {
            alert('Setidaknya harus ada 1 baris input absensi!');
        }
    }
</script>

</body>
</html>