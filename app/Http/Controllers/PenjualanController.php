<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Data_barang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Barang_keluar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{

    public function index()
    {
        $penjualan = Penjualan::all();
        return view('penjualan.index', compact('penjualan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|min:3|max:100',
            'tanggal'        => 'required|date',
        ]);

        $kode_penjualan = Str::upper(Str::random(8));
        $penjualan = Penjualan::create([
            'kode_penjualan' => $kode_penjualan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'tanggal'        => $request->tanggal,
            'total'          => 0,
        ]);

        return redirect()->route('penjualan.show', $penjualan->id)
            ->with('success', 'Data penjualan berhasil ditambahkan. Silakan isi barang yang dibeli.');
    }

    public function show($id)
    {
        $detail_penjualan = Penjualan::with('barangKeluar.dataBarang')->findOrFail($id);
        $barangs = Data_barang::all();
        $detail = Barang_keluar::with('dataBarang')
        ->where('id_penjualan', $id)
        ->get();

        return view('penjualan.show', compact('detail_penjualan', 'detail', 'barangs'));
    }

    public function cetak_nota($id){
        $penjualan = Penjualan::with('barangKeluar.dataBarang')->findOrFail($id);
        $barangs = Data_barang::all();
        $norek = DB::table('norek')->first();
        $detail = Barang_keluar::with('dataBarang')
        ->where('id_penjualan', $id)
        ->get();

        return view('penjualan.cetak', compact('penjualan', 'barangs', 'detail', 'norek'));
    }

    public function destroy($id){
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();
        return redirect()->route('penjualan.index')->with(['success' => 'Data berhasil dihapus']);
    }
}