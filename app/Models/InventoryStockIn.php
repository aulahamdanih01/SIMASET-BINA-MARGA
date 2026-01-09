<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryStockIn extends Model
{
    use HasFactory;

    protected $table = 'inventory_stock_in';

    /**
     * Karena tidak menggunakan $table->timestamps()
     */
    public $timestamps = false;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'asset_inventory_id',
        'quantity',
        'source',
        'created_at',
        'created_by',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'quantity'   => 'integer',
        'created_at' => 'datetime',
    ];

    /* ==========================
     | RELATIONSHIPS
     |==========================*/

    /**
     * Inventory item
     */
    public function inventory()
    {
        return $this->belongsTo(AssetInventory::class, 'asset_inventory_id');
    }

    /**
     * User who created this stock out
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
