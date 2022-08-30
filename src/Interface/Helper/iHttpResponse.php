<?php

namespace App\Interface\Helper;

use Symfony\Component\HttpFoundation\JsonResponse;

interface iHttpResponse
{
    public static function serverError(): JsonResponse;
    public static function unauthorized(string $message): JsonResponse;
    public static function badRequest(?string $message = ""): JsonResponse;
    public static function created(): JsonResponse;
    public static function ok(array|object $body = null): JsonResponse;
}
