<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Booking::with(['user', 'kost'])
            ->latest()
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function approve($id)
    {
        $order = Booking::findOrFail($id);

        $order->status = 'disetujui';
        $order->kode_booking = 'BK' . strtoupper(uniqid()); // Baru disini generate-nya
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Pesanan disetujui.');
    }


    public function cancel($id)
    {
        $order = Booking::findOrFail($id);
        $order->status = 'dibatalkan';
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Pesanan berhasil dibatalkan.');
    }


    public function cancelWithNote(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:1000',
        ]);

        $order = Booking::findOrFail($id);
        $order->status = 'dibatalkan';
        $order->catatan_admin = $request->catatan_admin;
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Pesanan telah dibatalkan dengan catatan.');
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
