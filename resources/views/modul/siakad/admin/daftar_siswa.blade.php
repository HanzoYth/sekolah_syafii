@php
    $totalSiswa = count($data_siswa);
    $siswaAktif = collect($data_siswa)->filter(fn ($siswa) => !isset($siswa->aktif) || (int) $siswa->aktif === 1)->count();
    $jumlahKelas = collect($data_siswa)->pluck('kelas_id')->filter()->unique()->count();
@endphp
<x-siakad-layout title="Data Siswa" description="Kelola dan pantau data siswa yang terdaftar pada SIAKAD." position="Administrator SIAKAD" initials="AD">

    <!-- Header Section -->
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px;">
        <div style="flex: 1;">
            <div style="font-size: 14px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                <i class="fa-solid fa-users"></i> Manajemen Akademik
            </div>
            <div style="font-size: 18px; font-weight: bold; color: #1e293b;">
                <i class="fa-solid fa-user-graduate"></i> Daftar Siswa
            </div>
            <div style="color: #64748b; font-size: 14px; margin-top: 4px;">
                Temukan informasi siswa berdasarkan nama, NIS, jenis kelamin, atau kelas.
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 8px; background: #f8fafc; padding: 10px 16px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 14px; font-weight: 600; color: #334155;">
            <i class="fa-solid fa-user-graduate" style="color: #177455;"></i>
            <span>{{ $totalSiswa }} siswa terdaftar</span>
        </div>
    </div>

    <!-- Metrics Section -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 24px;">
        <div style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div>
                <div style="font-size: 13px; color: #64748b; font-weight: 600;">Total Siswa</div>
                <div style="font-size: 20px; font-weight: bold; color: #1e293b;">{{ $totalSiswa }}</div>
                <div style="font-size: 12px; color: #94a3b8;">Data siswa terdaftar</div>
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <div style="font-size: 13px; color: #64748b; font-weight: 600;">Siswa Aktif</div>
                <div style="font-size: 20px; font-weight: bold; color: #1e293b;">{{ $siswaAktif }}</div>
                <div style="font-size: 12px; color: #94a3b8;">Siap mengikuti kegiatan</div>
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #f3e8ff; color: #9333ea; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                <i class="fa-solid fa-school"></i>
            </div>
            <div>
                <div style="font-size: 13px; color: #64748b; font-weight: 600;">Kelas Terisi</div>
                <div style="font-size: 20px; font-weight: bold; color: #1e293b;">{{ $jumlahKelas }}</div>
                <div style="font-size: 12px; color: #94a3b8;">Kelas dengan data siswa</div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div style="background: white; border-radius: 12px; padding: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        
        <!-- Controls -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
            <div style="font-size: 16px; font-weight: bold; color: #1e293b;">
                Data Siswa Terdaftar
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <div style="position: relative;">
                    <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <input type="text" id="studentSearch" placeholder="Cari nama, NIS, atau kelas..." style="padding: 8px 12px 8px 36px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; width: 250px;">
                </div>
                <div style="position: relative;">
                    <i class="fa-solid fa-filter" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <select id="genderFilter" style="padding: 8px 12px 8px 32px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: white; cursor: pointer; appearance: none;">
                        <option value="">Semua Gender</option>
                        <option value="l">Laki-laki</option>
                        <option value="p">Perempuan</option>
                    </select>
                </div>
                <span id="resultCounter" style="font-size: 13px; font-weight: 600; color: #64748b; background: #f1f5f9; padding: 6px 12px; border-radius: 20px;">{{ $totalSiswa }} data</span>
            </div>
        </div>

        <x-siakad.ui.table>
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">No.</th>
                    <th>Siswa</th>
                    <th style="width: 150px;">Jenis Kelamin</th>
                    <th style="width: 150px;">Kelas</th>
                    <th style="width: 120px; text-align: center;">Status</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="studentRows">
                @forelse ($data_siswa as $index => $siswa)
                    @php
                        $kelas = App\Models\ruang_kelas::find($siswa->kelas_id);
                        $isPerempuan = ($siswa->gender ?? '') === 'p';
                        $isAktif = !isset($siswa->aktif) || (int) $siswa->aktif === 1;
                        $kelasNama = $kelas->nama_ruang ?? '-';
                    @endphp
                    <tr data-student-row data-gender="{{ $siswa->gender ?? '' }}" data-search="{{ strtolower($siswa->nis . ' ' . $siswa->nama . ' ' . $kelasNama) }}">
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                @if ($siswa->url_foto)
                                    <img src="{{ route('file.show', $siswa->url_foto) }}" alt="Foto {{ $siswa->nama }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0;">
                                @else
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: #f1f5f9; color: #94a3b8; display: flex; align-items: center; justify-content: center; font-size: 16px; border: 2px solid #e2e8f0;">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                @endif
                                <div>
                                    <div style="font-weight: 600; color: #1e293b; font-size: 14px;">{{ $siswa->nama }}</div>
                                    <div style="font-size: 12px; color: #64748b;">NIS: {{ $siswa->nis }}</div>
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
                            <span style="display: inline-block; padding: 4px 10px; background: #f1f5f9; color: #475569; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                {{ $kelasNama }}
                            </span>
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
                            <a href="/sk/dls/{{ $siswa->id }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #f1f5f9; color: #475569; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                                <i class="fa-solid fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px 20px; color: #64748b;">
                            <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; color: #cbd5e1;"></i>
                            <p style="margin: 0; font-size: 14px;">Belum ada data siswa yang dapat ditampilkan.</p>
                        </td>
                    </tr>
                @endforelse
                <tr id="filterEmpty" style="display: none;">
                    <td colspan="6" style="text-align: center; padding: 40px 20px; color: #64748b;">
                        <i class="fa-solid fa-magnifying-glass" style="font-size: 32px; margin-bottom: 12px; color: #cbd5e1;"></i>
                        <p style="margin: 0; font-size: 14px;">Data siswa tidak ditemukan.</p>
                    </td>
                </tr>
            </tbody>
        </x-siakad.ui.table>
    </div>

    <script>
        const searchInput = document.getElementById('studentSearch');
        const genderFilter = document.getElementById('genderFilter');
        const studentRows = [...document.querySelectorAll('[data-student-row]')];
        const resultCounter = document.getElementById('resultCounter');
        const filterEmpty = document.getElementById('filterEmpty');

        function filterStudents() {
            const keyword = searchInput.value.trim().toLowerCase();
            const gender = genderFilter.value;
            let visible = 0;

            studentRows.forEach((row) => {
                const matchesKeyword = row.dataset.search.includes(keyword);
                const matchesGender = !gender || row.dataset.gender === gender;
                const show = matchesKeyword && matchesGender;
                
                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            resultCounter.textContent = `${visible} data`;
            if (visible === 0 && studentRows.length > 0) {
                filterEmpty.style.display = '';
            } else {
                filterEmpty.style.display = 'none';
            }
        }

        searchInput?.addEventListener('input', filterStudents);
        genderFilter?.addEventListener('change', filterStudents);
    </script>
</x-siakad-layout>
