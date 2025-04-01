<?php

declare(strict_types=1);

namespace App;

use App\Migrations\PostMigration;
use App\Repositories\PostRepository;
use App\Database\RedisConnectionService;
use App\Database\DatabaseConnectionService;

final class Init
{
    private readonly DatabaseConnectionService $databaseConnectionService;
    private readonly RedisConnectionService $redisConnectionService;
    private readonly PostMigration $postMigration;
    private readonly PostRepository $postRepository;

    public function __construct(array $config)
    {
        $this->databaseConnectionService = new DatabaseConnectionService($config['database']);
        $this->redisConnectionService = new RedisConnectionService($config['redis']);

        $this->postMigration = new PostMigration($this->databaseConnectionService);
        $this->postMigration->migrate();

        $this->postRepository = new PostRepository(
            $this->databaseConnectionService,
            $this->redisConnectionService
        );

        dump($this->postRepository->getPosts());

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
