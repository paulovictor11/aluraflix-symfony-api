<?php

namespace App\Interface\UseCase;

use App\Entity\Video;

interface iVideoUseCase
{
    public function all(): array;
    public function create(string $requestData): void;
    public function show(int $id): Video;
    public function update(string $requestData, int $id): void;
    public function delete(int $id): void;
}
