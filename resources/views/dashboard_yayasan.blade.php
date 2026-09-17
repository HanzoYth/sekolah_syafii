<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SIAKAD</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard_yayasan.css') }}?v={{ time() }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
</head>
<body>

    <main class="dashboard-app">
        <div class="dashboard-shell">

            <!-- Header -->
            <div class="page-header">
                <div>
                    <span class="eyebrow">Dashboard</span>
                    <h1>Ringkasan SIAKAD</h1>
                    <p>Pantau performa guru, siswa, dan keuangan yayasan.</p>
                </div>
                <div class="header-badge">
                    <i class="fa-solid fa-calendar-day"></i>
                    <span id="todayDate">--</span>
                </div>
            </div>

            <!-- Stat Guru & Siswa -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon icon-blue"><i class="fa-solid fa-chalkboard-user"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Guru Aktif</span>
                        <h2 class="stat-value">{{$total_guru}}</h2>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-purple"><i class="fa-solid fa-user-graduate"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Siswa</span>
                        <h2 class="stat-value">{{$total_siswa}}</h2>
                    </div>
                </div>
            </div>

            <!-- Keuangan -->
            <div class="finance-section">
                <div class="finance-hero">
                    <div>
                        <span class="finance-hero-label"><i class="fa-solid fa-wallet"></i> Total Pendapatan</span>
                        <h2 class="finance-hero-value">Rp {{number_format($total_bayar,0,",",".")}}</h2>
                        <span class="finance-hero-sub">Akumulasi periode berjalan</span>
                    </div>
                </div>

                <div class="debt-grid">
                    <div class="debt-card">
                        <div class="debt-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                        <span class="debt-label">Tunggakan IPP</span>
                        <span class="debt-value">Rp {{number_format($jumlah_tunggakan_ipp,0,",",".")}}</span>
                    </div>
                    <div class="debt-card">
                        <div class="debt-icon"><i class="fa-solid fa-building-columns"></i></div>
                        <span class="debt-label">Tunggakan Pangkal</span>
                        <span class="debt-value">Rp {{number_format($jumlah_tunggakan_pangkal,0,",",".")}}</span>
                    </div>
                    <div class="debt-card">
                        <div class="debt-icon"><i class="fa-solid fa-book"></i></div>
                        <span class="debt-label">Tunggakan Pendidikan</span>
                        <span class="debt-value">Rp {{number_format($jumlah_tunggakan_pendidikan,0,",",".")}}</span>
                    </div>
                    <div class="debt-card">
                        <div class="debt-icon"><i class="fa-solid fa-broom"></i></div>
                        <span class="debt-label">Tunggakan Pemeliharaan</span>
                        <span class="debt-value">Rp 900.000</span>
                    </div>
                </div>
            </div>

            <!-- Grafik -->
            <div class="chart-section">

                <!-- Grafik Pendapatan -->
                <div class="chart-card">
                    <div class="chart-card-header">
                        <div class="chart-title">
                            <i class="fa-solid fa-chart-line"></i>
                            <div>
                                <h3>Grafik Pendapatan</h3>
                                <span>Tren pemasukan yayasan</span>
                            </div>
                        </div>
                        <div class="chart-controls" data-chart-group="pendapatan">
                            <div class="period-switch">
                                <button type="button" class="period-btn active" data-period="mingguan">Mingguan</button>
                                <button type="button" class="period-btn" data-period="bulanan">Bulanan</button>
                            </div>
                            <input type="date" class="chart-date-input" data-period-input="mingguan">
                            <input type="month" class="chart-date-input hide" data-period-input="bulanan">
                        </div>
                    </div>

                    <div class="chart-summary">
                        <span class="chip">Total periode: <strong class="chart-total">Rp 0</strong></span>
                        <span class="chip">Rata-rata: <strong class="chart-avg">Rp 0</strong></span>
                    </div>

                    <div class="chart-canvas-wrap">
                        <canvas id="chartPendapatan"></canvas>
                    </div>
                </div>

                <!-- Grafik Tunggakan -->
                <div class="chart-card">
                    <div class="chart-card-header">
                        <div class="chart-title">
                            <i class="fa-solid fa-chart-column"></i>
                            <div>
                                <h3>Grafik Tunggakan</h3>
                                <span>Tren tunggakan pembayaran</span>
                            </div>
                        </div>
                        <div class="chart-controls" data-chart-group="tunggakan">
                            <div class="period-switch">
                                <button type="button" class="period-btn active" data-period="mingguan">Mingguan</button>
                                <button type="button" class="period-btn" data-period="bulanan">Bulanan</button>
                            </div>
                            <input type="date" class="chart-date-input" data-period-input="mingguan">
                            <input type="month" class="chart-date-input hide" data-period-input="bulanan">
                        </div>
                    </div>

                    <div class="chart-summary">
                        <span class="chip">Total periode: <strong class="chart-total">Rp 0</strong></span>
                        <span class="chip">Rata-rata: <strong class="chart-avg">Rp 0</strong></span>
                    </div>

                    <div class="chart-canvas-wrap">
                        <canvas id="chartTunggakan"></canvas>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <script src="{{ asset('js/dashboard_yayasan.js') }}?v={{ time() }}"></script>
</body>
</html>