@extends('layouts.user.app')
@section('title', 'Lihat Kost')

@section('content')
<section class="kostan">
    <div class="container">
        <div class="row mt-5 d-flex align-items-center">
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="content">
                            <h3 class="card-title">Cari kost yang cocok untukmu</h3>
                            <p class="card-text">Temukan kost terbaik di kota impianmu dengan harga terjangkau.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- kota -->
<div class="container mt-5">
    <h5>Kota Tersedia</h5>
</div>
@include('layouts.user.cities')
<!-- kota -->
@endsection