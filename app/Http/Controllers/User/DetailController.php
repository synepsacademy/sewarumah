<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Datakost;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    //menampilkan halaman detail kost
    public function show($id)
    {
        $kost = Datakost::with('kota')->findOrFail($id); // pastikan relasi 'kota' sudah didefinisikan
        return view('user.detail', compact('kost'));
    }
}
