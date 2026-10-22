@php
    $totalSiswa = count($data_siswa);
    $siswaAktif = collect($data_siswa)->filter(fn ($siswa) => !isset($siswa->aktif) || (int) $siswa->aktif === 1)->count();
    $tanpaKelas = $jumlahTanpaKelas ?? collect($data_siswa)->filter(fn ($siswa) => empty($siswa->kelas_id))->count();
    $jumlahKelas = collect($data_siswa)->pluck('kelas_id')->filter()->unique()->count();
@endphp
<x-siakad-layout title="Data Siswa" description="Kelola dan pantau data siswa yang terdaftar pada SIAKAD." position="Administrator SIAKAD" initials="AD">

    <!-- Header Section -->
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px; flex-wrap: wrap; gap: 14px;">
        <div style="flex: 1; min-width: 250px;">
            <div style="font-size: 14px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                <i class="fa-solid fa-users"></i> Manajemen Akademik
            </div>
            <div style="font-size: 18px; font-weight: bold; color: #1e293b; display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                <span><i class="fa-solid fa-user-graduate"></i> Daftar Siswa</span>
                <form action="" method="GET" style="display: flex; align-items: center;">
                    <div style="position: relative; display: flex; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 12px; gap: 8px;">
                        <i class="fa-solid fa-filter" style="color: #64748b; font-size: 14px;"></i>
                        <select name="sekolah_id" onchange="this.form.submit()" style="background: transparent; border: none; outline: none; font-size: 14px; color: #334155; font-weight: 600; cursor: pointer; padding-right: 8px;">
                            <option value="">Semua Jenjang</option>
                            @foreach($data_sekolah as $s)
                                <option value="{{ $s->id }}" {{ ($sekolah_id ?? '') == $s->id ? 'selected' : '' }}>{{ strtoupper($s->jenis) }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div style="color: #64748b; font-size: 14px; margin-top: 4px;">
                Temukan informasi siswa berdasarkan nama, NIS, jenis kelamin, atau status penempatan kelas.
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <a href="/sk/frss" style="display: inline-flex; align-items: center; gap: 8px; background: #166534; color: white; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; box-shadow: 0 2px 4px rgba(22, 101, 52, 0.2); transition: all 0.2s;" onmouseover="this.style.background='#14532d'" onmouseout="this.style.background='#166534'">
                <i class="fa-solid fa-user-plus"></i> Tambah Siswa Baru
            </a>
            <div style="display: flex; align-items: center; gap: 8px; background: #f8fafc; padding: 10px 16px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 14px; font-weight: 600; color: #334155;">
                <i class="fa-solid fa-user-graduate" style="color: #177455;"></i>
                <span>{{ $totalSiswa }} siswa terdaftar</span>
            </div>
        </div>
    </div>

    <!-- Metrics Section -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 16px; margin-bottom: 24px;">
        <div style="background: white; border-radius: 12px; padding: 18px 20px; display: flex; align-items: center; gap: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #64748b; font-weight: 600;">Total Siswa</div>
                <div style="font-size: 20px; font-weight: bold; color: #1e293b;">{{ $totalSiswa }}</div>
                <div style="font-size: 11px; color: #94a3b8;">Data siswa terdaftar</div>
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 18px 20px; display: flex; align-items: center; gap: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #64748b; font-weight: 600;">Siswa Aktif</div>
                <div style="font-size: 20px; font-weight: bold; color: #1e293b;">{{ $siswaAktif }}</div>
                <div style="font-size: 11px; color: #94a3b8;">Status aktif belajar</div>
            </div>
        </div>

        <div style="background: {{ $tanpaKelas > 0 ? '#fffbeb' : 'white' }}; border-radius: 12px; padding: 18px 20px; display: flex; align-items: center; gap: 14px; border: 1px solid {{ $tanpaKelas > 0 ? '#fde68a' : '#e2e8f0' }}; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: {{ $tanpaKelas > 0 ? '#fef3c7' : '#f1f5f9' }}; color: {{ $tanpaKelas > 0 ? '#d97706' : '#64748b' }}; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div style="flex: 1;">
                <div style="font-size: 12px; color: {{ $tanpaKelas > 0 ? '#92400e' : '#64748b' }}; font-weight: 700;">Belum Ada Kelas</div>
                <div style="font-size: 20px; font-weight: bold; color: {{ $tanpaKelas > 0 ? '#b45309' : '#1e293b' }};">{{ $tanpaKelas }}</div>
                <div style="font-size: 11px; color: {{ $tanpaKelas > 0 ? '#d97706' : '#94a3b8' }};">
                    @if($tanpaKelas > 0)
                        <a href="/sk/pembagian-kelas" style="color: #b45309; font-weight: 700; text-decoration: underline;">Bagi Kelas Sekarang &rarr;</a>
                    @else
                        Semua punya rombel
                    @endif
                </div>
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 18px 20px; display: flex; align-items: center; gap: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #f3e8ff; color: #9333ea; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                <i class="fa-solid fa-school"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #64748b; font-weight: 600;">Kelas Terisi</div>
                <div style="font-size: 20px; font-weight: bold; color: #1e293b;">{{ $jumlahKelas }}</div>
                <div style="font-size: 11px; color: #94a3b8;">Rombel aktif berpenghuni</div>
            </div>
        </div>
    </div>

    @if($tanpaKelas > 0)
        <!-- Alert Banner Siswa Belum Ada Kelas -->
        <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 12px; padding: 14px 20px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; gap: 14px; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <div style="font-size: 14px; font-weight: 700; color: #92400e;">
                        Perhatian: Terdapat {{ $tanpaKelas }} Siswa Belum Masuk Ruang Kelas
                    </div>
                    <div style="font-size: 12px; color: #b45309; margin-top: 2px;">
                        Peserta didik yang mendaftar mandiri perlu dimasukkan ke dalam rombel kelas agar terjadwal dalam kegiatan belajar mengajar.
                    </div>
                </div>
            </div>
            <a href="/sk/pembagian-kelas{{ $sekolah_id ? '?sekolah_id='.$sekolah_id : '' }}" style="display: inline-flex; align-items: center; gap: 8px; background: #d97706; color: white; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; box-shadow: 0 2px 4px rgba(217, 119, 6, 0.2); transition: all 0.2s;" onmouseover="this.style.background='#b45309'" onmouseout="this.style.background='#d97706'">
                <i class="fa-solid fa-users-gear"></i> Tempatkan ke Kelas Sekarang
            </a>
        </div>
    @endif

    <!-- Table Section -->
    <div style="background: white; border-radius: 12px; padding: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        
        <!-- Controls -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
            <div style="font-size: 16px; font-weight: bold; color: #1e293b;">
                Data Siswa Terdaftar
            </div>
            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <div style="position: relative; min-width: 180px;">
                    <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <input type="text" id="studentSearch" placeholder="Cari nama, NIS, atau kelas..." style="padding: 8px 12px 8px 36px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; width: 100%; box-sizing: border-box;">
                </div>
                <div style="position: relative;">
                    <i class="fa-solid fa-filter" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <select id="genderFilter" style="padding: 8px 12px 8px 32px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: white; cursor: pointer; appearance: none;">
                        <option value="">Semua Gender</option>
                        <option value="l">Laki-laki</option>
                        <option value="p">Perempuan</option>
                    </select>
                </div>
                <div style="position: relative;">
                    <i class="fa-solid fa-chalkboard-user" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 13px;"></i>
                    <select id="rombelFilter" style="padding: 8px 12px 8px 32px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: white; cursor: pointer; appearance: none;">
                        <option value="">Semua Status Rombel</option>
                        <option value="tanpa_kelas" {{ ($status_rombel ?? '') == 'tanpa_kelas' ? 'selected' : '' }}>⚠️ Belum Ada Kelas ({{ $tanpaKelas }})</option>
                        <option value="ada_kelas" {{ ($status_rombel ?? '') == 'ada_kelas' ? 'selected' : '' }}>Sudah Masuk Kelas</option>
                    </select>
                </div>
                <span id="resultCounter" style="font-size: 13px; font-weight: 600; color: #64748b; background: #f1f5f9; padding: 6px 12px; border-radius: 20px;">{{ $totalSiswa }} data</span>
            </div>
        </div>

        <x-siakad.ui.table>
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">No.</th>
                    <th style="min-width: 220px;">Siswa</th>
                    <th style="width: 150px;">Jenis Kelamin</th>
                    <th style="width: 150px;">Kelas</th>
                    <th style="width: 120px; text-align: center;">Status</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="studentRows">
                @if(count($data_siswa) > 0)
                    @foreach ($data_siswa as $index => $siswa)
                        @php
                            $kelas = $siswa->kelas;
                            $hasKelas = !empty($siswa->kelas_id) && $kelas;
                            $isPerempuan = ($siswa->gender ?? '') === 'p';
                            $isAktif = !isset($siswa->aktif) || (int) $siswa->aktif === 1;
                            $kelasNama = $kelas->nama_ruang ?? 'Belum Ada Kelas';
                        @endphp
                        <tr data-student-row data-gender="{{ $siswa->gender ?? '' }}" data-has-kelas="{{ $hasKelas ? '1' : '0' }}" data-search="{{ strtolower($siswa->nis . ' ' . $siswa->nama . ' ' . ($hasKelas ? $kelasNama : 'belum ada kelas tanpa rombel')) }}">
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px; min-width: 0;">
                                    @if ($siswa->url_foto)
                                        <img src="{{ route('file.show', $siswa->url_foto) }}" alt="Foto {{ $siswa->nama }}" style="width: 40px; height: 40px; min-width: 40px; min-height: 40px; aspect-ratio: 1 / 1; border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0; flex-shrink: 0; display: block;">
                                    @else
                                        <div style="width: 40px; height: 40px; min-width: 40px; min-height: 40px; aspect-ratio: 1 / 1; border-radius: 50%; background: #f1f5f9; color: #94a3b8; display: flex; align-items: center; justify-content: center; font-size: 16px; border: 2px solid #e2e8f0; flex-shrink: 0;">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    @endif
                                    <div style="min-width: 0; flex: 1;">
                                        <div style="font-weight: 600; color: #1e293b; font-size: 14px; word-break: break-word; line-height: 1.35;">{{ $siswa->nama }}</div>
                                        <div style="font-size: 12px; color: #64748b; margin-top: 2px;">NIS: {{ $siswa->nis ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($isPerempuan)
                                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; background: #fce7f3; color: #be185d; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        <i class="fa-solid fa-venus"></i> Perempuan
                                    </span>
                                @else
                                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; background: #e9f2ff; color: #3875c5; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        <i class="fa-solid fa-mars"></i> Laki-laki
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($hasKelas)
                                    <span style="display: inline-block; padding: 4px 10px; background: #f1f5f9; color: #475569; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                        {{ $kelasNama }}
                                    </span>
                                @else
                                    <span style="display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; background: #fef3c7; color: #b45309; border: 1px solid #fde68a; border-radius: 6px; font-size: 12px; font-weight: 700;">
                                        <i class="fa-solid fa-triangle-exclamation" style="color: #d97706; font-size: 11px;"></i> Belum Ada Kelas
                                    </span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                @if($isAktif)
                                    <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; background: #dcfce7; color: #166534; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        <i class="fa-solid fa-circle-check"></i> Aktif
                                    </span>
                                @else
                                    <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; background: #f3f4f6; color: #4b5563; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        <i class="fa-solid fa-circle-pause"></i> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 6px; justify-content: center; align-items: center;">
                                    <a href="/sk/dls/{{ $siswa->id }}" style="display: inline-flex; align-items: center; gap: 5px; padding: 6px 11px; background: #f1f5f9; color: #475569; border-radius: 8px; text-decoration: none; font-size: 12.5px; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </a>
                                    <button type="button" onclick="bukaModalEditSiswa({{ json_encode($siswa) }})" style="display: inline-flex; align-items: center; gap: 5px; padding: 6px 11px; background: #e9f2ff; color: #3875c5; border: none; border-radius: 8px; font-size: 12.5px; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#d0e3ff'" onmouseout="this.style.background='#e9f2ff'" title="Edit Data Siswa">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px 20px; color: #64748b;">
                            <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; color: #cbd5e1;"></i>
                            <p style="margin: 0; font-size: 14px;">Belum ada data siswa yang dapat ditampilkan.</p>
                        </td>
                    </tr>
                @endif
                <tr id="filterEmpty" style="display: none;">
                    <td colspan="6" style="text-align: center; padding: 40px 20px; color: #64748b;">
                        <i class="fa-solid fa-magnifying-glass" style="font-size: 32px; margin-bottom: 12px; color: #cbd5e1;"></i>
                        <p style="margin: 0; font-size: 14px;">Data siswa tidak ditemukan.</p>
                    </td>
                </tr>
            </tbody>
        </x-siakad.ui.table>
    </div>

    <!-- Modal Edit Siswa -->
    <x-siakad.ui.modal id="modalEditSiswa" title="Edit Data Siswa" icon="fa-user-pen" iconColor="#3875c5" iconBg="#e9f2ff">
        <form id="formEditSiswa" action="" method="POST" enctype="multipart/form-data">
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
                        @foreach($data_kelas as $k)
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

        const searchInput = document.getElementById('studentSearch');
        const genderFilter = document.getElementById('genderFilter');
        const rombelFilter = document.getElementById('rombelFilter');
        const studentRows = [...document.querySelectorAll('[data-student-row]')];
        const resultCounter = document.getElementById('resultCounter');
        const filterEmpty = document.getElementById('filterEmpty');

        function filterStudents() {
            const keyword = searchInput ? searchInput.value.trim().toLowerCase() : '';
            const gender = genderFilter ? genderFilter.value : '';
            const rombel = rombelFilter ? rombelFilter.value : '';
            let visible = 0;

            studentRows.forEach((row) => {
                const matchesKeyword = row.dataset.search.includes(keyword);
                const matchesGender = !gender || row.dataset.gender === gender;
                const hasKelas = row.dataset.hasKelas;
                const matchesRombel = !rombel || (rombel === 'tanpa_kelas' && hasKelas === '0') || (rombel === 'ada_kelas' && hasKelas === '1');
                const show = matchesKeyword && matchesGender && matchesRombel;
                
                row.setAttribute('data-filtered-out', show ? 'false' : 'true');
                if (show) visible++;
            });

            if (resultCounter) resultCounter.textContent = `${visible} data`;
            if (visible === 0 && studentRows.length > 0) {
                if (filterEmpty) filterEmpty.style.display = '';
            } else {
                if (filterEmpty) filterEmpty.style.display = 'none';
            }
            if (window.refreshSiakadPagination) window.refreshSiakadPagination();
        }

        searchInput?.addEventListener('input', filterStudents);
        genderFilter?.addEventListener('change', filterStudents);
        rombelFilter?.addEventListener('change', filterStudents);

        // Initial filter check if value preselected
        if (rombelFilter && rombelFilter.value) {
            filterStudents();
        }
    </script>
</x-siakad-layout>
