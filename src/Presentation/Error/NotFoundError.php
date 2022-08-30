<?php

namespace App\Presentation\Error;

use Exception;

class NotFoundError extends Exception
{
    public function __construct(string $model)
    {
        parent::__construct("Unable to find $model");
    }
}
