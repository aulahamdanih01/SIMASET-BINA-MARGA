@extends('layouts-copas.app')

@section('content')
<div class="container-fluid py-4">

    <div class="row g-4">

        {{-- ================== TABEL ================== --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 fw-semibold">
                    Daftar Satuan Inventory
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kode</th>
                                    <th>Nama Satuan</th>
                                    <th>Simbol</th>
                                    <th class="text-center">Status</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($units as $i => $unit)
                                <tr class="{{ !$unit->is_active ? 'table-light' : '' }}">
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $unit->code }}</td>
                                    <td>{{ $unit->name }}</td>
                                    <td>{{ $unit->symbol }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $unit->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $unit->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('master.units.index', ['edit' => $unit->id]) }}"
                                           class="btn btn-sm btn-outline-warning">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Data satuan inventory belum tersedia
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================== FORM CREATE / EDIT ================== --}}
        <div class="col-lg-4">
            <div class="card card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $editData ? 'Edit Satuan Inventory' : 'Tambah Satuan Inventory' }}
                    </h3>
                </div>

                <form method="POST"
                    action="{{ $editData
                            ? route('master.units.update', $editData->id)
                            : route('master.units.store') }}">
                    @csrf
                    @if($editData)
                        @method('PUT')
                    @endif

                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label>Kode</label>
                            <input type="text"
                                name="code"
                                class="form-control @error('code') is-invalid @enderror"
                                value="{{ old('code', $editData->code ?? '') }}"
                                placeholder="Contoh: PCS">
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Nama Satuan</label>
                            <input type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $editData->name ?? '') }}"
                                placeholder="Contoh: Pieces">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Simbol</label>
                            <input type="text"
                                name="symbol"
                                class="form-control @error('symbol') is-invalid @enderror"
                                value="{{ old('symbol', $editData->symbol ?? '') }}"
                                placeholder="Contoh: pcs">
                            @error('symbol')
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
                            <a href="{{ route('master.units.index') }}"
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