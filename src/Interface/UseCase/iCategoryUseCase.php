<?php

namespace App\Interface\UseCase;

use App\Entity\Category;

interface iCategoryUseCase
{
    public function all(array $filter, array $sort, int $page, int $perPage): array;
    public function create(string $requestData): void;
    public function show(int $id): Category;
    public function update(string $requestData, int $id): void;
    public function delete(int $id): void;
}
