<?php

namespace Tests\Unit\Controllers;

use App\Controllers\BookController;
use PHPUnit\Framework\TestCase;

class BookControllerTest extends TestCase
{
    public function test_routes_exist()
    {
        $routes = [
            'index',
            'new',
            'create',
            'show',
            'edit',
            'update',
            'deactivate',
            'activate',
        ];

        foreach ($routes as $route) {
            // Simula chamada de rota e verifica se método existe no controller
            $this->assertTrue(
                method_exists(BookController::class, $route),
                "Método {$route} não existe em BookController"
            );
        }
    }
}
