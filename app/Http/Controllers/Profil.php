<?php

namespace App\Http\Controllers;

use App\Models\Norek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Profil extends Controller
{
    public function index()
    {
        $norek = Norek::all();
        return view('profil' , compact('norek'));
    }

    public function uploadPhoto(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:5048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        if ($user->foto && $user->foto != 'default.png') {
            Storage::delete('public/' . $user->foto);
        }

        $path = $request->file('foto')->store('public/foto_profil');
        $user->foto = str_replace('public/', '', $path);
        $user->save();

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}