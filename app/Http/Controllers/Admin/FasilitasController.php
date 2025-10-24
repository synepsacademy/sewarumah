<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('admin.datakost.fasilitas', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string',
            'icon' => 'required|string',
        ]);

        Fasilitas::create($request->all());

        return redirect()->back()->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string',
            'icon' => 'required|string',
        ]);

        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->update($request->all());

        return redirect()->back()->with('success', 'Fasilitas berhasil diupdate');
    }

    public function destroy($id)
    {
        Fasilitas::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Fasilitas berhasil dihapus');
    }
}
