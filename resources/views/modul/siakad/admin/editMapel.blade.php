<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Pelajaran - SIAKAD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/dasboard.css') }}">
    <style>
        .mapel-container { padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 20px; max-width: 500px; }
        .mapel-header { font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #0d5c3a; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px; }
        .form-group { display: flex; flex-direction: column; gap: 5px; margin-bottom: 15px; }
        .form-group label { font-size: 13px; font-weight: 600; color: #475569; }
        .form-group input { padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; }
        .btn-submit { background: #0d5c3a; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; }
        .btn-cancel { background: #cbd5e1; color: #334155; padding: 10px 20px; border: none; border-radius: 6px; font-weight: bold; text-decoration: none; display: inline-block; text-align: center; }
        @media (max-width: 640px) {
            .mapel-container { width: 100%; max-width: 100%; padding: 16px; }
            .btn-actions { flex-direction: column; width: 100%; }
            .btn-submit, .btn-cancel { width: 100%; text-align: center; display: block; box-sizing: border-box; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar title="Mata Pelajaran" description="Edit mata pelajaran." position="Admin SIAKAD" initials="AD" />
            <div class="mapel-container">
                <div class="mapel-header"><i class="fa-solid fa-pen-to-square"></i> Edit Mata Pelajaran</div>
                <form action="/sk/update-mapel/{{ $mapel->id }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Jenjang Sekolah</label>
                        <select name="sekolah_id" required style="padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none;">
                            @foreach($data_sekolah as $s)
                                <option value="{{ $s->id }}" {{ $mapel->sekolah_id == $s->id ? 'selected' : '' }}>
                                    Jenjang {{ strtoupper($s->jenis) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Mata Pelajaran</label>
                        <input type="text" name="nama_mapel" value="{{ $mapel->nama_mapel }}" required>
                    </div>
                    <div class="form-group">
                        <label>Nilai Standar KKM</label>
                        <input type="number" name="kkm" value="{{ $mapel->kkm ?? 75 }}" min="0" max="100" required>
                    </div>
                    <div class="btn-actions" style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
                        <a href="/sk/kelola-mapel" class="btn-cancel">Batal</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>


