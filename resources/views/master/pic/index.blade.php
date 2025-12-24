@extends('layouts-copas.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">

        <!-- TABEL USER -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 fw-semibold">
                    Daftar Penanggung Jawab (PIC)
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>Nama</th>
                                    <th>No. HP</th>
                                    <th>Email</th>
                                    <th>Last Active</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->last_active)
                                                <span class="text-success">
                                                    {{ $user->last_active->diffForHumans() }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('master.pic.show', $user->id) }}"
                                               class="btn btn-sm btn-outline-info me-1">
                                                Detail
                                            </a>
                                            <a href="{{ route('master.pic.destroy', $user->id) }}"
                                               class="btn btn-sm btn-outline-danger">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">
                                            Data user belum tersedia
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM TAMBAH PIC -->
        <div class="col-lg-4">
            <div class="card card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Tambah PIC</h3>
                </div>

                <form method="POST" action="{{ route('master.pic.store') }}">
                    @csrf

                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>Jabatan</label>
                            <input type="text" name="position" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>Alamat</label>
                            <textarea name="address" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>No. HP</label>
                            <input type="text" name="phone" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        {{-- Role hanya bisa dipilih Admin --}}
                        <div class="form-group mb-3">
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Role --</option>

                                @if(auth()->user()->role === 'admin')
                                    <option value="admin">Admin</option>
                                @endif

                                <option value="operator">PIC</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END FORM -->

    </div>
</div>
@endsection