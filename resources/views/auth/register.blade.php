@extends('layouts.user.app')
@section('title', 'Register')

@section('content')
<section class="register">
    <div class="container">
        <div class="row mt-5 d-flex align-items-center">
            <div class="col-lg-6">
                <h3>Yuk gabung, biar cari kost gak ribet!</h3>
                <p>Pilih lokasi, lihat fasilitas, dan booking langsung!</p>

                <!-- form -->
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') }}" placeholder="cth. Ahmad Fulan" required>
                    </div>

                    <div class="mb-3">
                        <label for="no_wa" class="form-label">Nomor Whatsapp</label>
                        <input type="text" class="form-control" id="no_wa" name="whatsapp"
                            value="{{ old('whatsapp') }}" placeholder="cth. 628xxxx" required>
                    </div>


                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" placeholder="cth. username@email.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Buat Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Ulangi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                    </div>

                    <button type="submit" class="btn btn-primer w-100 mt-3">Daftar</button>
                    <div class="mt-5">
                        <span>Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none mb-3">Masuk sekarang</a></span>
                    </div>
                </form>

            </div>

            <div class="col-lg-6">
                <img src="./assets/img-register.png" alt="" width="100%">
            </div>
        </div>
    </div>
</section>
@endsection