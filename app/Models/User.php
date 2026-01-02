<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'nip',
        'position',
        'unit_id',
        'address',
        'phone',
        'email',
        'role',
        'password',
        'last_active',
    ];

    /**
     * Hidden attributes for serialization
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'last_active' => 'datetime',
    ];

    /* ==========================
     | RELATIONSHIPS
     |==========================*/

    /**
     * User belongs to Unit
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Fixed assets under user's responsibility
     */
    public function fixedAssets()
    {
        return $this->hasMany(FixedAsset::class, 'person_in_charge');
    }

    /**
     * Inventory stock in created by user
     */
    public function inventoryStockIns()
    {
        return $this->hasMany(InventoryStockIn::class, 'created_by');
    }

    /**
     * Inventory stock out created by user
     */
    public function inventoryStockOuts()
    {
        return $this->hasMany(InventoryStockOut::class, 'created_by');
    }

    /**
     * Asset histories created by user
     */
    public function assetHistories()
    {
        return $this->hasMany(AssetHistory::class, 'created_by');
    }

    /* ==========================
     | ACCESSORS & HELPERS
     |==========================*/

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}