<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryStockOut extends Model
{
    use HasFactory;

    protected $table = 'inventory_stock_out';

    protected $primaryKey = 'id';

    public $timestamps = false;
    // hanya menggunakan created_at manual

    protected $fillable = [
        'asset_inventory_id',
        'quantity',
        'source',
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
     * User yang mencatat stok keluar
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
