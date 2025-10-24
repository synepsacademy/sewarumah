@extends('layouts.admin.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="pagetitle mb-3">
    <h1>Dashboard</h1>
</div>

<section class="section dashboard">
    <div class="row">
        <!-- Total Kost -->
        <div class="col-md-3">
            <div class="card info-card">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-house-door-fill fs-2 text-primary"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-1">Total Kost</h6>
                        <h4>{{ $jumlahKost }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total User -->
        <div class="col-md-3">
            <div class="card info-card">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-people-fill fs-2 text-success"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-1">Total Pengguna</h6>
                        <h4>{{ $jumlahUser }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Hari Ini -->
        <div class="col-md-3">
            <div class="card info-card">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-calendar-check-fill fs-2 text-warning"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-1">Booking Hari Ini</h6>
                        <h4>{{ $bookingHariIni }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menunggu Konfirmasi -->
        <div class="col-md-3">
            <div class="card info-card">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-clock-history fs-2 text-danger"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-1">Menunggu Konfirmasi</h6>
                        <h4>{{ $bookingMenunggu }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Booking Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kost</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookingTerbaru as $b)
                        <tr>
                            <td>{{ $b->user->name }}</td>
                            <td>{{ $b->kost->nama_kost }}</td>
                            <td>{{ \Carbon\Carbon::parse($b->checkin_date)->format('d M Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $b->status == 'menunggu' ? 'warning' : ($b->status == 'disetujui' ? 'success' : 'secondary') }}">
                                    {{ ucfirst($b->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada booking baru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<section class="section mt-4">
    <div class="card text-center border-0 shadow-sm">
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p class="fst-italic text-muted">{{ $motivasi }}</p>
                <footer class="blockquote-footer mt-2">Admin Bijak</footer>
            </blockquote>
        </div>
    </div>
</section>

@endsection