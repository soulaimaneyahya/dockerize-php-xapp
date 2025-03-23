<?php

declare(strict_types=1);

namespace App;

use App\DatabaseConnection;

class App
{
    private DatabaseConnection $dbConnection;

    public function __construct(array $config)
    {
        $this->dbConnection = new DatabaseConnection($config);
        
        dump($config['app_name']);
        dump($config['app_root']);
        dump($config['app_url']);
        dump($_SERVER['SERVER_ADDR']);
        dd($_SERVER['SERVER_PORT']);
    }

    public function getDatabaseConnection(): DatabaseConnection
    {
        return $this->dbConnection;
    }
}
