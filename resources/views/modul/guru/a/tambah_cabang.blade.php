<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Cabang - Sekolah Al-Qur'an Imam Syafi'i</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">  
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Khusus Dashboard Cabang -->
    <link rel="stylesheet" href="{{asset('css/modul/guru/cabang_guru.css')}}">
</head>
<body>

    <div class="dashboard-container">
        
        <!-- Sidebar Guru -->
        <x-sidebar_guru />

        <!-- MAIN CONTENT AREA WITH ISOLATED SCOPE -->
        <main class="main-content cabang-page-wrapper">
            
            <!-- HEADER / TOPBAR DASHBOARD -->
            <header class="topbar">
                <div class="topbar-title">
                    <h2>Kelola Cabang</h2>
                    <p>Manajemen data lokasi dan cabang sekolah</p>
                </div>
                
                <!-- FITUR LOGO TAMBAH (TRIGGER MODAL) -->
                <button class="btn-add-trigger" id="btnOpenModal">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Cabang</span>
                </button>
            </header>

            <!-- ISI KONTEN UTAMA (DAFTAR CABANG) -->
            <section class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h3>Daftar Cabang Aktif</h3>
                        <span class="badge">Total: {{$jumlah}} Cabang</span>
                    </div>
                    
                    <!-- Tabel Data Cabang -->
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Cabang</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="branchTableBody">
                                @foreach($data as $value)
                                    <tr>
                                        <input type="hidden" value="{{$value->id}}" id="id">
                                        <td>{{$no}}</td>
                                        <td>{{$value->nama_cabang}}</td>
                                        <td>{{Carbon\Carbon::parse($value->creted_at)->translatedFormat('d M Y')}}</td>
                                        <td>
                                            <button class="btn-action edit" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button class="btn-action delete" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <p style="display: none;">{{$no++}}</p>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <!-- ========================================== -->
    <!-- MODAL POPUP INPUT TAMBAH CABANG          -->
    <!-- ========================================== -->
    <div class="modal-overlay" id="modalBranch">
        <div class="modal-card">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title">
                    <i class="fa-solid fa-building-circle-check"></i>
                    <h3>Tambah Cabang Baru</h3>
                </div>
                <button class="btn-close" id="btnCloseModal">&times;</button>
            </div>

            <!-- Modal Body / Form Input -->
            <form id="formAddBranch" action="/gr/tcb" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group">
                        <label for="namaCabang">Nama Cabang <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-school"></i>
                            <input type="text" id="namaCabang" name = "nama_cabang" placeholder="Contoh: Cabang Surabaya" required autocomplete="off">
                        </div>
                    </div>
                </div>

                <!-- Modal Footer / Action Button -->
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="btnCancelModal">Batal</button>
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-plus"></i> Tambahkan Cabang
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- JAVASCRIPT INTERAKSI MODAL -->
    <script>
        const btnOpenModal = document.getElementById('btnOpenModal');
        const btnCloseModal = document.getElementById('btnCloseModal');
        const btnCancelModal = document.getElementById('btnCancelModal');
        const modalBranch = document.getElementById('modalBranch');
        const formAddBranch = document.getElementById('formAddBranch');
        const namaCabangInput = document.getElementById('namaCabang');
        const btnDelete = document.querySelectorAll(".delete");
        const inpId = document.querySelectorAll("#id");

        // Buka Modal
        btnOpenModal.addEventListener('click', () => {
            modalBranch.classList.add('active');
            namaCabangInput.focus();
        });

        // Tutup Modal
        const closeModal = () => {
            modalBranch.classList.remove('active');
            formAddBranch.reset();
        };

        btnCloseModal.addEventListener('click', closeModal);
        btnCancelModal.addEventListener('click', closeModal);

        // Tutup modal jika klik di luar modal card
        modalBranch.addEventListener('click', (e) => {
            if (e.target === modalBranch) {
                closeModal();
            }
        });

        btnDelete.forEach((item,idx) => {
            item.addEventListener('click',() => {
                window.location.href = "/gr/hpcb/" + inpId[idx].value
            });
        });



    </script>
</body>
</html>