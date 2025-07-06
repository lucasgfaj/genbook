<?php

namespace Tests\Unit\Controllers;

use App\Controllers\AuthorController;

class AuthorControllerTest extends ControllerTestCase
{
    public function test_routes_exist(): void
    {
        $routes = [
            'index',
            'show',
            'new',
            'create',
            'edit',
            'update',
            'deactivate',
            'activate',
            'destroy',
            'fetchFromOpenLibrary',
        ];

        foreach ($routes as $route) {
            $this->assertTrue(
                method_exists(AuthorController::class, $route),
                "Método {$route} não existe em AuthorController"
            );
        }
    }

    public function test_fetch_from_open_library_returns_json(): void
    {
        $_SERVER['HTTP_ACCEPT'] = 'application/json';

        $params = ['q' => 'Daniel'];
        $output = $this->get('fetchFromOpenLibrary', AuthorController::class, $params);

        $this->assertJson($output, 'Resposta não é um JSON válido');
        $data = json_decode($output, true);

        $this->assertArrayHasKey('numFound', $data);
    }
    public function test_fetch_from_open_library_contains_expected_fields(): void
    {
        $__SERVER['HTTP_ACCEPT'] = 'application/json';

        $params = ['q' => 'Daniel'];
        $output = $this->get('fetchFromOpenLibrary', AuthorController::class, $params);

        $data = json_decode($output, true);

        $expectedFields = [
            'name',
            'key',
            'type',
            'work_count',
        ];

        foreach ($expectedFields as $field) {
            $this->assertArrayHasKey($field, $data['docs'][0]);
        }
    }
}
