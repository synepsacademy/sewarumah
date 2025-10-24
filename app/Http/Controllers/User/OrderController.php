<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Booking;

class OrderController extends Controller
{
    //menampilkan halaman order
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())->with('kost.kota')->latest()->get();
        return view('user.order', compact('bookings'));
    }

    public function cancel($id)
    {
        $booking = Booking::where('user_id', auth()->id())->findOrFail($id);

        // Kembalikan jumlah kamar
        $booking->kost->increment('jumlah_kamar');

        $booking->status = Booking::STATUS_DIBATALKAN;
        $booking->save();

        return redirect()->route('order')->with('success', 'Pesanan berhasil dibatalkan.');
    }


    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $order = Booking::where('user_id', auth()->id())->findOrFail($id);

        // Simpan file bukti bayar
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        $order->bukti_pembayaran = $path;


        $order->status = Booking::STATUS_DIBAYAR;


        $order->save();

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload. Menunggu persetujuan admin.');
    }
}
