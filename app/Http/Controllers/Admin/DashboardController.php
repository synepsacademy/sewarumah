<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Datakost;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKost = Datakost::count();
        $jumlahUser = User::where('role', '!=', 'admin')->count();
        $bookingHariIni = Booking::whereDate('created_at', today())->count();
        $bookingMenunggu = Booking::where('status', 'menunggu')->count();
        $bookingTerbaru = Booking::with('user', 'kost')->latest()->take(5)->get();

        $quotes = [
            '"Mengelola data dengan rapi adalah langkah kecil menuju sistem yang hebat."',
            '"Admin bukan hanya penjaga sistem, tapi pahlawan di balik layar."',
            '"Satu klik persetujuan hari ini, satu senyum penyewa besok."',
            '"Dashboard bukan akhir, ini tempat semua aksi dimulai."'
        ];

        $motivasi = $quotes[array_rand($quotes)];

        return view('admin.dashboard', compact(
            'jumlahKost',
            'jumlahUser',
            'bookingHariIni',
            'bookingMenunggu',
            'bookingTerbaru',
            'motivasi'
        ));
    }
}
