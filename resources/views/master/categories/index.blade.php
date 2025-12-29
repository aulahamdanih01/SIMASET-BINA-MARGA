@extends('layouts-copas.app')

@section('content')
<div class="container-fluid py-4">

    <div class="row g-4">

        {{-- ================== TABEL ================== --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 fw-semibold">
                    Daftar Kategori
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Kategori</th>
                                    <th>Tipe Aset</th>
                                    <th class="text-center">Status</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $i => $category)
                                <tr class="{{ !$category->is_active ? 'table-light' : '' }}">
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        {{ $category->asset_type === 'fixed' ? 'Asset Tetap' : 'Inventory' }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('master.categories.index', ['edit' => $category->id]) }}"
                                        class="btn btn-sm btn-outline-warning">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Data kategori belum tersedia
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================== FORM CREATE ================== --}}
        <div class="col-lg-4">
            <div class="card card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $editData ? 'Edit Kategori' : 'Tambah Kategori' }}
                    </h3>
                </div>

                <form method="POST"
                    action="{{ $editData
                            ? route('master.categories.update', $editData->id)
                            : route('master.categories.store') }}">
                    @csrf
                    @if($editData)
                        @method('PUT')
                    @endif

                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label>Nama Kategori</label>
                            <input type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $editData->name ?? '') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Tipe Aset</label>
                            <select name="asset_type"
                                    class="form-control @error('asset_type') is-invalid @enderror">
                                <option value="fixed"
                                    {{ old('asset_type', $editData->asset_type ?? '') == 'fixed' ? 'selected' : '' }}>
                                    Asset Tetap
                                </option>
                                <option value="inventory"
                                    {{ old('asset_type', $editData->asset_type ?? '') == 'inventory' ? 'selected' : '' }}>
                                    Inventory
                                </option>
                            </select>
                            @error('asset_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Status</label>
                            <select name="is_active" class="form-control">
                                <option value="1"
                                    {{ old('is_active', $editData->is_active ?? 1) == 1 ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="0"
                                    {{ old('is_active', $editData->is_active ?? 1) == 0 ? 'selected' : '' }}>
                                    Nonaktif
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">
                            {{ $editData ? 'Update' : 'Simpan' }}
                        </button>

                        @if($editData)
                            <a href="{{ route('master.categories.index') }}"
                            class="btn btn-outline-secondary ms-2">
                                Batal
                            </a>
                        @endif
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection