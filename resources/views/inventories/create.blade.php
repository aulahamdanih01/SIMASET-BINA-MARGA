@extends('layouts-copas.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">

        <!-- FORM TAMBAH INVENTORY -->
        <div class="col-lg-12">
            <div class="card card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Tambah Inventory</h3>
                </div>

                <form method="POST" action="{{ route('inventories.store') }}">
                    @csrf

                    <div class="card-body">

                        {{-- NAMA BARANG --}}
                        <div class="form-group mb-3">
                            <label>Nama Barang</label>
                            <input type="text"
                                name="name"
                                class="form-control"
                                placeholder="Contoh: Oli Mesin"
                                required>
                        </div>

                        {{-- KATEGORI --}}
                        <div class="form-group mb-3">
                            <label>Kategori</label>
                            <select name="asset_category_id"
                                    class="form-control"
                                    required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- SATUAN --}}
                        <div class="form-group mb-3">
                            <label>Satuan</label>
                            <select name="asset_inventory_unit_id"
                                    class="form-control"
                                    required>
                                <option value="" disabled selected>-- Pilih Satuan --</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">
                                        {{ $unit->symbol }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- SPESIFIKASI --}}
                        <div class="form-group mb-3">
                            <label>Specifikasi</label>
                            <textarea name="specification"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Contoh: Kemasan 1 Liter, SAE 10W-40"></textarea>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END FORM -->
    </div>
</div>
@endsection