<?php

namespace App\Http\Controllers;

use App\Models\InventoryStockIn;
use App\Models\InventoryStockOut;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * INDEX STOCK MASUK
     */
    public function index_in()
    {
        $stockIns = InventoryStockIn::with([
                'inventory',
                'creator'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('inventories.stocks.in', compact('stockIns'));
    }

    /**
     * INDEX STOCK KELUAR
     */
    public function index_out()
    {
        $stockOuts = InventoryStockOut::with([
                'inventory',
                'creator'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('inventories.stocks.out', compact('stockOuts'));
    }
}
