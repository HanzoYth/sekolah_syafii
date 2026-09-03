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

        .hide{
            display: none;
        }

        .no_hide{
            display: block;
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
                                            <button class="btn-action edit" title="Edit" onclick="openEditModal('{{$value->id}}','{{$data_siswa->nama}}', '{{$data_kelas->nama_ruang}}', '{{$data_sekolah->jenis}}','{{$value->tanggal_awal}}','{{$value->nominal}}','{{$value->status}}','{{$sisa_bayar}}')"><i class="fa-solid fa-pen-to-square"></i></button>
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
                <input type="hidden" value="" id="id" name = "id">
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
                    <label for="edit-bulan"> Bulan </label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal">
                </div>
              
                <div class="modal-field">
                    <label for="edit-nominal">Nominal Pembayaran (Rp)</label>
                    <input type="number" id="edit-nominal" name="nominal" placeholder="Contoh: 350000" required>
                </div>
                <div class="modal-field">
                    <label for="edit-nominal-bayar">Jumlah Yang Di Bayar (Rp)</label>
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

    {{-- SCRIPT DYNAMIC POPUP --}}
    <script>
        var input_status = document.getElementById("filter-status-bayar");
        var input_kelas = document.getElementById("filter-kelas-spp");
        var bulan_ipp = null;

        document.getElementById("filter-bulan-spp").addEventListener("change",() => {
            const [tahun,bulan] = document.getElementById("filter-bulan-spp").value.split("-");
            
            const tanggal = new Date(tahun,parseInt(bulan) - 1); 
            
            bulan_ipp = tanggal.toLocaleDateString("id-ID",{
                month : "long",
                year : "numeric"
            })

            filterData();
        });

        input_status.addEventListener("change",filterData);
        input_kelas.addEventListener("change",filterData);

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
            }else{
                e.target.value = memory_data;
            }

            if (parseInt(e.target.value ? e.target.value : 0) == parseInt(document.getElementById("value_pembayaran").value)){
                document.getElementById("edit-status").value = "Lunas";
            }else{
                document.getElementById("edit-status").value = "Menunggak";        
            }
        });


        
        
        function openEditModal(id,nama,kelas,sekolah,tanggal_awal,nominal,status,sisa_bayar) {

            document.getElementById("edit-bayar").setAttribute("placeholder",`Jumlah Yang harus di bayar ${parseInt(sisa_bayar)}`);

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

        window.onclick = function(event) {
            const modal = document.getElementById('modalEditPembayaran');
            if (event.target === modal) {
                closeEditModal();
            }
        }
    </script>

</body>
</html>