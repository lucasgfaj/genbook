<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Define a tabela (opcional, se o nome for "users")
    protected $table = 'users';

    // Define quais campos podem ser preenchidos em massa
    protected $fillable = [
        'full_name',
        'email',
        'is_active',
    ];

    // Casts automáticos
    protected $casts = [
        'is_active' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    // Exemplo de método customizado
    public static function findByEmail(string $email): ?User
    {
        return self::where('email', $email)->first();
    }
}
