<?php

declare(strict_types=1);

namespace App;

class App
{
    public function __construct()
    {
        var_dump($_SERVER['SERVER_ADDR'], $_SERVER['SERVER_PORT']);
    }
}
