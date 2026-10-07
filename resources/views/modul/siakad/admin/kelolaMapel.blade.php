<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mata Pelajaran - SIAKAD</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- MENGGUNAKAN STYLE DATA SISWA SEBAGAI REFERENSI UTAMA -->
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/data_siswa.css') }}?v={{ time() }}">
    
    <style>
        /* CSS TAMBAHAN UNTUK MODAL & TOMBOL (Mengikuti Skema Warna Data Siswa) */
        .btn-add-mapel {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background: var(--student-primary);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: .88rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(23, 116, 85, .2);
        }
        .btn-add-mapel:hover {
            background: #125e44;
            transform: translateY(-2px);
        }

        .action-btns {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-action-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-action-edit {
            background: #e9f2ff;
            color: #3875c5;
        }
        .btn-action-edit:hover {
            background: #3875c5;
            color: #fff;
        }
        .btn-action-delete {
            background: #f8e9e9;
            color: #b34d4d;
        }
        .btn-action-delete:hover {
            background: #b34d4d;
            color: #fff;
        }

        /* MODAL STYLES (Disesuaikan dengan estetik data siswa) */
        .custom-modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(24, 51, 44, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            padding: 20px;
        }
        .custom-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .custom-modal-card {
            background: var(--student-surface);
            width: 100%;
            max-width: 440px;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            transform: scale(0.95);
            transition: all 0.3s ease;
            border: 1px solid var(--student-border);
            font-family: 'Poppins', sans-serif;
        }
        .custom-modal-overlay.active .custom-modal-card {
            transform: scale(1);
        }
        
        .modal-header-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            font-size: 1.6rem;
            margin-bottom: 20px;
        }
        .icon-add { background: var(--student-primary-soft); color: var(--student-primary); }
        .icon-edit { background: #e9f2ff; color: #3875c5; }
        .icon-delete { background: #f8e9e9; color: #b34d4d; }

        .custom-modal-card h3 {
            margin: 0 0 10px;
            font-size: 1.25rem;
            color: var(--student-ink);
        }
        .custom-modal-card p {
            margin: 0 0 24px;
            color: var(--student-muted);
            font-size: 0.88rem;
            line-height: 1.5;
        }

        .custom-input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #cfddd6;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            color: var(--student-ink);
            outline: none;
            transition: all 0.2s;
            margin-bottom: 24px;
            box-sizing: border-box;
        }
        .custom-input:focus {
            border-color: var(--student-primary);
            box-shadow: 0 0 0 4px rgba(23, 116, 85, .12);
        }

        .modal-actions {
            display: flex;
            gap: 12px;
        }
        .btn-modal {
            flex: 1;
            padding: 12px;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 0.88rem;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }
        .btn-cancel {
            background: #f1f5f3;
            color: var(--student-muted);
        }
        .btn-cancel:hover { background: #e2e8e4; color: var(--student-ink); }
        .btn-confirm-add { background: var(--student-primary); color: #fff; }
        .btn-confirm-add:hover { background: #125e44; }
        .btn-confirm-edit { background: #3875c5; color: #fff; }
        .btn-confirm-edit:hover { background: #275da1; }
        .btn-confirm-delete { background: #b34d4d; color: #fff; }
        .btn-confirm-delete:hover { background: #963d3d; }

        .alert-toast {
            padding: 16px 20px;
            background: var(--student-primary-soft);
            color: var(--student-primary);
            border: 1px solid #cce5d9;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.88rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="dashboard-container admin-students-page">
        <x-sidebar_siakad />

        <main class="main-content">
            <x-siakad.topbar
                title="Mata Pelajaran"
                description="Kelola daftar mata pelajaran yang diajarkan."
                position="Admin SIAKAD"
                initials="AD"
            />

            <div class="students-content">
                <section class="students-heading">
                    <div>
                        <span class="section-eyebrow"><i class="fa-solid fa-book"></i> Manajemen Kurikulum</span>
                        <h1>Daftar Mata Pelajaran</h1>
                        <p>Kelola dan pantau seluruh daftar mata pelajaran yang aktif pada sistem SIAKAD.</p>
                    </div>
                    <div>
                        <button class="btn-add-mapel" onclick="openAddModal()">
                            <i class="fa-solid fa-plus"></i> Tambah Mapel Baru
                        </button>
                    </div>
                </section>

                @if(session('success'))
                    <div class="alert-toast">
                        <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <section class="students-card">
                    <div class="card-header">
                        <div>
                            <h2>Data Mata Pelajaran Terdaftar</h2>
                            <p>Daftar lengkap mata pelajaran beserta opsi untuk memperbarui data.</p>
                        </div>
                        <span class="result-counter">{{ count($data_mapel) }} data</span>
                    </div>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th class="number-column">No.</th>
                                    <th>Nama Mata Pelajaran</th>
                                    <th class="action-column">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data_mapel as $index => $m)
                                    <tr>
                                        <td class="number-column">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="student-cell">
                                                <div class="student-avatar avatar-fallback">
                                                    <i class="fa-solid fa-book-open"></i>
                                                </div>
                                                <div>
                                                    <strong>{{ $m->nama_mapel }}</strong>
                                                    <span>ID Mapel: MAPEL-{{ str_pad($m->id, 3, '0', STR_PAD_LEFT) }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="action-column">
                                            <div class="action-btns" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 8px; white-space: nowrap;">
                                                <button class="btn-action-icon btn-action-edit" onclick="openEditModal({{ $m->id }}, '{{ $m->nama_mapel }}')" title="Edit Data">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-action-icon btn-action-delete" onclick="openDeleteModal({{ $m->id }}, '{{ $m->nama_mapel }}')" title="Hapus Data">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-row">
                                        <td colspan="3">
                                            <i class="fa-solid fa-folder-open" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                                            Belum ada data mata pelajaran yang terdaftar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <!-- MODAL TAMBAH -->
    <div class="custom-modal-overlay" id="addModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon icon-add">
                <i class="fa-solid fa-book-medical"></i>
            </div>
            <h3>Tambah Mata Pelajaran</h3>
            <p>Masukkan nama mata pelajaran baru ke dalam sistem kurikulum.</p>
            <form action="/sk/simpan-mapel" method="POST">
                @csrf
                <input type="text" name="nama_mapel" class="custom-input" placeholder="Contoh: Pendidikan Agama Islam" required autocomplete="off">
                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-add">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="custom-modal-overlay" id="editModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon icon-edit">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <h3>Edit Mata Pelajaran</h3>
            <p>Perbarui informasi nama mata pelajaran ini.</p>
            <form id="editForm" method="POST">
                @csrf
                <input type="text" name="nama_mapel" id="editInput" class="custom-input" required autocomplete="off">
                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-edit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL HAPUS -->
    <div class="custom-modal-overlay" id="deleteModal">
        <div class="custom-modal-card" style="text-align: center;">
            <div class="modal-header-icon icon-delete" style="margin: 0 auto 20px;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3>Konfirmasi Hapus</h3>
            <p>Anda yakin ingin menghapus <strong><span id="deleteMapelName"></span></strong>? Data yang dihapus tidak dapat dipulihkan.</p>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                <button type="button" class="btn-modal btn-confirm-delete" id="btnConfirmDelete">Ya, Hapus Data</button>
            </div>
        </div>
    </div>

    <script>
        const overlayAdd = document.getElementById('addModal');
        const overlayEdit = document.getElementById('editModal');
        const overlayDelete = document.getElementById('deleteModal');
        
        const editForm = document.getElementById('editForm');
        const editInput = document.getElementById('editInput');
        const deleteNameSpan = document.getElementById('deleteMapelName');
        const btnConfirmDelete = document.getElementById('btnConfirmDelete');
        let deleteIdTarget = null;

        function closeAllModals() {
            overlayAdd.classList.remove('active');
            overlayEdit.classList.remove('active');
            overlayDelete.classList.remove('active');
        }

        function openAddModal() {
            closeAllModals();
            overlayAdd.classList.add('active');
        }

        function openEditModal(id, nama) {
            closeAllModals();
            editForm.action = "/sk/update-mapel/" + id;
            editInput.value = nama;
            overlayEdit.classList.add('active');
        }

        function openDeleteModal(id, nama) {
            closeAllModals();
            deleteIdTarget = id;
            deleteNameSpan.textContent = nama;
            overlayDelete.classList.add('active');
        }

        btnConfirmDelete.addEventListener('click', function() {
            if (deleteIdTarget) {
                window.location.href = "/sk/hapus-mapel/" + deleteIdTarget;
            }
        });

        // Close on overlay click
        [overlayAdd, overlayEdit, overlayDelete].forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeAllModals();
            });
        });
    </script>

    <x-warning />
</body>
</html>