@extends('layouts.user.app')
@section('title', 'Home')

@section('content')
<!-- hero -->
<section class="hero py-5">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6">
                <div class="badge bg-light text-dark mb-3 px-3 py-2">
                    <i class="bi bi-star-fill text-warning"></i> Platform Rumah Terpercaya
                </div>
                <h1 class="display-4 fw-bold mb-3">Temukan Rumah Impian Anda</h1>
                <p class="lead text-muted mb-4">Jual, beli, atau sewa rumah dengan mudah dan aman. Ribuan pilihan rumah menanti Anda.</p>

                <!-- Property Type Tabs -->
                <ul class="nav nav-pills mb-4" id="propertyTypeTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="buy-tab" data-bs-toggle="pill" data-bs-target="#buy" type="button">
                            <i class="bi bi-house-door"></i> Beli
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rent-tab" data-bs-toggle="pill" data-bs-target="#rent" type="button">
                            <i class="bi bi-key"></i> Sewa
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="sell-tab" data-bs-toggle="pill" data-bs-target="#sell" type="button">
                            <i class="bi bi-tag"></i> Jual
                        </button>
                    </li>
                </ul>

                <!-- Search Form -->
                <form role="search" class="search-form">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-geo-alt text-primer"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0" placeholder="Cari rumah di kota mana?" aria-label="Location">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-primer w-100">
                                        <i class="bi bi-search"></i> Cari Rumah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-6 d-none d-lg-block">
                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&h=600&fit=crop" 
                     alt="Modern House" class="img-fluid rounded-4 shadow-lg">
            </div>
        </div>
    </div>
</section>
<!-- hero -->

<!-- stats -->
<section class="stats py-4 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <h3 class="fw-bold text-primer mb-0">5000+</h3>
                <p class="text-muted mb-0">Rumah Tersedia</p>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <h3 class="fw-bold text-primer mb-0">2000+</h3>
                <p class="text-muted mb-0">Transaksi Sukses</p>
            </div>
            <div class="col-6 col-md-3">
                <h3 class="fw-bold text-primer mb-0">50+</h3>
                <p class="text-muted mb-0">Kota Terjangkau</p>
            </div>
            <div class="col-6 col-md-3">
                <h3 class="fw-bold text-primer mb-0">98%</h3>
                <p class="text-muted mb-0">Kepuasan Pelanggan</p>
            </div>
        </div>
    </div>
</section>
<!-- stats -->

<!-- features -->
<section class="features py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-primer bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-shield-check text-primer fs-2"></i>
                        </div>
                        <h5 class="card-title fw-bold">Aman & Terpercaya</h5>
                        <p class="card-text text-muted">Semua rumah telah diverifikasi dan dijamin keamanannya</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-primer bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-cash-stack text-primer fs-2"></i>
                        </div>
                        <h5 class="card-title fw-bold">Harga Terbaik</h5>
                        <p class="card-text text-muted">Dapatkan penawaran harga rumah terbaik di pasaran</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-primer bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-headset text-primer fs-2"></i>
                        </div>
                        <h5 class="card-title fw-bold">Dukungan 24/7</h5>
                        <p class="card-text text-muted">Tim support kami siap membantu Anda kapan saja</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- features -->

<!-- properties -->
<section class="properties py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-2">Rumah Pilihan</h2>
                <p class="text-muted mb-0">Temukan rumah terbaik untuk Anda</p>
            </div>
            <a href="#" class="btn btn-outline-primer">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        @include('layouts.user.kostan')
    </div>
</section>
<!-- properties -->

<!-- cta banner -->
<section class="cta-banner py-5">
    <div class="container">
        <div class="card border-0 shadow-lg overflow-hidden">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=800&h=500&fit=crop" 
                         alt="Sell House" class="img-fluid h-100 object-fit-cover">
                </div>
                <div class="col-md-6 bg-primer text-white">
                    <div class="card-body p-5 d-flex flex-column justify-content-center h-100">
                        <h3 class="fw-bold mb-3">Ingin Jual Rumah Anda?</h3>
                        <p class="mb-4">Kami siap membantu Anda menjual rumah dengan cepat dan harga terbaik. Proses mudah, aman, dan transparan.</p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-light">
                                <i class="bi bi-plus-circle"></i> Pasang Iklan
                            </button>
                            <button class="btn btn-outline-light">
                                Konsultasi Gratis
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- cta banner -->

<!-- cities -->
<section class="cities py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">Jelajahi Rumah Berdasarkan Kota</h2>
            <p class="text-muted">Pilih kota favorit Anda dan temukan rumah impian</p>
        </div>
        @include('layouts.user.cities')
    </div>
</section>
<!-- cities -->

<!-- testimonials -->
<section class="testimonials py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">Apa Kata Mereka?</h2>
            <p class="text-muted">Testimoni dari pelanggan yang puas</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="text-muted mb-3">"Proses cari rumah jadi sangat mudah! Dalam waktu 2 minggu saya sudah dapat rumah impian dengan harga yang sesuai budget."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://i.pravatar.cc/60?img=1" alt="User" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0 fw-bold">Budi Santoso</h6>
                                <small class="text-muted">Pembeli Rumah</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="text-muted mb-3">"Saya berhasil jual rumah dalam 1 bulan! Prosesnya cepat dan tim support sangat membantu."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://i.pravatar.cc/60?img=5" alt="User" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0 fw-bold">Siti Nurhaliza</h6>
                                <small class="text-muted">Penjual Rumah</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="text-muted mb-3">"Platform terbaik untuk cari rumah sewa! Banyak pilihan, harga jelas, dan prosesnya transparan."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://i.pravatar.cc/60?img=8" alt="User" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0 fw-bold">Ahmad Rizki</h6>
                                <small class="text-muted">Penyewa Rumah</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- testimonials -->

@include('layouts.user.footer')
@endsection