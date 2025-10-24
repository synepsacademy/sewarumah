<section class="kost">
    <div class="container">
        <div class="row">
            @foreach ($kosts as $kost)
            <div class="col-lg-4">
                <a href="{{ url('/detail/'.$kost->id) }}" class="text-decoration-none">
                    <div class="card border-0 mt-3">
                        @if($kost->foto_1)
                        <img src="{{ asset('storage/'.$kost->foto_1) }}" class="card-img-top" alt="{{ $kost->nama_kost }}">
                        @else
                        <span class="text-muted">Tidak ada foto</span>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $kost->nama_kost }}</h5>
                            <p class="card-text text-muted">Kota {{ $kost->kota->nama_kota ?? '-' }}</p>
                            <h5 class="card-price">Rp {{ number_format($kost->harga, 0, ',', '.') }}<small>/bulan</small></h5>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>