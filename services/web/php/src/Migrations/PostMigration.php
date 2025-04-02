<?php

declare(strict_types=1);

namespace App\Migrations;

use App\Database\DatabaseConnectionService;

final class PostMigration
{
    public function __construct(
        private readonly DatabaseConnectionService $dbConnectionService
    ) {
    }

    /**
     * Run the posts table migration.
     */
    public function migrate(): void
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
                ('Lorem Ipsum 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NOW(), NOW()),
                ('Lorem Ipsum 2', 'Quisque velit nisi, pretium ut lacinia in.', NOW(), NOW());
            ";

            $this->dbConnectionService->getPdo()->exec($sql);
        } catch (\Exception $ex) {
            error_log($ex->getMessage());
        }
    }
}
