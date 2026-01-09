<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryStockOut extends Model
{
    use HasFactory;

    protected $table = 'inventory_stock_out';

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
        'usage_type_id',
        'fixed_asset_id',
        'description',
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
     * Related fixed asset (nullable)
     */
    public function fixedAsset()
    {
        return $this->belongsTo(FixedAsset::class, 'fixed_asset_id');
    }

    /**
     * User who created this stock in
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
