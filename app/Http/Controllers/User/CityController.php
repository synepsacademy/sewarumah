<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\Datakost;

use Illuminate\Http\Request;

class CityController extends Controller
{
    //menampilkan halaman kota
    public function showCity($id)
    {
        $kota = Kota::withCount('kosts')->findOrFail($id);
        $kosts = Datakost::where('kota_id', $id)->get();

        return view('user.city', compact('kota', 'kosts'));
    }
}
