@extends('layouts-copas.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">

        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">

                {{-- HEADER --}}
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center g-2">

                        {{-- TITLE --}}
                        <div class="col-md-4">
                            <span class="fw-semibold fs-5">
                                Daftar Inventory Aset
                            </span>
                        </div>

                        {{-- ACTIONS --}}
                        <div class="col-md-8">
                            <form method="GET" action="{{ route('inventories.index') }}">
                                <div class="row g-2 justify-content-end">

                                    {{-- SEARCH --}}
                                    <div class="col-md-4">
                                        <input type="text"
                                               name="search"
                                               value="{{ request('search') }}"
                                               class="form-control form-control-sm"
                                               placeholder="Cari nama / kode aset...">
                                    </div> 

                                    {{-- BUTTON FILTER --}}
                                    <div class="col-auto">
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-funnel"></i>
                                        </button>
                                    </div>

                                    {{-- ADD INVENTORY --}}
                                    <div class="col-auto">
                                        <a href="{{ route('inventories.create') }}"
                                           class="btn btn-sm btn-primary">
                                            <i class="bi bi-plus-circle"></i> Tambah Item
                                        </a>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                {{-- BODY --}}
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th width="5%">ID</th>
                                    <th class="text-start">Kode</th>
                                    <th class="text-start">Nama Aset</th>
                                    <th class="text-start">Kategori</th>
                                    <th>Stok</th>
                                    <th width="22%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($assets as $asset)
                                    <tr>
                                        <td class="text-center">{{ $asset->id }}</td>
                                        <td>{{ $asset->code }}</td>
                                        <td class="fw-semibold">{{ $asset->name }}</td>
                                        <td>{{ $asset->category->name ?? '-' }}</td>

                                        {{-- STOCK --}}
                                        <td class="text-center">
                                            @if ($asset->stock > 0)
                                                <span class="badge bg-success px-3">
                                                    {{ $asset->stock }} unit
                                                </span>
                                            @else
                                                <span class="badge bg-danger px-3">
                                                    Habis
                                                </span>
                                            @endif
                                        </td>

                                        {{-- ACTION --}}
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="#"
                                                   class="btn btn-sm btn-outline-success">
                                                    <i class="bi bi-plus-circle"></i> Masuk
                                                </a>
                                                <a href="#"
                                                   class="btn btn-sm btn-outline-danger"
                                                   {{ $asset->stock == 0 ? 'disabled' : '' }}>
                                                    <i class="bi bi-dash-circle"></i> Keluar
                                                </a>
                                                <a href="#"
                                                   class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="bi bi-box-seam fs-4 d-block mb-2"></i>
                                            Data inventory belum tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
