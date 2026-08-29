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
    <link rel="stylesheet" href="{{ asset('css/modul/guru/profile.css')}}">
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
                                    <input type="file" id="foto" name="foto" class="file-input-hidden" accept="image/*" onchange="previewImage(event)" >
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

                                <label class="checkbox-card {{$data_guru->kepala_sekolah ? 'active' : ''}}">
                                    <input type="checkbox" name="kepala_sekolah" value="0" disabled {{$data_guru->kepala_sekolah ? 'checked' : ""}}>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-award"></i>
                                        <span>Kepala Sekolah</span>
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

    <x-warning />

    <script>
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
    </script>
</body>
</html>