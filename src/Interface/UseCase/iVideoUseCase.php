<?php

namespace App\Interface\UseCase;

interface iVideoUseCase extends iAbstractUseCase
{
    public function findByCategory(int $categoryId): array;
    public function findByName(string $title): array;
    public function freeVideos(): array;
}
