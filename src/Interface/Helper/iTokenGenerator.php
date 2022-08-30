<?php

namespace App\Interface\Helper;

interface iTokenGenerator
{
    public static function generate(int $id): string;
    public static function validate(string $token): bool;
    public static function decode(string $token): object;
}
