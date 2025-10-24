@extends('layouts.user.app')
@section('title', 'Detail Kost')

@section('content')
<section class="detail">
    <div class="container">
        <div class="row align-items-stretch g-3">
            @php
            $fotoUtama = $kost->foto_1 ? asset('storage/' . $kost->foto_1) : asset('assets/img-default.jpg');
            $thumbnail2 = $kost->foto_2 ? asset('storage/' . $kost->foto_2) : asset('assets/img-default.jpg');
            $thumbnail3 = $kost->foto_3 ? asset('storage/' . $kost->foto_3) : asset('assets/img-default.jpg');
            @endphp

            <div class="col-lg-8">
                <div class="h-100">
                    <img id="mainImage" src="{{ $fotoUtama }}" alt="Foto Kost"
                        class="img-fluid rounded-4 w-100 object-fit-cover">
                </div>
            </div>

            <div class="col-lg-4 d-flex flex-column gap-3">
                <img src="{{ $fotoUtama }}" class="thumbnail flex-fill" onclick="previewImage(this)">
                <img src="{{ $thumbnail2 }}" class="thumbnail flex-fill" onclick="previewImage(this)">
                <img src="{{ $thumbnail3 }}" class="thumbnail flex-fill" onclick="previewImage(this)">
            </div>

        </div>

        <div class="row mt-4 mb-5">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>{{ $kost->nama_kost }}</h2>
                        <p><i class="bi bi-geo-alt"></i> {{ $kost->alamat }} , {{ $kost->kota->nama_kota ?? '-' }}</p>
                    </div>

                    <div class="col-lg-6">
                        <div class="d-flex-justify-content-end">
                            <h5 class="text-end text-primary">Rp. {{ number_format($kost->harga, 0, ',', '.') }}</h5>
                            <p class="text-end">
                                <span class="text-muted">/bulan</span>
                            </p>
                        </div>
                    </div>
                </div>
                <p>Masih tersedia <span class="text-success">{{ $kost->jumlah_kamar }} Kamar</span></p>

                <hr>

                <h6>Fasilitas Kost</h6>
                <table class="table table-borderless">
                    <tr>
                        @foreach ($kost->fasilitas as $fasilitas)
                        <td class="text-center">
                            <i class="{{ $fasilitas->icon }} fs-3"></i>
                            <p>{{ $fasilitas->nama_fasilitas }}</p>
                        </td>
                        @endforeach
                    </tr>
                </table>

                <hr>

                <h6>Lokasi</h6>
                <p><i class="bi bi-geo-alt"></i> {{ $kost->alamat }} , {{ $kost->kota->nama_kota ?? '-' }}</p>
                {!! $kost->map !!}
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pilih tanggal pesan</h5>
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <form id="formPesan" method="POST" action="{{ route('booking.store', $kost->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="checkinDate" class="form-label">Tanggal Check-in</label>
                                <input type="date" class="form-control" id="checkinDate" name="checkin_date" min="{{ date('Y-m-d') }}">
                            </div>

                            <button type="submit" class="btn btn-primer w-100 mb-3" id="btnPesan">Pesan Sekarang</button>
                            <a href="https://wa.me/628123456789" class="btn btn-outline-dark w-100"><i class="bi bi-headset"></i> Ada pertanyaan? Hubungi Kami</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("formPesan");
        const checkinInput = document.getElementById("checkinDate");

        form.addEventListener("submit", function(e) {
            e.preventDefault();

            const checkinDate = checkinInput.value;
            const today = new Date().toISOString().split('T')[0];

            if (!checkinDate) {
                Swal.fire({
                    icon: "warning",
                    title: "Tanggal belum dipilih!",
                    text: "Yuk pilih dulu tanggal check-in-nya.",
                });
                return;
            }

            if (checkinDate < today) {
                Swal.fire({
                    icon: "error",
                    title: "Tanggal tidak valid",
                    text: "Tanggal check-in tidak boleh sebelum hari ini.",
                });
                return;
            }

            Swal.fire({
                title: "Konfirmasi Pesanan",
                html: `Pesan kost dengan tanggal check-in: <strong>${checkinDate}</strong>?`,
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Ya, pesan sekarang!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection