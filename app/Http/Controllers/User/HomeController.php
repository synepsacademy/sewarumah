<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Datakost;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // menampilkan halaman home
    public function index()
    {
        $kosts = Datakost::latest()->take(6)->get(); // ambil 6 terbaru
        return view('user.home', compact('kosts'));
    }
}
