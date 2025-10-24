@php
use App\Models\Booking;
@endphp

@extends('layouts.user.app')
@section('title', 'Pesananmu')

@section('content')
<section class="order mt-5">
    <div class="container">
        <h3>Pesananmu</h3>
        <p>Detail pesanan akan ditampilkan di sini.</p>

        <table class="table striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pesan</th>
                    <th>Nama Kost</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->checkin_date)->format('d M Y') }}</td>
                    <td>{{ $booking->kost->nama_kost }}</td>
                    <td>{{ $booking->kost->alamat }}, {{ $booking->kost->kota->nama_kota ?? '-' }}</td>
                    <td>
                        @switch($booking->status)
                        @case(Booking::STATUS_DISETUJUI)
                        <span class="badge bg-success">Disetujui</span>
                        @break
                        @case(Booking::STATUS_DIBAYAR)
                        <span class="badge bg-info text-dark">Menunggu Persetujuan</span>
                        @break
                        @case(Booking::STATUS_DIBATALKAN)
                        <span class="badge bg-danger">Dibatalkan</span>
                        @break
                        @default
                        <span class="badge bg-warning">Belum Bayar</span>
                        @endswitch
                    </td>
                    <td>
                        <button class="btn btn-primer btn-sm"
                            onclick="lihatDetail(
                                '{{ $booking->kost->nama_kost }}',
                                '{{ \Carbon\Carbon::parse($booking->checkin_date)->format('d M Y') }}',
                                '{{ $booking->kost->alamat }}',
                                '{{ ucfirst($booking->status) }}',
                                '{{ $booking->kode_booking }}',
                                `{{ $booking->catatan_admin ?? '' }}`
                            )">
                            Lihat Detail
                        </button>


                        @if ($booking->status === Booking::STATUS_MENUNGGU || $booking->status === 'menunggu_pembayaran')
                        <!-- Tombol Bayar -->
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal{{ $booking->id }}">
                            Bayar
                        </button>

                        <!-- Modal Upload Bukti -->
                        <div class="modal fade" id="uploadModal{{ $booking->id }}" tabindex="-1" aria-labelledby="uploadModalLabel{{ $booking->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-3 shadow">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title fw-bold" id="uploadModalLabel{{ $booking->id }}">Upload Bukti Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center mb-3">
                                            <img src="{{ asset('assets/ic-bca.png') }}" alt="Bank BCA" width="120" class="mb-2">
                                            <h6 class="fw-semibold">Transfer ke:</h6>
                                            <p class="mb-1">Bank BCA</p>
                                            <p class="mb-1">a.n. PT AnakKost Indonesia</p>
                                            <div class="bg-light p-2 rounded">
                                                <strong class="text-primary fs-5">1234567890</strong>
                                            </div>
                                        </div>

                                        <div class="mb-3 text-center">
                                            <p class="mb-1">Nominal yang harus dibayar:</p>
                                            <h5 class="fw-bold text-success">
                                                Rp {{ number_format($booking->kost->harga, 0, ',', '.') }}
                                            </h5>
                                        </div>

                                        <form action="{{ route('order.uploadBukti', $booking->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="buktiPembayaran{{ $booking->id }}" class="form-label">Upload Bukti Pembayaran</label>
                                                <input type="file" name="bukti_pembayaran" id="buktiPembayaran{{ $booking->id }}" class="form-control" accept="image/*" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">Upload Bukti</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Batalkan -->
                        <form action="{{ route('orders.cancel', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin batalkan pesanan?')">
                                Batalkan
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada pesanan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<!-- Modal Detail Pesanan -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Kost:</strong> <span id="modalNamaKost"></span></p>
                <p><strong>Tanggal Check-in:</strong> <span id="modalTanggal"></span></p>
                <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                <div id="modalKodeWrapper" style="display: none;">
                    <p><strong>Kode Booking:</strong> <span id="modalKode" class="fw-bold text-primary"></span></p>
                </div>

                <div id="modalCatatanAdminWrapper" style="display: none;">
                    <p><strong>Catatan Admin:</strong></p>
                    <div class="alert alert-warning">
                        <span id="modalCatatanAdmin"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button id="btnSalinKode" class="btn btn-outline-primary" onclick="salinKode()" style="display: none;">
                    Salin Kode
                </button>
            </div>

        </div>
    </div>
</div>


<script>
    function lihatDetail(namaKost, tanggal, alamat, status, kode, catatanAdmin) {
        document.getElementById('modalNamaKost').innerText = namaKost;
        document.getElementById('modalTanggal').innerText = tanggal;
        document.getElementById('modalAlamat').innerText = alamat;
        document.getElementById('modalStatus').innerText = status;
        document.getElementById('modalKode').innerText = kode;

        if (catatanAdmin && catatanAdmin.trim() !== "") {
            document.getElementById('modalCatatanAdmin').innerText = catatanAdmin;
            document.getElementById('modalCatatanAdminWrapper').style.display = 'block';
        } else {
            document.getElementById('modalCatatanAdminWrapper').style.display = 'none';
        }

        // Tampilkan tombol Salin Kode hanya jika status dibayar atau disetujui
        const statusLower = status.toLowerCase();
        if (statusLower === 'dibayar' || statusLower === 'disetujui') {
            document.getElementById('modalKodeWrapper').style.display = 'block';
            document.getElementById('btnSalinKode').style.display = 'inline-block';
        } else {
            document.getElementById('modalKodeWrapper').style.display = 'none';
            document.getElementById('btnSalinKode').style.display = 'none';
        }

        new bootstrap.Modal(document.getElementById('detailModal')).show();
    }
</script>

@endsection