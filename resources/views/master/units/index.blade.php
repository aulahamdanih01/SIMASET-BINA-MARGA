@extends('layouts-copas.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">

        <!-- TABEL SATUAN INVENTORY -->
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

                                {{-- Dummy --}}
                                <tr>
                                    <td>1</td>
                                    <td>PCS</td>
                                    <td>Pieces</td>
                                    <td>pcs</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <span class="badge bg-success">Aktif</span>
                                            <div class="custom-control custom-switch custom-switch-on-success">
                                                <input type="checkbox" class="custom-control-input" id="status1" checked>
                                                <label class="custom-control-label" for="status1"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-warning me-1">Edit</button>
                                        <button class="btn btn-sm btn-outline-info">Detail</button>
                                    </td>
                                </tr>

                                <tr class="table-light">
                                    <td>2</td>
                                    <td>KG</td>
                                    <td>Kilogram</td>
                                    <td>kg</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <span class="badge bg-secondary">Nonaktif</span>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="status2">
                                                <label class="custom-control-label" for="status2"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-warning me-1">Edit</button>
                                        <button class="btn btn-sm btn-outline-info">Detail</button>
                                    </td>
                                </tr>
                                {{-- End dummy --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM TAMBAH SATUAN -->
        <div class="col-lg-4">
            <div class="card card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Tambah Satuan Inventory</h3>
                </div>

                <form>
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label>Kode</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Contoh: PCS"
                            >
                        </div>

                        <div class="form-group mb-3">
                            <label>Nama Satuan</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Contoh: Pieces"
                            >
                        </div>

                        <div class="form-group mb-3">
                            <label>Simbol</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Contoh: pcs"
                            >
                        </div>

                        <div class="form-group mb-3">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="1" selected>Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END FORM -->

    </div>
</div>
@endsection
