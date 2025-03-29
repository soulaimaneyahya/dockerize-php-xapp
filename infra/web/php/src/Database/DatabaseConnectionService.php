<?php

declare(strict_types=1);

namespace App\Database;

use PDO;
use PDOException;

final class DatabaseConnectionService
{
    private readonly string $id;
    private readonly string $host;
    private readonly int $port;
    private readonly string $dbconnect;
    private readonly string $dbname;
    private readonly string $username;
    private readonly string $password;
    private ?PDO $pdo = null;

    public function __construct(array $config)
    {
        $this->host = $config['host'];
        $this->port = (int) $config['port'];
        $this->dbname = $config['database_name'];
        $this->dbconnect = $config['database_connect'];
        $this->username = $config['username'];
        $this->password = $config['password'];

        // Generate a unique ID for each connection
        $this->id = uniqid(uniqid('conn_', true));

        $this->connect();
    }

    private function connect(): PDO
    {
        try {
            if (is_null($this->pdo)) {
                $this->pdo = new PDO(
                    "{$this->dbconnect}:host={$this->host};port={$this->port};dbname={$this->dbname}",
                    $this->username,
                    $this->password
                );

                // Set PDO options for error handling and security
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                dump("database-{$this->dbconnect}-connected!");
            }

            return $this->pdo;
        } catch (PDOException $e) {
            // Handle connection failure and rethrow exception
            throw new \Exception("Database connection error: " . $e->getMessage());
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public function getConnectionId(): string
    {
        return $this->id;
    }
}
