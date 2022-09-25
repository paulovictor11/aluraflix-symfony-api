<?php

namespace App\Interface\Repository;

use App\Entity\Video;

interface iVideoRepository extends iAbstractRepositry
{
    public function findByCategory(int $categoryId): array;
    public function findByName(string $title): array;
    public function freeVideos(): array;
}
