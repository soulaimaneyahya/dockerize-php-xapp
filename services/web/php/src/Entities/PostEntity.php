<?php

declare(strict_types=1);

namespace App\Entities;

final class PostEntity
{
    public int $id;
    public string $title;
    public string $description;
    public string $createdAt;
    public string $updatedAt;

    public function __construct(
        int $id,
        string $title,
        string $description,
        string $createdAt,
        string $updatedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
