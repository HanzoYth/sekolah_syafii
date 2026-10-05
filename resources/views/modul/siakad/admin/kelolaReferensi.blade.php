<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Referensi Akademik - SIAKAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/data_siswa.css') }}?v={{ time() }}">
    
    <style>
        .btn-add-ref {
            display: inline-flex; align-items: center; gap: 10px; padding: 10px 20px;
            background: var(--student-primary); color: #fff; border: none; border-radius: 10px;
            font-family: 'Poppins', sans-serif; font-size: .85rem; font-weight: 600; cursor: pointer;
            transition: all 0.2s ease; box-shadow: 0 4px 12px rgba(23, 116, 85, .2);
        }
        .btn-add-ref:hover { background: #125e44; transform: translateY(-2px); }

        .action-btns { display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-action-icon {
            display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px;
            border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s;
        }
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
        .modal-header-icon {
            width: 60px; height: 60px; border-radius: 16px; display: grid; place-items: center;
            font-size: 1.6rem; margin-bottom: 20px;
        }
        .icon-add { background: var(--student-primary-soft); color: var(--student-primary); }
        .icon-edit { background: #e9f2ff; color: #3875c5; }
        .icon-delete { background: #f8e9e9; color: #b34d4d; }
        .custom-modal-card h3 { margin: 0 0 10px; font-size: 1.25rem; color: var(--student-ink); }
        .custom-modal-card p { margin: 0 0 20px; color: var(--student-muted); font-size: 0.88rem; line-height: 1.5; }
        
        .form-group { margin-bottom: 15px; text-align: left; }
        .form-group label { display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 6px; color: var(--student-ink); }
        .custom-input {
            width: 100%; padding: 12px 14px; border: 1px solid #cfddd6; border-radius: 10px;
            font-family: 'Poppins', sans-serif; font-size: 0.9rem; outline: none; box-sizing: border-box;
        }
        .custom-input:focus { border-color: var(--student-primary); box-shadow: 0 0 0 4px rgba(23, 116, 85, .12); }
        
        .modal-actions { display: flex; gap: 12px; margin-top: 24px; }
        .btn-modal { flex: 1; padding: 12px; border-radius: 10px; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 0.88rem; cursor: pointer; border: none; }
        .btn-cancel { background: #f1f5f3; color: var(--student-muted); }
        .btn-cancel:hover { background: #e2e8e4; color: var(--student-ink); }
        .btn-confirm-add { background: var(--student-primary); color: #fff; }
        .btn-confirm-add:hover { background: #125e44; }
        .btn-confirm-edit { background: #3875c5; color: #fff; }
        .btn-confirm-delete { background: #b34d4d; color: #fff; }

        .alert-toast {
            padding: 14px 20px; background: var(--student-primary-soft); color: var(--student-primary);
            border: 1px solid #cce5d9; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-size: 0.88rem; font-weight: 500;
        }

        .checkbox-group { display: flex; align-items: center; gap: 8px; margin-top: 10px; }
        .checkbox-group input { width: 18px; height: 18px; accent-color: var(--student-primary); cursor: pointer; }
        .checkbox-group label { margin: 0; cursor: pointer; font-weight: 500; }
    </style>
</head>
<body>
    <div class="dashboard-container admin-students-page">
        <x-sidebar_siakad />

        <main class="main-content">
            <x-siakad.topbar title="Referensi Akademik" description="Kelola data Tahun Ajaran & Jam Pelajaran." position="Admin SIAKAD" initials="AD" />

            <div class="students-content">
                <section class="students-heading">
                    <div>
                        <span class="section-eyebrow"><i class="fa-solid fa-database"></i> Referensi Data</span>
                        <h1>Data Akademik</h1>
                        <p>Kelola pengaturan Tahun Ajaran dan rentang Jam Pelajaran untuk jadwal.</p>
                    </div>
                </section>

                @if(session('success_tahun'))
                    <div class="alert-toast"><i class="fa-solid fa-circle-check"></i> {{ session('success_tahun') }}</div>
                @endif
                @if(session('success_jam'))
                    <div class="alert-toast"><i class="fa-solid fa-circle-check"></i> {{ session('success_jam') }}</div>
                @endif

                <!-- BAGIAN TAHUN AJARAN -->
                <section class="students-card" style="margin-bottom: 40px;">
                    <div class="card-header">
                        <div>
                            <h2>Tahun Ajaran</h2>
                            <p>Daftar tahun ajaran yang tersedia di sistem.</p>
                        </div>
                        <button class="btn-add-ref" onclick="openModal('addTahunModal')"><i class="fa-solid fa-plus"></i> Tambah Tahun</button>
                    </div>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th class="number-column">No.</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th class="action-column">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data_tahun as $index => $t)
                                    <tr>
                                        <td class="number-column">{{ $index + 1 }}</td>
                                        <td><strong>{{ $t->nama }}</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($t->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($t->tanggal_selesai)->format('d M Y') }}</td>
                                        <td>
                                            @if($t->aktif)
                                                <span class="status-badge active"><i class="fa-solid fa-check"></i> Aktif</span>
                                            @else
                                                <span class="status-badge inactive"><i class="fa-solid fa-xmark"></i> Non-Aktif</span>
                                            @endif
                                        </td>
                                        <td class="action-column">
                                            <div class="action-btns">
                                                <button class="btn-action-icon btn-action-edit" onclick="openEditTahun({{ $t->id }}, '{{ $t->nama }}', '{{ $t->tanggal_mulai }}', '{{ $t->tanggal_selesai }}', {{ $t->aktif ? 'true' : 'false' }})">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-action-icon btn-action-delete" onclick="openDeleteTahun({{ $t->id }}, '{{ $t->nama }}')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-row"><td colspan="5"><i class="fa-solid fa-folder-open"></i> Belum ada data Tahun Ajaran.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- BAGIAN JAM PELAJARAN -->
                <section class="students-card">
                    <div class="card-header">
                        <div>
                            <h2>Jam Pelajaran</h2>
                            <p>Atur blok waktu dan jam pelajaran untuk penjadwalan.</p>
                        </div>
                        <button class="btn-add-ref" onclick="openModal('addJamModal')"><i class="fa-solid fa-plus"></i> Tambah Jam</button>
                    </div>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th class="number-column">No.</th>
                                    <th>Nama Jam</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th class="action-column">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data_jam as $index => $j)
                                    <tr>
                                        <td class="number-column">{{ $index + 1 }}</td>
                                        <td><strong>{{ $j->nama_jam }}</strong></td>
                                        <td><i class="fa-regular fa-clock" style="color:var(--student-muted)"></i> {{ $j->jam_mulai }}</td>
                                        <td><i class="fa-regular fa-clock" style="color:var(--student-muted)"></i> {{ $j->jam_selesai }}</td>
                                        <td class="action-column">
                                            <div class="action-btns">
                                                <button class="btn-action-icon btn-action-edit" onclick="openEditJam({{ $j->id }}, '{{ $j->nama_jam }}', '{{ $j->jam_mulai }}', '{{ $j->jam_selesai }}')">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-action-icon btn-action-delete" onclick="openDeleteJam({{ $j->id }}, '{{ $j->nama_jam }}')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-row"><td colspan="5"><i class="fa-solid fa-folder-open"></i> Belum ada data Jam Pelajaran.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <!-- MODAL TAMBAH TAHUN -->
    <div class="custom-modal-overlay" id="addTahunModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon icon-add"><i class="fa-solid fa-calendar-plus"></i></div>
            <h3>Tambah Tahun Ajaran</h3>
            <form action="/sk/simpan-tahun-ajaran" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Tahun Ajaran (Contoh: 2026/2027 Ganjil)</label>
                    <input type="text" name="nama" class="custom-input" required>
                </div>
                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Mulai</label>
                        <input type="date" name="tanggal_mulai" class="custom-input" required>
                    </div>
                    <div style="flex:1;">
                        <label>Selesai</label>
                        <input type="date" name="tanggal_selesai" class="custom-input" required>
                    </div>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" name="aktif" id="chkAktifAdd" value="1" checked>
                    <label for="chkAktifAdd">Tandai sebagai Tahun Ajaran Aktif</label>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-add">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT TAHUN -->
    <div class="custom-modal-overlay" id="editTahunModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon icon-edit"><i class="fa-solid fa-calendar-check"></i></div>
            <h3>Edit Tahun Ajaran</h3>
            <form id="editTahunForm" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Tahun Ajaran</label>
                    <input type="text" name="nama" id="etNama" class="custom-input" required>
                </div>
                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Mulai</label>
                        <input type="date" name="tanggal_mulai" id="etMulai" class="custom-input" required>
                    </div>
                    <div style="flex:1;">
                        <label>Selesai</label>
                        <input type="date" name="tanggal_selesai" id="etSelesai" class="custom-input" required>
                    </div>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" name="aktif" id="etAktif" value="1">
                    <label for="etAktif">Tandai sebagai Tahun Ajaran Aktif</label>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-edit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL TAMBAH JAM -->
    <div class="custom-modal-overlay" id="addJamModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon icon-add"><i class="fa-solid fa-clock"></i></div>
            <h3>Tambah Jam Pelajaran</h3>
            <form action="/sk/simpan-jam-pelajaran" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Jam (Contoh: Jam Ke-1)</label>
                    <input type="text" name="nama_jam" class="custom-input" required>
                </div>
                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="custom-input" required>
                    </div>
                    <div style="flex:1;">
                        <label>Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="custom-input" required>
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-add">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT JAM -->
    <div class="custom-modal-overlay" id="editJamModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon icon-edit"><i class="fa-solid fa-clock"></i></div>
            <h3>Edit Jam Pelajaran</h3>
            <form id="editJamForm" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Jam</label>
                    <input type="text" name="nama_jam" id="ejNama" class="custom-input" required>
                </div>
                <div class="form-group" style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="ejMulai" class="custom-input" required>
                    </div>
                    <div style="flex:1;">
                        <label>Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="ejSelesai" class="custom-input" required>
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-edit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL HAPUS UMUM -->
    <div class="custom-modal-overlay" id="deleteModal">
        <div class="custom-modal-card" style="text-align: center;">
            <div class="modal-header-icon icon-delete" style="margin: 0 auto 20px;"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h3>Konfirmasi Hapus</h3>
            <p>Anda yakin ingin menghapus <strong><span id="delName"></span></strong>? Data tidak dapat dipulihkan.</p>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                <button type="button" class="btn-modal btn-confirm-delete" id="btnConfirmDelete">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <script>
        const modals = document.querySelectorAll('.custom-modal-overlay');
        let deleteTargetUrl = '';

        function closeAllModals() {
            modals.forEach(m => m.classList.remove('active'));
        }

        function openModal(id) {
            closeAllModals();
            document.getElementById(id).classList.add('active');
        }

        function openEditTahun(id, nama, mulai, selesai, aktif) {
            document.getElementById('editTahunForm').action = "/sk/update-tahun-ajaran/" + id;
            document.getElementById('etNama').value = nama;
            document.getElementById('etMulai').value = mulai;
            document.getElementById('etSelesai').value = selesai;
            document.getElementById('etAktif').checked = aktif;
            openModal('editTahunModal');
        }

        function openEditJam(id, nama, mulai, selesai) {
            document.getElementById('editJamForm').action = "/sk/update-jam-pelajaran/" + id;
            document.getElementById('ejNama').value = nama;
            document.getElementById('ejMulai').value = mulai;
            document.getElementById('ejSelesai').value = selesai;
            openModal('editJamModal');
        }

        function openDeleteTahun(id, nama) {
            deleteTargetUrl = "/sk/hapus-tahun-ajaran/" + id;
            document.getElementById('delName').textContent = "Tahun Ajaran: " + nama;
            openModal('deleteModal');
        }

        function openDeleteJam(id, nama) {
            deleteTargetUrl = "/sk/hapus-jam-pelajaran/" + id;
            document.getElementById('delName').textContent = "Jam Pelajaran: " + nama;
            openModal('deleteModal');
        }

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            if(deleteTargetUrl) window.location.href = deleteTargetUrl;
        });

        modals.forEach(m => {
            m.addEventListener('click', function(e) {
                if(e.target === m) closeAllModals();
            });
        });
    </script>

    <x-warning />
</body>
</html>