<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetInventory extends Model
{
    use HasFactory;

    protected $table = 'asset_inventory';

    protected $primaryKey = 'id';

    public $timestamps = false;
    // karena created_at & updated_at didefinisikan manual

    protected $fillable = [
        'name',
        'code',
        'asset_category_id',
        'spesification',
        'stock',
        'asset_inventory_units_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    protected $casts = [
        'stock'      => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke kategori aset
     */
    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    /**
     * Relasi ke satuan inventory
     */
    public function unit()
    {
        return $this->belongsTo(AssetInventoryUnit::class, 'asset_inventory_units_id');
    }

    /**
     * User pembuat data inventory
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * User pengubah data inventory
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
