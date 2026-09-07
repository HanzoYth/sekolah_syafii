<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa - Islamic Smart School</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/modul/siakad/detailsiswa.css')}}">
</head>
<body>

<div class="app-shell">
   

    <div class="main-content">
        <header class="topbar">
            <div class="topbar-inner">
                <div class="topbar-title">
                    <h1>Detail Data Santri / Siswa</h1>
                </div>
                <a href="{{ url()->previous() }}" class="btn btn-outline">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
        </header>

        <main class="page">
            <div class="detail-grid">
                <!-- Profil Card -->
                <div class="card profile-card">
                    <div class="avatar-wrapper">
                        <div class="avatar-large">
                            <img src="{{ route('file.show',$data_siswa->url_foto) }}" alt="Foto Santri" class="avatar-img-large">
                        </div>
                    </div>
                    <h2 class="profile-name">{{$data_siswa->nama}}</h2>
                    <span class="badge {{$data_siswa->gender == 'p' ? 'badge-perempuan' : 'badge-laki'}}">
                        <i class="fa-solid {{$data_siswa->gender == 'p' ? 'fa-venus' : 'fa-mars'}}"></i> 
                        {{$data_siswa->gender == 'p' ? 'Perempuan' : 'Laki-laki'}}
                    </span>
                    <div class="profile-meta">
                        <span class="badge-kelas">{{$data_kelas->nama_ruang}}</span>
                    </div>
                </div>

                <!-- Detail Info Card -->
                <div class="card detail-info-card">
                    <h3 class="card-title"><i class="fa-solid fa-id-card"></i> Informasi Pribadi &amp; Akademik</h3>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <label>NIS</label>
                            <p>{{$data_siswa->nis}}</p>
                        </div>

                        @php
                            Carbon\Carbon::setLocale("id");
                        @endphp
                        <div class="info-item">
                            <label>Tempat, Tanggal Lahir</label>
                            <p>{{$data_siswa->tempat_lahir}},{{Carbon\Carbon::parse($data_siswa->tanggal_lahir)->translatedFormat("Y F d")}}</p>
                        </div>
                        <div class="info-item">
                            <label>Program Studi / Kelas</label>
                            <p>{{$data_kelas->nama_ruang}}</p>
                        </div>
                        <div class="info-item full-width">
                            <label>Alamat Lengkap</label>
                            <p>{{$data_siswa->alamat}}</p>
                        </div>
                    </div> 
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>