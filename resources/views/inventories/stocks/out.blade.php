@extends('layouts-copas.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">

        <!-- FORM STOK KELUAR -->
        <div class="col-lg-12">
            <div class="card card-danger shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Tambah Stok Masuk</h3>
                </div>

                <form method="POST" action="{{ route('inventories.stocks.in.store') }}">
                    @csrf

                    <div class="card-body">

                        {{-- INVENTORY --}}
                        <div class="form-group mb-3">
                            <label>Nama Inventory</label>
                            <select name="asset_inventory_id"
                                    class="form-control"
                                    required>
                                <option value="" disabled selected>-- Pilih Inventory --</option>
                                @foreach ($inventories as $inventory)
                                    <option value="{{ $inventory->id }}">
                                        {{ $inventory->name }} ({{ $inventory->code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- JUMLAH --}}
                        <div class="form-group mb-3">
                            <label>Jumlah</label>
                            <input type="number"
                                   name="quantity"
                                   min="1"
                                   class="form-control"
                                   placeholder="Masukkan jumlah stok"
                                   required>
                        </div>

                        {{-- KEGUNAAN --}}
                        <div class="form-group mb-3">
                            <label>Digunakan Untuk</label>
                            <textarea name="usage_for"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Contoh: Penambahan stok gudang / pembelian supplier"></textarea>
                        </div>

                        {{-- TANGGAL --}}
                        <div class="form-group mb-3">
                            <label>Tanggal Masuk</label>
                            <input type="datetime-local"
                                   name="created_at"
                                   class="form-control"
                                   value="{{ now()->format('Y-m-d\TH:i') }}"
                                   required>
                        </div>

                        {{-- USER --}}
                        <input type="hidden"
                               name="created_by"
                               value="{{ auth()->id() }}">

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