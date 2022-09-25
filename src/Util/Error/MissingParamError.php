<?php

namespace App\Util\Error;

use Exception;

class MissingParamError extends Exception
{
    public function __construct(string $paramName)
    {
        parent::__construct("Missing param $paramName");
    }
}
