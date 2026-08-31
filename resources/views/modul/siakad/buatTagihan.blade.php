<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Tagihan Pembayaran Siswa</title>
    
    <!-- Font Poppins & FontAwesome Icon -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Load CSS Terpisah -->
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/buatTagihan.css') }}">
</head>
<body>

    <x-sidebar_siakad />
    {{-- Main Container --}}
    <div class="main-content">
        
        <!-- Topbar Section -->
        <div class="topbar">
            <div class="topbar-left">
                <span class="topbar-eyebrow">MODUL SIAKAD</span>
                <h2>Daftar Tagihan Siswa</h2>
            </div>
            <div class="topbar-icons">
                <div class="academic-pill">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>T.A. 2025/2026</span>
                </div>
                <div class="icon-bell-wrap">
                    <i class="fa-regular fa-bell"></i>
                </div>
            </div>
        </div>

        <!-- Filter Pencarian -->
        <div class="filter-card">
            <div class="filter-row">
                <div class="filter-field">
                    <label for="filterNama"><i class="fa-solid fa-magnifying-glass"></i> Cari Nama Siswa</label>
                    <input type="text" id="filterNama" placeholder="Ketik nama siswa..." onkeyup="filterSiswa()">
                </div>
                <div class="filter-field">
                    <label for="filterKelas"><i class="fa-solid fa-filter"></i> Pilih Kelas</label>
                    <select id="filterKelas" onchange="filterSiswa()">
                        <option value="">-- Semua Kelas --</option>
                        <option value="X-IPA 1">X-IPA 1</option>
                        <option value="X-IPA 2">X-IPA 2</option>
                        <option value="XI-IPA 3">XI-IPA 3</option>
                        <option value="XI-IPS 1">XI-IPS 1</option>
                        <option value="XII-IPS 2">XII-IPS 2</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Card Tabel Siswa -->
        <div class="table-card">
            <div class="table-header">
                <h4>Data Siswa</h4>
            </div>
            
            <div class="table-responsive">
                <table id="tableSiswa">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 0;
                        @endphp
                        @foreach($data_siswa as $index => $siswa)
                            @php
                                $data_kelas = App\Models\ruang_kelas::where("id",$siswa->kelas_id)->first();
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="student-name">{{ $siswa->nama }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td><span class="class-pill">{{ $data_kelas->nama_ruang }}</span></td>
                                <td class="text-center">
                                    <button type="button" 
                                            class="btn-outline"
                                            onclick="openModalTagihan('{{$siswa->id}}', '{{$siswa->nama}}', '{{$siswa->nis}}')">
                                        <i class="fa-solid fa-file-invoice-dollar"></i> Buat Tagihan
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal Pop-up Buat Tagihan -->
    <div class="modal-overlay" id="modalTagihan">
        <div class="modal-card">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <h3>
                    <i class="fa-solid fa-receipt"></i>
                    <div>
                        Buat Tagihan Pembayaran
                        <small id="modalStudentInfo">Siswa: -</small>
                    </div>
                </h3>
                <button type="button" class="btn-close-modal" onclick="closeModalTagihan()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Form Tagihan -->
            <form id="formBuatTagihan" action="/sk/tbtg" method="POST">
                @csrf
                <input type="hidden" name="siswa_id" id="modal_siswa_id">

                <div class="modal-body">
                    
                    <!-- Input Jenis Pembayaran -->
                    <div class="modal-field">
                        <label for="jenis_pembayaran">
                            <i class="fa-solid fa-wallet"></i> Jenis Pembayaran
                        </label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-list-check"></i>
                            <select name="jenis_pembayaran" id="jenis_pembayaran" required>
                                <option value="" disabled selected>-- Pilih Jenis Pembayaran --</option>
                                <option value="ipp">Tagihan IPP</option>
                                <option value="pangkal">Tagihan Pangkal</option>
                                <option value="pendidikan">Tagihan Pendidikan</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-section-title">Periode Tagihan</div>

                    <!-- Input Periode Tanggal (Mulai Tanggal & Akhir Tanggal) -->
                    <div class="modal-row">
                        <div class="modal-field">
                            <label for="tanggal_mulai">
                                <i class="fa-regular fa-calendar-minus"></i> Tanggal Mulai
                            </label>
                            <div class="input-icon-wrapper">
                                <i class="fa-regular fa-calendar"></i>
                                <input type="date" 
                                       name="tanggal_mulai" 
                                       id="tanggal_mulai" 
                                       required>
                            </div>
                        </div>

                        <div class="modal-field">
                            <label for="tanggal_akhir">
                                <i class="fa-regular fa-calendar-plus"></i> Tanggal Akhir
                            </label>
                            <div class="input-icon-wrapper">
                                <i class="fa-regular fa-calendar"></i>
                                <input type="date" 
                                       name="tanggal_akhir" 
                                       id="tanggal_akhir" 
                                       required>
                            </div>
                        </div>
                    </div>
                    <!-- Input Nominal -->
                    <div class="modal-field">
                        <label for="nominal">
                            <i class="fa-solid fa-money-bill-wave"></i> Nominal Tagihan (Rp)
                        </label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-rupiah-sign"></i>
                            <input type="number" 
                                   name="nominal" 
                                   id="nominal" 
                                   class="input-nominal" 
                                   placeholder="Masukkan nominal angka (contoh: 500000)" 
                                   min="0"
                                   required>
                        </div>
                        <span class="field-hint">Isikan angka tanpa titik atau koma.</span>
                    </div>

                </div>

                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeModalTagihan()">Batal</button>
                    <button type="submit" class="btn-modal-save">
                        <i class="fa-solid fa-paper-plane"></i> Simpan Tagihan
                    </button>
                </div>
            </form>

        </div>
    </div>
    <x-warning />
    <!-- JavaScript Handling Modal, Filter & Dummy Action -->
    <script>
        function filterSiswa() {
            const inputNama = document.getElementById('filterNama').value.toLowerCase();
            const selectKelas = document.getElementById('filterKelas').value.toLowerCase();
            const table = document.getElementById('tableSiswa');
            const tr = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let i = 0; i < tr.length; i++) {
                const tdNama = tr[i].getElementsByTagName('td')[1];
                const tdKelas = tr[i].getElementsByTagName('td')[3];

                if (tdNama && tdKelas) {
                    const txtNama = tdNama.textContent || tdNama.innerText;
                    const txtKelas = tdKelas.textContent || tdKelas.innerText;

                    const matchesNama = txtNama.toLowerCase().indexOf(inputNama) > -1;
                    const matchesKelas = selectKelas === "" || txtKelas.toLowerCase() === selectKelas;

                    if (matchesNama && matchesKelas) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function openModalTagihan(id, nama, nis) {
            document.getElementById('modal_siswa_id').value = id;
            document.getElementById('modalStudentInfo').textContent = `Siswa: ${nama} (${nis})`;
            
            // Reset form saat membuka modal
            document.getElementById('formBuatTagihan').reset();
            document.getElementById('modal_siswa_id').value = id;

            const modal = document.getElementById('modalTagihan');
            modal.classList.add('active');
        }

        function closeModalTagihan() {
            const modal = document.getElementById('modalTagihan');
            modal.classList.remove('active');
        }

        // Menutup modal saat mengklik area luar modal (overlay)
        window.onclick = function(event) {
            const modal = document.getElementById('modalTagihan');
            if (event.target === modal) {
                closeModalTagihan();
            }
        }
        const jenis = document.getElementById('jenis_pembayaran');
        const pembungkus_priode = document.querySelector('.modal-row');

        jenis.addEventListener('change',() => {
            if (jenis.value != "ipp"){
                pembungkus_priode.style.display = "none";
                document.getElementById("tanggal_mulai").removeAttribute("required");
                document.getElementById("tanggal_akhir").removeAttribute("required");
            }else{
                pembungkus_priode.style.display = "";
                document.getElementById("tanggal_mulai").setAttribute("required","");
                document.getElementById("tanggal_akhir").setAttribute("required","");
            }
        });

    </script>
</body>
</html>