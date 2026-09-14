<?php

namespace App\Http\Controllers;

use App\Models\slip_pembayaran_ipp;
use App\Models\slip_pembayaran_pangkal;
use App\Models\slip_pembayaran_pendidikan;
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
}
