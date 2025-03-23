<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;

class DatabaseConnection
{
    private PDO $pdo;
    private string $host;
    private int $port;
    private string $dbname;
    private string $username;
    private string $password;

    public function __construct(array $config)
    {
        $this->host = $config['database']['host'];
        $this->port = (int) $config['database']['port'];
        $this->dbname = $config['database']['database_name'];
        $this->username = $config['database']['username'];
        $this->password = $config['database']['password'];

        $this->connect();
    }

    private function connect(): void
    {
        $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}";

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "db-connected!";
        } catch (PDOException $e) {
            echo "db-connection-failed: " . $e->getMessage();
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
