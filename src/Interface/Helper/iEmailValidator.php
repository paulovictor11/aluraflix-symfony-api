<?php

namespace App\Interface\Helper;

interface iEmailValidator
{
    public static function isValid(string $email): bool;
}
