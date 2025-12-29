<?php

namespace App\Http\Controllers;

use App\Models\AssetInventoryUnit;
use Illuminate\Http\Request;

class AssetInventoryUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index + Edit (dalam satu halaman)
     */
    public function index(Request $request)
    {
        $units = AssetInventoryUnit::orderBy('name')->get();

        $editData = null;
        if ($request->filled('edit')) {
            $editData = AssetInventoryUnit::findOrFail($request->edit);
        }

        return view('master.units.index', compact(
            'units',
            'editData'
        ));
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'      => 'required|string|max:20|unique:asset_inventory_units,code',
            'name'      => 'required|string|max:100',
            'symbol'    => 'required|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        AssetInventoryUnit::create([
            'code'       => $request->code,
            'name'       => $request->name,
            'symbol'     => $request->symbol,
            'is_active'  => $request->is_active,
            'created_at'=> now(),
            'created_by'=> auth()->user()->id,
        ]);

        return redirect()
            ->route('master.units.index')
            ->with('success', 'Satuan inventory berhasil ditambahkan');
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $unit = AssetInventoryUnit::findOrFail($id);

        $request->validate([
            'code'      => 'required|string|max:20|unique:asset_inventory_units,code,' . $unit->id,
            'name'      => 'required|string|max:100',
            'symbol'    => 'required|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        $unit->update([
            'code'       => $request->code,
            'name'       => $request->name,
            'symbol'     => $request->symbol,
            'is_active'  => $request->is_active,
            'updated_at'=> now(),
            'updated_by'=> auth()->user()->id,
        ]);

        return redirect()
            ->route('master.units.index')
            ->with('success', 'Satuan inventory berhasil diperbarui');
    }
}