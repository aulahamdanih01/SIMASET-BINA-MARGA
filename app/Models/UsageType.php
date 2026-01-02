<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsageType extends Model
{
    use HasFactory;

    protected $table = 'usage_types';

    /**
     * Tidak menggunakan timestamps
     */
    public $timestamps = false;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'code',
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
     * Inventory stock in with this usage type
     */
    public function stockIns()
    {
        return $this->hasMany(InventoryStockIn::class, 'usage_type_id');
    }

    /**
     * Inventory stock out with this usage type
     */
    public function stockOuts()
    {
        return $this->hasMany(InventoryStockOut::class, 'usage_type_id');
    }

    /* ==========================
     | SCOPES
     |==========================*/

    /**
     * Only active usage types
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /* ==========================
     | HELPERS
     |==========================*/

    public function isDaily(): bool
    {
        return $this->code === 'DAILY';
    }

    public function isMaintenance(): bool
    {
        return $this->code === 'MAINTENANCE';
    }
}
