<?php

namespace Config;

class App
{
    public static array $middlewareAliases = [
        'auth' => \App\Middleware\Authenticate::class,
        'guest' => \App\Middleware\GuestAuthenticate::class,
        'admin' => \App\Middleware\AdminAuthenticate::class,
    ];
}
