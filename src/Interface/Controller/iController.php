<?php

namespace App\Interface\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface iController
{
    public function all(): JsonResponse;
    public function create(Request $request): JsonResponse;
    public function show(int $id): JsonResponse;
    public function update(Request $request, int $id): JsonResponse;
    public function delete(int $id): JsonResponse;
}
