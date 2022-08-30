<?php

namespace App\Presentation\Error;

use Exception;

class UnauthorizedError extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
