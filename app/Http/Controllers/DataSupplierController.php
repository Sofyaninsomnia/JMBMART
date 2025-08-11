<?php

namespace App\Http\Controllers;

use App\Models\DataSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_supplier = DataSupplier::all();
        return view('data_supplier.index', compact('data_supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|min:3|max:120',
            'alamat' => 'required|min:3|max:255',
            'no_telp_supplier' => 'required|numeric|min:10'
        ]);
        
        $validator = Validator::make($request->all(), [
            'nama_supplier' => 'required|min:3|max:120',
            'alamat' => 'required|min:3|max:255',
            'no_telp_supplier' => 'required|numeric|min:10'
        ], [
            'nama_supplier.required' => 'Nama supplier harus diisi!',
            'alamat.required' => 'Alamat harus diisi!',
            'no_telp_supplier.required' => 'Nomor telepon supplier harus diisi!'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DataSupplier::create($request->all());
        return redirect()->route('data_supplier.index')->with(['success' => 'Data berhasil disimpan']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_supplier)              
    {
        $request->validate([
            'nama_supplier' => 'required|min:3|max:120',
            'alamat' => 'required|min:3|max:255',
            'no_telp_supplier' => 'required|numeric|min:10'
        ]);

        $validator = Validator::make($request->all(), [
            'nama_supplier' => 'required|min:3|max:120',
            'alamat' => 'required|min:3|max:255',
            'no_telp_supplier' => 'required|numeric|min:10'
        ], [
            'nama_supplier.required' => 'Nama supplier harus diisi!',
            'alamat.required' => 'Alamat harus diisi!',
            'no_telp_supplier.required' => 'Nomor telepon supplier harus diisi!'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $supplier = DataSupplier::findOrFail($id_supplier);
        $supplier->update($request->all());
        return redirect()->route('data_supplier.index')->with(['success' => 'Data berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_supplier)
    {
        $id_supplier = DataSupplier::findOrFail($id_supplier);
        $id_supplier->delete();
        return redirect()->route('data_supplier.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
