<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'is_active',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /* ==========================
     | RELATIONSHIPS
     |==========================*/

    /**
     * Users in this unit
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Inventory stock out (daily usage) via users
     */
    public function inventoryStockOuts()
    {
        return $this->hasManyThrough(
            InventoryStockOut::class,
            User::class,
            'unit_id',        // FK di users
            'created_by',     // FK di inventory_stock_out
            'id',             // PK di units
            'id'              // PK di users
        );
    }

    /* ==========================
     | SCOPES
     |==========================*/

    /**
     * Only active units
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
