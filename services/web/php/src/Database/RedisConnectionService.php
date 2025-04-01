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

    public function getClient(): Client
    {
        return $this->client;
    }

    public function set(string $key, mixed $value, int $ttl = 3600): void
    {
        $this->client->set($key, json_encode($value));
        $this->client->expire($key, $ttl);
    }

    public function get(string $key): mixed
    {
        $value = $this->client->get($key);

        return $value ? json_decode($value, true) : null;
    }
}
