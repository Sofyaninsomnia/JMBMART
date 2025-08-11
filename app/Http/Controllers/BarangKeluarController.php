<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Data_barang;
use Illuminate\Http\Request;
use App\Models\Barang_keluar;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all barang_keluar
        $barang_keluar = Barang_keluar::all();
        $data_barang = Data_barang::all();
        return view('barang_keluar.index', compact('barang_keluar', 'data_barang'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeDetail(Request $request, $id)
    {

        $penjualan = Penjualan::findOrFail($id);
        $request->validate([
            'id_barang'     => 'required|exists:data_barang,id_barang',
            'jumlah_keluar' => 'required|integer|min:1',
        ]);

        $barang = Data_barang::findOrFail($request->id_barang);
        if ($request->jumlah_keluar > $barang->stok) {
            return redirect()->back()->withInput()
                ->with('swal_error', 'Stok barang ' . $barang->nama_barang . ' tidak mencukupi. Stok tersedia: ' . $barang->stok);
        }
        $subtotal = $barang->harga_jual * $request->jumlah_keluar;

        Barang_keluar::create([
            'id_barang'      => $barang->id_barang,
            'tanggal_keluar' => $penjualan->tanggal,
            'jumlah_keluar'  => $request->jumlah_keluar,
            'keterangan'     => 'Penjualan',
            'id_penjualan'   => $id,
        ]);
        $penjualan->total += $subtotal;
        $penjualan->save();

        return redirect()->route('penjualan.show', $id)->with('success', 'Barang berhasil ditambahkan');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_barang_keluar)
    {
        $barang_keluar = Barang_keluar::findOrFail($id_barang_keluar);
        $id_penjualan = $barang_keluar->id_penjualan; // ambil dulu sebelum hapus
        $barang_keluar->delete();

        return redirect()->route('penjualan.show', $id_penjualan)->with('success', 'Data berhasil dihapus');
    }
}
