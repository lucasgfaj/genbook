<?php

$bookToJson = [];

foreach ($books as $book) {
    $booksToJson[] = ['id' => $book->id, 'title' => $book->title];
}

$json['books'] = $booksToJson;
$json['pagination'] = [
    'page'                       => $paginator->getPage(),
    'per_page'                   => $paginator->perPage(),
    'total_of_pages'             => $paginator->totalOfPages(),
    'total_of_registers'         => $paginator->totalOfRegisters(),
    'total_of_registers_of_page' => $paginator->totalOfRegistersOfPage(),
];
