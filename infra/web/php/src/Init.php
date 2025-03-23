<?php

declare(strict_types=1);

namespace App;

use App\DatabaseConnection;

final class Init
{
    private readonly DatabaseConnection $dbConnection;

    public function __construct(array $config)
    {
        $this->dbConnection = new DatabaseConnection($config);
        // $this->migrateDatabase();
        $posts = $this->getPosts();

        foreach ($posts as $post) {
            echo '<h4>#' . htmlspecialchars($post['title']) . '</h4>';
            echo '<p>' . htmlspecialchars($post['description']) . '</p>';
            echo '<p>Created At: ' . $post['created_at'] . '</p>';
            echo '<hr>';
        }

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

    public function getPosts(): array
    {
        $query = "SELECT id, title, description, created_at, updated_at FROM posts";
        $stmt = $this->dbConnection->getPdo()->query($query);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    /**
     * migrations
     *
     * @return void
     */
    protected function migrateDatabase(): void
    {
        $sql = "
            DROP TABLE IF EXISTS posts;
            CREATE TABLE posts (
                id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description VARCHAR(700),
                created_at TIMESTAMP NULL DEFAULT NULL,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );

            INSERT INTO posts (title, description, created_at, updated_at) VALUES
            ('Lorem Ipsum 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.', NOW(), NOW()),
            ('Lorem Ipsum 2', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', NOW(), NOW()),
            ('Lorem Ipsum 3', 'Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Proin eget tortor risus.', NOW(), NOW()),
            ('Lorem Ipsum 4', 'Nulla quis lorem ut libero malesuada feugiat. Cras ultricies ligula sed magna dictum porta.', NOW(), NOW()),
            ('Lorem Ipsum 5', 'Quisque velit nisi, pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada.', NOW(), NOW());
        ";

        $this->dbConnection->getPdo()->exec($sql);
    }
}
