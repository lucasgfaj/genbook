<?php

namespace Tests\Unit\Lib\Validations;

use PHPUnit\Framework\TestCase;
use Core\Database\ActiveRecord\Model;
use Core\Database\Database;
use Lib\Validations;

class UniquenessValidationsTest extends TestCase
{
    public function setup(): void
    {
        Database::drop();
        Database::create();
        Database::exec('
            CREATE TABLE test_users (
                id SERIAL PRIMARY KEY,
                email VARCHAR(50) UNIQUE NOT NULL,
                phone VARCHAR(50)
            );
        ');
    }

    public function tearDown(): void
    {
        Database::drop();
    }

    public function test_uniqueness_true_when_no_registers(): void
    {
        $model = new class () extends Model {
            protected static string $table = 'test_users';
            protected static array $columns = ['email'];
        };

        $this->assertTrue(Validations::uniqueness('email', $model));
    }

    public function test_uniqueness_true_with_same_register(): void
    {
        $model = new class () extends Model {
            protected static string $table = 'test_users';
            protected static array $columns = ['email'];
        };

        $model->email = 'a@a.com'; // @phpstan-ignore-line
        $this->assertTrue($model->save());
        $this->assertTrue(Validations::uniqueness('email', $model));
    }

    public function test_uniqueness_update(): void
    {
        $model = new class () extends Model {
            protected static string $table = 'test_users';
            protected static array $columns = ['email'];

            public function validates(): void
            {
                Validations::uniqueness('email', $this);
            }
        };

        $model->email = 'a@a.com'; // @phpstan-ignore-line
        $this->assertTrue($model->save());
        $this->assertTrue($model->save());
    }

    public function test_uniqueness_update_with_another_email(): void
    {
        $model = new class () extends Model {
            protected static string $table = 'test_users';
            protected static array $columns = ['email'];

            public function validates(): void
            {
                Validations::uniqueness('email', $this);
            }
        };

        $model->email = 'a@a.com'; // @phpstan-ignore-line
        $this->assertTrue($model->save());

        $model->email = 'b@b.com';
        $this->assertTrue($model->save());
    }
}
