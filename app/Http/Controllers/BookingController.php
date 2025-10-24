<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datakost;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $orders = Booking::with('kost')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.order', compact('orders'));
    }

    public function store(Request $request, $kostId)
    {
        $request->validate([
            'checkin_date' => 'required|date|after_or_equal:today',
        ]);

        $userId = Auth::id();
        $checkin = $request->checkin_date;

        // Cek apakah user sudah pernah booking kost ini di tanggal yang sama
        $sudahBooking = Booking::where('user_id', $userId)
            ->where('datakost_id', $kostId)
            ->where('checkin_date', $checkin)
            ->exists();

        if ($sudahBooking) {
            return redirect()->back()->with('error', 'Kamu sudah memesan kost ini untuk tanggal tersebut.');
        }

        $kost = Datakost::findOrFail($kostId);

        if ($kost->jumlah_kamar <= 0) {
            return redirect()->back()->with('error', 'Kamar kost sudah penuh.');
        }

        // Simpan booking
        Booking::create([
            'user_id' => $userId,
            'datakost_id' => $kostId,
            'checkin_date' => $checkin,
            'status' => Booking::STATUS_MENUNGGU,
            'kode_booking' => strtoupper(Str::random(10)), // optional kalo kamu pakai kode
        ]);

        // Kurangi jumlah kamar
        $kost->decrement('jumlah_kamar');

        return redirect()->route('order')->with('success', 'Pesanan berhasil dibuat. Silakan upload bukti pembayaran.');
    }

}
