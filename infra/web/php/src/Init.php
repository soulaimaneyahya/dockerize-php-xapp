<?php

declare(strict_types=1);

namespace App;

use App\Database\DatabaseConnectionService;
use App\Database\RedisConnectionService;

final class Init
{
    private readonly DatabaseConnectionService $dbConnectionService;
    private readonly RedisConnectionService $redisConnectionService;

    public function __construct(array $config)
    {
        $this->dbConnectionService = new DatabaseConnectionService($config['database']);
        $this->redisConnectionService = new RedisConnectionService($config['redis']);

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
