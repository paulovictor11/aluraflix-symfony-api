<?php

namespace App\Interface\Controller;

use App\Entity\Category;

interface iCategoryRepository
{
    public function all(array $filter, array $sort, int $page, int $perPage): array;
    public function add(Category $category): void;
    public function show(int $id): ?Category;
    public function update(Category $category, int $id): void;
    public function delete(int $id): void;
}
