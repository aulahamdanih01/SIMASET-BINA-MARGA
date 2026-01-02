<?php

namespace App\Http\Controllers;

use App\Models\AssetInventory;
use App\Models\InventoryStockIn;
use App\Models\InventoryStockOut;
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

        return view('inventories.stocks.in', compact(
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

        return view('inventories.stocks.out', compact(
            'stockOuts',
            'inventories'
        ));
    }
}
