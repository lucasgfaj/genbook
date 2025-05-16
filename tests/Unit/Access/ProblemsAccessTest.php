<?php

namespace Tests\Unit\Access;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ProblemsAccessTest extends TestCase
{
    private Client $client;

    public function setup(): void
    {
        parent::setUp();
        $this->client = new Client([
            'allow_redirects' => false, // Disable following redirects
            'base_uri' => 'http://web:8080'
        ]);
    }

    public function test_should_not_access_the_index_route_if_not_authenticated(): void
    {
        $response = $this->client->get('/home');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/', $response->getHeaderLine('Location'));
    }

    public function test_should_not_access_the_show_route_if_not_authenticated(): void
    {
        $response = $this->client->get('/home');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/', $response->getHeaderLine('Location'));
    }

    public function test_should_not_access_the_route_route_if_not_authenticated(): void
    {
        $response = $this->client->get('/home');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/', $response->getHeaderLine('Location'));
    }

    // public function test_should_not_access_the_create_route_if_not_authenticated(): void
    // {
    //     $response = $this->client->post('/home', []);

    //     $this->assertEquals(302, $response->getStatusCode());
    //     $this->assertEquals('/', $response->getHeaderLine('Location'));
    // }

    // public function test_should_not_access_the_edit_route_if_not_authenticated(): void
    // {
    //     $response = $this->client->get('/home/1/edit');

    //     $this->assertEquals(302, $response->getStatusCode());
    //     $this->assertEquals('/', $response->getHeaderLine('Location'));
    // }

    // public function test_should_not_access_the_update_route_if_not_authenticated(): void
    // {
    //     $response = $this->client->put('/home/1', []);

    //     $this->assertEquals(302, $response->getStatusCode());
    //     $this->assertEquals('/', $response->getHeaderLine('Location'));
    // }
}
