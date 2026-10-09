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
<x-siakad-layout title="Slip Pembayaran" description="Lihat status tagihan dan riwayat pembayaran Anda." position="Orang Tua / Siswa" initials="OT">
    
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px;">
        <div style="flex: 1;">
            <div style="font-size: 14px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                <i class="fa-solid fa-file-invoice-dollar"></i> Administrasi Siswa
            </div>
            <div style="font-size: 18px; font-weight: bold; color: #1e293b;">
                Ringkasan Pembayaran
            </div>
            <div style="color: #64748b; font-size: 14px; margin-top: 4px;">
                {{ $data_siswa->nama }} - {{ $data_kelas->nama_ruang ?? 'Belum ada kelas' }} - T.A. 2026/2027
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 8px; background: #f8fafc; padding: 10px 16px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 14px; font-weight: 600; color: #334155;">
            <i class="fa-regular fa-calendar" style="color: #177455;"></i>
            <span>Periode 2026/2027</span>
        </div>
    </div>

    @if(session('eror'))
        <x-siakad.ui.alert type="danger" message="{{ session('eror') }}" />
    @endif

    <!-- Metrics Section -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 24px;">
        <div style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #f1f5f9; color: #475569; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                <i class="fa-solid fa-file-invoice"></i>
            </div>
            <div>
                <div style="font-size: 13px; color: #64748b; font-weight: 600;">Total Tagihan</div>
                <div style="font-size: 20px; font-weight: bold; color: #1e293b;">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</div>
                <div style="font-size: 12px; color: #94a3b8;">Seluruh periode</div>
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <div style="font-size: 13px; color: #64748b; font-weight: 600;">Sudah Dibayar</div>
                <div style="font-size: 20px; font-weight: bold; color: #1e293b;">Rp {{ number_format($totalDibayar, 0, ',', '.') }}</div>
                <div style="font-size: 12px; color: #94a3b8;">{{ count($riwayat) - count($tagihanAktif) }} transaksi lunas</div>
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div>
                <div style="font-size: 13px; color: #64748b; font-weight: 600;">Sisa Tagihan</div>
                <div style="font-size: 20px; font-weight: bold; color: #1e293b;">Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</div>
                <div style="font-size: 12px; color: #94a3b8;">{{ count($tagihanAktif) }} tagihan perlu ditinjau</div>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-bottom: 24px; align-items: start;">
        
        <!-- Tagihan Aktif -->
        <div style="background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #dc2626; letter-spacing: 1px; margin-bottom: 4px;">PERLU PERHATIAN</div>
                    <h3 style="margin: 0; font-size: 16px; color: #1e293b;">Tagihan Aktif</h3>
                </div>
                <span style="font-size: 13px; font-weight: 600; color: #64748b; background: #f1f5f9; padding: 6px 12px; border-radius: 20px;">{{ count($tagihanAktif) }} tagihan</span>
            </div>

            @forelse($tagihanAktif as $tagihan)
                <div style="display: flex; align-items: center; gap: 16px; padding: 16px; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 12px; background: #f8fafc;">
                    <div style="width: 40px; height: 40px; border-radius: 8px; background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div style="flex: 1;">
                        <strong style="display: block; color: #1e293b; font-size: 15px; margin-bottom: 4px;">{{ $tagihan->nama_tagihan }}</strong>
                        <p style="margin: 0 0 6px; font-size: 13px; color: #64748b;">{{ $tagihan->keterangan }}</p>
                        <small style="color: #94a3b8; font-size: 12px;"><i class="fa-regular fa-calendar"></i> {{ $tagihan->tanggal }}</small>
                    </div>
                    <div style="text-align: right;">
                        <strong style="display: block; color: #1e293b; font-size: 16px; margin-bottom: 4px;">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</strong>
                        <span style="font-size: 12px; font-weight: 600; color: #dc2626;">Menunggu pembayaran</span>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 40px; color: #64748b; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px;">
                    <i class="fa-solid fa-circle-check" style="font-size: 32px; color: #16a34a; margin-bottom: 12px; display: block;"></i>
                    <strong style="display: block; font-size: 16px; color: #1e293b; margin-bottom: 4px;">Tidak ada tagihan aktif</strong>
                    <p style="margin: 0; font-size: 14px;">Seluruh tagihan pada periode ini telah lunas.</p>
                </div>
            @endforelse
        </div>

        <!-- Bantuan -->
        <div style="background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); text-align: center;">
            <div style="width: 48px; height: 48px; border-radius: 50%; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 20px; margin: 0 auto 16px;">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <h3 style="margin: 0 0 12px; font-size: 16px; color: #1e293b;">Butuh Bantuan Pembayaran?</h3>
            <p style="margin: 0 0 20px; font-size: 13px; color: #64748b; line-height: 1.5;">Hubungi bagian administrasi sekolah apabila terdapat perbedaan data atau kendala pembayaran.</p>
            <div style="display: flex; flex-direction: column; gap: 12px; text-align: left; background: #f8fafc; padding: 16px; border-radius: 8px;">
                <div style="display: flex; align-items: center; gap: 12px; font-size: 13px; color: #475569;">
                    <i class="fa-solid fa-clock" style="color: #94a3b8; width: 16px; text-align: center;"></i>
                    <span>Senin-Jumat, 07.00-14.00 WITA</span>
                </div>
                <div style="display: flex; align-items: center; gap: 12px; font-size: 13px; color: #475569;">
                    <i class="fa-solid fa-building" style="color: #94a3b8; width: 16px; text-align: center;"></i>
                    <span>Loket Administrasi Sekolah</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Transaksi -->
    <div style="background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
            <div>
                <div style="font-size: 12px; font-weight: 700; color: #177455; letter-spacing: 1px; margin-bottom: 4px;">ARSIP PEMBAYARAN</div>
                <h3 style="margin: 0; font-size: 16px; color: #1e293b;">Riwayat Transaksi</h3>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <div style="position: relative;">
                    <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <input type="text" id="paymentSearch" placeholder="Cari tagihan atau jenis..." style="padding: 8px 12px 8px 36px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; width: 250px;">
                </div>
                <span style="font-size: 13px; font-weight: 600; color: #64748b; background: #f1f5f9; padding: 6px 12px; border-radius: 20px;">{{ count($riwayat) }} transaksi</span>
            </div>
        </div>

        <x-siakad.ui.table>
            <thead>
                <tr>
                    <th style="width: 120px;">Tanggal</th>
                    <th>Tagihan</th>
                    <th style="width: 150px;">Jenis</th>
                    <th style="width: 150px; text-align: right;">Nominal</th>
                    <th style="width: 130px; text-align: center;">Status</th>
                    <th style="width: 80px; text-align: center;">Slip</th>
                </tr>
            </thead>
            <tbody id="paymentRows">
                @foreach($riwayat as $item)
                    <tr>
                        <td style="color: #64748b; font-size: 13px;">{{ $item->tanggal }}</td>
                        <td>
                            <strong style="display: block; color: #1e293b; font-size: 14px; margin-bottom: 4px;">{{ $item->nama_tagihan }}</strong>
                            <span style="color: #64748b; font-size: 12px;">{{ $item->keterangan }}</span>
                        </td>
                        <td>
                            <span style="display: inline-block; padding: 4px 10px; background: #f1f5f9; color: #475569; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                {{ $item->jenis }}
                            </span>
                        </td>
                        <td style="text-align: right; font-weight: bold; color: #1e293b;">
                            Rp {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td style="text-align: center;">
                            @if($item->status === 'lunas')
                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; background: #dcfce7; color: #166534; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                    <i class="fa-solid fa-circle-check"></i> Lunas
                                </span>
                            @else
                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; background: #fee2e2; color: #dc2626; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                    <i class="fa-solid fa-clock"></i> Belum
                                </span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <a href="/sk/dsp" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #e9f2ff; color: #3875c5; border-radius: 8px; transition: all 0.2s; text-decoration: none;" onmouseover="this.style.background='#3875c5'; this.style.color='#fff';" onmouseout="this.style.background='#e9f2ff'; this.style.color='#3875c5';">
                                <i class="fa-solid fa-download"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-siakad.ui.table>
    </div>

    <script>
        document.getElementById('paymentSearch')?.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('#paymentRows tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
            });
        });
    </script>
</x-siakad-layout>
