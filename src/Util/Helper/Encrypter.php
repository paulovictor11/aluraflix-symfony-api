<?php

namespace App\Util\Helper;

use App\Interface\Helper\iEncrypter;
use App\Util\Error\MissingParamError;

class Encrypter implements iEncrypter
{
    /**
     * @param string $value
     * @param string $hash
     * @return bool
     * @throws MissingParamError
     */
    public static function compare(string $value, string $hash): bool
    {
        if (empty($value)) {
            throw new MissingParamError('value');
        }

        if (empty($hash)) {
            throw new MissingParamError('hash');
        }

        return password_verify($value, $hash);
    }

    /**
     * @param string $value
     * @return string|bool
     * @throws MissingParamError
     */
    public static function encrypt(string $value): string|bool
    {
        if (empty($value)) {
            throw new MissingParamError('value');
        }

        return password_hash($value, PASSWORD_BCRYPT);
    }
}
