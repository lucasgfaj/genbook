<?php

$authorsToJson = [];

foreach ($authors as $author) {
    $authorsToJson[] = ['id' => $author->id, 'title' => $author->title];
}

$json['authors'] = $authorsToJson;
$json['pagination'] = [
    'page'                       => $paginator->getPage(),
    'per_page'                   => $paginator->perPage(),
    'total_of_pages'             => $paginator->totalOfPages(),
    'total_of_registers'         => $paginator->totalOfRegisters(),
    'total_of_registers_of_page' => $paginator->totalOfRegistersOfPage(),
];
