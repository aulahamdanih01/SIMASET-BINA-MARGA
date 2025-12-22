<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FixedAsset extends Model
{
    use HasFactory;

    protected $table = 'fixed_assets';

    protected $primaryKey = 'id';

    public $timestamps = false;
    // created_at & updated_at dikelola manual

    protected $fillable = [
        'name',
        'code',
        'asset_category_id',
        'person_in_charge',
        'asset_condition_id',
        'acquisition_date',
        'specification',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    protected $casts = [
        'acquisition_date' => 'date',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];

    /**
     * Kategori aset tetap
     */
    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    /**
     * Penanggung jawab aset
     */
    public function personInCharge()
    {
        return $this->belongsTo(User::class, 'person_in_charge');
    }

    /**
     * Kondisi aset
     */
    public function condition()
    {
        return $this->belongsTo(AssetCondition::class, 'asset_condition_id');
    }

    /**
     * User pembuat data aset
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * User pengubah data aset
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}