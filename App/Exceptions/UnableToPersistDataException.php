<?php
namespace App\Exceptions;

class UnableToPersistDataException extends \Exception
{
    public function __construct(
        $message = "Unable to persist data",
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
