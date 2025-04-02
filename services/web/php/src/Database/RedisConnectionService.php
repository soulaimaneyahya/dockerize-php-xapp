<?php

declare(strict_types=1);

namespace App\Database;

use Predis\Client;

final class RedisConnectionService
{
    private readonly string $host;
    private readonly int $port;
    private readonly string $scheme;
    private ?Client $client = null;

    public function __construct(array $config)
    {
        $this->host = $config['host'];
        $this->port = (int) $config['port'];
        $this->scheme = $config['scheme'] ?? 'tcp';

        $this->connect();
    }

    private function connect(): void
    {
        try {
            if (is_null($this->client)) {
                $this->client = new Client([
                    'scheme' => $this->scheme,
                    'host'   => $this->host,
                    'port'   => $this->port,
                ]);

                dump("redis-connected!");
            }
        } catch (\Exception $e) {
            dump("Redis Connection failed: " . $e->getMessage());
        }
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }
}
