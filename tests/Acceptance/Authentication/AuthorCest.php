<?php

namespace Tests\Acceptance\Authentication;

use App\Models\Staff;
use App\Models\User;
use Tests\Acceptance\BaseAcceptanceCest;
use Tests\Support\AcceptanceTester;

class AuthorCest extends BaseAcceptanceCest
{
    public function authorSuccessfullyAdmin(AcceptanceTester $page): void
    {
        $user = new User([
            'full_name' => 'Admin exemplo',
            'email' => 'admin@example.com',
        ]);
        $user->save();
        $staff = new Staff([
            'user_id' => $user->id,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'admin' => true,
            'employee_id' => '654321',
            'hire_date' => date('Y-m-d'),
        ]);
        $staff->save();

        $page->amOnPage('/');

        $page->fillField('user[email]', $user->email);
        $page->fillField('user[password]', '123456');

        $page->click('Entrar');

        $page->see('Login realizado com sucesso!');
        $page->seeInCurrentUrl('/home');
        $page->click('.menu-button');
        $page->see('Autores');
        $page->click('Autores');
        $page->seeInCurrentUrl('/authors');
    }
    public function AuthSuccessfully(AcceptanceTester $page): void
    {
        $user1 = new User([
            'full_name' => 'Bibliotecário exemplo',
            'email' => 'genbook@gmail.com',
        ]);
        $user1->save();
        $staff1 = new Staff([
            'user_id' => $user1->id,
            'admin' => false,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'employee_id' => '789012',
            'hire_date' => date('Y-m-d'),
        ]);
        $staff1->save();

        $page->amOnPage('/');

        $page->fillField('user[email]', $user1->email);
        $page->fillField('user[password]', '123456');

        $page->click('Entrar');

        $page->see('Login realizado com sucesso!');

        $page->seeInCurrentUrl('/home');
        $page->click('.menu-button');
        $page->see('Autores');
        $page->click('Autores');
        $page->seeInCurrentUrl('/authors');
    }
}
