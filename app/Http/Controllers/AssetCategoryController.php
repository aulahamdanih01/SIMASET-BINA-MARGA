<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use Illuminate\Http\Request;

class AssetCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $categories = AssetCategory::orderBy('name')->get();

        $editData = null;
        if ($request->filled('edit')) {
            $editData = AssetCategory::findOrFail($request->edit);
        }

        return view('master.categories.index', compact(
            'categories',
            'editData'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'asset_type' => 'required|in:fixed,inventory',
            'is_active'  => 'required|boolean',
        ]);

        AssetCategory::create([
            'name'        => $request->name,
            'asset_type'  => $request->asset_type,
            'is_active'   => $request->is_active,
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ]);

        return redirect()
            ->route('master.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $category = AssetCategory::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:100',
            'asset_type' => 'required|in:fixed,inventory',
            'is_active'  => 'required|boolean',
        ]);

        $category->update([
            'name'        => $request->name,
            'asset_type'  => $request->asset_type,
            'is_active'   => $request->is_active,
            'updated_at' => now(),
            'updated_by' => auth()->user()->id,
        ]);

        return redirect()
            ->route('master.categories.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }
}