<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetCategory extends Model
{
    use HasFactory;

    protected $table = 'asset_categories';

    protected $primaryKey = 'id';

    public $timestamps = false; 
    // karena timestamp dibuat manual (created_at & updated_at nullable)

    protected $fillable = [
        'name',
        'asset_type',
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
     * User yang membuat kategori
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * User yang terakhir mengubah kategori
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
