@extends('layouts.admin.app')
@section('title', 'Kota & Lokasi')

@section('content')
<div class="pagetitle mb-3">
    <h1>Data Kota</h1>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <h5 class="card-title">Daftar Kota</h5>
                </div>
                <div class="col-lg-6 text-end">
                    <!-- Tombol Tambah Kota -->
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahKotaModal">
                        + Tambah Kota
                    </button>
                </div>
            </div>

            <!-- Modal Tambah Kota -->
            <div class="modal fade" id="tambahKotaModal" tabindex="-1" aria-labelledby="tambahKotaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.kota.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahKotaModalLabel">Tambah Kota</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_kota" class="form-label">Nama Kota</label>
                                <input type="text" class="form-control" name="nama_kota" required>
                            </div>
                            <div class="mb-3">
                                <label for="gambar_kota" class="form-label">Gambar Kota</label>
                                <input type="file" class="form-control" name="gambar_kota" accept="image/*" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- List Kota -->
            <ul class="list-group">
                @foreach ($kotas as $kota)
                <li class="list-group-item d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/' . $kota->gambar_kota) }}" alt="{{ $kota->nama_kota }}" width="40" height="40" class="rounded me-2">
                        <strong>{{ $kota->nama_kota }}</strong>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary rounded-pill">{{ $kota->kosts_count }} Kost</span>

                        <!-- Tombol Edit -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editKotaModal{{ $kota->id }}">
                            Edit
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.kota.destroy', $kota->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kota ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </div>
                </li>

                <!-- Modal Edit Kota -->
                <div class="modal fade" id="editKotaModal{{ $kota->id }}" tabindex="-1" aria-labelledby="editKotaModalLabel{{ $kota->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('admin.kota.update', $kota->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Kota</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama_kota" class="form-label">Nama Kota</label>
                                    <input type="text" class="form-control" name="nama_kota" value="{{ $kota->nama_kota }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar_kota" class="form-label">Gambar Kota (Opsional)</label>
                                    <input type="file" class="form-control" name="gambar_kota" accept="image/*">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </ul>

        </div>
    </div>
</section>
@endsection
