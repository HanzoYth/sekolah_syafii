<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembayaran & Pembayaran Manual - SIAKAD</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome Icons --}}
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pemeliharaan.css') }}?v={{ time() }}">
    <style>
        .badge-ipp { background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
        .badge-pangkal { background-color: #f3e8ff; color: #7e22ce; border: 1px solid #e9d5ff; }
        .badge-pendidikan { background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }
        .badge.warning { background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
        .badge-type {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* UNIFORM INPUT & DATE STYLING (MENYESUAIKAN DENGAN INPUT UMUM) */
        .filter-group .input-wrap {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .filter-group .input-wrap label {
            font-size: 0.82rem;
            font-weight: 600;
            color: #334155;
            letter-spacing: -0.01em;
        }
        .filter-group .input-wrap input[type="search"],
        .filter-group .input-wrap input[type="date"],
        .filter-group .input-wrap input[type="month"],
        .filter-group .input-wrap input[type="text"],
        .filter-group .input-wrap select,
        .input-wrap input[type="date"],
        .input-wrap input[type="month"],
        .input-wrap input[type="search"],
        .input-wrap select {
            width: 100% !important;
            height: 42px !important;
            padding: 9px 14px !important;
            border: 1px solid #cfddd6 !important;
            border-radius: 8px !important;
            background-color: #ffffff !important;
            color: #1e293b !important;
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
            font-size: 0.875rem !important;
            font-weight: 400 !important;
            line-height: 1.4 !important;
            outline: none !important;
            box-sizing: border-box !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03) !important;
            transition: all 0.2s ease-in-out !important;
        }

        .filter-group .input-wrap input[type="date"],
        .input-wrap input[type="date"] {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
        }

        .filter-group .input-wrap input[type="date"]::-webkit-calendar-picker-indicator,
        .input-wrap input[type="date"]::-webkit-calendar-picker-indicator,
        .modal-field input[type="date"]::-webkit-calendar-picker-indicator,
        .modal-field input[type="month"]::-webkit-calendar-picker-indicator {
            cursor: pointer !important;
            opacity: 0.75 !important;
            filter: invert(0.3) sepia(0.8) saturate(3) hue-rotate(115deg) !important;
            padding: 3px !important;
            margin-left: 6px !important;
            transition: transform 0.2s ease, opacity 0.2s ease !important;
        }

        .filter-group .input-wrap input[type="date"]::-webkit-calendar-picker-indicator:hover,
        .input-wrap input[type="date"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1 !important;
            transform: scale(1.15) !important;
        }

        .filter-group .input-wrap input[type="search"]:focus,
        .filter-group .input-wrap input[type="date"]:focus,
        .filter-group .input-wrap select:focus,
        .input-wrap input[type="search"]:focus,
        .input-wrap input[type="date"]:focus,
        .input-wrap select:focus {
            border-color: #059669 !important;
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.12) !important;
            background-color: #ffffff !important;
        }

        .header-actions-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }
        .btn-primary-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(4, 120, 87, 0.2);
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-primary-action:hover {
            background: linear-gradient(135deg, #047857 0%, #065f46 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(4, 120, 87, 0.3);
            color: #ffffff;
        }
        .btn-secondary-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: #ffffff;
            color: #1e293b;
            font-size: 0.88rem;
            font-weight: 600;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-secondary-action:hover {
            background: #f8fafc;
            border-color: #94a3b8;
            color: #0f172a;
        }
        .alert-floating {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.92rem;
            animation: fadeIn 0.3s ease;
        }
        .alert-floating.success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .alert-floating.error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .manual-banner-info {
            background: linear-gradient(to right, #f8fafc, #f1f5f9);
            border-left: 4px solid #059669;
            padding: 12px 16px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 20px;
            font-size: 0.86rem;
            color: #334155;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
        .receipt-modal-preview {
            background: #ffffff;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            padding: 16px;
            margin-top: 10px;
        }
        .receipt-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.88rem;
        }
        .receipt-row:last-child {
            border-bottom: none;
        }

        /* ================= INVOICE PRINTABLE PAPER STYLING ================= */
        .invoice-paper {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px 28px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
            color: #0f172a;
            font-size: 0.9rem;
            position: relative;
        }
        .invoice-kop {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-bottom: 12px;
            border-bottom: 3px double #0f172a;
            margin-bottom: 16px;
        }
        .invoice-logo {
            width: 68px;
            height: 68px;
            object-fit: contain;
            flex-shrink: 0;
        }
        .invoice-kop-text {
            flex: 1;
            text-align: center;
        }
        .invoice-kop-text h2 {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #065f46;
            letter-spacing: 0.5px;
        }
        .invoice-kop-text h3 {
            margin: 2px 0 0 0;
            font-size: 0.98rem;
            font-weight: 700;
            color: #1e293b;
        }
        .invoice-kop-text p {
            margin: 4px 0 0 0;
            font-size: 0.76rem;
            color: #475569;
            line-height: 1.35;
        }
        .invoice-grid-bio {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px 20px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 16px;
            font-size: 0.86rem;
        }
        .invoice-bio-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .invoice-bio-label {
            width: 105px;
            color: #64748b;
            flex-shrink: 0;
            font-weight: 500;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
            font-size: 0.875rem;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #cbd5e1;
            padding: 8px 12px;
        }
        .invoice-table thead th {
            background-color: #f1f5f9;
            font-weight: 700;
            color: #1e293b;
            text-transform: uppercase;
            font-size: 0.78rem;
            letter-spacing: 0.02em;
        }
        .invoice-terbilang-box {
            background: #f8fafc;
            border-left: 4px solid #059669;
            padding: 10px 14px;
            border-radius: 0 6px 6px 0;
            margin-bottom: 16px;
            font-size: 0.84rem;
        }
        .invoice-ttd-container {
            display: flex;
            justify-content: space-between;
            margin-top: 24px;
            padding-top: 10px;
            font-size: 0.86rem;
        }
        .invoice-ttd-box {
            text-align: center;
            width: 220px;
        }
        .invoice-ttd-space {
            height: 60px;
        }

        /* PRINT STYLING KHUSUS */
        @media print {
            body * {
                visibility: hidden !important;
            }
            #invoicePrintArea, #invoicePrintArea * {
                visibility: visible !important;
            }
            #invoicePrintArea {
                position: fixed !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 12mm 16mm !important;
                background: #ffffff !important;
                border: none !important;
                box-shadow: none !important;
                z-index: 9999999 !important;
            }
            .modal-card {
                box-shadow: none !important;
                border: none !important;
                max-width: 100% !important;
            }
            .no-print,
            .btn-close-modal,
            .modal-footer,
            .modal-header,
            .topbar,
            .sidebar,
            #sidebar,
            .main-content,
            .dashboard-container,
            .filter-box,
            .table-card {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="dashboard-container maintenance-page">

        {{-- WADAH TEMPLATE SIDEBAR --}}
        <x-sidebar_siakad />

        {{-- MAIN CONTENT --}}
        <main class="main-content">
            <x-siakad.topbar title="Riwayat Pembayaran & Input Manual" description="Kelola riwayat transaksi keuangan santri, penelusuran audit, dan pencatatan pembayaran manual." position="{{ session('role') === 'a' ? 'Administrator Keuangan' : 'Bendahara Sekolah' }}" initials="RP" />

            {{-- ALERT NOTIFIKASI --}}
            @if(session('success'))
                <div class="alert-floating success">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                    <div style="flex: 1;"><strong>Berhasil:</strong> {{ session('success') }}</div>
                    <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: inherit;"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-floating error">
                    <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                    <div style="flex: 1;"><strong>Perhatian:</strong> {{ session('error') }}</div>
                    <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: inherit;"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            {{-- HEADER BAR DENGAN TOMBOL AKSI CEPAT --}}
            <div class="header-actions-bar">
                <div class="manual-banner-info" style="flex: 1; margin-bottom: 0;">
                    <div>
                        <i class="fa-solid fa-circle-info text-emerald-600 mr-1"></i>
                        <strong>Pencatatan Riwayat Manual:</strong> Gunakan menu ini untuk mencatat pembayaran masa lalu santri (sebelum komputerisasi) atau transaksi tunai langsung di bendahara.
                    </div>
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button type="button" class="btn-primary-action" onclick="openManualModal()">
                        <i class="fa-solid fa-plus-circle"></i>
                        <span>Catat Pembayaran Manual</span>
                    </button>
                    <a href="/sk/bt" class="btn-secondary-action">
                        <i class="fa-solid fa-file-circle-plus text-blue-600"></i>
                        <span>Buat Tagihan Siswa</span>
                    </a>
                    <button type="button" class="btn-secondary-action" onclick="window.print()">
                        <i class="fa-solid fa-print text-slate-600"></i>
                        <span>Cetak Rekap</span>
                    </button>
                </div>
            </div>

            {{-- STATISTIK RINGKASAN KEUANGAN --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon icon-primary"><i class="fa-solid fa-receipt"></i></div>
                    <div>
                        <h3>{{ number_format($total_transaksi, 0, ',', '.') }}</h3>
                        <p>Total Transaksi Tercatat</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-success"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                    <div>
                        <h3>Rp {{ number_format($total_terbayar, 0, ',', '.') }}</h3>
                        <p>Total Dana Terkumpul</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-warning"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                    <div>
                        <h3 class="text-danger">Rp {{ number_format($total_sisa, 0, ',', '.') }}</h3>
                        <p>Total Sisa Tunggakan</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-info"><i class="fa-solid fa-users-viewfinder"></i></div>
                    <div>
                        <h3>{{ $total_lunas }} <span style="font-size: 0.95rem; font-weight: normal; color: #64748b;">Lunas</span> / {{ $total_menunggak }} <span style="font-size: 0.95rem; font-weight: normal; color: #ef4444;">Menunggak</span></h3>
                        <p>Status Kelunasan Santri</p>
                    </div>
                </div>
            </div>

            {{-- FILTER PEMBAYARAN LENGKAP --}}
            <div class="filter-box">
                <form action="/sk/ppl" method="GET">
                    <div class="filter-heading">
                        <div>
                            <h4><i class="fa-solid fa-filter text-emerald-600 mr-1"></i> Filter & Penelusuran Riwayat Pembayaran</h4>
                            <p>Saring riwayat transaksi berdasarkan nama santri, NIS, jenis pembayaran, ruang kelas, status, atau rentang tanggal.</p>
                        </div>
                        <span class="result-counter" id="resultCounter">{{ $paginated_records->total() }} data ditemukan</span>
                    </div>

                    <div class="filter-group" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px;">
                        <div class="input-wrap">
                            <label for="filter-q">Pencarian Santri / NIS</label>
                            <input type="search" id="filter-q" name="q" value="{{ $q ?? '' }}" placeholder="Nama siswa atau NIS..." autocomplete="off">
                        </div>

                        <div class="input-wrap">
                            <label for="filter-jenis">Jenis Pembayaran</label>
                            <select id="filter-jenis" name="jenis">
                                <option value="" {{ empty($jenis) ? 'selected' : '' }}>Semua Jenis Biaya</option>
                                <option value="ipp" {{ ($jenis ?? '') === 'ipp' ? 'selected' : '' }}>SPP / IPP Bulanan</option>
                                <option value="pangkal" {{ ($jenis ?? '') === 'pangkal' ? 'selected' : '' }}>Uang Pangkal Masuk</option>
                                <option value="pendidikan" {{ ($jenis ?? '') === 'pendidikan' ? 'selected' : '' }}>Dana Pendidikan</option>
                            </select>
                        </div>

                        <div class="input-wrap">
                            <label for="filter-status">Status Pembayaran</label>
                            <select id="filter-status" name="status">
                                <option value="" {{ empty($status) ? 'selected' : '' }}>Semua Status</option>
                                <option value="lunas" {{ ($status ?? '') === 'lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="cicilan" {{ ($status ?? '') === 'cicilan' ? 'selected' : '' }}>Dicicil (Sebagian)</option>
                                <option value="menunggak" {{ ($status ?? '') === 'menunggak' ? 'selected' : '' }}>Menunggak / Belum</option>
                            </select>
                        </div>

                        <div class="input-wrap">
                            <label for="filter-kelas">Ruang Kelas</label>
                            <select id="filter-kelas" name="kelas_id">
                                <option value="">Semua Kelas</option>
                                @foreach($daftar_kelas as $kls)
                                    <option value="{{ $kls->id }}" {{ ($kelas_id ?? '') == $kls->id ? 'selected' : '' }}>{{ $kls->nama_ruang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-wrap">
                            <label for="filter-tanggal-mulai">Dari Tanggal</label>
                            <input type="date" id="filter-tanggal-mulai" name="tanggal_mulai" value="{{ $tanggal_mulai ?? '' }}">
                        </div>

                        <div class="input-wrap">
                            <label for="filter-tanggal-akhir">Sampai Tanggal</label>
                            <input type="date" id="filter-tanggal-akhir" name="tanggal_akhir" value="{{ $tanggal_akhir ?? '' }}">
                        </div>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 14px; padding-top: 12px; border-top: 1px solid #f1f5f9;">
                        <a href="/sk/ppl" class="btn-action" style="padding: 8px 16px; background: #f1f5f9; color: #475569;" title="Reset Filter">
                            <i class="fa-solid fa-arrows-rotate"></i> Reset
                        </a>
                        <button type="submit" class="btn-primary-action" style="padding: 8px 18px;">
                            <i class="fa-solid fa-magnifying-glass"></i> Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>

            {{-- TABEL DAFTAR RIWAYAT TRANSAKSI --}}
            <div class="table-card">
                <div class="table-header">
                    <div>
                        <h4><i class="fa-solid fa-table-list text-emerald-600 mr-1"></i> Data Riwayat Transaksi Pembayaran</h4>
                        <span class="table-subtitle">Daftar transaksi gabungan IPP, Uang Pangkal, dan Dana Pendidikan.</span>
                    </div>
                    <div>
                        <span style="font-size: 0.85rem; color: #64748b;">Halaman {{ $paginated_records->currentPage() }} dari {{ $paginated_records->lastPage() }}</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Kode & Jenis</th>
                                <th>Nama Santri</th>
                                <th>Kelas</th>
                                <th>Deskripsi / Periode</th>
                                <th>Tgl Transaksi</th>
                                <th class="text-right">Nominal</th>
                                <th class="text-right">Terbayar</th>
                                <th class="text-right">Sisa</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($paginated_records as $item)
                                <tr>
                                    <td>
                                        <div style="display: flex; flex-direction: column; gap: 4px;">
                                            <span style="font-size: 0.75rem; font-family: monospace; font-weight: 700; color: #475569;">#{{ $item->kode }}</span>
                                            <span class="badge-type {{ $item->tipe_badge }}">
                                                @if($item->tipe === 'ipp')
                                                    <i class="fa-solid fa-wallet"></i> IPP
                                                @elseif($item->tipe === 'pangkal')
                                                    <i class="fa-solid fa-money-check-dollar"></i> Pangkal
                                                @else
                                                    <i class="fa-solid fa-graduation-cap"></i> Pendidikan
                                                @endif
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="student-name font-bold">{{ $item->nama_siswa }}</span>
                                        <span class="student-nis">NIS: {{ $item->nis }}</span>
                                    </td>
                                    <td><span class="class-pill">{{ $item->nama_kelas }}</span></td>
                                    <td>
                                        <span style="font-weight: 500; color: #1e293b;">{{ $item->deskripsi }}</span>
                                        <span style="display: block; font-size: 0.76rem; color: #64748b;">{{ $item->nama_sekolah }}</span>
                                    </td>
                                    <td>
                                        <span style="font-size: 0.86rem; color: #334155;">{{ $item->tanggal_bayar_formatted }}</span>
                                    </td>
                                    <td class="amount text-right">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                    <td class="amount text-right text-success font-bold">Rp {{ number_format($item->dibayar, 0, ',', '.') }}</td>
                                    <td class="amount text-right {{ $item->sisa > 0 ? 'text-danger font-bold' : '' }}">Rp {{ number_format($item->sisa, 0, ',', '.') }}</td>
                                    <td class="status">
                                        @if($item->is_lunas)
                                            <span class="badge success"><i class="fa-solid fa-check"></i> Lunas</span>
                                        @elseif($item->dibayar > 0)
                                            <span class="badge warning"><i class="fa-solid fa-clock-rotate-left"></i> Dicicil</span>
                                        @else
                                            <span class="badge danger"><i class="fa-solid fa-triangle-exclamation"></i> Menunggak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 6px; white-space: nowrap;">
                                            {{-- DETAIL POPUP CEPAT --}}
                                            <button type="button" class="btn-action view" title="Lihat Bukti / Detail Slip" onclick="openDetailModal('{{ $item->id }}', '{{ $item->tipe }}', '{{ $item->kode }}', '{{ addslashes($item->nama_siswa) }}', '{{ $item->nis }}', '{{ addslashes($item->nama_kelas) }}', '{{ addslashes($item->deskripsi) }}', '{{ $item->nominal }}', '{{ $item->dibayar }}', '{{ $item->sisa }}', '{{ $item->is_lunas ? 1 : 0 }}', '{{ $item->tanggal_bayar_formatted }}', '{{ addslashes($item->nama_sekolah) }}')">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>

                                            {{-- CETAK INVOICE POPUP --}}
                                            <button type="button" class="btn-action" style="background: #ede9fe; color: #6d28d9;" title="Cetak Kuitansi / Invoice Resmi" onclick="openInvoiceModal('{{ $item->id }}', '{{ $item->tipe }}', '{{ $item->kode }}', '{{ addslashes($item->nama_siswa) }}', '{{ $item->nis }}', '{{ addslashes($item->nama_kelas) }}', '{{ addslashes($item->deskripsi) }}', '{{ $item->nominal }}', '{{ $item->dibayar }}', '{{ $item->sisa }}', '{{ $item->is_lunas ? 1 : 0 }}', '{{ $item->tanggal_bayar_formatted }}', '{{ addslashes($item->nama_sekolah) }}')">
                                                <i class="fa-solid fa-receipt"></i>
                                            </button>

                                            {{-- EDIT PEMBAYARAN / CICILAN --}}
                                            <button type="button" class="btn-action edit" title="Edit Pembayaran / Input Cicilan" onclick="openEditModal('{{ $item->id }}', '{{ $item->tipe }}', '{{ addslashes($item->nama_siswa) }}', '{{ $item->nis }}', '{{ $item->nominal }}', '{{ $item->dibayar }}', '{{ $item->sisa }}', '{{ $item->is_lunas ? 1 : 0 }}', '{{ $item->tanggal_raw }}')">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>

                                            {{-- HAPUS TRANSAKSI --}}
                                            <button type="button" class="btn-action delete" title="Hapus Riwayat" onclick="openDeleteModal('{{ $item->id }}', '{{ $item->tipe }}', '{{ addslashes($item->nama_siswa) }}', '{{ $item->deskripsi }}')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" style="text-align: center; padding: 48px 20px;">
                                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; color: #64748b;">
                                            <i class="fa-solid fa-receipt" style="font-size: 3rem; color: #cbd5e1;"></i>
                                            <h4 style="margin: 0; color: #334155;">Tidak Ada Data Transaksi</h4>
                                            <p style="margin: 0; font-size: 0.9rem;">Belum ada riwayat pembayaran yang sesuai dengan kriteria filter Anda.</p>
                                            <button type="button" class="btn-primary-action" style="margin-top: 8px;" onclick="openManualModal()">
                                                <i class="fa-solid fa-plus-circle"></i> Tambah Transaksi Manual Pertama
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                @if($paginated_records->hasPages())
                    <div class="card-footer pagination-wrap" style="display: flex; justify-content: center; align-items: center; width: 100%; padding: 20px;">
                        {{ $paginated_records->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL 1: CATAT PEMBAYARAN MANUAL (HISTORIS / KASIR)           --}}
    {{-- ============================================================ --}}
    <div id="modalTambahManual" class="modal-overlay">
        <div class="modal-card" style="max-width: 580px; width: 92%;">
            <div class="modal-header">
                <div>
                    <h3 style="display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-file-invoice-dollar text-emerald-600"></i>
                        <span>Catat Pembayaran Manual</span>
                    </h3>
                    <p style="margin: 2px 0 0 0; font-size: 0.8rem; color: #64748b;">Gunakan untuk mencatat pembayaran santri masa lalu atau setoran tunai langsung.</p>
                </div>
                <button type="button" class="btn-close-modal" onclick="closeManualModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form action="/sk/tbtg" method="POST" class="modal-body" style="gap: 14px;">
                @csrf
                <input type="hidden" name="is_manual" value="1">

                <div class="modal-field">
                    <label for="manual-siswa-id"><i class="fa-solid fa-user-graduate"></i> Pilih Santri / Siswa <span style="color: #ef4444;">*</span></label>
                    <select name="siswa_id" id="manual-siswa-id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px;">
                        <option value="">-- Pilih Santri --</option>
                        @foreach($daftar_siswa as $s)
                            <option value="{{ $s->id }}">
                                {{ $s->nama }} (NIS: {{ $s->nis ?? '-' }}) - {{ $s->kelas->nama_ruang ?? 'Belum Kelas' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-row-2">
                    <div class="modal-field">
                        <label for="manual-jenis-pembayaran"><i class="fa-solid fa-tags"></i> Jenis Biaya <span style="color: #ef4444;">*</span></label>
                        <select name="jenis_pembayaran" id="manual-jenis-pembayaran" required onchange="toggleManualJenis(this.value)" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px;">
                            <option value="ipp">SPP / IPP Bulanan</option>
                            <option value="pangkal">Uang Pangkal Masuk</option>
                            <option value="pendidikan">Dana Pengembangan Pendidikan</option>
                        </select>
                    </div>

                    <div class="modal-field" id="wrap-bulan-ipp">
                        <label for="manual-bulan-ipp"><i class="fa-solid fa-calendar-days"></i> Bulan Tagihan IPP</label>
                        <input type="month" name="tanggal_awal" id="manual-bulan-ipp" value="{{ date('Y-m') }}" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px;">
                    </div>
                </div>

                <div class="modal-row-2">
                    <div class="modal-field">
                        <label for="manual-nominal"><i class="fa-solid fa-money-bill-wave"></i> Nominal Tagihan (Rp) <span style="color: #ef4444;">*</span></label>
                        <input type="number" name="nominal" id="manual-nominal" placeholder="Contoh: 350000" required min="0" oninput="hitungSisaManual()" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px;">
                    </div>

                    <div class="modal-field">
                        <label for="manual-dibayar"><i class="fa-solid fa-hand-holding-dollar"></i> Jumlah Yang Dibayar (Rp) <span style="color: #ef4444;">*</span></label>
                        <input type="number" name="jumlah_dibayar" id="manual-dibayar" placeholder="Contoh: 350000" required min="0" oninput="hitungSisaManual()" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px;">
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; padding: 8px 12px; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; color: #047857;">
                        <input type="checkbox" id="check-bayar-lunas" onchange="setLunasOtomatis(this.checked)">
                        <span>Bayar Lunas Penuh (Jumlah Dibayar = Nominal)</span>
                    </label>
                    <span id="manual-sisa-label" style="font-size: 0.84rem; font-weight: 700; color: #64748b;">Sisa: Rp 0</span>
                </div>

                <div class="modal-row-2">
                    <div class="modal-field">
                        <label for="manual-tanggal-bayar"><i class="fa-solid fa-clock-rotate-left"></i> Tanggal Pembayaran <span style="color: #ef4444;">*</span></label>
                        <input type="date" name="tanggal_bayar" id="manual-tanggal-bayar" value="{{ date('Y-m-d') }}" required style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px;">
                    </div>

                    <div class="modal-field">
                        <label for="manual-status"><i class="fa-solid fa-circle-check"></i> Status Transaksi <span style="color: #ef4444;">*</span></label>
                        <select name="status" id="manual-status" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px;">
                            <option value="1">Lunas</option>
                            <option value="0">Dicicil / Belum Lunas</option>
                        </select>
                    </div>
                </div>

                <div class="modal-field">
                    <label for="manual-catatan"><i class="fa-solid fa-note-sticky"></i> Catatan Transaksi / Referensi Kuitansi</label>
                    <input type="text" name="catatan" id="manual-catatan" placeholder="Contoh: Kuitansi Manual No. 45/2025, Bayar Tunai di Kantor" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px;">
                </div>

                <div class="modal-footer" style="padding-top: 10px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-action" style="padding: 9px 18px; background: #e2e8f0; color: #475569;" onclick="closeManualModal()">Batal</button>
                    <button type="submit" class="btn-primary-action">
                        <i class="fa-solid fa-check"></i> Simpan Transaksi Manual
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL 2: DETAIL SLIP & KUITANSI PEMBAYARAN                    --}}
    {{-- ============================================================ --}}
    <div id="modalDetailSlip" class="modal-overlay">
        <div class="modal-card" style="max-width: 540px; width: 92%;">
            <div class="modal-header">
                <div>
                    <h3 style="display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-receipt text-emerald-600"></i>
                        <span>Bukti Kuitansi Pembayaran</span>
                    </h3>
                    <p style="margin: 2px 0 0 0; font-size: 0.8rem; color: #64748b;">Rincian transaksi resmi SIAKAD Imam Syafii.</p>
                </div>
                <button type="button" class="btn-close-modal" onclick="closeDetailModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body" id="printableSlip">
                <div style="text-align: center; border-bottom: 2px solid #0f172a; padding-bottom: 10px; margin-bottom: 12px;">
                    <h4 style="margin: 0; text-transform: uppercase; font-size: 1.05rem; color: #047857;">Yayasan Pendidikan Imam Syafii</h4>
                    <p style="margin: 2px 0 0 0; font-size: 0.82rem; color: #64748b;">Kuitansi Resmi Pembayaran Santri &middot; SIAKAD Online</p>
                    <span id="detail-slip-kode" style="display: inline-block; margin-top: 6px; padding: 2px 10px; background: #f1f5f9; border-radius: 4px; font-family: monospace; font-size: 0.85rem; font-weight: 700;"></span>
                </div>

                <div class="receipt-modal-preview">
                    <div class="receipt-row">
                        <span style="color: #64748b;">Nama Santri:</span>
                        <strong id="detail-slip-nama" style="color: #0f172a;"></strong>
                    </div>
                    <div class="receipt-row">
                        <span style="color: #64748b;">NIS:</span>
                        <span id="detail-slip-nis"></span>
                    </div>
                    <div class="receipt-row">
                        <span style="color: #64748b;">Kelas:</span>
                        <span id="detail-slip-kelas"></span>
                    </div>
                    <div class="receipt-row">
                        <span style="color: #64748b;">Jenis Biaya:</span>
                        <strong id="detail-slip-jenis"></strong>
                    </div>
                    <div class="receipt-row">
                        <span style="color: #64748b;">Tanggal Transaksi:</span>
                        <span id="detail-slip-tanggal"></span>
                    </div>
                    <div class="receipt-row">
                        <span style="color: #64748b;">Nominal Tagihan:</span>
                        <span id="detail-slip-nominal" style="font-weight: 600;"></span>
                    </div>
                    <div class="receipt-row">
                        <span style="color: #64748b;">Jumlah Terbayar:</span>
                        <strong id="detail-slip-dibayar" style="color: #059669;"></strong>
                    </div>
                    <div class="receipt-row">
                        <span style="color: #64748b;">Sisa Tagihan:</span>
                        <strong id="detail-slip-sisa" style="color: #dc2626;"></strong>
                    </div>
                    <div class="receipt-row" style="padding-top: 8px;">
                        <span style="color: #64748b;">Status Pelunasan:</span>
                        <span id="detail-slip-status-badge"></span>
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="padding: 14px 20px; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                <button type="button" class="btn-action" style="background: #ede9fe; color: #6d28d9; padding: 8px 14px;" onclick="openInvoiceFromCurrentDetail()">
                    <i class="fa-solid fa-receipt"></i> Pratinjau Invoice Resmi
                </button>
                <div style="display: flex; gap: 8px;">
                    <button type="button" class="btn-action" style="padding: 8px 14px; background: #e2e8f0; color: #475569;" onclick="closeDetailModal()">Tutup</button>
                    <button type="button" class="btn-primary-action" onclick="openInvoiceFromCurrentDetail()">
                        <i class="fa-solid fa-print"></i> Cetak Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL 2.1: POPUP CETAK INVOICE / KUITANSI RESMI              --}}
    {{-- ============================================================ --}}
    <div id="modalCetakInvoice" class="modal-overlay">
        <div class="modal-card" style="max-width: 760px; width: 94%; max-height: 90vh; overflow-y: auto;">
            <div class="modal-header no-print">
                <div>
                    <h3 style="display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-receipt text-emerald-600"></i>
                        <span>Cetak Invoice / Kuitansi Resmi</span>
                    </h3>
                    <p style="margin: 2px 0 0 0; font-size: 0.8rem; color: #64748b;">Pratinjau resmi kuitansi pembayaran santri SIAKAD Imam Syafii.</p>
                </div>
                <button type="button" class="btn-close-modal" onclick="closeInvoiceModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body" style="padding: 16px 20px;">
                {{-- AREA KERTAS INVOICE YANG DICETAK --}}
                <div id="invoicePrintArea" class="invoice-paper">
                    <!-- KOP SURAT SEKOLAH -->
                    <div class="invoice-kop">
                        <img src="{{ asset('img/logo_sklh.png') }}" class="invoice-logo" alt="Logo Sekolah" onerror="this.style.display='none'">
                        <div class="invoice-kop-text">
                            <h2>Yayasan Pendidikan Imam Syafii</h2>
                            <h3>SEKOLAH ISLAM TERPADU IMAM SYAFII</h3>
                            <p>
                                Alamat: Jl. Pendidikan Raya No. 45, Manado, Sulawesi Utara &bull; Telp/WA: (0431) 889212<br>
                                Email: info@sekolahsyafii.sch.id &bull; Website: sekolahsyafii.sch.id
                            </p>
                        </div>
                    </div>

                    <!-- JUDUL KUITANSI & NOMOR -->
                    <div style="text-align: center; margin-bottom: 18px;">
                        <h3 style="margin: 0; font-size: 1.15rem; font-weight: 800; text-transform: uppercase; color: #0f172a; letter-spacing: 0.5px; text-decoration: underline;">
                            KUITANSI BUKTI PEMBAYARAN RESMI
                        </h3>
                        <div style="display: flex; justify-content: center; gap: 16px; margin-top: 6px; font-size: 0.84rem; color: #475569;">
                            <span>Nomor: <strong id="inv-nomor" style="font-family: monospace; font-size: 0.9rem; color: #047857;">#INV/202611/0001</strong></span>
                            <span>&bull;</span>
                            <span>Tanggal Cetak: <strong id="inv-tanggal-cetak">{{ date('d/m/Y') }}</strong></span>
                        </div>
                    </div>

                    <!-- BIODATA SANTRI -->
                    <div class="invoice-grid-bio">
                        <div class="invoice-bio-row">
                            <span class="invoice-bio-label">Nama Santri</span>
                            <span>:</span>
                            <strong id="inv-nama" style="color: #0f172a;">-</strong>
                        </div>
                        <div class="invoice-bio-row">
                            <span class="invoice-bio-label">NIS</span>
                            <span>:</span>
                            <span id="inv-nis" style="font-weight: 600;">-</span>
                        </div>
                        <div class="invoice-bio-row">
                            <span class="invoice-bio-label">Kelas</span>
                            <span>:</span>
                            <span id="inv-kelas">-</span>
                        </div>
                        <div class="invoice-bio-row">
                            <span class="invoice-bio-label">Unit Sekolah</span>
                            <span>:</span>
                            <span id="inv-sekolah">-</span>
                        </div>
                        <div class="invoice-bio-row">
                            <span class="invoice-bio-label">Tahun Ajaran</span>
                            <span>:</span>
                            <span>2026/2027</span>
                        </div>
                        <div class="invoice-bio-row">
                            <span class="invoice-bio-label">Status Bayar</span>
                            <span>:</span>
                            <span id="inv-status-pill"></span>
                        </div>
                    </div>

                    <!-- TABEL RINCIAN PEMBAYARAN -->
                    <table class="invoice-table">
                        <thead>
                            <tr>
                                <th style="width: 40px; text-align: center;">No</th>
                                <th>Uraian / Deskripsi Pembayaran</th>
                                <th style="text-align: right; width: 140px;">Nominal Tagihan</th>
                                <th style="text-align: right; width: 140px;">Jumlah Terbayar</th>
                                <th style="text-align: right; width: 140px;">Sisa Tunggakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;">1</td>
                                <td>
                                    <strong id="inv-item-deskripsi" style="color: #0f172a;">-</strong>
                                    <div style="font-size: 0.78rem; color: #64748b;" id="inv-item-subdeskripsi">Pembayaran Terverifikasi SIAKAD</div>
                                </td>
                                <td style="text-align: right; font-weight: 600;" id="inv-item-nominal">Rp 0</td>
                                <td style="text-align: right; font-weight: 700; color: #047857;" id="inv-item-dibayar">Rp 0</td>
                                <td style="text-align: right; font-weight: 600;" id="inv-item-sisa">Rp 0</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr style="background: #f8fafc; font-weight: 700;">
                                <td colspan="3" style="text-align: right; font-size: 0.88rem; text-transform: uppercase;">Total Pembayaran Diterima:</td>
                                <td style="text-align: right; font-size: 1.05rem; color: #047857;" id="inv-total-terima">Rp 0</td>
                                <td style="text-align: right; font-size: 0.88rem; color: #dc2626;" id="inv-total-sisa">Rp 0</td>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- BOX TERBILANG -->
                    <div class="invoice-terbilang-box">
                        <span style="font-weight: 600; color: #475569;">Terbilang:</span>
                        <em id="inv-terbilang-teks" style="font-weight: 700; color: #065f46; font-style: normal; margin-left: 6px;">Nol Rupiah</em>
                    </div>

                    <!-- CATATAN VALIDASI -->
                    <div style="font-size: 0.78rem; color: #64748b; line-height: 1.4; border-left: 3px solid #cbd5e1; padding-left: 10px; margin-bottom: 20px;">
                        <strong>Keterangan:</strong> Bukti pembayaran ini sah dan dikeluarkan secara otomatis oleh Sistem Informasi Akademik (SIAKAD) Sekolah Islam Terpadu Imam Syafii. Harap disimpan dengan baik sebagai bukti setoran yang valid.
                    </div>

                    <!-- TANDA TANGAN -->
                    <div class="invoice-ttd-container">
                        <div class="invoice-ttd-box">
                            <div>Yang Menyerahkan,</div>
                            <div style="font-size: 0.75rem; color: #64748b;">(Santri / Wali Santri)</div>
                            <div class="invoice-ttd-space"></div>
                            <div style="font-weight: 700; text-decoration: underline;" id="inv-ttd-nama">-</div>
                        </div>

                        <div class="invoice-ttd-box">
                            <div>Manado, <span id="inv-ttd-tgl">{{ date('d M Y') }}</span></div>
                            <div style="font-size: 0.75rem; color: #64748b;">Petugas / Bendahara Sekolah</div>
                            <div class="invoice-ttd-space"></div>
                            <div style="font-weight: 700; text-decoration: underline;">
                                {{ session('nama') ?? 'Bendahara SIAKAD' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer no-print" style="padding: 14px 20px; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; background: #fafafa;">
                <div>
                    <a href="#" id="inv-btn-pdf" class="btn-secondary-action" style="padding: 8px 14px; font-size: 0.85rem;" target="_blank">
                        <i class="fa-solid fa-file-pdf text-red-600"></i> Unduh Dokumen PDF
                    </a>
                </div>
                <div style="display: flex; gap: 8px;">
                    <button type="button" class="btn-action" style="padding: 8px 16px; background: #e2e8f0; color: #475569;" onclick="closeInvoiceModal()">Tutup</button>
                    <button type="button" class="btn-primary-action" onclick="printInvoiceModal()">
                        <i class="fa-solid fa-print"></i> Cetak Kuitansi
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL 3: EDIT PEMBAYARAN / INPUT CICILAN                     --}}
    {{-- ============================================================ --}}
    <div id="modalEditPembayaran" class="modal-overlay">
        <div class="modal-card" style="max-width: 500px; width: 92%;">
            <div class="modal-header">
                <div>
                    <h3 style="display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-pen-to-square text-amber-600"></i>
                        <span>Perbarui Data Pembayaran</span>
                    </h3>
                    <p style="margin: 2px 0 0 0; font-size: 0.8rem; color: #64748b;">Perbarui jumlah terbayar, nominal tagihan, atau status.</p>
                </div>
                <button type="button" class="btn-close-modal" onclick="closeEditModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form id="formEditPembayaran" method="POST" action="/sk/esp" class="modal-body" style="gap: 14px;">
                @csrf
                <input type="hidden" name="id" id="edit-id" value="">
                <input type="hidden" name="tipe" id="edit-tipe" value="">

                <div class="modal-field">
                    <label>Santri / Siswa</label>
                    <input type="text" id="edit-nama-siswa" readonly disabled style="background: #f1f5f9; cursor: not-allowed; font-weight: 600;">
                </div>

                <div class="modal-row-2">
                    <div class="modal-field">
                        <label for="edit-nominal">Nominal Tagihan (Rp)</label>
                        <input type="number" name="nominal" id="edit-nominal" min="0" required oninput="hitungSisaEdit()">
                    </div>

                    <div class="modal-field">
                        <label for="edit-jumlah-dibayar">Total Terbayar Saat Ini (Rp)</label>
                        <input type="number" name="jumlah_dibayar" id="edit-jumlah-dibayar" min="0" required oninput="hitungSisaEdit()">
                    </div>
                </div>

                <div style="background: #f8fafc; padding: 8px 12px; border-radius: 8px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.85rem; color: #64748b;">Sisa Tagihan:</span>
                    <strong id="edit-sisa-label" style="font-size: 0.95rem; color: #dc2626;">Rp 0</strong>
                </div>

                <div class="modal-field">
                    <label for="edit-status">Status Pembayaran</label>
                    <select name="status" id="edit-status" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px;">
                        <option value="1">Lunas</option>
                        <option value="0">Belum Lunas / Cicilan</option>
                    </select>
                </div>

                <div class="modal-footer" style="padding-top: 10px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-action" style="padding: 9px 18px; background: #e2e8f0; color: #475569;" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn-primary-action" style="background: linear-gradient(135deg, #d97706 0%, #b45309 100%);">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL 4: HAPUS RIWAYAT PEMBAYARAN                            --}}
    {{-- ============================================================ --}}
    <div id="modalDeletePembayaran" class="modal-overlay">
        <div class="modal-card" style="max-width: 440px; width: 92%;">
            <div class="modal-header">
                <div>
                    <h3 style="display: flex; align-items: center; gap: 8px; color: #dc2626;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>Konfirmasi Hapus Transaksi</span>
                    </h3>
                </div>
                <button type="button" class="btn-close-modal" onclick="closeDeleteModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form action="/sk/hpsp" method="POST" class="modal-body" style="gap: 14px;">
                @csrf
                <input type="hidden" name="id" id="delete-id" value="">
                <input type="hidden" name="pembayaran" id="delete-tipe" value="">

                <p style="margin: 0; font-size: 0.92rem; color: #334155; line-height: 1.5;">
                    Apakah Anda yakin ingin menghapus data riwayat transaksi pembayaran <strong id="delete-deskripsi"></strong> untuk santri <strong id="delete-nama-siswa"></strong>?
                </p>
                <div style="background: #fef2f2; border: 1px solid #fecaca; padding: 10px 14px; border-radius: 8px; font-size: 0.82rem; color: #991b1b;">
                    <i class="fa-solid fa-circle-exclamation mr-1"></i> Tindakan ini tidak dapat dibatalkan dan akan memperbarui catatan keuangan santri.
                </div>

                <div class="modal-footer" style="padding-top: 10px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-action" style="padding: 9px 18px; background: #e2e8f0; color: #475569;" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="btn-action delete" style="padding: 9px 18px; font-weight: 600;">
                        <i class="fa-solid fa-trash-can"></i> Ya, Hapus Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- JAVASCRIPT LOGIC UNTUK SEMUA MODAL & FILTER --}}
    <script>
        /* --- Modal Manual --- */
        function openManualModal() {
            document.getElementById('modalTambahManual').classList.add('active');
        }
        function closeManualModal() {
            document.getElementById('modalTambahManual').classList.remove('active');
        }

        function toggleManualJenis(val) {
            const wrap = document.getElementById('wrap-bulan-ipp');
            if (val === 'ipp') {
                wrap.style.display = 'flex';
            } else {
                wrap.style.display = 'none';
            }
        }

        function setLunasOtomatis(isLunas) {
            const nomInput = document.getElementById('manual-nominal');
            const dibayarInput = document.getElementById('manual-dibayar');
            const statusSelect = document.getElementById('manual-status');

            if (isLunas) {
                const nom = parseFloat(nomInput.value) || 0;
                dibayarInput.value = nom;
                statusSelect.value = "1";
            }
            hitungSisaManual();
        }

        function hitungSisaManual() {
            const nom = parseFloat(document.getElementById('manual-nominal').value) || 0;
            const dibayar = parseFloat(document.getElementById('manual-dibayar').value) || 0;
            const sisa = Math.max(0, nom - dibayar);
            const statusSelect = document.getElementById('manual-status');

            document.getElementById('manual-sisa-label').textContent = 'Sisa: Rp ' + sisa.toLocaleString('id-ID');
            if (dibayar >= nom && nom > 0) {
                statusSelect.value = "1";
            } else {
                statusSelect.value = "0";
            }
        }

        /* --- Modal Detail Slip --- */
        let currentDetailData = null;

        function openDetailModal(id, tipe, kode, nama, nis, kelas, deskripsi, nominal, dibayar, sisa, isLunas, tanggal, sekolah) {
            currentDetailData = { id, tipe, kode, nama, nis, kelas, deskripsi, nominal, dibayar, sisa, isLunas, tanggal, sekolah: sekolah || 'SIT Imam Syafii' };

            document.getElementById('detail-slip-kode').textContent = kode;
            document.getElementById('detail-slip-nama').textContent = nama;
            document.getElementById('detail-slip-nis').textContent = nis;
            document.getElementById('detail-slip-kelas').textContent = kelas;
            document.getElementById('detail-slip-jenis').textContent = deskripsi;
            document.getElementById('detail-slip-tanggal').textContent = tanggal;
            document.getElementById('detail-slip-nominal').textContent = 'Rp ' + parseInt(nominal).toLocaleString('id-ID');
            document.getElementById('detail-slip-dibayar').textContent = 'Rp ' + parseInt(dibayar).toLocaleString('id-ID');
            document.getElementById('detail-slip-sisa').textContent = 'Rp ' + parseInt(sisa).toLocaleString('id-ID');

            const badgeSpan = document.getElementById('detail-slip-status-badge');
            if (parseInt(isLunas) === 1) {
                badgeSpan.className = 'badge success';
                badgeSpan.innerHTML = '<i class="fa-solid fa-check"></i> Pembayaran Lunas';
            } else if (parseInt(dibayar) > 0) {
                badgeSpan.className = 'badge warning';
                badgeSpan.innerHTML = '<i class="fa-solid fa-clock-rotate-left"></i> Dicicil (Sebagian)';
            } else {
                badgeSpan.className = 'badge danger';
                badgeSpan.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Menunggak (Belum Bayar)';
            }

            document.getElementById('modalDetailSlip').classList.add('active');
        }
        function closeDetailModal() {
            document.getElementById('modalDetailSlip').classList.remove('active');
        }

        function openInvoiceFromCurrentDetail() {
            if (!currentDetailData) return;
            closeDetailModal();
            openInvoiceModal(
                currentDetailData.id,
                currentDetailData.tipe,
                currentDetailData.kode,
                currentDetailData.nama,
                currentDetailData.nis,
                currentDetailData.kelas,
                currentDetailData.deskripsi,
                currentDetailData.nominal,
                currentDetailData.dibayar,
                currentDetailData.sisa,
                currentDetailData.isLunas,
                currentDetailData.tanggal,
                currentDetailData.sekolah
            );
        }

        /* --- Modal Popup Cetak Invoice Resmi --- */
        function openInvoiceModal(id, tipe, kode, nama, nis, kelas, deskripsi, nominal, dibayar, sisa, isLunas, tanggal, sekolah) {
            const nomNum = parseInt(nominal) || 0;
            const dibayarNum = parseInt(dibayar) || 0;
            const sisaNum = parseInt(sisa) || 0;
            const lunasBool = parseInt(isLunas) === 1 || (nomNum > 0 && dibayarNum >= nomNum);

            document.getElementById('inv-nomor').textContent = kode || ('#INV/' + (tipe || 'SKD').toUpperCase() + '/' + id);
            document.getElementById('inv-nama').textContent = nama;
            document.getElementById('inv-nis').textContent = nis || '-';
            document.getElementById('inv-kelas').textContent = kelas || 'Belum Ditentukan';
            document.getElementById('inv-sekolah').textContent = sekolah || 'SIT Imam Syafii';
            document.getElementById('inv-item-deskripsi').textContent = deskripsi;
            document.getElementById('inv-item-subdeskripsi').textContent = 'Kategori: ' + (tipe === 'ipp' ? 'SPP / IPP Bulanan' : (tipe === 'pangkal' ? 'Uang Pangkal Masuk' : 'Dana Pengembangan Pendidikan'));
            document.getElementById('inv-item-nominal').textContent = 'Rp ' + nomNum.toLocaleString('id-ID');
            document.getElementById('inv-item-dibayar').textContent = 'Rp ' + dibayarNum.toLocaleString('id-ID');
            document.getElementById('inv-item-sisa').textContent = 'Rp ' + sisaNum.toLocaleString('id-ID');
            document.getElementById('inv-total-terima').textContent = 'Rp ' + dibayarNum.toLocaleString('id-ID');
            document.getElementById('inv-total-sisa').textContent = 'Rp ' + sisaNum.toLocaleString('id-ID');
            document.getElementById('inv-ttd-nama').textContent = nama;
            document.getElementById('inv-ttd-tgl').textContent = tanggal || '{{ date("d M Y") }}';
            document.getElementById('inv-btn-pdf').href = '/sk/ssp?id=' + id + '&type=' + tipe;

            // Terbilang dalam Rupiah
            document.getElementById('inv-terbilang-teks').textContent = angkaKeTerbilang(dibayarNum);

            // Status Pill
            const pill = document.getElementById('inv-status-pill');
            if (lunasBool) {
                pill.className = 'badge success';
                pill.innerHTML = '<i class="fa-solid fa-check"></i> LUNAS';
            } else if (dibayarNum > 0) {
                pill.className = 'badge warning';
                pill.innerHTML = '<i class="fa-solid fa-clock-rotate-left"></i> DICICIL (SEBAGIAN)';
            } else {
                pill.className = 'badge danger';
                pill.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> MENUNGGAK';
            }

            document.getElementById('modalCetakInvoice').classList.add('active');
        }

        function closeInvoiceModal() {
            document.getElementById('modalCetakInvoice').classList.remove('active');
        }

        function printInvoiceModal() {
            window.print();
        }

        /* Konversi Angka ke Huruf Terbilang Bahasa Indonesia */
        function angkaKeTerbilang(nilai) {
            nilai = Math.abs(parseInt(nilai)) || 0;
            if (nilai === 0) return 'Nol Rupiah';
            const satuan = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
            function terbilangHelper(n) {
                if (n < 12) return satuan[n];
                if (n < 20) return terbilangHelper(n - 10) + ' Belas';
                if (n < 100) return terbilangHelper(Math.floor(n / 10)) + ' Puluh ' + (n % 10 > 0 ? terbilangHelper(n % 10) : '');
                if (n < 200) return 'Seratus ' + (n - 100 > 0 ? terbilangHelper(n - 100) : '');
                if (n < 1000) return terbilangHelper(Math.floor(n / 100)) + ' Ratus ' + (n % 100 > 0 ? terbilangHelper(n % 100) : '');
                if (n < 2000) return 'Seribu ' + (n - 1000 > 0 ? terbilangHelper(n - 1000) : '');
                if (n < 1000000) return terbilangHelper(Math.floor(n / 1000)) + ' Ribu ' + (n % 1000 > 0 ? terbilangHelper(n % 1000) : '');
                if (n < 1000000000) return terbilangHelper(Math.floor(n / 1000000)) + ' Juta ' + (n % 1000000 > 0 ? terbilangHelper(n % 1000000) : '');
                return terbilangHelper(Math.floor(n / 1000000000)) + ' Miliar ' + (n % 1000000000 > 0 ? terbilangHelper(n % 1000000000) : '');
            }
            return (terbilangHelper(nilai).replace(/\s+/g, ' ').trim() + ' Rupiah');
        }

        /* --- Modal Edit Pembayaran --- */
        function openEditModal(id, tipe, nama, nis, nominal, dibayar, sisa, isLunas, tanggalRaw) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-tipe').value = tipe;
            document.getElementById('edit-nama-siswa').value = nama + ' (' + nis + ')';
            document.getElementById('edit-nominal').value = parseInt(nominal);
            document.getElementById('edit-jumlah-dibayar').value = parseInt(dibayar);
            document.getElementById('edit-status').value = parseInt(isLunas) === 1 ? '1' : '0';

            const form = document.getElementById('formEditPembayaran');
            if (tipe === 'pangkal') {
                form.action = '/sk/espk';
            } else if (tipe === 'pendidikan') {
                form.action = '/sk/espp';
            } else {
                form.action = '/sk/esp';
            }

            hitungSisaEdit();
            document.getElementById('modalEditPembayaran').classList.add('active');
        }
        function closeEditModal() {
            document.getElementById('modalEditPembayaran').classList.remove('active');
        }
        function hitungSisaEdit() {
            const nom = parseFloat(document.getElementById('edit-nominal').value) || 0;
            const dibayar = parseFloat(document.getElementById('edit-jumlah-dibayar').value) || 0;
            const sisa = Math.max(0, nom - dibayar);
            document.getElementById('edit-sisa-label').textContent = 'Rp ' + sisa.toLocaleString('id-ID');
            const statusSelect = document.getElementById('edit-status');
            if (dibayar >= nom && nom > 0) {
                statusSelect.value = "1";
            }
        }

        /* --- Modal Hapus Pembayaran --- */
        function openDeleteModal(id, tipe, nama, deskripsi) {
            document.getElementById('delete-id').value = id;
            document.getElementById('delete-tipe').value = tipe;
            document.getElementById('delete-nama-siswa').textContent = nama;
            document.getElementById('delete-deskripsi').textContent = deskripsi;
            document.getElementById('modalDeletePembayaran').classList.add('active');
        }
        function closeDeleteModal() {
            document.getElementById('modalDeletePembayaran').classList.remove('active');
        }

        /* Close when clicking outside of modal card */
        window.onclick = function(event) {
            const m1 = document.getElementById('modalTambahManual');
            const m2 = document.getElementById('modalDetailSlip');
            const m3 = document.getElementById('modalEditPembayaran');
            const m4 = document.getElementById('modalDeletePembayaran');
            const m5 = document.getElementById('modalCetakInvoice');

            if (event.target === m1) closeManualModal();
            if (event.target === m2) closeDetailModal();
            if (event.target === m3) closeEditModal();
            if (event.target === m4) closeDeleteModal();
            if (event.target === m5) closeInvoiceModal();
        };
    </script>
</body>
</html>
