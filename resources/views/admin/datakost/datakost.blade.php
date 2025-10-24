@extends('layouts.admin.app')
@section('title', 'Data Kost')

@section('content')
<div class="pagetitle mb-3">
    <h1>Data Kost</h1>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <h5 class="card-title">Daftar Kost</h5>
                </div>
                <div class="col-lg-6 text-end">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKost">Tambah Kost</a>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Kost</th>
                        <th>Foto Kost</th>
                        <th>Harga <small>/bulan</small></th>
                        <th>Alamat</th>
                        <th>Total Kamar</th>
                        <th>Kota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kosts as $kost)
                    <tr>
                        <td>{{ $kost->nama_kost }}</td>
                        <td>
                            @if($kost->foto_1)
                            <img src="{{ asset('storage/'.$kost->foto_1) }}" width="100">
                            @else
                            <span class="text-muted">Tidak ada foto</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($kost->harga, 0, ',', '.') }}</td>
                        <td>{{ $kost->alamat }}</td>
                        <td>{{ $kost->jumlah_kamar }}</td>
                        <td>{{ $kost->kota->nama_kota ?? '-' }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditKost{{ $kost->id }}">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteKost('{{ route('admin.datakost.destroy', $kost->id) }}')">
                                Hapus
                            </button>


                            <!-- Modal Edit Kost -->
                            <div class="modal fade" id="modalEditKost{{ $kost->id }}" tabindex="-1" aria-labelledby="modalEditKostLabel{{ $kost->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.datakost.update', $kost->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Kost</label>
                                                    <input type="text" class="form-control" name="nama_kost" value="{{ $kost->nama_kost }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Harga (per bulan)</label>
                                                    <input type="number" class="form-control" name="harga" value="{{ $kost->harga }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Alamat</label>
                                                    <input type="text" class="form-control" name="alamat" value="{{ $kost->alamat }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Jumlah Kamar</label>
                                                    <input type="number" class="form-control" name="jumlah_kamar" value="{{ $kost->jumlah_kamar }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Kota</label>
                                                    <select name="kota_id" class="form-select" required>
                                                        @foreach($kotas as $kota)
                                                        <option value="{{ $kota->id }}" {{ $kost->kota_id == $kota->id ? 'selected' : '' }}>
                                                            {{ $kota->nama_kota }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Fasilitas</label>
                                                    <div class="row">
                                                        @foreach($fasilitas as $fas)
                                                        <div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{ $fas->id }}"
                                                                    {{ $kost->fasilitas->contains($fas->id) ? 'checked' : '' }}>
                                                                <label class="form-check-label">
                                                                    <i class="bi {{ $fas->icon }}"></i> {{ $fas->nama_fasilitas }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Foto 1</label>
                                                    <input type="file" class="form-control" name="foto_1" accept="image/*">
                                                    @if ($kost->foto_1)
                                                    <img src="{{ asset('storage/'.$kost->foto_1) }}" class="mt-2" width="100">
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Foto 2</label>
                                                    <input type="file" class="form-control" name="foto_2" accept="image/*">
                                                    @if ($kost->foto_2)
                                                    <img src="{{ asset('storage/'.$kost->foto_2) }}" class="mt-2" width="100">
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Foto 3</label>
                                                    <input type="file" class="form-control" name="foto_3" accept="image/*">
                                                    @if ($kost->foto_3)
                                                    <img src="{{ asset('storage/'.$kost->foto_3) }}" class="mt-2" width="100">
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Embed Google Maps (iframe)</label>
                                                    <textarea name="map" class="form-control" rows="3">{{ $kost->map }}</textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal Tambah Kost -->
<div class="modal fade" id="modalTambahKost" tabindex="-1" aria-labelledby="modalTambahKostLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.datakost.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kost</label>
                        <input type="text" class="form-control" name="nama_kost" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga (per bulan)</label>
                        <input type="number" class="form-control" name="harga" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Kamar</label>
                        <input type="number" class="form-control" name="jumlah_kamar" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kota</label>
                        <select name="kota_id" class="form-select" required>
                            <option value="">-- Pilih Kota --</option>
                            @foreach($kotas as $kota)
                            <option value="{{ $kota->id }}">{{ $kota->nama_kota }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fasilitas</label>
                        <div class="row">
                            @foreach($fasilitas as $fas)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{ $fas->id }}">
                                    <label class="form-check-label">
                                        <i class="bi {{ $fas->icon }}"></i> {{ $fas->nama_fasilitas }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto 1</label>
                        <input type="file" class="form-control" name="foto_1" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto 2</label>
                        <input type="file" class="form-control" name="foto_2" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto 3</label>
                        <input type="file" class="form-control" name="foto_3" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Embed Google Maps (iframe)</label>
                        <textarea name="map" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- SweetAlert Delete -->
<script>
    function deleteKost(url) {
        Swal.fire({
            title: 'Yakin mau hapus?',
            text: "Data kost tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                const token = document.createElement('input');
                token.type = 'hidden';
                token.name = '_token';
                token.value = '{{ csrf_token() }}';

                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';

                form.appendChild(token);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection