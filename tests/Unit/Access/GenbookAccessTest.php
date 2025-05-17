<?php

namespace Tests\Unit\Access;

use App\Models\Staff;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use PHPUnit\Framework\TestCase;

class GenbookAccessTest extends TestCase
{
    private Client $client;
    private Staff $staff;
    private User $user;

    public function setup(): void
    {
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

    public function test_should_not_access_the_route_admin_if_not_authenticated(): void
    {
        $response = $this->client->get('/admin');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/', $response->getHeaderLine('Location'));
    }

    public function test_should_access_the_route_admin_if_authenticated_as_admin(): void
    {
        $email = 'test@test.com';
        $password = '123456';

        $this->user = new User([
        'full_name' => 'User 1',
        'email' => $email,
        ]);
        $this->user->save();

        $this->staff = new Staff([
        'user_id' => $this->user->id,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'admin' => true,
        'employee_id' => '654321',
        'hire_date' => date('Y-m-d'),
        ]);
        $this->staff->save();

        $cookieJar = new CookieJar();

        $loginResponse = $this->client->post('/login', [
        'form_params' => [
            'user[email]' => $email,
            'user[password]' => $password,
        ],
        'cookies' => $cookieJar,
        ]);

        $this->assertTrue(in_array($loginResponse->getStatusCode(), [200, 302]));

        $response = $this->client->get('/admin', [
        'cookies' => $cookieJar,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
