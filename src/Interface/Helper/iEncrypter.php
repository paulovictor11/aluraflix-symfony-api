<?php

namespace App\Interface\Helper;

interface iEncrypter
{
    public static function compare(string $value, string $hash): bool;
    public static function encrypt(string $value): string|bool;
}
