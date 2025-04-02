<?php

declare(strict_types=1);

namespace App\Servcies;

use Predis\Client;
use InvalidArgumentException;
use App\Database\RedisConnectionService;

final class RedisService
{
    private readonly Client $client;

    public function __construct(
        private readonly RedisConnectionService $redisConnectionService
    ) {
        $client = $this->redisConnectionService->getClient();

        if ($client === null) {
            throw new InvalidArgumentException('Redis client is null.');
        }

        $this->client = $client;
    }

    public function set(string $key, array $value, int $ttl = 3600): void
    {
        $this->client->set($key, json_encode($value));
        $this->client->expire($key, $ttl);
    }

    public function get(string $key): ?array
    {
        $value = $this->client->get($key);

        return $value ? json_decode($value, true) : null;
    }
}
