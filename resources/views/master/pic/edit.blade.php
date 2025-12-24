@extends('layouts-copas.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4 justify-content-center">

        <div class="col-lg-6">
            <div class="card card-warning shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Edit PIC</h3>
                </div>

                <form method="POST" action="{{ route('master.pic.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label>Nama Lengkap</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $user->name) }}"
                                required
                            >
                        </div>

                        <div class="form-group mb-3">
                            <label>NIP</label>
                            <input
                                type="text"
                                name="nip"
                                class="form-control"
                                value="{{ old('nip', $user->nip) }}"
                            >
                        </div>

                        <div class="form-group mb-3">
                            <label>Jabatan</label>
                            <input
                                type="text"
                                name="position"
                                class="form-control"
                                value="{{ old('position', $user->position) }}"
                            >
                        </div>

                        <div class="form-group mb-3">
                            <label>Alamat</label>
                            <textarea
                                name="address"
                                class="form-control"
                                rows="2"
                            >{{ old('address', $user->address) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>No. HP</label>
                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone', $user->phone) }}"
                            >
                        </div>

                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $user->email) }}"
                                required
                            >
                        </div>

                        {{-- Role hanya bisa diubah Admin --}}
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <div class="form-group mb-3">
                                    <label>Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>
                                        <option value="operator" {{ $user->role === 'operator' ? 'selected' : '' }}>
                                            PIC
                                        </option>
                                    </select>
                                </div>
                            @endif
                        @endauth

                        <div class="form-group mb-3">
                            <label>Password (Opsional)</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Kosongkan jika tidak diubah"
                            >
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('master.pic.index') }}" class="btn btn-secondary me-2">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
