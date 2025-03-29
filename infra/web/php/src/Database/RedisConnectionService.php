<?php

declare(strict_types=1);

namespace App\Database;

use Predis\Client;

final class RedisConnectionService
{
    private readonly string $host;
    private readonly int $port;
    private readonly string $scheme;
    private readonly string $password;
    private ?Client $client = null;

    public function __construct(array $config)
    {
        $this->host = $config['host'];
        $this->port = (int) $config['port'];
        $this->scheme = $config['scheme'] ?? 'tcp';
        $this->password = $config['password'] ?? '';

        $this->connect();
    }

    private function connect(): void
    {
        try {
            if (is_null($this->client)) {
                $options = [
                    'scheme' => $this->scheme,
                    'host'   => $this->host,
                    'port'   => $this->port,
                ];

                if (!empty($this->password)) {
                    $options['password'] = $this->password;
                }

                $this->client = new Client($options);

                dump("redis-connected!");
            }
        } catch (\Exception $e) {
            // Handle connection failure and rethrow exception
            throw new \Exception("Redis connection error: " . $e->getMessage());
        }
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
