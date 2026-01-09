@extends('layouts-copas.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">

        <div class="col-lg-12">
            <div class="card card-danger shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Pengeluaran Stok (Stock Out)</h3>
                </div>

                <form method="POST" action="{{ route('inventories.stocks.out.store') }}">
                    @csrf

                    <div class="card-body">

                        {{-- INVENTORY --}}
                        <div class="form-group mb-3">
                            <label>Nama Inventory</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $selectedInventory->name }} ({{ $selectedInventory->code }})"
                                   readonly>

                            <input type="hidden"
                                   name="asset_inventory_id"
                                   value="{{ $selectedInventory->id }}">
                        </div>

                        {{-- JUMLAH --}}
                        <div class="form-group mb-3">
                            <label>Jumlah Keluar</label>
                            <input type="number"
                                   name="quantity"
                                   min="1"
                                   max="{{ $selectedInventory->stock }}"
                                   class="form-control"
                                   required>
                            <small class="text-muted">
                                Stok tersedia: {{ $selectedInventory->stock }}
                            </small>
                        </div>

                        {{-- JENIS PENGGUNAAN --}}
                        <div class="form-group mb-3">
                            <label class="d-block">Jenis Penggunaan</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                    type="radio"
                                    name="usage_type"
                                    id="usage_daily"
                                    value="daily"
                                    required>
                                <label class="form-check-label" for="usage_daily">
                                    Daily
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                    type="radio"
                                    name="usage_type"
                                    id="usage_maintenance"
                                    value="maintenance"
                                    required>
                                <label class="form-check-label" for="usage_maintenance">
                                    Maintenance
                                </label>
                            </div>
                        </div>

                        {{-- FIXED ASSET (MAINTENANCE ONLY) --}}
                        <div class="form-group mb-3 d-none" id="fixed-asset-wrapper">
                            <label>Digunakan Untuk Pemeliharaan</label>
                            <select name="fixed_asset_id" class="form-control">
                                <option value="">-- Pilih Aset --</option>
                                @foreach ($fixedAssets as $asset)
                                    <option value="{{ $asset->id }}">
                                        {{ $asset->code }} - {{ $asset->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- UNIT (DAILY ONLY) --}}
                        <div class="form-group mb-3 d-none" id="unit-wrapper">
                            <label>Unit</label>
                            <select name="unit_id" class="form-control">
                                <option value="">-- Pilih Unit --</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- KETERANGAN --}}
                        <div class="form-group mb-3">
                            <label>Keterangan</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Contoh: Pemakaian harian unit / perbaikan aset AC"></textarea>
                        </div>

                        {{-- TANGGAL --}}
                        <div class="form-group mb-3">
                            <label>Tanggal Pengeluaran</label>
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
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-box-arrow-up"></i> Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dailyRadio = document.getElementById('usage_daily');
    const maintenanceRadio = document.getElementById('usage_maintenance');

    const fixedAssetWrapper = document.getElementById('fixed-asset-wrapper');
    const unitWrapper = document.getElementById('unit-wrapper');

    function toggleUsage() {
        if (dailyRadio.checked) {
            unitWrapper.classList.remove('d-none');
            fixedAssetWrapper.classList.add('d-none');
        } 
        else if (maintenanceRadio.checked) {
            fixedAssetWrapper.classList.remove('d-none');
            unitWrapper.classList.add('d-none');
        }
    }

    dailyRadio.addEventListener('change', toggleUsage);
    maintenanceRadio.addEventListener('change', toggleUsage);
});
</script>
@endpush
