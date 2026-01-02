<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetCategory extends Model
{
    use HasFactory;

    /**
     * Table name (opsional, tapi eksplisit)
     */
    protected $table = 'asset_categories';

    /**
     * Timestamps manual (karena tidak pakai $table->timestamps())
     */
    public $timestamps = false;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'asset_type',
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
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* ==========================
     | RELATIONSHIPS
     |==========================*/

    /**
     * User who created the category
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * User who last updated the category
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Fixed assets under this category
     */
    public function fixedAssets()
    {
        return $this->hasMany(FixedAsset::class)
            ->where('asset_type', 'fixed');
    }

    /**
     * Inventory assets under this category
     */
    public function inventories()
    {
        return $this->hasMany(AssetInventory::class)
            ->where('asset_type', 'inventory');
    }

    /* ==========================
     | SCOPES
     |==========================*/

    /**
     * Only active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /* ==========================
     | HELPERS
     |==========================*/

    /**
     * Check category type
     */
    public function isFixed(): bool
    {
        return $this->asset_type === 'fixed';
    }

    public function isInventory(): bool
    {
        return $this->asset_type === 'inventory';
    }
}
