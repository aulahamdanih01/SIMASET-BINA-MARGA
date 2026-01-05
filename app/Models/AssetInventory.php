<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetInventory extends Model
{
    use HasFactory;

    protected $table = 'asset_inventories';

    /**
     * Karena tidak menggunakan $table->timestamps()
     */
    public $timestamps = false;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'code',
        'asset_category_id',
        'specification',
        'stock',
        'asset_inventory_unit_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'stock'       => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    /* ==========================
     | RELATIONSHIPS
     |==========================*/

    /**
     * Category of inventory
     */
    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    /**
     * Unit of inventory (pcs, box, etc)
     */
    public function unit()
    {
        return $this->belongsTo(
            AssetInventoryUnit::class,
            'asset_inventory_unit_id'
        );
    }

    /**
     * User who created this inventory
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * User who last updated this inventory
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Stock in history
     */
    public function stockIns()
    {
        return $this->hasMany(InventoryStockIn::class, 'asset_inventory_id');
    }

    /**
     * Stock out history
     */
    public function stockOuts()
    {
        return $this->hasMany(InventoryStockOut::class, 'asset_inventory_id');
    }

    /* ==========================
     | SCOPES
     |==========================*/

    /**
     * Inventory with available stock
     */
    public function scopeAvailable($query)
    {
        return $query->where('stock', '>', 0);
    }

    /* ==========================
     | HELPERS
     |==========================*/

    /**
     * Increase stock
     */
    public function increaseStock(int $qty): void
    {
        $this->increment('stock', $qty);
    }

    /**
     * Decrease stock (safe)
     */
    public function decreaseStock(int $qty): void
    {
        if ($this->stock < $qty) {
            throw new \Exception('Stok tidak mencukupi');
        }

        $this->decrement('stock', $qty);
    }
}
