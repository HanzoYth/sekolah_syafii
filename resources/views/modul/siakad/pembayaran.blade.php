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

        .hide {
            display: none !important;
        }

        .no_hide {
            display: block;
        }

        /* Container Tombol Aksi Tabel */
        .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            text-decoration: none;
        }

        .btn-action.view {
            background-color: #e0f2fe;
            color: #0284c7;
        }
        .btn-action.view:hover {
            background-color: #0284c7;
            color: #ffffff;
        }

        .btn-action.edit {
            background-color: #fef3c7;
            color: #d97706;
        }
        .btn-action.edit:hover {
            background-color: #d97706;
            color: #ffffff;
        }

        .btn-action.publish {
            background-color: #e0e7ff;
            color: #4338ca;
        }

        .btn-action.publish:hover {
            background-color: #4338ca;
            color: #ffffff;
        }

        .btn-action.delete {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .btn-action.delete:hover {
            background-color: #dc2626;
            color: #ffffff;
        }

        /* --- Styling Modal Overlay & Popup --- */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.25s ease-in-out;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-card {
            background: #ffffff;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.25s ease-in-out;
            margin: 16px;
        }

        .modal-overlay.active .modal-card {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 1.125rem;
            color: #0f172a;
        }

        .btn-close-modal {
            background: transparent;
            border: none;
            font-size: 1.25rem;
            color: #64748b;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: color 0.2s ease;
        }

        .btn-close-modal:hover {
            color: #0f172a;
        }

        .modal-body {
            padding: 20px 24px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .modal-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .modal-field label {
            font-size: 0.85rem;
            font-weight: 500;
            color: #475569;
        }

        .modal-field input {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 0.9rem;
            outline: none;
            box-sizing: border-box;
            transition: border-color 0.2s ease;
        }

        .modal-field input:focus {
            border-color: #2563eb;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 8px;
        }

        .btn-modal-cancel {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-modal-cancel:hover {
            background-color: #e2e8f0;
        }

        .btn-modal-save {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-modal-save:hover {
            background-color: #1d4ed8;
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
                    <h2>Pembayaran IPP</h2>
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
                        <h3>Rp {{number_format($total_bayar_lunas,0,",",".")}}</h3>
                        <p>Total Lunas Pembayaran IPP</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-circle-check"></i></div>
                    <div>
                        <h3>712</h3>
                        <p>Sudah Lunas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-hourglass-half"></i></div>
                    <div>
                        <h3>98</h3>
                        <p>Belum Lunas</p>
                    </div>
                </div>
            </div>

            {{-- FILTER PEMBAYARAN --}}
            <div class="filter-box pembayaran-filter">
                <h4>Filter Pembayaran</h4>
                <div class="filter-group">
                    <div class="input-wrap">
                        <label for="filter-status-bayar">Status</label>
                        <select id="filter-status-bayar" name="status_bayar">
                            <option value="">Semua Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="Menunggak">Menunggak</option>
                        </select>
                    </div>
                    <div class="input-wrap">
                        <label for="filter-kelas-spp">Kelas</label>
                        <select id="filter-kelas-spp" name="kelas_spp">
                            <option value="">Semua Kelas</option>
                            @foreach ($data_ruang_kelas as $value)
                                <option value="{{$value->nama_ruang}}">{{$value->nama_ruang}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-wrap">
                        <label for="filter-bulan-spp">Bulan & Tahun</label>
                        <input type="month" id="filter-bulan-spp" name="bulan_spp" class="input-date-custom" lang="id">
                    </div>
                </div>
            </div>

            {{-- TABEL DAFTAR PEMBAYARAN --}}
            <div class="table-card">
                <div class="table-header">
                    <h4>Daftar Pembayaran SPP</h4>  
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Bulan</th>
                                <th>Nominal</th>
                                <th>Jumlah Bayar</th>
                                <th>Sisa Tagihan</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_slip_ipp as $value)
                                @php
                                    Carbon\Carbon::setLocale("id");
                                    $data_siswa = App\Models\siswa::where("id",$value->siswa_id)->first();
                                    $data_kelas = App\Models\ruang_kelas::where("id",$data_siswa->kelas_id)->first();
                                    $data_sekolah = App\Models\jenis_sekolah::where("id",$data_siswa->sekolah_id)->first();
                                    $bulan = Carbon\Carbon::parse($value->tanggal_awal)->translatedFormat("F Y");
                                    $sisa_bayar = $value->nominal - $value->jumlah_dibayar;
                                @endphp
                                <tr>
                                    <td><span class="student-name">{{$data_siswa->nama}}</span></td>
                                    <td><span class="class-pill">{{$data_kelas->nama_ruang}}</span></td>
                                    <td class="bulan">{{$bulan}}</td>
                                    <td class="amount">Rp{{number_format($value->nominal,0,",",".")}}</td>
                                    <td>Rp{{isset($value->jumlah_dibayar) ? number_format($value->jumlah_dibayar,0,",",".") : '0'}}</td>
                                    <td>Rp{{number_format($sisa_bayar,0,",",".")}}</td>
                                    <td class="status"><span class="badge {{$value->status ? 'success' : 'danger'}}"><i class="fa-solid fa-triangle-exclamation"></i> {{$value->status ? 'lunas':'menunggak'}}</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/sk/dp" class="btn-action view" title="Detail"><i class="fa-solid fa-eye"></i></a>
                                            <button type="button" class="btn-action edit" title="Edit" onclick="openEditModal('{{$value->id}}','{{$data_siswa->nama}}', '{{$data_kelas->nama_ruang}}', '{{$data_sekolah->jenis}}','{{$value->tanggal_awal}}','{{$value->nominal}}','{{$value->status}}','{{$sisa_bayar}}')"><i class="fa-solid fa-pen-to-square"></i></button>
                                            
                                            {{-- TOMBOL PUBLISH --}}
                                            <button type="button" class="btn-action publish" title="Publish" onclick="openPublishModal('{{$data_siswa->id}}', '{{$data_siswa->nama}}')">
                                                <i class="fa-solid fa-paper-plane"></i>
                                            </button>

                                            {{-- TOMBOL HAPUS --}}
                                            <button type="button" class="btn-action delete" title="Hapus" onclick="openDeleteModal('{{$value->id}}', '{{$data_siswa->nama}}')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- FOOTER CARD / PAGINATION --}}
                <div class="card-footer pagination-wrap">
                    {{-- Laravel Pagination Link --}}
                    <div class="pagination-container">
                        {{ $data_slip_ipp->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL POPUP EDIT PEMBAYARAN --}}
    <div id="modalEditPembayaran" class="modal-overlay">
        <input type="hidden" value="" id="value_pembayaran">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Edit Pembayaran IPP / SPP</h3>
                <button type="button" class="btn-close-modal" onclick="closeEditModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action='/sk/esp' method="POST" class="modal-body">
                @csrf
                <input type="hidden" value="" id="id" name="id">
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
                    <label for="tanggal_awal">Bulan</label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal">
                </div>
              
                <div class="modal-field">
                    <label for="edit-nominal">Nominal Pembayaran (Rp)</label>
                    <input type="number" id="edit-nominal" name="nominal" placeholder="Contoh: 350000" required>
                </div>
                <div class="modal-field">
                    <label for="edit-bayar">Jumlah Yang Di Bayar (Rp)</label>
                    <input type="number" id="edit-bayar" name="bayar">
                </div>
                <div class="modal-field">
                    <label for="edit-status">Status Pembayaran IPP</label>
                    <input type="text" id="edit-status" placeholder="Menunggak" name="status" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn-modal-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL POPUP KONFIRMASI PUBLISH --}}
    <div id="modalPublishPembayaran" class="modal-overlay">
        <div class="modal-card" style="max-width: 420px; text-align: center;">
            <div class="modal-header" style="justify-content: flex-end; padding-bottom: 0; border-bottom: none;">
                <button type="button" class="btn-close-modal" onclick="closePublishModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body" style="padding: 10px 24px 24px 24px;">
                <div style="font-size: 3rem; color: #2563eb; margin-bottom: 12px;">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
                <h3 style="margin-bottom: 8px;">Publish Pembayaran?</h3>
                <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 24px; line-height: 1.5;">
                    Apakah Anda yakin ingin mempublikasikan status pembayaran untuk siswa <strong id="publish-nama-siswa" style="color: #0f172a;">-</strong>?
                </p>
                
                <form action="/sk/pbsp" method="POST" id="formPublish">
                    @csrf
                    <input type="hidden" name="id_siswa" id="id_siswa">
                    <input type="hidden" name="pembayaran" value="spp">
                    
                    <div style="display: flex; gap: 12px; justify-content: center;">
                        <button type="button" class="btn-modal-cancel" onclick="closePublishModal()" style="flex: 1; padding: 10px;">Batal</button>
                        <button type="submit" class="btn-modal-save" style="flex: 1; background-color: #2563eb; padding: 10px;"><i class="fa-solid fa-check"></i> Ya, Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL POPUP KONFIRMASI HAPUS --}}
    <div id="modalDeletePembayaran" class="modal-overlay">
        <div class="modal-card" style="max-width: 420px; text-align: center;">
            <div class="modal-header" style="justify-content: flex-end; padding-bottom: 0; border-bottom: none;">
                <button type="button" class="btn-close-modal" onclick="closeDeleteModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body" style="padding: 10px 24px 24px 24px;">
                <div style="font-size: 3rem; color: #dc2626; margin-bottom: 12px;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h3 style="margin-bottom: 8px;">Hapus Data Pembayaran?</h3>
                <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 24px; line-height: 1.5;">
                    Apakah Anda yakin ingin menghapus data pembayaran untuk siswa <strong id="delete-nama-siswa" style="color: #0f172a;">-</strong>? Tindakan ini tidak dapat dibatalkan.
                </p>
                
                <form action="/sk/hpsp" method="POST" id="formDelete">
                    @csrf
                    <input type="hidden" name="id" id="delete_id">
                    <input type="hidden" name="pembayaran" id="delete_id" value="ipp">
                    
                    <div style="display: flex; gap: 12px; justify-content: center;">
                        <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()" style="flex: 1; padding: 10px;">Batal</button>
                        <button type="submit" class="btn-modal-save" style="flex: 1; background-color: #dc2626; padding: 10px;"><i class="fa-solid fa-trash-can"></i> Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT DYNAMIC POPUP & FILTER --}}
    <script>
        var input_status = document.getElementById("filter-status-bayar");
        var input_kelas = document.getElementById("filter-kelas-spp");
        var bulan_ipp = null;

        document.getElementById("filter-bulan-spp").addEventListener("change",() => {
            const val = document.getElementById("filter-bulan-spp").value;
            if(!val) {
                bulan_ipp = null;
                filterData();
                return;
            }
            const [tahun, bulan] = val.split("-");
            const tanggal = new Date(tahun, parseInt(bulan) - 1); 
            
            bulan_ipp = tanggal.toLocaleDateString("id-ID",{
                month : "long",
                year : "numeric"
            });

            filterData();
        });

        input_status.addEventListener("change", filterData);
        input_kelas.addEventListener("change", filterData);

        function filterData(){
            var value_status = input_status.value;
            var value_kelas = input_kelas.value;
            var row_tr = document.querySelectorAll("tbody tr");

            reset();
            row_tr.forEach((data) => {
                var row_kelas = data.querySelector(".class-pill");
                var row_status = data.querySelector(".status");
                var row_bulan = data.querySelector(".bulan");

                if (value_status != ""){
                    if (!row_status.classList.contains("hide") && row_status.textContent.toLowerCase().trim() != value_status.toLowerCase().trim()){
                        data.classList.add("hide");
                    }
                }

                if (value_kelas != ""){
                    if (!row_kelas.classList.contains("hide") && row_kelas.textContent.toLowerCase().trim() != value_kelas.toLowerCase().trim()){
                        data.classList.add("hide");
                    }
                }

                if (bulan_ipp){
                    if (!row_bulan.classList.contains("hide") && row_bulan.textContent.toLowerCase().trim() != bulan_ipp.toLowerCase().trim()){
                        data.classList.add("hide");
                    }  
                }
            });
        }

        function reset(){
            var row_tr = document.querySelectorAll("tbody tr");
            row_tr.forEach((data) => {
                data.classList.remove("hide");
            }); 
        }

        var memory_data = 0;
        document.getElementById("edit-bayar").addEventListener('input',(e) => {
            if (parseInt(e.target.value ? e.target.value : 0) <= parseInt(document.getElementById("value_pembayaran").value)){
                memory_data = parseInt(e.target.value);
            } else {
                e.target.value = memory_data;
            }

            if (parseInt(e.target.value ? e.target.value : 0) == parseInt(document.getElementById("value_pembayaran").value)){
                document.getElementById("edit-status").value = "Lunas";
            } else {
                document.getElementById("edit-status").value = "Menunggak";        
            }
        });

        /* --- Fungsi Modal Edit --- */
        function openEditModal(id, nama, kelas, sekolah, tanggal_awal, nominal, status, sisa_bayar) {
            document.getElementById("edit-bayar").setAttribute("placeholder", `Jumlah Yang harus di bayar ${parseInt(sisa_bayar)}`);
            document.getElementById("value_pembayaran").value = sisa_bayar;
            document.getElementById("id").value = id;
            document.getElementById('modal-nama-siswa').value = nama;
            document.getElementById('modal-nama-sekolah').value = sekolah;
            document.getElementById('modal-nama-kelas').value = kelas;
            document.getElementById('tanggal_awal').value = tanggal_awal;
            document.getElementById('edit-nominal').value = parseInt(nominal);
            document.getElementById("edit-status").value = parseInt(status) ? "Lunas" : "Menunggak";
            document.getElementById('modalEditPembayaran').classList.add('active');
        }

        function closeEditModal() {
            document.getElementById('modalEditPembayaran').classList.remove('active');
        }

        /* --- Fungsi Modal Publish --- */
        function openPublishModal(id, nama) {
            document.getElementById('id_siswa').value = id;
            document.getElementById('publish-nama-siswa').textContent = nama;
            document.getElementById('modalPublishPembayaran').classList.add('active');
        }

        function closePublishModal() {
            document.getElementById('modalPublishPembayaran').classList.remove('active');
        }

        /* --- Fungsi Modal Hapus --- */
        function openDeleteModal(id, nama) {
            document.getElementById('delete_id').value = id;
            document.getElementById('delete-nama-siswa').textContent = nama;
            document.getElementById('modalDeletePembayaran').classList.add('active');
        }

        function closeDeleteModal() {
            document.getElementById('modalDeletePembayaran').classList.remove('active');
        }

        /* --- Event Handler Klik Luar Modal --- */
        window.onclick = function(event) {
            const modalEdit = document.getElementById('modalEditPembayaran');
            const modalPublish = document.getElementById('modalPublishPembayaran');
            const modalDelete = document.getElementById('modalDeletePembayaran');

            if (event.target === modalEdit) {
                closeEditModal();
            }
            if (event.target === modalPublish) {
                closePublishModal();
            }
            if (event.target === modalDelete) {
                closeDeleteModal();
            }
        }
    </script>

</body>
</html>