<?php

namespace Tests\Acceptance\Authentication;

use App\Models\Staff;
use App\Models\User;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Tests\Acceptance\BaseAcceptanceCest;
use Tests\Support\AcceptanceTester;

class BookCest extends BaseAcceptanceCest
{
    /** @var Author */
    private $testAuthor;

    /** @var Category */
    private $testCategory;

    public function _before(AcceptanceTester $page): void
    {
        parent::_before($page);

        $this->testAuthor = new Author([
            'full_name' => 'Test Author for Books',
            'bio' => 'Biography of a test author for book-related tests.',
            'nationality' => 'Brazilian',
            'birth_date' => '1900-01-01',
            'is_active' => true,
        ]);
        $this->testAuthor->save();

        $this->testCategory = new Category([
            'name' => 'Test Category for Books',
            'description' => 'Description of a test category for book-related tests.',
            'is_active' => true,
        ]);
        $this->testCategory->save();
    }

    public function booksIndexLoadsSuccessfullyAsAdmin(AcceptanceTester $page): void
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
        $page->see('Livros');
        $page->click('Livros');
        $page->seeInCurrentUrl('/books');
        $page->see('Livros');
    }

    public function booksIndexLoadsSuccessfullyAsLibrarian(AcceptanceTester $page): void
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
        $page->see('Livros');
        $page->click('Livros');
        $page->seeInCurrentUrl('/books');
        $page->see('Livros');
    }

    public function booksNewPageLoadsSuccessfully(AcceptanceTester $page): void
    {
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

        $page->amOnPage('/books/new');

        $page->see('Adicionar Novo Livro');
        $page->seeElement('form#addBookForm');
        $page->seeElement('input[name="book[title]"]');
        $page->seeElement('select[name="book[category_id]"]');
        $page->seeElement('input[name="book[publisher]"]');
        $page->seeElement('input[name="book[isbn]"]');
        $page->seeElement('input[name="book[edition]"]');
        $page->seeElement('input[name="book[year]"]');
        $page->seeElement('input[name="book[quantity]"]');
        $page->seeElement('input[name="book[shelf_location]"]');
        $page->seeElement('select[name="authors[]"]');
    }

    public function booksShowSuccessfully(AcceptanceTester $page): void
    {
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

        $book = new Book([
            'title' => 'Book to Show',
            'category_id' => $this->testCategory->id,
            'publisher' => 'Publisher Show',
            'isbn' => '111-222-333-4',
            'edition' => '1st',
            'year' => 2020,
            'quantity' => 1,
            'shelf_location' => 'S1',
            'is_active' => true,
        ]);
        $book->save();
        $book->authors()->attach($this->testAuthor->id);

        $page->amOnPage('/');
        $page->fillField('user[email]', $user->email);
        $page->fillField('user[password]', '123456');
        $page->click('Entrar');
        $page->see('Login realizado com sucesso!');

        $page->amOnPage('/books/' . $book->id);
        $page->see('Detalhes do Livro');
    }
    public function booksEditSuccessfully(AcceptanceTester $page): void
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

        $book = new Book([
            'title' => 'Book to Edit',
            'category_id' => $this->testCategory->id,
            'publisher' => 'Old Publisher',
            'isbn' => '999-888-777-6',
            'edition' => '1ª',
            'year' => 2000,
            'quantity' => 1,
            'shelf_location' => 'E1',
            'is_active' => true,
        ]);
        $book->save();
        $book->authors()->attach($this->testAuthor->id);

        $page->amOnPage('/');
        $page->fillField('user[email]', $user1->email);
        $page->fillField('user[password]', '123456');
        $page->click('Entrar');

        $page->see('Login realizado com sucesso!');
        $page->seeInCurrentUrl('/home');

        $page->click('.menu-button');
        $page->see('Livros');
        $page->click('Livros');
        $page->seeInCurrentUrl('/books');
        $page->click('a[href="/books/' . $book->id . '"]');
        $page->see('Detalhes do Livro');

        $page->amOnPage('/books/' . $book->id . '/edit');
        $page->seeInCurrentUrl('/books/' . $book->id . '/edit');
        $page->see('Título');
        $page->fillField('book[title]', 'Book Edited Title');
        $page->waitForElementVisible('button.btn.btn-success', 5);
        $page->executeJS(
            'document.querySelector("button.btn.btn-success").scrollIntoView({behavior: "instant", block: "center"});'
        );
        $page->wait(1);
        $page->click('button.btn.btn-success');

        $page->seeInCurrentUrl('/books');
    }

    public function booksDeactivateSuccessfully(AcceptanceTester $page): void
    {
        $user1 = new User([
            'full_name' => 'Admin exemplo',
            'email' => 'admin@example.com',
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

        $book = new Book([
            'title' => 'Book to Deactivate',
            'category_id' => $this->testCategory->id,
            'publisher' => 'Deactivate Publisher',
            'isbn' => '555-444-333-2',
            'edition' => '1ª',
            'year' => 2010,
            'quantity' => 1,
            'shelf_location' => 'D1',
            'is_active' => true,
        ]);
        $book->save();
        $book->authors()->attach($this->testAuthor->id);

        $page->amOnPage('/');
        $page->fillField('user[email]', $user1->email);
        $page->fillField('user[password]', '123456');
        $page->click('Entrar');
        $page->see('Login realizado com sucesso!');

        $page->amOnPage('/books');
        $page->waitForElementClickable('form[action="/books/' . $book->id . '/deactivate"] button[type="submit"]', 10);
        $page->click('form[action="/books/' . $book->id . '/deactivate"] button[type="submit"]');
        $page->seeInCurrentUrl('/books');
        $page->see('Livro inativado com sucesso!');
    }

    public function booksDestroySuccessfully(AcceptanceTester $page): void
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

        $book = new Book([
            'title' => 'Book to Delete',
            'category_id' => $this->testCategory->id,
            'publisher' => 'Delete Publisher',
            'isbn' => '666-555-444-3',
            'edition' => '1ª',
            'year' => 2005,
            'quantity' => 1,
            'shelf_location' => 'DEL',
            'is_active' => true,
        ]);
        $book->save();
        $book->authors()->attach($this->testAuthor->id);

        $page->amOnPage('/');
        $page->fillField('user[email]', $user1->email);
        $page->fillField('user[password]', '123456');
        $page->click('Entrar');
        $page->see('Login realizado com sucesso!');

        $page->amOnPage('/books');
        $page->waitForElementClickable('form[action="/books/' . $book->id . '"] button[type="submit"]', 10);
        $page->click('form[action="/books/' . $book->id . '"] button[type="submit"]');
        $page->acceptPopup();

        $page->seeInCurrentUrl('/books');
        $page->see("Livro #{$book->id} excluído com sucesso.");
        $page->dontSee($book->title);
    }

    public function bookCoverUpdateOnEditSuccessfully(AcceptanceTester $page): void
    {
        $user = new User([
            'full_name' => 'Admin Edita Capa',
            'email' => 'adminedit@example.com',
        ]);
        $user->save();

        $staff = new Staff([
            'user_id' => $user->id,
            'admin' => true,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'employee_id' => '333444',
            'hire_date' => date('Y-m-d'),
        ]);
        $staff->save();

        $book = new Book([
            'title' => 'Livro Antigo',
            'category_id' => $this->testCategory->id,
            'publisher' => 'Editora X',
            'isbn' => '000-111-222-3',
            'edition' => '1ª',
            'year' => 2010,
            'quantity' => 2,
            'shelf_location' => 'Z1',
            'is_active' => true,
        ]);
        $book->save();
        $book->authors()->attach($this->testAuthor->id);

        $page->amOnPage('/');
        $page->fillField('user[email]', $user->email);
        $page->fillField('user[password]', '123456');
        $page->click('Entrar');
        $page->see('Login realizado com sucesso!');

        $page->amOnPage('/books/' . $book->id . '/edit');
        $page->attachFile('input[name="cover_name"]', 'genbook.png');
        $page->fillField('book[title]', 'Livro Atualizado');
        $page->waitForElementVisible('button.btn.btn-success', 5);
        $page->executeJS(
            'document.querySelector("button.btn.btn-success").scrollIntoView({behavior: "instant", block: "center"});'
        );
        $page->wait(1);

        $page->click('button.btn.btn-success');
    }
}
