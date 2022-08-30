<?php

namespace App\Util\Helper;

use App\Interface\Helper\iEmailValidator;
use MissingParamError;

class EmailValidator implements iEmailValidator
{
    public static function isValid(string $email): bool
    {
        if (is_null($email)) {
            throw new MissingParamError('email');
        }

        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
