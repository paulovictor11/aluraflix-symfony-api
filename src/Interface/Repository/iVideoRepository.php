<?php

namespace App\Interface\Repository;

use App\Entity\Video;

interface iVideoRepository
{
    public function all(array $filter, array $sort, int $page, int $perPage): array;
    public function add(Video $video): void;
    public function show(int $id): ?Video;
    public function update(Video $video, int $id): void;
    public function delete(int $id): void;
    public function findByCategory(int $categoryId): array;
    public function findByName(string $title): array;
    public function freeVideos(): array;
}
