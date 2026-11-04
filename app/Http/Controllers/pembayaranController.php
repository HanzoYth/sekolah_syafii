<?php

namespace App\Http\Controllers;

use App\Models\slip_pembayaran_ipp;
use App\Models\slip_pembayaran_pangkal;
use App\Models\slip_pembayaran_pendidikan;
use App\Models\siswa;
use App\Models\ruang_kelas;
use App\Models\jenis_sekolah;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class pembayaranController extends Controller
{
    public function data(Request $request)
    {
        $jenis   = $request->query('jenis', 'pendapatan');
        $periode = $request->query('periode', 'mingguan');

        if ($periode === 'mingguan') {
            $tanggal = $request->query('tanggal')
                ? Carbon::parse($request->query('tanggal'))
                : Carbon::now();

            $awal  = $tanggal->copy()->startOfWeek(Carbon::MONDAY);
            $akhir = $tanggal->copy()->endOfWeek(Carbon::SUNDAY);
        } else {
            $bulan = $request->query('bulan') ?? Carbon::now()->format('Y-m');
            [$tahun, $bln] = explode('-', $bulan);

            $awal  = Carbon::create((int) $tahun, (int) $bln, 1)->startOfMonth();
            $akhir = $awal->copy()->endOfMonth();
        }

        $rows = $jenis === 'tunggakan'
            ? $this->ambilTunggakan($awal, $akhir)
            : $this->ambilPendapatan($awal, $akhir);

        $labels    = [];
        $data      = [];
        $hariLabel = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

        $cursor = $awal->copy()->startOfDay();
        $batas  = $akhir->copy()->startOfDay();

        while ($cursor->lte($batas)) {
            $key = $cursor->format('Y-m-d');

            $labels[] = $periode === 'mingguan'
                ? $hariLabel[$cursor->dayOfWeek] . ' ' . $cursor->format('j/n')
                : $cursor->format('j');

            $data[] = isset($rows[$key]) ? (float) $rows[$key] : 0;

            $cursor->addDay();
        }

        return response()->json([
            'jenis'   => $jenis,
            'periode' => $periode,
            'labels'  => $labels,
            'data'    => $data,
        ]);
    }

    private function ambilPendapatan(Carbon $awal, Carbon $akhir): array
    {
        $mulai = $awal->copy()->startOfDay();
        $sampai = $akhir->copy()->endOfDay();

        $pendidikan = DB::table('slip_pembayaran_pendidikan')
            ->selectRaw('DATE(created_at) as tgl, SUM(jumlah_di_bayar) as total')
            ->whereBetween('created_at', [$mulai, $sampai])
            ->groupBy('tgl');

        $pangkal = DB::table('slip_pembayaran_pangkal')
            ->selectRaw('DATE(created_at) as tgl, SUM(jumlah_di_bayar) as total')
            ->whereBetween('created_at', [$mulai, $sampai])
            ->groupBy('tgl');

        $ipp = DB::table('slip_pembayaran_ipp')
            ->selectRaw('DATE(created_at) as tgl, SUM(jumlah_dibayar) as total')
            ->whereBetween('created_at', [$mulai, $sampai])
            ->groupBy('tgl');

        $gabungan = $pendidikan->unionAll($pangkal)->unionAll($ipp);

        return DB::table(DB::raw("({$gabungan->toSql()}) as gabungan"))
            ->mergeBindings($gabungan)
            ->selectRaw('tgl, SUM(total) as total')
            ->groupBy('tgl')
            ->pluck('total', 'tgl')
            ->toArray();
    }

    private function ambilTunggakan(Carbon $awal, Carbon $akhir): array
    {
        $mulai = $awal->copy()->startOfDay();
        $sampai = $akhir->copy()->endOfDay();

        $pendidikan = DB::table('slip_pembayaran_pendidikan')
            ->selectRaw('DATE(created_at) as tgl, SUM(nominal - jumlah_di_bayar) as total')
            ->where('status', 0)
            ->whereBetween('created_at', [$mulai, $sampai])
            ->groupBy('tgl');

        $pangkal = DB::table('slip_pembayaran_pangkal')
            ->selectRaw('DATE(created_at) as tgl, SUM(nominal - jumlah_di_bayar) as total')
            ->where('status', 0)
            ->whereBetween('created_at', [$mulai, $sampai])
            ->groupBy('tgl');

        $ipp = DB::table('slip_pembayaran_ipp')
            ->selectRaw('DATE(created_at) as tgl, SUM(nominal - jumlah_dibayar) as total')
            ->where('status', 0)
            ->whereBetween('created_at', [$mulai, $sampai])
            ->groupBy('tgl');

        $gabungan = $pendidikan->unionAll($pangkal)->unionAll($ipp);

        return DB::table(DB::raw("({$gabungan->toSql()}) as gabungan"))
            ->mergeBindings($gabungan)
            ->selectRaw('tgl, SUM(total) as total')
            ->groupBy('tgl')
            ->pluck('total', 'tgl')
            ->toArray();
    }

    public function detail_pembayaran_siswa(Request $request)
    {
        $id = $request->query('id');
        $type = strtolower($request->query('type', 'ipp'));

        $slip = null;
        $jenis_label = 'SPP / IPP Bulanan';
        $periode_label = '-';

        if ($type === 'pangkal') {
            $slip = $id ? slip_pembayaran_pangkal::with(['siswa.kelas', 'siswa.sekolah', 'siswa.tahunAjaran'])->find($id) : null;
            $jenis_label = 'Uang Pangkal Siswa';
            $periode_label = ($slip && $slip->siswa && $slip->siswa->tahunAjaran) ? $slip->siswa->tahunAjaran->nama : 'Tahun Masuk';
        } elseif ($type === 'pendidikan') {
            $slip = $id ? slip_pembayaran_pendidikan::with(['siswa.kelas', 'siswa.sekolah', 'siswa.tahunAjaran'])->find($id) : null;
            $jenis_label = 'Dana Pengembangan Pendidikan';
            $periode_label = ($slip && $slip->siswa && $slip->siswa->tahunAjaran) ? $slip->siswa->tahunAjaran->nama : 'Tahunan';
        } else {
            $type = 'ipp';
            $slip = $id ? slip_pembayaran_ipp::with(['siswa.kelas', 'siswa.sekolah', 'siswa.tahunAjaran'])->find($id) : null;
            $jenis_label = 'SPP / IPP Bulanan';
            $periode_label = ($slip && $slip->tanggal_awal) ? Carbon::parse($slip->tanggal_awal)->locale('id')->isoFormat('MMMM Y') : '-';
        }

        // Fallback jika id tidak ditemukan
        if (!$slip) {
            $slip = slip_pembayaran_ipp::with(['siswa.kelas', 'siswa.sekolah', 'siswa.tahunAjaran'])->latest()->first();
            $type = 'ipp';
            $jenis_label = 'SPP / IPP Bulanan';
            if ($slip && $slip->tanggal_awal) {
                $periode_label = Carbon::parse($slip->tanggal_awal)->locale('id')->isoFormat('MMMM Y');
            }
        }
        if (!$slip) {
            $slip = slip_pembayaran_pangkal::with(['siswa.kelas', 'siswa.sekolah', 'siswa.tahunAjaran'])->latest()->first();
            $type = 'pangkal';
            $jenis_label = 'Uang Pangkal Siswa';
        }

        if (!$slip) {
            return redirect('/sk/ppl')->with('error', 'Belum ada data pembayaran yang tersimpan.');
        }

        $nominal = (float) $slip->nominal;
        $dibayar = (float) ($slip->jumlah_dibayar ?? $slip->jumlah_di_bayar ?? 0);
        $sisa = max(0, $nominal - $dibayar);
        $isLunas = (bool) $slip->status || ($nominal > 0 && $dibayar >= $nominal);

        $invoice_no = 'INV/' . strtoupper($type) . '/' . ($slip->created_at ? Carbon::parse($slip->created_at)->format('Ym') : date('Ym')) . '/' . str_pad($slip->id, 4, '0', STR_PAD_LEFT);

        return view('modul.siakad.admin.detailPembayaran', compact(
            'slip',
            'type',
            'jenis_label',
            'periode_label',
            'nominal',
            'dibayar',
            'sisa',
            'isLunas',
            'invoice_no'
        ));
    }

    public function Ambil_DataPembayaran(Request $request)
    {
        return redirect('/sk/ppl');
    }
}
