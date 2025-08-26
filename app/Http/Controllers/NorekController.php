<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Norek;
use Illuminate\Support\Facades\Validator;

class NorekController extends Controller
{
    public function changeNorek(Request $request, $id)
    {
        $norek = Norek::findOrFail($id);

        $rules = [
            'nomor'  => 'required|numeric|min:12',
            'nama'   => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->failed()) {
            return redirect()->withErrors($validator)->withInput();
        }

        $validateData = $validator->validated();

        $norek->update([
            'nomor' => $validateData['nomor'],
            'nama'  => $validateData['nama']
        ]);

        return redirect()->route('profil')->with(['success'  => 'Data berhasil diubah']);
    }
}