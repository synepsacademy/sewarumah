<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
                <a class="nav-link" href="{{ url('/kost') }}">Kost</a>
                <a class="nav-link" href="{{ url('/order') }}">Pesananmu</a>
            </div>

            <div class="vr d-none d-lg-block mx-3"></div>

            <div class="d-flex gap-2">
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark btn-sm">Keluar</button>
                    </form>
                @else
                    <a href="{{ url('/login') }}" class="btn btn-outline-dark btn-sm">Masuk</a>
                    <a href="{{ url('/register') }}" class="btn btn-primer btn-sm">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
