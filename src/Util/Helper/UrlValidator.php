<?php

namespace App\Util\Helper;

use App\Interface\Helper\iUrlValidator;
use App\Util\Error\MissingParamError;

class UrlValidator implements iUrlValidator
{
    /**
     * @param string $url
     * @return bool
     * @throws MissingParamError
     */
    public static function isValid(string $url): bool
    {
        if (empty($url)) {
            throw new MissingParamError('url');
        }

        return filter_var($url, FILTER_VALIDATE_URL);
    }
}
