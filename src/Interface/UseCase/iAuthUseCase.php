<?php

namespace App\Interface\UseCase;

interface iAuthUseCase
{
    public function login(string $requestData): array;
}
