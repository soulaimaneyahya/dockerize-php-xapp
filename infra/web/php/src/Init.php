<?php

declare(strict_types=1);

namespace App;

use App\Repositories\PostRepository;

final class Init
{
    private readonly array $posts;

    public function __construct(array $config)
    {
        $this->posts = (new PostRepository($config))->getPosts();

        $this->getPosts();

        $this->dumpConfig($config);
    }

    protected function getPosts(): void
    {
        foreach ($this->posts as $post) {
            echo '<h4>#' . htmlspecialchars($post->getTitle()) . '</h4>';
            echo '<p>' . htmlspecialchars($post->getDescription()) . '</p>';
            echo '<p>Created At: ' . $post->getCreatedAt() . '</p>';
            echo '<hr>';
        }
    }

    protected function dumpConfig(array $config): void
    {
        dump($config['app_name']);
        dump($config['app_root']);
        dump($config['app_url']);
        dump($_SERVER['SERVER_ADDR']);
        dd($_SERVER['SERVER_PORT']);
    }
}
