<div class="container">
    <div class="row">
        @foreach ($kotas as $kota)
        <div class="col-lg-3">
            <a href="{{ route('city.show', $kota->id) }}" class="text-decoration-none">
                <div class="overlay mt-3">
                    <img src="{{ asset('storage/' . $kota->gambar_kota) }}" alt="{{ $kota->nama_kota }}" width="100%" class="rounded-3">
                    <div class="text">
                        <h5>{{ $kota->nama_kota }}</h5>
                        <p>{{ $kota->kosts_count }} Kost Tersedia</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>