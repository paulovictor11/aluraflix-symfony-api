<?php

namespace App\Presentation\Error;

use Exception;

class ServerError extends Exception
{
    public function __construct()
    {
        parent::__construct("Internal Server Error");
    }
}
