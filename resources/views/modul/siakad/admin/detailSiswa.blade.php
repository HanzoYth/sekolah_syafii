@php
    $isPerempuan = ($data_siswa->gender ?? '') === 'p';
    $isAktif = !isset($data_siswa->aktif) || (int) $data_siswa->aktif === 1;
    $namaKelas = $data_kelas->nama_ruang ?? 'Belum ditempatkan';
    $tanggalLahir = !empty($data_siswa->tanggal_lahir)
        ? \Carbon\Carbon::parse($data_siswa->tanggal_lahir)->locale('id')->translatedFormat('d F Y')
        : 'Belum tersedia';
@endphp
<x-siakad-layout title="Detail Siswa" description="Tinjau informasi profil dan akademik siswa." position="Administrator SIAKAD" initials="AD">
    
    <!-- Header Section -->
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px; flex-wrap: wrap; gap: 14px;">
        <div style="flex: 1; min-width: 250px;">
            <div style="font-size: 14px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                <i class="fa-solid fa-user-graduate"></i> Manajemen Akademik
            </div>
            <div style="font-size: 18px; font-weight: bold; color: #1e293b;">
                <i class="fa-solid fa-address-card"></i> Profil Siswa
            </div>
            <div style="color: #64748b; font-size: 14px; margin-top: 4px;">
                Informasi terdaftar untuk siswa pada sistem akademik.
            </div>
        </div>
        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <button type="button" onclick="bukaModalEditSiswa({{ json_encode($data_siswa) }})" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; background: #0d5c3a; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#083d26'" onmouseout="this.style.background='#0d5c3a'">
                <i class="fa-solid fa-pen-to-square"></i> Edit Data Siswa
            </button>
            <a href="/sk/ds" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; background: #f1f5f9; color: #475569; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke daftar
            </a>
        </div>
    </div>

    <!-- Profile Hero -->
    <div style="background: white; border-radius: 16px; padding: 30px; display: flex; align-items: center; gap: 30px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); margin-bottom: 24px; flex-wrap: wrap;">
        
        <div style="width: 120px; height: 120px; border-radius: 20px; overflow: hidden; background: #f1f5f9; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 48px; color: #94a3b8;">
            @if (!empty($data_siswa->url_foto))
                <img src="{{ route('file.show', $data_siswa->url_foto) }}" alt="Foto {{ $data_siswa->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <i class="fa-solid fa-user"></i>
            @endif
        </div>
        
        <div style="flex: 1; min-width: 250px;">
            <div style="font-size: 12px; font-weight: 700; color: #177455; letter-spacing: 1px; margin-bottom: 8px;">SISWA TERDAFTAR</div>
            <h2 style="margin: 0 0 8px; font-size: 24px; color: #1e293b;">{{ $data_siswa->nama }}</h2>
            <div style="color: #64748b; font-size: 15px; margin-bottom: 16px;">
                <i class="fa-solid fa-id-card"></i> NIS: {{ $data_siswa->nis }}
            </div>
            
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #f1f5f9; color: #475569; border-radius: 8px; font-size: 13px; font-weight: 600;">
                    <i class="fa-solid fa-school"></i> {{ $namaKelas }}
                </span>
                @if($isAktif)
                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #dcfce7; color: #166534; border-radius: 8px; font-size: 13px; font-weight: 600;">
                        <i class="fa-solid fa-circle-check"></i> Siswa aktif
                    </span>
                @else
                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #f3f4f6; color: #4b5563; border-radius: 8px; font-size: 13px; font-weight: 600;">
                        <i class="fa-solid fa-circle-pause"></i> Siswa nonaktif
                    </span>
                @endif
            </div>
        </div>
        
        <div style="background: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center; min-width: 150px;">
            <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 8px;">Jenis kelamin</div>
            <div style="font-size: 16px; font-weight: bold; color: #1e293b;">
                @if($isPerempuan)
                    <i class="fa-solid fa-venus" style="color: #be185d; margin-right: 4px;"></i> Perempuan
                @else
                    <i class="fa-solid fa-mars" style="color: #3875c5; margin-right: 4px;"></i> Laki-laki
                @endif
            </div>
        </div>
    </div>

    <!-- Detail Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- Personal Info -->
        <div class="lg:col-span-2" style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 16px; color: #1e293b;">Informasi Pribadi</h3>
                    <p style="margin: 0; font-size: 13px; color: #64748b;">Data identitas dasar siswa.</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">NIS</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">{{ $data_siswa->nis }}</div>
                </div>
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Jenis kelamin</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">{{ $isPerempuan ? 'Perempuan' : 'Laki-laki' }}</div>
                </div>
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Tempat lahir</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">{{ $data_siswa->tempat_lahir ?: 'Belum tersedia' }}</div>
                </div>
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Tanggal lahir</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">{{ $tanggalLahir }}</div>
                </div>
                <div class="sm:col-span-2">
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Alamat</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500; line-height: 1.5;">{{ $data_siswa->alamat ?: 'Belum tersedia' }}</div>
                </div>
            </div>
        </div>

        <!-- Academic Status -->
        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: #f3e8ff; color: #9333ea; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-school"></i>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 16px; color: #1e293b;">Status Akademik</h3>
                    <p style="margin: 0; font-size: 13px; color: #64748b;">Penempatan siswa saat ini.</p>
                </div>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">Kelas</div>
                    <div style="font-size: 14px; color: #1e293b; font-weight: bold;">{{ $namaKelas }}</div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">Status siswa</div>
                    <div>
                        @if($isAktif)
                            <span style="font-size: 14px; font-weight: bold; color: #166534;"><i class="fa-solid fa-circle" style="font-size: 10px; margin-right: 4px;"></i> Aktif</span>
                        @else
                            <span style="font-size: 14px; font-weight: bold; color: #4b5563;"><i class="fa-solid fa-circle" style="font-size: 10px; margin-right: 4px;"></i> Nonaktif</span>
                        @endif
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">ID data siswa</div>
                    <div style="font-size: 14px; color: #1e293b; font-weight: bold;">#{{ $data_siswa->id }}</div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Edit Siswa -->
    <x-siakad.ui.modal id="modalEditSiswa" title="Edit Data Siswa" icon="fa-user-pen" iconColor="#3875c5" iconBg="#e9f2ff">
        <form id="formEditSiswa" action="/sk/update-siswa/{{ $data_siswa->id }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 14px;">
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13px;">Nama Lengkap Siswa <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="nama" id="editSiswaNama" required style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13.5px; font-family: inherit; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13px;">Nomor Induk Siswa (NIS) <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="nis" id="editSiswaNis" required style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13.5px; font-family: inherit; box-sizing: border-box;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 14px;">
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13px;">Jenjang / Unit Sekolah <span style="color:#ef4444;">*</span></label>
                    <select name="sekolah_id" id="editSiswaSekolah" required style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13.5px; font-family: inherit; box-sizing: border-box;">
                        <option value="">-- Pilih Jenjang --</option>
                        @foreach($data_sekolah as $s)
                            <option value="{{ $s->id }}">{{ strtoupper($s->jenis) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13px;">Rombongan Belajar / Kelas</label>
                    <select name="kelas_id" id="editSiswaKelas" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13.5px; font-family: inherit; box-sizing: border-box;">
                        <option value="">-- Belum Memiliki Kelas --</option>
                        @foreach($semua_kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_ruang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 14px;">
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13px;">Jenis Kelamin <span style="color:#ef4444;">*</span></label>
                    <select name="gender" id="editSiswaGender" required style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13.5px; font-family: inherit; box-sizing: border-box;">
                        <option value="l">Laki-laki</option>
                        <option value="p">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13px;">Status Siswa</label>
                    <select name="aktif" id="editSiswaAktif" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13.5px; font-family: inherit; box-sizing: border-box;">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 14px;">
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13px;">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="editSiswaTempatLahir" placeholder="Kota / Tempat Lahir" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13.5px; font-family: inherit; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13px;">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="editSiswaTanggalLahir" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13.5px; font-family: inherit; box-sizing: border-box;">
                </div>
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13px;">Alamat Domisili Siswa</label>
                <textarea name="alamat" id="editSiswaAlamat" rows="2" placeholder="Alamat lengkap tempat tinggal siswa..." style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13.5px; font-family: inherit; box-sizing: border-box;"></textarea>
            </div>

            <div style="margin-bottom: 22px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13px;">Perbarui Foto Profil (Opsional)</label>
                <input type="file" name="url_foto" id="editSiswaFoto" accept="image/jpeg,image/png,image/jpg" style="width: 100%; padding: 7px 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 12.5px; font-family: inherit; background: #f8fafc; box-sizing: border-box;">
                <span style="font-size: 11.5px; color: #94a3b8; display: block; margin-top: 4px;">Format: JPG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</span>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #f1f5f9; padding-top: 16px;">
                <button type="button" onclick="closeModal('modalEditSiswa')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 18px; border: none; background: #0d5c3a; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        function bukaModalEditSiswa(s) {
            document.getElementById('formEditSiswa').action = '/sk/update-siswa/' + s.id;
            document.getElementById('editSiswaNama').value = s.nama || '';
            document.getElementById('editSiswaNis').value = s.nis || '';
            document.getElementById('editSiswaSekolah').value = s.sekolah_id || '';
            document.getElementById('editSiswaKelas').value = s.kelas_id || '';
            document.getElementById('editSiswaGender').value = s.gender || 'l';
            document.getElementById('editSiswaAktif').value = (s.aktif !== undefined && s.aktif !== null) ? s.aktif : '1';
            document.getElementById('editSiswaTempatLahir').value = s.tempat_lahir || '';
            document.getElementById('editSiswaTanggalLahir').value = s.tanggal_lahir || '';
            document.getElementById('editSiswaAlamat').value = s.alamat || '';
            openModal('modalEditSiswa');
        }
    </script>
</x-siakad-layout>
