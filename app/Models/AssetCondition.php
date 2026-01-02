<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetCondition extends Model
{
    use HasFactory;

    protected $table = 'asset_conditions';

    /**
     * Karena tidak menggunakan $table->timestamps()
     */
    public $timestamps = false;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'code',
        'name',
        'description',
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
     * User who created this condition
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * User who last updated this condition
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Fixed assets with this condition
     */
    public function fixedAssets()
    {
        return $this->hasMany(FixedAsset::class, 'asset_condition_id');
    }

    /* ==========================
     | SCOPES
     |==========================*/

    /**
     * Only active conditions
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}