<?php

namespace App\Http\Controllers;

use App\Models\AssetInventory;
use App\Models\AssetCategory;
use App\Models\AssetInventoryUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssetInventoryController extends Controller
{
    /**
     * Display inventory list
     */
    public function index(Request $request)
    {
        $inventories = AssetInventory::with(['category', 'unit'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('code', 'like', "%{$request->search}%");
            })
            ->when($request->category, function ($q) use ($request) {
                $q->where('asset_category_id', $request->category);
            })
            ->orderBy('name')
            ->get();

        $categories = AssetCategory::orderBy('name')->get();

        return view('inventories.index', compact('inventories', 'categories'));
    }

    /**
     * Show create inventory form
     */
    public function create()
    {
        $categories = AssetCategory::orderBy('name')->get();
        $units      = AssetInventoryUnit::orderBy('name')->get();

        return view('inventories.create
        
        
        ', compact('categories', 'units'));
    }

    /**
     * Store new inventory
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                     => 'required|string|max:255',
            'asset_category_id'        => 'required|exists:asset_categories,id',
            'asset_inventory_unit_id' => 'required|exists:asset_inventory_units,id',
            'specification'            => 'nullable|string',
        ]);

        AssetInventory::create([
            'name'                     => $request->name,
            'code'                     => $this->generateCode((int) $request->asset_category_id),
            'asset_category_id'        => $request->asset_category_id,
            'asset_inventory_unit_id'  => $request->asset_inventory_unit_id,
            'specification'            => $request->specification,
            'created_at'               => now(),
            'created_by'               => auth()->id(),
        ]);



        return redirect()
            ->route('inventories.index')
            ->with('success', 'Inventory berhasil ditambahkan');
    }

    /**
     * Generate inventory code
     */
    private function generateCode(int $categoryId): string
    {
        $category = AssetCategory::findOrFail($categoryId);
        
        $prefix = 'INV';

        // Ambil 3 huruf pertama nama kategori
        $name = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $category->name), 0, 3));

        // Ambil kode terakhir berdasarkan kategori
        $lastInventory = AssetInventory::where('asset_category_id', $categoryId)
            ->where('code', 'like', "{$name}-%")
            ->orderByDesc('code')
            ->first();

        // Tentukan nomor urut
        if ($lastInventory) {
            $lastNumber = (int) substr($lastInventory->code, -3);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $prefix.'-'.$name . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

}