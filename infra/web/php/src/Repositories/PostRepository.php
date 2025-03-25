<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\PostEntity;
use App\Database\ConnectionService;

final class PostRepository
{
    public array $posts = [];

    private readonly ConnectionService $dbConnection;

    public function __construct(array $config)
    {
        $this->dbConnection = new ConnectionService($config);

        $this->posts = $this->setPosts();
    }

    public function setPosts(): array
    {
        $query = "SELECT id, title, description, created_at, updated_at FROM posts";
        $stmt = $this->dbConnection->getPdo()->query($query);

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->hydratePosts($data);

        return $this->posts;
    }

    public function getPosts(): array
    {
        return $this->posts;
    }

    /**
     * Hydrate posts
     *
     * @param array $data
     * @return void
     */
    public function hydratePosts(array $data): void
    {
        foreach ($data as $post) {
            $this->posts[] = new PostEntity(
                $post['id'],
                $post['title'],
                $post['description'],
                $post['created_at'],
                $post['updated_at']
            );
        }
    }
}
