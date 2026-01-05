@extends('layouts-copas.app')

@section('content')
<div class="container-fluid py-4">

    <div class="row g-4">
        <!-- TABEL KONDISI ASET -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 fw-semibold">
                    Daftar Kondisi Aset
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kode</th>
                                    <th>Nama Kondisi</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Status</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($conditions as $condition)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="fw-semibold">{{ $condition->code }}</td>
                                        <td>{{ $condition->name }}</td>
                                        <td>{{ $condition->description ?? '-' }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $condition->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $condition->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('master.conditions.index', ['edit' => $condition->id]) }}"
                                               class="btn btn-sm btn-outline-warning">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Belum ada data kondisi aset
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <!-- FORM TAMBAH / EDIT -->
        <div class="col-lg-4">
            <div class="card card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $editData ? 'Edit Kondisi Aset' : 'Tambah Kondisi Aset' }}
                    </h3>
                </div>

                <form method="POST"
                      action="{{ $editData
                                ? route('master.conditions.update', $editData->id)
                                : route('master.conditions.store') }}">
                    @csrf
                    @if ($editData)
                        @method('PUT')
                    @endif

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Nama Kondisi</label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $editData->name ?? '') }}"
                                   placeholder="Contoh: Baik">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Deskripsi kondisi aset">{{ old('description', $editData->description ?? '') }}</textarea>
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
                        @if ($editData)
                            <a href="{{ route('master.conditions.index') }}"
                               class="btn btn-secondary me-2">
                                Batal
                            </a>
                        @endif

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            {{ $editData ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
        <!-- END FORM -->

    </div>
</div>
@endsection