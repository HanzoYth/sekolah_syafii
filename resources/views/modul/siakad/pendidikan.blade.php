<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembayaran Pendidikan - SIAKAD</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Stylesheet dashboard SIAKAD --}}
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pembayaran.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pendidikan.css') }}">
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
                    <h2>Pembayaran Pendidikan</h2>
                </div>

                <div class="academic-pill">
                    <i class="fa-solid fa-calendar-check"></i>
                    T.A. 2026/2027 &middot; Semester Genap
                </div>

                <div class="topbar-icons">
                    <div class="icon-bell-wrap">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            {{-- STATISTIK PEMBAYARAN PENDIDIKAN --}}
            <div class="stats-grid pembayaran-stats">
                <div class="stat-card">
                    <div class="stat-icon icon-primary"><i class="fa-solid fa-wallet"></i></div>
                    <div>
                        <h3>Rp {{number_format($total_target_pendidikan,0,",",".")}}</h3>
                        <p>Target Biaya Pendidikan Bulan Ini</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-success"><i class="fa-solid fa-circle-dollar-to-slot"></i></div>
                    <div>
                        <h3>Rp {{number_format($total_lunas_pendidikan,0,",",".")}}</h3>
                        <p>Total Biaya Pendidikan Terkumpul</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-info"><i class="fa-solid fa-user-check"></i></div>
                    <div>
                        <h3>{{$total_siswa_lunas}}</h3>
                        <p>Siswa Lunas Pendidikan</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-danger"><i class="fa-solid fa-user-xmark"></i></div>
                    <div>
                        <h3>{{$total_siswa_belum_lunas}}</h3>
                        <p>Siswa Menunggak</p>
                    </div>
                </div>
            </div>

            {{-- FILTER PEMBAYARAN PENDIDIKAN --}}
            <div class="filter-box pembayaran-filter">
                <h4><i class="fa-solid fa-filter"></i> Filter Tagihan Pendidikan</h4>
                <div class="filter-group">
                    <div class="input-wrap">
                        <label for="filter-status-spp">Status Biaya Pendidikan</label>
                        <select id="filter-status-spp" name="status_spp">
                            <option value="">Semua Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="menunggak">Menunggak</option>
                        </select>
                    </div>

                    <div class="input-wrap">
                        <label for="filter-kelas-spp">Kelas</label>
                        <select id="filter-kelas-spp" name="kelas">
                            <option value="">Semua Kelas</option>
                            @foreach ($data_kelas as $value)
                                <option value="{{$value->nama_ruang}}">{{$value->nama_ruang}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- TABEL DAFTAR TAGIHAN SPP --}}
            <div class="table-card">
                <div class="table-header">
                    <h4>Daftar Tagihan Pendidikan Siswa</h4>
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
                            @foreach ($data_slip_pendidikan as $value)
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
                                            <button class="btn-action view" title="Konfirmasi & Bukti Pembayaran" onclick="openDetailModal('{{$data_siswa->nama}}', '{{$data_siswa->nis}}', '{{$value->nominal}}', '{{$value->jumlah_di_bayar}}', '{{$sisa_bayar}}', '{{$value->status}}')"><i class="fa-solid fa-eye"></i></button>
                                            <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('{{$value->id}}','{{$data_siswa->nama}}', '{{$data_siswa->nis}}', '{{$value->nominal}}','{{$sisa_bayar}}','{{$value->status}}')"><i class="fa-solid fa-cash-register"></i></button>
                                            <button class="btn-action publish" title="Publish Tagihan" onclick="openPublishModal('{{$data_siswa->id}}', '{{$data_siswa->nama}}', '{{$data_siswa->nis}}')"><i class="fa-solid fa-paper-plane"></i></button>
                                            <button class="btn-action delete" style="background-color: #ef4444; color: #fff;" title="Hapus Tagihan" onclick="openDeleteModal('{{$value->id}}', '{{$data_siswa->nama}}', '{{$data_siswa->nis}}')"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- FOOTER CARD / PAGINATION --}}
                <div class="card-footer pagination-wrap">
                    <div class="pagination-container">
                        {{ $data_slip_pendidikan->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL INPUT TRANSAKSI / ANGSURAN SPP --}}
    <div id="modalBayarPendidikan" class="modal-overlay">
        <input type="hidden" value="" id="value_pembayaran">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Input Pembayaran Pendidikan</h3>
                <button type="button" class="btn-close-modal" onclick="closeBayarModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/espp" method="POST" class="modal-body">
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
                    <input type="number" id="bayar-nominal" name="bayar" placeholder="Masukkan jumlah yang dibayarkan">
                </div>
                <div class="modal-field">
                    <label for="edit-status">Status Pembayaran Pendidikan</label>
                    <input type="text" id="edit-status" name="status" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeBayarModal()">Batal</button>
                    <button type="submit" class="btn-modal-save"><i class="fa-solid fa-receipt"></i> Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL POP-UP KONFIRMASI & BUKTI PEMBAYARAN --}}
    <div id="modalDetailPendidikan" class="modal-overlay">
        <div class="modal-card modal-lg">
            <div class="modal-header">
                <h3>Konfirmasi Pembayaran Pendidikan</h3>
                <button type="button" class="btn-close-modal" onclick="closeDetailModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <!-- Header Logo & Nama Sekolah -->
                <div class="printable-header" style="text-align: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 15px;">
                    <h3 style="margin: 0; font-family: 'Poppins', sans-serif;">SISTEM INFORMASI AKADEMIK (SIAKAD)</h3>
                    <p style="margin: 0; font-size: 0.85rem; color: #666;">Bukti Konfirmasi Tagihan Pembayaran Pendidikan</p>
                </div>

                <div class="student-info-summary">
                    <div>
                        <small>Nama Siswa</small>
                        <h4 id="detail-nama">-</h4>
                    </div>
                    <div>
                        <small>NIS / No. Reg</small>
                        <h4 id="detail-reg">-</h4>
                    </div>
                    <div>
                        <small>Status Pembayaran</small>
                        <span id="detail-status-badge" class="badge success">Lunas</span>
                    </div>
                </div>

                <div class="confirmation-box" style="background: #f8f9fa; border-radius: 8px; padding: 15px; margin-top: 15px;">
                    <h5 style="margin-top: 0; margin-bottom: 10px; color: #333;"><i class="fa-solid fa-circle-info"></i> Ringkasan Konfirmasi</h5>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; font-size: 0.9rem;">
                        <div>
                            <span style="color: #666; display: block;">Total Tagihan:</span>
                            <strong id="detail-total">Rp 0</strong>
                        </div>
                        <div>
                            <span style="color: #666; display: block;">Total Terbayar:</span>
                            <strong id="detail-terbayar" style="color: #2e7d32;">Rp 0</strong>
                        </div>
                        <div>
                            <span style="color: #666; display: block;">Sisa Tagihan:</span>
                            <strong id="detail-sisa" style="color: #c62828;">Rp 0</strong>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="margin-top: 20px;">
                    <button type="button" class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
                    <button type="button" class="btn-action view" onclick="window.print()"><i class="fa-solid fa-print"></i> Cetak Bukti</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL POP-UP KONFIRMASI PUBLISH TAGIHAN --}}
    <div id="modalPublishPendidikan" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Konfirmasi Publish Tagihan</h3>
                <button type="button" class="btn-close-modal" onclick="closePublishModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/pbsp" method="POST" class="modal-body">
                @csrf
                <input type="hidden" name="id_siswa" id="publish-id-pendidikan" value="">
                <input type="hidden" name="pembayaran" value="pendidikan">

                <div style="text-align: center; padding: 10px 0;">
                    <i class="fa-solid fa-paper-plane" style="font-size: 3rem; color: #0284c7; margin-bottom: 15px;"></i>
                    <p style="margin: 0; font-size: 1rem; color: #333;">Apakah Anda yakin ingin mempublikasikan tagihan pendidikan ini?</p>
                    <strong id="publish-student-info" style="display: block; margin-top: 8px; font-size: 0.95rem; color: #555;">-</strong>
                </div>

                <div class="modal-footer" style="margin-top: 20px;">
                    <button type="button" class="btn-modal-cancel" onclick="closePublishModal()">Batal</button>
                    <button type="submit" class="btn-modal-save" style="background-color: #0284c7;"><i class="fa-solid fa-paper-plane"></i> Ya, Publish</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL POP-UP KONFIRMASI HAPUS TAGIHAN --}}
    <div id="modalDeletePendidikan" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Konfirmasi Hapus Tagihan</h3>
                <button type="button" class="btn-close-modal" onclick="closeDeleteModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/hpsp" method="POST" class="modal-body">
                @csrf
                <input type="hidden" name="id" id="delete-id-pendidikan" value="">
                <input type="hidden" name="pembayaran" id="delete_id" value="pendidikan">

                <div style="text-align: center; padding: 10px 0;">
                    <i class="fa-solid fa-trash-can" style="font-size: 3rem; color: #ef4444; margin-bottom: 15px;"></i>
                    <p style="margin: 0; font-size: 1rem; color: #333;">Apakah Anda yakin ingin menghapus data tagihan ini?</p>
                    <strong id="delete-student-info" style="display: block; margin-top: 8px; font-size: 0.95rem; color: #555;">-</strong>
                </div>

                <div class="modal-footer" style="margin-top: 20px;">
                    <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="btn-modal-save" style="background-color: #ef4444;"><i class="fa-solid fa-trash"></i> Ya, Hapus Data</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT --}}
    <script>
        var input_status = document.getElementById("filter-status-spp");
        var input_kelas = document.getElementById("filter-kelas-spp");

        input_status.addEventListener("change", filterData);
        input_kelas.addEventListener("change", filterData);

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
            } else {
                e.target.value = memory_data;
            }

            if (parseInt(e.target.value ? e.target.value : 0) == parseInt(document.getElementById("value_pembayaran").value)){
                document.getElementById("edit-status").value = "Lunas";
            } else {
                document.getElementById("edit-status").value = "Menunggak";
            }
        });

        function openBayarModal(id, nama, reg, total, sisa, status) {
            document.getElementById("value_pembayaran").value = sisa;
            document.getElementById("id_siswa").value = id;

            document.getElementById("edit-status").value = parseInt(status) ? "lunas" : "Menunggak";

            document.getElementById('modal-bayar-siswa').value = `${reg} - ${nama}`;
            document.getElementById('modal-bayar-total').value = parseInt(total);
            document.getElementById('modal-bayar-sisa').value = 'Rp ' + parseInt(sisa).toLocaleString('id-ID');
            document.getElementById('bayar-nominal').max = sisa;

            document.getElementById('modalBayarPendidikan').classList.add('active');
        }

        function closeBayarModal() {
            document.getElementById('modalBayarPendidikan').classList.remove('active');
        }

        function openDetailModal(nama, reg, total, terbayar, sisa, status) {
            document.getElementById('detail-nama').innerText = nama;
            document.getElementById('detail-reg').innerText = reg;
            document.getElementById('detail-total').innerText = 'Rp ' + parseInt(total).toLocaleString('id-ID');
            document.getElementById('detail-terbayar').innerText = 'Rp ' + parseInt(terbayar).toLocaleString('id-ID');
            document.getElementById('detail-sisa').innerText = 'Rp ' + parseInt(sisa).toLocaleString('id-ID');

            var badge = document.getElementById('detail-status-badge');
            if (parseInt(status) === 1 || status === 'lunas') {
                badge.className = 'badge success';
                badge.innerText = 'Lunas';
            } else {
                badge.className = 'badge danger';
                badge.innerText = 'Menunggak';
            }

            document.getElementById('modalDetailPendidikan').classList.add('active');
        }

        function closeDetailModal() {
            document.getElementById('modalDetailPendidikan').classList.remove('active');
        }

        function openPublishModal(id, nama, reg) {
            document.getElementById('publish-id-pendidikan').value = id;
            document.getElementById('publish-student-info').innerText = `${reg} - ${nama}`;
            document.getElementById('modalPublishPendidikan').classList.add('active');
        }

        function closePublishModal() {
            document.getElementById('modalPublishPendidikan').classList.remove('active');
        }

        function openDeleteModal(id, nama, reg) {
            document.getElementById('delete-id-pendidikan').value = id;
            document.getElementById('delete-student-info').innerText = `${reg} - ${nama}`;
            document.getElementById('modalDeletePendidikan').classList.add('active');
        }

        function closeDeleteModal() {
            document.getElementById('modalDeletePendidikan').classList.remove('active');
        }

        window.onclick = function(event) {
            const modalBayar = document.getElementById('modalBayarPendidikan');
            const modalDetail = document.getElementById('modalDetailPendidikan');
            const modalPublish = document.getElementById('modalPublishPendidikan');
            const modalDelete = document.getElementById('modalDeletePendidikan');

            if (event.target === modalBayar) closeBayarModal();
            if (event.target === modalDetail) closeDetailModal();
            if (event.target === modalPublish) closePublishModal();
            if (event.target === modalDelete) closeDeleteModal();
        }
    </script>

</body>
</html>