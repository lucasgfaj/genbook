<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

class Staff extends Model

{
    protected $table = 'staff';

    protected $fillable = [
        'user_id',
        'password',
        'admin',
        'employee_id',
        'hire_date',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'admin' => 'boolean',
        'hire_date' => 'date',
    ];

    protected $hidden = [
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function authenticate(string $password): bool
    {
        return Hash::check($password, $this->password);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public static function findByUserId($userId)
    {
        return static::where('user_id', $userId)->first();
    }

    public static function isAdmin(int $userId): bool
    {
        return self::where('user_id', $userId)->value('admin') ?? false;
    }
}
