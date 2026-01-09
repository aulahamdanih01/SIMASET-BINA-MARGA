<?php

namespace App\Http\Controllers;

use App\Models\AssetInventory;
use App\Models\FixedAsset;
use App\Models\InventoryStockIn;
use App\Models\InventoryStockOut;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * INDEX STOCK MASUK
     */
    public function index_in(Request $request)
    {
        $inventories = AssetInventory::orderBy('name')->get();

        $stockIns = InventoryStockIn::with(['inventory', 'creator'])
            ->when($request->asset_inventory_id, function ($query) use ($request) {
                $query->where('asset_inventory_id', $request->asset_inventory_id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('inventories.stocks.in.index', compact(
            'stockIns',
            'inventories'
        ));
    }

    /**
     * INDEX STOCK KELUAR
     */
    public function index_out(Request $request)
    {
        $inventories = AssetInventory::orderBy('name')->get();

        $stockOuts = InventoryStockOut::with(['inventory', 'creator'])
            ->when($request->asset_inventory_id, function ($query) use ($request) {
                $query->where('asset_inventory_id', $request->asset_inventory_id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('inventories.stocks.out.index', compact(
            'stockOuts',
            'inventories'
        ));
    }


    public function create_in($id)
    {
        $selectedInventory = AssetInventory::findOrFail($id);

        return view('inventories.stocks.in.create', [
            'inventories' => AssetInventory::orderBy('name')->get(),
            'selectedInventory' => $selectedInventory,
        ]);
    }


        public function create_out($id)
    {
        $selectedInventory = AssetInventory::findOrFail($id);
        $units = Unit::active()->orderBy('name')->get();
        $fixedAssets       = FixedAsset::orderBy('name')->get();


        return view('inventories.stocks.out.create', [
            'inventories' => AssetInventory::orderBy('name')->get(),
            'units' => $units,
            'fixedAssets' => $fixedAssets,
            'selectedInventory' => $selectedInventory,
        ]);
    }
}
