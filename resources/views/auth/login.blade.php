@extends('layouts.user.app')
@section('title', 'Login')

@section('content')
<section class="login">
    <div class="container">
        <div class="row mt-5 d-flex align-items-center">
            <div class="col-lg-6">
                <h3>Masuk untuk mulai cari kost</h3>
                <p>Akses fitur lengkap dan pantau pesanan kost-mu di sini.</p>

                <!-- form -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" placeholder="cth. username@email.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan password" required>
                    </div>

                    <div class="mb-5 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                        <label class="form-check-label" for="rememberMe">Masuk otomatis untuk nanti</label>
                    </div>

                    <button type="submit" class="btn btn-primer w-100">Masuk</button>
                    <div class="mt-5">
                        <span>Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none mb-3">Daftar sekarang</a></span>
                    </div>
                </form>

            </div>

            <div class="col-lg-6">
                <img src="./assets/img-login.png" alt="" width="100%">
            </div>
        </div>
    </div>
</section>
@endsection