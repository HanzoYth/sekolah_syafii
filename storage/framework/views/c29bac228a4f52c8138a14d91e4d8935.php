<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Keterlambatan Guru - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #064e3b;
            --primary-hover: #022c22;
            --primary-light: #d1fae5;
            --bg-main: #f4f7f6;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --success-color: #059669;
            --danger-color: #dc2626;
            --radius-md: 10px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --transition: all 0.25s ease-in-out;
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* STRUKTUR UTAMA LAYOUT (AGAR SIDEBAR & KONTEN AMAN) */
        .app-layout {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

        /* Kustomisasi / Penjaga Posisi Sidebar Laravel Component */
        .app-layout > x-sidebar_guru, 
        .app-layout aside {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        /* Konten Utama Menggeser Margin Sesuai Lebar Sidebar */
        .dashboard-container {
            flex: 1;
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            display: flex;
            justify-content: center;
        }

        .main-wrapper {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 24px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .topbar h2 {
            font-size: 1.5rem;
            font-weight: 700;
        }
        .topbar p {
            color: var(--text-muted);
            font-size: 0.88rem;
            margin-top: 2px;
        }

        /* Filter Panel & Tab */
        .filter-card {
            background-color: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            padding: 20px 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            box-shadow: var(--shadow-sm);
        }

        .tab-group {
            display: flex;
            gap: 8px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 12px;
            flex-wrap: wrap;
        }

        .btn-tab {
            background: #f1f5f9;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--text-muted);
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-tab.active {
            background-color: var(--primary-color);
            color: #ffffff;
        }

        /* Sub Filter Dinamis */
        .sub-filter-container {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-control {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.88rem;
            outline: none;
            background: #fff;
            color: var(--text-main);
        }

        .sub-filter-group {
            display: none;
        }
        .sub-filter-group.active {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        /* Tabel Data */
        .card {
            background-color: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .table-custom {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.9rem;
        }

        .table-custom th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-weight: 600;
            padding: 14px 18px;
            border-bottom: 2px solid var(--border-color);
            white-space: nowrap;
        }

        .table-custom td {
            padding: 14px 18px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Badge & Indicators */
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 700;
        }
        .badge-success { background-color: #d1fae5; color: #047857; }
        .badge-danger { background-color: #fee2e2; color: #b91c1c; }

        .bool-badge {
            font-weight: 600;
            font-size: 0.85rem;
        }
        .bool-true { color: #059669; }
        .bool-false { color: #64748b; }

        /* Responsif untuk Mobile */
        @media(max-width: 768px) {
            .app-layout > x-sidebar_guru, 
            .app-layout aside {
                transform: translateX(-100%);
            }
            .dashboard-container {
                margin-left: 0;
                width: 100%;
            }
            .main-wrapper {
                padding: 16px 12px;
            }
        }
    </style>
</head>
<body>

<!-- PEMBUNGKUS UTAMA (MENJAGA POSISI SIDEBAR & KONTEN TERPISAH) -->
<div class="app-layout">

    <!-- KOMPONEN SIDEBAR GURU -->
    <?php if (isset($component)) { $__componentOriginale234f8d1d87fff37708f17b59eb20f90 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale234f8d1d87fff37708f17b59eb20f90 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar_guru','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar_guru'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale234f8d1d87fff37708f17b59eb20f90)): ?>
<?php $attributes = $__attributesOriginale234f8d1d87fff37708f17b59eb20f90; ?>
<?php unset($__attributesOriginale234f8d1d87fff37708f17b59eb20f90); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale234f8d1d87fff37708f17b59eb20f90)): ?>
<?php $component = $__componentOriginale234f8d1d87fff37708f17b59eb20f90; ?>
<?php unset($__componentOriginale234f8d1d87fff37708f17b59eb20f90); ?>
<?php endif; ?>

    <!-- KONTEN UTAMA DASHBOARD -->
    <div class="dashboard-container">
        <main class="main-wrapper">
            
            <header class="topbar">
                <h2>Daftar Keterlambatan & Kehadiran Guru</h2>
                <p>Monitor status kehadiran, durasi keterlambatan, dan status piket aktif pengajar</p>
            </header>

            <!-- Panel Filter Utama & Sub-Filter Dinamis -->
            <div class="filter-card">
                <!-- Pilihan Utama -->
                <div class="tab-group" id="mainTabGroup">
                    <button type="button" class="btn-tab active" onclick="switchMainTab('semua', this)">Lihat Semua</button>
                    <button type="button" class="btn-tab" onclick="switchMainTab('terlambat', this)">Terlambat</button>
                    <button type="button" class="btn-tab" onclick="switchMainTab('tepat', this)">Tepat Waktu</button>
                </div>

                <!-- Sub Pilihan (Per Bulan / Per Hari) yang muncul otomatis -->
                <div class="sub-filter-container">
                    <!-- Sub-filter untuk Lihat Semua -->
                    <div id="sub-semua" class="sub-filter-group active">
                        <select class="filter-control" onchange="filterData()">
                            <option value="all">-- Semua Periode (Semua) --</option>
                            <option value="bulan">Filter Berdasarkan Bulan</option>
                            <option value="hari">Filter Berdasarkan Hari</option>
                        </select>
                        <input type="month" class="filter-control" id="inputBulanSemua">
                    </div>

                    <!-- Sub-filter untuk Terlambat -->
                    <div id="sub-terlambat" class="sub-filter-group">
                        <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted);">Tampilkan Terlambat:</span>
                        <select class="filter-control" id="selectTerlambatMode" onchange="toggleSubMode('terlambat')">
                            <option value="bulan">Per Bulan</option>
                            <option value="hari">Per Hari</option>
                        </select>
                        <input type="month" class="filter-control" id="terlambatBulanInput">
                        <input type="date" class="filter-control" id="terlambatHariInput" style="display:none;">
                    </div>

                    <!-- Sub-filter untuk Tepat Waktu -->
                    <div id="sub-tepat" class="sub-filter-group">
                        <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted);">Tampilkan Tepat Waktu:</span>
                        <select class="filter-control" id="selectTepatMode" onchange="toggleSubMode('tepat')">
                            <option value="bulan">Per Bulan</option>
                            <option value="hari">Per Hari</option>
                        </select>
                        <input type="month" class="filter-control" id="tepatBulanInput">
                        <input type="date" class="filter-control" id="tepatHariInput" style="display:none;">
                    </div>
                </div>
            </div>

            <!-- Tabel Data Keterlambatan -->
            <div class="card">
                <div class="table-responsive">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Nama Guru</th>
                                <th>Jam Masuk</th>
                                <th>Piket Aktif</th>
                                <th>Keterlambatan (Menit)</th>
                                <th>Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr data-status="terlambat">
                                <td style="font-weight: 600;">Ahmad Fauzi, S.Pd</td>
                                <td>07:25 WIB</td>
                                <td><span class="bool-badge bool-true">True</span></td>
                                <td><span style="color: var(--danger-color); font-weight: 700;">25 Menit</span></td>
                                <td><span class="badge badge-danger">Terlambat</span></td>
                            </tr>
                            <tr data-status="tepat">
                                <td style="font-weight: 600;">Siti Aminah, M.Pd</td>
                                <td>06:50 WIB</td>
                                <td><span class="bool-badge bool-false">False</span></td>
                                <td>0 Menit</td>
                                <td><span class="badge badge-success">Tepat Waktu</span></td>
                            </tr>
                            <tr data-status="terlambat">
                                <td style="font-weight: 600;">Budi Santoso, S.Kom</td>
                                <td>07:15 WIB</td>
                                <td><span class="bool-badge bool-true">True</span></td>
                                <td><span style="color: var(--danger-color); font-weight: 700;">15 Menit</span></td>
                                <td><span class="badge badge-danger">Terlambat</span></td>
                            </tr>
                            <tr data-status="tepat">
                                <td style="font-weight: 600;">Dewi Lestari, S.Pd</td>
                                <td>06:45 WIB</td>
                                <td><span class="bool-badge bool-true">True</span></td>
                                <td>0 Menit</td>
                                <td><span class="badge badge-success">Tepat Waktu</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

</div>

<!-- JavaScript Interaktif -->
<script>
    function switchMainTab(type, buttonElement) {
        document.querySelectorAll('.btn-tab').forEach(btn => btn.classList.remove('active'));
        buttonElement.classList.add('active');

        document.querySelectorAll('.sub-filter-group').forEach(group => group.classList.remove('active'));

        if (type === 'semua') {
            document.getElementById('sub-semua').classList.add('active');
            filterTableRows('all');
        } else if (type === 'terlambat') {
            document.getElementById('sub-terlambat').classList.add('active');
            filterTableRows('terlambat');
        } else if (type === 'tepat') {
            document.getElementById('sub-tepat').classList.add('active');
            filterTableRows('tepat');
        }
    }

    function toggleSubMode(category) {
        if (category === 'terlambat') {
            let mode = document.getElementById('selectTerlambatMode').value;
            if (mode === 'bulan') {
                document.getElementById('terlambatBulanInput').style.display = 'block';
                document.getElementById('terlambatHariInput').style.display = 'none';
            } else {
                document.getElementById('terlambatBulanInput').style.display = 'none';
                document.getElementById('terlambatHariInput').style.display = 'block';
            }
        } else if (category === 'tepat') {
            let mode = document.getElementById('selectTepatMode').value;
            if (mode === 'bulan') {
                document.getElementById('tepatBulanInput').style.display = 'block';
                document.getElementById('tepatHariInput').style.display = 'none';
            } else {
                document.getElementById('tepatBulanInput').style.display = 'none';
                document.getElementById('tepatHariInput').style.display = 'block';
            }
        }
    }

    function filterTableRows(status) {
        let rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            let rowStatus = row.getAttribute('data-status');
            if (status === 'all' || rowStatus === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function filterData() {
        console.log("Filter diperbarui");
    }
</script>

</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/guru/g/leaderboardGuru.blade.php ENDPATH**/ ?>