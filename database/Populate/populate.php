<?php

require __DIR__ . '/../../config/bootstrap.php';

use Core\Database\Database;
use Database\Populate\AuthorsPopulate;
use Database\Populate\BooksPopulate;
use Database\Populate\CategoriesPopulate;
use Database\Populate\UsersPopulate;

Database::migrate();
UsersPopulate::populate();
CategoriesPopulate::populate();
AuthorsPopulate::populate();
BooksPopulate::populate();
