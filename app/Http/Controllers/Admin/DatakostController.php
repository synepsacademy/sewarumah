<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kota;
use App\Models\Fasilitas;
use App\Models\Datakost;

class DatakostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kosts = Datakost::with('kota')->get();
        $kotas = Kota::withCount('kosts')->get();

        $fasilitas = Fasilitas::all();
        return view('admin.datakost.datakost', compact('kosts', 'kotas', 'fasilitas'));
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
            'nama_kost' => 'required',
            'harga' => 'required|numeric',
            'alamat' => 'required',
            'jumlah_kamar' => 'required|numeric',
            'kota_id' => 'required|exists:kotas,id',
            'foto' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'map' => 'nullable|string'
        ]);

        $foto1 = $request->file('foto_1')?->store('foto_kost', 'public');
        $foto2 = $request->file('foto_2')?->store('foto_kost', 'public');
        $foto3 = $request->file('foto_3')?->store('foto_kost', 'public');

        $kost = Datakost::create([
            'nama_kost' => $request->nama_kost,
            'harga' => $request->harga,
            'alamat' => $request->alamat,
            'jumlah_kamar' => $request->jumlah_kamar,
            'kota_id' => $request->kota_id,
            'foto_1' => $foto1,
            'foto_2' => $foto2,
            'foto_3' => $foto3,
            'map' => $request->map,
        ]);

        $kost->fasilitas()->sync($request->fasilitas);

        return redirect()->back()->with('success', 'Kost berhasil ditambahkan!');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kost' => 'required',
            'harga' => 'required|numeric',
            'alamat' => 'required',
            'jumlah_kamar' => 'required|numeric',
            'kota_id' => 'required|exists:kotas,id',
            'foto_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'map' => 'nullable|string',
        ]);

        $kost = Datakost::findOrFail($id);

        // Upload jika ada foto baru
        if ($request->hasFile('foto_1')) {
            $kost->foto_1 = $request->file('foto_1')->store('foto_kost', 'public');
        }

        if ($request->hasFile('foto_2')) {
            $kost->foto_2 = $request->file('foto_2')->store('foto_kost', 'public');
        }

        if ($request->hasFile('foto_3')) {
            $kost->foto_3 = $request->file('foto_3')->store('foto_kost', 'public');
        }

        // Update field lainnya
        $kost->update([
            'nama_kost' => $request->nama_kost,
            'harga' => $request->harga,
            'alamat' => $request->alamat,
            'jumlah_kamar' => $request->jumlah_kamar,
            'kota_id' => $request->kota_id,
            'map' => $request->map,
        ]);

        // Sync fasilitas
        $kost->fasilitas()->sync($request->fasilitas);

        return redirect()->back()->with('success', 'Kost berhasil diperbarui!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kost = Datakost::findOrFail($id);
        $kost->delete();

        return redirect()->back()->with('toast', 'Data Kost berhasil dihapus!');
    }
}
