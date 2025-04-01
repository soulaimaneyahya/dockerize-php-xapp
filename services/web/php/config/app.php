<?php

declare(strict_types=1);

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return [
    'app_name' => $_ENV['APP_NAME'],
    'app_root' => dirname(dirname(__FILE__)) . '/app/',
    'app_url' => $_ENV['APP_URL'],
    'database' => [
        'host' => $_ENV['DB_HOST'],
        'database_connect' => $_ENV['DB_CONNECT'],
        'port' => $_ENV['MYSQL_PORT'],
        'database_name' => $_ENV['MYSQL_DATABASE'],
        'username' => $_ENV['MYSQL_USER'],
        'password' => $_ENV['MYSQL_PASSWORD'],
        'database_root_password' => $_ENV['MYSQL_ROOT_PASSWORD'],
    ],
    'redis' => [
        'host' => $_ENV['REDIS_HOST'],
        'port' => $_ENV['REDIS_PORT'],
    ],
];
