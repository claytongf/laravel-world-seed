<?php

namespace Claytongf\WorldSeed\Exceptions;

use Exception;

class FileNotFoundException extends Exception
{
    public function __construct(string $message, int $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
