<?php

namespace App\Http\Controllers;

use App\Models\Data_barang;
use Illuminate\Http\Request;
use App\Models\Barang_masuk;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(){
        $filter_masuk = request()->query('filter_masuk', 'semua');
        $filter_keluar = request()->query('filter_keluar', 'semua');
        $query_bm = DB::table('barang_masuk');
        $query_bk = DB::table('barang_keluar');

        if ($filter_masuk === 'hari'){
            $query_bm->whereDate('tanggal_masuk', Carbon::today());
        } elseif ($filter_masuk === 'bulan') {
            $query_bm->whereMonth('tanggal_masuk', Carbon::now()->month)
                  ->whereYear('tanggal_masuk', Carbon::now()->year);
        } elseif ($filter_masuk === 'tahun') {
            $query_bm->whereYear('tanggal_masuk', Carbon::now()->year);
        }
        $barang_masuk =  $query_bm->select(DB::raw('SUM(jumlah_masuk) as total_masuk'))->first();

        if ($filter_keluar === 'hari'){
            $query_bk->whereDate('tanggal_keluar', Carbon::today());
        } elseif ($filter_keluar === 'bulan') {
            $query_bk->whereMonth('tanggal_keluar', Carbon::now()->month)
                  ->whereYear('tanggal_keluar', Carbon::now()->year);
        } elseif ($filter_keluar === 'tahun') {
            $query_bk->whereYear('tanggal_keluar', Carbon::now()->year);
        }
        $barang_keluar = $query_bk->select(DB::raw('SUM(jumlah_keluar) as total_keluar'))->first();

        $stokBarang = Data_barang::select('nama_barang', 'stok')->get();
        $data_barang = Data_barang::count();
        return view('admin.index', compact('data_barang', 'stokBarang', 'barang_masuk', 'barang_keluar', 'filter_masuk', 'filter_keluar'));
    }
}
