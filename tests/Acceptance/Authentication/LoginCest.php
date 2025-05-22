<?php

namespace Tests\Acceptance\Authentication;

use App\Models\Staff;
use App\Models\User;
use Tests\Acceptance\BaseAcceptanceCest;
use Tests\Support\AcceptanceTester;

class LoginCest extends BaseAcceptanceCest
{
    public function loginSuccessfullyAdmin(AcceptanceTester $page): void
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
        $page->see('Admin');
        $page->click('Admin');
        $page->seeInCurrentUrl('/admin');
    }

    public function loginUnsuccessfully(AcceptanceTester $page): void
    {
        $page->amOnPage('/');

        $page->fillField('user[email]', 'fulano@example.com');
        $page->fillField('user[password]', 'wrong_password');

        $page->click('Entrar');

        $page->see('Email e/ou senha inválidos!');
        $page->seeInCurrentUrl('/');
    }

    public function loginSuccessfully(AcceptanceTester $page): void
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
    }

    public function logout(AcceptanceTester $page): void
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
        $page->see('Sair');
        $page->click('Sair');

        $page->seeInCurrentUrl('/');

        $page->see('Logout realizado com sucesso!');
    }

    public function loginUnsuccessfullyAdmin(AcceptanceTester $page): void
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

        $page->amOnPage('/admin');

        $page->see('Você deve estar logado para acessar essa página');

        $page->fillField('user[email]', $user1->email);
        $page->fillField('user[password]', '123456');

        $page->click('Entrar');

        $page->see('Login realizado com sucesso!');

        $page->seeInCurrentUrl('/home');

        $page->amOnPage('/admin');

        $page->see('Você deve ser um administrador para acessar essa página');

        $page->seeInCurrentUrl('/home');
    }
}
