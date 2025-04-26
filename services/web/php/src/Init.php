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

        if ($_SERVER['REQUEST_URI'] === '/') {
            dump($this->postRepository->getPosts());
        } elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {
            // number or a numeric string
            dump($this->postRepository->getPostById((int)$_GET['id']));
        }

        $this->logConfig($config);
    }

    private function logConfig(array $config): void
    {
        $pdo = $this->databaseConnectionService->getPdo();
        $version = $pdo->query('SELECT VERSION()')->fetchColumn();

        dump("MySQL Version: {$version}");
        
        dump([
            $config['app_name'],
            $config['app_root'],
            $config['app_url'],
            $_SERVER['SERVER_ADDR'],
            $_SERVER['SERVER_PORT'],
        ]);
    }
}
