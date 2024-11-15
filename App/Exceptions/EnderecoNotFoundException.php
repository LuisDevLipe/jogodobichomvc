<?php

namespace App\Exceptions;
class EnderecoNotFoundException extends \Exception
{
    public function __construct(
        $message = "Endereco not found",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
