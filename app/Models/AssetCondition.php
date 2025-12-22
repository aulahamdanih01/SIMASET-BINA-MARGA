<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetCondition extends Model
{
    use HasFactory;

    protected $table = 'asset_conditions';

    protected $primaryKey = 'id';

    public $timestamps = false;
    // created_at & updated_at dikelola manual

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

    protected $casts = [
        'is_active'   => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * User pembuat kondisi aset
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * User pengubah kondisi aset
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}