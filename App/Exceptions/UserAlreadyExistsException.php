<?php

namespace App\Exceptions;
class UserAlreadyExistsException extends \Exception
{
    public function __construct(
        $message = "User is not available",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
