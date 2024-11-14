<?php

namespace App\Exceptions;
class UsernameNotFoundException extends \Exception
{
    public function __construct(
        $message = "Username not found",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
