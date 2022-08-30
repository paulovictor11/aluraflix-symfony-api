<?php

namespace App\Interface\Helper;

interface iUrlValidator
{
    public static function isValid(string $url): bool;
}
