<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penugasan Wali Kelas - SIAKAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/data_siswa.css') }}?v={{ time() }}">
    
    <style>
        .btn-add {
            display: inline-flex; align-items: center; gap: 10px; padding: 12px 24px;
            background: var(--student-primary); color: #fff; border: none; border-radius: 12px;
            font-family: 'Poppins', sans-serif; font-size: .88rem; font-weight: 600; cursor: pointer;
            transition: all 0.2s ease; box-shadow: 0 4px 12px rgba(23, 116, 85, .2);
        }
        .btn-add:hover { background: #125e44; transform: translateY(-2px); }

        .action-btns { display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-action-icon { display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s; }
        .btn-action-edit { background: #e9f2ff; color: #3875c5; }
        .btn-action-edit:hover { background: #3875c5; color: #fff; }
        .btn-action-delete { background: #f8e9e9; color: #b34d4d; }
        .btn-action-delete:hover { background: #b34d4d; color: #fff; }

        .custom-modal-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(24, 51, 44, 0.6); backdrop-filter: blur(4px);
            display: flex; align-items: center; justify-content: center; z-index: 1000;
            opacity: 0; visibility: hidden; transition: all 0.3s ease; padding: 20px;
        }
        .custom-modal-overlay.active { opacity: 1; visibility: visible; }
        .custom-modal-card {
            background: var(--student-surface); width: 100%; max-width: 440px; border-radius: 20px;
            padding: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); transform: scale(0.95);
            transition: all 0.3s ease; border: 1px solid var(--student-border); font-family: 'Poppins', sans-serif;
        }
        .custom-modal-overlay.active .custom-modal-card { transform: scale(1); }
        
        .modal-header-icon { width: 60px; height: 60px; border-radius: 16px; display: grid; place-items: center; font-size: 1.6rem; margin-bottom: 20px; }
        .icon-add { background: var(--student-primary-soft); color: var(--student-primary); }
        .icon-edit { background: #e9f2ff; color: #3875c5; }
        .icon-delete { background: #f8e9e9; color: #b34d4d; }

        .custom-modal-card h3 { margin: 0 0 10px; font-size: 1.25rem; color: var(--student-ink); }
        .custom-modal-card p { margin: 0 0 24px; color: var(--student-muted); font-size: 0.88rem; line-height: 1.5; }

        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 6px; color: var(--student-ink); }
        .custom-select {
            width: 100%; padding: 12px 14px; border: 1px solid #cfddd6; border-radius: 10px;
            font-family: 'Poppins', sans-serif; font-size: 0.9rem; outline: none; box-sizing: border-box; background: #fff; cursor: pointer;
        }
        .custom-select:focus { border-color: var(--student-primary); box-shadow: 0 0 0 4px rgba(23, 116, 85, .12); }

        .modal-actions { display: flex; gap: 12px; margin-top: 10px; }
        .btn-modal { flex: 1; padding: 12px; border-radius: 10px; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 0.88rem; cursor: pointer; border: none; transition: all 0.2s; }
        .btn-cancel { background: #f1f5f3; color: var(--student-muted); }
        .btn-cancel:hover { background: #e2e8e4; color: var(--student-ink); }
        .btn-confirm-add { background: var(--student-primary); color: #fff; }
        .btn-confirm-add:hover { background: #125e44; }
        .btn-confirm-edit { background: #3875c5; color: #fff; }
        .btn-confirm-edit:hover { background: #275da1; }
        .btn-confirm-delete { background: #b34d4d; color: #fff; }
        .btn-confirm-delete:hover { background: #963d3d; }

        .alert-toast {
            padding: 16px 20px; background: var(--student-primary-soft); color: var(--student-primary);
            border: 1px solid #cce5d9; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-size: 0.88rem; font-weight: 500;
        }
        .alert-error {
            padding: 16px 20px; background: #f8e9e9; color: #b34d4d; border: 1px solid #ecc9c9;
            border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-size: 0.88rem; font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="dashboard-container admin-students-page">
        <x-sidebar_siakad />

        <main class="main-content">
            <x-siakad.topbar title="Penugasan Wali Kelas" description="Kelola penugasan guru sebagai wali kelas." position="Admin SIAKAD" initials="AD" />

            <div class="students-content">
                <section class="students-heading">
                    <div>
                        <span class="section-eyebrow"><i class="fa-solid fa-users-rectangle"></i> Manajemen Kelas</span>
                        <h1>Penugasan Wali Kelas</h1>
                        <p>Tetapkan guru untuk menjadi wali kelas pada setiap rombongan belajar (rombel) yang tersedia.</p>
                    </div>
                    <div>
                        <button class="btn-add" onclick="openAddModal()"><i class="fa-solid fa-plus"></i> Tugaskan Wali Kelas</button>
                    </div>
                </section>

                @if(session('success'))
                    <div class="alert-toast"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}</div>
                @endif

                <section class="students-card">
                    <div class="card-header">
                        <div>
                            <h2>Daftar Wali Kelas Terdaftar</h2>
                            <p>Data penempatan wali kelas saat ini.</p>
                        </div>
                        <span class="result-counter">{{ count($data_wallas) }} Kelas</span>
                    </div>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th class="number-column">No.</th>
                                    <th>Guru (Wali Kelas)</th>
                                    <th>Kelas</th>
                                    <th class="action-column">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data_wallas as $index => $w)
                                    <tr>
                                        <td class="number-column">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="student-cell">
                                                @if(!empty($w->guru->url_foto))<img src="{{ route('file.show', $w->guru->url_foto) }}" alt="Foto {{ $w->guru->nama }}" class="student-avatar" style="object-fit: cover;">@else<div class="student-avatar avatar-fallback"><i class="fa-solid fa-user-tie"></i></div>@endif
                                                <div>
                                                    <strong>{{ $w->guru->nama ?? 'Guru tidak ditemukan' }}</strong>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="class-badge" style="font-size:0.8rem; padding: 6px 12px;"><i class="fa-solid fa-school"></i> {{ $w->ruangKelas->nama_ruang ?? 'Kelas tidak ditemukan' }}</span>
                                        </td>
                                        <td class="action-column">
                                            <div class="action-btns" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 8px; white-space: nowrap;">
                                                <button class="btn-action-icon btn-action-edit" onclick="openEditModal({{ $w->id }}, {{ $w->guru_id }}, {{ $w->kelas_id }})" title="Edit Data">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-action-icon btn-action-delete" onclick="openDeleteModal({{ $w->id }}, '{{ $w->guru->nama ?? '' }}', '{{ $w->ruangKelas->nama_ruang ?? '' }}')" title="Hapus Data">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-row"><td colspan="4"><i class="fa-solid fa-folder-open"></i> Belum ada penugasan wali kelas.</td></tr>
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
            <div class="modal-header-icon icon-add"><i class="fa-solid fa-user-plus"></i></div>
            <h3>Penugasan Baru</h3>
            <p>Pilih guru dan tentukan kelas yang akan dipimpin.</p>
            <form action="/sk/simpan-wali-kelas" method="POST">
                @csrf
                <div class="form-group">
                    <label>Pilih Guru</label>
                    <select name="guru_id" class="custom-select" required>
                        <option value="">-- Silakan Pilih Guru --</option>
                        @foreach($data_guru as $g)
                            <option value="{{ $g->id }}">{{ $g->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tugaskan ke Kelas</label>
                    <select name="kelas_id" class="custom-select" required>
                        <option value="">-- Silakan Pilih Kelas --</option>
                        @foreach($data_kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_ruang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-add">Simpan Penugasan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="custom-modal-overlay" id="editModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon icon-edit"><i class="fa-solid fa-pen-to-square"></i></div>
            <h3>Edit Penugasan</h3>
            <p>Ubah penempatan guru atau kelas yang ditugaskan.</p>
            <form id="editForm" method="POST">
                @csrf
                <div class="form-group">
                    <label>Pilih Guru</label>
                    <select name="guru_id" id="editGuru" class="custom-select" required>
                        @foreach($data_guru as $g)
                            <option value="{{ $g->id }}">{{ $g->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tugaskan ke Kelas</label>
                    <select name="kelas_id" id="editKelas" class="custom-select" required>
                        @foreach($data_kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_ruang }}</option>
                        @endforeach
                    </select>
                </div>
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
            <div class="modal-header-icon icon-delete" style="margin: 0 auto 20px;"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h3>Konfirmasi Hapus</h3>
            <p>Cabut tugas wali kelas untuk <strong><span id="delGuru"></span></strong> di <strong id="delKelas"></strong>?</p>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                <button type="button" class="btn-modal btn-confirm-delete" id="btnConfirmDelete">Ya, Cabut Tugas</button>
            </div>
        </div>
    </div>

    <script>
        const modals = document.querySelectorAll('.custom-modal-overlay');
        let deleteTargetUrl = '';

        function closeAllModals() { modals.forEach(m => m.classList.remove('active')); }
        function openAddModal() { closeAllModals(); document.getElementById('addModal').classList.add('active'); }

        function openEditModal(id, guru_id, kelas_id) {
            closeAllModals();
            document.getElementById('editForm').action = "/sk/update-wali-kelas/" + id;
            document.getElementById('editGuru').value = guru_id;
            document.getElementById('editKelas').value = kelas_id;
            document.getElementById('editModal').classList.add('active');
        }

        function openDeleteModal(id, nama_guru, nama_kelas) {
            closeAllModals();
            deleteTargetUrl = "/sk/hapus-wali-kelas/" + id;
            document.getElementById('delGuru').textContent = nama_guru;
            document.getElementById('delKelas').textContent = nama_kelas;
            document.getElementById('deleteModal').classList.add('active');
        }

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            if(deleteTargetUrl) window.location.href = deleteTargetUrl;
        });

        modals.forEach(m => {
            m.addEventListener('click', function(e) { if(e.target === m) closeAllModals(); });
        });
    </script>

    <x-warning />
</body>
</html>