<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Gaji Guru</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Memanggil CSS Terpisah -->
    <link rel="stylesheet" href="{{ asset('css/modul/guru/slip_gaji.css') }}">
</head>
<body>

    <div class="app-container">
        <!-- SIDEBAR -->
        <x-sidebar_guru />

        <!-- MAIN CONTENT AREA -->
        <main class="main-content">
            <div class="main-wrapper">
                
                <!-- TOPBAR HEADER -->
                <div class="topbar">
                    <div class="topbar-title">
                        <h2>Daftar Gaji Anda</h2>
                        <p>Riwayat dan informasi slip gaji Anda setiap bulan.</p>
                    </div>
                </div>

                <!-- CARD TABLE GAJI -->
                <div class="card">
                    <div class="table-responsive">
                        <table class="table-gaji">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Download File</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_riwayat_gaji as $value)
                                    @php
                                        $tanggal = Carbon\Carbon::parse($value->create_at)->translatedFormat("d M Y");
                                    @endphp
                                    <tr>
                                        <td>{{$tanggal}}</td>
                                        <td>
                                            <a href="{{route('Slipgaji.guru',$value->id)}}" class="btn-download" title="Download Slip Gaji">
                                                <i class="fa-solid fa-file-arrow-down"></i> download file
                                            </a>
                                        </td>
                                        <td>
                                            <div class="action-group" style="justify-content: center;">
                                                <a href="{{route('DetailSlipGaji.guru',$value->id)}}" class="btn btn-icon btn-view" title="Lihat Detail Gaji">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>