<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\PostEntity;
use App\Database\DatabaseConnectionService;
use App\Database\RedisConnectionService;

final class PostRepository
{
    public function __construct(
        private readonly DatabaseConnectionService $dbConnectionService,
        private readonly RedisConnectionService $redisConnectionService,
    ) {
    }

    public function getPosts(): array
    {
        return $this->hydratePosts(
            $this->fetchAllPosts()
        );
    }

    public function getPostById(int $id): ?PostEntity
    {
        $post = $this->fetchPostById($id);

        if ($post === null) {
            return null;
        }

        return $this->hydratePost($post);
    }

    private function hydratePosts(array $data): array
    {
        return array_map([$this, 'hydratePost'], $data);
    }

    private function hydratePost(array $data): PostEntity
    {
        return new PostEntity(
            $data['id'],
            $data['title'],
            $data['description'],
            $data['created_at'],
            $data['updated_at']
        );
    }

    private function fetchAllPosts(): array
    {
        $cacheKey = 'all-posts';
        $cachedPosts = $this->redisConnectionService->get($cacheKey);

        if ($cachedPosts !== null) {
            return json_decode($cachedPosts, true);
        }

        $query = "SELECT id, title, description, created_at, updated_at FROM posts";
        $stmt = $this->dbConnectionService->getPdo()->query($query);
        $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->cachePosts($cacheKey, $posts);

        return $posts;
    }

    private function fetchPostById(int $id): ?array
    {
        $cacheKey = "post:{$id}";
        $cachedPost = $this->redisConnectionService->get($cacheKey);

        if ($cachedPost !== null) {
            return json_decode($cachedPost, true);
        }

        $query = "SELECT id, title, description, created_at, updated_at FROM posts WHERE id = :id";
        $stmt = $this->dbConnectionService->getPdo()->prepare($query);
        $stmt->execute(['id' => $id]);

        $post = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($post !== null) {
            $this->cachePost($cacheKey, $post);
        }

        return $post;
    }

    private function cachePost(string $cacheKey, array $post): void
    {
        $this->redisConnectionService->set($cacheKey, json_encode($post), 3600);
    }

    private function cachePosts(string $cacheKey, array $posts): void
    {
        $this->redisConnectionService->set($cacheKey, json_encode($posts), 3600);
    }
}
