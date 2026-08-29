<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembayaran - SIAKAD</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Stylesheet dashboard SIAKAD --}}
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pembayaran.css') }}">

    <style>
        /* CSS Tambahan untuk Merapikan Layout & Pagination */
        .table-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin-bottom: 24px;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            flex-wrap: wrap;
            gap: 12px;
        }

        .card-footer-info {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pagination button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 14px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #334155;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .pagination button:hover:not(:disabled) {
            background-color: #f1f5f9;
            border-color: #94a3b8;
            color: #0f172a;
        }

        .pagination button.active {
            background-color: #2563eb;
            color: #ffffff;
            border-color: #2563eb;
            font-weight: 600;
        }

        .pagination button:disabled {
            background-color: #f1f5f9;
            color: #94a3b8;
            border-color: #e2e8f0;
            cursor: not-allowed;
            opacity: 0.7;
        }
    </style>
</head>
<body>

    @php 
        Carbon\Carbon::setLocale("id");
    @endphp

    <div class="dashboard-container">

        {{-- WADAH TEMPLATE SIDEBAR --}}
        <x-sidebar_siakad />

        {{-- MAIN CONTENT --}}
        <main class="main-content">

            {{-- TOPBAR / HEADER --}}
            <header class="topbar">
                <div class="topbar-left">
                    <span class="topbar-eyebrow">Sistem Informasi Akademik &middot; Selasa, 04 Agustus 2026</span>
                    <h2>Pembayaran</h2>
                </div>

                <div class="academic-pill">
                    <i class="fa-solid fa-calendar-check"></i>
                    T.A. 2025/2026 &middot; Semester Ganjil
                </div>

                <div class="topbar-icons">
                    <div class="icon-bell-wrap">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            {{-- STATISTIK PEMBAYARAN --}}
            <div class="stats-grid pembayaran-stats">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-sack-dollar"></i></div>
                    <div>
                        <h3>Rp 84.200.000</h3>
                        <p>Total Pemasukan Bulan Ini</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-circle-check"></i></div>
                    <div>
                        <h3>712</h3>
                        <p>Siswa Lunas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-hourglass-half"></i></div>
                    <div>
                        <h3>98</h3>
                        <p>Belum Bayar</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div>
                        <h3>32</h3>
                        <p>Tunggakan &gt; 1 Bulan</p>
                    </div>
                </div>
            </div>

            {{-- FILTER PEMBAYARAN --}}
            <div class="filter-box pembayaran-filter">
                <h4>Filter Pembayaran</h4>
                <div class="filter-group">
                    <div class="input-wrap">
                        <label for="filter-bulan-spp">Bulan</label>
                        <select id="filter-bulan-spp" name="bulan_spp">
                            <option value="8" selected>Agustus 2026</option>
                            <option value="7">Juli 2026</option>
                            <option value="6">Juni 2026</option>
                        </select>
                    </div>
                    <div class="input-wrap">
                        <label for="filter-status-bayar">Status</label>
                        <select id="filter-status-bayar" name="status_bayar">
                            <option value="">Semua Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="belum">Belum Bayar</option>
                            <option value="tunggak">Tunggakan</option>
                        </select>
                    </div>
                    <div class="input-wrap">
                        <label for="filter-kelas-spp">Kelas</label>
                        <select id="filter-kelas-spp" name="kelas_spp">
                            <option value="">Semua Kelas</option>
                            <option value="1a">Kelas 1A</option>
                            <option value="2b">Kelas 2B</option>
                            <option value="7a">Kelas 7A</option>
                            <option value="tkb1">TK B1</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- TABEL DAFTAR PEMBAYARAN --}}
            <div class="table-card">
                <div class="table-header">
                    <h4>Daftar Pembayaran SPP</h4>
                    <a href="#" class="card-link">Lihat semua <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Bulan</th>
                                <th>Nominal</th>
                                <th>Tgl Bayar</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_slip_ipp as $value)
                                @php
                                    $data_siswa = App\Models\siswa::where("id",$value->siswa_id)->first();
                                    $data_kelas = App\Models\ruang_kelas::where("id",$data_siswa->kelas_id)->first();
                                @endphp
                                <tr>
                                    <td><span class="student-name">{{$data_siswa->nama}}</span></td>
                                    <td><span class="class-pill">{{$data_kelas->nama_ruang}}</span></td>
                                    <td>{{$value->tanggal_awal ?? 'kosong'}}</td>
                                    <td class="amount">{{$value->nominal}}</td>
                                    <td>{{$value->tanggal_awal ?? 'kosong'}}</td>
                                    <td><span class="badge {{$value->status ? 'success' : 'danger'}}"><i class="fa-solid fa-triangle-exclamation"></i> {{$value->status ? 'lunas':'tunggakan'}}</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/sk/dp" class="btn-action view" title="Detail"><i class="fa-solid fa-eye"></i></a>
                                            <button class="btn-action edit" title="Edit" onclick="openEditModal('{{$value->id}}','{{$data_siswa->nama}}', '{{$value->tanggal_awal}}', '{{$}}', 'lunas')"><i class="fa-solid fa-pen-to-square"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- FOOTER CARD / PAGINATION --}}
                <div class="card-footer">
                    <span class="card-footer-info">Menampilkan 4 dari 4 data siswa aktif</span>
                    <div class="pagination">
                        <button disabled><i class="fa-solid fa-chevron-left"></i> Sebelumnya</button>
                        <button class="active">1</button>
                        <button disabled>Selanjutnya <i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL POPUP EDIT PEMBAYARAN --}}
    <div id="modalEditPembayaran" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Edit Pembayaran IPP / SPP</h3>
                <button type="button" class="btn-close-modal" onclick="closeEditModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="#" method="POST" class="modal-body">
                @csrf
                <input type="hidden" value="" id="id">
                <div class="modal-field">
                    <label>Nama Siswa</label>
                    <input type="text" id="modal-nama-siswa" readonly disabled style="background-color: #f1f5f9; cursor: not-allowed;">
                </div>
                <div class="modal-field">
                    <label>Kelas</label>
                    <input type="text" id="modal-nama-kelas" readonly disabled style="background-color: #f1f5f9; cursor: not-allowed;">
                </div>
                <div class="modal-field">
                    <label>Jenis sekolah</label>
                    <input type="text" id="modal-nama-sekolah" readonly disabled style="background-color: #f1f5f9; cursor: not-allowed;">
                </div>
                <div class="modal-field">
                    <label for="edit-bulan">Dari Bulan Ke ?</label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal">
                </div>
                <div class="modal-field">
                    <label for="edit-bulan">Sampai Bulan ke ?</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir">
                </div>
                <div class="modal-field">
                    <label for="edit-nominal">Nominal Pembayaran (Rp)</label>
                    <input type="number" id="edit-nominal" name="nominal" placeholder="Contoh: 350000" required>
                </div>
                <div class="modal-field">
                    <label for="edit-nominal-bayar">Jumlah Yang Di Bayar (Rp)</label>
                    <input type="number" id="edit-nominal" name="nominal" placeholder="Contoh: 350000" required>
                </div>
                <div class="modal-field">
                    <label for="edit-status">Status Pembayaran IPP</label>
                    <select id="edit-status" name="status">
                        <option value="lunas">Lunas</option>
                        <option value="belum">Belum Bayar</option>
                        <option value="tunggak">Tunggakan</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn-modal-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT DYNAMIC POPUP --}}
    <script>
        function openEditModal(id,nama,kelas,sekolah,tanggal_awal,tanggal_akhir,nominal,jumlah_dibayar) {
            document.getElementById("id").value = id;
            document.getElementById('modal-nama-siswa').value = nama;
            document.getElementById('modal-nama-kelas').value = kelas;
            document.getElementById('modal-nama-masjid').value = masjid;
            document.getElementById('tanggal_awal').value = tanggal_awal;
            document.getElementById('tanggal_akhir').value = tanggal_akhir;
            document.getElementById('edit-nominal').value = nominal;
            document.getElementById('edit-nominal-bayar').value = jumlah_dibayar;
            document.getElementById('edit-status').value = status;

            document.getElementById('modalEditPembayaran').classList.add('active');
        }

        function closeEditModal() {
            document.getElementById('modalEditPembayaran').classList.remove('active');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modalEditPembayaran');
            if (event.target === modal) {
                closeEditModal();
            }
        }
    </script>

</body>
</html>