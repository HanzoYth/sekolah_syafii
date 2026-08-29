<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Guru - Dashboard Tahfiz</title>
    <!-- Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/edit_guru.css')}}">
</head>
<body>

    <div class="edit-container">
        
        <!-- HEADER & TOMBOL KEMBALI -->
        <div class="edit-header">
            <a href="/gr/klgr" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <div class="header-title">
                <h2>Edit Profil Guru</h2>
                <p>Perbarui jabatan guru.</p>
            </div>
        </div>

        <!-- FORM CARD EDIT DATA GURU -->
        <div class="edit-card">
            <form action="/gr/updgr" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$data_guru->id}}" name="id_guru" id="id_guru">  
                
                <!-- SECTION 1: FOTO PROFIL & FOTO UPLOAD -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-image"></i> Foto Profil
                    </div>
                    <div class="photo-upload-wrapper">
                        <!-- Tampilan Foto yang Ada Saat Ini -->
                        <img src="{{route('file.show', $data_guru->url_foto)}}" alt="Foto Profil Guru" class="photo-preview" id="previewFoto" required>
                    </div>
                </div>

                <!-- SECTION 2: BIODATA PRIBADI GURU -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-user-gear"></i> Biodata Pribadi
                    </div>
                    
                    <div class="form-grid">
                        <!-- Nama Lengkap -->
                        <div class="form-group">
                            <label for="nama">Nama Lengkap & Gelar</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="{{$data_guru->nama}}" readonly>
                        </div>

                        <!-- NIG (Nomor Induk Guru) -->
                        <div class="form-group">
                            <label for="nig">NIG (Nomor Induk Guru)</label>
                            <input type="text" id="nig" name="nig" class="form-control" value="{{$data_guru->nig}}" readonly>
                        </div>
                        <!-- Nomor Wa -->
                        <div class="form-group">
                            <label for="nig">WA (Nomor WA Aktif)</label>
                            <input type="text" id="wa" name="wa" class="form-control" value="{{$nomor_wa}}" readonly>
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" value="{{$data_guru->tempat_lahir}}" readonly>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{$data_guru->tanggal_lahir}}" readonly>
                        </div>

                        <!-- Agama -->
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <input type="text" id="agama" name="agama" class="form-control" value="{{$data_guru->agama}}" readonly>
                        </div>

                        <!-- Pendidikan Terakhir -->
                        <div class="form-group">
                            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                            <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="form-control" disabled>
                                <option value="" disabled selected>-- Pilih Pendidikan --</option>
                                <option value="smp" {{$data_guru->pendidikan_terakhir == 'smp' ? 'selected' : ""}}>SMP / Sederajat</option>
                                <option value="sma" {{$data_guru->pendidikan_terakhir == 'sma' ? 'selected' : ""}}>SMA / MA / Sederajat</option>
                                <option value="s1" {{$data_guru->pendidikan_terakhir == 's1' ? 'selected' : ""}}>S1 (Sarjana)</option>
                                <option value="s2" {{$data_guru->pendidikan_terakhir == 's2' ? 'selected' : ""}}>S2 (Magister)</option>
                                <option value="s3" {{$data_guru->pendidikan_terakhir == 's3' ? 'selected' : ""}}>S3 (Doktor)</option>
                            </select>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="form-group span-2">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" class="form-control" rows="3" readonly>{{$data_guru->alamat}}</textarea>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: JABATAN & PENUGASAN -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-briefcase"></i> Status & Peran Guru
                    </div>

                    <div class="checkbox-grid">
                        <label class="checkbox-card">
                            <input type="checkbox" name="guru_tetap" value="0" {{$data_guru->guru_tetap ? 'checked' : ""}}>
                            <span>Guru Tetap</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="guru_honor" value="0" {{$data_guru->guru_honor ? 'checked' : ""}}>
                            <span>Guru Honor</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="pengampu_tahfiz" value="0" {{$data_guru->pengampu_tahfiz ? 'checked' : ""}}>
                            <span>Pengampu Tahfiz</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="koordinator_tahfiz" value="0" {{$data_guru->koordinator_tahfiz ? 'checked' : ""}}>
                            <span>Koordinator Tahfiz</span>
                        </label>

                        <label class="checkbox-card">
                            <input type="checkbox" name="kepala_sekolah" value="0" {{$data_guru->kepala_sekolah ? 'checked' : ""}}>
                            <span>Kepala Sekolah</span>
                        </label>
                    </div>
                </div>

                <!-- SECTION 4: CABANG & SEKOLAH -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-school"></i> Penempatan Unit
                    </div>

                    <div class="form-grid">
                        <!-- Cabang ID -->
                        <div class="form-group">
                            <label for="cabang_id">Cabang Unit</label>
                            <select id="cabang_id" name="cabang_id" class="form-control" required>
                                <option value="">-- Pilih Cabang --</option>
                                @foreach ($data_cabang as $cb)
                                    <option value="{{$cb->id}}" {{$cb->id == $data_guru->cabang_id ? 'selected' : ''}}>{{$cb->nama_cabang}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sekolah ID -->
                        <div class="form-group">
                            <label for="sekolah_id">Unit Sekolah</label>
                            <select id="sekolah_id" name="sekolah_id" class="form-control" required>
                                <option value="">-- Pilih Sekolah --</option>
                                @foreach ($data_jenis_sekolah as $djs)
                                    <option value="{{$djs->id}}" {{$djs->id == $data_guru->sekolah_id ? 'selected' : ''}}>{{$djs->jenis}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL SIMPAN -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>

    </div>
    <x-warning />

    <!-- Script Sederhana Preview Foto -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('previewFoto');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
        console.log(document.getElementById("id_guru").value)

        //reset
        document.querySelectorAll(".checkbox-card").forEach(item => {
            if(item.querySelector("input").hasAttribute("checked")){
                item.querySelector("input").value = 1;
            }else{
                item.querySelector("input").value = 0
            }
        });

        document.querySelectorAll(".checkbox-card").forEach(item => {
            item.querySelector("input").addEventListener('change',(e) => {
                if (e.target.checked){
                    e.target.value = 1;
                }else{
                    e.target.value = 0
                }
            });
        });
    </script>
</body>
</html>