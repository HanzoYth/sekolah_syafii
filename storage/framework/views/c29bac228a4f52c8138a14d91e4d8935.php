<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Keterlambatan Staf - EduHRIS</title>

    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/guru/leaderboard.css')); ?>?v=<?php echo e(time()); ?>">

    <!-- CSRF Token Laravel -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>

<body>

    <!-- PEMBUNGKUS UTAMA -->
    <div class="app-layout">

        <!-- SIDEBAR GURU -->
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

        <!-- KONTEN UTAMA -->
        <div class="dashboard-container">

            <main class="main-wrapper">

                <header class="topbar">
                    <h2>Daftar Keterlambatan Staf(guru,bendahara,operator)</h2>
                    <p>Monitor status keterlambatan dan durasi keterlambatan pengajar</p>
                </header>

                <!-- PANEL FILTER -->
                <div class="filter-card">

                    <!-- PILIHAN UTAMA (Hanya Terlambat) -->
                    <div class="tab-group" id="mainTabGroup">
                        <button
                            type="button"
                            class="btn-tab active"
                            style="width: 100%; cursor: default;">
                            Daftar Terlambat Guru
                        </button>
                    </div>

                    <!-- SUB FILTER -->
                    <div class="sub-filter-container">

                        <!-- FILTER TERLAMBAT -->
                        <div id="sub-terlambat" class="sub-filter-group active">

                            <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted);">
                                Tampilkan Mode:
                            </span>

                            <select
                                class="filter-control"
                                id="selectTerlambatMode"
                                onchange="toggleSubMode()">

                                <option value="bulan">Per Bulan</option>
                                <option value="hari">Per Hari</option>

                            </select>

                            <input
                                type="month"
                                class="filter-control"
                                id="terlambatBulanInput"
                                onchange="fetchData()">

                            <input
                                type="date"
                                class="filter-control"
                                id="terlambatHariInput"
                                style="display:none;"
                                onchange="fetchData()">

                        </div>

                    </div>
                </div>

                <!-- TABEL DATA KETERLAMBATAN -->
                <div class="card">

                    <div class="table-responsive">

                        <table class="table-custom">

                            <thead>
                                <tr>
                                    <th>Nama Guru</th>
                                    <!-- Kolom Jam Masuk & Piket Aktif disembunyikan via JS jika mode = bulan -->
                                    <th id="thJamMasuk">Jam Masuk</th>
                                    <th id="thPiketAktif">Piket Aktif</th>
                                    <th>Keterlambatan (Menit)</th>
                                </tr>
                            </thead>

                            <tbody id="tableBody">
                                <!-- Data dimuat melalui JavaScript -->
                            </tbody>

                        </table>

                    </div>

                </div>

            </main>

        </div>

    </div>


    <!-- JAVASCRIPT FETCH API -->
    <script>

        // Status selalu 'terlambat'
        let currentStatus = 'terlambat';

        document.addEventListener('DOMContentLoaded', function () {
            // Fetch awal ketika halaman dimuat
            fetchData();
        });


        // TOGGLE FILTER PER BULAN / PER HARI
        function toggleSubMode() {
            const mode = document.getElementById('selectTerlambatMode').value;
            const inputBulan = document.getElementById('terlambatBulanInput');
            const inputHari = document.getElementById('terlambatHariInput');

            if (mode === 'bulan') {
                inputBulan.style.display = 'inline-block';
                inputHari.style.display = 'none';
            } else {
                inputBulan.style.display = 'none';
                inputHari.style.display = 'inline-block';
            }

            fetchData();
        }


        // FUNGSI MENDAPATKAN MODE AKTIF (BULAN / HARI)
        function getCurrentMode() {
            return document.getElementById('selectTerlambatMode').value;
        }


        // FUNGSI FETCH DATA
        function fetchData() {
            let mode = getCurrentMode();
            let tanggalNilai = '';

            if (mode === 'bulan') {
                tanggalNilai = document.getElementById('terlambatBulanInput').value;
            } else {
                tanggalNilai = document.getElementById('terlambatHariInput').value;
            }

            // Atur visibilitas kolom Jam Masuk & Piket Aktif pada Header Tabel
            const thJamMasuk = document.getElementById('thJamMasuk');
            const thPiketAktif = document.getElementById('thPiketAktif');
            
            // Jika mode = hari, kolom total jadi 4. Jika bulan, kolom total jadi 2 (Nama & Keterlambatan)
            const colspanVal = (mode === 'hari') ? 4 : 2;

            if (mode === 'bulan') {
                thJamMasuk.style.display = 'none';
                thPiketAktif.style.display = 'none';
            } else {
                thJamMasuk.style.display = '';
                thPiketAktif.style.display = '';
            }

            // Loading state
            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = `
                <tr>
                    <td colspan="${colspanVal}" style="text-align: center; padding: 2rem;">
                        <i class="fa-solid fa-spinner fa-spin fa-2x" style="color: var(--primary-color, #4f46e5);"></i>
                        <p style="margin-top: 0.5rem; color: #6b7280;">Mengambil data...</p>
                    </td>
                </tr>
            `;

            // Query Parameter
            const params = new URLSearchParams({
                status: currentStatus,
                mode: mode,
                val: tanggalNilai
            });

            // Fetch HTTP GET
            fetch(`/gr/khdspgr?${params.toString()}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With':                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data dari server');
                }
                return response.json();
            })
            .then(data => {
                renderTable(data, mode);
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="${colspanVal}" style="text-align: center; color: red; padding: 1.5rem;">
                            Terjadi kesalahan saat memuat data.
                        </td>
                    </tr>
                `;
            });
        }


        // RENDER HTML TABLE
        function renderTable(data, mode) {
            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';

            const colspanVal = (mode === 'hari') ? 4 : 2;

            if (!data || !data.data_guru || data.data_guru.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="${colspanVal}" style="text-align: center; color: #9ca3af; padding: 1.5rem;">
                            Tidak ada data keterlambatan yang ditemukan.
                        </td>
                    </tr>
                `;
                return;
            }
            console.log(data.data_absen.filter(i => i.id == 2));
            data.data_guru.forEach(item => {
                const boolBadgeClass = item.piket ? 'bool-true' : 'bool-false';
                const boolText = item.piket ? 'True' : 'False';
                
                const keterlambatanHTML = `<span style="color: var(--danger-color, #ef4444); font-weight: 700;">${data.data_absen.filter(i => i.id == item.id).terlambat} Menit</span>`;

                // Jika mode hari, tampilkan Jam Masuk & Piket Aktif. Jika bulan, dikosongkan.
                let tambahanTD = '';
                if (mode === 'hari') {
                    let absenMatch = data.data_absen ? data.data_absen.filter(i => i === item.id) : '-';
                    tambahanTD = `
                        <td>${absenMatch}</td>
                        <td>
                            <span class="bool-badge ${boolBadgeClass}">
                                ${boolText}
                            </span>
                        </td>
                    `;
                }

                const row = `
                    <tr>
                        <td style="font-weight: 600;">
                            ${item.nama}
                        </td>
                        ${tambahanTD}
                        <td>
                            ${keterlambatanHTML}
                        </td>
                    </tr>
                `;

                tbody.insertAdjacentHTML('beforeend', row);
            });
        }

    </script>

</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/guru/g/leaderboardGuru.blade.php ENDPATH**/ ?>