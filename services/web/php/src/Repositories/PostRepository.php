<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\PostEntity;
use App\Servcies\RedisService;
use App\Database\DatabaseConnectionService;
use App\Database\RedisConnectionService;

final class PostRepository
{
    private readonly RedisService $redisService;

    public function __construct(
        private readonly DatabaseConnectionService $dbConnectionService,
        private readonly RedisConnectionService $redisConnectionService,
    ) {
        $this->redisService = new RedisService($this->redisConnectionService);
    }

    public function getPosts(): array
    {
        $posts = $this->fetchAllPosts();

        if (empty($posts)) {
            dd('no-posts');
        }

        return $this->hydratePosts($posts);
    }

    public function getPostById(int $id): PostEntity
    {
        $post = $this->fetchPostById($id);

        if ($post === false) {
            dd('404');
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
        $cachedPosts = $this->redisService->get($cacheKey);

        if ($cachedPosts !== null) {
            return $cachedPosts;
        }

        $query = "SELECT id, title, description, created_at, updated_at FROM posts";
        $stmt = $this->dbConnectionService->getPdo()->query($query);
        $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->cachePosts($cacheKey, $posts);

        return $posts;
    }

    private function fetchPostById(int $id): array|bool
    {
        $cacheKey = "post:{$id}";
        $cachedPost = $this->redisService->get($cacheKey);

        if ($cachedPost !== null) {
            return $cachedPost;
        }

        $query = "SELECT id, title, description, created_at, updated_at FROM posts WHERE id = :id";
        $stmt = $this->dbConnectionService->getPdo()->prepare($query);
        $stmt->execute(['id' => $id]);

        $post = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($post !== false) {
            $this->cachePost($cacheKey, $post);
        }

        return $post;
    }

    private function cachePost(string $cacheKey, array $post): void
    {
        $this->redisService->set($cacheKey, $post, 3600);
    }

    private function cachePosts(string $cacheKey, array $posts): void
    {
        $this->redisService->set($cacheKey, $posts, 3600);
    }
}
