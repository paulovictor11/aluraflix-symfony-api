<?php

namespace App\Util\Error;

use Exception;

class InvalidParamError extends Exception
{
    public function __construct(string $paramName)
    {
        parent::__construct("Invalid param $paramName");
    }
}
