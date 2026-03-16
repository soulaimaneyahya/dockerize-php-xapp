<?php

declare(strict_types=1);

namespace App\Entities;

use Carbon\Carbon;

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

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->createdAt);
    }

    public function getUpdatedAt(): Carbon
    {
        return Carbon::parse($this->updatedAt);
    }
}
