<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryStockIn extends Model
{
    use HasFactory;

    protected $table = 'inventory_stock_in';

    protected $primaryKey = 'id';

    public $timestamps = false;
    // hanya memakai created_at manual

    protected $fillable = [
        'asset_inventory_id',
        'quantity',
        'usage_for',
        'created_at',
        'created_by',
    ];

    protected $casts = [
        'quantity'   => 'decimal:2',
        'created_at' => 'datetime',
    ];

    /**
     * Relasi ke master inventory
     */
    public function inventory()
    {
        return $this->belongsTo(AssetInventory::class, 'asset_inventory_id');
    }

    /**
     * User yang mencatat stok masuk
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
