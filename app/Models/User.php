<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'full_name',
        'email',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function getAdminAttribute(): bool
    {
        return (bool) ($this->staff?->admin ?? false);
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public static function findByEmail(string $email): ?User
    {
        return self::where('email', $email)->first();
    }
}
