<?php

namespace App\Util\Helper;

use App\Interface\Helper\iEncrypter;
use MissingParamError;

class Encrypter implements iEncrypter
{
    public static function compare(string $value, string $hash): bool
    {
        if (is_null($value)) {
            throw new MissingParamError('value');
        }

        if (is_null($hash)) {
            throw new MissingParamError('hash');
        }

        return password_verify($value, $hash);
    }

    public static function encrypt(string $value): string|bool
    {
        if (is_null($value)) {
            throw new MissingParamError('value');
        }

        return password_hash($value, PASSWORD_BCRYPT);
    }
}
