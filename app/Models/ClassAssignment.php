<?php

namespace App\Models;

use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property int $client_id
 * @property int $class_id
 */
class ClassAssignment extends Model
{
    protected static string $table = 'class_assignments';
    protected static array $columns = [
        'client_id',
        'class_id'
    ];

    public function validates(): void
    {
        // Add validations as needed
    }

    // public function client()
    // {
    //     return $this->belongsTo(Client::class, 'client_id');
    // }

//     public function class()
//     {
//         return $this->belongsTo(Classe::class, 'class_id');
//     }
}
