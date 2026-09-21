<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Guru - Dashboard Tahfiz</title>
    <!-- Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/profile.css')}}?v={{ time() }}">
</head>
<body>
    <div class="app-layout">
        
        <x-sidebar_guru />

        <main class="main-content">
            <div class="edit-container">
                <!-- HEADER DASHBOARD -->
                <div class="edit-header">
                    <div class="header-title">
                        <h2><i class="fa-solid fa-user-pen header-icon"></i> Edit Profil Anda</h2>
                        <p>Perbarui informasi biodata serta kredensial akun akses guru secara berkala.</p>
                    </div>
                </div>

                <!-- FORM CARD -->
                <div class="edit-card">
                    <form action="/gr/upprgr" method="POST" enctype="multipart/form-data" id="profileForm">
                        @csrf
                        <input type="hidden" value="{{$data_guru->id}}" name="id_guru" id="id_guru">  
                        
                        <!-- SECTION 1: FOTO PROFIL -->
                        <div class="form-section">
                            <div class="section-title">
                                <span class="icon-box"><i class="fa-solid fa-camera"></i></span>
                                <div>
                                    <h3>Foto Profil</h3>
                                    <small>Format pendukung: JPG, JPEG, PNG (Maks. 2MB)</small>
                                </div>
                            </div>
                            <div class="photo-upload-wrapper">
                                <div class="photo-preview-container">
                                    <img src="{{route('file.show', $data_guru->url_foto)}}" alt="Foto Profil Guru" class="photo-preview" id="previewFoto">
                                    <label for="foto" class="photo-overlay-btn" title="Ubah Foto">
                                        <i class="fa-solid fa-pen"></i>
                                    </label>
                                </div>
                                <div class="photo-input-group">
                                    <label for="foto" class="custom-file-label">
                                        <i class="fa-solid fa-cloud-arrow-up"></i> Pilih Foto Baru
                                    </label>
                                    <input type="file" id="foto" name="foto" class="file-input-hidden" accept="image/*" onchange="previewImage(event)">
                                    <span class="file-name-indicator" id="fileName">Belum ada file baru dipilih</span>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 2: BIODATA PRIBADI -->
                        <div class="form-section">
                            <div class="section-title">
                                <span class="icon-box"><i class="fa-solid fa-address-card"></i></span>
                                <div>
                                    <h3>Biodata Pribadi</h3>
                                    <small>Informasi pribadi dan identitas pengajar</small>
                                </div>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap & Gelar</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-user input-icon"></i>
                                        <input type="text" id="nama" name="nama" class="form-control" value="{{$data_guru->nama}}" required placeholder="Nama lengkap beserta gelar">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nig">NIG (Nomor Induk Guru)</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-id-badge input-icon"></i>
                                        <input type="text" id="nig" name="nig" class="form-control" value="{{$data_guru->nig}}" required placeholder="Nomor Induk Guru">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="wa">Nomor WhatsApp Aktif</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-brands fa-whatsapp input-icon"></i>
                                        <input type="text" id="wa" name="wa" class="form-control" value="{{$nomor_wa}}" required placeholder="08xxxxxxxxxx">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-location-dot input-icon"></i>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" value="{{$data_guru->tempat_lahir}}" required placeholder="Kota kelahiran">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-calendar-day input-icon"></i>
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{$data_guru->tanggal_lahir}}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-mosque input-icon"></i>
                                        <input type="text" id="agama" name="agama" class="form-control" value="{{$data_guru->agama}}" required placeholder="Agama">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-graduation-cap input-icon"></i>
                                        <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="form-control" required>
                                            <option value="" disabled>-- Pilih Pendidikan --</option>
                                            <option value="smp" {{$data_guru->pendidikan_terakhir == 'smp' ? 'selected' : ""}}>SMP / Sederajat</option>
                                            <option value="sma" {{$data_guru->pendidikan_terakhir == 'sma' ? 'selected' : ""}}>SMA / MA / Sederajat</option>
                                            <option value="s1" {{$data_guru->pendidikan_terakhir == 's1' ? 'selected' : ""}}>S1 (Sarjana)</option>
                                            <option value="s2" {{$data_guru->pendidikan_terakhir == 's2' ? 'selected' : ""}}>S2 (Magister)</option>
                                            <option value="s3" {{$data_guru->pendidikan_terakhir == 's3' ? 'selected' : ""}}>S3 (Doktor)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group span-2">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-house input-icon textarea-icon"></i>
                                        <textarea id="alamat" name="alamat" class="form-control" rows="3" required placeholder="Alamat domisili lengkap">{{$data_guru->alamat}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION: DOKUMEN PENDUKUNG (KTP, KK, IJAZAH) -->
                        <div class="form-section">
                            <div class="section-title">
                                <span class="icon-box"><i class="fa-solid fa-file-contract"></i></span>
                                <div>
                                    <h3>Dokumen Pendukung</h3>
                                    <small>Upload berkas identitas dan kualifikasi (PDF, JPG, JPEG, PNG - Maks. 2MB)</small>
                                </div>
                            </div>

                            <div class="form-grid">

                                <!-- ===== KTP ===== -->
                                <div class="form-group">
                                    <label for="ktp">Kartu Tanda Penduduk (KTP)</label>
                                    <div class="doc-card" data-doc="ktp">
                                        <!-- Berkas yang sudah tersimpan -->
                                        <div class="doc-saved">
                                            <span class="doc-thumb"><i class="fa-solid fa-file-pdf" id="docIcon-ktp"></i></span>
                                            <div class="doc-meta">
                                                <span class="doc-name" id="docName-ktp">-</span>
                                                <span class="doc-status" id="docStatus-ktp"></span>
                                            </div>
                                            <button type="button" class="btn-view-doc" id="viewBtn-ktp" onclick="openDocViewer('ktp', 'saved')">
                                                <i class="fa-solid fa-eye"></i> Lihat
                                            </button>
                                        </div>

                                        <!-- Ganti dengan berkas baru -->
                                        <div class="doc-upload">
                                            <label for="ktp" class="custom-file-label">
                                                <i class="fa-solid fa-id-card"></i> Pilih File KTP
                                            </label>
                                            <input type="file" id="ktp" class="file-input-hidden" accept="image/*,.pdf" value="{{route('pdf.show',$data_guru->ktp)}}" onchange="previewDocument(event, 'ktp')">
                                            <span class="file-name-indicator" id="fileName-ktp">Belum ada file baru dipilih</span>
                                            <button type="button" class="btn-preview-new" id="previewBtn-ktp" onclick="openDocViewer('ktp', 'new')" hidden>
                                                <i class="fa-solid fa-magnifying-glass"></i> Pratinjau file baru
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===== KK ===== -->
                                <div class="form-group">
                                    <label for="kk">Kartu Keluarga (KK)</label>
                                    <div class="doc-card" data-doc="kk">
                                        <div class="doc-saved">
                                            <span class="doc-thumb"><i class="fa-solid fa-file-pdf" id="docIcon-kk"></i></span>
                                            <div class="doc-meta">
                                                <span class="doc-name" id="docName-kk">-</span>
                                                <span class="doc-status" id="docStatus-kk"></span>
                                            </div>
                                            <button type="button" class="btn-view-doc" id="viewBtn-kk" onclick="openDocViewer('kk', 'saved')">
                                                <i class="fa-solid fa-eye"></i> Lihat
                                            </button>
                                        </div>

                                        <div class="doc-upload">
                                            <label for="kk" class="custom-file-label">
                                                <i class="fa-solid fa-users"></i> Pilih File KK
                                            </label>
                                            <input type="file" id="kk" class="file-input-hidden" accept="image/*,.pdf" value="{{route('pdf.show',$data_guru->kk)}}" onchange="previewDocument(event, 'kk')">
                                            <span class="file-name-indicator" id="fileName-kk">Belum ada file baru dipilih</span>
                                            <button type="button" class="btn-preview-new" id="previewBtn-kk" onclick="openDocViewer('kk', 'new')" hidden>
                                                <i class="fa-solid fa-magnifying-glass"></i> Pratinjau file baru
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===== IJAZAH ===== -->
                                <div class="form-group span-2">
                                    <label for="ijazah">Ijazah Terakhir</label>
                                    <div class="doc-card" data-doc="ijazah">
                                        <div class="doc-saved">
                                            <span class="doc-thumb"><i class="fa-solid fa-file-pdf" id="docIcon-ijazah"></i></span>
                                            <div class="doc-meta">
                                                <span class="doc-name" id="docName-ijazah">-</span>
                                                <span class="doc-status" id="docStatus-ijazah"></span>
                                            </div>
                                            <button type="button" class="btn-view-doc" id="viewBtn-ijazah" onclick="openDocViewer('ijazah', 'saved')">
                                                <i class="fa-solid fa-eye"></i> Lihat
                                            </button>
                                        </div>

                                        <div class="doc-upload">
                                            <label for="ijazah" class="custom-file-label">
                                                <i class="fa-solid fa-scroll"></i> Pilih File Ijazah
                                            </label>
                                            <input type="file" id="ijazah" class="file-input-hidden" accept="image/*,.pdf" value="{{route('pdf.show',$data_guru->ijazah)}}" onchange="previewDocument(event, 'ijazah')">
                                            <span class="file-name-indicator" id="fileName-ijazah">Belum ada file baru dipilih</span>
                                            <button type="button" class="btn-preview-new" id="previewBtn-ijazah" onclick="openDocViewer('ijazah', 'new')" hidden>
                                                <i class="fa-solid fa-magnifying-glass"></i> Pratinjau file baru
                                            </button>
                                        </div>
                                    </div>
<!-- 
                                    <input type="hidden">
                                    <input type="hidden">
                                    <input type="text"> -->
                                </div>

                            </div>
                        </div>

                        <!-- SECTION 3: STATUS & PERAN GURU -->
                        <div class="form-section">
                            <div class="section-title">
                                <span class="icon-box"><i class="fa-solid fa-user-shield"></i></span>
                                <div>
                                    <h3>Status & Peran Guru</h3>
                                    <small>Penugasan akademik (Read-only)</small>
                                </div>
                            </div>

                            <div class="checkbox-grid">
                                <label class="checkbox-card {{$data_guru->guru_tetap ? 'active' : ''}}">
                                    <input type="checkbox" name="guru_tetap" value="0" disabled {{$data_guru->guru_tetap ? 'checked' : ""}}>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-user-check"></i>
                                        <span>Guru Tetap</span>
                                    </div>
                                </label>

                                <label class="checkbox-card {{$data_guru->guru_honor ? 'active' : ''}}">
                                    <input type="checkbox" name="guru_honor" value="0" disabled {{$data_guru->guru_honor ? 'checked' : ""}}>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-user-clock"></i>
                                        <span>Guru Honor</span>
                                    </div>
                                </label>

                                <label class="checkbox-card {{$data_guru->pengampu_tahfiz ? 'active' : ''}}">
                                    <input type="checkbox" name="pengampu_tahfiz" value="0" disabled {{$data_guru->pengampu_tahfiz ? 'checked' : ""}}>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-book-quran"></i>
                                        <span>Pengampu Tahfiz</span>
                                    </div>
                                </label>

                                <label class="checkbox-card {{$data_guru->koordinator_tahfiz ? 'active' : ''}}">
                                    <input type="checkbox" name="koordinator_tahfiz" value="0" disabled {{$data_guru->koordinator_tahfiz ? 'checked' : ""}}>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-crown"></i>
                                        <span>Koordinator Tahfiz</span>
                                    </div>
                                </label>

                                <label class="checkbox-card {{$data_guru->wakil_sekolah ? 'active' : ''}}">
                                    <input type="checkbox" name="wakil_sekolah" value="0" disabled {{$data_guru->wakil_sekolah ? 'checked' : ""}}>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-award"></i>
                                        <span>Wakil Kepala Sekolah</span>
                                    </div>
                                </label>

                                <label class="checkbox-card {{$data_guru->kepala_sekolah ? 'active' : ''}}">
                                    <input type="checkbox" name="kepala_sekolah" value="0" disabled {{$data_guru->kepala_sekolah ? 'checked' : ""}}>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-award"></i>
                                        <span>Kepala Sekolah</span>
                                    </div>
                                </label>

                                <label class="checkbox-card {{$data_guru->ast_krk ? 'active' : ''}}">
                                    <input type="checkbox" name="kepala_sekolah" value="0" disabled {{$data_guru->ast_krk ? 'checked' : ""}}>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-award"></i>
                                        <span>Asisten Kurikulum</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- SECTION 4: CABANG & SEKOLAH -->
                        <div class="form-section">
                            <div class="section-title">
                                <span class="icon-box"><i class="fa-solid fa-building-columns"></i></span>
                                <div>
                                    <h3>Penempatan Unit</h3>
                                    <small>Cabang dan unit sekolah terdaftar (Read-only)</small>
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="cabang_id">Cabang Unit</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-sitemap input-icon"></i>
                                        <select id="cabang_id" name="cabang_id" class="form-control" disabled>
                                            <option value="">-- Pilih Cabang --</option>
                                            @foreach ($data_cabang as $cb)
                                                <option value="{{$cb->id}}" {{$cb->id == $data_guru->cabang_id ? 'selected' : ''}}>{{$cb->nama_cabang}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="sekolah_id">Unit Sekolah</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-school input-icon"></i>
                                        <select id="sekolah_id" name="sekolah_id" class="form-control" disabled>
                                            <option value="">-- Pilih Sekolah --</option>
                                            @foreach ($data_jenis_sekolah as $djs)
                                                <option value="{{$djs->id}}" {{$djs->id == $data_guru->sekolah_id ? 'selected' : ''}}>{{$djs->jenis}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 5: DATA AKUN -->
                        <div class="form-section">
                            <div class="section-title">
                                <span class="icon-box"><i class="fa-solid fa-shield-halved"></i></span>
                                <div>
                                    <h3>Kredensial Akun</h3>
                                    <small>Pengaturan nama pengguna dan kata sandi login</small>
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-at input-icon"></i>
                                        <input type="text" id="username" name="username" class="form-control" value="{{$data_akun->username}}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Alamat Email</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-envelope input-icon"></i>
                                        <input type="email" id="email" name="email" class="form-control" value="{{$data_akun->email}}" required>
                                    </div>
                                </div>

                                <div class="form-group span-2">
                                    <label for="password">Password Baru <span class="label-hint">(Kosongkan jika tidak ingin mengubah password)</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-lock input-icon"></i>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••••••">
                                        <button type="button" class="btn-toggle-password" onclick="togglePasswordVisibility()">
                                            <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SUBMIT -->
                        <div class="form-actions">
                            <button type="submit" class="btn-submit" id="submitBtn">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </main>
    </div>

    <!-- ============================================================
         MODAL PENAMPIL DOKUMEN (KTP / KK / IJAZAH)
         Murni HTML + CSS + JS, belum terhubung ke PHP.
         ============================================================ -->
    <div class="doc-viewer" id="docViewer" hidden>
        <div class="doc-viewer__backdrop" data-close></div>

        <div class="doc-viewer__dialog" role="dialog" aria-modal="true" aria-labelledby="docViewerTitle">
            <header class="doc-viewer__header">
                <div class="doc-viewer__heading">
                    <span class="doc-viewer__icon"><i class="fa-solid fa-file-lines" id="docViewerIcon"></i></span>
                    <div>
                        <h3 id="docViewerTitle">Dokumen</h3>
                        <small id="docViewerSubtitle">-</small>
                    </div>
                </div>
                <button type="button" class="doc-viewer__close" data-close aria-label="Tutup pratinjau">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </header>

            <div class="doc-viewer__body" id="docViewerBody"></div>

            <footer class="doc-viewer__footer">
                <span class="doc-viewer__badge" id="docViewerBadge">Berkas tersimpan</span>
                <div class="doc-viewer__actions">
                    <a href="#" target="_blank" rel="noopener" class="btn-viewer btn-viewer--ghost" id="docViewerOpen" hidden>
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka di tab baru
                    </a>
                    <button type="button" class="btn-viewer" data-close>Tutup</button>
                </div>
            </footer>
        </div>
    </div>

    <x-warning />

    <script>

        console.log(document.getElementById("ijazah").value);
        function previewImage(event) {
            const input = event.target;
            const fileNameText = document.getElementById('fileName');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewFoto').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
                fileNameText.textContent = input.files[0].name;
            }
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        document.querySelectorAll(".checkbox-card").forEach(item => {
            const input = item.querySelector("input");
            input.value = input.hasAttribute("checked") ? 1 : 0;
            input.addEventListener('change', (e) => {
                e.target.value = e.target.checked ? 1 : 0;
            });
        });

        document.getElementById('profileForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.classList.add('loading');
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Menyimpan...</span>';
        });

        /* =====================================================
           DOKUMEN PENDUKUNG: LIHAT BERKAS (KTP, KK, IJAZAH)
           -----------------------------------------------------
           Bagian ini sengaja belum tersambung ke PHP.
           Data di bawah adalah contoh statis.

           NANTI saat mau disambungkan:
           - isi "name" dengan nama file dari database
           - isi "url" dengan URL dari route pdf.show
           - kosongkan name dan url jika guru belum upload berkas
           ===================================================== */
        const docConfig = {
            ktp: {
                label: 'Kartu Tanda Penduduk (KTP)',
                saved: { name: 'ktp.pdf', url: '' },
                fresh: null
            },
            kk: {
                label: 'Kartu Keluarga (KK)',
                saved: { name: 'kk-contoh.jpg', url: '' },
                fresh: null
            },
            ijazah: {
                label: 'Ijazah Terakhir',
                saved: { name: 'ijazah-contoh.pdf', url: '' },
                fresh: null
            }
        };

        const docViewer = document.getElementById('docViewer');
        const docViewerBody = document.getElementById('docViewerBody');
        let lastFocusedElement = null;
        let closeTimer = null;

        /* Tentukan jenis file: 'image' atau 'pdf' */
        function detectType(name, mime) {
            if (mime) {
                return mime.indexOf('image/') === 0 ? 'image' : 'pdf';
            }
            return /\.(jpe?g|png|webp|gif)$/i.test(name || '') ? 'image' : 'pdf';
        }

        /* Tampilkan nama & status berkas tersimpan pada tiap kartu */
        function initSavedDocs() {
            Object.keys(docConfig).forEach(function(key) {
                const saved = docConfig[key].saved;
                const nameEl = document.getElementById('docName-' + key);
                const statusEl = document.getElementById('docStatus-' + key);
                const iconEl = document.getElementById('docIcon-' + key);
                const viewBtn = document.getElementById('viewBtn-' + key);

                if (saved.name) {
                    nameEl.textContent = saved.name;
                    statusEl.className = 'doc-status is-saved';
                    statusEl.innerHTML = '<i class="fa-solid fa-circle-check"></i> Sudah diunggah';
                    iconEl.className = detectType(saved.name) === 'image'
                        ? 'fa-solid fa-file-image'
                        : 'fa-solid fa-file-pdf';
                    viewBtn.disabled = false;
                } else {
                    nameEl.textContent = 'Belum ada berkas tersimpan';
                    statusEl.className = 'doc-status is-empty';
                    statusEl.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Belum diunggah';
                    iconEl.className = 'fa-solid fa-file';
                    viewBtn.disabled = true;
                }
            });
        }

        /* Dipanggil saat guru memilih file baru */
        function previewDocument(event, key) {
            const file = event.target.files && event.target.files[0];
            const doc = docConfig[key];
            const nameEl = document.getElementById('fileName-' + key);
            const previewBtn = document.getElementById('previewBtn-' + key);

            /* Bersihkan URL sementara dari pilihan sebelumnya */
            if (doc.fresh && doc.fresh.url) {
                URL.revokeObjectURL(doc.fresh.url);
            }

            if (!file) {
                doc.fresh = null;
                nameEl.textContent = 'Belum ada file baru dipilih';
                previewBtn.hidden = true;
                return;
            }

            doc.fresh = {
                name: file.name,
                url: URL.createObjectURL(file),
                type: detectType(file.name, file.type)
            };
            nameEl.textContent = file.name;
            previewBtn.hidden = false;
        }

        /* Buka modal. source = 'saved' (berkas tersimpan) atau 'new' (file baru dipilih) */
        function openDocViewer(key, source) {
            const doc = docConfig[key];
            const isNew = source === 'new';
            const file = isNew ? doc.fresh : doc.saved;
            if (!file) return;

            const type = file.type || detectType(file.name);

            document.getElementById('docViewerTitle').textContent = doc.label;
            document.getElementById('docViewerSubtitle').textContent = file.name || '-';
            document.getElementById('docViewerIcon').className = type === 'image'
                ? 'fa-solid fa-file-image'
                : 'fa-solid fa-file-pdf';

            const badge = document.getElementById('docViewerBadge');
            badge.textContent = isNew ? 'File baru (belum disimpan)' : 'Berkas tersimpan';
            badge.className = 'doc-viewer__badge' + (isNew ? ' is-new' : '');

            /* Isi area pratinjau */
            docViewerBody.innerHTML = '';
            if (file.url) {
                if (type === 'image') {
                    const img = document.createElement('img');
                    img.src = file.url;
                    img.alt = doc.label;
                    img.className = 'doc-viewer__image';
                    docViewerBody.appendChild(img);
                } else {
                    const frame = document.createElement('iframe');
                    frame.src = file.url;
                    frame.title = doc.label;
                    frame.className = 'doc-viewer__frame';
                    docViewerBody.appendChild(frame);
                }
            } else {
                docViewerBody.innerHTML =
                    '<div class="doc-viewer__empty">' +
                        '<i class="fa-solid fa-file-circle-question"></i>' +
                        '<strong>Pratinjau belum tersedia</strong>' +
                        '<p>Berkas ini belum tersambung ke server. Isi <code>url</code> pada <code>docConfig</code> untuk menampilkan isinya.</p>' +
                    '</div>';
            }

            /* Tombol "Buka di tab baru" hanya muncul jika ada URL */
            const openLink = document.getElementById('docViewerOpen');
            if (file.url) {
                openLink.href = file.url;
                openLink.hidden = false;
            } else {
                openLink.removeAttribute('href');
                openLink.hidden = true;
            }

            /* Tampilkan modal */
            clearTimeout(closeTimer);
            lastFocusedElement = document.activeElement;
            docViewer.hidden = false;
            document.body.classList.add('no-scroll');
            requestAnimationFrame(function() {
                docViewer.classList.add('is-open');
                docViewer.querySelector('.doc-viewer__close').focus();
            });
        }

        function closeDocViewer() {
            if (docViewer.hidden) return;
            docViewer.classList.remove('is-open');
            document.body.classList.remove('no-scroll');
            closeTimer = setTimeout(function() {
                docViewer.hidden = true;
                docViewerBody.innerHTML = '';   /* hentikan iframe / lepas gambar */
            }, 200);
            if (lastFocusedElement && lastFocusedElement.focus) {
                lastFocusedElement.focus();
            }
        }

        /* Tutup lewat backdrop, tombol X, atau tombol "Tutup" */
        docViewer.addEventListener('click', function(e) {
            if (e.target.closest('[data-close]')) {
                closeDocViewer();
            }
        });

        /* Tutup dengan tombol Esc */
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDocViewer();
            }
        });

        initSavedDocs();
    </script>
</body>
</html>