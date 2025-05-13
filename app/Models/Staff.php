<?php

namespace App\Models;

use Lib\Validations;
use App\Models\User;

// -- STAFF
// CREATE TABLE staff (
//     id SERIAL PRIMARY KEY,
//     user_id INTEGER REFERENCES users(id),
//     password VARCHAR(255),
//     admin BOOLEAN DEFAULT FALSE,
//     employee_id VARCHAR(50),
//     hire_date DATE
// );
/**
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property bool $is_active
 * @property string $password
 * @property string $employee_id
 * @property string $hire_date
 * @property bool $admin
 * @property User $user
 */
class Staff extends User
{
    protected static string $table = 'staff';
    protected static array $columns = ['user_id', 'password', 'admin', 'employee_id', 'hire_date'];

    public function validates(): void
    {
        Validations::notEmpty('full_name', $this);
        Validations::notEmpty('email', $this);
        Validations::notEmpty('password', $this);
        Validations::notEmpty('employee_id', $this);
        Validations::uniqueness('email', $this);
    }
}
