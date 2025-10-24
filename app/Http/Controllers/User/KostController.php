<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class KostController extends Controller
{
    // menampilkan halaman kost
    public function index()
    {
        return view('user.kost');
    }
}
