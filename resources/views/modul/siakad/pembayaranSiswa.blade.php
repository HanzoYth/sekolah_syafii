<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Slip Pembayaran</title>

    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/css/modul/guru/das_ad_gr.css')}}">
    <link rel="stylesheet" href="{{asset('/css/modul/siakad/pembayaranSiswa.css')}}">
</head>
<body>

    <div class="app-layout">

        <!-- INCLUDE SIDEBAR -->
        <x-sidebar_siakad />

        <!-- MAIN CONTENT AREA -->
        <main class="main-content">

            <header class="topbar">
                <div class="page-title">
                    <h2>Slip Pembayaran</h2>
                    <p>Riwayat & status pembayaran <strong>{{$data_siswa->nama}}</strong> &middot;{{$data_kelas->nama_ruang}}</p>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <div class="content-body">

                <!-- FLASH MESSAGES / ERROR TOAST -->
                @if(session('eror'))
                    <div class="alert alert-danger" id="errorToast">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
                            <div>
                                <p>
                                    <i class="fas fa-exclamation-circle" style="color: #e63946;"></i>
                                    {{ session('eror') }}
                                </p>
                            </div>
                            <button type="button" onclick="closeToast()" style="background:none; border:none; color: var(--text-light); cursor:pointer; font-size:1.1rem; line-height:1;">&times;</button>
                        </div>
                    </div>
                @endif

                <!-- RINGKASAN TAGIHAN -->
                <h3 class="page-section-title">Ringkasan Tagihan</h3>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon bg-info-light">
                            <i class="fa-solid fa-file-invoice text-info"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Total Tagihan</span>
                            <h3>Rp 1.000.000</h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-success-light">
                            <i class="fa-solid fa-circle-check text-success"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Sudah Dibayar</span>
                            <h3>Rp 1.000.000</h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-warning-light">
                            <i class="fa-solid fa-circle-exclamation text-warning"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Sisa Tunggakan</span>
                            <h3>Rp 0</h3>
                        </div>
                    </div>
                </div>

                {{-- Data Dummy untuk Pengujian (3 contoh per kategori, termasuk yang sudah Lunas) --}}
                @php
                    $dummy_ipp = [
                        (object)[
                            'tanggal' => '12 Feb 2026',
                            'nama_tagihan' => 'IPP Bulan Februari 2026',
                            'jenis' => 'IPP Bulanan',
                            'keterangan' => 'Pembayaran via Transfer Bank',
                            'nominal' => 500000,
                            'status' => 'lunas'
                        ],
                        (object)[
                            'tanggal' => '12 Mar 2026',
                            'nama_tagihan' => 'IPP Bulan Maret 2026',
                            'jenis' => 'IPP Bulanan',
                            'keterangan' => 'Pembayaran via Transfer Bank',
                            'nominal' => 500000,
                            'status' => 'lunas'
                        ],
                        (object)[
                            'tanggal' => '12 Apr 2026',
                            'nama_tagihan' => 'IPP Bulan April 2026',
                            'jenis' => 'IPP Bulanan',
                            'keterangan' => 'Menunggu konfirmasi pembayaran',
                            'nominal' => 500000,
                            'status' => 'belum'
                        ],
                    ];

                    $dummy_pangkal = [
                        (object)[
                            'tanggal' => '10 Jul 2025',
                            'nama_tagihan' => 'Uang Pangkal Tahun Ajaran 2025/2026',
                            'jenis' => 'Uang Pangkal',
                            'keterangan' => 'Pembayaran via Transfer Bank',
                            'nominal' => 900000,
                            'status' => 'lunas'
                        ],
                        (object)[
                            'tanggal' => '10 Jul 2026',
                            'nama_tagihan' => 'Uang Pangkal Tahun Ajaran 2026/2027',
                            'jenis' => 'Uang Pangkal',
                            'keterangan' => 'Pembayaran via Transfer Bank',
                            'nominal' => 1000000,
                            'status' => 'lunas'
                        ],
                        (object)[
                            'tanggal' => '10 Jul 2027',
                            'nama_tagihan' => 'Uang Pangkal Tahun Ajaran 2027/2028',
                            'jenis' => 'Uang Pangkal',
                            'keterangan' => 'Menunggu konfirmasi pembayaran',
                            'nominal' => 1100000,
                            'status' => 'belum'
                        ],
                    ];

                    $dummy_pendidikan = [
                        (object)[
                            'tanggal' => '05 Jan 2026',
                            'nama_tagihan' => 'Dana Pengembangan Pendidikan 2026',
                            'jenis' => 'Dana Pendidikan',
                            'keterangan' => 'Pembayaran via Transfer Bank',
                            'nominal' => 750000,
                            'status' => 'lunas'
                        ],
                        (object)[
                            'tanggal' => '05 Jan 2027',
                            'nama_tagihan' => 'Dana Pengembangan Pendidikan 2027',
                            'jenis' => 'Dana Pendidikan',
                            'keterangan' => 'Pembayaran via Transfer Bank',
                            'nominal' => 800000,
                            'status' => 'lunas'
                        ],
                        (object)[
                            'tanggal' => '05 Jan 2028',
                            'nama_tagihan' => 'Dana Pengembangan Pendidikan 2028',
                            'jenis' => 'Dana Pendidikan',
                            'keterangan' => 'Menunggu konfirmasi pembayaran',
                            'nominal' => 850000,
                            'status' => 'belum'
                        ],
                    ];

                    // Gunakan $riwayat_pembayaran dari Controller jika ada, kelompokkan per kategori berdasarkan "jenis".
                    // Kalau tidak ada / tidak ada yang cocok di suatu kategori, pakai data dummy kategori itu.
                    $riwayat_pembayaran = $riwayat_pembayaran ?? [];

                    $list_ipp = array_values(array_filter($riwayat_pembayaran, fn($item) => str_contains(strtolower($item->jenis), 'ipp')));
                    $list_ipp = count($list_ipp) > 0 ? $list_ipp : $dummy_ipp;

                    $list_pangkal = array_values(array_filter($riwayat_pembayaran, fn($item) => str_contains(strtolower($item->jenis), 'pangkal')));
                    $list_pangkal = count($list_pangkal) > 0 ? $list_pangkal : $dummy_pangkal;

                    $list_pendidikan = array_values(array_filter($riwayat_pembayaran, fn($item) => str_contains(strtolower($item->jenis), 'pendidikan')));
                    $list_pendidikan = count($list_pendidikan) > 0 ? $list_pendidikan : $dummy_pendidikan;
                @endphp

                <!-- === TAMBAHAN: 3 Kartu Riwayat Transaksi (IPP / Pangkal / Pendidikan), tersusun ke bawah === -->
                <div class="payment-columns">

                    <!-- KARTU 1: RIWAYAT IPP (dengan filter Bulan & Status) -->
                    <div class="card card-table">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-clock-rotate-left"></i> Riwayat IPP</h4>
                        </div>

                        <div class="table-filters">
                            <select id="filterBulanIpp">
                                <option value="">Semua Bulan</option>
                                <option value="Jan">Januari</option>
                                <option value="Feb">Februari</option>
                                <option value="Mar">Maret</option>
                                <option value="Apr">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Jun">Juni</option>
                                <option value="Jul">Juli</option>
                                <option value="Agu">Agustus</option>
                                <option value="Sep">September</option>
                                <option value="Okt">Oktober</option>
                                <option value="Nov">November</option>
                                <option value="Des">Desember</option>
                            </select>
                            <select id="filterStatusIpp">
                                <option value="">Semua Status</option>
                                <option value="lunas">Lunas</option>
                                <option value="belum">Belum Lunas</option>
                            </select>
                        </div>

                        @if (count($list_ipp) > 0)
                            <div class="table-wrap">
                                <table class="payment-table" id="tableIpp">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Tagihan</th>
                                            <th>Jenis Pembayaran</th>
                                            <th class="text-right">Nominal</th>
                                            <th>Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list_ipp as $item)
                                            <tr data-bulan="{{ explode(' ', $item->tanggal)[1] ?? '' }}" data-status="{{ $item->status === 'lunas' ? 'lunas' : 'belum' }}">
                                                <td>{{ $item->tanggal }}</td>
                                                <td><strong>{{ $item->nama_tagihan }}</strong></td>
                                                <td>
                                                    <div class="cell-jenis">
                                                        <span>{{ $item->jenis }}</span>
                                                        @if(!empty($item->keterangan))
                                                            <span class="sub">{{ $item->keterangan }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-right cell-nominal">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                                <td>
                                                    @if ($item->status === 'lunas')
                                                        <span class="badge-status badge-lunas">
                                                            <i class="fa-solid fa-circle"></i> Lunas
                                                        </span>
                                                    @else
                                                        <span class="badge-status badge-belum">
                                                            <i class="fa-solid fa-circle"></i> Belum Lunas
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="/sk/dsp" class="btn-action-download" title="Download File">
                                                        <i class="fa-solid fa-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="table-empty">
                                <i class="fa-solid fa-receipt"></i>
                                <p>Belum ada riwayat transaksi IPP.</p>
                            </div>
                        @endif
                    </div>

                    <!-- KARTU 2: RIWAYAT PANGKAL -->
                    <div class="card card-table">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Pangkal</h4>
                        </div>

                        @if (count($list_pangkal) > 0)
                            <div class="table-wrap">
                                <table class="payment-table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Tagihan</th>
                                            <th>Jenis Pembayaran</th>
                                            <th class="text-right">Nominal</th>
                                            <th>Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list_pangkal as $item)
                                            <tr>
                                                <td>{{ $item->tanggal }}</td>
                                                <td><strong>{{ $item->nama_tagihan }}</strong></td>
                                                <td>
                                                    <div class="cell-jenis">
                                                        <span>{{ $item->jenis }}</span>
                                                        @if(!empty($item->keterangan))
                                                            <span class="sub">{{ $item->keterangan }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-right cell-nominal">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                                <td>
                                                    @if ($item->status === 'lunas')
                                                        <span class="badge-status badge-lunas">
                                                            <i class="fa-solid fa-circle"></i> Lunas
                                                        </span>
                                                    @else
                                                        <span class="badge-status badge-belum">
                                                            <i class="fa-solid fa-circle"></i> Belum Lunas
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="/sk/dsp" class="btn-action-download" title="Download File">
                                                        <i class="fa-solid fa-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="table-empty">
                                <i class="fa-solid fa-receipt"></i>
                                <p>Belum ada riwayat transaksi Pangkal.</p>
                            </div>
                        @endif
                    </div>

                    <!-- KARTU 3: RIWAYAT PENDIDIKAN -->
                    <div class="card card-table">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Pendidikan</h4>
                        </div>

                        @if (count($list_pendidikan) > 0)
                            <div class="table-wrap">
                                <table class="payment-table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Tagihan</th>
                                            <th>Jenis Pembayaran</th>
                                            <th class="text-right">Nominal</th>
                                            <th>Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list_pendidikan as $item)
                                            <tr>
                                                <td>{{ $item->tanggal }}</td>
                                                <td><strong>{{ $item->nama_tagihan }}</strong></td>
                                                <td>
                                                    <div class="cell-jenis">
                                                        <span>{{ $item->jenis }}</span>
                                                        @if(!empty($item->keterangan))
                                                            <span class="sub">{{ $item->keterangan }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-right cell-nominal">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                                <td>
                                                    @if ($item->status === 'lunas')
                                                        <span class="badge-status badge-lunas">
                                                            <i class="fa-solid fa-circle"></i> Lunas
                                                        </span>
                                                    @else
                                                        <span class="badge-status badge-belum">
                                                            <i class="fa-solid fa-circle"></i> Belum Lunas
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="/sk/dsp" class="btn-action-download" title="Download File">
                                                        <i class="fa-solid fa-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="table-empty">
                                <i class="fa-solid fa-receipt"></i>
                                <p>Belum ada riwayat transaksi Pendidikan.</p>
                            </div>
                        @endif
                    </div>

                </div>
                <!-- === /TAMBAHAN === -->

            </div>
        </main>
    </div>
<x-chatbot />
    <script>
        function closeToast() {
            const toast = document.getElementById('errorToast');
            if (toast) {
                toast.classList.add('fade-out');
                setTimeout(() => {
                    toast.remove();
                }, 400);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('errorToast');
            if (toast) {
                setTimeout(() => {
                    closeToast();
                }, 5000);
            }
        });

        // === TAMBAHAN: Filter Bulan & Status khusus tabel Riwayat IPP ===
        const filterBulanIpp = document.getElementById('filterBulanIpp');
        const filterStatusIpp = document.getElementById('filterStatusIpp');
        const tableIpp = document.getElementById('tableIpp');

        function terapkanFilterIpp() {
            if (!tableIpp) return;
            const bulan = filterBulanIpp.value;
            const status = filterStatusIpp.value;

            tableIpp.querySelectorAll('tbody tr').forEach(row => {
                const cocokBulan = !bulan || row.dataset.bulan === bulan;
                const cocokStatus = !status || row.dataset.status === status;
                row.style.display = (cocokBulan && cocokStatus) ? '' : 'none';
            });
        }

        if (filterBulanIpp && filterStatusIpp) {
            filterBulanIpp.addEventListener('change', terapkanFilterIpp);
            filterStatusIpp.addEventListener('change', terapkanFilterIpp);
        }
        // === /TAMBAHAN ===
    </script>
</body>
</html>