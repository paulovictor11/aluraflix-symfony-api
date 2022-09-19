<?php

namespace App\Interface\UseCase;

interface iUserUseCase
{
    public function create(string $requestData): void;
}
