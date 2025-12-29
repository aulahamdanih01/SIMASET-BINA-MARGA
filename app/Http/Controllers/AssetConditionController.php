<?php

namespace App\Http\Controllers;

use App\Models\AssetCondition;
use Illuminate\Http\Request;

class AssetConditionController extends Controller
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
        $conditions = AssetCondition::orderBy('name')->get();

        $editData = null;
        if ($request->filled('edit')) {
            $editData = AssetCondition::findOrFail($request->edit);
        }

        return view('master.conditions.index', compact(
            'conditions',
            'editData'
        ));
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'        => 'required|string|max:20|unique:asset_conditions,code',
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'is_active'   => 'required|boolean',
        ]);

        AssetCondition::create([
            'code'        => $request->code,
            'name'        => $request->name,
            'description' => $request->description,
            'is_active'   => $request->is_active,
            'created_at'  => now(),
            'created_by'  => auth()->user()->id,
        ]);

        return redirect()
            ->route('master.conditions.index')
            ->with('success', 'Kondisi aset berhasil ditambahkan');
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $condition = AssetCondition::findOrFail($id);

        $request->validate([
            'code'        => 'required|string|max:20|unique:asset_conditions,code,' . $condition->id,
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'is_active'   => 'required|boolean',
        ]);

        $condition->update([
            'code'        => $request->code,
            'name'        => $request->name,
            'description' => $request->description,
            'is_active'   => $request->is_active,
            'updated_at'  => now(),
            'updated_by'  => auth()->user()->id,
        ]);

        return redirect()
            ->route('master.conditions.index')
            ->with('success', 'Kondisi aset berhasil diperbarui');
    }
}