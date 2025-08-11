<?php

namespace App\Http\Controllers;

use App\Models\Data_barang;
use App\Models\DataSupplier;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DataBarangController extends Controller
{

    public function index()
    {
        $kategori = Kategori::all();
        $supplier = DataSupplier::all();
        $data_barang = Data_barang::all();
        return view('data_barang.index', compact('kategori', 'supplier', 'data_barang'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_barang'           => 'required|min:3|max:120',
            'package'               => 'required|min:3|max:100',
            'harga_beli'            => 'required|numeric|min:4',
            'harga_jual'            => 'required|numeric|min:4',
            'id_kategori'           => 'required|integer|exists:kategori,id_kategori',
            'stok'                  => 'nullable',
            'id_supplier'           => 'required|integer|exists:data_supplier,id_supplier'
        ];

        $messages = [
            'nama_barang.required'      => 'Nama barang harus di isi!',
            'package.required'          => 'Package harus di isi!',
            'harga_beli.required'       => 'Harga beli harus di isi!',
            'harga_jual.required'       => 'Harga jual harus di isi!',
            'id_kategori.required'      => 'Id kategori harus di isi!',
            'id_supplier.required'      => 'Id supplier harus di isi!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $kode_barang = Str::upper(Str::random(8));
        $barang = Data_barang::create([
            'kode_barang'       => $kode_barang,
            'nama_barang'       => $request->nama_barang,
            'package'           => $request->package,
            'harga_beli'        => $request->harga_beli,
            'harga_jual'        => $request->harga_jual,
            'id_kategori'       => $request->id_kategori,
            'stok'              => $request->stok,
            'id_supplier'       => $request->id_supplier
        ]);

        Log::info('Data_barang created successfully:', $barang->toArray());
        return redirect()->route('data_barang.index')->with(['success' => 'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data_barang = Data_barang::findOrFail($id);
        return view('data_barang.show', compact('data_barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Data_barang $data_barang)
    {
        $kategori = Kategori::all();
        $supplier = DataSupplier::all();
        return view('data_barang.edit', compact('data_barang', 'kategori', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $data_barang = Data_barang::findOrFail($id);
    $rules = [
        'nama_barang' => 'required|min:3|max:120',
        'package'     => 'required|min:3|max:100',
        'harga_beli'  => 'required|integer|min:1000',
        'harga_jual'  => 'required|integer|min:1000',
        'id_kategori' => 'required|integer|exists:kategori,id_kategori',
        'id_supplier' => 'required|integer|exists:data_supplier,id_supplier',
        'stok'        => 'nullable|integer',
    ];

    $validated = $request->validate($rules);
    $data_barang->update($validated);

    return redirect()
        ->route('data_barang.index')
        ->with('success', 'Data berhasil diubah');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $data_barang = Data_barang::findOrFail($id);
        $data_barang->delete();

        return redirect()->route('data_barang.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
