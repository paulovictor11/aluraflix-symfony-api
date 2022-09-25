<?php

namespace App\Util\Helper;

use App\Interface\Helper\iEmailValidator;
use App\Util\Error\MissingParamError;

class EmailValidator implements iEmailValidator
{
    /**
     * @param string $email
     * @return bool
     * @throws MissingParamError
     */
    public static function isValid(string $email): bool
    {
        if (empty($email)) {
            throw new MissingParamError('email');
        }

        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
