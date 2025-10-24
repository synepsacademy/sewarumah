<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kota;

class LocationController extends Controller
{
    public function index()
    {
        $kotas = Kota::withCount('kosts')->get();
        return view('admin.location', compact('kotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kota' => 'required|string|max:100',
            'gambar_kota' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gambarPath = $request->file('gambar_kota')->store('gambar_kota', 'public');

        Kota::create([
            'nama_kota' => $request->nama_kota,
            'gambar_kota' => $gambarPath,
        ]);

        return redirect()->back()->with('success', 'Kota berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kota' => 'required|string|max:255',
            'gambar_kota' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $kota = Kota::findOrFail($id);
        $kota->nama_kota = $request->nama_kota;

        if ($request->hasFile('gambar_kota')) {
            $gambarPath = $request->file('gambar_kota')->store('gambar_kota', 'public');
            $kota->gambar_kota = $gambarPath;
        }

        $kota->save();

        return redirect()->back()->with('success', 'Data kota berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kota = Kota::findOrFail($id);
        $kota->delete();

        return redirect()->back()->with('success', 'Kota berhasil dihapus.');
    }
}
