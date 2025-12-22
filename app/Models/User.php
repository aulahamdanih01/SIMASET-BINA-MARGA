<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'nip',
        'position',
        'address',
        'phone',
        'email',
        'role',
        'password',
        'last_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_active' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel sessions
     */
    public function sessions()
    {
        return $this->hasMany(Session::class, 'user_id');
    }
}
