<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject; // Thêm dòng này
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject // Thêm implements JWTSubject
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'age',
        'hometown',
        'job',
        'workplace',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Lấy giá trị của ID người dùng cho JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Lấy các claim mặc định của JWT.
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id');
    }
}