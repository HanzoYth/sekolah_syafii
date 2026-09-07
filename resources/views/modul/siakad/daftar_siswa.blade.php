<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Islamic Smart School</title>

    <!-- Font Inter & Arabic -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Custom -->    
    <link rel="stylesheet" href="{{asset('css/modul/siakad/data_siswa.css')}}">
</head>
<body>

<div class="app-shell">

    <!-- ============================= SIDEBAR ============================= -->
    <x-sidebar_siakad />

    <!-- ========================= KONTEN UTAMA ========================= -->
    <div class="main-content">

        <!-- Header / Topbar -->
        <header class="topbar">
            <div class="topbar-inner">
                <div class="topbar-title">
                    <h1>Daftar Siswa</h1>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="page">

            <!-- Card Tabel -->
            <div class="card">

                <!-- Toolbar & Filter -->
                <div class="toolbar">
                    <form action="#" method="GET" class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="search" placeholder="Cari NIS, Nama, atau Kelas...">
                    </form>
                    <div class="toolbar-meta">
                        <i class="fa-solid fa-users"></i>
                        <span>Total Siswa: <strong>{{ count($data_siswa) }}</strong> Santri/Siswa</span>
                    </div>
                </div>

                <!-- Tabel Data Siswa -->
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-center">No</th>
                                <th class="col-center">Foto</th>
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Kelas</th>
                                <th class="col-center">Aksi</th>
                            </tr>
                        </thead>
                        @php
                            $no = 0;
                        @endphp
                        <tbody>
                            @foreach ($data_siswa as $value)
                                @php            
                                    $kelas = App\Models\ruang_kelas::find($value->kelas_id);
                                    $no++;
                                @endphp
                                <tr>
                                    <td class="col-center row-number">{{$no}}</td>
                                    <td class="col-center">
                                        <div class="avatar-container">
                                            @if($value->url_foto)
                                                <img src='{{route("file.show", $value->url_foto)}}' alt="{{$value->nama}}" class="avatar-img">
                                            @else
                                                <div class="avatar-placeholder">
                                                    <i class="fa-solid fa-user"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="student-id">
                                        <strong>{{$value->nis}}</strong>
                                    </td>
                                    <td class="student-name">{{$value->nama}}</td>
                                    <td>
                                        <span class="badge {{$value->gender == 'p' ? 'badge-perempuan' : 'badge-laki'}}">
                                            <i class="fa-solid {{$value->gender == 'p' ? 'fa-venus' : 'fa-mars'}}"></i> 
                                            {{$value->gender == 'p' ? 'Perempuan' : 'Laki-laki'}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-kelas">{{ $kelas->nama_ruang ?? '-' }}</span>
                                    </td>
                                    <td class="col-center">
                                        <div class="actions">
                                            <a href='/sk/dls/{{$value->id}}' class="btn-icon btn-icon-view" data-tooltip="Detail Siswa">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn-icon btn-icon-deactivate" data-tooltip="Nonaktifkan Siswa" onclick="openDeactivateModal('{{ $value->nama }}', '{{ $value->id}}')">
                                                <i class="fa-solid fa-user-slash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Footer Card / Pagination -->
                <!-- <div class="card-footer">
                    <span class="card-footer-info">Menampilkan {{ count($data_siswa) }} data siswa aktif</span>
                    <div class="pagination">
                        <button disabled>Sebelumnya</button>
                        <button class="active">1</button>
                        <button disabled>Selanjutnya</button>
                    </div>
                </div> -->

            </div>
        </main>
    </div>
</div>

<!-- ================= POP-UP MODAL KONFIRMASI ================= -->
<div class="modal-overlay" id="deactivateModal">
    <div class="modal-card">
        <div class="modal-icon">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h3 class="modal-title">Konfirmasi Nonaktifkan</h3>
        <p class="modal-desc">Apakah Anda yakin ingin menonaktifkan akun siswa <strong id="modalStudentName"></strong>? Akses siswa ke sistem akan dibatasi.</p>
        <div class="modal-actions">
            <button type="button" class="btn-cancel" onclick="closeDeactivateModal()">Batal</button>
            <form id="deactivateForm" action="#" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-confirm">Ya, Nonaktifkan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeactivateModal(name, id) {
        document.getElementById('modalStudentName').innerText = name;
        // Jika ada route aksi nonaktifkan, Anda bisa set action form di sini secara dinamis:
        // document.getElementById('deactivateForm').action = '/siswa/nonaktifkan/' + id;
        document.getElementById('deactivateModal').classList.add('active');
    }

    function closeDeactivateModal() {
        document.getElementById('deactivateModal').classList.remove('active');
    }
</script>

</body>
</html>