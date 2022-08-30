<?php

namespace App\Util\Helper;

use App\Interface\Helper\iUrlValidator;
use MissingParamError;

class UrlValidator implements iUrlValidator
{
    public static function isValid(string $url): bool
    {
        if (is_null($url)) {
            throw new MissingParamError('url');
        }

        return filter_var($url, FILTER_VALIDATE_URL);
    }
}
