<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Uang Pangkal - SIAKAD</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Stylesheet dashboard SIAKAD --}}
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pembayaran.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pangkal.css') }}">
</head>
<body>

    <div class="dashboard-container">

        {{-- WADAH TEMPLATE SIDEBAR --}}
        <x-sidebar_siakad />

        {{-- MAIN CONTENT --}}
        <main class="main-content">

            {{-- TOPBAR / HEADER --}}
            <header class="topbar">
                <div class="topbar-left">
                    <span class="topbar-eyebrow">Sistem Informasi Akademik &middot; Selasa, 04 Agustus 2026</span>
                    <h2>Pembayaran Uang Pangkal</h2>
                </div>

                <div class="academic-pill">
                    <i class="fa-solid fa-calendar-check"></i>
                    T.A. 2026/2027 &middot; Penerimaan Siswa Baru
                </div>

                <div class="topbar-icons">
                    <div class="icon-bell-wrap">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            {{-- STATISTIK UANG PANGKAL --}}
            <div class="stats-grid pembayaran-stats">
                <div class="stat-card">
                    <div class="stat-icon icon-primary"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                    <div>
                        <h3>Rp 425.000.000</h3>
                        <p>Total Target Uang Pangkal</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-success"><i class="fa-solid fa-vault"></i></div>
                    <div>
                        <h3>Rp 310.500.000</h3>
                        <p>Total Terkumpul</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-info"><i class="fa-solid fa-user-check"></i></div>
                    <div>
                        <h3>62</h3>
                        <p>Siswa Lunas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-warning"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <div>
                        <h3>23</h3>
                        <p>Siswa Mengangsur</p>
                    </div>
                </div>
            </div>

            {{-- FILTER PEMBAYARAN UANG PANGKAL --}}
            <div class="filter-box pembayaran-filter">
                <h4> Uang Pangkal</h4>
                <div class="filter-group">
                  
                    <div class="input-wrap">
                        <label for="filter-status-pangkal">Status Pembayaran</label>
                        <select id="filter-status-pangkal" name="status_pangkal">
                            <option value="">Semua Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="Menunggak">Menunggak</option>
                        </select>
                    </div>
                  
                    <div class="input-wrap">
                        <label for="filter-kelas-pangkal">kelas</label>
                        <select id="filter-kelas-pangkal" name="kelas">
                            <option value="">Semua kelas</option>
                            @foreach ($data_kelas as $value)
                                <option value="{{$value->nama_ruang}}">{{$value->nama_ruang}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- TABEL DAFTAR UANG PANGKAL --}}
            <div class="table-card">
                <div class="table-header">
                    <h4>Daftar Tagihan Uang Pangkal Siswa Baru</h4>
                 
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Nominal</th>
                                <th>Terbayar</th>
                                <th>Sisa Tagihan</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_slip_pangkal as $value)
                                @php
                                    $data_siswa = App\Models\siswa::where("id", $value->siswa_id)->first();
                                    $data_kelas = App\Models\ruang_kelas::where("id",$data_siswa->kelas_id)->first();
                                    $sisa_bayar = $value->nominal - $value->jumlah_di_bayar;
                                @endphp
                                <tr>
                                    <td><span class="student-name">{{$data_siswa->nama}}</span></td>
                                    <td><span class="class-pill">{{$data_kelas->nama_ruang}}</span></td>
                                    <td class="amount">Rp{{number_format($value->nominal,0,",",".")}}</td>
                                    <td class="amount text-success">Rp{{number_format($value->jumlah_di_bayar,0,",",".")}}</td>
                                    <td class="amount">Rp{{number_format($sisa_bayar,0,",",".")}}</td>
                                    <td class="status"><span class="badge {{$value->status ? 'success' : 'danger'}}"><i class="fa-solid fa-triangle-exclamation"></i> {{$value->status ? 'lunas':'menunggak'}}</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-action view" title="Detail Riwayat" onclick="openDetailModal('Ahmad Raihan', 'REG-2026-001', '5000000', '5000000', '0')"><i class="fa-solid fa-eye"></i></button>
                                            <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('{{$value->id}}','{{$data_siswa->nama}}', '{{$data_siswa->nis}}', '{{$value->nominal}}','{{$sisa_bayar}}','{{$value->status}}')"><i class="fa-solid fa-cash-register"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- FOOTER CARD / PAGINATION --}}
                <div class="card-footer pagination-wrap">
                    {{-- Laravel Pagination Link --}}
                    <div class="pagination-container">
                        {{ $data_slip_pangkal->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL INPUT TRANSAKSI / ANGSURAN --}}
    <div id="modalBayarPangkal" class="modal-overlay">
        <input type="hidden" value="" id="value_pembayaran">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Input Pembayaran Uang Pangkal</h3>
                <button type="button" class="btn-close-modal" onclick="closeBayarModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/espk" method="POST" class="modal-body">
                @csrf
                <input type="hidden" name="id_siswa" id="id_siswa" value="">
                <div class="modal-field">
                    <label>Nis / Nama Siswa</label>
                    <input type="text" id="modal-bayar-siswa" readonly disabled class="input-readonly">
                </div>
                <div class="modal-row-2">
                    <div class="modal-field">
                        <label>Nominal Tagihan</label>
                        <input type="number" id="modal-bayar-total" name="nominal">
                    </div>
                    <div class="modal-field">
                        <label>Sisa Tanggungan</label>
                        <input type="text" id="modal-bayar-sisa" readonly disabled class="input-readonly text-danger font-bold">
                    </div>
                </div>
                <div class="modal-field">
                    <label for="bayar-nominal">Nominal Pembayaran Saat Ini (Rp)</label>
                    <input type="number" id="bayar-nominal" name="bayar" placeholder="Masukkan jumlah yang dibayarkan" required>
                </div>
                <div class="modal-field">
                    <label for="edit-status">Status Pembayaran IPP</label>
                    <input type="text" id="edit-status" name="status" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeBayarModal()">Batal</button>
                    <button type="submit" class="btn-modal-save"><i class="fa-solid fa-receipt"></i> Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL DETAIL RIWAYAT ANGSURAN --}}
    <div id="modalDetailPangkal" class="modal-overlay">
        <div class="modal-card modal-lg">
            <div class="modal-header">
                <h3>Riwayat Pembayaran Uang Pangkal</h3>
                <button type="button" class="btn-close-modal" onclick="closeDetailModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="student-info-summary">
                    <div>
                        <small>Siswa</small>
                        <h4 id="detail-nama">Ahmad Raihan</h4>
                    </div>
                    <div>
                        <small>Nis</small>
                        <h4 id="detail-reg">REG-2026-001</h4>
                    </div>
                    <div>
                        <small>Status</small>
                        <span id="detail-status-badge" class="badge success">Lunas</span>
                    </div>
                </div>

                <h5 class="history-title"><i class="fa-solid fa-history"></i> Log Transaksi Masuk</h5>
                <div class="history-table-wrap">
                    <table class="table-history">
                        <thead>
                            <tr>
                                <th>Tgl Transaksi</th>
                                <th>Nominal</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="detail-history-body">
                            <!-- Populated via Javascript -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
                    <button type="button" class="btn-action view" onclick="window.print()"><i class="fa-solid fa-print"></i> Cetak Bukti</button>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT --}}
    <script>
        var input_status = document.getElementById("filter-status-pangkal");
        var input_kelas = document.getElementById("filter-kelas-pangkal");


        input_status.addEventListener("change",filterData);
        input_kelas.addEventListener("change",filterData);

        function filterData(){
            var value_status = input_status.value;
            var value_kelas = input_kelas.value;
            var row_tr = document.querySelectorAll(".table-responsive tbody tr");

            reset();
            row_tr.forEach((data) => {
                var row_kelas = data.querySelector(".class-pill");
                var row_status = data.querySelector(".status");

                if (value_status != ""){
                    if (!row_status.classList.contains("hide") && row_status.textContent.toLowerCase().trim() != value_status.toLowerCase().trim()){
                        data.classList.add("hide");
                    }
                }

                if (value_kelas != ""){
                    if (!row_kelas.classList.contains("hide") && row_kelas.textContent.toLowerCase().trim() != value_kelas.toLowerCase().trim()){
                        data.classList.add("hide");
                    }
                }
            });
        }

        function reset(){
            var row_tr = document.querySelectorAll("tbody tr");
            row_tr.forEach((data) => {
                data.classList.remove("hide");
            }); 
        }


        var memory_data = 0;
        document.getElementById("bayar-nominal").addEventListener('input',(e) => {
            if (parseInt(e.target.value ? e.target.value : 0) <= parseInt(document.getElementById("value_pembayaran").value)){
                memory_data = parseInt(e.target.value);
            }else{
                e.target.value = memory_data;
            }

            if (parseInt(e.target.value ? e.target.value : 0) == parseInt(document.getElementById("value_pembayaran").value)){
                document.getElementById("edit-status").value = "Lunas";
            }else{
                document.getElementById("edit-status").value = "Menunggak";        
            }
        });


        function openBayarModal(id,nama, reg, total, sisa,status) {
            document.getElementById("value_pembayaran").value = sisa;
            document.getElementById("id_siswa").value = id;

            document.getElementById("edit-status").value = parseInt(status) ? "lunas" : "Menunggak";

            document.getElementById('modal-bayar-siswa').value = `${reg} - ${nama}`;
            document.getElementById('modal-bayar-total').value = parseInt(total);
            document.getElementById('modal-bayar-sisa').value = 'Rp ' + parseInt(sisa).toLocaleString('id-ID');
            document.getElementById('bayar-nominal').max = sisa;
            
            document.getElementById('modalBayarPangkal').classList.add('active');
        }

        function closeBayarModal() {
            document.getElementById('modalBayarPangkal').classList.remove('active');
        }

        function openDetailModal(nama, reg, total, terbayar, sisa) {

            document.getElementById('modalDetailPangkal').classList.add('active');
        }

        function closeDetailModal() {
            document.getElementById('modalDetailPangkal').classList.remove('active');
        }

        window.onclick = function(event) {
            const modalBayar = document.getElementById('modalBayarPangkal');
            const modalDetail = document.getElementById('modalDetailPangkal');
            if (event.target === modalBayar) closeBayarModal();
            if (event.target === modalDetail) closeDetailModal();
        }
    </script>

</body>
</html>