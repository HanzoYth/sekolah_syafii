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
                    <p>Riwayat & status pembayaran <strong>Rafly</strong> &middot; Kelas 1A</p>
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

                <!-- TABEL RIWAYAT TRANSAKSI -->
                <div class="card card-table">
                    <div class="card-header">
                        <h4><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Transaksi</h4>
                    </div>

                    {{-- Data Dummy untuk Pengujian --}}
                    @php
                        $riwayat_dummy = [
                            (object)[
                                'tanggal' => '12 Feb 2026',
                                'nama_tagihan' => 'SPP Bulan Februari 2026',
                                'jenis' => 'SPP Bulanan',
                                'keterangan' => 'Pembayaran via Transfer Bank',
                                'nominal' => 500000,
                                'status' => 'lunas'
                            ],
                        ];

                        // Gunakan $riwayat_pembayaran jika dikirim dari Controller, jika tidak ada pakai $riwayat_dummy
                        $list_pembayaran = (isset($riwayat_pembayaran) && count($riwayat_pembayaran) > 0) ? $riwayat_pembayaran : $riwayat_dummy;
                    @endphp

                    @if (count($list_pembayaran) > 0)
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
                                    @foreach ($list_pembayaran as $item)
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
                                                <a href="/sk/dsp" class="btn-action-view" title="Lihat Detail / Cetak">
                                                    <i class="fa-solid fa-eye"></i>
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
                            <p>Belum ada riwayat transaksi pembayaran.</p>
                        </div>
                    @endif
                </div>

            </div>
        </main>
    </div>

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
    </script>
</body>
</html>