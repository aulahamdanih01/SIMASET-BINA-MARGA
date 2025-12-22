<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetInventoryUnit extends Model
{
    use HasFactory;

    protected $table = 'asset_inventory_units';

    protected $primaryKey = 'id';

    public $timestamps = false;
    // karena created_at & updated_at didefinisikan manual

    protected $fillable = [
        'code',
        'name',
        'symbol',
        'is_active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * User pembuat satuan inventory
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * User pengubah satuan inventory
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
