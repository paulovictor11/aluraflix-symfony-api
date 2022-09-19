<?php

namespace App\Interface\UseCase;

use App\Entity\Video;

interface iVideoUseCase
{
    public function all(array $filter, array $sort, int $page, int $perPage): array;
    public function create(string $requestData): void;
    public function show(int $id): Video;
    public function update(string $requestData, int $id): void;
    public function delete(int $id): void;
    public function findByCategory(int $categoryId): array;
    public function findByName(string $title): array;
}
