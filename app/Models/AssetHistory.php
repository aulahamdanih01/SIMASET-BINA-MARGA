<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetHistory extends Model
{
    use HasFactory;

    protected $table = 'asset_histories';

    protected $primaryKey = 'id';

    public $timestamps = false;
    // hanya created_at manual

    protected $fillable = [
        'fixed_asset_id',
        'event_type',
        'old_user',
        'new_user',
        'old_status',
        'new_status',
        'reference',
        'created_by',
        'created_at',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Aset tetap terkait
     */
    public function fixedAsset()
    {
        return $this->belongsTo(FixedAsset::class, 'fixed_asset_id');
    }

    /**
     * User sebelum mutasi
     */
    public function oldUser()
    {
        return $this->belongsTo(User::class, 'old_user');
    }

    /**
     * User setelah mutasi
     */
    public function newUser()
    {
        return $this->belongsTo(User::class, 'new_user');
    }

    /**
     * Kondisi lama aset
     */
    public function oldCondition()
    {
        return $this->belongsTo(AssetCondition::class, 'old_status');
    }

    /**
     * Kondisi baru aset
     */
    public function newCondition()
    {
        return $this->belongsTo(AssetCondition::class, 'new_status');
    }

    /**
     * User pencatat histori
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
