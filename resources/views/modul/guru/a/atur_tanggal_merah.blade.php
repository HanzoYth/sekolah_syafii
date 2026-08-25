<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Tanggal Merah - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/atur_tanggal_merah.css') }}">
</head>
<body>

<div class="dashboard-container">
    <!-- Include Sidebar -->
    <x-sidebar_guru />

    <main class="tanggal-merah-wrapper">
        <!-- TOPBAR HEADER -->
        <header class="topbar">
            <div class="topbar-title">
                <h2>Kelola Tanggal Merah</h2>
                <p>Atur hari libur nasional dan kebijakan libur khusus per cabang sekolah</p>
            </div>
            <button class="btn-add-trigger" id="btnOpenAddModal">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Tanggal Merah</span>
            </button>
        </header>

        <!-- FILTER & DATA SECTION -->
        <section class="card">
            <div class="card-header">
                <div class="header-left">
                    <h3>Daftar Libur & Tanggal Merah</h3>
                    <span class="badge">4 Hari Terdaftar</span>
                </div>
                
                <!-- FILTER BERDASARKAN CABANG -->
                <div class="filter-group">
                    <i class="fa-solid fa-filter filter-icon"></i>
                    <select id="filterCabang" class="select-filter">
                        <option value="all">-- Semua Cabang Sekolah --</option>
                        @foreach($cabang as $value)
                            <option value="{{$value->nama_cabang}}">{{$value->nama_cabang}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tanggal Merah / Libur</th>
                            <th>Tanggal</th>
                            <th>Cabang Sekolah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="holidayTableBody">
                       @foreach ($tanggal_merah as $value)
                            <p style="display: none;">{{$nomor ++}}</p>
                            <tr data-cabang="Cabang Utama (Pusat)">
                                <input type="hidden" value="{{$value->id}}" id="id">
                                <td>{{$nomor}}</td>
                                <td class="holiday-name"><strong>{{$value->keterangan}}</strong></td>
                                <td class="holiday-date"><i class="fa-regular fa-calendar"></i>{{Carbon\Carbon::parse($value->tanggal)->translatedFormat('d M Y')}}</td>
                                @foreach ($cabang as $value_cb)
                                    @if ($value_cb->id == $value->cabang_id)                                 
                                        <td class="holiday-cabang"><span class="branch-tag">{{$value_cb->nama_cabang}}</span></td>
                                    @endif
                                @endforeach
                                <td>
                                    <button class="btn-action edit btn-edit-trigger" 
                                            data-id="1"
                                            data-nama="Hari Raya Idul Fitri 1447 H" 
                                            data-tanggal="2026-03-20" 
                                            data-cabang="Cabang Utama (Pusat)"
                                            title="Edit Libur">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn-action delete" title="Hapus Libur" onclick="tombolHapus('{{$value->id}}')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<!-- ================= MODAL POPUP (TAMBAH) ================= -->
<div class="modal-overlay" id="holidayModal">
    <div class="modal-card">
        <div class="modal-header">
            <div class="modal-title">
                <i class="fa-solid fa-calendar-plus" id="modalIcon"></i>
                <h3 id="modalTitle">Tambah Tanggal Merah</h3>
            </div>
            <button class="btn-close" id="btnCloseModal">&times;</button>
        </div>

        <form action="/gr/tbgm" method="POST" id="formHoliday">
            @csrf
            <div class="modal-body">
                <!-- INPUT NAMA TANGGAL MERAH -->
                <input type="hidden" id="id_tanggal_merah">
                <div class="input-group">
                    <label for="nama_libur">Nama Tanggal Merah / Libur <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-file-pen"></i>
                        <input type="text" id="nama_libur" name="nama_libur" placeholder="Contoh: Hari Raya Idul Fitri" required>
                    </div>
                </div>

                <!-- INPUT TANGGAL -->
                <div class="input-group">
                    <label for="tanggal">Pilih Tanggal <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-calendar-day"></i>
                        <input type="date" id="tanggal" name="tanggal" required>
                    </div>
                </div>

                <!-- SELECT CABANG SEKOLAH -->
                <div class="input-group">
                    <label for="cabang_id">Pilih Cabang Sekolah <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-school"></i>
                        <select id="cabang_id" name="cabang_id" required>
                            <option value="" disabled selected>-- Pilih Cabang --</option>
                            <option value="all">Semua Cabang</option>
                            @foreach($cabang as $value)
                                <option value="{{$value->id}}">{{$value->nama_cabang}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" id="btnCancelModal">Batal</button>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span id="btnSubmitText">Simpan Data</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL POPUP (EDIT) ================= -->
<div class="modal-overlay" id="holidayModalEdit">
    <div class="modal-card">
        <div class="modal-header">
            <div class="modal-title">
                <i class="fa-solid fa-calendar-plus" id="modalIcon"></i>
                <h3 id="modalTitle">Tambah Tanggal Merah</h3>
            </div>
            <button class="btn-close close-edit" id="btnCloseModalEdit">&times;</button>
        </div>

        <form method="POST" id="formHoliday">
            @csrf
            <div class="modal-body">
                <!-- INPUT NAMA TANGGAL MERAH -->
                <input type="hidden" id="id_tanggal_merah">
                <div class="input-group">
                    <label for="nama_libur">Nama Tanggal Merah / Libur <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-file-pen"></i>
                        <input type="text" id="nama_libur_edit" name="nama_libur" placeholder="Contoh: Hari Raya Idul Fitri" required>
                    </div>
                </div>

                <!-- INPUT TANGGAL -->
                <div class="input-group">
                    <label for="tanggal">Pilih Tanggal <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-calendar-day"></i>
                        <input type="date" id="tanggal_edit" name="tanggal" required>
                    </div>
                </div>

                <!-- SELECT CABANG SEKOLAH -->
                <div class="input-group">
                    <label for="cabang_id">Pilih Cabang Sekolah <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-school"></i>
                        <select id="cabang_id_edit" name="cabang_id" required>
                            <option value="" disabled selected>-- Pilih Cabang --</option>
                            <option value="all">Semua Cabang</option>
                            @foreach($cabang as $value)
                                <option value="{{$value->id}}">{{$value->nama_cabang}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" id="btnCancelModalEdit">Batal</button>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span id="btnSubmitText">Simpan Data</span>
                </button>
            </div>
        </form>
    </div>
</div>
<x-warning />
<!-- JAVASCRIPT MODAL & FILTER LOGIC -->
<script>
    function tombolHapus(id){
        window.location.href = "/gr/hpgm/" + id;
    }
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('holidayModal');
        const modal_edit = document.getElementById('holidayModalEdit');
        const btnOpenAdd = document.getElementById('btnOpenAddModal');
        const btnClose = document.getElementById('btnCloseModal');
        const btnCancel = document.getElementById('btnCancelModal');
        const btnCloseEdit = document.getElementById('btnCloseModalEdit');
        const btnCancelEdit = document.getElementById('btnCancelModalEdit');
        const modalTitle = document.getElementById('modalTitle');
        const modalIcon = document.getElementById('modalIcon');
        const btnSubmitText = document.getElementById('btnSubmitText');
        const formHoliday = document.getElementById('formHoliday');

        const formEdit = document.querySelector("#holidayModalEdit form");

        // Form Fields
        const inputNama = document.getElementById('nama_libur_edit');
        const inputTanggal = document.getElementById('tanggal_edit');
        const inputCabang = document.getElementById('cabang_id_edit');

        // Open Modal (Tambah)
        btnOpenAdd.addEventListener('click', () => {
            modalTitle.innerText = "Tambah Tanggal Merah";
            modalIcon.className = "fa-solid fa-calendar-plus";
            btnSubmitText.innerText = "Simpan Data";
            formHoliday.reset();
            modal.classList.add('active');
        });

        // Open Modal (Edit)
        document.querySelectorAll('.btn-edit-trigger').forEach(button => {
            button.addEventListener("click",e => {
                const nama_hari = e.target.closest("tr").querySelector(".holiday-name strong");
                const tanggal = e.target.closest("tr").querySelector(".holiday-date");
                const id_tanggal_merah = e.target.closest("tr").querySelector("#id");
                const pilihan_cabang = document.querySelectorAll("#cabang_id_edit option");
                const date = new Date(tanggal.textContent);

                const tahun = date.getFullYear();
                const bulan = String(date.getMonth() + 1).padStart(2, "0");
                const hari = String(date.getDate()).padStart(2, "0");
                inputNama.value = nama_hari.textContent;
                inputTanggal.value = `${tahun}-${bulan}-${hari}`;
                pilihan_cabang.forEach(item => {
                    if (item.textContent == "Semua Cabang") item.style.display = "none";
                });

                formEdit.setAttribute('action',`/gr/edgm/${id_tanggal_merah.value}`)

                modal_edit.classList.add('active');
            });
        });

        // Close Modal
        const closeModal = () => modal.classList.remove('active');
        const closeModalEdit = () => modal_edit.classList.remove('active');
        btnClose.addEventListener('click', closeModal);
        btnCancel.addEventListener('click', closeModal);
        btnCloseEdit.addEventListener('click', closeModalEdit);
        btnCancelEdit.addEventListener('click', closeModalEdit);

        // Filter Cabang
        const list_cabang = document.getElementById("filterCabang");
        const list_cabang_data = document.querySelectorAll("#holidayTableBody tr");


        list_cabang.addEventListener('change',(e) => {
            list_cabang_data.forEach(item => {
                const span = item.querySelector(".branch-tag");
                if (e.target.value == "all"){
                    item.style.display = "";
                }else{
                    span.textContent == e.target.value ? item.style.display = "" : item.style.display = "none";
                }
            });
        });
    });
</script>

</body>
</html>