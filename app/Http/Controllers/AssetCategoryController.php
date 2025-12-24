<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use Illuminate\Http\Request;

class AssetCategoryController extends Controller
{
    public function index()
    {
        $categories = AssetCategory::orderBy('name')->get();

        return view('master.categories.index', compact('categories'));
    }

    public function show(Request $request, $id)
{
    $category = AssetCategory::findOrFail($id);
    $mode = $request->get('mode', 'detail'); // detail | edit

    return view('asset-categories.show', compact('category', 'mode'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'asset_type' => 'required',
    ]);

    AssetCategory::where('id', $id)->update([
        'name' => $request->name,
        'asset_type' => $request->asset_type,
    ]);

    return redirect()
        ->route('asset-categories.show', $id)
        ->with('success', 'Kategori berhasil diperbarui');
}

public function toggleStatus($id)
{
    $category = AssetCategory::findOrFail($id);
    $category->is_active = !$category->is_active;
    $category->save();

    return response()->json([
        'success' => true,
        'status' => $category->is_active
    ]);
}}