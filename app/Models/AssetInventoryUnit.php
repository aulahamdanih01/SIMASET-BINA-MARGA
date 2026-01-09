<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetInventoryUnit extends Model
{
    use HasFactory;

    protected $table = 'asset_inventory_units';

    /**
     * Karena tidak menggunakan $table->timestamps()
     */
    public $timestamps = false;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'code',
        'photo',
        'name',
        'symbol',
        'is_active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'is_active'   => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* ==========================
     | RELATIONSHIPS
     |==========================*/

    /**
     * User who created this unit
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * User who last updated this unit
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Inventories that use this unit
     */
    public function inventories()
    {
        return $this->hasMany(AssetInventory::class, 'asset_inventory_unit_id');
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
