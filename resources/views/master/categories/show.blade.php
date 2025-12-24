@extends('layouts-copas.app')

@section('content')
<div class="container-fluid py-4">
<div class="card shadow-sm col-lg-6 mx-auto">

    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">
            {{ $mode === 'edit' ? 'Edit Kategori' : 'Detail Kategori' }}
        </h3>

        @if ($mode === 'detail')
            <a href="?mode=edit" class="btn btn-warning btn-sm">Edit</a>
        @endif
    </div>

    <form method="POST"
        action="{{ route('asset-categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group mb-3">
                <label>Nama Kategori</label>
                <input type="text"
                    name="name"
                    class="form-control"
                    value="{{ $category->name }}"
                    {{ $mode === 'detail' ? 'readonly' : '' }}>
            </div>

            <div class="form-group mb-3">
                <label>Tipe Aset</label>
                <select name="asset_type"
                    class="form-control"
                    {{ $mode === 'detail' ? 'disabled' : '' }}>
                    <option value="Asset Tetap"
                        {{ $category->asset_type == 'Asset Tetap' ? 'selected' : '' }}>
                        Asset Tetap
                    </option>
                    <option value="Inventory"
                        {{ $category->asset_type == 'Inventory' ? 'selected' : '' }}>
                        Inventory
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }}">
                    {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
        </div>

        @if ($mode === 'edit')
        <div class="card-footer text-end">
            <a href="{{ route('asset-categories.show', $category->id) }}"
                class="btn btn-secondary">Batal</a>
            <button class="btn btn-primary">Simpan</button>
        </div>
        @endif
    </form>
</div>
</div>
@endsection
