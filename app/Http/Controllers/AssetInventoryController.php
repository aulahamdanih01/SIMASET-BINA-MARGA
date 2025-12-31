<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\AssetCategory;
use App\Models\AssetInventory;
use App\Models\AssetInventoryUnit;

class AssetInventoryController extends Controller
{
    /**
     * Tampilkan daftar inventory aset
     */
    public function index(Request $request)
    {
        $assets = AssetInventory::with('category')
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                ->orWhere('code', 'like', "%{$request->search}%");
            })
            ->when($request->category, function ($q) use ($request) {
                $q->where('asset_category_id', $request->category);
            })
            ->orderBy('name')
            ->get();

        $categories = AssetInventory::orderBy('name')->get();

        return view('inventories.index', compact('assets', 'categories'));
    }

    public function create()
    {
        $categories = AssetCategory::orderBy('name')->get();
        $units = AssetInventoryUnit::orderBy('name')->get();

        return view('inventories.create', compact('categories', 'units'));
    }

    public function store(Request $request)
    {
        
    }

}