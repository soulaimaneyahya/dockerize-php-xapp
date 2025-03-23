<?php

declare(strict_types=1);

namespace App;

use App\Database\ConnectionService;

final class Init
{
    private readonly ConnectionService $connectionService;

    public function __construct(array $config)
    {
        $this->connectionService = new ConnectionService($config);

        $this->logConfig($config);
    }

    private function logConfig(array $config): void
    {
        dump([
            $config['app_name'],
            $config['app_root'],
            $config['app_url'],
            $_SERVER['SERVER_ADDR'],
            $_SERVER['SERVER_PORT'],
        ]);
    }
}
