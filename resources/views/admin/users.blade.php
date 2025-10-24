@extends('layouts.admin.app')
@section('title', 'Data Pengguna')

@section('content')
<div class="pagetitle mb-3">
    <h1>Data Pengguna</h1>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Daftar Pengguna</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>No. WhatsApp</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role ?? 'user') }}</td>
                        <td>
                            @if($user->role !== 'admin')
                            {!! $user->whatsapp
                            ? '<a href="https://wa.me/' . $user->whatsapp . '" target="_blank">' . $user->whatsapp . '</a>'
                            : '-' !!}
                            @else
                            <em class="text-muted">-</em>
                            @endif
                        </td>


                        <td>
                            @if($user->is_active ?? true)
                            <span class="badge bg-success">Aktif</span>
                            @else
                            <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            @if($user->is_active ?? true)
                            <button class="btn btn-sm btn-danger" onclick="confirmDeactivation({{ $user->id }})">Nonaktifkan</button>
                            @else
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-success" onclick="confirmActivation({{ $user->id }})">Aktifkan</button>
                                <button class="btn btn-sm btn-outline-danger" onclick="confirmDeletion({{ $user->id }})">Hapus</button>
                            </div>
                            @endif

                            <!-- Form hidden untuk aksi -->
                            <form id="deactivate-form-{{ $user->id }}" action="{{ route('admin.users.deactivate', $user->id) }}" method="POST" class="d-none">
                                @csrf @method('PUT')
                            </form>

                            <form id="activate-form-{{ $user->id }}" action="{{ route('admin.users.activate', $user->id) }}" method="POST" class="d-none">
                                @csrf @method('PUT')
                            </form>

                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-none">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada pengguna terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    function confirmDeactivation(userId) {
        Swal.fire({
            title: 'Yakin Nonaktifkan?',
            text: "User tidak akan bisa login.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Nonaktifkan'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`deactivate-form-${userId}`).submit();
            }
        });
    }

    function confirmActivation(userId) {
        Swal.fire({
            title: 'Aktifkan User?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Aktifkan'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`activate-form-${userId}`).submit();
            }
        });
    }

    function confirmDeletion(userId) {
        Swal.fire({
            title: 'Hapus User?',
            text: "Data akan hilang permanen!",
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus Sekarang!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${userId}`).submit();
            }
        });
    }
</script>

@endsection