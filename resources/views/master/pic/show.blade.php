@extends('layouts-copas.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">

        <div class="col-lg-12">
            <div class="card card-primary shadow-sm">

                <div class="card-header">
                    <h3 class="card-title mb-0">
                        {{ $isEdit ? 'Edit PIC' : 'Detail PIC' }}
                    </h3>
                </div>

                <form method="POST" action="{{ route('master.pic.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name"
                                   class="form-control"
                                   value="{{ old('name', $user->name) }}"
                                   {{ $isEdit ? '' : 'readonly' }}>
                        </div>

                        <div class="form-group mb-3">
                            <label>NIP</label>
                            <input type="text" name="nip"
                                   class="form-control"
                                   value="{{ old('nip', $user->nip) }}"
                                   {{ $isEdit ? '' : 'readonly' }}>
                        </div>

                        <div class="form-group mb-3">
                            <label>Jabatan</label>
                            <input type="text" name="position"
                                   class="form-control"
                                   value="{{ old('position', $user->position) }}"
                                   {{ $isEdit ? '' : 'readonly' }}>
                        </div>

                        <div class="form-group mb-3">
                            <label>Alamat</label>
                            <textarea name="address"
                                      class="form-control"
                                      rows="2"
                                      {{ $isEdit ? '' : 'readonly' }}>{{ old('address', $user->address) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>No. HP</label>
                            <input type="text" name="phone"
                                   class="form-control"
                                   value="{{ old('phone', $user->phone) }}"
                                   {{ $isEdit ? '' : 'readonly' }}>
                        </div>

                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" name="email"
                                   class="form-control"
                                   value="{{ old('email', $user->email) }}"
                                   {{ $isEdit ? '' : 'readonly' }}>
                        </div>

                        @auth
                        @if(auth()->user()->role === 'admin')
                            <div class="form-group mb-3">
                                <label>Role</label>
                                <select name="role"
                                        class="form-control"
                                        {{ $isEdit ? '' : 'disabled' }}>
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

                        @if($isEdit)
                            <div class="form-group mb-3">
                                <label>Password Baru</label>
                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="Kosongkan jika tidak diubah">
                            </div>
                        @endif

                    </div>

                    {{-- FOOTER --}}
                    <div class="card-footer text-end">

                        {{-- MODE DETAIL --}}
                        @if(!$isEdit)
                            <a href="{{ route('master.pic.index') }}"
                               class="btn btn-secondary me-2">
                                Kembali
                            </a>

                            <a href="{{ route('master.pic.show', $user->id) }}?mode=edit"
                               class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif

                        {{-- MODE EDIT --}}
                        @if($isEdit)
                            <a href="{{ route('master.pic.show', $user->id) }}"
                               class="btn btn-secondary me-2">
                                Batal
                            </a>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        @endif

                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
