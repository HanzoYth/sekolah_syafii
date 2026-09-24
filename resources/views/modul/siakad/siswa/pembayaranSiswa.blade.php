<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Pembayaran - SIAKAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pembayaranSiswa.css') }}?v={{ time() }}">
</head>
<body>
    @php
        $riwayat = $riwayat_pembayaran ?? [
            (object)['tanggal' => '12 Apr 2026', 'nama_tagihan' => 'IPP Bulan April 2026', 'jenis' => 'IPP Bulanan', 'keterangan' => 'Menunggu konfirmasi pembayaran', 'nominal' => 500000, 'status' => 'belum'],
            (object)['tanggal' => '12 Mar 2026', 'nama_tagihan' => 'IPP Bulan Maret 2026', 'jenis' => 'IPP Bulanan', 'keterangan' => 'Pembayaran via Transfer Bank', 'nominal' => 500000, 'status' => 'lunas'],
            (object)['tanggal' => '10 Jul 2026', 'nama_tagihan' => 'Uang Pangkal Tahun Ajaran 2026/2027', 'jenis' => 'Uang Pangkal', 'keterangan' => 'Pembayaran via Transfer Bank', 'nominal' => 1000000, 'status' => 'lunas'],
            (object)['tanggal' => '05 Jan 2026', 'nama_tagihan' => 'Dana Pengembangan Pendidikan 2026', 'jenis' => 'Dana Pendidikan', 'keterangan' => 'Pembayaran via Transfer Bank', 'nominal' => 750000, 'status' => 'lunas'],
            (object)['tanggal' => '15 Mei 2026', 'nama_tagihan' => 'Pemeliharaan Fasilitas Semester Genap 2026', 'jenis' => 'Pemeliharaan', 'keterangan' => 'Pembayaran via Transfer Bank', 'nominal' => 400000, 'status' => 'lunas'],
        ];
        $riwayat = is_array($riwayat) ? $riwayat : $riwayat->all();
        $totalTagihan = array_sum(array_map(fn ($item) => $item->nominal, $riwayat));
        $totalDibayar = array_sum(array_map(fn ($item) => $item->status === 'lunas' ? $item->nominal : 0, $riwayat));
        $sisaTagihan = $totalTagihan - $totalDibayar;
        $tagihanAktif = array_values(array_filter($riwayat, fn ($item) => $item->status !== 'lunas'));
    @endphp

    <div class="dashboard-container student-payment-page">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar :name="$data_siswa->nama" position="Siswa" initials="SW" title="Slip Pembayaran" description="Lihat status tagihan dan riwayat pembayaran Anda." />

            @if(session('eror'))
                <div class="payment-alert" id="errorToast"><i class="fa-solid fa-circle-exclamation"></i><span>{{ session('eror') }}</span><button type="button" onclick="closeToast()" aria-label="Tutup pesan">&times;</button></div>
            @endif

            <section class="payment-intro">
                <div><p>ADMINISTRASI SISWA</p><h2>Ringkasan pembayaran</h2><span>{{ $data_siswa->nama }} · {{ $data_kelas->nama_ruang }} · T.A. 2026/2027</span></div>
                <span class="payment-period"><i class="fa-regular fa-calendar"></i> Periode 2026/2027</span>
            </section>

            <section class="payment-summary-grid">
                <article><span class="summary-icon total"><i class="fa-solid fa-file-invoice"></i></span><div><small>Total tagihan</small><strong>Rp {{ number_format($totalTagihan, 0, ',', '.') }}</strong><em>Seluruh periode</em></div></article>
                <article><span class="summary-icon paid"><i class="fa-solid fa-circle-check"></i></span><div><small>Sudah dibayar</small><strong>Rp {{ number_format($totalDibayar, 0, ',', '.') }}</strong><em>{{ count($riwayat) - count($tagihanAktif) }} transaksi lunas</em></div></article>
                <article><span class="summary-icon due"><i class="fa-solid fa-clock"></i></span><div><small>Sisa tagihan</small><strong>Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</strong><em>{{ count($tagihanAktif) }} tagihan perlu ditinjau</em></div></article>
            </section>

            <section class="payment-layout">
                <article class="payment-card current-bills">
                    <div class="payment-card-heading"><div><p>PERLU PERHATIAN</p><h3>Tagihan aktif</h3></div><span class="item-count">{{ count($tagihanAktif) }} tagihan</span></div>
                    @forelse($tagihanAktif as $tagihan)
                        <div class="current-bill-item"><span class="bill-icon"><i class="fa-solid fa-wallet"></i></span><div><strong>{{ $tagihan->nama_tagihan }}</strong><p>{{ $tagihan->keterangan }}</p><small><i class="fa-regular fa-calendar"></i> {{ $tagihan->tanggal }}</small></div><div class="bill-amount"><strong>Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</strong><span>Menunggu pembayaran</span></div></div>
                    @empty
                        <div class="payment-empty"><i class="fa-solid fa-circle-check"></i><strong>Tidak ada tagihan aktif</strong><p>Seluruh tagihan pada periode ini telah lunas.</p></div>
                    @endforelse
                </article>

                <article class="payment-card payment-guide">
                    <span class="guide-icon"><i class="fa-solid fa-circle-info"></i></span><h3>Butuh bantuan pembayaran?</h3><p>Hubungi bagian administrasi sekolah apabila terdapat perbedaan data atau kendala pembayaran.</p><div><i class="fa-solid fa-clock"></i><span>Senin–Jumat, 07.00–14.00 WITA</span></div><div><i class="fa-solid fa-building"></i><span>Loket administrasi sekolah</span></div>
                </article>
            </section>

            <section class="payment-card history-card">
                <div class="payment-card-heading"><div><p>ARSIP PEMBAYARAN</p><h3>Riwayat transaksi</h3></div><span class="item-count">{{ count($riwayat) }} transaksi</span></div>
                <div class="payment-filter"><i class="fa-solid fa-magnifying-glass"></i><input type="search" id="paymentSearch" placeholder="Cari nama tagihan atau jenis pembayaran..."></div>
                <div class="payment-table-wrap"><table class="payment-table"><thead><tr><th>Tanggal</th><th>Tagihan</th><th>Jenis</th><th>Nominal</th><th>Status</th><th>Slip</th></tr></thead><tbody id="paymentRows">
                    @foreach($riwayat as $item)
                        <tr><td>{{ $item->tanggal }}</td><td><strong>{{ $item->nama_tagihan }}</strong><span>{{ $item->keterangan }}</span></td><td>{{ $item->jenis }}</td><td class="amount">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td><td><span class="payment-badge {{ $item->status === 'lunas' ? 'paid' : 'pending' }}"><i class="fa-solid fa-circle"></i> {{ $item->status === 'lunas' ? 'Lunas' : 'Belum lunas' }}</span></td><td><a href="/sk/dsp" class="download-slip" aria-label="Lihat slip {{ $item->nama_tagihan }}"><i class="fa-solid fa-download"></i></a></td></tr>
                    @endforeach
                </tbody></table></div>
            </section>
        </main>
    </div>
    <script>
        function closeToast(){document.getElementById('errorToast')?.remove();}
        window.setTimeout(closeToast,5000);
        document.getElementById('paymentSearch')?.addEventListener('input', function(){const query=this.value.toLowerCase();document.querySelectorAll('#paymentRows tr').forEach(function(row){row.hidden=!row.textContent.toLowerCase().includes(query);});});
    </script>
</body>
</html>
