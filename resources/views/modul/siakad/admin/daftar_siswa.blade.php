<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - SIAKAD</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/data_siswa.css') }}">
</head>
<body>
    @php
        $totalSiswa = count($data_siswa);
        $siswaAktif = collect($data_siswa)->filter(fn ($siswa) => !isset($siswa->aktif) || (int) $siswa->aktif === 1)->count();
        $jumlahKelas = collect($data_siswa)->pluck('kelas_id')->filter()->unique()->count();
    @endphp

    <div class="dashboard-container admin-students-page">
        <x-sidebar_siakad />

        <main class="main-content">
            <x-siakad.topbar
                title="Data Siswa"
                description="Kelola dan pantau data siswa yang terdaftar pada SIAKAD."
                position="Administrator SIAKAD"
                initials="AD"
            />

            <div class="students-content">
                <section class="students-heading" aria-labelledby="students-page-title">
                    <div>
                        <span class="section-eyebrow"><i class="fa-solid fa-users"></i> Manajemen Akademik</span>
                        <h1 id="students-page-title">Daftar Siswa</h1>
                        <p>Temukan informasi siswa berdasarkan nama, NIS, jenis kelamin, atau kelas.</p>
                    </div>
                    <div class="heading-total">
                        <i class="fa-solid fa-user-graduate"></i>
                        <span><strong>{{ $totalSiswa }}</strong> siswa terdaftar</span>
                    </div>
                </section>

                <section class="student-metrics" aria-label="Ringkasan data siswa">
                    <article class="metric-card metric-primary">
                        <div class="metric-icon"><i class="fa-solid fa-user-graduate"></i></div>
                        <div><span>Total Siswa</span><strong>{{ $totalSiswa }}</strong><small>Data siswa terdaftar</small></div>
                    </article>
                    <article class="metric-card metric-success">
                        <div class="metric-icon"><i class="fa-solid fa-circle-check"></i></div>
                        <div><span>Siswa Aktif</span><strong>{{ $siswaAktif }}</strong><small>Siap mengikuti kegiatan</small></div>
                    </article>
                    <article class="metric-card metric-info">
                        <div class="metric-icon"><i class="fa-solid fa-school"></i></div>
                        <div><span>Kelas Terisi</span><strong>{{ $jumlahKelas }}</strong><small>Kelas dengan data siswa</small></div>
                    </article>
                </section>

                <section class="students-card" aria-labelledby="table-title">
                    <div class="card-header">
                        <div>
                            <h2 id="table-title">Data Siswa Terdaftar</h2>
                            <p>Gunakan pencarian atau filter untuk mempercepat penelusuran data.</p>
                        </div>
                        <span class="result-counter" id="resultCounter">{{ $totalSiswa }} data</span>
                    </div>

                    <div class="table-toolbar">
                        <label class="search-field" for="studentSearch">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input id="studentSearch" type="search" placeholder="Cari nama, NIS, atau kelas..." autocomplete="off">
                        </label>
                        <label class="select-field" for="genderFilter">
                            <span class="sr-only">Filter jenis kelamin</span>
                            <i class="fa-solid fa-filter"></i>
                            <select id="genderFilter">
                                <option value="">Semua jenis kelamin</option>
                                <option value="l">Laki-laki</option>
                                <option value="p">Perempuan</option>
                            </select>
                        </label>
                    </div>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th class="number-column">No.</th>
                                    <th>Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                    <th class="action-column">Aksi</th>
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
                                        <td class="number-column">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="student-cell">
                                                @if ($siswa->url_foto)
                                                    <img src="{{ route('file.show', $siswa->url_foto) }}" alt="Foto {{ $siswa->nama }}" class="student-avatar">
                                                @else
                                                    <span class="student-avatar avatar-fallback"><i class="fa-solid fa-user"></i></span>
                                                @endif
                                                <div>
                                                    <strong>{{ $siswa->nama }}</strong>
                                                    <span>NIS: {{ $siswa->nis }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="gender-badge {{ $isPerempuan ? 'female' : 'male' }}">
                                                <i class="fa-solid {{ $isPerempuan ? 'fa-venus' : 'fa-mars' }}"></i>
                                                {{ $isPerempuan ? 'Perempuan' : 'Laki-laki' }}
                                            </span>
                                        </td>
                                        <td><span class="class-badge">{{ $kelasNama }}</span></td>
                                        <td>
                                            <span class="status-badge {{ $isAktif ? 'active' : 'inactive' }}">
                                                <i class="fa-solid {{ $isAktif ? 'fa-circle-check' : 'fa-circle-pause' }}"></i>
                                                {{ $isAktif ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="action-column">
                                            <a href="/sk/dls/{{ $siswa->id }}" class="view-button" aria-label="Lihat detail {{ $siswa->nama }}">
                                                <i class="fa-solid fa-eye"></i><span>Detail</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-row"><td colspan="6"><i class="fa-solid fa-users-slash"></i> Belum ada data siswa yang dapat ditampilkan.</td></tr>
                                @endforelse
                                <tr class="empty-row" id="filterEmpty" hidden><td colspan="6"><i class="fa-solid fa-magnifying-glass"></i> Data siswa tidak ditemukan.</td></tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </main>
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
                row.hidden = !show;
                if (show) visible++;
            });

            resultCounter.textContent = `${visible} data`;
            filterEmpty.hidden = visible !== 0 || studentRows.length === 0;
        }

        searchInput?.addEventListener('input', filterStudents);
        genderFilter?.addEventListener('change', filterStudents);
    </script>
</body>
</html>
