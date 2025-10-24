@extends('layouts.user.app')
@section('title', 'Kota ' . $kota->nama_kota)

@section('content')
<section class="detail-kota">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6">
                <h3>Kost Tersedia di Kota {{ $kota->nama_kota }}</h3>
                <p>Temukan kost terbaik di kota {{ $kota->nama_kota }} dengan berbagai pilihan harga dan fasilitas yang sesuai
                    dengan kebutuhanmu.</p>
            </div>
            <div class="col-lg-6">
                <div class="d-flex justify-content-end">
                    <img src="{{ asset('storage/' . $kota->gambar_kota) }}" alt="{{ $kota->nama_kota }}" width="100%" class="rounded-3">
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container mt-5">
    <h5>Kostan yang tersedia di {{ $kota->nama_kota }}</h5>
</div>

@include('layouts.user.kostan')
@endsection
