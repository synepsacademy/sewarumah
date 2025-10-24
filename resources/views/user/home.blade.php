@extends('layouts.user.app')
@section('title', 'Home')

@section('content')
<!-- hero -->
<section class="hero">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-5">
                <h1>Booking Kost Tanpa Ribet, Tanpa Drama!</h1>
                <p class="my-3">Cari, lihat detail, dan booking langsung dimanapun kamu berada.</p>

                <!-- Search Form -->
                <form role="search">
                    <div class="input-group">
                        <input type="text" class="form-control border-end-0" placeholder="Cari kost di kota mana?"
                            aria-label="Search">
                        <span class="input-group-text bg-white border-start-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                    </div>
                </form>
            </div>

            <div class="col-lg-7 d-none d-lg-block">
                <img src="./assets/img-hero.png" alt="" width="100%" class="rounded-3">
            </div>
        </div>
    </div>
</section>
<!-- hero -->

<!-- cta -->
<section class="cta mt-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="content">
                            <h3 class="card-title">Kost Dikelola sepenuh hati agar kamu nyaman</h3>
                            <p class="card-text">Lokasi strategis dan terverifikasi, bangunan kost lolos seleksi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- cta -->

<!-- kost -->
<div class="container mt-5">
    <h5>Kostan yang mungkin cocok denganmu</h5>
</div>
@include('layouts.user.kostan')
<!-- kost -->

<!-- kota -->
<div class="container mt-5">
    <h5>Cari area Kost berdasarkan kota</h5>
</div>
@include('layouts.user.cities')
<!-- kota -->


@include('layouts.user.footer')
@endsection