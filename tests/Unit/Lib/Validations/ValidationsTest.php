<?php

namespace Tests\Unit\Lib\Validations;

use PHPUnit\Framework\TestCase;
use Core\Database\ActiveRecord\Model;
use Lib\Validations;

class ValidationsTest extends TestCase
{
    public function test_not_empty(): void
    {
        $model = new class () extends Model {
            protected static array $columns = ['full_name'];
        };

        $this->assertFalse(Validations::notEmpty('full_name', $model));

        $model->full_name = 'Diego'; // @phpstan-ignore-line
        $this->assertTrue(Validations::notEmpty('full_name', $model));
    }
}
