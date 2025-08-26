<?php

namespace App\Http\Controllers;

use App\Models\Data_barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Rekap_data;
use Illuminate\Support\Facades\Log;

class RekapDataController extends Controller
{
    // ========== HARSIAN ========== //
public function index(Request $request)
    {
        $mode = $request->query('mode', 'harian');

        $harianQuery = Rekap_data::selectRaw('tanggal, SUM(penjualan) AS penjualan, SUM(pembelian) AS pembelian, SUM(keuntungan) AS keuntungan')
            ->groupBy('tanggal')
            ->orderByDesc('tanggal');

        if ($request->filled('search')) {
            $harianQuery->havingRaw('tanggal LIKE ?', ['%'.$request->search.'%']);
        }
        $rekapHarian = $harianQuery->paginate(10)->withQueryString();

        $bulanParam = $request->query('bulan', Carbon::now()->format('Y-m'));
        $bulanDt   = Carbon::parse($bulanParam);
        $rekapBulanan = Rekap_data::selectRaw(
                'DATE(tanggal) AS tanggal,
                 SUM(keuntungan) AS keuntungan,
                 SUM(modal_per_akhir) AS modal_per_akhir,
                 SUM(sub_total) AS sub_total'
            )
            ->whereYear('tanggal', $bulanDt->year)
            ->whereMonth('tanggal', $bulanDt->month)
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $tahunParam = $request->query('tahun', Carbon::now()->year);
        $rekapTahunan = Rekap_data::selectRaw(
                'MONTH(tanggal) AS bulan,
                 SUM(keuntungan) AS keuntungan,
                 SUM(modal_per_akhir) AS modal_per_akhir,
                 SUM(sub_total) AS sub_total'
            )
            ->whereYear('tanggal', $tahunParam)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('rekap_data.index', compact(
            'mode',
            'rekapHarian',
            'rekapBulanan',
            'rekapTahunan',
            'bulanParam',
            'tahunParam'
        ));
    }

    public function cetakHarian(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
        ]);

        $tanggal = $request->tanggal;
        $barangs = Data_barang::all();
        $dataRekap = [];

        foreach ($barangs as $barang) {
            $pembelian = DB::table('barang_masuk')
                ->where('id_barang', $barang->id_barang)
                ->whereDate('tanggal_masuk', $tanggal)
                ->sum('jumlah_masuk');

            $penjualan = DB::table('barang_keluar')
                ->where('id_barang', $barang->id_barang)
                ->whereDate('tanggal_keluar', $tanggal)
                ->sum('jumlah_keluar');

                    Log::info('Penjualan untuk barang ' . $barang->nama_barang . ' pada tanggal ' . $tanggal . ': ' . $penjualan);


            $totalPenjualan = DB::table('barang_keluar')
                ->where('id_barang', $barang->id_barang)
                ->whereDate('tanggal_keluar', '>', $tanggal)
                ->sum('jumlah_keluar'); 
            $totalPembelian = DB::table('barang_masuk')
                ->where('id_barang', $barang->id_barang)
                ->whereDate('tanggal_masuk', '>', $tanggal)
                ->sum('jumlah_masuk');

            $stok_awal = $barang->stok + $totalPenjualan - $totalPembelian;
            $stok_akhir = $stok_awal + $pembelian - $penjualan;

            $keuntungan = ($barang->harga_jual - $barang->harga_beli) * $penjualan;
            $modal_per_akhir = $stok_akhir * $barang->harga_beli;
            $sub_total = $penjualan * $barang->harga_jual;

            $dataRekap[] = [
                'nama_barang' => $barang->nama_barang,
                'satuan' => $barang->package,
                'stok_awal' => $stok_awal,
                'pembelian' => $pembelian,
                'penjualan' => $penjualan,
                'stok_akhir' => $stok_akhir,
                'harga_beli' => $barang->harga_beli,
                'harga_jual' => $barang->harga_jual,
                'keuntungan' => $keuntungan,
                'modal_per_akhir' => $modal_per_akhir,
                'sub_total' => $sub_total,
            ];
        }

        return view('rekap_data.print_harian', [
            'dataRekap' => $dataRekap,
            'tanggal' => Carbon::parse($tanggal)->translatedFormat('l, d F Y')
        ]);
    }

    public function hapusHarian($tanggal)
    {
        Rekap_data::whereDate('tanggal', $tanggal)->delete();

        return redirect()->route('rekap.index')->with('success', 'Data rekap tanggal ' . $tanggal . ' berhasil dihapus.');
    }

    public function cetakBulanan(Request $request)
    {
        $request->validate([
            'bulan' => 'required|date_format:Y-m'
        ]);

        $bulan = Carbon::parse($request->bulan);
        $rekap = DB::table('rekap_data')
            ->selectRaw('DATE(tanggal) as tanggal, SUM(keuntungan) as keuntungan, SUM(modal_per_akhir) as modal_per_akhir, SUM(sub_total) as sub_total')
            ->whereMonth('tanggal', $bulan->month)
            ->whereYear('tanggal', $bulan->year)
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('rekap_data.print_bulanan', [
            'rekapBulanan' => $rekap,
            'bulan' => $bulan->translatedFormat('F Y'),
            'user' => auth()->user()->name ?? 'Admin'
        ]);
    }

    public function cetakTahunan(Request $request)
    {
        $request->validate([
            'tahun' => 'required|digits:4'
        ]);

        $tahun = $request->tahun;
        $rekap = DB::table('rekap_data')
            ->selectRaw('MONTH(tanggal) as bulan, SUM(keuntungan) as keuntungan, SUM(modal_per_akhir) as modal_per_akhir, SUM(sub_total) as sub_total')
            ->whereYear('tanggal', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('rekap_data.print_tahunan', [
            'rekapTahunan' => $rekap,
            'tahun' => $tahun,
            'user' => auth()->user()->name ?? 'Admin'
        ]);
    }

    public function simpanHarian(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
        ]);
        $tanggal = $request->tanggal;
        $barangs = Data_barang::all();
        foreach ($barangs as $barang) {
            $pembelian = DB::table('barang_masuk')
                ->where('id_barang', $barang->id_barang)
                ->whereDate('tanggal_masuk', $tanggal)
                ->sum('jumlah_masuk');

            $penjualan = DB::table('barang_keluar')
                ->where('id_barang', $barang->id_barang)
                ->whereDate('tanggal_keluar', $tanggal)
                ->sum('jumlah_keluar');

            $stok_awal = $barang->stok + $penjualan - $pembelian;
            $stok_akhir = $stok_awal + $pembelian - $penjualan;

            $keuntungan = ($barang->harga_jual - $barang->harga_beli) * $penjualan;
            $modal_per_akhir = $stok_akhir * $barang->harga_beli;
            $sub_total = $penjualan * $barang->harga_jual;

            Rekap_data::updateOrCreate(
                [
                    'tanggal' => $tanggal,
                    'data_barang_id' => $barang->id_barang
                ],
                [
                    'jenis' => 'keluar', 
                    'jumlah' => $penjualan,
                    'keterangan' => 'Rekap otomatis',

                    'stok_awal' => $stok_awal,
                    'pembelian' => $pembelian,
                    'penjualan' => $penjualan,
                    'stok_akhir' => $stok_akhir,
                    'harga_beli' => $barang->harga_beli,
                    'harga_jual' => $barang->harga_jual,
                    'keuntungan' => $keuntungan,
                    'modal_per_akhir' => $modal_per_akhir,
                    'sub_total' => $sub_total
                ]
            );
        }

        return redirect()->route('rekap.index')->with('success', 'Data rekap harian tanggal ' . $tanggal . ' berhasil disimpan');
    }
}
