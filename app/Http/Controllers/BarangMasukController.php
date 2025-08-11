<?php

namespace App\Http\Controllers;

use App\Models\Barang_masuk;
use App\Models\Data_barang;
use Dotenv\Validator;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // Get all barang_masuk
        $barang_masuk = Barang_masuk::all();
        $data_barang = Data_barang::all();
        return view('barang_masuk.index', compact('barang_masuk', 'data_barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id_barang' => 'required|exists:data_barang,id_barang',
            'tanggal_masuk' => 'required|date',
            'jumlah_masuk' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Barang_masuk::create($request->all());

        return redirect()->route('barang_masuk.index')->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_barang_masuk)
    {
        $data_barang = Barang_masuk::findOrFail($id_barang_masuk);
        $data_barang->delete();

        return redirect()->route('barang_masuk.index')->with('success', 'Barang masuk berhasil dihapus.');
    }
}
