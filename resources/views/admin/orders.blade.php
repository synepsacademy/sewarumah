@extends('layouts.admin.app')
@section('title', 'Data Pesanan')

@section('content')
<div class="pagetitle mb-3">
    <h1>Data Pesanan</h1>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Riwayat Pesanan</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Penyewa</th>
                        <th>Kost</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->kost->nama_kost }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->checkin_date)->format('d M Y') }}</td>
                        <td>
                            @php
                            $status = strtolower($order->status);
                            @endphp
                            <span class="badge 
                {{ $status == 'menunggu' ? 'bg-warning' : 
                   ($status == 'disetujui' ? 'bg-success' : 
                   ($status == 'dibatalkan' ? 'bg-danger' : 'bg-secondary')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                            @if($order->status == \App\Models\Booking::STATUS_DIBAYAR)
                            <!-- Tombol Setujui -->
                            <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-sm btn-success" onclick="return confirm('Setujui pesanan ini?')">Setujui</button>
                            </form>

                            <!-- Tombol Tolak dengan Modal -->
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalTolak{{ $order->id }}">
                                Tolak
                            </button>
                            <!-- Modal Tolak Pesanan -->
                            <div class="modal fade" id="modalTolak{{ $order->id }}" tabindex="-1" aria-labelledby="modalTolakLabel{{ $order->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.orders.cancelWithNote', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTolakLabel{{ $order->id }}">Tolak Pesanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Masukkan alasan penolakan atau catatan untuk referensi:</p>
                                                <textarea name="catatan_admin" class="form-control" rows="4" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Tolak Sekarang</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @endif

                            <!-- Tombol Lihat Detail -->
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $order->id }}">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada pesanan.</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
            @foreach($orders as $order)
            <!-- Modal Detail -->
            <div class="modal fade" id="modalDetail{{ $order->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $order->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Nama Penyewa:</strong> {{ $order->user->name }}</p>
                            <p><strong>Nama Kost:</strong> {{ $order->kost->nama_kost }}</p>
                            <p><strong>Tanggal Check-in:</strong> {{ \Carbon\Carbon::parse($order->checkin_date)->translatedFormat('d F Y') }}</p>
                            @if($order->status === 'disetujui')
                            <div class="alert alert-success text-center">
                                <strong>Kode Booking:</strong> {{ $order->kode_booking }}
                            </div>
                            @endif

                            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                            @if($order->bukti_pembayaran)
                            <p><strong>Bukti Pembayaran:</strong></p>
                            <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" alt="Bukti" class="img-fluid rounded">
                            @else
                            <p class="text-muted fst-italic">Belum ada bukti pembayaran.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endsection