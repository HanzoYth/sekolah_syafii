<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ruang Kelas - SIAKAD</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/tambahKelas.css') }}">
</head>
<body>
    <div class="dashboard-container admin-class-page">
        <x-sidebar_siakad />

        <main class="main-content">
            <x-siakad.topbar
                title="Kelola Kelas"
                description="Buat ruang kelas baru untuk kebutuhan tahun ajaran berjalan."
                position="Administrator SIAKAD"
                initials="AD"
            />

            <div class="class-content">
                <section class="class-heading" aria-labelledby="page-title">
                    <div>
                        <span class="section-eyebrow"><i class="fa-solid fa-school"></i> Manajemen Akademik</span>
                        <h1 id="page-title">Tambah Ruang Kelas</h1>
                        <p>Atur jenjang, tingkat, dan paralel untuk membentuk identitas kelas baru.</p>
                    </div>
                    <a href="javascript:history.back()" class="back-link"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </section>

                                <div class="class-layout">
                    <section class="class-form-card" aria-labelledby="form-title">
                        <div class="form-card-heading">
                            <span class="heading-icon"><i class="fa-solid fa-door-open"></i></span>
                            <div>
                                <h2 id="form-title">Informasi Ruang Kelas</h2>
                                <p>Isikan seluruh pilihan agar data kelas dapat disimpan dengan benar.</p>
                            </div>
                        </div>

                        <form action="/sk/simpan-kelas" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="form-field">
                                    <label for="tingkat_sekolah"><i class="fa-solid fa-building-columns"></i> Jenjang Sekolah</label>
                                    <div class="input-wrap">
                                        <i class="fa-solid fa-layer-group"></i>
                                        <select name="tingkat_sekolah" id="tingkat_sekolah" required>
                                            <option value="" disabled selected>Pilih jenjang sekolah</option>
                                            <option value="TK">TK ?" Taman Kanak-Kanak</option>
                                            <option value="SD">SD ?" Sekolah Dasar</option>
                                            <option value="SMP">SMP ?" Sekolah Menengah Pertama</option>
                                            <option value="SMA">SMA ?" Sekolah Menengah Atas</option>
                                        </select>
                                    </div>
                                    <small>Pilih tingkat pendidikan yang menaungi kelas ini.</small>
                                </div>

                                <div class="form-grid">
                                    <div class="form-field">
                                        <label for="no_kelas"><i class="fa-solid fa-arrow-down-1-9"></i> Tingkat Kelas</label>
                                        <div class="input-wrap">
                                            <i class="fa-solid fa-hashtag"></i>
                                            <select name="no_kelas" id="no_kelas" required>
                                                <option value="" disabled selected>Pilih tingkat</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}">Kelas {{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <small>Pilih nomor tingkat kelas.</small>
                                    </div>

                                    <div class="form-field">
                                        <label for="tipe_kelas"><i class="fa-solid fa-font"></i> Paralel / Jurusan</label>
                                        <div class="input-wrap">
                                            <i class="fa-solid fa-shapes"></i>
                                            <select name="tipe_kelas" id="tipe_kelas" required>
                                                <option value="" disabled selected>Pilih paralel atau jurusan</option>
                                                <option value="A">Kelas A</option>
                                                <option value="B">Kelas B</option>
                                                <option value="C">Kelas C</option>
                                                <option value="IPA 1">IPA 1</option>
                                                <option value="IPA 2">IPA 2</option>
                                                <option value="IPS 1">IPS 1</option>
                                                <option value="IPS 2">IPS 2</option>
                                                <option value="REGULER">Reguler</option>
                                                <option value="UNGGULAN">Unggulan</option>
                                            </select>
                                        </div>
                                        <small>Pilih nama rombel atau jurusan.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <a href="javascript:history.back()" class="button button-secondary">Batal</a>
                                <button type="submit" class="button button-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan Kelas</button>
                            </div>
                        </form>
                    </section>

                    <section class="class-form-card">
                        <div class="form-card-heading">
                            <span class="heading-icon" style="background:#e0e7ff; color:#4f46e5;"><i class="fa-solid fa-list-check"></i></span>
                            <div>
                                <h2>Daftar Ruang Kelas</h2>
                                <p>Daftar seluruh ruang kelas yang telah ditambahkan ke sistem.</p>
                            </div>
                        </div>
                        <div style="padding: 25px;">
                            <div class="class-table-container">
                                <table class="class-table">
                                    <thead>
                                        <tr>

                                            <th style="width: 80px; text-align: center;">No</th>
                                            <th>Nama Kelas</th>
                                        
                                            <th style="width: 80px; text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($data_kelas as $k)
                                        <tr>
                                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                                            <td style="font-weight: 500;">{{ $k->nama_kelas }}</td>
                                            <td style="text-align: center;">
                                                <a href="/sk/edit-kelas/{{ $k->id }}" class="btn-action edit" style="color: #105a41; border: 1px solid #dbe8e1; background: #e7f4ec; padding: 6px 10px; border-radius: 6px; text-decoration: none; margin-right: 5px;" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="/sk/hapus-kelas/{{ $k->id }}" class="btn-action view" style="color: #dc2626; border: 1px solid #fecaca; background: #fef2f2; padding: 6px 10px; border-radius: 6px; text-decoration: none;" onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini? Tindakan ini akan menghapus kelas secara permanen.')" title="Hapus">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            $13" style="text-align: center; color: #6b7b75; padding: 30px;">Belum ada ruang kelas yang dibuat.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <x-warning />

    <script>
        const jenjang = document.getElementById('tingkat_sekolah');
        const tingkat = document.getElementById('no_kelas');
        const paralel = document.getElementById('tipe_kelas');
        const previewName = document.querySelector('[data-class-preview]');

        function selectedText(select) {
            return select.value ? select.options[select.selectedIndex].text : 'Belum dipilih';
        }

        function updatePreview() {
            document.getElementById('previewJenjang').textContent = selectedText(jenjang);
            document.getElementById('previewTingkat').textContent = selectedText(tingkat);
            document.getElementById('previewParalel').textContent = selectedText(paralel);

            const namaTingkat = tingkat.value ? `Kelas ${tingkat.value}` : '';
            const namaParalel = paralel.value || '';
            previewName.textContent = [jenjang.value, namaTingkat, namaParalel].filter(Boolean).join(' ') || 'Kelas baru';
        }

        [jenjang, tingkat, paralel].forEach((select) => select.addEventListener('change', updatePreview));
    </script>
</body>
</html>
