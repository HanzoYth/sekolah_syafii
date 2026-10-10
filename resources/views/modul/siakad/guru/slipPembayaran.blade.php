<x-siakad-layout title="Slip Pembayaran" description="Daftar riwayat penerimaan honorarium dan slip gaji Anda." position="Guru" initials="GR">
    
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px;">
        <div style="flex: 1;">
            <div style="font-size: 14px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                <i class="fa-solid fa-wallet"></i> Keuangan Guru
            </div>
            <div style="font-size: 18px; font-weight: bold; color: #1e293b;">
                Arsip Slip Pembayaran
            </div>
            <div style="color: #64748b; font-size: 14px; margin-top: 4px;">
                Akses dan unduh slip gaji atau honorarium yang telah diterbitkan.
            </div>
        </div>
    </div>

    <div style="background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
            <div style="font-size: 16px; font-weight: bold; color: #1e293b;">
                Daftar Transaksi
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <div style="position: relative;">
                    <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <input type="text" id="slipSearch" placeholder="Cari periode atau keterangan..." style="padding: 8px 12px 8px 36px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; width: 250px;">
                </div>
            </div>
        </div>

        <x-siakad.ui.table>
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">No</th>
                    <th style="width: 150px;">Tanggal Terbit</th>
                    <th>Periode & Keterangan</th>
                    <th style="width: 150px; text-align: right;">Nominal (Rp)</th>
                    <th style="width: 120px; text-align: center;">Status</th>
                    <th style="width: 80px; text-align: center;">Unduh</th>
                </tr>
            </thead>
            <tbody id="slipRows">
                <!-- Data Dummy -->
                <tr>
                    <td style="text-align: center;">1</td>
                    <td style="color: #64748b; font-size: 13px;">25 Agu 2026</td>
                    <td>
                        <strong style="display: block; color: #1e293b; font-size: 14px; margin-bottom: 4px;">Honorarium Agustus 2026</strong>
                        <span style="color: #64748b; font-size: 12px;">Gaji pokok dan tunjangan</span>
                    </td>
                    <td style="text-align: right; font-weight: bold; color: #1e293b;">3.500.000</td>
                    <td style="text-align: center;">
                        <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; background: #dcfce7; color: #166534; border-radius: 20px; font-size: 12px; font-weight: 600;">
                            <i class="fa-solid fa-circle-check"></i> Selesai
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <button style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #e9f2ff; color: #3875c5; border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#3875c5'; this.style.color='#fff';" onmouseout="this.style.background='#e9f2ff'; this.style.color='#3875c5';">
                            <i class="fa-solid fa-download"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td style="color: #64748b; font-size: 13px;">25 Jul 2026</td>
                    <td>
                        <strong style="display: block; color: #1e293b; font-size: 14px; margin-bottom: 4px;">Honorarium Juli 2026</strong>
                        <span style="color: #64748b; font-size: 12px;">Gaji pokok dan tunjangan</span>
                    </td>
                    <td style="text-align: right; font-weight: bold; color: #1e293b;">3.500.000</td>
                    <td style="text-align: center;">
                        <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; background: #dcfce7; color: #166534; border-radius: 20px; font-size: 12px; font-weight: 600;">
                            <i class="fa-solid fa-circle-check"></i> Selesai
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <button style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #e9f2ff; color: #3875c5; border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#3875c5'; this.style.color='#fff';" onmouseout="this.style.background='#e9f2ff'; this.style.color='#3875c5';">
                            <i class="fa-solid fa-download"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </x-siakad.ui.table>
    </div>

    <script>
        document.getElementById('slipSearch')?.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('#slipRows tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
            });
        });
    </script>
</x-siakad-layout>
