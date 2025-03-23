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

    /**
     * migrations
     *
     * @return void
     */
    private function migrateDatabase(): void
    {
        try {
            $sql = "
                DROP TABLE IF EXISTS posts;
                CREATE TABLE posts (
                    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                    title VARCHAR(255) NOT NULL,
                    description VARCHAR(700),
                    created_at TIMESTAMP NULL DEFAULT NULL,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );

                TRUNCATE posts;
                INSERT INTO posts (title, description, created_at, updated_at) VALUES
                ('Lorem Ipsum 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.', NOW(), NOW()),
                ('Lorem Ipsum 2', 'Quisque velit nisi, pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada.', NOW(), NOW());
            ";

            $this->dbConnection->getPdo()->exec($sql);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
