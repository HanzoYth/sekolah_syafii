<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gaji Guru - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/edit_gaji_guru.css') }}">
</head>
<body>

<div class="dashboard-container">
    <!-- MAIN CONTENT -->
    <main class="main-wrapper">
        <!-- TOPBAR HEADER -->
        <header class="topbar">
            <div class="topbar-left">
                <a href="/gr/klgjgr" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div class="topbar-title">
                    <h2>Edit Data Gaji Guru</h2>
                    <p>Penyesuaian rincian kafalah, tunjangan, dan potongan periode ini</p>
                </div>
            </div>
            <div class="topbar-actions">
                <button type="submit" form="formEditGaji" class="btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </header>

        <!-- FORM KELOLA GAJI -->
        <form id="formEditGaji" action="/gr/spgjgr" method="POST" class="form-grid">
            @csrf

            <input type="hidden" value="{{$data_guru->id}}" name="id_guru">
            <!-- KELOMPOK 1: INFORMASI GURU & KEHADIRAN -->
            <section class="card col-12">
                <div class="card-header">
                    <div class="header-icon icon-info">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <div>
                        <h3>1. Informasi Guru & Kehadiran</h3>
                        <p class="subtitle">Data profil guru serta rekapitulasi presensi periode berjalan</p>
                    </div>
                </div>
                <div class="card-body grid-cols-3">
                    <input type="hidden" id="jumlahPotonganKehadiran" value="{{$jumlah_hari_aktif - $jumlah_kehadiran}}">
                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" value="{{$data_guru->nama}}" class="form-control readonly" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status Guru</label>
                        <input type="text" value="{{$data_guru->guru_honor ? 'Guru Honor' : 'Guru Tetap'}}" class="form-control readonly" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tugas / Jabatan Utama</label>
                        <input type="text" value="{{$info_jabatan}}" class="form-control readonly" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tugas Tambahan</label>
                        <input type="text" name="tgs_tambahan" value="" class="form-control" placeholder="kosongkan kalau tidak punya tugas tambahan">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Hadir (Hari)</label>
                        <div class="input-unit">
                            <input type="number" id="absenHari" value="{{$jumlah_kehadiran}}" class="form-control readonly" readonly placeholder="0">
                            <span class="unit-text">Hari</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Telat (Menit/Frekuensi)</label>
                        <div class="input-unit">
                            <input type="number" id="telatMenit" value="{{$jumlah_terlambat}}" class="form-control readonly" readonly placeholder="0">
                            <span class="unit-text">Menit</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Detail Kehadiran</label>
                        <input type="text" name="detail_kehadiran" value="{{$jumlah_kehadiran}}/{{$jumlah_hari_aktif}}" class="form-control readonly" readonly>
                    </div>
                </div>
            </section>

            <!-- KELOMPOK 2: PENDAPATAN / KAFALAH -->
            <section class="card col-8">
                <div class="card-header">
                    <div class="header-icon icon-income">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div>
                        <h3>2. Rincian Pendapatan (Kafalah)</h3>
                        <p class="subtitle">Komponen gaji pokok, honorarium, dan tunjangan reguler</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="grid-cols-3">
                        <div class="form-group">
                            <label>Kafalah Pokok</label>
                            <div class="input-currency">
                                <span>Rp</span>
                                <input type="number" name="pokok" id="kafalahPokok" value="{{(int) $data_gaji->gaji_pokok == 0 ? '' : (int) $data_gaji->gaji_pokok}}" class="form-control calc-income" placeholder="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kafalah Honor</label>
                            <div class="input-currency">
                                <span>Rp</span>
                                <input type="number" name="honor" id="kafalahHonor" value="{{(int) $data_gaji->gaji_honor == 0 ? '' : (int) $data_gaji->gaji_honor}}" class="form-control calc-income" placeholder="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kafalah Tugas Tambahan</label>
                            <div class="input-currency">
                                <span>Rp</span>
                                <input type="number" name="tugas_tambahan" id="kafalahTugasTambahan" value="{{(int) $data_gaji->tugas_tambahan == 0 ? '' : (int) $data_gaji->tugas_tambahan}}" class="form-control calc-income" placeholder="0">
                            </div>
                        </div>
                    </div>

                    <!-- DYNAMIC TUNJANGAN SECTION -->
                    <div class="dynamic-section">
                        <div class="dynamic-header">
                            <h4>Daftar Tunjangan Lainnya</h4>
                            <button type="button" id="btnAddTunjangan" class="btn-add">
                                <i class="fa-solid fa-plus"></i>
                                <span>Tambah Tunjangan</span>
                            </button>
                        </div>
                        
                        <div id="tunjanganContainer" class="dynamic-list">
                            @foreach ($data_tunjangan as $value)
                                <div class="dynamic-row">
                                    <div class="form-group flex-2">
                                        <input type="text" name="nama_tunjangan[]" value="{{$value->nama_tunjangan}}" class="form-control" placeholder="Nama Tunjangan Baru">
                                    </div>
                                    <div class="form-group flex-2">
                                        <div class="input-currency">
                                            <span>Rp</span>
                                            <input type="number" name="harga_tunjangan[]" value="{{(int) $value->nominal}}" class="form-control calc-income tunjangan-val" placeholder="0">
                                        </div>
                                    </div>
                                    <button type="button" class="btn-remove-row"><i class="fa-solid fa-trash-can"></i></button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- TOTAL KAFALAH / PENDAPATAN -->
                    <div class="total-box total-income">
                        <span>Total Pendapatan (Kafalah)</span>
                        <strong id="displayTotalPendapatan">Rp 5.700.000</strong>
                    </div>
                </div>
            </section>

            <!-- KELOMPOK 3: POTONGAN -->
            <section class="card col-4">
                <div class="card-header">
                    <div class="header-icon icon-deduction">
                        <i class="fa-solid fa-scissors"></i>
                    </div>
                    <div>
                        <h3>3. Potongan</h3>
                        <p class="subtitle">Penyesuaian keterlambatan & kasbon</p>
                        <p class="subtitle">Anda Cukup Masukkan Nominal Potongannya Saja Terekecuali Untuk Kasbon</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nominal Potongan Tidak Hadir</label>
                        <div class="input-currency">
                            <span>Rp</span>
                            <input type="number" name="tidak_hadir" id="potonganAbsen" value="40000" class="form-control calc-deduct" placeholder="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nominal Potongan Keterlambatan</label>
                        <div class="input-currency">
                            <span>Rp</span>
                            <input type="number" name="terlambat" id="potonganTelat" value="500" class="form-control calc-deduct" placeholder="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kasbon / Pinjaman</label>
                        <div class="input-currency">
                            <span>Rp</span>
                            <input type="number" name="kasbon" id="potonganKasbon" value="" class="form-control calc-deduct" placeholder="0">
                        </div>
                    </div>

                    <!-- TOTAL POTONGAN -->
                    <div class="total-box total-deduction">
                        <span>Jumlah Potongan</span>
                        <strong id="displayTotalPotongan"></strong>
                    </div>
                </div>
            </section>

            <!-- KELOMPOK 4: KAFALAH TAMBAHAN & RINGKASAN SLIP -->
            <section class="card col-7">
                <div class="card-header">
                    <div class="header-icon icon-bonus">
                        <i class="fa-solid fa-gift"></i>
                    </div>
                    <div>
                        <h3>4. Kafalah Tambahan & Reward</h3>
                        <p class="subtitle">Bonus kinerja, apresiasi, dan insentif khusus</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="grid-cols-2">
                        <div class="form-group">
                            <label>Kafalah Tambahan</label>
                            <div class="input-currency">
                                <span>Rp</span>
                                <input type="number" name="tambahan" id="kafalahTambahan" value="{{(int) $data_gaji->gaji_tambahan == 0 ? '' : (int) $data_gaji->gaji_tambahan}}" class="form-control calc-bonus" placeholder="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Reward / Bonus Kinerja</label>
                            <div class="input-currency">
                                <span>Rp</span>
                                <input type="number" name="bonus" id="rewardKafalah" value="{{(int) $data_gaji->bonus == 0 ? '' :(int) $data_gaji->bonus}}" class="form-control calc-bonus" placeholder="0">
                            </div>
                        </div>
                    </div>

                    <!-- TOTAL TAMBAHAN -->
                    <div class="total-box total-bonus">
                        <span>Jumlah Kafalah Tambahan</span>
                        <strong id="displayTotalTambahan"></strong>
                    </div>
                </div>
            </section>

            <!-- CARD RINGKASAN & SLIP AKHIR -->
            <section class="card col-5 summary-card">
                <div class="card-header">
                    <div class="header-icon icon-summary">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <div>
                        <h3>Ringkasan Slip Gaji</h3>
                        <p class="subtitle">Kalkulasi akhir penerimaan gaji guru</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="summary-list">
                        <div class="summary-item">
                            <span>Total Pendapatan Utama</span>
                            <strong id="sumPendapatan">Rp</strong>
                        </div>
                        <div class="summary-item text-success">
                            <span>Total Bonus & Reward (+)</span>
                            <strong id="sumTambahan"></strong>
                        </div>
                        <div class="summary-item text-danger">
                            <span>Total Potongan (-)</span>
                            <strong id="sumPotongan"></strong>
                        </div>
                        <hr class="summary-divider">
                        <div class="summary-grand-total">
                            <div>
                                <small>Total Gaji Diterima</small>
                                <h2 id="displayGrandTotal"></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </main>
</div>

<!-- JAVASCRIPT LOGIC -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tunjanganContainer = document.getElementById('tunjanganContainer');
    const btnAddTunjangan = document.getElementById('btnAddTunjangan');

    // Format mata uang Rupiah
    function formatRupiah(number) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
    }

    // Helper ambil nilai input number
    function getVal(id) {
        const el = document.getElementById(id);
        return el ? (parseFloat(el.value) || 0) : 0;
    }

    // 1. TAMBAH TUNJANGAN DINAMIS
    btnAddTunjangan.addEventListener('click', function() {
        const newRow = document.createElement('div');
        newRow.classList.add('dynamic-row');
        newRow.innerHTML = `
            <div class="form-group flex-2">
                <input type="text" name="nama_tunjangan[]" class="form-control" placeholder="Nama Tunjangan Baru">
            </div>
            <div class="form-group flex-2">
                <div class="input-currency">
                    <span>Rp</span>
                    <input type="number" name="harga_tunjangan[]" value="0" class="form-control calc-income tunjangan-val" placeholder="0">
                </div>
            </div>
            <button type="button" class="btn-remove-row"><i class="fa-solid fa-trash-can"></i></button>
        `;
        tunjanganContainer.appendChild(newRow);
        calculateAll();
    });

    // 2. HAPUS BARIS TUNJANGAN
    tunjanganContainer.addEventListener('click', function(e) {
        if (e.target.closest('.btn-remove-row')) {
            e.target.closest('.dynamic-row').remove();
            calculateAll();
        }
    });

    // 3. KALKULASI REAL-TIME
    function calculateAll() {
        // A. Total Pendapatan
        const pokok = getVal('kafalahPokok');
        const honor = getVal('kafalahHonor');
        const tugasTambahan = getVal('kafalahTugasTambahan');
        
        let dynamicTunjanganTotal = 0;
        document.querySelectorAll('.tunjangan-val').forEach(input => {
            dynamicTunjanganTotal += parseFloat(input.value) || 0;
        });

        const totalPendapatan = pokok + honor + tugasTambahan + dynamicTunjanganTotal;

        // B. Total Potongan
        const potAbsen = getVal('potonganAbsen') * parseInt(document.getElementById("jumlahPotonganKehadiran").value);
        const potTelat = getVal('potonganTelat') * parseInt(document.getElementById("telatMenit").value);
        const potKasbon = getVal('potonganKasbon');
        const totalPotongan = potAbsen + potTelat + potKasbon;

        // C. Total Tambahan / Reward
        const tambahan = getVal('kafalahTambahan');
        const reward = getVal('rewardKafalah');
        const totalTambahan = tambahan + reward;

        // D. Grand Total Gaji
        const grandTotal = totalPendapatan + totalTambahan - totalPotongan;

        // Update DOM Display
        document.getElementById('displayTotalPendapatan').textContent = formatRupiah(totalPendapatan);
        document.getElementById('displayTotalPotongan').textContent = formatRupiah(totalPotongan);
        document.getElementById('displayTotalTambahan').textContent = formatRupiah(totalTambahan);
        
        document.getElementById('sumPendapatan').textContent = formatRupiah(totalPendapatan);
        document.getElementById('sumTambahan').textContent = '+ ' + formatRupiah(totalTambahan);
        document.getElementById('sumPotongan').textContent = '- ' + formatRupiah(totalPotongan);
        document.getElementById('displayGrandTotal').textContent = formatRupiah(grandTotal);
    }

    // Event listener pada perubahan input
    document.getElementById('formEditGaji').addEventListener('input', function(e) {
        if (e.target.tagName === 'INPUT') {
            calculateAll();
        }
    });

    // Jalankan kalkulasi pertama kali
    calculateAll();
});
</script>

</body>
</html>