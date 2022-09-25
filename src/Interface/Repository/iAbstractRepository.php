<?php

namespace App\Interface\Repository;

interface iAbstractRepositry
{
    public function all(array $filter, array $sort, int $page, int $perPage): array;
    public function add(object $entity): void;
    public function show(int $id): ?object;
    public function update(object $entity, int $id): void;
    public function delete(int $id): void;
}
