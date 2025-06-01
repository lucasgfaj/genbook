<?php

namespace Tests\Acceptance\Authentication;

use App\Models\Staff;
use App\Models\User;
use App\Models\Author;
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
    public function authSuccessfully(AcceptanceTester $page): void
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

    public function authorsEditSuccessfully(AcceptanceTester $page): void
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

        $author = new Author([
            'full_name' => 'Author to Deactivate',
            'bio' => 'Bio para desativação',
            'nationality' => 'BR',
            'birth_date' => '1970-01-01',
            'is_active' => true,
        ]);

        $author->save();

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
        $page->click('a[href="/authors/' . $author->id . '"]');;
        $page->see('Detalhes do Autor');
        $page->amOnPage('/authors/' . $author->id . '/edit');
        $page->seeInCurrentUrl('/authors/' . $author->id . '/edit');
        $page->see('Nome Completo');
        $page->fillField('author[full_name]', 'Autor Editado');
        $page->click('Salvar Alterações');
        $page->seeInCurrentUrl('/authors');
        $page->see('Autor atualizado com sucesso!');
    }


    public function authorsDeactivateSuccessfully(AcceptanceTester $page): void
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

        $author = new Author([
            'full_name' => 'Author to Deactivate',
            'bio' => 'Bio para desativação',
            'nationality' => 'BR',
            'birth_date' => '1970-01-01',
            'is_active' => true,
        ]);

        $author->save();

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
        $page->click('form[action="/authors/' . $author->id . '/deactivate"] button[type="submit"]');
        $page->seeInCurrentUrl('/authors');
        $page->see('Autor deletado com sucesso!');
    }

    public function authorsDestroySuccessfully(AcceptanceTester $page): void
    {
        $user1 = new User([
            'full_name' => 'Bibliotecário exemplo',
            'email' => 'genbook@gmail.com',
        ]);
        $user1->save();
        $staff1 = new Staff([
            'user_id' => $user1->id,
            'admin' => true,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'employee_id' => '789012',
            'hire_date' => date('Y-m-d'),
        ]);
        $staff1->save();

        $author = new Author([
            'full_name' => 'Author to Deactivate',
            'bio' => 'Bio para desativação',
            'nationality' => 'BR',
            'birth_date' => '1970-01-01',
            'is_active' => true,
        ]);

        $author->save();

        $page->amOnPage('/');

        $page->fillField('user[email]', $user1->email);
        $page->fillField('user[password]', '123456');

        $page->click('Entrar');

        $page->see('Login realizado com sucesso!');

        $page->seeInCurrentUrl('/home');
        $page->click('.menu-button');
        $page->see('Autores');
        $page->click('Autores');
        $page->amOnPage('/authors');

        $page->click('form[action="/authors/' . $author->id . '"] button[type="submit"]');

        $page->acceptPopup();

        $page->seeInCurrentUrl('/authors');
        $page->see("Autor #{$author->id} excluído com sucesso.");
        $page->dontSee($author->full_name);
    }

    public function authorsNewPageLoadsSuccessfully(AcceptanceTester $page): void
    {
        // Criar usuário admin
        $user = new User([
            'full_name' => 'Bibliotecário exemplo',
            'email' => 'genbook@gmail.com',
        ]);
        $user->save();

        $staff = new Staff([
            'user_id' => $user->id,
            'admin' => true,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'employee_id' => '789012',
            'hire_date' => date('Y-m-d'),
        ]);
        $staff->save();

        $page->amOnPage('/');

        $page->fillField('user[email]', $user->email);
        $page->fillField('user[password]', '123456');
        $page->click('Entrar');

        $page->see('Login realizado com sucesso!');
        $page->seeInCurrentUrl('/home');

        $page->amOnPage('/authors/new');

        $page->see('Adicionar Novo Autor');
        $page->seeElement('form#addAuthorForm');

        $page->seeElement('input[name="author[full_name]"]');
        $page->seeElement('input[name="author[nationality]"]');
        $page->seeElement('input[name="author[birth_date]"]');
        $page->seeElement('textarea[name="author[bio]"]');
    }
}
