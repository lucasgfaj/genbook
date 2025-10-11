<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property string $password
 * @property bool $admin
 * @property string $employee_id
 * @property string $hire_date
 * @property bool $is_active
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class Staff extends Model
{
    use HasFactory;

    /**
     * Nome da tabela.
     */
    protected $table = 'staff';

    /**
     * Campos permitidos para inserção/atualização.
     */
    protected $fillable = [
        'user_id',
        'password',
        'admin',
        'employee_id',
        'hire_date',
        'is_active',
    ];

    /**
     * Cast automático de tipos.
     */
    protected $casts = [
        'is_active' => 'boolean',
        'admin' => 'boolean',
        'hire_date' => 'date',
    ];

    /**
     * Esconde a senha quando o modelo for convertido em JSON.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Relacionamento: Staff pertence a um usuário.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define o hash da senha automaticamente.
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * Autentica verificando a senha.
     */
    public function authenticate(string $password): bool
    {
        return Hash::check($password, $this->password);
    }

    /**
     * Escopo para buscar apenas funcionários ativos.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Busca um staff pelo ID do usuário.
     */
    public static function findByUserId(int $userId): ?self
    {
        return self::where('user_id', $userId)->first();
    }

    /**
     * Verifica se o usuário é administrador.
     */
    public static function isAdmin(int $userId): bool
    {
        return self::where('user_id', $userId)->value('admin') ?? false;
    }
}
