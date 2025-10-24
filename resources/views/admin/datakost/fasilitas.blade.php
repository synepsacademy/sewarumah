@extends('layouts.admin.app') {{-- Ganti sesuai layout kamu --}}
@section('title', 'Kelola Fasilitas')

@section('content')
<div class="container mt-4">
    <div class="pagetitle mb-3">
        <h1>Data Fasilitas</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <h5 class="card-title">Data Fasilitas</h5>
                </div>
                <div class="col-lg-6 text-end">
                    {{-- Button Tambah --}}
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Fasilitas</button>
                </div>
            </div>
            {{-- Table --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Nama Fasilitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fasilitas as $f)
                    <tr>
                        <td><i class="{{ $f->icon }}"></i> <code>{{ $f->icon }}</code></td>
                        <td>{{ $f->nama_fasilitas }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $f->id }}">Edit</button>

                            <!-- Delete Form -->
                            <form action="{{ route('admin.fasilitas.destroy', $f->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $f->id }}" tabindex="-1" aria-labelledby="editLabel{{ $f->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('admin.fasilitas.update', $f->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Fasilitas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Nama Fasilitas</label>
                                            <input type="text" name="nama_fasilitas" class="form-control" value="{{ $f->nama_fasilitas }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Icon (class)</label>
                                            <input type="text" name="icon" class="form-control" value="{{ $f->icon }}" required>
                                            <small class="text-muted">Contoh: <code>bi bi-wifi</code></small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.fasilitas.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Fasilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Fasilitas</label>
                        <input type="text" name="nama_fasilitas" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Icon (class)</label>
                        <input type="text" name="icon" class="form-control" required>
                        <small class="text-muted">Contoh: <code>bi bi-wifi</code></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection